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
                    <h3><strong>Edit</strong> Riwayat Pendidikan </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form action="<?php echo $path?>Member/riw_edu_add_function" class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                    <div class="form-group">
                                        <label class="control-label">Tingkat Pendidikan</label>
                                        <div>
                                            <select class="form-control" id="edu" name="edu"></select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Sekolah / Univ.</label>
                                        <div>
                                            <input type="text" class="form-control" id="sekolah" name="sekolah"
                                            value="<?php if(isset($nm_sekolah)){echo $nm_sekolah;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jurusan / Prodi</label>
                                        <div>
                                            <input type="text" class="form-control" id="prodi" name="prodi"
                                            value="<?php if(isset($jurusan)){echo $jurusan;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tahun Masuk</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tahun" id="tahun" name="tahun"
                                            value="<?php if(isset($thn_masuk)){echo $thn_masuk;}else{echo '-';} ?>">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 5px;">Tanggal Lulus</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" id="tanggal" name="tanggal"
                                            value="<?php if(isset($thn_lulus)){echo date('d-m-Y',strtotime($thn_lulus));}else{echo '-';} ?>">
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
                                            <input type="text" class="form-control" id="lokasi" name="lokasi"
                                            value="<?php if(isset($lokasi)){echo $lokasi;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">No. Ijazah</label>
                                        <div>
                                            <input type="text" class="form-control" id="ijasah" name="ijasah"
                                            value="<?php if(isset($no_ijazah)){echo $no_ijazah;}else{echo '-';} ?>">

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

