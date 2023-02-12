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
                            <?php
                            $pp = $this->db->query("SELECT * FROM saw_result r INNER JOIN saw_alternatives a ON r.id_alternative = a.id_alternative INNER JOIN saw_users u ON u.id_user = a.id_user
                            WHERE r.id_event = '$ev' GROUP BY r.id_alternative")->result();
                            foreach($pp as $al): ?>
                                <tr>
                                    <td><?=$al->fullname;?> <?=$al->top == 1 ? "<i class='fa fa-star checked'></i>" : "";?> </td>
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
                        //    $last = $this->db->query("SELECT *,r.status as rstatus, fullname, AVG(r.score) as rata FROM saw_result r LEFT JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                        //         LEFT JOIN saw_users u ON a.id_user = u.id_user 
                        //         WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC LIMIT 1")->row();
                           $hasil = $this->db->query("SELECT * FROM (SELECT fullname, r.id_event as id_event, r.id_alternative as idkandidat, r.status as rstatus, r.top as top,AVG(r.score) as rata FROM saw_result r 
                           INNER JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                           INNER JOIN saw_users u ON a.id_user = u.id_user 
                           WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC) AS beres WHERE rata = (
                           SELECT rata FROM ( 
                           SELECT fullname,r.id_event as id_event, r.id_alternative as idkandidat, r.status as rstatus, r.top as top, AVG(r.score) as rata FROM saw_result r 
                           INNER JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                           INNER JOIN saw_users u ON a.id_user = u.id_user 
                           WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC) AS hasil GROUP BY rata HAVING COUNT(*) > 1)")->num_rows();
                           
                           $mbuh = $this->db->query("SELECT * FROM (SELECT fullname, r.id_event as id_event, r.id_alternative as idkandidat, r.status as rstatus, r.top as top,AVG(r.score) as rata FROM saw_result r 
                           INNER JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                           INNER JOIN saw_users u ON a.id_user = u.id_user 
                           WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC) AS beres WHERE rata = (
                           SELECT rata FROM ( 
                           SELECT fullname,r.id_event as id_event, r.id_alternative as idkandidat, r.status as rstatus, r.top as top, AVG(r.score) as rata FROM saw_result r 
                           INNER JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                           INNER JOIN saw_users u ON a.id_user = u.id_user 
                           WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC) AS hasil GROUP BY rata HAVING COUNT(*) > 1) LIMIT 1")->row();                           
                           
                           if($hasil > 0){
                            $juara = $this->db->query("SELECT *,r.status as rstatus, fullname, AVG(r.score) as rata FROM saw_result r LEFT JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                            LEFT JOIN saw_users u ON a.id_user = u.id_user 
                            WHERE r.id_event = '$ev' AND r.top = 1 GROUP BY r.id_alternative ORDER BY rata DESC LIMIT 1")->row();
                            if($user->id_user == 1){
                                echo "<div class='alert alert-success' role='alert'>".$eventid->title." adalah <strong>".$juara->fullname."</strong> dengan nilai akhir <strong >".number_format($juara->rata, 3, '.', '')."</strong></div>";
                                if ($mbuh->rstatus == '0') {
                                    echo "<a href='".base_url()."admin/hasil/publikasi/".$mbuh->id_event."' class='btn btn-sm btn-primary' onclick=\"return confirm('Yakin akan dipublikasi ?')\"><i class='fa fa-globe'></i> Publikasikan</a> ";    
                                    echo "<a href='".base_url()."admin/hasil/edit/".$mbuh->id_event."' class='btn btn-sm btn-danger'><i class='fa fa-edit'></i> Edit Hasil</a>";    
                                  }elseif($mbuh->rstatus == '1'){
                                      echo "<a href='".base_url()."admin/hasil/privasi/".$mbuh->id_event."' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin akan diprivasi ?')\"><i class='fa fa-globe'></i> Privasi</a>";                                    
                                  }      
                            }else{
                                echo "<div class='alert alert-success' role='alert'>".$eventid->title." adalah <strong>".$juara->fullname."</strong> dengan nilai akhir <strong >".number_format($juara->rata, 3, '.', '')."</strong></div>";
                            }
                           }else{
                                if($user->id_user == 1){
                                    $last = $this->db->query("SELECT *,r.status as rstatus, fullname, AVG(r.score) as rata FROM saw_result r LEFT JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                                    LEFT JOIN saw_users u ON a.id_user = u.id_user 
                                    WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC LIMIT 1")->row();
                                    $dt = array(
                                        'id_event' => $ev,
                                        'id_alternative' => $last->id_alternative
                                    );
                                    $this->db->where($dt);
                                    $this->db->update('saw_result',['top'=>'1']);
                                    $juara = $this->db->query("SELECT *,r.status as rstatus, fullname, AVG(r.score) as rata FROM saw_result r LEFT JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                                    LEFT JOIN saw_users u ON a.id_user = u.id_user 
                                    WHERE r.id_event = '$ev' AND r.top = 1 GROUP BY r.id_alternative ORDER BY rata DESC LIMIT 1")->row();
                                    echo "<div class='alert alert-success' role='alert'>".$eventid->title." adalah <strong>".$juara->fullname."</strong> dengan nilai akhir <strong >".number_format($juara->rata, 3, '.', '')."</strong></div>";
                                        if ($last->rstatus == '0') {
                                        echo "<a href='".base_url()."admin/hasil/publikasi/".$last->id_event."' class='btn btn-sm btn-primary' onclick=\"return confirm('Yakin akan dipublikasi ?')\"><i class='fa fa-globe'></i> Publikasikan</a> ";    
                                      }elseif($last->rstatus == '1'){
                                          echo "<a href='".base_url()."admin/hasil/privasi/".$last->id_event."' class='btn btn-sm btn-danger' onclick=\"return confirm('Yakin akan diprivasi ?')\"><i class='fa fa-globe'></i> Privasi</a>";                                    
                                      }      
                                }else{
                                    $juara = $this->db->query("SELECT *,r.status as rstatus, fullname, AVG(r.score) as rata FROM saw_result r LEFT JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                                    LEFT JOIN saw_users u ON a.id_user = u.id_user 
                                    WHERE r.id_event = '$ev' AND r.top = 1 GROUP BY r.id_alternative ORDER BY rata DESC LIMIT 1")->row();
                                    echo "<div class='alert alert-success' role='alert'>".$eventid->title." adalah <strong>".$juara->fullname."</strong> dengan nilai akhir <strong >".number_format($juara->rata, 3, '.', '')."</strong></div>";
                                }
                               }
                                // echo "<div class='alert alert-success' role='alert'>".$eventid->title." adalah <strong>".$last->fullname."</strong> dengan nilai akhir <strong >".number_format($last->rata, 3, '.', '')."</strong></div>";
                        ?>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
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