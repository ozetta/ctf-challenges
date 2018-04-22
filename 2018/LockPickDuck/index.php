<?php 
  if(isset($_GET["username"]) && isset($_GET["password"])){ 
    require('flag.php'); 
    $flag = 0; 
    $random = []; 
    for($i=0;$i<16;$i++) $random[] = strtr(base64_encode(openssl_random_pseudo_bytes(48)),"+/","-_"); 
    $csvdb = ""; 
    for($i=0;$i<8;$i++) $csvdb .= $random[$i*2].",".$random[$i*2+1]."\n"; 
    $sqldb = new SQLite3(":memory:"); 
    $sqldb->exec("CREATE TABLE users (username text, password text)"); 
    for($i=0;$i<8;$i++) $sqldb->exec("INSERT INTO users VALUES ('".$random[$i*2]."', '".$random[$i*2+1]."')"); 
    $xmldb = new SimpleXMLElement("<users/>"); 
    for($i=0;$i<8;$i++){ 
      $xmluser = $xmldb->addChild('user'); 
      $xmluser->addChild('username',$random[$i*2]); 
      $xmluser->addChild('password',$random[$i*2+1]); 
    } 
    $U = $_GET["username"]; 
    $P = $_GET["password"]; 
    if(@preg_match("/^$U,$P$/m", $csvdb)){$flag++;echo "csvdb1\n";} 
    if(@$sqldb->querySingle("SELECT username FROM users WHERE username='$U' AND password='$P'") != FALSE){$flag++;echo "sqldb1\n";} 
    if(@$xmldb->xpath("//users/user[username='$U' and password='$P']") != FALSE){$flag++;echo "xmldb1\n";} 
    preg_match("/^$U,($P)$/m", $csvdb, $csvpass); 
    if(@$csvpass[1]===$P){$flag++;echo "csvdb2\n";} 
    $sqlpass = @$sqldb->querySingle("SELECT password FROM users WHERE username='$U' AND password='$P'"); 
    if($sqlpass===$P){$flag++;echo "sqldb2\n";} 
    $xmlpass = print_r(@$xmldb->xpath("//users/user[username='$U' and password='$P']/password"), TRUE); 
    if(@strpos($xmlpass, $P) !== FALSE){$flag++;echo "xmldb2\n";} 
    if($flag >= 3) printf("Flag 1: %s\n", $flag1); 
    if($flag == 6) printf("Flag 2: %s\n", $flag2); 
  }else{ 
    highlight_file(__FILE__); 
  } 
?>