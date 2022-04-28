<input type="hidden" id="pageUri" value="<?php echo base_url() . $this->uri->segment(1) . '/'; ?>" />
<span class="title_page_table"><i class="material-icons">&#xE2C7;</i><?php echo $title_page_table ?></span>
<div style="clear:both; background:#ffffff; padding:10px;">
    <form id="pencarian">
        <label>kategori invoice</label>
        <select id="searchkat_inv" name="searchkat_inv" onchange="get_tabel_data();get_data_table_sudah();">
            <option value=""></option>
            <option value="1">Semarang PPN</option>
            <option value="2">Semarang Non PPN</option>
            <option value="3">Salatiga PPN</option>
            <option value="4">Salatiga Non PPN</option>
        </select>
        <label style="margin-left:20px">bulan</label>
        <select id="searchbln_inv" name="searchbln_inv" onchange="get_tabel_data();get_data_table_sudah();">
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
        <label style="margin-left:20px">tahun</label>
        <select id="searchthn_inv" name="searchthn_inv" onchange="get_tabel_data();get_data_table_sudah();">
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020" selected>2020</option>
        </select>
        <label style="margin-left:20px">Sort</label>
        <select id="sorting" name="sorting" onchange="get_tabel_data();get_data_table_sudah();">
            <option value=""></option>
            <option value="1">Nomor Nota</option>
            <option value="2">Nama</option>
        </select>
        <br />
        <input type="checkbox" id="cekall_invoice" /> Pilih Semua
        <button type="button" onclick="approve_invoice()">Approve</button>
    </form>
</div>
<br>
<form id="formulir">
    <div class="row">
        <div class="col-lg-6" id="total_belum"></div>
        <div class="col-lg-6" id="total_sudah"></div>
    </div>
    <div class="row">
        <div class="col-lg-6" id="data_invoice_belum_approve"></div>
        <div class="col-lg-6" id="data_invoice_sudah_approve"></div>
    </div>
</form>

<div class="modal fade" id="modalHeader" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih Header Cetak Invoice</h4>
            </div>
            <form id="formheader">
                <div class="modal-body">
                    <input id="no_invoice" name="no_invoice" type="hidden">
                    <p class="c-black f-500 m-b-20 m-t-20">Pilih header invoice</p>
                    <div class="row" id="pilihhead" style="margin:10px">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="set_head();">Cetak</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>