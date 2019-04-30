<?php
	$path = base_url();
	if(isset($biodata)){
		//var_dump(json_decode($biodata));
		$data = json_decode($biodata);
	}

?>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading bg-inverse">
                    <h3><strong>Tambah</strong> Riwayat Kepangkatan </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                    <div class="form-group">
                                        <label class="control-label">Golongan / Ruang</label>
                                        <div class="col-lg-6">
                                            <input type="text" class="form-control" id="no_sk" name="no_sk">
                                        </div>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tmt" name="tmt">
                                            <span class="help-block">TMT Golongan Ruang</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Golongan / Ruang</label>
                                        <div>
                                            <select class="form-control" id="gol_ruang" name="gol_ruang"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">TMT Golongan Ruang</label>
                                        <div>
                                            <input type="text" class="form-control tanggal" id="tmt" name="tmt">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Pejabat Penandatangan</label>
                                        <div>
                                            <input type="text" class="form-control" id="pejab_sk" name="pejab_sk">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor SK</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="no_sk" name="no_sk">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 7px;">Tanggal SK</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tgl_sk" name="tgl_sk">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Keterangan</label>
                                        <div>
                                            <input type="text" class="form-control" id="ket" name="ket">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="control-label" for="exampleInputFile" >Upload Berkas</label>
                                            <div>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="input-group">
                                                        <div class="form-control uneditable-input" data-trigger="fileinput">
                                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                                            <span class="fileinput-filename"></span>
                                                        </div>
                                                        <span class="input-group-addon btn btn-inverse btn-file">
                                                            <span class="fileinput-new">Pilih File</span>
                                                            <span class="fileinput-exists">Ubah</span>
                                                            <input type="file" name="file_image" id="file_image">
                                                        </span>
                                                        <a href="#" class="input-group-addon  btn btn-default fileinput-exists" data-dismiss="fileinput">Hapus</a>
                                                    </div>
                                                </div><!-- //fileinput-->
                                            </div>
                                    </div>
                                    <div class="form-group offset">
                                            <div>
                                                    <button class="btn btn-theme" type="submit"><i class="fa fa-check"></i> Simpan</button>
                                                    <a class="btn btn-info" href="biodata2">Batal</a>
                                            </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <img src="<?php echo base_url();?>/assets/img/noimage.jpg" class="img-responsive" id="blah">
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>

