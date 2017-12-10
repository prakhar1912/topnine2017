from sys import argv
import imgkit

username = argv[1]
profile_picture = argv[2]
posts = argv[3]
likes = argv[4]
images = argv[5:]

body="""
	<html>
    <head>
        <style>
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-size: 20px;
            }
            .primary-container{
                margin: 10px;
                width: 600px;
            }
            .top img{
                width: 40px;
                height: 40px;
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
                width: 100%;
            }
            .image-grid:after{
                content:'';
                display: table;
                clear: both;
            }
            .image-grid .image{
                width: 200px;
                height: 200px;
                float: left;
                border: none;
                text-align: center;
            }
            .image img{
            	height: 200px;
            }
            .bottom{
                padding:5px;
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
                    <p style="font-weight: bold">
    """
body+=username
body+="""
        </p>
        <p>2017 top nine on Instagram&nbsp;<span style="font-weight: bold">#TopNine2017</span></p>
    </div>
</div>
<div class="image-grid">
"""
for image in images:
    imagestring = "<div class=\"image\"><img src=\""+image+"\" /></div>"
    body+=imagestring

body+="""
            </div>
            <div class="bottom">
                <p><span style="font-weight: bold"><img src="http://cdn.mysitemyway.com/icons-watermarks/simple-black/foundation/foundation_heart/foundation_heart_simple-black_512x512.png" style="width:15px"/>&nbsp;
                """
body+=likes
body+="""
         Likes</span>&nbsp;to 
         """
body+=posts
body+=""" posts in 2017</p>
                <p><span style="font-weight: bold">
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
    'crop-h': '720',
    'crop-w': '620',
    'crop-x': '0',
    'crop-y': '0'
}

options_photo = {
    'crop-h': '600',
    'crop-w': '620',
    'crop-x': '0',
    'crop-y': '60'
}

imagename = '2017topnine_'+username

imgkit.from_string(body, 'images/'+imagename+'_original.jpeg', options=options_original)
imgkit.from_string(body, 'images/'+imagename+'_photo.jpeg', options=options_photo)
print(imagename)