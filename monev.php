<?php 
require "function/init.php";

$id_variabel = get('id_variabel');

if (!$id_variabel) {
  direct('index.php');
}

$variabel = query_select('variabel', ['where' => "id_variabel = '$id_variabel'"])[0];
$id_book = $variabel['id_book'];

$lembar = query_select('book', ['where' => "id_book = '$id_book'"])[0];

$pertanyaan = query_select('pertanyaan_monev', ['where' => "id_variabel = '$id_variabel'"]);

$hasilMonev = arrayWhere('hasil_monev', "id_pertanyaan");

$fileBukti = arrayWhere('bukti', "id_pertanyaan");

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
              <tr>
                <td>Variabel</td>
                <td>:</td>
                <td><?= $variabel['nama_variabel']  ?></td>
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
        <a href="index.php?id=<?= $id_book ?>" class="btn btn-secondary btn-sm mt-4">Kembali</a>
        <a href="pertanyaan-add.php?id_variabel=<?= $id_variabel ?>" class="btn btn-primary btn-sm mt-4">Tambah Pertanyaan</a>
        <table class="table mt-4">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Pertanyaan Monev</th>
              <th scope="col">Hasil Monev</th>
              <th scope="col">Upload Bukti</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody class="data">
            <?php 
            $no = 1;
            foreach ($pertanyaan as $item): ?>
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?= $item['pertanyaan'] ?></td>
                <td>
                  <?php if ($item['type'] == "Textarea"): ?>
                    <textarea name="" onchange="handleSimpanTextarea(<?= $hasilMonev[$item['id_pertanyaan']][0]['id_hasil'] ?>, this)" class="form-control" id="" cols="30" rows="10"><?= $hasilMonev[$item['id_pertanyaan']][0]['jawaban'] ?></textarea>
                  <?php elseif($item['type'] == "Checkbox"): ?>
                    <?php foreach ($hasilMonev[$item['id_pertanyaan']] as $cb): ?>
                      <ul style="list-style: none;" class="ps-0">
                        <li>
                          <input onchange="handleSelectCheckbox(<?= $cb['id_hasil'] ?>, <?= $item['id_pertanyaan'] ?>)" type="radio" id="<?= $cb['id_hasil'] ?>" name="cb_<?= $item['id_pertanyaan'] ?>" <?= $cb['checked'] == 1 ? "checked" : '' ?> >
                          <label for="<?= $cb['id_hasil'] ?>"><?= $cb['label'] ?></label>
                        </li>
                      </ul>
                    <?php endforeach ?>
                  <?php endif ?>
                </td>
                <td>
                  <?php if (isset($fileBukti[ $item['id_pertanyaan'] ])): ?>
                    <a href="upload/<?= $fileBukti[$item['id_pertanyaan']][0]['file'] ?>" class="btn badge btn-sm btn-primary me-2">Lihat File</a>
                    <a href="file-delete.php?id_variabel=<?= $id_variabel ?>&id=<?= $fileBukti[$item['id_pertanyaan']][0]['id_bukti'] ?>" class="btn badge btn-sm btn-danger" onclick="return confirm('Apakah Anda Yakin Menghapus File')">Hapus File</a>
                  <?php else: ?>
                    <button class="btn btn-light btn-sm" onclick="setID(<?= $item['id_pertanyaan'] ?>)" data-bs-toggle="modal" data-bs-target="#upload">Upload</button>
                  <?php endif ?>
                </td>
                <td>
                  <a href="pertanyaan-edit.php?id=<?= $item['id_pertanyaan'] ?>&id_variabel=<?= $item['id_variabel'] ?>" class="btn btn-sm btn-secondary">Edit</a>
                  <a href="pertanyaan-delete.php?id=<?= $item['id_pertanyaan'] ?>&id_variabel=<?= $item['id_variabel'] ?>" onclick="return confirm('Apakah Anda Yakin Menghapus?')" class="btn btn-sm btn-danger">Hapus</a>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<form action="upload-bukti.php?id_variabel=<?= $id_variabel ?>" method="POST" enctype="multipart/form-data">
  <div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content ">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Bukti</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="handleClose(this)"></button>
        </div>
        <div class="modal-body">
        <div class="mb-3">
          <label for="buku" class="form-label">File</label>
          <input type="file" class="form-control" name="file">
        </div>
        <input type="hidden" name="id_pertanyaan">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="handleClose(this)">Batal</button>
        <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Upload</button>
      </div>
    </div>
  </div>
</div>
</form>
  <script>
    const handleSimpanTextarea = (id, e) => {
      let val = e.value;
      fetch('api/saveTextarea.php?id=' + id + '&jawaban=' + val);
    }
    const handleSelectCheckbox = (id, id_pertanyaan) => {
      fetch('api/saveCheckbox.php?id=' + id + '&id_pertanyaan=' + id_pertanyaan);
    }
    const setID = id => {
      q('#upload input[name=id_pertanyaan]').value = id;
    }
  </script>
  <script src="assets/js/bootstrap.js"></script>
</body>

</html>
