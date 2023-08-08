<?php 
require "../function/init.php";

$nama = get('nama');
$id_variabel = get('id_variabel');


$data = [
	'nama_variabel' => $nama,
	'updated_at' => date("Y-m-d H:i:s"),
];

query_update('variabel', $data, "id_variabel = '$id_variabel'");

?>
1