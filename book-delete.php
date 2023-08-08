<?php 
require "function/init.php";

if (requestMethod()) {

  $id_book = htmlspecialchars($_POST['id_book']);

    query_delete('book', "id_book = '$id_book'");
    setSuccess("Buku Berhasil Dihapus!");

}

direct('book.php');

?>
