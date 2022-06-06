from flask import Flask, render_template, Response, url_for,request
from camera import Video
import numpy as np
import cv2
import time
import datetime
from threading import Thread

globalvar = True

class MotionDetection(object):

    is_recording = False
    time_counter = 0

    # Standard Video Dimensions Sizes
    # different resolutions available for the video
    STD_DIMENSIONS = {
        "480p": (640, 480),
        "720p": (1280, 720),
        "1080p": (1920, 1080),
        "4k": (3840, 2160),
    }
    ##assigning values
    def __init__(self, path, video_source, video_size, frame_rate, threshold, time_interval, recording_time, show_camera, show_mask, debug):
        self.video_source = video_source                # 0 is assigned to enable webcam usage.
        self.video_size = video_size                    # determine the resolution of video
        self.get_dimensions(video_size)                 # Width and Height of camera
        self.threshold = threshold                      # sensitivity, 0 being super sensible, and 100000 not sensible at all
        self.frame_rate = frame_rate                    # Frame rate of the output video
        self.time_interval = time_interval              # Time interval between records in seconds
        self.recording_time = recording_time            # Duration of the video recorded if motion detected
        self.path = path                                # Recorded file saving path
        self.show_camera = show_camera
        self.show_mask = show_mask                      #show difference in frame
        self.debug = debug

        # Initializing components
        #1. Video capture : live feed
        #2. creating background subtraction for image processing
        # Integrate current frame with the background, output : foreground mask (can be seen on mask frame window )
        self.cap = cv2.VideoCapture(video_source)
        self.sub = cv2.createBackgroundSubtractorMOG2()
        self.cap.set(3, self.width)
        self.cap.set(4, self.height)

        # Preparing window frame
        # if value assigned is true, window will be shown
        if self.show_camera:
            cv2.namedWindow('Motion Detection', cv2.WINDOW_NORMAL)
            cv2.resizeWindow('Motion Detection', 640, 420)

        if self.show_mask:
            cv2.namedWindow('Motion Mask', cv2.WINDOW_NORMAL)
            cv2.resizeWindow('Motion Mask', 640, 420)

    #set default as 480p, then change to the assigned video_size
    def get_dimensions(self, video_size):
        self.width, self.height = self.STD_DIMENSIONS['480p']
        if video_size in self.STD_DIMENSIONS:
            self.width, self.height = self.STD_DIMENSIONS[video_size]


    def start(self):
        self.time_counter = time.time()
        print("Camera detected! Size: " + str(self.cap.get(cv2.CAP_PROP_FRAME_WIDTH)) + 'x' + str(self.cap.get(cv2.CAP_PROP_FRAME_HEIGHT)))
        print("Motion Detection activated. Waiting for motion...")
        while (globalvar == True):
        ##while (True):
            # Reading the frame
            ret, frame = self.cap.read()
            if self.show_camera:
                cv2.imshow("Motion Detection", frame)

            # Creating the mask
            #updates the background model
            blur = cv2.GaussianBlur(frame, (19, 19), 0)
            mask = self.sub.apply(blur)
            if self.show_mask:
                cv2.imshow("Motion Mask",mask)

            # Creating numpy histogram to analyse the noise of the pixels
            img_temp = np.ones(frame.shape, dtype="uint8") * 255
            img_temp_and = cv2.bitwise_and(img_temp, img_temp, mask=mask)
            img_temp_and_bgr = cv2.cvtColor(img_temp_and, cv2.COLOR_BGR2GRAY)
            hist, bins = np.histogram(img_temp_and_bgr.ravel(), 256, [0, 256])
            if self.debug:
                print("Threshold =", self.threshold, ", Noise = ", hist[255], )

            # Testing if the histogram is greater than the threshold configured
            # Launching the recording thread
            if hist[255] > self.threshold and not self.is_recording and time.time() - self.time_counter > self.time_interval:
                print("Motion detected! Recording video...")
                self.is_recording = True
                if not self.show_mask and not self.show_camera:
                    self.record_video()
                else:
                    record_thread = Thread(target=self.record_video)
                    record_thread.start()

            ##this is for self debugging/checking
            k=cv2.waitKey(1)
            if k==ord('q') or k==ord('Q'):
                print("End Motion Detection")
                break


    # Recording thread
    def record_video(self):
        date = datetime.datetime.now().strftime("%Y-%m-%d-%H-%M-%S")
        fourcc = cv2.VideoWriter_fourcc(*'XVID')
        out = cv2.VideoWriter(self.path + '/' + date+'.avi', fourcc, self.frame_rate, self.STD_DIMENSIONS[self.video_size])
        time_counter = time.time()
        while time.time() - time_counter < self.recording_time and self.cap.isOpened():
            ret, frame = self.cap.read()
            if ret == True:
                out.write(frame)
            else:
                break
            cv2.waitKey(int(self.recording_time / self.frame_rate*100))
        print("Video recorded: " + self.path + '/' + date + '.mp4')
        self.time_counter = time.time()
        self.is_recording = False

    def end(self):
        self.cap.release()
        cv2.destroyAllWindows()


app = Flask(__name__)

@app.route("/")
def index():
    return render_template("examindex.php")

@app.route('/', methods=['POST',])
def getvalue():
    if request.method=="POST":
        if request.form["endtest"]:
            global globalvar
            globalvar = False
            return render_template('testfinish.php')

##loop
##getframe from camera.py get_frame()
def gen(camera):
    while True:
        #live video, but not activated for now
        frame=camera.get_frame()
        yield(b'--frame\r\n'
       b'Content-Type:  image/jpeg\r\n\r\n' + frame +
         b'\r\n\r\n')

    # MotionDetection(path, video_source =0 , video_size = 720p, frame_rate =24 , threshold = 70000, time_interval 4 seconds before it starts motion detecting again, recording_time =10 , show_camera, show_mask, debug)
        md= MotionDetection("C:\\xampp\\htdocs\\DualDeviceProctor\\recordings", 0, '720p', 24.0, 70000, 4, 10, False, False, False)
        md.start()
        md.end()

##to capture the camera, and since it takes 1 by 1, we need loop
##thus we create a function gen(camera) for the loop
@app.route('/video')

##mimetype from google, information that we want to pass
def video():
    return Response(gen(Video()), mimetype ='multipart/x-mixed-replace; boundary=frame')



if __name__=="__main__":
    app.run(debug=True)




