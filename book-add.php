<?php 
require "function/init.php";
if (isset($_POST['tambah'])) {

  $data = validate(['nama_observer','nama_buku', 'satuan_pendidikan', 'lokasi', 'tanggal', 'narasumber']);

  if ($data) {
    $data['created_at'] = date("Y-m-d H:i:s");
    $data['updated_at'] = date("Y-m-d H:i:s");
    query_insert('book', $data);
    setSuccess("Buku Berhasil Ditambah!");
    direct('book.php');
  } else {
    setError("Nama Buku Tidak Boleh Kosong!");
  }

}


$data = query_select('book', ['orderby' => "id_book DESC"]);
?>
<!doctype html>
  <html lang="en">
  
  <?php partials('head.php') ?>

  <body>

    <?php partials('navbar.php') ?>

    <div class="container-fluid mt-5 pt-5">
      <div class="card shadow border-0">
        <div class="card-body">

          <h5 class="mb-4">Tambah Book Baru</h5>

          <?php if (hasSuccess() || hasError()): ?>
            <div class="alert <?= hasSuccess() ? "alert-success" : "alert-danger" ?>">
              <?= hasSuccess() ? success() : error() ?>
            </div>
          <?php endif ?>

          <div class="row">
            <div class="col-md-12 mb-4">

              <form action="" method="POST">

                <div class="mb-3">
                  <label for="buku" class="form-label">Nama Observer</label>
                  <input type="text" class="form-control" id="buku" name="nama_observer">
                </div>

                <div class="mb-3">
                  <label for="buku" class="form-label">Nama Buku</label>
                  <input type="text" class="form-control" id="buku" name="nama_buku">
                </div>

                <div class="mb-3">
                  <label for="pendidikan" class="form-label">Nama Satuan Pendidikan</label>
                  <input type="text" class="form-control" id="pendidikan" name="satuan_pendidikan">
                </div>

                <div class="mb-3">
                  <label for="lokasi" class="form-label">Lokasi</label>
                  <input type="text" class="form-control" id="lokasi" name="lokasi">
                </div>

                <div class="mb-3">
                  <label for="tanggal" class="form-label">Tanggal Observasi</label>
                  <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>

                <div class="mb-3">
                  <label for="narasumber" class="form-label">Narasumber</label>
                  <input type="text" class="form-control" id="narasumber" name="narasumber">
                </div>

                <a href="book.php" class="btn btn-secondary">Kembali</a>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Buku</button>

              </form>

            </div>

          </div>
        </div>
      </div>
    </div>

    <script src="assets/js/bootstrap.js"></script>
  </body>

  </html>
