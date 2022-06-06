{% extends 'base.php'%}

{% block timer %}

<p>Exam Time<p>

{% endblock %}




{% block content %}

<!--We wanted to include webcam into the website, however this might increase the stress of student, thus we decided to not add that component-->
<img src="{{ url_for('video') }}" width=50%/>
<div style="text-align: center">
<form name="passdata" action"." method="POST">
<input type ="submit" value ="Finish Test" name = "endtest" id="endtest" style="width: 300px"/>
</form>
</div>

{% endblock %}

