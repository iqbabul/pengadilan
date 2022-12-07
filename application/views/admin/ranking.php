<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
      <form action="<?=base_url('admin/ranking')?>" method="post">
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
                                        <th colspan="<?=$jmlc?>" class="text-center">Kriteria</th>
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
                                            $data = array(
                                                'id_event' => $ev,
                                                'id_alternative' => $alter,
                                                'id_user' => $us,
                                                'score' => $last
                                            );
                                            $result = $this->db->query("SELECT * FROM saw_result WHERE id_event = '$ev' AND id_alternative = '$alter' AND id_user = '$us'")->num_rows();
                                            if($result <= 0){
                                                $this->db->insert('saw_result', $data);
                                            }
                                        ?>
                                    </tr>
                                    <?php endforeach; ?>
                                </table>
                            </div>  
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6">
                                <table class="table table-bordered" width="30%" cellspacing="0">
                                    <tr class="text-center">
                                        <th width="1%">Peringkat</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                    <?php
                                        $urut=1;$sult = $this->db->query("SELECT * FROM saw_result r LEFT JOIN saw_alternatives a ON a.id_alternative = r.id_alternative WHERE r.id_event = '$ev' AND r.id_user = '$us' ORDER BY score DESC")->result();
                                        foreach($sult as $hasil){
                                            echo "<tr>";
                                            echo "<td class='text-center'>".$urut++."</td>";
                                            echo "<td>".$hasil->name."</td>";
                                            echo "<td class='text-center'>".number_format($hasil->score, 2, '.', '')."</td>";
                                            echo "</tr>";
                                        }
                                    ?>                                
                                    </table>

                                </div>                  

                                </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->