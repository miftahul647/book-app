<?php 
require "../function/init.php";

$id_hasil = get('id');
$id_pertanyaan = get('id_pertanyaan');


$data = [
	'checked' => 0,
	'updated_at' => date("Y-m-d H:i:s"),
];

query_update('hasil_monev', $data, "id_pertanyaan = '$id_pertanyaan' AND checked = '1'");

query_update('hasil_monev', 
	[
		'checked' => 1,
		'updated_at' => date("Y-m-d H:i:s"),
	],
	"id_hasil = '$id_hasil'");

	?>

	1