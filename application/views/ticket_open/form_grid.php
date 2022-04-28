<input type="hidden" id="id" name="id" />
<input type="hidden" id="up_default" name="up_default" />
<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6">
            <label for="lokasi">lokasi</label>
            <select class="form-control" id="lokasi" name="lokasi" onchange="get_detail_lokasi(this.value, 0);">
                <option value=""></option>
                <option value="1">CUSTOMER</option>
                <option value="2">PRE CUSTOMER</option>
                <option value="3">BTS</option>
            </select>
            </div>
            <div class="col-lg-6">
            <label for="ref_id">nama</label>
            <select class="form-control select-search" id="ref_id" name="ref_id">
            </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="subject">subject</label>
            <input class="form-control" type="text" id="subject" name="subject" />
        </div>
        
        <div class="form-group">
            <label for="report">report</label>
            <textarea class="form-control" id="report" name="report"></textarea>
        </div>
        
        <div class="form-group">
            <label><strong>question</strong></label>
            <select class="form-control" id="question" name="question" onchange="change_question(this.value)">
                <option value=""></option>
                <?php
                    $q = $this->m_global->gmd_ticket_question_type();
                    if($q->num_rows() > 0){
                        foreach($q->result_array() as $r){
                            echo '<option value="'.$r['id'].'">'.$r['nama'].'</option>';
                        }
                    }
                ?>
            </select>
        </div>
	
    <div id="detail_question"></div>
    
        <div class="row">
            <div class="col-lg-6">
            <label for="status">status</label>
            <select class="form-control" id="status" name="status">
                <option value=""></option>
                <option value="1">OPEN</option>
                <option value="3">CLOSED</option>
            </select>
            </div>
            <div class="col-lg-6">
            <label for="type">type</label>
            <select class="form-control" id="type" name="type">
                <option value=""></option>
                <option value="1">GANGGUAN</option>
                <option value="2">PERMINTAAN</option>
            </select>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6">
            <label for="priority">priority</label>
            <select class="form-control" id="priority" name="priority">
                <option value=""></option>
                <option value="1">LOW</option>
                <option value="2">MEDIUM</option>
                <option value="3">HIGH</option>
            </select>
            </div>
            <div class="col-lg-6">
            <label for="forwarded">forward</label>
            <select class="form-control" id="forwarded" name="forwarded">
                <option value=""></option>
                <option value="1">HELP DESK</option>
            </select>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <label for="comment_line">komentar</label>
        <ul id="timeline" class="media-list chat-stacked content-group" style="height:300px; overflow-y: scroll;"></ul>
        <input class="form-control" type="text" id="comment_line" name="comment_line" />
    </div>
</div>