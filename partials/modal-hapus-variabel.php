<div class="modal fade" id="hapusVariabel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Variabel</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="handleClose(this)"></button>
      </div>
      <div class="modal-body">
       <center>
         <h4>Apakah Anda Yakin Menghapus Variabel?</h4>
       </center>

       <input type="hidden" name="id_variabel">

     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="handleClose(this)">Batal</button>
      <button type="button" data-bs-dismiss="modal" onclick="handleHapusVariabel(this)" class="btn btn-danger">Hapus</button>
    </div>
  </div>
</div>
</div>