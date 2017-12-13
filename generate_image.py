from sys import argv
import imgkit
import uuid

username = argv[1]
profile_picture = argv[2]
posts = argv[3]
likes = argv[4]
images = argv[5:]

body="""
    <html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,700,500,100" rel="stylesheet">
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-size: 40px;
                font-family: 'Roboto';
            }
            .primary-container{
                padding: 15px;
                width: 1110px;
            }
            .top{
                padding:15px;
            }
            .top img{
                width: 90px;
                height: 90px;
                border-radius: 50%;
                margin-right: 20px;
            }
            .top>*{
                float:left;
            }
            .top:after{
                content:'';
                display: table;
                clear: both;
            }
            .image-grid{
                width: 1080px;
            }
            .image-grid:after{
                content:'';
                display: table;
                clear: both;
            }
            .image-grid .image{
                width: 360px;
                height: 360px;
                float: left;
                border: none;
                text-align: center;
                background-position: center center;
                background-size: cover;
            }
            .bottom{
                padding:15px;
            }
        </style>
    </head>

    <body>
        <div class="primary-container">
            <div class="top">
                <img src="
                """
body+=profile_picture
body+="""
                    "/>
                <div>
                    <p style="font-weight: 700">
    """
body+=username
body+="""
        </p>
        <p style="color:#666">2017 top nine on Instagram&nbsp;<span style="font-weight: 700;color:#4c82f2">#TopNine2017</span></p>
    </div>
</div>
<div class="image-grid">
"""
for image in images:
    imagestring = "<div class=\"image\" style=\"background-image: url(\'"+image+"\')\"></div>"
    body+=imagestring

body+="""
            </div>
            <div class="bottom">
                <p style="color:#666"><span style="font-weight: 700;color:black"><i class="fa fa-heart" style="color:red"></i>
                """
body+=likes
body+="""
         Likes</span>&nbsp;to 
         """
body+=posts
body+=""" posts in 2017</p>
                <p style="color:#666"><span style="font-weight: 700;color:black">
                """
body+=username
body+="""
                </span> Thank you for your likes!</p>
            </div>
        </div>
    </body>
</html>
"""

options_original = {
    'crop-h': '1920',
    'crop-w': '1110',
    'crop-x': '0',
    'crop-y': '0'
}

options_photo = {
    'crop-h': '1080',
    'crop-w': '1080',
    'crop-x': '15',
    'crop-y': '140'
}

imagename = '2017topnine_'+str(uuid.uuid4())

imgkit.from_string(body, 'images/insta/'+imagename+'_original.jpeg', options=options_original)
imgkit.from_string(body, 'images/insta/'+imagename+'_photo.jpeg', options=options_photo)
print(imagename)