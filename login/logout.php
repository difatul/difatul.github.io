<?php
session_start();
$_SESSION['username']='';
$_SESSION['level']='';
$_SESSION['masuk']=0;
session_unset();
session_destroy();
?>
<script language="javascript">
location.href="../";
</script>