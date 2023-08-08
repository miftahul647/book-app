<?php 
require "../function/init.php";

$id_variabel = get('id_variabel');

query_delete('variabel', "id_variabel = '$id_variabel'");

$allPertanyaan = query_select('pertanyaan_monev', ['where' => "id_variabel = '$id_variabel'"]);


foreach ($allPertanyaan as $item) {

  $id_pertanyaan = $item['id_pertanyaan'];
  query_delete('hasil_monev', "id_pertanyaan = '$id_pertanyaan'");

  $bukti = query_select('bukti', ['where' => "id_pertanyaan = '$id_pertanyaan'"]);

  foreach ($bukti as $buk) {
    $filename = $buk['file'];
    File::delete("../upload/$filename");
  }

  query_delete('bukti', "id_pertanyaan = '$id_pertanyaan'");

}

query_delete('pertanyaan_monev', "id_variabel = '$id_variabel'");
?>