<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bobot & Kriteria</h1>
    </div>
    <!-- Content Row -->
    <div class="row">
    <div class="col-12">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-success">Data Alternatif</h6>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Atribut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($kriteria as $row): ?>
                                <tr>
                                    <td><?=$no++;?></td>
                                    <td><?=$row->criteria;?></td>
                                    <td><?=$row->weight;?></td>
                                    <td><?=$row->attribute;?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
<!-- /.container-fluid -->
<script>
  $(function() {
    var flashData = $('.flash-data').data('flashdata');
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    if (flashData) {
      toastr.success('Data berhasil '+flashData+'.')
    }
    //tombol-hapus
    $('.tombol-hapus').on('click', function(e){
      e.preventDefault(); // mematikan aksi default
      var href = $(this).attr('href');
      Swal.fire({
        title: 'Peringatan!',
        text: "Apakah ingin menghapus data ini?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.value) {
          document.location.href = href;
        }
      });
    });     
  });    
</script>