<?php 
require "../function/init.php";

$data = [
	'pertanyaan' => get('pertanyaan'),
	'type' => get('type'),
	'id_variabel' => get('id_variabel'),
	'created_at' => date("Y-m-d H:i:s"),
	'updated_at' => date("Y-m-d H:i:s"),
];

query_insert('pertanyaan_monev', $data);

 ?>