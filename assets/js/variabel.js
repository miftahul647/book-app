const handleSaveVariabel = (e) => {

  const namaVariabel = q('#tambahVariabel input[name=nama_variabel]').value;
  fetch(`api/addVariabel.php?nama=${namaVariabel}&id=${IDBOOK}`)
  .then(res => res.text())
  .then(data => {

    handleClose(e);
    loadData();
    alert('Variabel Berhasil Ditambah!');

  });

}

const handleShowModalEdit = (id, nama) => {

  q('#editVariabel input[name=id_variabel]').value = id;
  q('#editVariabel input[name=nama_variabel]').value = nama;

}

const handleSaveEdit = (e) => {
  const id = q('#editVariabel input[name=id_variabel]').value;
  const nama = q('#editVariabel input[name=nama_variabel]').value;

  fetch(`api/editVariabel.php?nama=${nama}&id=${IDBOOK}&id_variabel=${id}`)
  .then(res => res.text())
  .then(data => {

    handleClose(e);
    loadData();
    alert('Variabel Berhasil Diupdate!');

  });

};


const handleShowModalHapus = (id) => {

  q('#hapusVariabel input[name=id_variabel]').value = id;

}

const handleHapusVariabel = (e) => {

  const id = q('#hapusVariabel input[name=id_variabel]').value;
  fetch(`api/hapusVariabel.php?id_variabel=${id}`)
  .then(res => res.text())
  .then(data => {

    console.log(data);

    handleClose(e);
    loadData();
    alert('Variabel Berhasil Dihapus!');

    console.log(data)

  });

}