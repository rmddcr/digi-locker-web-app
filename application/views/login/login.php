<!DOCTYPE html>
<html lang="en">

<head>
<title> Digi Locker</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|PT+Sans|Roboto|Roboto+Slab|Titillium+Web" rel="stylesheet">
<style class="cp-pen-styles">* { box-sizing:border-box; }

body {
  font-family: 'PT Sans', sans-serif;
/*font-family: 'Open Sans', sans-serif;
font-family: 'Lato', sans-serif;
font-family: 'PT Sans', sans-serif;
font-family: 'Roboto Slab', serif;
font-family: 'Titillium Web', sans-serif;*/ 
  background: #ebebeb;
  -webkit-font-smoothing: antialiased;
}

hgroup {   text-align:center;  margin-top: 3em;  opacity: 0.7;  padding: 30px;  background: #3F51B5;}
h1, h3 { font-weight: 300; }
h1 { color: #fff; }
form {      padding: 30px;    padding-top: 60px;    background: #fff;}
.powered{    padding: 10px;    margin-top: -16px;    line-height: 25px;    background: #737fc5;}
.powered a {    color: #ddd;    text-decoration: none;}
.powered a:hover {  font-style:italic;}
.group {   position: relative;  margin-bottom: 45px; }

input {  font-size: 18px;  padding: 10px 10px 10px 5px;  -webkit-appearance: none;  display: block;  background: transparent;  color: #03a9f4;  width: 100%;  border: none;  border-radius: 0;  border-bottom: 1px solid #ddd;}

input:focus { outline: none; }

/* Label */
label {  color: #999;   font-size: 18px;  font-weight: normal;  position: absolute;  pointer-events: none;  left: 5px;  top: 10px;  -webkit-transition:all 0.2s ease;  transition: all 0.2s ease;}

/* active */

input:focus ~ label, input.used ~ label {  top: -20px;  -webkit-transform: scale(.75);          transform: scale(.75); left: -2px;  color: #4a89dc;}

/* Underline */
.bar {  position: relative;  display: block;  width: 100%;}
.bar:before, .bar:after {  content: '';  height: 2px;   width: 0;  bottom: 1px;   position: absolute;  background: #4a89dc;   -webkit-transition:all 0.2s ease;   transition: all 0.2s ease;}
.bar:before { left: 50%; }
.bar:after { right: 50%; }

/* active */
input:focus ~ .bar:before, input:focus ~ .bar:after { width: 50%; }

/* Highlight */
.highlight {  position: absolute;  height: 60%;   width: 100px;   top: 25%;   left: 0;  pointer-events: none;  opacity: 0.5;}

/* active */
input:focus ~ .highlight {  -webkit-animation: inputHighlighter 0.3s ease;          animation: inputHighlighter 0.3s ease;}

/* Animations */
@-webkit-keyframes inputHighlighter {
  from { background: #4a89dc; }
  to  { width: 0; background: transparent; }
}

@keyframes inputHighlighter {
  from { background: #4a89dc; }
  to  { width: 0; background: transparent; }
}

div.background{  position: fixed;    width: 100%;    z-index: -1;    height: 100%;    right: -10%;}
div.background2 {  position: fixed;    width: 100%;    z-index: -1;    height: 100%;    left: 6%;}
div.background:before {    content: '';    position: absolute;    top: 0;    right: 0;    width: 80%;    height: 70%;    /* opacity: 0.8; */    background-color: #03A9F4;    border-bottom: 30px solid #2196F3;    -webkit-transform-origin: 100% 100%;    -ms-transform-origin: 100% 100%;    transform-origin: 100% 100%;    -webkit-transform: skewX(30deg);    -ms-transform: skewX(30deg);    transform: skewY(30deg);    -webkit-box-sizing: border-box;    -moz-box-sizing: border-box;    box-shadow: 0px 0px 20px #89898a;}
div.background2:before {    content: '';    position: absolute;    bottom: 0;    left: 0;    width: 50%;    height: 100%;     background-color: #03A9F4;    border-right: 50px solid #2196F3;    -webkit-transform-origin: 100% 100%;    -ms-transform-origin: 100% 100%;    transform-origin: 100% 100%;    -webkit-transform: skewX(60deg);    -ms-transform: skewX(60deg);        transform: skewX(60deg);    -webkit-box-sizing: border-box;    -moz-box-sizing: border-box;    box-shadow: 0px 0px 20px #89898a;}
html, body{   background-size:cover;    margin:0;padding:0;    height:100%;}
.buttonui {   position: relative;    padding: 8px 45px;    line-height: 30px;    overflow: hidden;    border-width: 0;    outline: none;    border-radius: 2px;    box-shadow: 0 1px 4px rgba(0, 0, 0, .6);    background-color: #03a9f4;    color: #ecf0f1;    transition: background-color .3s;}
.buttonui:before {    content: "";    position: absolute;    top: 50%;    left: 50%;    display: block;    width: 0;    padding-top: 0;    border-radius: 100%;    background-color: rgba(236, 240, 241, .3);    -webkit-transform: translate(-50%, -50%);    -moz-transform: translate(-50%, -50%);    -ms-transform: translate(-50%, -50%);    -o-transform: translate(-50%, -50%);    transform: translate(-50%, -50%);}
.buttonui span  {    padding: 12px 24px;    font-size:16px;}
.loginForm {   width: 420px;    margin: 0 auto;    z-index: 99;    display: block;    margin-top: 5%;    background: transparent;    border-radius: .25em .25em .4em .4em;    text-align: center;    box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);    color: #fff;}
/* Ripples container */

.ripples {  position: absolute;  top: 0;  left: 0;  width: 100%;  height: 100%;  overflow: hidden;  background: transparent;}
.ripplesCircle {  position: absolute;  top: 50%;  left: 50%;  -webkit-transform: translate(-50%, -50%);          transform: translate(-50%, -50%);  opacity: 0;  width: 0;  height: 0;  border-radius: 50%;  background: rgba(255, 255, 255, 0.25);}
.ripples.is-active .ripplesCircle {  -webkit-animation: ripples .4s ease-in;          animation: ripples .4s ease-in;}

/* Ripples animation */
@-webkit-keyframes ripples {
  0% { opacity: 0; }

  25% { opacity: 1; }

  100% {
    width: 200%;
    padding-bottom: 200%;
    opacity: 0;
  }
}

@keyframes ripples {
  0% { opacity: 0; }

  25% { opacity: 1; }

  100% {
    width: 200%;
    padding-bottom: 200%;
    opacity: 0;
  }
}
form, .powered { opacity: 0.8; }
@media screen and (max-width: 860px){
	div.background{ margin-top: -10%; }
}
@media screen and (max-width: 560px){
	div.background{ margin-top: -50%; }
}
@media screen and (max-width: 460px){
	.loginForm{ width: 100%; max-width: 420px; }
	div.background{ margin-top: -60%; }
	div.background2{ margin-top: -10%; }
	div.background2:before{ width: 80%; }
	form, .powered { opacity: 0.8; }
}
@media screen and (max-width: 380px){
	div.background{ margin-top: -80%; }
	div.background2{ margin-top: -10%; }
	div.background2:before{ width: 100%; }
}
span.password-link{
  text-align: left;
}
</style></head><body>
  <div class="background"></div>
  <div class="background2"></div>
    <div class="loginForm"> 
    <hgroup>
      <h1>Login</h1>
    </hgroup>
    <form>
      <div class="group">
        <input type="email" class="used"><span class="highlight"></span><span class="bar"></span>
        <label>Username</label>
      </div>
      <div class="group">
        <input type="password"><span class="highlight"></span><span class="bar"></span>
        <br>
        <label>Password</label>
        <a href="">
          <span class="password-link">Haven't registered yet?</span>
        </a>
      </div>
      <div>

      </div>
      <button type="button" class="buttonui "> <span> Sign In </span>
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
          </button>        
    </form>
    <div class="powered">
          Powered by <a href=""> Unicorn </a>
      </div>
  </div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>$(window, document, undefined).ready(function() {

  $('input').blur(function() {
    var $this = $(this);
    if ($this.val())
      $this.addClass('used');
    else
      $this.removeClass('used');
  });

  var $ripples = $('.ripples');

  $ripples.on('click.Ripples', function(e) {

    var $this = $(this);
    var $offset = $this.parent().offset();
    var $circle = $this.find('.ripplesCircle');

    var x = e.pageX - $offset.left;
    var y = e.pageY - $offset.top;

    $circle.css({
      top: y + 'px',
      left: x + 'px'
    });

    $this.addClass('is-active');

  });

  $ripples.on('animationend webkitAnimationEnd mozAnimationEnd oanimationend MSAnimationEnd', function(e) {
    $(this).removeClass('is-active');
  });

});

</script>
</body></html>