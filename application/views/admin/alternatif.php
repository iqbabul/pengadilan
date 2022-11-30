<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Usulan Pegawai</h1>
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
                    <?php
                        $usr = $user->id_user;
                        $id_alternatif = $row->id_alternative;
                        $nilai = $this->db->query("SELECT count(id_evaluations) as jml FROM saw_evaluations 
                        WHERE id_alternative = '$id_alternatif' AND id_user = '$usr'")->row();
                        if($nilai->jml > 0):
                    ?>
                    <form action="<?=base_url('admin/penilaian/edit')?>" method="post">
                    <input type="hidden" name="id" value="<?=$row->id_alternative?>">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Sudah Dinilai</button>
                    </form>
                    <?php else: ?>
                    <form action="<?=base_url('admin/penilaian/input')?>" method="post">
                    <input type="hidden" name="id" value="<?=$row->id_alternative?>">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-edit"></i> Beri Nilai</button>
                    </form>
                    <?php endif ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- /.container-fluid -->
