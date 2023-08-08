<?php 
require "function/init.php";

$id_variabel = get('id_variabel');

if ( File::has('file') ) {
  
  $filename = File::randomName() . File::getExt('file');

  $data = [];
  $data['file'] = $filename;
  $data['id_pertanyaan'] = $_POST['id_pertanyaan'];
  $data['created_at'] = date("Y-m-d H:i:s");
  $data['updated_at'] = date("Y-m-d H:i:s");

  query_insert('bukti', $data);
  File::save($_FILES, "upload/$filename");

  setSuccess('File Berhasil Diupload!');

} else {
  setError("File Tidak Boleh Kosong!");
}


direct('monev.php?id_variabel=' . $id_variabel);