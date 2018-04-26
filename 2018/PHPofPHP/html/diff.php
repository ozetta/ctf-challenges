<?php
set_time_limit(3);
@$data = json_decode(file_get_contents('php://input'), true);
if(isset($data["version"])){
  $v = $data["version"];
  if(strlen($v) >= 15){exit("Input too long!");}
  if(preg_match('/[^a-zA-Z0-9\/\?\*\t\n]/',$v)){exit("Special character found in input!");}
  if(preg_match('/ls|cat|tac|nl|more|less|head|tail|od|strings|base64|sort|pg|uniq|rev/',$v)){exit("Blacklisted command found in input!");}
  chdir("web-php");
  @system("diff current/index $v");
}
?>