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
                                        <label class="control-label">Jenis Diklat</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->jns_diklat;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Angkatan</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->angkatan;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Penyelenggara</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->penyelenggara;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tanggal Mulai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tahun" disabled value="<?php if(isset($data)){echo $data->tgl_mulai;}else{echo '-';} ?>">
                                        </div>
                                        <label class="col-lg-2" style="text-align: right; margin-top: 5px;">Tanggal Selesai</label>
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control tanggal" disabled value="<?php if(isset($data)){echo $data->tgl_selesai;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Predikat</label>
                                        <div>
                                            <input type="text" class="form-control tanggal" disabled value="<?php if(isset($data)){echo $data->predikat;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Lokasi</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->lokasi;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Jumlah Jam</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->jml_jam;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <img src="<?php echo base_url();?>/assets/<?php if(isset($data)){echo 'uploads/data_dikjenjang/'.$data->nama_berkas;}else{echo 'img/noimage.jpg';} ?>" class="img-responsive" id="blah">
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
                                    <div class="form-group">
                                        <label class="control-label">Kategori</label>
                                        <select class="selectpicker" id="select_kategori" name="jenis_diklat">
                                            <option value='1'> Pengembangan </option>
                                            <option value='2'> Pemberdayaan </option>
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

