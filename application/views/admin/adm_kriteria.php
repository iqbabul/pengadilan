<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kriteria</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#exampleModal">Tambah Kriteria</a>        
    </div>
    <div class="flash-data" data-flashdata="<?=$this->session->flashdata('alert');?>"></div>      

    <!-- Content Row -->
    <div class="row">
      <div class="col-12">
        
        <div class="card shadow mb-4">
            <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-success">Data Kriteria</h6>
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
                                    <th colspan="2" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $jml=0; $no=1; foreach($kriteria as $row): ?>
                                <tr>
                                    <td><?=$no++;?></td>
                                    <td><?=$row->criteria;?></td>
                                    <td class="text-center"><?=$row->weight;?></td>
                                    <td><?=$row->attribute;?></td>
                                    <td>
                                    <button class="btn btn-sm btn-circle btn-primary"><i class="fas fa-edit"></i></button>
                                    </td>
                                    <td>
                                        <a href="<?=base_url();?>admin/data/hapus_kriteria/<?=$row->id_criteria;?>" class="btn btn-sm btn-circle btn-danger tombol-hapus"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                <?php $jml+=$row->weight; endforeach; ?>
                                <tr>
                                  <td colspan="2" class="text-center">Jumlah</td>
                                  <td class="text-center"><?=$jml;?></td>
                                  <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php if($jml != 1):?>
                          <div class="alert alert-danger" role="alert">
                          <i class="fas fa-exclamation-triangle"></i> Jumlah Bobot Harus 1
                        </div>
                        <?php else: ?>
                          <div class="alert alert-success" role="alert">
                          <i class="fas fa-check"></i> Jumlah Bobot Sesuai
                        </div>
                        <?php endif; ?>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
<!-- /.container-fluid -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kriteria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="<?=base_url('admin/data/simpan_kriteria')?> ">
        <div class="modal-body">        
          <div class="form-group">
            <label for="exampleInputEmail1">Kriteria</label>
            <input type="text" name="kriteria" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Nilai</label>
            <input type="text" name="nilai" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="exampleFormControlFile1">Atribut</label>
            <select name="atribut" id="" class="form-control">
              <option value="benefit">Benefit</option>
              <option value="cost">Cost</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-success">Simpan</button>
        </div>
      </form>      
    </div>
  </div>
</div>
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