
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h1>Data Sales</h1>
                    </div>
                    <div class="x_content">
                        <table id="idtable" class="display responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                <th style="width:5%">No</th>
                                <th style="width:35%">Nama</th>
                                <th style="width:35%">username</th>
                                <th style="width:35%">No Telepon</th>
                                <th style="width:25%">Aksi</th>
                                <!-- <th>Office</th>
                                <th>Age</th>
                                <th>Start date</th>
                                <th>Salary</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no =1; foreach ($user as $r){?>
                                <tr class="<?= $r->id_user; ?>">
                                    <td><?= $no ?></td>
                                    <td><?= $r->nama ?></td>
                                     <td><?= $r->username ?></td>
                                    <td><?= $r->nohp ?></td>
                                    <td>
                                        <a onclick="hapus_btn(event,<?= $r->id_user ?>)" class="btn btn-round btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        <a href="<?php echo site_url('home/transaksisales/').$r->id_user ?>" class="btn btn-round btn-success"><i class="fa fa-file" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                <?php $no++; } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
   function hapus_btn(e,idt){
       e.preventDefault();
     
      var data =  $("."+idt ).val();
      console.log(data)
     
      $.ajax({
          url:"https://api.thegadeareamalang.com/bpo/index.php/sales/hapus/",
          type: "POST",
          data:{id_user:idt},
          success:function(data){
              if(data.status==="success"){
                  $("."+idt ).remove();
                //   $("#pesan_aksi").html('<div id="pesan" class="alert alert-success"><strong>Berhasil!</strong> Data Telah Terhapus.</div>');
                
                setTimeout(function(){
                    location.reload();
                    $("#pesan").remove();
                },2000)
              }else{
                  $("#pesan_aksi").html(
              '<div id="pesan" class="alert alert-danger"><strong>Warning!</strong> Data Gagal Di hapus.</div>'
            )
              }
          },
          error:(function(xhr,status,t){
              console.log("error woy")
          })
          
      })
   }


</script>

<!-- /page content -->

