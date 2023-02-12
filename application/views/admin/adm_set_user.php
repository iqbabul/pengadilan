<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="m-0 font-weight-bold text-success">Data Pegawai</h6>
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
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Tanggal Lahir</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Telepon</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($usr as $row): ?>
                                        <tr>
                                            <td class="text-center"><?=$no++; ?></td>
                                            <td class="text-center"><img src="<?=base_url()?>assets/img/user/<?=$row->foto?>" alt="" class="rounded-circle" width="50"></td>
                                            <td><?=$row->fullname ?></td>
                                            <td><?=$row->nip ?></td>
                                            <td><?=$row->tempat_lahir;?>, <?=date('d-m-Y',strtotime($row->tgl_lahir));?></td>
                                            <td><?=$row->jenis_kelamin ?></td>
                                            <td><?=$row->telp ?></td>
                                            <td><span class="badge badge-dark"><?=$row->position_name ?></span></td>
                                            <td class="text-center">
                                              <?= $row->status == "on" ? "<button class='btn btn-sm btn-circle btn-success'><i class='fa fa-check'></i></button>" : "<button class='btn btn-sm btn-circle btn-danger'><i class='fa fa-power-off'></i></button>"; ?>
                                            </td>
                                            <td class="text-center">
                                            <div class="dropdown">
                                            <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-list"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1<?=$row->id_user;?>"><i class="fa fa-eye"></i> Detail</a></li>
                                                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal2<?=$row->id_user;?>"><i class="fa fa-edit"></i> Edit</a></li>
                                                    <li><a class="dropdown-item" class="tombol-hapus" href="<?=base_url('admin/data/hapus_user')?>/<?=$row->id_user;?>" onclick="return confirm('Yakin Hapus <?=$row->fullname;?>?')"><i class="fa fa-trash"></i> Hapus</a></li>
                                                    <!-- <li><a class="dropdown-item" href="<?=base_url('admin/setting/reset_password')?>/<?=$row->id_user;?>"><i class="fa fa-recycle"></i> Reset</a></li> -->
                                                </ul>
                                            </div>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="exampleModal2<?=$row->id_user;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Pegawai</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <form method="post" enctype="multipart/form-data" action="<?=base_url('admin/data/update_user')?> ">
                                              <div class="modal-body">        
                                                <div class="form-group">
                                                  <label for="exampleInputPassword1">Nama Lengkap</label>
                                                  <input type="text" name="fullname" class="form-control" value="<?=$row->fullname ?>" required>
                                                  <input type="hidden" name="ids" value="<?=$row->id_user;?>">
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleInputPassword1">NIP</label>
                                                  <input type="text" name="nip" value="<?=$row->nip;?>" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleInputPassword1">Tempat Lahir</label>
                                                  <input type="text" name="tmpt" class="form-control" value="<?=$row->tempat_lahir;?>" required>
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleInputPassword1">Tanggal Lahir</label>
                                                  <input type="date" name="tgl" class="form-control" value="<?=$row->tgl_lahir?>" required>
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleInputPassword1">Alamat</label>
                                                  <textarea name="alamat" cols="15" class="form-control" rows="5"><?=$row->alamat?></textarea>
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleInputPassword1">Jenis Kelamin</label><br>
                                                  <?php if($row->jenis_kelamin == "Laki-laki"): ?>
                                                  <input type="radio" name="jk" value="Laki-laki" checked> Laki-laki <br>
                                                  <input type="radio" name="jk" value="Perempuan"> Perempuan
                                                  <?php elseif($row->jenis_kelamin == "Perempuan"): ?>
                                                  <input type="radio" name="jk" value="Laki-laki" > Laki-laki <br>
                                                  <input type="radio" name="jk" value="Perempuan" checked> Perempuan
                                                  <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleInputPassword1">No.Telp</label>
                                                  <input type="number" name="telp" class="form-control" value="<?=$row->telp ?>" required>
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleFormControlFile1">Jabatan</label><br>
                                                  <select name="jb" class="form-control" required>
                                                    <option value="">- Pilih </option>
                                                  <?php foreach($posisi as $pos): ?>                                                    
                                                  <?php if($pos->id_position == $row->id_position): ?>
                                                  <option value="<?=$pos->id_position?>" selected><?=$pos->position_name?></option>
                                                  <?php else: ?>
                                                  <option value="<?=$pos->id_position?>"><?=$pos->position_name?></option>
                                                  <?php endif; ?>
                                                  <?php endforeach; ?>
                                                  </select>
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleFormControlFile1">Foto</label><br>
                                                  <img src="<?=base_url()?>assets/img/user/<?=$row->foto?>" alt="" class="rounded-circle" width="50"><br>
                                                  <input type="file" name="foto" accept="image/*" class="form-control-file" id="exampleFormControlFile1">
                                                </div>
                                                <div class="form-group">
                                                  <label for="exampleFormControlFile1">Status</label><br>
                                                  <select name="status" class="form-control" required>
                                                  <?php if($row->status == "on"): ?>
                                                  <option value="on" selected>Aktif</option>
                                                  <option value="off">Tidak Aktif</option>
                                                  <?php elseif($row->status == "off"): ?>
                                                  <option value="on">Aktif</option>
                                                  <option value="off" selected>Tidak Aktif</option>
                                                  <?php endif; ?>
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
                                        <!-- Modal Detail -->
                                        <div class="modal fade" id="exampleModal1<?=$row->id_user;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Pegawai</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="text-center mt-2 mb-3">
                                                  <img src="<?=base_url()?>assets/img/user/<?=$row->foto?>" alt="" class="rounded-circle" width="200">
                                                </div> 
                                              <div class="card">
                                                  <div class="card-body">
                                                    <h5 class="card-title"><?=$row->fullname;?></h5>
                                                    <p class="card-text"><?=$row->tempat_lahir;?>, <?=date('d-m-Y',strtotime($row->tgl_lahir));?></p>
                                                  </div>
                                                  <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Jabatan : <?=$row->position_name?></li>
                                                    <li class="list-group-item">NIP : <?=$row->nip?></li>
                                                    <li class="list-group-item">Jenis Kelamin : <?=$row->jenis_kelamin?></li>
                                                    <li class="list-group-item">Alamat : <?=$row->alamat?></li>
                                                    <li class="list-group-item">No. Telepon : <?=$row->telp?></li>
                                                  </ul>
                                                </div>                                                
                                              </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
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
      <form method="post" enctype="multipart/form-data" action="<?=base_url('admin/data/simpan')?> ">
        <div class="modal-body">        
          <div class="form-group">
            <label for="exampleInputPassword1">Nama Lengkap</label>
            <input type="text" name="fullname" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">NIP</label>
            <input type="text" name="nip" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tempat Lahir</label>
            <input type="text" name="tmpt" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Tanggal Lahir</label>
            <input type="date" name="tgl" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Alamat</label>
            <textarea name="alamat" cols="15" class="form-control" rows="5" required></textarea>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Jenis Kelamin</label><br>
            <input type="radio" name="jk" value="Laki-laki"> Laki-laki <br>
            <input type="radio" name="jk" value="Perempuan"> Perempuan
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">No.Telp</label>
            <input type="number" name="telp" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Jabatan</label><br>
            <select name="jb" class="form-control" required>
            <option value="">- Pilih -</option>
            <?php foreach($posisi as $pos): ?>                                                    
            <option value="<?=$pos->id_position?>" selected><?=$pos->position_name?></option>
            <?php endforeach; ?>
            </select>
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