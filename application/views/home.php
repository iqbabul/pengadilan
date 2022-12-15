<?php
  error_reporting(0);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Pengadilan Negeri Batang</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
  </head>

  <body style="color: black;">

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-success">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?=base_url()?>">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?=base_url('login')?>">Login <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container mt-5">
          <h1 class="">Pengadilan Negeri Batang</h1>
          <p>Jl. Slamet Riyadi No.05, Kauman, Kec. Batang, Kabupaten Batang, Jawa Tengah 51215</p>
        </div>
      </div>

      <div class="container" style="color: black;">
        <!-- Example row of columns -->
        <div class="row">
        <div class="col-12">    
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Pegawai Teladan</h6>
                </div>
                <div class="card-content">
                    <div class="card-body">
                    <form action="<?=base_url('welcome')?>" method="post">
                        <select class="form-control" name="event" onchange="this.form.submit()">
                        <option value="">- Pilih -</option>
                        <?php foreach($event as $ev):?>
                        <?php if($ev->id_event == $eventid->id_event):?>
                        <option value="<?=$ev->id_event;?>" selected>
                        <?=$ev->title?>
                        <?php if($ev->status == 0): ?>
                        (<span class='text-success'>Tidak Aktif</span>)
                        <?php elseif($ev->status == 1):?> 
                        (<span class='text-success'>Aktif</span>)
                        <?php elseif($ev->status == 2):?> 
                        (<span class='text-success'>Selesai</span>)
                        <?php endif ?> 
                        </option>
                        <?php else:?>
                        <option value="<?=$ev->id_event;?>"><?=$ev->title?>
                        <?php if($ev->status == 0): ?>
                        (<span class='text-success'>Tidak Aktif</span>)
                        <?php elseif($ev->status == 1):?> 
                        (<span class='text-success'>Aktif</span>)
                        <?php elseif($ev->status == 2):?> 
                        (<span class='text-success'>Selesai</span>)
                        <?php endif ?> 
                        </option>
                        <?php endif?>
                        <?php endforeach; ?>
                        </select>
                    </form>

                        <div class="table-responsive mt-3">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <tr>
                                <th rowspan="2" class="align-middle text-center">Kandidat</th>
                                <?php 
                                $ev = $eventid->id_event;
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

        <hr>

      </div> <!-- /container -->

    </main>

    <footer class="container">
      <p> Pengadilan Negeri Batang &copy; 2022</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
