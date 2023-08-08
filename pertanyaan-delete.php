<?php 
require "function/init.php";

$id_pertanyaan = get('id');
$id_variabel = get('id_variabel');

query_delete('pertanyaan_monev', "id_pertanyaan = '$id_pertanyaan'");
query_delete('hasil_monev', "id_pertanyaan = '$id_pertanyaan'");
query_delete('bukti', "id_pertanyaan = '$id_pertanyaan'");

setSuccess('Pertanyaan Berhasil Dihapus!');

direct("monev.php?id_variabel=$id_variabel");