<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>音樂頻譜網頁</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.4/jquery.fullpage.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <style>
*{
            margin: 0;
            padding: 0;
        }
        #canvas{
            display: block;
        }
#PlayBtn{color:#eee;position: absolute;bottom:30px;border: 3px solid #fff;
    padding: 25px;
    border-radius: 48px;}
#first-view{
  background: #000 url(minwt_bg.jpg) center center fixed no-repeat;
  -moz-background-size: cover;
  background-size: cover;
}




#third-view{
  background: linear-gradient(49deg, #ffb75e, #ed8f03, #f7c90b);
  background-size: 600% 600%;

  -webkit-animation: third-bganimator 7s ease infinite;
  -moz-animation: third-bganimator 7s ease infinite;
  animation: third-bganimator 7s ease infinite;
}
@-webkit-keyframes third-bganimator {
    0%{background-position:0% 96%}
    50%{background-position:100% 5%}
    100%{background-position:0% 96%}
}
@-moz-keyframes third-bganimator {
    0%{background-position:0% 96%}
    50%{background-position:100% 5%}
    100%{background-position:0% 96%}
}
@keyframes third-bganimator { 
    0%{background-position:0% 96%}
    50%{background-position:100% 5%}
    100%{background-position:0% 96%}
}
    </style>   
</head>
<body> 
<div id="fullpage">
  <div class="section" id="first-view">
    <canvas id="canvas"></canvas>
    <div style="text-align: center;font-size: 50px;">
<a href="javascript:;" id="PlayBtn">
  <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
</a>
    </div>
  </div>
  <div class="section">
  這不是空白畫面~只是還沒完成而已
  </div>
  <div class="section" id="third-view">
    留言系統待補 信箱:<a href="mailto:service@fufuk.com">service@fufuk.com</a>
  </div>
</div>





<script src="https://code.createjs.com/createjs-2015.11.26.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- This following line is optional. Only necessary if you use the option css3:false and you want to use other easing effects rather than "linear", "swing" or "easeInOutCubic". -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.4/vendors/jquery.easings.min.js"></script>
<!-- This following line is only necessary in the case of using the option `scrollOverflow:true` -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.4/vendors/scrolloverflow.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.4/jquery.fullpage.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
var playing = false;
function resizeCanvas(){                                                    
  var e = document.getElementById('canvas'); 
  e.setAttribute('width',window.innerWidth),e.setAttribute('height',window.innerHeight); 
}
function SoundMp3(e){
  createjs.Sound.alternateExtensions = ['mp3'],createjs.Sound.registerSound( e,'sound') ,createjs.Sound.on('fileload',loadHandler);
}
function loadHandler(){
  var t = createjs.Sound.activePlugin.context;analyserNode = t.createAnalyser(), 
    analyserNode.fftSize = 2048,
    analyserNode.connect(t.destination);
  var a=createjs.Sound.activePlugin.dynamicsCompressorNode;
    a.disconnect(),
    a.connect(analyserNode),
    freqByteData = new Uint8Array(analyserNode.frequencyBinCount);
  for(var n=0;n <freqByteData.length;n ++ ){ 
    var r = new createjs.Graphics();
    r.beginFill('#fff'),
    r.drawRect(0,-10, window.innerWidth/2048,20);
    var i = new createjs.Shape(r);
    stage.addChild(i),i.x =6*n,i.y=window.innerHeight/2,
    soundArray.push(i);
  }
  createjs.Ticker.setFPS(60),createjs.Ticker.addEventListener('tick',handleTick);
}
function handleTick(){
  analyserNode.getByteFrequencyData(freqByteData);
  for(var e=0;e<freqByteData.length;e++) soundArray[e].scaleY = freqByteData[e]/5*-1;
  stage.update();
} 
var analyserNode,
  freqByteData,
  canvas,
  stage,
  soundArray = [];
  window.onresize = resizeCanvas, 
  window.onload = function(){
    resizeCanvas(),
    SoundMp3('Monks.mp3'),
    canvas = document.getElementById('canvas'),
    stage  = new createjs.Stage(canvas);
    var e  = new createjs.Bitmap('rsz_anh-phan-134368.jpg').set( {scaleX:1.2,scaleY :1.2} );
    stage.addChild(e);
  };        
$(document).ready(function() {
  $('#fullpage').fullpage({navigation:true});
  $('#PlayBtn').bind('click',function(){
    if(playing){
      $(this).find('span').removeClass('glyphicon-pause');
      $(this).find('span').addClass('glyphicon-play');
      createjs.Sound.stop();
      playing = false;
    } else {
      $(this).find('span').removeClass('glyphicon-play');
      $(this).find('span').addClass('glyphicon-pause');
      createjs.Sound.play('sound',{loop:-1,volume:.1});
      playing = true;
    }
  });
});


    </script>
</body></html>