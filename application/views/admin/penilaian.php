<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Content Row -->
    <div class="row">
        <div class="col-12">
            <div class="card card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-success"><?=$alternatif->fullname;?></h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    <div class="alert alert-primary" role="alert">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4>Petunjuk Pengisian</h4>
                                <ol>
                                    <li>Berikanlah Nilai/Bobot : dari angka <?=$min->min;?> s/d <?=$max->max;?></li>
                                    <?php foreach($score as $sc): ?>
                                    <li>Nilai <?=$sc->score;?> : <strong><?=$sc->ket;?></strong></li>
                                    <?php endforeach ?>
                                </ol>
                            </div>
                            <div class="col-lg-6 text-center">
                                <img src="<?=base_url()?>assets/img/user/<?=$alternatif->foto?>" width="100" class="mb-2" alt="">
                                <br><?=$alternatif->fullname;?>
                            </div>
                        </div>
                    </div>
                        <form action="<?=base_url('admin/penilaian/simpan')?>" method="post">
                        <input type="hidden" name="alternatif" value="<?=$alternatif->id_alternative;?>">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th colspan="2">Kriteria</th>
                                            <th width="20%" class="text-center">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; foreach($kriteria as $sult):?>
                                        <tr>
                                            <td><?=$no++;?></td>
                                            <td>(<?=$sult->alias;?>)</td>
                                            <td><?=$sult->criteria;?></td>
                                            <td class="text-right">
                                                <input type="hidden" name="kriteria[]" value="<?=$sult->id_criteria;?>">
                                                <select name="nilai[]" id="" class="form-control" required>
                                                <option value="">-Pilih-</option>
                                                <?php foreach($score as $sc): ?>  
                                                    <option value="<?=$sc->score;?>"><?=$sc->score;?> (<?=$sc->ket;?>)</option>
                                                <?php endforeach ?>
                                                </select>
                                                <!-- <input type="number" class="form-control" name="nilai[]" min="<?=$min->min;?>" max="<?=$max->max;?>" required> -->
                                            </td>
                                        </tr>
                                        <?php endforeach?>
                                        <tr>
                                            <td colspan="3"><input type="hidden" name="idv" value="<?=$eventid;?>"></td>
                                            <td><button type="submit" class="btn btn-sm btn-success">Simpan</button></td>
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