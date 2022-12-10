<?php
  error_reporting(0);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
      <form action="<?=base_url('admin/data/alternatif')?>" method="post">
        <select class="form-control" name="event" onchange="this.form.submit()">
        <option value="">- Pilih -</option>
          <?php foreach($event as $ev):?>
          <?php if($ev->id_event == $eventid->id_event):?>
          <option value="<?=$ev->id_event;?>" selected>
          <?=$ev->title?>
          <?php if($ev->status == 0): ?>
          (<span class='text-success'>Tidak Aktif</span>)
          <?php elseif($ev->status == 1):?> 
          (<span class='text-success'>Aktif</span>)
          <?php elseif($ev->status == 2):?> 
          (<span class='text-success'>Selesai</span>)
          <?php endif ?> 
          </option>
          <?php else:?>
          <option value="<?=$ev->id_event;?>"><?=$ev->title?>
          <?php if($ev->status == 0): ?>
          (<span class='text-success'>Tidak Aktif</span>)
          <?php elseif($ev->status == 1):?> 
          (<span class='text-success'>Aktif</span>)
          <?php elseif($ev->status == 2):?> 
          (<span class='text-success'>Selesai</span>)
          <?php endif ?> 
          </option>
          <?php endif?>
          <?php endforeach; ?>
        </select>
      </form>
    </div>
    <div class="row mb-4">
      <div class="col-6">
      <?php if($eventid->status == 0): ?>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm" data-toggle="modal" data-target="#exampleModal1">Impor Data</a>        
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#exampleModal">Tambah Kandidat</a>        
      <?php endif ?>
      </div>
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
                    <?php if($eventid->status != 2): ?>
                    <form action="<?=base_url('admin/data/status_alternatif')?>" method="post">
                      <?php if($row->status == 1):?>
                      <input type="hidden" name="status" value="0">
                      <button type="submit" class="btn btn-sm btn-circle btn-success" title="Pasifkan"><i class="fas fa-check"></i></button>
                      <?php else:?>
                      <input type="hidden" name="status" value="1">
                      <button type="submit" class="btn btn-sm btn-circle btn-danger" title="Aktifkan"><i class="fas fa-times"></i></button>
                      <?php endif?>
                      <button class="btn btn-sm btn-circle btn-primary"><i class="fas fa-edit"></i></button>
                      <?php if($eventid->status == 0): ?>
                      <a href="<?=base_url();?>admin/data/hapus_alternatif/<?=$row->id_alternative;?>" class="btn btn-sm btn-circle btn-danger tombol-hapus"><i class="fas fa-trash"></i></a>
                      <?php endif; ?>
                      <input type="hidden" name="id" value="<?=$row->id_alternative;?>">
                    </form>
                    <?php endif ?>
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
            <input type="hidden" name="idev" class="form-control" value="<?=$eventid->id_event?>" required>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Impor Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?=base_url('admin/data/impor_alternatif')?> ">
        <div class="modal-body">        
          <div class="form-group">
            <label for="exampleInputEmail1">Acara</label>
            <select class="form-control" name="event"">
              <option value="">- Pilih -</option>
                <?php foreach($eventD as $ev):?>
                <option value="<?=$ev->id_event;?>"><?=$ev->title?><?= $ev->status == 1 ? " (<span class='text-success'>Aktif</span>)" : " (<span class='text-success'>Selesai</span>)"; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="ev" value="<?=$eventid->id_event?>">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-danger">Impor</button>
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
          confirmButtonColor: '#3085d6',
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