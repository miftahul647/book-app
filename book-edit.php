<?php 
require "function/init.php";

if (requestMethod()) {

  $data = validate(['nama_observer','nama_buku', 'satuan_pendidikan', 'lokasi', 'tanggal', 'narasumber']);

  if ($data) {
    $id_book = htmlspecialchars($_POST['id_book']);
    $data['updated_at'] = date("Y-m-d H:i:s");
    
    query_update('book', $data, "id_book = '$id_book'");
    setSuccess("Buku Berhasil Diupdate!");
  } else {
    setError("Nama Buku Tidak Boleh Kosong!");
  }


}

direct('book.php');

?>
