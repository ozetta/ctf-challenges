<?php
	if($_SERVER['REMOTE_ADDR']===$_SERVER['SERVER_ADDR']){
		if(isset($_GET["url"])){
			setcookie("flag", "flag{some_string}", time()+60);
			header("Location: ".urldecode($_GET["url"]));
		}else{
			die("wtf");
		}
	}else{
		header("HTTP/1.0 404 Not Found");
	}