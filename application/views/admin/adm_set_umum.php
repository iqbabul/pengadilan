<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-8">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Data Acara</h6>
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
                                                <li><a class="dropdown-item" href="#">Aktifkan</a></li>
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                <?php elseif($row->status == 1): ?>
                                                <li><a class="dropdown-item" href="#">Pasifkan</a></li>
                                                <li><a class="dropdown-item" href="#">Selesai</a></li>
                                                <li><a class="dropdown-item" href="#">Edit</a></li>
                                                <?php elseif($row->status == 2): ?>
                                                <li><a class="dropdown-item" href="#">Selesai</a></li>
                                                <?php else: ?>
                                                <?php endif; ?>
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
        <div class="col-4">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success">Skor Penilaian</h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form method="post" action="<?=base_url('admin/setting/umum_update')?>">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-6 col-form-label">Nilai Minimal</label>
                                <div class="col-sm-6">
                                <input type="number" class="form-control" name="min" value="<?=$score->min?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-6 col-form-label">Nilai Maksimal</label>
                                <div class="col-sm-6">
                                <input type="number" class="form-control" name="max" value="<?=$score->max?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPassword" class="col-sm-6 col-form-label"></label>
                                <div class="col-sm-6">
                                <button type="submit" class="btn btn-block btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->