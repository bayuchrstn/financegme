<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<span class="title_page_table"><i class="material-icons">&#xE2C7;</i><?php echo $title_page_table ?></span>
<div style="clear:both; background:#ffffff; width:400px; padding:10px;">
    <form id="pencarian" method="post" target="_blank" action="<?php echo base_url().$this->uri->segment(1).'/print_report'; ?>">
    <label>kategori customer</label>
    <select class="form-control" id="searchkategori" name="searchkategori">
    	<option value="0"></option>
        <?php
			$q = $this->finance_report_piutang_by_service->kategori();
			if($q->num_rows() > 0){
				foreach($q->result_array() as $r){
					echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
				}
			}
        ?>
    </select>
    <label>kategori invoice</label>
    <select class="form-control" id="searchkat_inv" name="searchkat_inv">
    	<option value="0"></option>
    	<option value="1">PPN</option>
    	<option value="2">NON PPN</option>
    	<option value="3">MAXI</option>
    	<option value="4">CABANG</option>
    </select>
    <br />
    <button type="submit"><i class="material-icons">&#xE8B6;</i>View Report</button>
    </form>
</div>
