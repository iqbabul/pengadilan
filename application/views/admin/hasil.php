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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perangkingan</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">    
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Tabel Perangkingan</h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <tr>
                                        <th rowspan="2" class="align-middle text-center">Alternatif</th>
                                        <th colspan="<?=$jmlc?>" class="text-center">Penilai</th>
                                        <th crowspan="2" class="text-center">Jumlah</th>
                                    </tr>
                                    <tr class="text-center font-weight-bold">
                                        <?php foreach($kriteria as $c):?>
                                        <td><?=$c->alias;?></td>
                                        <?php endforeach;?>
                                        <td></td>
                                    </tr>
                                    <?php foreach($alternatif as $al): ?>
                                    <tr>
                                        <td><?=$al->name;?></td>
                                        <?php 
                                            $ev = $eventid->id_event;
                                            $us = $user->id_user; 
                                            $alter = $al->id_alternative; 
                                            $nilai = $this->db->query("SELECT value as nilai FROM saw_evaluations WHERE id_event = '$ev' AND id_alternative = '$alter' AND id_user = '$us' ORDER BY id_criteria ASC")->result_array();                                        
                                            $item = array();
                                            foreach($nilai as $i => $nil) {
                                                $item[]=$nil;
                                            }
                                            $x=0;
                                            $last = 0;
                                            //$rank = array();
                                            foreach($kriteria as $c){
                                                $idc = $c->id_criteria;
                                                if($c->attribute == "benefit"){
                                                    $mm = $this->db->query("SELECT *, max(value) as mm FROM saw_evaluations WHERE id_criteria = '$idc' AND id_user = '$us'")->row(); 
                                                    $score = $item[$x++]['nilai']/$mm->mm;
                                                    echo "<td class='text-center'>".number_format($score, 2, '.', '')."</td>";
                                                }elseif($c->attribute == "cost"){
                                                    $mm = $this->db->query("SELECT *, min(value) as mm FROM saw_evaluations WHERE id_criteria = '$idc' AND id_user = '$us'")->row(); 
                                                    $score = $mm->mm/$item[$x++]['nilai'];
                                                    echo "<td class='text-center'>".number_format($score, 2, '.', '')."</td>";
                                                }
                                                $last += ($score * ($c->weight/100));
                                            }
                                            $rank[] = $last;
                                            echo "<td class='text-center'>".number_format($last, 2, '.', '')."</td>";
                                            //echo "<td class='text-center'>".ranking($rank)."</td>";
                                        ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                                <?php 
                                    //print_r($rank);
                                   // $urut = array($a => 'ani', $b => 'budi', $c => 'joe', $d => 'sasa');
                                    rsort($rank);
                                    $i = 1;
                                    foreach($rank as $n => $nilai){
                                        if($i == 1){
                                            echo "<strong>Ranking ".$i." : ".number_format($nilai, 2, '.', '')."</strong><br/>";
                                        }else{
                                            echo "Ranking ".$i." : ".number_format($nilai, 2, '.', '')."<br/>";
                                        }
                                        $i++;
                                    }                                
                                ?>
                            </div>                    
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<?php
function ranking($ranking){
    $ordered_values = $ranking;
    rsort($ordered_values);
    foreach ($ranking as $key => $value) {
        foreach ($ordered_values as $ordered_key => $ordered_value) {
        if ($value === $ordered_value) {
            $key = $ordered_key;
            break;
        }
    }
        echo ((int) $key + 1);
    }
}
?>
