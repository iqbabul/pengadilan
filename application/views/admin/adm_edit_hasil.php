<?php
  error_reporting(0);
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <!-- Content Row -->
    <div class="row">
        <div class="col-12">    
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success"><?=$eventid->title?></h6>
                </div>
                <div class="card-content">
                    <form action="<?=base_url('admin/hasil/simpan_edit')?>" method="post">
                        <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <tr>
                            <th class="align-middle text-center">#</th>
                                <th class="align-middle text-center">Kandidat</th>
                                <?php 
                                $ev = $eventid->id_event;
                                $us = $user->id_user;                                 
                                $pen = $this->db->query("SELECT * FROM saw_result r 
                                        LEFT JOIN saw_users u ON u.id_user = r.id_user 
                                        WHERE id_event = '$ev' GROUP BY r.id_user")->num_rows();
                                $ss = $this->db->query("SELECT * FROM (SELECT fullname, a.id_alternative as idkandidat, r.top as top, AVG(r.score) as rata FROM saw_result r 
                                INNER JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                                INNER JOIN saw_users u ON a.id_user = u.id_user 
                                WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC) AS beres WHERE rata = (
                                SELECT rata FROM ( 
                                SELECT fullname, a.id_alternative as idkandidat, r.top as top, AVG(r.score) as rata FROM saw_result r 
                                INNER JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                                INNER JOIN saw_users u ON a.id_user = u.id_user 
                                WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC) AS hasil GROUP BY rata HAVING COUNT(*) > 1)")->result();?>
                                <th class="align-middle text-center">Nilai Akhir</th>
                            </tr>

                            <?php foreach($ss as $al): ?>
                                <tr>
                                    <td class="text-center">
                                        <input type="hidden" name="idev" value="<?=$ev?>">
                                        <?php if($al->top == '1'):?>
                                        <input type="radio" name="idal" value="<?=$al->idkandidat?>" checked>
                                        <?php else:?>
                                        <input type="radio" name="idal" value="<?=$al->idkandidat?>">
                                        <?php endif;?>
                                    </td>
                                    <td><?=$al->fullname;?></td>
                                    <?php
                                    $rata = 0;
                                    $alter = $al->id_alternative;
                                    $nilai = $this->db->query("SELECT u.fullname as nama, r.score as score FROM saw_result r 
                                    LEFT JOIN saw_users u ON u.id_user = r.id_user 
                                    WHERE id_event = '$ev' AND id_alternative = '$alter'")->result();?>
                                    <?php foreach($nilai as $nilai): ?>
                                    <?php $rata += $nilai->score; endforeach ?>
                                    <td class="text-center"><?=number_format($al->rata, 3, '.', '');?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                      </div> 
                      <?php
                           $last = $this->db->query("SELECT *,r.status as rstatus, fullname, AVG(r.score) as rata FROM saw_result r LEFT JOIN saw_alternatives a ON a.id_alternative=r.id_alternative
                                LEFT JOIN saw_users u ON a.id_user = u.id_user 
                                WHERE r.id_event = '$ev' GROUP BY r.id_alternative ORDER BY rata DESC LIMIT 1")->row();
                            if($user->id_user == 1){
                                if ($last->rstatus == '0') {
                                    echo "<a href='".base_url()."admin/hasil' class='btn btn-sm btn-danger'> Kembali</a> ";    
                                    echo "<button type='submit' class='btn btn-sm btn-success'><i class='fa fa-check'></i> Simpan</button>";    
                                  }     
                            }else{
                                echo "";
                            }
                        ?>  
                    </div>
                    </form>
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