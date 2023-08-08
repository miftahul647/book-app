<?php 
require "function/init.php";

$id_variabel = get('id_variabel');
$id_pertanyaan = get('id');

if (!$id_variabel) {

  direct('index.php');
  
}

$pertanyaan = query_select('pertanyaan_monev', ['where' => "id_pertanyaan = '$id_pertanyaan'"])[0];

if (requestMethod() == "POST") {

  $data = validate(['pertanyaan']);

  if ($data) {

    $data['type'] = htmlspecialchars($_POST['type']);
    $data['updated_at'] = date("Y-m-d H:i:s");

    query_update('pertanyaan_monev', $data, "id_pertanyaan = '$id_pertanyaan'");

    setSuccess("Pertanyaan Monev Berhasil Diupdate!");

    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    

    if ($pertanyaan['type'] != $data['type']) {

      // Dari textarea ke checkbox
      if ($data['type'] == "Checkbox") {

        query_delete('hasil_monev', "id_pertanyaan = '$id_pertanyaan'");
        $hasilMonev = [
          'id_pertanyaan' => $id_pertanyaan,
          'created_at' => $created_at,
          'updated_at' => $updated_at,
        ];

        $numberCb = 1;

        while (isset( $_POST["cb_" . $numberCb] )) {

          $hasilMonev['label'] = $_POST["cb_" . $numberCb];

          $numberCb++;

          if ($numberCb > 100) {
            break;
          }

          query_insert('hasil_monev', $hasilMonev);

        }


      }

      // Dari Checkbox ke textarea
      else if ($data['type'] == "Textarea") {

        query_delete('hasil_monev', "id_pertanyaan = '$id_pertanyaan'");
        $hasilMonev = [
          'id_pertanyaan' => $id_pertanyaan,
          'created_at' => $created_at,
          'updated_at' => $updated_at,
        ];
        echo "Textarea";
      }

    } 

    if ($pertanyaan['type'] == "Checkbox") {
      
      query_delete('hasil_monev', "id_pertanyaan = '$id_pertanyaan'");
        $hasilMonev = [
          'id_pertanyaan' => $id_pertanyaan,
          'created_at' => $created_at,
          'updated_at' => $updated_at,
        ];

        $numberCb = 1;

        while (isset( $_POST["cb_" . $numberCb] )) {

          $hasilMonev['label'] = $_POST["cb_" . $numberCb];

          $numberCb++;

          if ($numberCb > 100) {
            break;
          }

          query_insert('hasil_monev', $hasilMonev);

        }

    }

    direct("monev.php?id_variabel=$id_variabel");

    die;
  } else {
    setError("Pertanyaan Tidak Boleh Kosong!");
  }

}

// echo "<pre>";
$hasilMonev = query_select('hasil_monev', ['where' => "id_pertanyaan = '$id_pertanyaan'"]);
// var_dump($hasilMonev);
// die;

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

          <h5 class="mb-4">Ubah Pertanyaan Monev</h5>

          <?php if (hasSuccess() || hasError()): ?>
          <div class="alert <?= hasSuccess() ? "alert-success" : "alert-danger" ?>">
            <?= hasSuccess() ? success() : error() ?>
          </div>
        <?php endif ?>

        <hr class="mt-4 mb-4">

        <form action="" method="POST">


          <div class="mb-3">
            <label for="buku" class="form-label">Pertanyaan Monev</label>
            <textarea name="pertanyaan" id="" cols="30" rows="10" class="form-control"><?= $pertanyaan['pertanyaan'] ?></textarea>
          </div>

          <div class="mb-3">
            <label for="buku" class="form-label">Tipe Hasil Monev</label>
            <select name="type" id="" class="form-control" onchange="selectHasil(this)">
              <option value="Textarea" <?= $pertanyaan['type'] == "Textarea" ? "selected" : "" ?> >Textarea</option>
              <option value="Checkbox" <?= $pertanyaan['type'] == "Checkbox" ? "selected" : "" ?> >Checkbox</option>
            </select>
          </div>

          <p class=" <?= $pertanyaan['type'] == "Textarea" ? "d-none" : "" ?> text-cb">List Checkbox</p>
          <div class="cb <?= $pertanyaan['type'] == "Textarea" ? "d-none" : "" ?> ">
            <ul>

              <?php $noCB = 1; ?>
              <?php foreach ($hasilMonev as $item): ?>

                <li class="d-flex gap-2 pb-3"><input type="checkbox"><input class="form-control" type="text" name="cb_<?= $noCB++ ?>" value="<?= $item['label'] ?>"><button class="btn btn-danger btn-sm" onclick="removeCB(this)">x</button></li>
              <?php endforeach ?>

            </ul>
          </div>

          <button type="button" class="btn btn-info btn-add <?= $pertanyaan['type'] == "Textarea" ? "d-none" : "" ?> " onclick="createLI()">Tambah Checkbox</button>

          <a href="monev.php?id_variabel=<?= $id_variabel ?>" class="btn btn-secondary">Kembali</a>
          <button class="btn btn-primary" type="submit">Simpan</button>

        </form>


      </div>
    </div>
  </div>

  <script>

    const textCB = q('.text-cb');
    const listCB = q('.cb');
    const ul = q('.cb ul');
    const btnAdd = q('.btn-add');

    const createLI = () => {

      let li = document.createElement('li');
      li.setAttribute('class', 'd-flex gap-2 pb-3');
      let checkbox = document.createElement('input');
      checkbox.setAttribute('type', 'checkbox');

      li.append(checkbox);

      let checkbox2 = document.createElement('input');
      checkbox2.classList.add('form-control');
      checkbox2.setAttribute('type', 'text');

      li.append(checkbox2);

      let button = document.createElement('button');
      button.setAttribute('class', 'btn btn-danger btn-sm');
      button.setAttribute('onclick', 'removeCB(this)');
      button.innerHTML = 'x';

      li.append(button);

      ul.append(li);

      sortNameLI();
    }

    const removeCB = e => {

      e.parentElement.remove();
      sortNameLI();

    }

    const sortNameLI = () => {
      let allLi = qAll('.cb ul li input[type=text]');
      let no = 1;

      allLi.forEach(e => { 
        e.name = 'cb_' + no;
        no++;
      });
    }

    const selectHasil = e => {

      let val = e.value;

      if (val == "Checkbox") {

        textCB.classList.remove('d-none');
        listCB.classList.remove('d-none');
        btnAdd.classList.remove('d-none');

        createLI();

      } else {

        textCB.classList.add('d-none');
        listCB.classList.add('d-none');
        btnAdd.classList.add('d-none');

        ul.innerHTML = '';

      }

    }
  </script>

  <script src="assets/js/bootstrap.js"></script>
</body>

</html>
