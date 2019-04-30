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
                    <h3><strong>Tambah</strong> Riwayat Jabatan Fungsional </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                    <div class="form-group">
                                        <label class="control-label">Eselon</label>
                                        <div class="col-lg-2">
                                            <select class="form-control" id="eselon" name="eselon">
                                                <option value="">-</option>
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                                <option value="IV">IV</option>
                                            </select>
                                        </div>
                                        <label class="col-lg-3" style="text-align: right; margin-top: 7px;">Nama Jabatan</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="jabatan" name="jabatan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Jabatan</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control tanggal" id="unitkerja" name="unitkerja">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 7px;">TMT Jabatan</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tmt" name="tmt">
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
                                        <label class="control-label">Pejabat Penandatangan</label>
                                        <div>
                                            <input type="text" class="form-control" id="pejab_sk" name="pejab_sk">
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
                            <img src="<?php if(isset($nama_berkas)){echo $path.'assets/uploads/'.$tbl.'/'.$nama_berkas;}else{echo $path.'assets/img/noimage.jpg';} ?>" class="img-responsive" id="blah">
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>

