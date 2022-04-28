<input type="hidden" id="id" name="id" />
<input type="hidden" id="task_id" name="task_id" />

<div class="row">
    <label for="nama">judul</label>
    <input class="form-control" type="text" id="subject" name="subject" readonly="readonly" />
</div>

<div class="row">
        <div class="col-lg-6">
        <label>waktu mulai</label>
        <input class="form-control datetime_picker" type="text" id="date_start" name="date_start" readonly="readonly" />
        </div>
        <div class="col-lg-6">
        <label>waktu selesai</label>
        <input class="form-control datetime_picker" type="text" id="date_due" name="date_due" readonly="readonly" />
        </div>
</div>

<div class="row">
	<div class="col-lg-6">
    <input type="hidden" id="location_id" name="location_id" />
    <label>pelanggan</label>
    <input class="form-control" type="text" id="pelanggan" name="pelanggan" readonly="readonly" />
	</div>
	<div class="col-lg-6">
    <label>service id</label>
    <input class="form-control" type="text" id="service_id" name="service_id" readonly="readonly" />
	</div>
</div>

<div class="row">
    <label for="pesan">laporan</label>
    <textarea class="form-control" id="laporan" name="laporan" rows="3" readonly="readonly" ></textarea>
</div>

<div class="row">
    <label for="pesan">analisa</label>
    <textarea class="form-control" id="analisa" name="analisa" rows="3" ></textarea>
</div>

<div class="row">
    <label for="pesan">tindakan</label>
    <textarea class="form-control" id="tindakan" name="tindakan" rows="3" ></textarea>
</div>

<div class="row">
	<div class="col-lg-8">
    <label>problem</label>
    <select class="form-control" id="problem_cat" name="problem_cat">
    	<option value=""></option>
        <?php
            $q = $this->m_global->master_noc_cat_problem();
            if($q->num_rows() > 0){
                foreach($q->result_array() as $r){
                    echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
                }
            }
        ?>
    </select>
	</div>
	<div class="col-lg-4">
    <label>source</label>
    <select class="form-control" id="problem_side" name="problem_side">
    	<option value=""></option>
    	<option value="1">Internal</option>
    	<option value="2">External</option>
    </select>
	</div>
</div>

<div class="row">
	<div class="col-lg-4">
    <label>status</label>
    <select class="form-control" id="status_laporan" name="status_laporan">
    	<option value="0">Open</option>
    	<option value="1">On Progress</option>
    	<option value="2">Monitoring</option>
    	<option value="3">Close</option>
    </select>
	</div>
	<div class="col-lg-4">
    <label>solve</label>
    <select class="form-control" id="solve" name="solve">
    	<option value=""></option>
    	<option value="Y">Ya</option>
    	<option value="N">Tidak</option>
    </select>
	</div>
	<div class="col-lg-4">
    <label>sla</label>
    <select class="form-control" id="sla" name="sla">
    	<option value=""></option>
    	<option value="Y">Ya</option>
    	<option value="N">Tidak</option>
    </select>
	</div>
</div>

