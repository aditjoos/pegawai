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
                    <h3><strong>Edit</strong> Riwayat Diklat Penjenjangan </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                    <div class="form-group">
                                        <label class="control-label">Jenis Diklat</label>
                                        <div>
                                            <select class="form-control" id="jns_diklat" name="jns_diklat">
                                                <option value="Diklatpim Tk I-1">Diklatpim Tk I-1</option>
                                                <option value="Diklatpim Tk II-2">Diklatpim Tk II-2</option>
                                                <option value="Diklatpim Tk III-3">Diklatpim Tk III-3</option>
                                                <option value="Diklatpim Tk IV-4">Diklatpim Tk IV-4 atau diklat lain yang setara</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Angkatan</label>
                                        <div>
                                            <input type="text" class="form-control" id="angkatan" name="angkatan" onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                                            value="<?php if(isset($angkatan)){ echo $angkatan;}else{echo "-";} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Penyelenggara</label>
                                        <div>
                                            <input type="text" class="form-control" id="created" name="created"
                                            value="<?php if(isset($penyelenggara)){ echo $penyelenggara;}else{echo "-";} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Mulai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tgl_mulai" name="tgl_mulai"
                                            value="<?php if(isset($tgl_mulai)){echo date('d-m-Y', strtotime($tgl_mulai));}else{echo '-';} ?>">
                                        </div>
                                        <label class="col-lg-3" style="text-align: right; margin-top: 7px;">Tanggal Selesai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tgl_selesai" name="tgl_selesai"
                                            value="<?php if(isset($tgl_selesai)){echo date('d-m-Y', strtotime($tgl_selesai));}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Predikat</label>
                                        <div>
                                            <input type="text" class="form-control" id="predikat" name="predikat"
                                            value="<?php if(isset($predikat)){ echo $predikat;}else{echo "kosong";} ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Lokasi</label>
                                        <div>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi"
                                            value="<?php if(isset($lokasi)){ echo $lokasi;}else{echo "kosong";} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jumlah Jam</label>
                                        <div>
                                            <input type="text" class="form-control" id="jml_jam" name="jml_jam" onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                                            value="<?php if(isset($jml_jam)){ echo $jml_jam;}else{echo "kosong";} ?>">
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
                                    <input type="hidden" id="id_rec" name="id_rec" value="<?php echo $id_rec;?>">
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <img src="<?php if(isset($nama_berkas)){echo $path.'assets/uploads/'.$tbl.'/'.$nama_berkas;}else{echo $path.'assets/img/noimage.jpg';} ?>" class="img-responsive" id="blah">
                            <!-- <img src="<?php echo base_url();?>/assets/img/noimage.jpg" class="img-responsive" id="blah"> -->
                        </div>

                    </div>
                </div>
            </section>

        </div>
    </div>

