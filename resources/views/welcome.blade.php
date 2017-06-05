<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Web Design,App Design</title>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullPage.js/2.9.4/jquery.fullpage.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <link href='https://fonts.googleapis.com/css?family=Lobster|Open+Sans:400,400italic,300italic,300|Raleway:300,400,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="/css/app.css" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="google-site-verification" content="ETXKiATxE5AdvQCMbQrDR0pX7fCIClrUmS1X_IuCQRo" />
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
  <div class="section" id="secind-view">
    <div class="content">
      <div class="container wow fadeInUp delay-03s">
        <div class="row">
          <div class="logo text-center">
            <h2>We are doing something new!! Comming Soon</h2>
          </div>

          <div id="countdown" data-date="July 31, 2017 18:00:00"></div>
          <h2 class="subs-title text-center">We are welcome to write to us!!! </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="section" id="third-view">
    
<form id="contact-form">
  <p>Dear Fu,</p>
  <p>My
    <label for="your-name">name</label> is
    <input type="text" name="name" id="your-name" minlength="3" placeholder="(your name here)" required> and</p>

  <p>my
    <label for="email">email address</label> is
    <input type="email" name="email" id="email" placeholder="(your email address)" required>
  </p>

  <p> I have a
    <label for="your-message">message</label> for you,</p>

  <p>
    <textarea name="message" id="your-message" placeholder="(your msg here)" class="expanding" required></textarea>
  </p>
  <p>
    <button type="submit">
      <svg version="1.1" class="send-icn" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="36px" viewBox="0 0 100 36" enable-background="new 0 0 100 36" xml:space="preserve">
        <path d="M100,0L100,0 M23.8,7.1L100,0L40.9,36l-4.7-7.5L22,34.8l-4-11L0,30.5L16.4,8.7l5.4,15L23,7L23.8,7.1z M16.8,20.4l-1.5-4.3
    l-5.1,6.7L16.8,20.4z M34.4,25.4l-8.1-13.1L25,29.6L34.4,25.4z M35.2,13.2l8.1,13.1L70,9.9L35.2,13.2z" />
      </svg>
      <small>send</small>
    </button>
  </p>
</form>


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
<script type="text/javascript" src="/js/app.js"></script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-96209141-1', 'auto');
  ga('send', 'pageview');
</script>
</body></html>