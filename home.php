<?php

session_start();
if(!isset($_SESSION['name']))
{
	header("location:login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Portfolio</title>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://kit.fontawesome.com/2f57eae505.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">
	<link rel="icon" type="image/png" href="https://www.pngrepo.com/download/46690/pen.png">
	<link href="https://fonts.googleapis.com/css2?family=Alata&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Aladin&display=swap" rel="stylesheet">
</head>
<body>
	<header>
		<nav>
			<input type="checkbox" id="check">
			<label for="check" class="checkbtn">
			 <span><i class="fas fa-bars"></i></span></label>
			<ul>
			   <li><a href="#1">About</a></li>
			   <li><a href="#2">Skills</a></li>
			   <li><a href="#3">Projects</a></li>
			   <li><a href="#4">Hobbies</a></li>
			   <li><a href="#5">Contact</a></li>
		    </ul>
		</nav>
	</header>
	<section class="first">
		<div class="intro">
			Hey!&nbsp;&nbsp;This&nbsp;&nbsp;is<br><br>&nbsp;&nbsp;&nbsp;GARVIT
		</div>
	</section>
	<aside id="1">
		<h2>ABOUT...</h2>
		<div class="about">
			<img src="img/myphoto.jpg" alt="Garvit's Image" title="GARVIT">
			<div class="aboutexp"><p>Hello, My name is Garvit Bhardwaj.I have done my schooling from Kasganj.I got 95% in 10th and 94.4% in my 12th boards.I was topper of my district in 12th as well.Currently I am persuing B.Tech in Computer Science from <abbr title="Ajay Kumar Garg Engineering College">AKGEC</abbr>,Ghaziabad.I like programming and I am currently developing my skills in the field of competitive programming.I am learning frontend web development as well.</p>
		</div>
	</aside>
	<div class="skills" id="2">
		<h2>SKILLS...</h2>
		<span id="c"><img src="img/clogo.png" alt="C language logo" title="C Programming Language">
		<img src="img/c++icon.png" alt="C++ language logo" title="C++ Programming Language"></span>
		<span id="h"><img src="img/logo.png" alt="HTML5 logo" title="HTML5 Language"></span>
		<span id="p"><img src="img/cssicon.png" alt="CSS3 logo" title="CSS3">
		<img src="img/pythonlogo.png" alt="Python logo" title="Python Language"></span>
	</div>
	<div class="projects">
		<p id="3">PROJECTS</p>
		<details><summary>Numerous Games with Password Encryption</summary><p>A login panel that stores registered usernames and passwords(after encrypting them with<strong> RSA</strong> algorithm) and later use them to access those games with <strong>FILE HANDLING</strong>.The games include rock,paper and scissors,tic-tac-toe and snake game.</p></details>
		<details><summary>Portfolio website</summary><p>This website itself is my second project and first project in web development.It uses only HTML and CSS and is responsive on different screen sizes.</p>
	</div>
	<div class="hobbies" id="4">
		<p>HOBBIES...</p>
		<span id="list">
		<ul id="firstlist">
			<li><img src="img/star.gif">Singing</li>
			<li><img src="img/star.gif">Dancing</li>
			<li id="do"><img src="img/star.gif">Creative writing</li>
		</ul>
		<ul id="secondlist">
			<li><img src="img/star.gif">Sketching</li>
			<li><img src="img/star.gif">Competitive Programming</li>
			<li><img src="img/star.gif">Watching movies</li>
		</ul>
	</span>
	</div>
	<div class="contact" id="5">
		<p>Contact</p>
		<div class="logos">
		<a href="https://www.instagram.com/garvitbhrdwj/"><img src="img/instagram.png" alt="instagram logo" title="Instagam"></a>
		<a href="https://www.linkedin.com/in/garvitbhardwaj/"><img src="img/linkedin.png" alt="linkedin logo" title="Linkedin"></a>
		<a href="https://www.facebook.com/garv.bhardwaj.750/"><img src="img/facebook.png" alt="facebook logo" title="Facebook"></a>
		<a href="https://github.com/garvit-bhardwaj"><img src="img/github.png" alt="github logo" title="Github"></a>
	</div>
	</div>
	<footer>
		<button name="logout"><a href="logout.php">Log out</a></button>
	</footer>
</body>
</html>