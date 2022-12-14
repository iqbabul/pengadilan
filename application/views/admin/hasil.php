<?php
  error_reporting(0);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
      <form action="<?=base_url('admin/hasil')?>" method="post">
        <select class="form-control" name="event" onchange="this.form.submit()">
        <option value="">- Pilih -</option>
          <?php foreach($event as $ev):?>
          <?php if($ev->id_event == $eventid->id_event):?>
          <option value="<?=$ev->id_event;?>" selected><?=$ev->title?><?= $ev->status == 1 ? " (<span class='text-success'>Aktif</span>)" : " (<span class='text-success'>Selesai</span>)"; ?></option>
          <?php else:?>
          <option value="<?=$ev->id_event;?>"><?=$ev->title?><?= $ev->status == 1 ? " (<span class='text-success'>Aktif</span>)" : " (<span class='text-success'>Selesai</span>)"; ?></option>
          <?php endif?>
          <?php endforeach; ?>
        </select>
      </form>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">    
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Tabel Hasil</h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <tr>
                                <th rowspan="2" class="align-middle text-center">Kandidat</th>
                                <?php 
                                $ev = $eventid->id_event;
                                $us = $user->id_user;                                 
                                $pen = $this->db->query("SELECT * FROM saw_result r 
                                        LEFT JOIN saw_users u ON u.id_user = r.id_user 
                                        WHERE id_event = '$ev' GROUP BY r.id_user")->num_rows();?>
                                <th colspan="<?=$pen?>" class="text-center">Penilai</th>
                                <th rowspan="2" class="align-middle text-center">Nilai Akhir</th>
                            </tr>
                            <tr class="text-center font-weight-bold">
                            <?php 
                            $penilai = $this->db->query("SELECT u.fullname as nama, r.score as score FROM saw_result r 
                                        LEFT JOIN saw_users u ON u.id_user = r.id_user 
                                        WHERE id_event = '$ev' GROUP BY r.id_user")->result();?>  
                            <?php foreach($penilai as $p):?>
                                <td><?=$p->nama;?></td>
                            <?php endforeach;?>
                            </tr>
                            <?php foreach($alternatif as $al): ?>
                                <tr>
                                    <td><?=$al->name;?></td>
                                    <?php
                                    $rata = 0;
                                    $alter = $al->id_alternative;
                                    $nilai = $this->db->query("SELECT u.fullname as nama, r.score as score FROM saw_result r 
                                    LEFT JOIN saw_users u ON u.id_user = r.id_user 
                                    WHERE id_event = '$ev' AND id_alternative = '$alter'")->result();?>
                                    <?php foreach($nilai as $nilai): ?>
                                    <td class="text-center"><?=number_format($nilai->score, 3, '.', '');?></td>
                                    <?php $rata += $nilai->score; endforeach ?>
                                    <td class="text-center"><?=number_format($rata/$pen, 3, '.', '');?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                      </div> 
                      <?php
                           $last = $this->db->query("SELECT a.name as nama, AVG(r.score) as rata FROM saw_result r LEFT JOIN saw_alternatives a ON a.id_alternative=r.id_alternative 
                                WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC LIMIT 1")->row();
                                echo "<div class='alert alert-success' role='alert'>".$eventid->title." adalah <strong>".$last->nama."</strong> dengan nilai akhir <strong >".number_format($last->rata, 3, '.', '')."</strong></div>";
                        ?>      
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->