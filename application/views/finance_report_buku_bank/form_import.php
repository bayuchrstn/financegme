<input type="hidden" id="id" name="id" />

<div class="row">
    <div class="col-lg-12">
        <label>Bank</label>
        <input type="hidden" name="tipe_upload" id="tipe_upload">
        <select class="form-control" id="id_rek" name="id_rek" onchange="check_bank(this);">
            <option value="0"></option>
            <?php
            $q = $this->m_global->finance_coa_card_name_bank_upload();
            if (!empty($q)) {
                echo $q;
            }
            ?>
        </select>
    </div>
</div>
<br>
<div class="row">
    <label>Upload File Excel :</label>
    <hr>
    <input type="file" name="excel_file" id="excel_file" onchange="upload_file('modal_finance_tax_import','excel_file')" style="display: none">
    <input type="hidden" name="id_confirmed" id="id_confirmed">
    <input type="hidden" name="location_file" id="location_file">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Sheet Name</th>
                <th>Jumlah Data</th>
                <th>Cek Format Data</th>
            </tr>
        </thead>
        <tbody id="import_table"></tbody>
    </table>
</div>