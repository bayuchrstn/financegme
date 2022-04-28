<head>
    <title> Cetak Invoice</title>
    <style>
        html {
            font: 400 14px/12px "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        b,
        strong {
            font-weight: 750;
            font-size: 12px;
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            font-size: 10px;
            font-family: sans-serif;
            border-spacing: 0px;
            font-weight: 400;
        }

        .clearfix {
            content: "";
            display: table
        }

        .text-left {
            text-align: left
        }

        .text-right {
            text-align: right
        }

        .text-center {
            text-align: center
        }

        .text-justify {
            text-align: justify
        }

        .text-muted {
            font-size: 14px;
            color: #777
        }

        th {
            text-align: left
        }

        .bgm-blue {
            background-color: #2196f3 !important
        }

        .p-0 {
            padding: 0 !important
        }

        .p-5 {
            padding: 5px !important
        }

        .p-10 {
            padding: 10px !important
        }

        .p-15 {
            padding: 15px !important
        }

        .f-300 {
            font-weight: 300 !important
        }

        .f-400 {
            font-weight: 400 !important
        }

        .f-500 {
            font-weight: 500 !important
        }

        .f-700 {
            font-weight: 700 !important
        }

        address {
            margin-bottom: 5px;
            font-style: normal;
            font-size: 14px
        }

        .brd-2 {
            border-radius: 2px
        }

        .c-white {
            color: #fff !important
        }

        .c-black {
            color: #000 !important
        }

        table {
            font-size: 10px;
        }

        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 5px;
            border-top: 1px solid black;
            font-size: 10px;
        }

        .borderleft {
            border-left: 1px solid black;
        }

        .borderright {
            border-right: 1px solid black;
        }

        .borderbottom {
            border-bottom: 1px solid black;
        }

        .tandatangan {
            margin-left: 230px;
        }
    </style>
</head>
<div style="page-break-after : always;">
    <div class="invoice">
        <div>
            <div style="width:50%;display:inline-block;">
                <h1 style="margin-left:20px;margin-bottom:0px;height:60px"><img class="i-logo" style="height:60px;" alt="">&nbsp;
                </h1>
            </div>
            <div style="width:49%;float:right;text-align:right;">
                <h1 style="padding-top:35px;margin-bottom:0px;">INVOICE</h1>
            </div>
            <hr style="margin-top:0px;border:1px solid black;">
        </div>
        <?php foreach ($detail as $row) {
            $nama_invoice = $row->nama;
            if (!empty($row->kota)) {
                $alamat_cust = $row->alamat . ' , ' . $row->kota;
            } else {
                $alamat_cust = $row->alamat;
            }
            $attention = $row->attention;
            $cust_id = $row->cust_id;
            $no_invoice = $row->nomor;
            $date_invoice = $row->tanggal_invoice;
            $date_due = $row->due_date;
            $serv_id = $row->servid;
            $telp = $row->phone;
            $periode = $this->Kamus_model->make_period($row->periode_dari, $row->periode_sampai);
            if (empty($row->periode_dari) || empty($row->periode_sampai)) {
                $periode = '-';
            }
        } ?>
        <div>
            <div style="width:49%;display:inline-block;">
                <h5 style="margin-bottom:10px">DATA CUSTOMER</h5>
            </div>
            <div style="width:50%;display:inline-block;text-align:right;">
                <h5 style="margin-bottom:10px">DATA INVOICE</h5>
            </div>
        </div>
        <div>
            <div style="width:46%;display:inline-block;padding-left:5px">
                <table style="border:0;">
                    <tr>
                        <td style="text-align:left;">CUST ID </td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td><?= $cust_id ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">SERV ID </td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td><?= $serv_id ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">NAME </td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td><?= $nama_invoice ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">ADDRESS</td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td><?= $alamat_cust ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">ATTENTION </td>
                        <td style="width:30px;text-align:center;"> : </td>
                        <td><?= $attention ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:left;">PHONE </td>
                        <td style="width:30px;text-align:center;"> : </td>
                        <td><?= $telp ?></td>
                    </tr>
                </table>
            </div>
            <div style="width:52%;display:inline-block;">
                <table style="border:0;width:100%;">
                    <tr>
                        <td style="text-align:right;width: 200px;">NO </td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td style="text-align:right;"><?= $no_invoice ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">NO BAA </td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td style="text-align:right;"></td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">DATE</td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td style="text-align:right;"><?= $date_invoice ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">DUE DATE </td>
                        <td style="width:30px;text-align:center;"> : </td>
                        <td style="text-align:right;"><?= $date_due ?></td>
                    </tr>
                    <tr>
                        <td style="text-align:right;">PERIODE </td>
                        <td style="width:30px;text-align:center;"> : </td>
                        <td style="text-align:right;"><?= $periode ?>
                        </td>
                    </tr>
                    <tr>
                        <td><br></td>
                    </tr>
                </table>
            </div>
        </div>
        <table class="table">
            <thead class="t-uppercase">
                <tr>
                    <th class="c-gray borderleft" style="text-align:center">DESCRIPTION</th>
                    <th class="c-gray">NOTE</th>
                    <th class="c-gray borderright" style="text-align:right">TOTAL PRICE</th>
                </tr>
            </thead>

            <tbody>
                <?php $ppn = $grand = $total = $materai = 0;
                foreach ($detail as $row) {
                    if ($row->jenis_transaksi == "BJ") {
                        $grand = $grand + $row->nominal;
                        $total = $total + $row->nominal;
                        echo '<tr>
                            <td class="borderleft" style="padding: 10px 5px">
                                ' . $row->detail . '
                            </td>
                            <td></td>
                            <td class="borderright" style="vertical-align:middle;">
                                <div class="text-right">Rp ' . number_format($row->nominal, 0) . ',-</div>
                            </td>
                        </tr>';
                    }
                    if ($row->jenis_transaksi == "BR") {
                        $grand = $grand + $row->nominal;
                        $total = $total + $row->nominal;
                        $q = $this->db->query("SELECT
                        h.`nama_barang`,b.`qty`,COALESCE(b.`harga`,0) AS harga
                      FROM
                        erp_gmedia.`transaksi` a
                        JOIN erp_gmedia.`order_barang` b
                          ON a.`id_order` = b.`id_order`
                       JOIN inventory_v2.`ms_header_barang` h
                      ON b.`id_barang`=h.`id_header`
                      WHERE a.`nomor` = '" . $no_invoice . "' AND b.`status`=1
                      GROUP BY b.`id`")->result();
                        $hrg_barang = 0;
                        foreach ($q as $sow) {
                            if (empty($sow->harga)) {
                                $hrg_barang = 0;
                            } else {
                                $hrg_barang = $sow->qty * $sow->harga;
                            }
                            echo '<tr>
                            <td class="borderleft" style="padding: 10px 5px">
                                - ' . $sow->nama_barang . '
                            </td>
                            <td>' . $sow->qty . ' pc(s)</td>
                            <td class="borderright" style="vertical-align:middle;">
                                <div class="text-right">Rp ' . number_format($hrg_barang, 0) . ',-</div>
                            </td>
                        </tr>';
                        }
                    }
                    if ($row->jenis_transaksi == "PN") {
                        $grand = $grand + $row->nominal;
                        $ppn = $row->nominal;
                    }
                    if ($row->jenis_transaksi == "MB" || $row->jenis_transaksi == "MT") {
                        $grand = $grand + $row->nominal;
                        $materai = $row->nominal;
                    }
                } ?>
                <?php if (!empty($ppn) && !empty($materai)) { ?>
                    <tr>
                        <td class="borderleft borderbottom" style="vertical-align:bottom;" rowspan="4">
                            Terbilang : <h4 class="t-uppercase f-500">
                                <b><?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?></b></h4>
                        </td>
                    <?php } else if (!empty($ppn) || !empty($materai)) { ?>
                    <tr>
                        <td class="borderleft borderbottom" style="vertical-align:bottom;" rowspan="3">
                            Terbilang : <h4 class="t-uppercase f-500">
                                <b><?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?></b></h4>
                        </td>
                    <?php } else { ?>
                    <tr>
                        <td class="borderleft borderbottom" style="vertical-align:bottom;" rowspan="4">
                            Terbilang : <h4 class="t-uppercase f-500">
                                <b><?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?></b></h4>
                        </td>
                    <?php } ?>
                    <td class="borderleft" style="vertical-align:middle;text-align: right;padding:10px">
                        AMOUNT
                    </td>
                    <td class="borderright" style="vertical-align:middle;text-align: right;padding:10px">
                        <div class="text-right">Rp <?= number_format($total, 0) ?>,-</div>
                    </td>
                    </tr>

                    <?php if (!empty($ppn)) {
                        echo '<tr>
                    <td class="borderleft" style="vertical-align:middle;text-align: right;padding:10px">
                        PPN
                    </td>
                    <td class="borderright" style="vertical-align:middle;">
                        <div class="text-right">Rp ' . number_format($ppn, 0) . ',-</div>
                    </td>
                </tr>';
                    } ?>
                    <?php if (!empty($materai)) {
                        echo '<tr>
                    <td class="borderleft" style="vertical-align:middle;text-align: right;padding:10px">
                        <div class="text-right">MATERAI</div>
                    </td>
                    <td class="borderright" style="vertical-align:middle;">
                        <div class="text-right">Rp ' . number_format($materai, 0) . ',-</div>
                    </td>
                </tr>';
                    } ?>

                    <tr>
                        <td class="borderleft borderbottom" style="vertical-align:middle;text-align: right;padding:10px">
                            <div class="text-right">TOTAL AMOUNT</div>
                        </td>
                        <td class="borderright borderbottom" style="vertical-align:middle;">
                            <div class="text-right">Rp <?= number_format($grand, 0) ?>,-</div>
                        </td>
                    </tr>
            </tbody>
        </table>


        <div>
            <div style="width:45%;display:inline-block;">
                <h5 style="margin-top:0px;padding-top:0px">Please make payment to :</h5>
                <table style="font-size: 12px">
                    <tr>
                        <td>Account Bank</td>
                        <td>:</td>
                        <td>BCA Jend. Sudirman Yogyakarta</td>
                    </tr>
                    <tr>
                        <td>Account No</td>
                        <td>:</td>
                        <td>037-7799899</td>
                    </tr>
                    <tr>
                        <td>Account Name</td>
                        <td>:</td>
                        <td>PT. Media Sarana Data</td>
                    </tr>
                </table>
                <br><br>
            </div>
            <div style="width:54%;display:inline-block;">
                <h5 style="margin-top:10px;padding-top:10px">Note :</h5>
                <div class="text-justify">
                    <span>
                        <small>
                            Please send your confirmation transfer payment to : <br>Fax : 024-8509696 or email :
                            finance.smg@gmedia.co.id <br>This invoice can be treated as official receipt upon acceptance
                            of payment (Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran
                            diterima)</small><br>
                        <b>** Please transfer in full amount</b>
                    </span>
                </div>
            </div>
        </div>
        <div>
            <table style="border: 0;width:100%;">
                <tr>
                    <td style="width:100%;">
                        <center>
                            <h4>Approved by :</h4>
                        </center>
                    </td>
                </tr>
                <tr>
                    <td><br><br></td>
                </tr>
                <tr>
                    <td><br><br></td>
                </tr>
                <tr>
                    <td>
                        <center>
                            <h4>Priyo Suyono<br>( Operational Director )</h4>
                        </center>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>