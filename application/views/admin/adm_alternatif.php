<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
      <form action="<?=base_url('admin/setting/alternatif')?>" method="post">
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
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#exampleModal">Tambah Kandidat</a>        
      <?php endif ?>
      </div>
    </div>
    <div class="flash-data" data-flashdata="<?=$this->session->flashdata('alert');?>"></div>      
    <!-- Content Row -->
    <div class="row">
    <div class="col-12">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="m-0 font-weight-bold text-success">Data Kandidat</h6>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Keterangan</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($alternatif as $row): ?>
                            <tr>
                                <td><?=$no++;?></td>
                                <td class="text-center"><img src="<?=base_url()?>assets/img/user/<?=$row->foto?>" alt="" class="rounded-circle" width="50"></td>
                                <td><?=$row->fullname;?></td>
                                <td><?=$row->position_name;?></td>
                                <td><?=$row->ket;?></td>
                                <td class="text-center">
                                  <a href="<?=base_url()?>admin/setting/alternatif_hapus/<?=$row->id_alternative;?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus <?=$row->fullname;?>?')"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                      </table>  
                    </div>
                </div>
            </div>
        </div>

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
      <form method="post" action="<?=base_url('admin/setting/simpan_alternatif')?> ">
        <div class="modal-body">        
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Kandidat</label>
            <select class="form-control" id="theSelect" name="kandidat" style="width: 100%;">
              <?php foreach($kandidat as $k): ?>
              <option value="<?=$k->id_user?>"><?=$k->fullname;?> [<?= $k->position_name?>]</option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" value="<?=$eventid->id_event?>" name="idevent">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Keterangan</label>
            <textarea name="ket" class="form-control" cols="30" rows="5"></textarea>
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
  $(function () {
    $("#theSelect").select2();
    }
   )
</script>
<!-- <script type="text/javascript">
  $(".theSelect").change(function(){
    var id = $(".theSelect").val();
    console.log('helo');
  });    
</script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script type="text/javascript">
<?php if($this->session->flashdata('success')){ ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
<?php }else if($this->session->flashdata('error')){  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
<?php }else if($this->session->flashdata('warning')){  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
<?php }else if($this->session->flashdata('info')){  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
<?php } ?>


</script>