<input type="hidden" id="pageUri" value="<?php echo base_url().$this->uri->segment(1).'/'; ?>" />
<div class="panel panel-white">
    <div class="panel-heading">
        <h6 class="panel-title"><?php echo $title_page_table ?></h6>
        <div class="heading-elements">
        <form id="formsearch" onSubmit="return false;">   
            <div class="input-group">
                    <div class="input-group-btn" style="text-align:right;">
                        <button id="button_dropdown_search" type="button" class="btn dropdown-toggle btn-icon btn-default btn-raised" data-toggle="dropdown">
                        <span class="caret"></span> <i class="icon-search4"></i>
                        </button>
            
                        <ul class="dropdown-menu dropdown-content dropdown-menu-right" style="width:400px;">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                    <label>dari tanggal</label>
                                    <input type="text" class="form-control date_picker" id="searchDateTransFirst" name="searchDateTransFirst" readonly="readonly" value="<?php echo date('Y-m-01') ?>"/> 
                                    </div>
                                    <div class="col-lg-6">
                                    <label>sampai tanggal</label>
                                    <input type="text" class="form-control date_picker" id="searchDateTransFinish" name="searchDateTransFinish" readonly="readonly" value="<?php echo date('Y-m-t') ?>"/><br />
                                    </div>
                                </div>
                                <div class="row">
                                    <label>Marketing</label>
                                    <select class="form-control" id="search_marketing" name="search_marketing" >
                                    	<option value="0">All</option>
                                        <?php
                                            $q = $this->m_global->gmd_user_by_sub_dep('sub_dept_sales');
                                            if($q->num_rows() > 0){
                                                foreach($q->result_array() as $r){
                                                    echo '<option value="'.$r['id'].'">'.$r['name'].'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <label>jenis</label>
                                    <select class="form-control" id="searchjenis" name="searchjenis" >
										<?php
                                        $kat = $this->m_global->data_master('marketing_progress_category');
                                        if($kat->num_rows() > 0){
                                            foreach($kat->result_array() as $r){
                                                echo '<option value="'.$r['code'].'">'.$r['name'].'</option>';
                                            }
                                        }
                                        $kat->free_result();
                                        ?>
                                    </select>
                                </div>
                                <br />
                                <div class="row" style="text-align:right;">
                                    <button id="buttonPencarian" type="button" class="btn btn-default btn-raised"><b><i class="icon-search4"></i> Search</b></button>
                                </div>
                            </div>
                        </ul>
                    </div>
            </div>
        </form>
        </div>
    </div>

    <table id="datamain_datatable" class="table datatable-ajax table-striped table-xxs table-bordered">
        <thead>
            <tr>
                <th>no</th>
                <th>tanggal</th>
                <th>marketing</th>
                <th>judul</th>
                <th>customer</th>
            </tr>
        </thead>
    </table>
</div>	
