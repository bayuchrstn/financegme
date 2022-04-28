<input type="hidden" id="id" name="id" />

<div class="row">
    <div class="col-lg-6">
        <label>kode jurnal</label><br />
        <div class="col-lg-6" style="padding: 0px">
            <select class="form-control" id="kat_gl" name="kat_gl" style="display:inline;">
                <option value=""></option>
                <?php
                $q = $this->m_global->finance_master_kat_gl();
                if ($q->num_rows() > 0) {
                    foreach ($q->result_array() as $r) {
                        echo '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>
        <div class="col-lg-6" style="padding: 0px;padding-left:5px">
            <input class="form-control" type="text" id="jurnal_group" name="jurnal_group" style="display:inline;" readonly />
        </div>
    </div>
    <div class="col-lg-6">
        <label>debet</label>
        <input class="form-control" type="text" id="debet" name="debet" readonly style="text-align:right;" />
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>tanggal jurnal</label>
        <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" />
    </div>
    <div class="col-lg-6">
        <label>kredit</label>
        <input class="form-control" type="text" id="kredit" name="kredit" readonly style="text-align:right;" />
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>deskripsi jurnal</label>
        <input class="form-control" type="text" id="deskripsi" name="deskripsi" />
    </div>
    <div class="col-lg-6">
        <label>out of balance</label>
        <input class="form-control" type="text" id="out_of_balance" name="out_of_balance" readonly style="text-align:right;" />
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>divisi</label><br />
        <select class="form-control" id="divisi" name="divisi">
            <option value=""></option>
            <option value="0">Lain-lain</option>
            <?php
            $q = $this->m_global->gmd_finance_master_divisi();
            if ($q->num_rows() > 0) {
                foreach ($q->result_array() as $r) {
                    echo '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
                }
            }
            ?>
        </select>
    </div>
    <!-- <div class="col-lg-6">
        <label>memo jurnal</label>
        <input class="form-control" type="text" id="tambah_description" />
    </div> -->
    <div class="col-lg-6">
        <label>no referensi</label>
        <input class="form-control" type="text" id="no_referensi" name="no_referensi" />
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <label>PPN</label>
        <select class="form-control" id="ppn" name="ppn">
            <option value="0">Lain-lain</option>
            <option value="1">Ya</option>
            <option value="2">Tidak</option>
        </select>
    </div>
    <div class="col-lg-3">
        <label>project</label>
        <select class="form-control" id="project" name="project">
            <option value="0">Lain-lain</option>
            <?php
            $q = $this->m_global->gmd_finance_project();
            if ($q->num_rows() > 0) {
                foreach ($q->result_array() as $r) {
                    echo '<option value="' . $r['id'] . '">' . $r['nama'] . '</option>';
                }
            }
            ?>
        </select>
    </div>

</div>

<div class="row">
    <table id="tabelDetailInvoice" class="tabel_report" border="1" cellpadding="0" cellspacing="0" width="100%" style="margin-top:50px;">
        <thead>
            <tr>
                <td style="border:0; vertical-align:middle;"><input class="form-control" type="hidden" id="tambah_account_id" />
                    <input class="form-control" type="text" style="width:90px;" id="tambah_account_no" /></td>
                <td style="border:0; vertical-align:middle;"><input class="form-control" type="text" style="width:150px;" id="tambah_account_name" readonly /></td>
                <td style="border:0; vertical-align:middle;"><input class="form-control" type="hidden" id="tambah_pra_gl_card_name" />
                    <select class="form-control" id="tambah_pra_gl_card" style="width:300px;" onchange="select_card_name(this.value)">
                        <option value=""></option>
                        <option value="0">No card</option>
                    </select></td>
                <td style="border:0; vertical-align:middle;"><input class="form-control" type="text" id="tambah_description" /></td>
                <td style="border:0; vertical-align:middle;"><input class="form-control price_decimal" type="text" style="width:150px;" id="tambah_debet" /></td>
                <td style="border:0; vertical-align:middle;"><input class="form-control price_decimal" type="text" style="width:150px;" id="tambah_kredit" /></td>
                <td style="border:0; vertical-align:middle;"><a href="#" id="tambahDetailInvoice"><i class="material-icons">&#xE147;</i></a></td>
            </tr>
            <tr>
                <th valign="top" width="10"><strong>account id</strong></th>
                <th valign="top" width="10"><strong>account name</strong></th>
                <th valign="top" width="10"><strong>card name</strong></th>
                <th valign="top"><strong>memo</strong></th>
                <th valign="top" width="10"><strong>debet</strong></th>
                <th valign="top" width="10"><strong>kredit</strong></th>
                <th valign="top" width="10">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>