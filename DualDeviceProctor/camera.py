import cv2
import numpy as np

class Video(object):

    #capture video, 0 means webcam
    def __init__(self):
        self.video=cv2.VideoCapture(0)

    #release camera
    def __del__(self):
        self.video.release()

    #extract the frames
    def get_frame(self):
        ret,frame=self.video.read()
        ret,jpg =cv2.imencode('.jpg',frame)
        return jpg.tobytes()