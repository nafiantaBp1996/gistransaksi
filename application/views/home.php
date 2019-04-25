<!-- page content -->
<script src="<?php echo base_url(); ?>assets/gentelella/vendors/echarts/dist/echarts.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Dropzone multiple file uploader</h2>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <?php if ($this->session->flashdata('message')==true){ ?>
                  <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php echo $this->session->flashdata('message'); ?> </strong>
                  </div>
                  <?php } ?>
                  <form class="form-horizontal form-label-left" action="<?php echo site_url('index.php/upload/input')?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Produk <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select class="form-control" id="input-produk" name="input-produk">
                                <option value="">Pilih Produk</option>
                                <?php foreach ($produk as $key) { ?>
                                  <option value="<?php echo $key->id_produk ?>"><?php echo $key->nama_produk ?></option>  
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tanggal Tranasaksi <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <fieldset>
                              <div class="control-group">
                                <div class="controls">
                                    <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2" name="tgl-input">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                                    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
                                </div>
                              </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pilih File Excel <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                         <input type="file" name="file" class="form-control col-md-7 col-xs-12" style="border: 0px;background-color:#ffffff;box-shadow: none" />
                      </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Unggah File</button>
                  </form> 
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

