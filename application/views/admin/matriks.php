<?php
  error_reporting(0);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
      <form action="<?=base_url('admin/matriks')?>" method="post">
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
                <h6 class="m-0 font-weight-bold text-success">Matriks Keputusan</h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <tr>
                                    <th rowspan="2" class="align-middle text-center">Alternatif</th>
                                    <th colspan="<?=$jmlc?>" class="text-center">Kriteria</th>
                                </tr>
                                <tr class="text-center font-weight-bold">
                                    <?php foreach($kriteria as $c):?>
                                    <td><?=$c->alias;?></td>
                                    <?php endforeach;?>
                                </tr>
                                <?php foreach($alternatif as $al): ?>
                                <tr>
                                    <td><?=$al->name;?></td>
                                    <?php 
                                    $ev = $eventid->id_event;
                                    $us = $user->id_user; 
                                    $alter = $al->id_alternative; 
                                    $nilai = $this->db->query("SELECT * FROM saw_evaluations WHERE id_event = '$ev' AND id_alternative = '$alter' AND id_user = '$us' ORDER BY id_criteria ASC")->result();?>
                                    <?php foreach($nilai as $n): ?>
                                    <td class="text-center"><?=$n->value;?></td>
                                    <?php endforeach;?>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">    
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Matriks Nomalisasi</h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tr>
                                        <th rowspan="2" class="align-middle text-center">Alternatif</th>
                                        <th colspan="<?=$jmlc?>" class="text-center">Kriteria</th>
                                    </tr>
                                    <tr class="text-center font-weight-bold">
                                        <?php foreach($kriteria as $c):?>
                                        <td><?=$c->alias;?></td>
                                        <?php endforeach;?>
                                    </tr>
                                    <?php foreach($alternatif as $al): ?>
                                    <tr>
                                        <td><?=$al->name;?></td>
                                        <?php 
                                            $us = $user->id_user; 
                                            $alter = $al->id_alternative; 
                                            $nilai = $this->db->query("SELECT value as nilai FROM saw_evaluations WHERE id_event = '$ev' AND id_alternative = '$alter' AND id_user = '$us' ORDER BY id_criteria ASC")->result_array();                                        
                                            $item = array();
                                            foreach($nilai as $i => $nil) {
                                                $item[]=$nil;
                                            }
                                            $x=0;
                                            foreach($kriteria as $c){
                                                $idc = $c->id_criteria;
                                                if($c->attribute == "benefit"){
                                                    $mm = $this->db->query("SELECT *, max(value) as mm FROM saw_evaluations WHERE id_criteria = '$idc' AND id_user = '$us'")->row(); 
                                                    echo "<td class='text-center'>".number_format($item[$x++]['nilai']/$mm->mm, 2, '.', '')."</td>";
                                                }elseif($c->attribute == "cost"){
                                                    $mm = $this->db->query("SELECT *, min(value) as mm FROM saw_evaluations WHERE id_criteria = '$idc' AND id_user = '$us'")->row(); 
                                                    echo "<td class='text-center'>".number_format($mm->mm/$item[$x++]['nilai'], 2, '.', '')."</td>";
                                                }
                                            }
                                        ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>                    
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
