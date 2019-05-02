<?php
	$path = base_url();
	if(isset($konten)){
		$data = json_decode($konten);
	}

?>


    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading bg-inverse">
                    <h3><strong>Edit</strong> Riwayat Diklat Fungsional </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                    <div class="form-group">
                                        <label class="control-label">Nama Diklat</label>
                                        <div>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php if(isset($nm_diklat)){ echo $nm_diklat;}else{echo "kosong";} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tempat Belajar</label>
                                        <div>
                                            <select class="form-control" id="belajar" name="belajar">
                                                <option value="Dalam Negeri">Dalam Negeri</option>
                                                <option value="Luar Negeri">Luar Negeri</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Lokasi</label>
                                        <div>
                                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?php if(isset($lokasi)){echo $lokasi;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Mulai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tgl_mulai" name="tgl_mulai" autocomplete="off"
                                            value="<?php if(isset($tgl_mulai)){echo date('d-m-Y', strtotime($tgl_mulai));}else{echo '-';} ?>">
                                        </div>
                                        <label class="col-lg-3" style="text-align: right; margin-top: 7px;">Tanggal Selesai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tgl_selesai" name="tgl_selesai" autocomplete="off"
                                            value="<?php if(isset($tgl_selesai)){echo date('d-m-Y', strtotime($tgl_selesai));}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jumlah Jam</label>
                                        <div>
                                            <input type="text" class="form-control" id="jml_jam" name="jml_jam" onkeyup="this.value=this.value.replace(/[^\d]/,'')"
                                            value="<?php if(isset($jml_jam)){echo $jml_jam;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Penyelenggara</label>
                                        <div>
                                            <input type="text" class="form-control" id="created" name="created"
                                            value="<?php if(isset($penyelenggara)){echo $penyelenggara;}else{echo '-';} ?>">
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

    <input type="hidden" id="line" value="<?php echo base_url();?>">