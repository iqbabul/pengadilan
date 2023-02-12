<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="m-0 font-weight-bold text-success">Data Acara</h6>
                        </div>
                        <div class="col-lg-6 text-right">
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#exampleModal1">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Acara</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($event as $row): ?>
                                    <tr>
                                        <td><?=$no++;?></td>
                                        <td><?=$row->title;?></td>
                                        <td class="text-center">
                                            <?php if($row->status == 0): ?>
                                                <span class="badge badge-danger">Tidak Aktif</span>
                                            <?php elseif($row->status == 1): ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php elseif($row->status == 2): ?>
                                                <span class="badge badge-primary">Selesai</span>
                                            <?php else: ?>
                                                <strong>error</strong>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-list"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <?php if($row->status == 0): ?>
                                                <li><a class="dropdown-item" href="<?=base_url('admin/setting/event_aktif')?>/<?=$row->id_event;?>">Aktifkan</a></li>
                                                <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1<?=$row->id_event;?>">Edit</a></li>
                                                <li><a class="dropdown-item" class="tombol-hapus" href="<?=base_url('admin/setting/hapus_event')?>/<?=$row->id_event;?>" onclick="return confirm('Yakin Hapus <?=$row->title;?>?')">Hapus</a></li>
                                                <?php elseif($row->status == 1): ?>
                                                <li><a class="dropdown-item" href="<?=base_url('admin/setting/event_pasif')?>/<?=$row->id_event;?>">Pasifkan</a></li>
                                                <li><a class="dropdown-item" href="<?=base_url('admin/setting/event_done')?>/<?=$row->id_event;?>">Selesai</a></li>
                                                <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1<?=$row->id_event;?>">Edit</a></li>
                                                <?php elseif($row->status == 2): ?>
                                                <li><a class="dropdown-item" href="<?=base_url('admin/setting/event_done')?>/<?=$row->id_event;?>">Selesai</a></li>
                                                <?php else: ?>
                                                <?php endif; ?>
                                                </ul>
                                            </div>                                                
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="exampleModal1<?=$row->id_event;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" action="<?=base_url('admin/setting/ubah_event')?> ">
                                                <div class="modal-body">        
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Nama Acara</label>
                                                    <input type="hidden" class="form-control" name="id" value="<?=$row->id_event;?>">
                                                    <input type="text" class="form-control" name="acara" value="<?=$row->title;?>">
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                                </div>
                                            </form>      
                                            </div>
                                        </div>
                                    </div>                                    
                                    <?php endforeach; ?>
                                </tbody>
                        </table>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Skor Penilaian</h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table table-bordered">
                                <tr>
                                    <th>Masukkan Rentang Nilai</th>
                                </tr>    
                                <tr>
                                        <td>
                                            <form method="post" action="<?=base_url('admin/setting/update_score')?>">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-6 col-form-label">Nilai Minimal</label>
                                                    <div class="col-sm-6">
                                                    <input type="number" class="form-control" name="min" value="<?=$min->min?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-6 col-form-label">Nilai Maksimal</label>
                                                    <div class="col-sm-6">
                                                    <input type="number" class="form-control" name="max" value="<?=$max->max?>">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputPassword" class="col-sm-6 col-form-label"></label>
                                                    <div class="col-sm-6">
                                                    <button type="submit" class="btn btn-block btn-success">Simpan</button>
                                                    </div>
                                                </div>
                                            </form>                    
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <form action="<?=base_url('admin/setting/score_update')?>" method="post">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <tr class="text-center">
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                    </tr>
                                    <?php $n=1;foreach($score as $sc): ?>
                                        <tr>
                                            <td class="text-center"><?=$sc->score;?></td>
                                            <td>
                                                <input type="hidden" name="sc[]" value="<?=$sc->id_score;?>">
                                                <input type="text" class="form-control" name="ket[]" required value="<?=$sc->ket; ?>">
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                    <tr>
                                        <td></td>
                                        <td><button type="submit" class="btn btn-block btn-primary">Update</button></td>
                                    </tr>
                                </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?=base_url('admin/setting/simpan_acara')?> ">
        <div class="modal-body">        
          <div class="form-group">
            <label for="exampleInputEmail1">Nama Acara</label>
            <input type="text" class="form-control" name="acara" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-success">Simpan</button>
        </div>
      </form>      
    </div>
  </div>
</div>
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