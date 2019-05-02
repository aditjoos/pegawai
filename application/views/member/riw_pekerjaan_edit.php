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
                    <h3><strong>Edit</strong> Riwayat Pekerjaan </h3>
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
                                            <input type="text" class="form-control" id="jabatan" name="jabatan"
                                            value= "<?php if(isset($nm_jabatan)){echo $nm_jabatan;}else{echo '-';} ?>">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 7px;">TMT Jabatan</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tmt_jabatan" name="tmt_jabatan"
                                            value = "<?php if(isset($tmt_jabatan)){echo date("d-m-Y",strtotime($tmt_jabatan));}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tahun Mulai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tahun" id="thn_mulai" name="thn_mulai"
                                            value= "<?php if(isset($thn_mulai)){echo $thn_mulai;}else{echo '-';} ?>">
                                        </div>
                                        <label class="col-lg-3" style="text-align: right; margin-top: 7px;">Sampai Dengan</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tahun" id="thn_selesai" name="thn_selesai"
                                            value= "<?php if(isset($thn_selesai)){echo $thn_selesai;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nomor SK</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control" id="no_sk" name="no_sk"
                                            value= "<?php if(isset($no_sk)){echo $no_sk;}else{echo '-';} ?>">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 7px;">Tanggal SK</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tgl_sk" name="tgl_sk"
                                            value= "<?php if(isset($tgl_sk)){echo date("d-m-Y",strtotime($tgl_sk));}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">NIP Pejabat Penandatangan</label>
                                        <div class="col-lg-4">
                                            <input type="text" class="form-control " id="nip_pejab_baru" name="nip_pejab_baru" onkeyup="this.value=this.value.replace(/[^\d]/,'')" value= "<?php if(isset($nip_pejbaru)){echo $nip_pejbaru;}else{echo '-';} ?>">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 7px;">NIP Lama</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control " id="nip_pejab_lama" name="nip_pejab_lama"
                                            value= "<?php if(isset($nip_pejlama)){echo $nip_pejlama;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Pejabat Penandatangan</label>
                                        <div>
                                            <input type="text" class="form-control" id="nm_pejab" name="nm_pejab"
                                            value= "<?php if(isset($pejabat_sk)){echo $pejabat_sk;}else{echo '-';} ?>">
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
                                            <button class="btn btn-theme" type="submit" id="btn_submit"><i class="fa fa-check"></i> Update</button>
                                            <a class="btn btn-info" href="biodata2">Batal</a>
                                        </div>
                                    </div>
                                    <input type="hidden" id="id_rec" name="id_rec" value="<?php echo $id_rec;?>">
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

