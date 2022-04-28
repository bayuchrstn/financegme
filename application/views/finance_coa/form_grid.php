<input type="hidden" id="id" name="id" />
<input type="hidden" id="number_lama" name="number_lama" />
<input type="hidden" id="tukar" name="tukar" />

<div class="row">
    <div class="col-lg-12">
        <label>parent</label>
        <select class="form-control" id="parent" name="parent" onchange="get_number_type(this.value)">
            <option value=""></option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label>account number</label><br />
        <input class="form-control" type="text" id="group_type" name="group_type" readonly="readonly" style="width:50px; display:inline;" maxlength="1" /> - 
    	<input class="form-control" type="text" id="number" name="number" style="width:150px; display:inline;" maxlength="5" />
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <label>nama</label>
    	<input class="form-control" type="text" id="nama" name="nama" />
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <label>saldo awal</label>
        <input class="form-control price_decimal" type="text" id="saldo" name="saldo" />
    </div>
    <div class="col-lg-3">
        <label>tanggal saldo</label>
        <input class="form-control date_picker" type="text" id="tanggal" name="tanggal" />
    </div>
    <div class="col-lg-3">
        <label>level</label>
        <select class="form-control" id="level" name="level">
            <option value=""></option>
            <option value="0">Header</option>
            <option value="1">Level 1</option>
            <option value="2">Level 2</option>
            <option value="3">Level 3</option>
        </select>
    </div>
</div>
