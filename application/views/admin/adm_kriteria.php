<!-- Begin Page Content -->        

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
      <form action="<?=base_url('admin/data/kriteria')?>" method="post">
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
          <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#exampleModal">Tambah Kriteria</a>        
        <?php endif; ?>
      </div>
    </div>
    <div class="flash-data" data-flashdata="<?=$this->session->flashdata('alert');?>"></div>      

    <!-- Content Row -->
    <div class="row">
      <div class="col-12">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-success">Data Kriteria</h6>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th colspan="2">Kriteria</th>
                                    <th>Atribut</th>
                                    <th class="text-center">Bobot (%)</th>
                                    <?php if($eventid->status == 0): ?>
                                    <th colspan="2" class="text-center">Aksi</th>
                                    <?php endif ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $jml=0; $no=1; foreach($kriteria as $row): ?>
                                <tr>
                                    <td><?=$no++;?></td>
                                    <td>(<?=$row->alias;?>)</td>
                                    <td><?=$row->criteria;?></td>
                                    <td><span class="badge badge-success"><?=$row->attribute;?></span></td>
                                    <td class="text-center"><?=$row->weight;?>%</td>
                                    <?php if($eventid->status == 0): ?>
                                    <td class="text-center">
                                    <button class="btn btn-sm btn-circle btn-primary"><i class="fas fa-edit"></i></button>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?=base_url();?>admin/data/hapus_kriteria/<?=$row->id_criteria;?>" class="btn btn-sm btn-circle btn-danger tombol-hapus"><i class="fas fa-trash"></i></button>
                                    </td>
                                    <?php endif ?>
                                </tr>
                                <?php $jml+=$row->weight; endforeach; ?>
                                <tr>
                                  <td colspan="4" class="text-center">Jumlah</td>
                                  <td class="text-center"><?=$jml;?>%</td>
                                  <?php if($eventid->status == 0): ?>
                                  <td colspan="2"></td>
                                  <?php endif ?>
                                </tr>
                            </tbody>
                        </table>
                        <?php if($jml != 100):?>
                          <div class="alert alert-danger" role="alert">
                          <i class="fas fa-exclamation-triangle"></i> Jumlah Bobot Harus 100%
                        </div>
                        <?php else: ?>
                          <div class="alert alert-success" role="alert">
                          <i class="fas fa-check"></i> Jumlah Bobot Sesuai
                        </div>
                        <?php endif; ?>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
<!-- /.container-fluid -->
<?php if($eventid->status == 1 || $eventid->status == 0): ?>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?=base_url('admin/data/simpan_kriteria')?> ">
        <div class="modal-body">        
          <div class="form-group">
            <label for="exampleInputEmail1">Kriteria</label>
            <input type="text" name="kriteria" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Alias</label>
            <input type="text" name="alias" class="form-control" required>
            <input type="hidden" name="idevent" value="<?=$eventid->id_event;?>" class="form-control" required>
          </div>
          <div class="mb-2">Nilai</div>
          <div class="input-group mb-3">
            <input type="number" name="nilai" class="form-control" required><br>
            <div class="input-group-append">
              <span class="input-group-text" id="basic-addon2">%</span>
            </div>            
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Atribut</label>
            <select name="atribut" id="" class="form-control">
              <option value="benefit">Benefit</option>
              <option value="cost">Cost</option>
            </select>
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
<?php endif ?>
<?php if($eventid->status == 0): ?>
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
      <form method="post" action="<?=base_url('admin/data/impor_kriteria')?> ">
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
<?php endif ?>
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