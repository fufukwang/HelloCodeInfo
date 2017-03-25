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
    SoundMp3('../Monks.mp3'),
    canvas = document.getElementById('canvas'),
    stage  = new createjs.Stage(canvas);
    /*
    var e  = new createjs.Bitmap('../rsz_anh-phan-134368.jpg').set( {scaleX:1.2,scaleY :1.2} );
    stage.addChild(e);*/
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


function resizeInput() {
    $(this).attr('size', $(this).val().length);
}

$('input[type="text"], input[type="email"]')
    // event handler
    .keyup(resizeInput)
    // resize on page load
    .each(resizeInput);


console.clear();
// Adapted from georgepapadakis.me/demo/expanding-textarea.html
(function(){
  
  var textareas = document.querySelectorAll('.expanding'),
      
      resize = function(t) {
        t.style.height = 'auto';
        t.style.overflow = 'hidden'; // Ensure scrollbar doesn't interfere with the true height of the text.
        t.style.height = (t.scrollHeight + t.offset ) + 'px';
        t.style.overflow = '';
      },
      
      attachResize = function(t) {
        if ( t ) {
          console.log('t.className',t.className);
          t.offset = !window.opera ? (t.offsetHeight - t.clientHeight) : (t.offsetHeight + parseInt(window.getComputedStyle(t, null).getPropertyValue('border-top-width')));

          resize(t);

          if ( t.addEventListener ) {
            t.addEventListener('input', function() { resize(t); });
            t.addEventListener('mouseup', function() { resize(t); }); // set height after user resize
          }

          t['attachEvent'] && t.attachEvent('onkeyup', function() { resize(t); });
        }
      };
  
  // IE7 support
  if ( !document.querySelectorAll ) {
  
    function getElementsByClass(searchClass,node,tag) {
      var classElements = new Array();
      node = node || document;
      tag = tag || '*';
      var els = node.getElementsByTagName(tag);
      var elsLen = els.length;
      var pattern = new RegExp("(^|\\s)"+searchClass+"(\\s|$)");
      for (i = 0, j = 0; i < elsLen; i++) {
        if ( pattern.test(els[i].className) ) {
          classElements[j] = els[i];
          j++;
        }
      }
      return classElements;
    }
    
    textareas = getElementsByClass('expanding');
  }
  
  for (var i = 0; i < textareas.length; i++ ) {
    attachResize(textareas[i]);
  }
  
})();