<?php 
require "function/init.php";

$id_variabel = get('id_variabel');
$id_bukti = get('id');

$data = query_select('bukti', ['where' => "id_bukti = '$id_bukti'"])[0];

$filename = $data['file'];

File::delete("upload/$filename");
query_delete('bukti', "id_bukti = '$id_bukti'");

setSuccess('File Berhasil Dihapus!');

direct('monev.php?id_variabel=' . $id_variabel);