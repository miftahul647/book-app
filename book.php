<?php 
require "function/init.php";

if (isset($_POST['tambah'])) {

  $data = validate(['nama_buku']);

  if ($data) {
    $data['tanggal'] = date("Y-m-d");
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

          <h5 class="mb-4">Daftar Book</h5>

          <a href="book-add.php" class="btn btn-primary mb-4">Tambah</a>

          <?php if (hasSuccess() || hasError()): ?>
          <div class="alert <?= hasSuccess() ? "alert-success" : "alert-danger" ?>">
            <?= hasSuccess() ? success() : error() ?>
          </div>
          <script>
            setTimeout(() => {
              document.querySelector('.alert').remove();
            }, 4000)
          </script>
        <?php endif ?>

        <div class="row">

          <div class="col-md-12">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Book</th>
                  <th scope="col">Nama Observer</th>
                  <th scope="col">Nama Satuan Pendidikan</th>
                  <th scope="col">Lokasi Satuan Pendidikan</th>
                  <th scope="col">Tanggal Observasi</th>
                  <th scope="col">Narasumber</th>
                  <th scope="col">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach ($data as $item): ?>

                  <tr>
                    <th scope="row"><?= $no++ ?></th>
                    <td><?= $item['nama_buku'] ?></td>
                    <td><?= $item['nama_observer'] ?></td>
                    <td><?= $item['satuan_pendidikan'] ?></td>
                    <td><?= $item['lokasi'] ?></td>
                    <td><?= dateToString( $item['tanggal'] ) ?></td>
                    <td><?= $item['narasumber'] ?></td>
                    <td>

                      <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit" onclick="handleEditModal(<?= $item['id_book'] ?>, '<?= $item['nama_observer'] ?>', '<?= $item['nama_buku'] ?>', '<?= $item['satuan_pendidikan'] ?>', '<?= $item['lokasi'] ?>', '<?= $item['tanggal'] ?>', '<?= $item['narasumber'] ?>')">
                        Edit
                      </button>


                      <?php if (count($data) > 1): ?>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus" onclick="handleHapusModal(<?= $item['id_book'] ?>)">
                          Hapus
                        </button>
                      <?php endif ?>
                    </td>
                  </tr>

                <?php endforeach ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="book-edit.php" method="POST">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="handleClose(this)"></button>
          </div>
          <div class="modal-body">

            <input type="hidden" name="id_book">

            <div class="mb-3">
              <label for="buku" class="form-label">Nama Buku</label>
              <input type="text" class="form-control" id="buku" name="nama_buku">
            </div>

            <div class="mb-3">
              <label for="observer" class="form-label">Nama Observer</label>
              <input type="text" class="form-control" id="observer" name="nama_observer">
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

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="handleClose(this)">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="book-delete.php" method="POST">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Buku</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="handleClose(this)"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_book">
            <center>
              <h5>Apakah Anda Yakin Menghapus Buku?</h5>
            </center>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="handleClose(this)">Batal</button>
            <button type="submit" class="btn btn-danger">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <script>
    const handleEditModal = (id, observer, nama, satuan, lokasi, tanggal, narasumber) => {

      q('#modalEdit input[name=id_book]').value = id;
      q('#modalEdit input[name=nama_observer]').value = observer;
      q('#modalEdit input[name=nama_buku]').value = nama;
      q('#modalEdit input[name=satuan_pendidikan]').value = satuan;
      q('#modalEdit input[name=lokasi]').value = lokasi;
      q('#modalEdit input[name=tanggal]').value = tanggal;
      q('#modalEdit input[name=narasumber]').value = narasumber;

    }

    const handleHapusModal = (id) => {

      q('#modalHapus input[name=id_book]').value = id;

    }

    const handleClose = modal => {

      const form = modal.parentElement.parentElement;
      const Allinput = form.querySelectorAll('input');

      Allinput.forEach(e => e.value = '');
    }
  </script>


  <script src="assets/js/bootstrap.js"></script>
</body>

</html>
