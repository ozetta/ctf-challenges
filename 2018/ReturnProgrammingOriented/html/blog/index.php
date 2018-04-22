<?php
$nonce = bin2hex(random_bytes(16));
header("Content-Security-Policy: default-src 'none'; img-src data: *; style-src 'self' 'unsafe-inline'; script-src 'self' 'nonce-$nonce';");
error_reporting(0);

$header = '<html><head><title>Someone\'s Blog</title><link rel="stylesheet" href="style.css" /><script nonce=\''.$nonce.'\'>var link=document.createElement(\'link\');link.rel=\'import\';link.href=\'../ads.html\';link.onload=function(e){document.querySelector(\'#ads\').appendChild(this.import.querySelector(\'body\'))};document.head.appendChild(link);</script>';
$footer = '<div style="position:fixed;top:10px;right:10px;"><b style="color:red">Advertisment</b><a href="#" style="float:right;color:0;text-decoration:none">&cross;</a><div id="ads"></div></div></body></html>';

if(isset($_GET['ln'])){
  if(strlen($_GET['ln']) > 128){
    echo $header.'<h1>Link too long</h1><p>The link is too long. Maybe you should copy and paste from the URL.</p>'.$footer;
  }else if(strpos($_GET['ln'],'//') !== false){
    echo $header.'<h1>External link alert</h1><p>The following link: '.htmlentities($_GET['ln']).' seems dangerous.</p><p>Copy and paste it yourself to access it</p>'.$footer;
  }else{
    header('Location:'.$_GET['ln']);
  }
  exit();
}

switch($_GET['id']){
  case "style.css":
    exit("body{font-family:'Impact';background:#bedead}");
    break;
  case "":
    echo $header.'<h1>My blog posts</h1><ol><li><a href="my-php-key">My PHP Keys</a></li><li><a href="my-friends-website">My friend\'s website</a></li><li><a href="my-online-riddle">My online riddle</a></li><li><a href="contact-me">Contact me</a></li><li><a href="my-first-blog-post">My first blog post</a></li></ol>'.$footer;
    break;
  case "my-first-blog-post":
    echo $header.'<h1>My first blog post</h1><p>Hello World!</p>'.$footer;
    break;
  case "contact-me":
    echo $header.'<h1>Contact me</h1><p>I have made a <a href="?ln=../contact">form</a>. Please don\'t send me virus.</p>'.$footer;
    break;
  case "my-online-riddle":
    echo $header.'<h1>My online riddle</h1><p>I\'m still developing. You can preview in <a href="?ln=../game">here</a>.</p>'.$footer;
    break;
  case "my-friends-website":
    echo $header.'<h1>My friend\'s website</h1><p>Feel free to visit it <a href="?ln=http://example.com/">here</a></p>'.$footer;
    break;
  case "my-php-key":
    echo $header.'<h1>My PHP Keys</h1><p><a href="?ln=../keystore/public.php">Public key</a></p><p><a href="?ln=../keystore/private.php">Private key</a></p>'.$footer;
    break;
  default:
    echo '<s>File not found</s>';
}
?>