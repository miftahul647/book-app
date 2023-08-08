<div class="modal fade" id="editVariabel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Variabel</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="handleClose(this)"></button>
          </div>
          <div class="modal-body">

            <div class="mb-3">
              <label for="buku" class="form-label">Variabel</label>
              <input type="text" class="form-control" id="buku" name="nama_variabel">
              <input type="hidden" class="form-control" id="buku" name="id_variabel">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="handleClose(this)">Batal</button>
            <button type="button" data-bs-dismiss="modal" onclick="handleSaveEdit(this)" class="btn btn-primary">Simpan</button>
          </div>
      </div>
    </div>
  </div>