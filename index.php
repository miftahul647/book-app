<?php 
require "function/init.php";

$data = query_select('book');

// if (!get('id')) {
//   // code...
//   direct("index.php?id=" . $data[0]['id_book']);
//   die;
// }

$id_book = get('id') ? get('id') : $data[0]['id_book'] ;

$lembar = query_select('book', ['where' => "id_book = '$id_book'"])[0];

?>
<!doctype html>
  <html lang="en">
  
  <?php partials('head.php') ?>
  
  <body>
    <style>
      table.biodata td {
        padding: 4px;
        padding-right: 10px;
      }
    </style>

    <?php partials('navbar.php') ?>

    <div class="container-fluid mt-5 pt-5">
      <div class="card shadow border-0">
        <div class="card-body p-4">
          <h5 class="mb-4">Kertas Kerja Monev IEP</h5>
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
        <label for="" class="form-label">Pilih Lembar</label>
        <select class="form-select mb-4" aria-label="Default select example" onchange="handleSelectLembar(this)">
          <?php foreach ($data as $item): ?>
            <option value="<?= $item['id_book'] ?>" <?= $item['id_book'] == $id_book ? "selected" : "" ?> > <?= $item['nama_buku'] ?> </option>
          <?php endforeach ?>
        </select>
        <hr class="mt-4 mb-4">
        <div class="row">
          <div class="col-md-6">
            <table border="0" class="biodata">
              <tr>
                <td>Nama Observer</td>
                <td>:</td>
                <td><?= $lembar['nama_observer']  ?></td>
              </tr>
              <tr>
                <td>Nama Satuan Pendidikan</td>
                <td>:</td>
                <td><?= $lembar['satuan_pendidikan']  ?></td>
              </tr>
              <tr>
                <td>Lokasi Satuan Pendidikan</td>
                <td>:</td>
                <td><?= $lembar['lokasi']  ?></td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <table border="0" class="biodata">
              <tr>
                <td>Tanggal Observasi</td>
                <td>:</td>
                <td><?= dateToString( $lembar['tanggal'] ) ?></td>
              </tr>
              <tr>
                <td>Narasumber</td>
                <td>:</td>
                <td><?= $lembar['narasumber']  ?></td>
              </tr>
            </table>
          </div>
        </div>
        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Variabel</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody class="data">
            <tr>
              <td></td>
              <td colspan="5">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahVariabel">+</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php include "partials/modal-tambah-variabel.php" ?>
  <?php include "partials/modal-edit-variabel.php" ?>
  <?php include "partials/modal-hapus-variabel.php" ?>

  <div class="modal fade" id="addPertanyaan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pertanyaan Monev</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="handleClose(this)"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
          <label for="buku" class="form-label">Pertanyaan Moven</label>
          <textarea name="pertanyaan" id="" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="mb-3">
          <label for="buku" class="form-label">Tipe Hasil Monev</label>
          <select name="type" id="" class="form-control">
            <option value="Textarea">Textarea</option>
            <option value="Checkbox">Checkbox</option>
          </select>
        </div>
        <input type="hidden" name="id_variabel">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="handleClose(this)">Batal</button>
        <button type="button" data-bs-dismiss="modal" onclick="handleTambahPertanyaan(this)" class="btn btn-info">Tambah</button>
      </div>
    </div>
  </div>
</div>

<script>

  const IDBOOK = <?= $id_book ?>;

  const handleSelectLembar = (e) => {

    const val = e.value;
    location.replace(`index.php?id=${val}`);

  }

  const insertTableBody = html => {

    q('tbody.data').innerHTML = html;

  }

  const loadData = () => {

    console.log('Data Diload!');
    fetch(`api/load.php?id=${IDBOOK}`)
    .then(res => res.text())
    .then(data => {

      insertTableBody(data);

    })

  }

  const handleClose = modal => {

    const form = modal.parentElement.parentElement;
    const Allinput = form.querySelectorAll('input');

    Allinput.forEach(e => e.value = '');
  }

  <?php require "assets/js/variabel.js"; ?>

  // Monev Fun

  const setIDVariabelMonev = (id, modal) => {
    q(modal + " input[name=id_variabel]").value = id;
  }

  const handleTambahPertanyaan = e => {

    const pertanyaan = q('#addPertanyaan textarea[name=pertanyaan]').value;
    const type = q('#addPertanyaan select[name=type]').value;
    const id_variabel = q('#addPertanyaan input[name=id_variabel]').value;

    fetch(`api/addPertanyaan.php?pertanyaan=${pertanyaan}&id_variabel=${id_variabel}&type=${type}`)
    .then(res => res.text())
    .then(data => {

      q('#addPertanyaan textarea[name=pertanyaan]').value = '';
      q('#addPertanyaan select[name=type]').value = ''

      loadData();
      alert('Pertanyaan Berhasil Berhasil Ditambah!');

    });

  }



  loadData();


</script>

<script src="assets/js/bootstrap.js"></script>
</body>

</html>
