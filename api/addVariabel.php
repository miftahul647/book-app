<?php 
require "../function/init.php";

$nama = get('nama');
$id_book = get('id');

$data = [
	'nama_variabel' => $nama,
	'id_book' => $id_book,
	'created_at' => date("Y-m-d H:i:s"),
	'updated_at' => date("Y-m-d H:i:s"),
];

query_insert('variabel', $data);

?>