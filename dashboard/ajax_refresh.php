<?php
// PDO connect *********
include("../setting/koneksi.php");

$keyword = '%'.$_POST['keyword'].'%';
$sql = "SELECT * FROM pelanggan WHERE idpel LIKE (:keyword) OR nm_pel LIKE (:keyword) ORDER BY idpel ASC LIMIT 0, 10";
$query = $conn->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$list = $query->fetchAll();
foreach ($list as $rs) {
	// put in bold the written text
	$country_name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['idpel'].'-'.$rs['nm_pel']);
	// add new option
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['idpel']).'\')">'.$country_name.'</li>';
}
?>