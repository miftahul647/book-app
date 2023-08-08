<?php 
require "../function/init.php";

$id_hasil = get('id');
$jawaban = get('jawaban');


$data = [
	'jawaban' => $jawaban,
	'updated_at' => date("Y-m-d H:i:s"),
];

query_update('hasil_monev', $data, "id_hasil = '$id_hasil'");

?>
