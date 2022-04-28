<input type="hidden" id="id" name="id" />

<div class="row">
    <div class="col-lg-4">
        <label>No Invoice</label>
        <input type="hidden" id="service_id" name="service_id">
        <input type="hidden" id="id_order" name="id_order">
        <input class="form-control" type="text" id="service_id_val" name="service_id_val" readonly>
    </div>
    <div class="col-lg-4">
        <label>ID Customer</label>
        <input type="hidden" id="id_cust" name="id_cust" />
        <input class="form-control" type="text" id="customer_id" name="customer_id" readonly />
    </div>
    <div class="col-lg-4">
        <label>Nama Customer</label>
        <input class="form-control" type="text" id="nama_cust" name="nama_cust" readonly />
    </div>
</div>
<div class="row">
    <div class="col-lg-4">
        <label>Nama Site</label>
        <input type="hidden" id="site_id" name="site_id" />
        <input class="form-control" type="text" id="nama_site" name="nama_site" readonly />
    </div>
    <div class="col-lg-4 alamat">
        <label>Alamat</label>
        <select class="form-control" type="text" id="alamat" name="alamat">
        </select>
    </div>
    <div class="col-lg-4">
        <label>NPWP</label>
        <input class="form-control" type="text" id="npwp" name="npwp" />
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
        <label>Attention</label>
        <input type="hidden" id="id_contact" name="id_contact" readonly />
        <input class="form-control" type="text" id="attention" name="attention" />
    </div>
    <div class="col-lg-3">
        <label>Phone</label>
        <input class="form-control" type="text" id="phone" name="phone" />
    </div>
    <div class="col-lg-3">
        <label>Email</label>
        <input class="form-control" type="text" id="email" name="email" />
    </div>
    <div class="col-lg-3">
        <label>Service ID</label>
        <input class="form-control" type="text" id="servid" readonly />
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>tanggal invoice</label>
        <input class="form-control date_picker" type="text" id="tanggal_invoice" name="tanggal_invoice" />
    </div>
    <div class="col-lg-6">
        <label>tanggal jatuh tempo</label>
        <input class="form-control date_picker" type="text" id="due_date" name="due_date" />
    </div>
</div>

<div class="row" style="margin-top:20px;">
    <div class="col-lg-6">
        <label>periode dari</label>
        <input class="form-control date_picker" type="text" id="periode_dari" name="periode_dari" />
    </div>
    <div class="col-lg-6">
        <label>periode sampai</label>
        <input class="form-control date_picker" type="text" id="periode_sampai" name="periode_sampai" />
    </div>
</div>

<div class="row">
    <table id="tabelDetailInvoice" class="tabel_report" cellpadding="0" cellspacing="0" width="100%" style="margin-top:50px;">
        <thead>
            <tr>
                <td style="border:0; vertical-align:middle;width:100px">
                    <select class="form-control" type="text" id="pilih_tambah" />
                    <option value="LG">Layanan</option>
                    <option value="MT">Materai</option>
                    <option value="BI">Instalasi</option>
                    <option value="LL">Lain-Lain</option>
                    </select>
                </td>
                <td style="border:0; vertical-align:middle;width:200px"><select class="form-control" type="text" id="sel_tambah_service_produk" /></td>
                <td style="border:0; vertical-align:middle;width:200px"><input class="form-control" type="text" id="tambah_note" /></td>
                <td style="border:0; vertical-align:middle;"><input class="form-control price_decimal" type="text" id="tambah_jumlah" /></td>
                <td style="border:0; vertical-align:middle;"><a href="#" id="tambahDetailInvoice"><i class="material-icons">&#xE147;</i></a></td>
            </tr>
            <tr>
                <th valign="top" colspan="2"><strong>Description</strong></th>
                <th valign="top"><strong>Note</strong></th>
                <th valign="top" width="10"><strong>Jumlah</strong></th>
                <th valign="top" width="10">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- 
                <td valign="top"><input class="form-control" type="text" style="width:270px;" id="service_produk" name="service_produk" /></td>
                <td valign="top"><input class="form-control price" type="text" style="width:100px;" id="bw" name="bw" onkeyup="count_harga()" onblur="count_harga()" /></td>
                <td valign="top"><input class="form-control price" type="text" style="width:100px;" id="instalasi" name="instalasi" onkeyup="count_harga()" onblur="count_harga()" /></td>
                <td valign="top"><input class="form-control price" type="text" style="width:100px;" id="lain2" name="lain2" onkeyup="count_harga()" onblur="count_harga()" /></td>
                <td valign="top"><input class="form-control date_picker" type="text" style="width:150px;" id="period" name="period" onchange="to_periode()" /></td>
                <td valign="top" style="middle;display:none"><input class="form-control" type="text" style="width:150px;" hidden="true" id="tgl_awal" name="tgl_awal" /></td>
                <td>&nbsp;</td> -->
            </tr>
        </tbody>
    </table>
</div>
<br>
<div class="row">
    <!-- <div class="col-lg-6">
        <label>potongan</label><br />
        <select class="form-control" id="jenis_potongan" name="jenis_potongan" style="display:inline; width:120px;">
            <option value="0">Diskon</option>
            <option value="1">Potongan</option>
        </select>
        <input class="form-control price" type="text" id="potongan" name="potongan" onkeyup="count_harga()" onblur="count_harga()" style="display:inline; width:295px;" />
    </div> -->
    <div class="col-lg-4">
        <label>PPN</label>
        <input class="form-control text-right" type="text" id="ppnnya" name="ppnnya" />
    </div>
</div>

<div class="row">
    <div class="col-lg-4">
        <label>total tagihan</label>
        <input class="form-control price_decimal" id="total_tagihan" name="total_tagihan" readonly="readonly" />
    </div>
</div>