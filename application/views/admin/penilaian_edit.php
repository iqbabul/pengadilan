<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success"><?=$alternatif->name;?></h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <h4>Petunjuk Pengisian</h4>
                        <ol>
                            <li>Berikanlah Nilai/Bobot : dari angka 1 s/d 5</li>
                            <li>Nilai 1 : <strong>Sangat Tidak Berpengaruh</strong></li>
                            <li>Nilai 5 : <strong>Sangat Berpengaruh</strong></li>
                        </ol>
                    </div>
                        <?php 
                            $idv = $eventid;
                            $id_alternatif = $alternatif->id_alternative;
                            $usr = $user->id_user;
                            $cr = $this->db->query("SELECT *, ev.status as evstatus FROM saw_criterias c 
                            LEFT JOIN saw_event ev ON ev.id_event = c.id_event
                            LEFT JOIN saw_evaluations e ON c.id_criteria = e.id_criteria AND e.id_alternative = '$id_alternatif' AND e.id_user = '$usr' WHERE c.id_event = '$idv' AND c.status = 1")->result(); ?>
                        <form action="<?=base_url('admin/penilaian/update')?>" method="post">
                        <input type="hidden" name="alternatif" value="<?=$alternatif->id_alternative;?>">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th colspan="2">Kriteria</th>
                                            <th width="15%" class="text-center">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($cr as $sult):?>
                                        <tr>
                                            <td><?=$no++;?></td>
                                            <td>(<?=$sult->alias;?>)</td>
                                            <td><?=$sult->criteria;?></td>
                                            <td class="text-center">
                                                <?php if($sult->evstatus == 1): ?>
                                                <input type="hidden" name="kriteria[]" value="<?=$sult->id_criteria;?>">
                                                <input type="number" class="form-control" name="nilai[]" value="<?=$sult->value;?>" min="1" max="5" required>
                                                <?php elseif($sult->evstatus == 2): ?>
                                                <?=$sult->value;?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach?>
                                        <tr>
                                            <td colspan="3"></td>
                                            <!-- <td><button type="submit" class="btn btn-sm btn-success">Simpan</button></td> -->
                                        </tr>
                                    </tbody>
                            </table>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->