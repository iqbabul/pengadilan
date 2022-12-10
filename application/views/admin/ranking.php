<?php
  error_reporting(0);
?>
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
    <?php if($eventid->status == 1): ?>
        <?php if($cek <= 0):?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <p class="card-text">
                            Anda harus mengisi form penilaian terlebih dahulu klik <a href="<?=base_url('admin/penilaian')?>">di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php else: ?> 
        <?php $this->load->view('admin/table_ranking');?>
        <?php endif; ?>
    <?php else: ?>
        <?php if($cek <= 0):?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger" role="alert">
                        <p class="card-text">
                        Anda tidak termasuk dalam tim penilai pada acara ini
                        </p>
                    </div>
                </div>
            </div>
        <?php else: ?> 
        <?php $this->load->view('admin/table_ranking');?>
        <?php endif; ?>
    <?php endif ?>
</div>
<!-- /.container-fluid -->
