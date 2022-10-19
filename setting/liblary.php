<?php
# Fungsi enkripsi encoder
function enkoder($x){
	$modul = base64_encode($x);
	return $modul;
}

# Fungsi dekripsi decoder
function dekoder($y){
	$modul = base64_decode($y);
	return $modul;
}
?>