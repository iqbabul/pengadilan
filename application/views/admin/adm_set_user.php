<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <h6 class="m-0 font-weight-bold text-success">Data Pengguna</h6>
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
                                        <th width="1%">No</th>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Akses</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no=1; foreach($usr as $row): ?>
                                        <tr>
                                            <td class="text-center"><?=$no++; ?></td>
                                            <td><img src="<?=base_url()?>assets/img/user/<?=$row->foto?>" alt="" width="50"></td>
                                            <td><?=$row->fullname ?></td>
                                            <td><?=$row->username ?></td>
                                            <td><span class="badge badge-primary"><?=$row->name ?></span></td>
                                            <td class="text-center">
                                            <div class="dropdown">
                                            <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-list"></i>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><a class="dropdown-item" href="<?=base_url('admin/setting/event_aktif')?>/<?=$row->id_user;?>">Edit</a></li>
                                                    <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal1<?=$row->id_user;?>">Hapus</a></li>
                                                </ul>
                                            </div>
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
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" enctype="multipart/form-data" action="<?=base_url('admin/setting/simpan_user')?> ">
        <div class="modal-body">        
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" name="username" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Nama Lengkap</label>
            <input type="text" name="fullname" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Akses</label>
            <select name="akses" id="" class="form-control">
                <option value="">-Pilih-</option>
                <?php foreach($access as $ac): ?>
                <option value="<?=$ac->id_access;?>"><?=$ac->name;?></option>
                <?php endforeach ?>
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
