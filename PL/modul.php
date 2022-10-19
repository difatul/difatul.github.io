<?php
if (isset($_GET['mod'])) {
  $mod=$_GET['mod'];
  if (file_exists($mod.".php")) {
  	include($mod.".php");
  }else{
  	include("404.php");
  }
}else{
	include("home.php");
}
?>