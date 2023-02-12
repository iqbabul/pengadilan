<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="m-0 font-weight-bold text-success">Setting Jabatan</h6>
                        </div>
                        <div class="col-lg-6 text-right">
                            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#exampleModal1">Tambah</a>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="1%">No</th>
                                        <th>Jabatan</th>
                                        <th>Akses</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($jabatan as $row): ?>
                                        <tr>
                                            <td class="text-center"><?=$no++; ?></td>
                                            <td><?=$row->position_name ?></td>
                                            <td><?=$row->name ?></td>
                                            <td class="text-center">
                                            <div class="dropdown">
                                            <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-list"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal2<?=$row->id_position;?>"><i class="fa fa-edit"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" class="tombol-hapus" href="<?=base_url('admin/setting/hapus_jabatan')?>/<?=$row->id_position;?>" onclick="return confirm('Yakin Hapus <?=$row->position_name;?>?')"><i class="fa fa-trash"></i> Hapus</a></li>
                                                </ul>
                                            </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="exampleModal2<?=$row->id_position;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Jabatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form method="post" enctype="multipart/form-data" action="<?=base_url('admin/setting/update_jabatan')?> ">
                                              <div class="modal-body">        
                                                <div class="form-group">
                                                  <label for="exampleInputPassword1">Nama Lengkap</label>
                                                  <input type="text" name="jb" class="form-control" value="<?=$row->position_name ?>" required>
                                                  <input type="hidden" name="idp" value="<?=$row->id_position;?>">
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleFormControlFile1">Akses</label><br>
                                                  <select name="akses" class="form-control">
                                                  <?php foreach($akses as $result): ?>                                                    
                                                  <?php if($result->id_access == $row->id_access): ?>
                                                  <option value="<?=$result->id_access?>" selected><?=$result->name?></option>
                                                  <?php else: ?>
                                                  <option value="<?=$result->id_access?>"><?=$result->name?></option>
                                                  <?php endif; ?>
                                                  <?php endforeach; ?>
                                                  </select>
                                                </div>
                                              </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                  <button type="submit" class="btn btn-sm btn-primary">Update</button>
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
    </div>

</div>
<!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" enctype="multipart/form-data" action="<?=base_url('admin/setting/simpan_jabatan')?> ">
        <div class="modal-body">        
          <div class="form-group">
            <label for="exampleInputPassword1">Jabatan</label>
            <input type="text" name="jb" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Akses</label><br>
            <select name="akses" class="form-control">
                <option value="">- Pilih -</option>
            <?php foreach($akses as $result): ?>                                                    
            <option value="<?=$result->id_access?>"><?=$result->name?></option>
            <?php endforeach; ?>
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