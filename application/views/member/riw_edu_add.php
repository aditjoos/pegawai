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
                    <h3><strong>Tambah</strong> Riwayat Pendidian </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                    <div class="form-group">
                                        <label class="control-label">Tingkat Pendidikan</label>
                                        <div>
                                            <select class="form-control" id="edu" name="edu"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Sekolah / Univ.</label>
                                        <div>
                                            <input type="text" class="form-control" id="sekolah" name="sekolah">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jurusan / Prodi</label>
                                        <div>
                                            <input type="text" class="form-control" id="prodi" name="prodi">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tahun Masuk</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tahun" id="tahun" name="tahun">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 5px;">Tanggal Lulus</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tanggal" name="tanggal">
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
                                            <input type="text" class="form-control" id="lokasi" name="lokasi">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">No. Ijasah</label>
                                        <div>
                                            <input type="text" class="form-control" id="ijasah" name="ijasah">
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

