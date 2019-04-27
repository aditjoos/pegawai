<?php
	$path = base_url();
	if(isset($detail)){
		//var_dump(json_decode($biodata));
        $data = json_decode($detail);
        // echo "<script>console.log($data);</script>";
    }
    
    if(isset($select_option)){
        $data_option = json_encode($select_option);
        $option = json_decode($data_option, true);
	}

?>
    
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading bg-inverse">
                <h3><strong>Approve</strong> Riwayat Diklat Fungsional Pegawai </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label">Tingkat Pendidikan</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->tingkat_pend;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nama Sekolah</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->nama_sekolah;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jurusan</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->jurusan;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Masuk</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tahun" disabled value="<?php if(isset($data)){echo $data->thn_masuk;}else{echo '-';} ?>">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 5px;">Tanggal Lulus</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" disabled value="<?php if(isset($data)){echo $data->thn_lulus;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tempat Belajar</label>
                                        <div>
                                            <input type="text" class="form-control tanggal" disabled value="<?php if(isset($data)){echo $data->tmp_belajar;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Lokasi</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->lokasi;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">No Ijazah</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->no_ijazah;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <img src="<?php echo base_url();?>/assets/<?php if(isset($data)){echo 'uploads/data_dikteknis/'.$data->nama_berkas;}else{echo 'img/noimage.jpg';} ?>" class="img-responsive" id="blah">
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel-body">
                                <form action="<?php echo $path; ?>member/update_ajuan/<?php echo $this->uri->segment(4) ?>/<?php if(isset($data)){echo $data->no;}else{echo '-';} ?>" class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                    <div class="form-group">
                                        <label class="control-label">Keterangan</label>
                                        <div>
                                            <input type="text" class="form-control" name="keterangan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select class="selectpicker" id="select_status" name="status_ajuan">
                                            <?php foreach($option as $option){ ?>
                                                <option value="<?php echo $option['id']; ?>"><?php echo $option['deskripsi']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <a class="btn btn-info" href="<?php echo base_url();?>member/admin_ajuan_pegawai">Batal</a>
                                    <button class="btn btn-theme" href="#!"><i class="fa fa-check"></i> Approve</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

