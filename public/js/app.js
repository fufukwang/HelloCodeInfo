// jquery.countdown
(function( $ ){!function(e){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=e();else if("function"==typeof define&&define.amd)define([],e);else{var n;"undefined"!=typeof window?n=window:"undefined"!=typeof global?n=global:"undefined"!=typeof self&&(n=self),n.Countdown=e()}}(function(){var define,module,exports;return function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s}({1:[function(require,module,exports){var defaultOptions={date:"June 7, 2087 15:03:25",refresh:1e3,offset:0,onEnd:function(){return},render:function(date){this.el.innerHTML=date.years+" years, "+date.days+" days, "+this.leadingZeros(date.hours)+" hours, "+this.leadingZeros(date.min)+" min and "+this.leadingZeros(date.sec)+" sec"}};var Countdown=function(el,options){this.el=el;this.options={};this.interval=false;for(var i in defaultOptions){if(defaultOptions.hasOwnProperty(i)){this.options[i]=typeof options[i]!=="undefined"?options[i]:defaultOptions[i];if(i==="date"&&typeof this.options.date!=="object"){this.options.date=new Date(this.options.date)}if(typeof this.options[i]==="function"){this.options[i]=this.options[i].bind(this)}}}this.getDiffDate=function(){var diff=(this.options.date.getTime()-Date.now()+this.options.offset)/1e3;var dateData={years:0,days:0,hours:0,min:0,sec:0,millisec:0};if(diff<=0){if(this.interval){this.stop();this.options.onEnd()}return dateData}if(diff>=365.25*86400){dateData.years=Math.floor(diff/(365.25*86400));diff-=dateData.years*365.25*86400}if(diff>=86400){dateData.days=Math.floor(diff/86400);diff-=dateData.days*86400}if(diff>=3600){dateData.hours=Math.floor(diff/3600);diff-=dateData.hours*3600}if(diff>=60){dateData.min=Math.floor(diff/60);diff-=dateData.min*60}dateData.sec=Math.round(diff);dateData.millisec=diff%1*1e3;return dateData}.bind(this);this.leadingZeros=function(num,length){length=length||2;num=String(num);if(num.length>length){return num}return(Array(length+1).join("0")+num).substr(-length)};this.update=function(newDate){if(typeof newDate!=="object"){newDate=new Date(newDate)}this.options.date=newDate;this.render();return this}.bind(this);this.stop=function(){if(this.interval){clearInterval(this.interval);this.interval=false}return this}.bind(this);this.render=function(){this.options.render(this.getDiffDate());return this}.bind(this);this.start=function(){if(this.interval){return}this.render();if(this.options.refresh){this.interval=setInterval(this.render,this.options.refresh)}return this}.bind(this);this.updateOffset=function(offset){this.options.offset=offset;return this}.bind(this);this.start()};module.exports=Countdown},{}],2:[function(require,module,exports){var Countdown=require("./countdown.js");var NAME="countdown";var DATA_ATTR="date";jQuery.fn.countdown=function(options){return $.each(this,function(i,el){var $el=$(el);if(!$el.data(NAME)){if($el.data(DATA_ATTR)){options.date=$el.data(DATA_ATTR)}$el.data(NAME,new Countdown(el,options))}})};module.exports=Countdown},{"./countdown.js":1}]},{},[2])(2)});})( jQuery );


var playing = false;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
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
    .keyup(resizeInput)
    .each(resizeInput);


(function(){
  
  var textareas = document.querySelectorAll('.expanding'),
      
      resize = function(t) {
        t.style.height = 'auto';
        t.style.overflow = 'hidden'; 
        t.style.height = (t.scrollHeight + t.offset ) + 'px';
        t.style.overflow = '';
      },
      
      attachResize = function(t) {
        if ( t ) {
          t.offset = !window.opera ? (t.offsetHeight - t.clientHeight) : (t.offsetHeight + parseInt(window.getComputedStyle(t, null).getPropertyValue('border-top-width')));
          resize(t);

          if ( t.addEventListener ) {
            t.addEventListener('input', function() { resize(t); });
            t.addEventListener('mouseup', function() { resize(t); });
          }

          t['attachEvent'] && t.attachEvent('onkeyup', function() { resize(t); });
        }
      };
  
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
  

  $('#contact-form').submit(function(){
    var obj = {
      'name'  : $('#your-name').val(),
      'email' : $('#email').val(),
      'note'  : $('#your-message').val(),
    };
    $.post('/contactus',obj,function(data){
      console.log(data);
      if(data.status>0){
        $('#your-name,#email,#your-message').val('');
        cla = 'success';
        txt = '留言完成~';
      } else {
        cla = 'success';
        txt = '錯誤!請稍後在試';
      }
      $('#contact-form').after('<div class="alert alert-'+cla+' alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+txt+'</strong></div>');
    },'json');
    return false;
  });
})();



// counter
(function ($) {

    // Countdown
    if ($('#countdown').length) { 
        $('#countdown').countdown({
            render: function(data) {
                if (data.years >= 1) {
                    var $days = (data.years*365)+data.days;
                } else {
                    var $days = data.days;
                }
                $(this.el).html(
                    '<div class="day">' + this.leadingZeros($days) + ' <span>Days</span></div>'+
                    '<div class="hour">' + this.leadingZeros(data.hours, 2) + ' <span>Hours</span></div>'+
                    '<div class="min">' + this.leadingZeros(data.min, 2) + ' <span>Minutes</span></div>'+
                    '<div class="sec">' + this.leadingZeros(data.sec, 2) + ' <span>Seconds</span></div>'
                );
            }
        });
    }
    
})(jQuery);

