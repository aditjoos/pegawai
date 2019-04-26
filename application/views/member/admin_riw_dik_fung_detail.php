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
                                        <label class="control-label">Nama Diklat</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->nama_diklat;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Tempat Belajar</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->tmp_belajar;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Lokasi</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->lokasi;}else{echo '-';} ?>">
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
                                        <label class="control-label">Jumlah Jam</label>
                                        <div>
                                            <input type="text" class="form-control tanggal" disabled value="<?php if(isset($data)){echo $data->jml_jam;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Penyelenggara</label>
                                        <div>
                                            <input type="text" class="form-control" disabled value="<?php if(isset($data)){echo $data->penyelenggara;}else{echo '-';} ?>">
                                        </div>
                                    </div>
                                </form>
                                <div class="form-group offset">
                                    <div>
                                        <form action="<?php echo $path; ?>member/update_ajuan/2/<?php if(isset($data)){echo $data->no;}else{echo '-';} ?>" class="form-horizontal" method="POST" id="upload_form" enctype="multipart/form-data" data-collabel="3" data-alignlabel="left">
                                            <a class="btn btn-info" href="<?php echo base_url();?>member/admin_riw_dik_fung">Batal</a>
                                            <select class="selectpicker" id="select_status" name="status_ajuan">
                                                <?php foreach($option as $option){ ?>
                                                    <option value="<?php echo $option['id']; ?>"><?php echo $option['deskripsi']; ?></option>
                                                <?php } ?>
                                            </select>
                                            <select class="selectpicker" id="select_kategori" name="">
                                                <option value=''> Pilih Kategori </option>
                                            </select>
                                            <button class="btn btn-theme" href="#!"><i class="fa fa-check"></i> Approve</button>
                                        </form>
                                    </div>
                                </div>
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

