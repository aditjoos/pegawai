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
                    <h3><strong>Tambah</strong> Riwayat Pekerjaan </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                    <div class="form-group">
                                        <label class="control-label">Nama Jabatan</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="pejabat" name="pejabat">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 7px;">TMT Jabatan</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tmt" name="tmt">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tahun Mulai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tahun" id="unitkerja" name="unitkerja">
                                        </div>
                                        <label class="col-lg-3" style="text-align: right; margin-top: 7px;">Sampai Dengan</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tahun" id="tmt" name="tmt">
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
                                        <label class="control-label">NIP Pejabat Penandatangan</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control " id="nip_pejab" name="nip_pejab" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 7px;">NIP Lama</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control " id="nip_pejab_lama" name="nip_pejab_lama">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Pejabat Penandatangan</label>
                                        <div>
                                            <input type="text" class="form-control" id="nm_pejab" name="nm_pejab">
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
                                                    <button class="btn">Batal</button>
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

