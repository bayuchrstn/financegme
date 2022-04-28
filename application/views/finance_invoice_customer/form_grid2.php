<div class="row">
    <div class="col-lg-6">
        <label>Tipe Invoice</label>
        <select class="form-control" id="tipe_inv" name="tipe_inv">
            <option value="0">Layanan</option>
            <option value="1">Project</option>
        </select>
    </div>
    <div class="col-lg-6">
        <label>Customer</label>
        <input type="hidden" id="customer_inv" name="customer_inv" />
        <select class="form-control" id="service_inv" name="service_inv"></select>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>Attention</label>
        <input class="form-control" type="text" id="nama_att" name="nama_att" />
    </div>
    <div class="col-lg-6">
        <label>Phone</label>
        <input class="form-control" type="number" id="phone_inv" name="phone_inv" />
    </div>
</div>

<div class="row" style="margin-top:30px;">
    <div class="col-lg-6">
        <label>No Invoice <em style="color:#006600;">(Jika kosong maka akan di create otomatis)</em></label>
        <input class="form-control" type="text" id="no_invoicebaru" name="no_invoicebaru" />
    </div>
    <div class="col-lg-6">
        <label>Region</label>
        <select class="form-control" id="reg_inv" name="region">
            <option value="3">Semarang</option>
            <option value="7">Salatiga</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>Tanggal Invoice</label>
        <input class="form-control date_picker" type="text" id="date_inv" name="date_inv" />
    </div>
    <div class="col-lg-6">
        <label>Tanggal Jatuh Tempo</label>
        <input class="form-control date_picker" type="text" id="date_due_inv" name="date_due_inv" />
    </div>
</div>

<div class="row">
    <table id="tabelDetailInvoice2" class="tabel_report" cellpadding="0" cellspacing="0" width="100%" style="margin-top:50px;">
        <thead>
            <tr>
                <td style="border:0; vertical-align:middle;">
                    <select class="form-control" type="text" style="width:270px;" id="sel_tambah_service_produk2" /></select><br />
                    <input class="form-control" type="text" style="width:270px;" id="tambah_service_produk2" placeholder="Tambah Non Layanan" /></td>
                <td style="border:0; vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="tambah_bw2" /></td>
                <td style="border:0; vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="tambah_instalasi2" /></td>
                <td style="border:0; vertical-align:middle;"><input class="form-control price" type="text" style="width:100px;" id="tambah_lain22" /></td>
                <td style="border:0; vertical-align:middle;"><input type="text" class="form-control date_picker" id="tambah_period2" name="tambah_period" /></td>
                <td style="border:0; vertical-align:middle;"><a href="#" id="tambahDetailInvoice2"><i class="material-icons">&#xE147;</i></a></td>
            </tr>
            <tr>
                <th valign="top"><strong>Description</strong></th>
                <th valign="top" width="10"><strong>bandwidth</strong></th>
                <th valign="top" width="10"><strong>instalasi</strong></th>
                <th valign="top" width="10"><strong>lain2</strong></th>
                <th valign="top" width="10"><strong>periode</strong></th>
                <th valign="top" width="10">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr>

                <td valign="top"><input class="form-control" type="text" style="width:270px;" id="service_produk2" name="service_produk" /></td>
                <td valign="top"><input class="form-control price" type="text" style="width:100px;" id="bw2" name="bw" onkeyup="count_harga2()" onblur="count_harga2()" /></td>
                <td valign="top"><input class="form-control price" type="text" style="width:100px;" id="instalasi2" name="instalasi" onkeyup="count_harga2()" onblur="count_harga2()" /></td>
                <td valign="top"><input class="form-control price" type="text" style="width:100px;" id="lain22" name="lain2" onkeyup="count_harga2()" onblur="count_harga2()" /></td>
                <td valign="top"><input class="form-control date_picker" type="text" style="width:150px;" id="period2" name="period" onchange="to_periode2()" /></td>
                <td valign="top" style="middle;display:none"><input class="form-control" type="text" style="width:150px;" hidden="true" id="tgl_awal2" name="tgl_awal" /></td>
                <td>&nbsp;</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>potongan</label><br />
        <select class="form-control" id="jenis_potongan2" name="jenis_potongan" style="display:inline; width:120px;">
            <option value="0">Diskon</option>
            <option value="1">Potongan</option>
        </select>
        <input class="form-control price" type="text" id="potongan2" name="potongan" onkeyup="count_harga2()" onblur="count_harga2()" style="display:inline; width:295px;" />
    </div>
    <div class="col-lg-6">
        <label>PPN</label>
        <input class="form-control price" type="text" id="ppnnya2" name="ppnnya" onkeyup="count_harga2()" onblur="count_harga2()" />
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>total tagihan</label>
        <input class="form-control price" type="text" id="total_tagihan2" name="total_tagihan" readonly />
    </div>
</div>