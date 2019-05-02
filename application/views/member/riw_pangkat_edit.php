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
                    <h3><strong>Edit</strong> Riwayat Kepangkatan </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                    <div class="form-group">
                                        <label class="control-label">Golongan / Ruang</label>
                                        <div class="col-lg-4">
                                            <select class="form-control" id="gol" name="gol"></select>
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 7px;">TMT</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tmt_gol" name="tmt_gol" autocomplete="off"
                                            value = "<?php if(isset($tanggal_tmt)){echo $tanggal_tmt; }else{echo "-";} ?>">

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Pejabat</label>
                                        <div>
                                            <input type="text" class="form-control" id="pejab_sk" name="pejab_sk" placeholder="Pejabat Penandatangan SK"
                                            value="<?php if(isset($pejab_sk)){echo $pejab_sk; }else{echo "-";} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor SK</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="no_sk" name="no_sk"
                                            value="<?php if(isset($no_sk)){echo $no_sk; }else{echo "-";} ?>">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 7px;">Tanggal SK</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tgl_sk" name="tgl_sk" autocomplete="off"
                                            value="<?php if(isset($tanggal_sk)){echo $tanggal_sk; }else{echo "-";} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Keterangan</label>
                                        <div>
                                            <input type="text" class="form-control" id="ket" name="ket"
                                            value="<?php if(isset($ket)){echo $ket; }else{echo "-";} ?>">
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
                                                <button class="btn btn-theme" type="submit" id="btn_submit"><i class="fa fa-check"></i> Simpan</button>
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

