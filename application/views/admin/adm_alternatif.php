<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usulan Pegawai</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#exampleModal">Tambah Kandidat</a>        
    </div>
    <div class="flash-data" data-flashdata="<?=$this->session->flashdata('alert');?>"></div>      

    <!-- Content Row -->
    <div class="row">
        <?php $no=1; foreach($alternatif as $row): ?>
        <div class="col-sm-3 mb-3">
            <div class="card">
                <img class="card-img-top" src="<?=base_url()?>assets/img/alternatif/<?=$row->photo;?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?=$row->name;?></h5>
                    <p class="card-text"><?=$row->jabatan;?></p><hr>
                    <form action="<?=base_url('admin/data/status_alternatif')?>" method="post">
                      <?php if($row->status == 1):?>
                      <input type="hidden" name="status" value="0">
                      <button type="submit" class="btn btn-sm btn-circle btn-success" title="Pasifkan"><i class="fas fa-check"></i></button>
                      <?php else:?>
                      <input type="hidden" name="status" value="1">
                      <button type="submit" class="btn btn-sm btn-circle btn-danger" title="Aktifkan"><i class="fas fa-times"></i></button>
                      <?php endif?>
                      <button class="btn btn-sm btn-circle btn-primary"><i class="fas fa-edit"></i></button>
                      <a href="<?=base_url();?>admin/data/hapus_alternatif/<?=$row->id_alternative;?>" class="btn btn-sm btn-circle btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                      <input type="hidden" name="id" value="<?=$row->id_alternative;?>">
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- /.container-fluid -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kandidat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" enctype="multipart/form-data" action="<?=base_url('admin/data/simpan_alternatif')?> ">
        <div class="modal-body">        
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Kandidat</label>
            <input type="text" name="alternatif" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Foto</label>
            <input type="file" name="foto" accept="image/*" class="form-control-file" id="exampleFormControlFile1" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-success">Simpan</button>
        </div>
      </form>      
    </div>
  </div>
</div>
<script>
  $(function() {
    var flashData = $('.flash-data').data('flashdata');
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    if (flashData) {
      toastr.success('Data berhasil '+flashData+'.')
    }
    //tombol-hapus
    $('.tombol-hapus').on('click', function(e){
      e.preventDefault(); // mematikan aksi default
      var href = $(this).attr('href');
      Swal.fire({
        title: 'Peringatan!',
        text: "Apakah ingin menghapus data ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#25c904',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.value) {
          document.location.href = href;
        }
      });
    });     
  });    
</script>