<?=!session_start();$f=&$_FILES;$a='form';$s=&$_SESSION;$t='tmp';$l='location';$o=" onchange=this.$a.submit() ";$v='<option value=';$e='name';$r="<$a method=post";isset($_POST[$t])?$s[$t]=$_POST[$t]:1;isset($s[$t])?include($s[$t].'.inc.php'):die($s[$t]=$t.header("$l:."));if(isset($f[4])&&$f[4]['size']<4**8){$d="./$t/".md5(session_id());@mkdir($d);$b="$d/".pathinfo($f[4][$e],8);file_put_contents($b,preg_replace('/[^acgt]/is','',file_get_contents($f[4][$t."_$e"])));echo"<script>$l='$b'</script>";}echo"$r enctype=multipart/$a-data><input type=file$o$e=4></$a>$r><select$o$e=$t>$v$t>== Template ==$v$t>Default$v$a>Boxes$v$l>Motion$v$e>Shredder";