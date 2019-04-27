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
                    <h3><strong>Approve</strong> Ajuan Data Pegawai </h3>
                    <label class="color"><strong><?php echo $this->session->userdata('nama'); ?></strong></label>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form>
                                <table class="table table-striped" id="table-example">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID Card</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Nama Ajuan</th>
                                            <th class="text-center">Tanggal Ajuan</th>
                                            <th class="text-center">Status Ajuan</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody align="center" id="ls_ajuan_dik_fung"></tbody>
                                </table>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </section>
        </div>
    </div>

