<?php
  session_start();
  $oldans = $_SESSION['ans'];
  $u = mt_rand(0,50);
  $v = mt_rand(0,50);
  $_SESSION['ans'] = $u + $v;

  if(isset($_POST["url"])){
    if($_POST['ans'] != $oldans){
      exit("Do you need a calculator to solve this simple maths?");
    }
    if(substr($_POST["url"],0,7) != "http://" && substr($_POST["url"],0,8) != "https://"){
      exit("Don't send me smb:// virus. Send me http:// or https:// links. No SSRF plz.");
    }
    $payload = escapeshellarg($_POST["url"]);
    $command = "timeout 20 google-chrome --no-sandbox --headless --disable-gpu --screenshot $payload";
    echo $command;
    chdir('/tmp');
    $h = exec($command);
    exit("<p>Thanks for the link. I should have viewed it already? </p>");
  }

?>
<h1>Contact me</h1>
<p>Give me a link and I will have a look for 20 seconds.</p>
<p>Don't keep clicking submit. It is not useful.</p>
<p>Be a good citizen. Don't spam me frequently. </p>
<form method="post">
<input name="url" placeholder="http://example.com" size="50" />
<h3>Challenge: <span id="qst"><?=strval($u);?> + <?=strval($v);?></span></h3>
<h3>Answer: <span id="ans">0</span></h3>
<p><input name="ans" type="range" value="0" min="0" max="100" step="1" onchange="document.getElementById('ans').innerText=this.value" />
</p>
<input type="submit" />
</form>