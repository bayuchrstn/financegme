<head>
    <title> Cetak Invoice</title>
    <style>
        html {
            font: 400 14px/17px "Helvetica Neue", Helvetica, Arial, sans-serif;
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
            font-size: 11px;
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


        .table>thead>tr>th,
        .table>tbody>tr>th,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>tbody>tr>td,
        .table>tfoot>tr>td {
            padding: 5px;
            border-top: 1px solid black;
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
                <h1 style="margin-left:20px;margin-bottom:0px;height:50px"><img class="i-logo" style="height:50px;" src="./assets/invoice/img/msd.png" alt="">&nbsp;
                </h1>
            </div>
            <div style="width:49%;display:inline-block;text-align:right;">
                <h1 style="margin-bottom:0px">INVOICE</h1>
            </div>
            <?php
            foreach ($isi as $row) {
                $nama_invoice = $row['nama'];
                if (!empty($row['kota'])) {
                    $alamat_cust = $row['alamat'] . ' , ' . $row['kota'];
                } else {
                    $alamat_cust = $row['alamat'];
                }
                $attention = $row['attention'];
                $cust_id = $row['cust_id'];
                $no_invoice = $row['nomor'];
                $date_invoice = $row['tanggal_invoice'];
                $date_due = $row['due_date'];
            } ?>
            <hr style="margin-top:0px;border:1px solid black;">
            <div style="width:76%;display:inline-block;margin-bottom: 10px">
                <h3 style="margin-top:5px;margin-bottom:0px">
                    To : <?= strtoupper($nama_invoice); ?>
                    <!-- To : BALAI PENGKAJIAN TEKNOLOGI PERTANIAN JAWA TENGAH -->
                </h3>
                <?= $alamat_cust; ?>
                <!-- Jl. Soekarno Hatta KM 28 No. 10, Bergas Kab. Semarang, Jawa Tengah -->
                <br />
                Attention : <?= $attention; ?>
                <!-- Attention : Margono -->
            </div>
            <div style="width:23%;display:inline-block;vertical-align:top;">
                <div class="text-right">
                    <h5><b>CUST. ID : <?= $cust_id; ?></b></h5>
                </div>
            </div>
        </div>
        <small>
            <table width="100%" class="table">
                <tbody>
                    <tr style="font-size: 11px">
                        <td colspan="2" class="c-black" style="border-right:1px black solid;border-left:1px black solid;">
                            <center>INVOICE NUMBER<br /><?= strtoupper($no_invoice); ?></center>
                        </td>
                        <td colspan="3" class="c-black" style="border-right:1px black solid;">
                            <center>DATE<br /><?= $this->Kamus_model->tanggal_indo($date_invoice, 1); ?></center>
                        </td>
                        <td colspan="4" style="border-right:1px black solid;" class="c-black">
                            <center>DUE DATE<br /><?= $this->Kamus_model->tanggal_indo($date_due, 1); ?></center>
                        </td>
                    </tr>
                    <tr>
                        <td style="border-left:1px white solid;" colspan="2"></td>
                        <td colspan="3"></td>
                        <td style="border-right:1px white solid;" colspan="4"></td>
                    </tr>

                    <tr>
                        <td class="c-black borderleft" style="text-align:center;width:10px;padding:5px"><b>NO</b></td>
                        <td class="borderleft c-black" style="text-align:center;width:260px;"><b>DESCRIPTION</b></td>
                        <td class="borderleft c-black" style="text-align:center;width:70px;padding:3px"><b>SERVICE ID</b></td>
                        <td class="borderleft c-black" style="text-align:center;width:25px;padding:3px"><b>QTY</b></td>
                        <td class="borderleft c-black" style="text-align:center;width:25px;padding:3px"><b>CUR</b></td>
                        <td colspan="2" class="borderleft c-black" style="text-align:center;padding:5px"><b>UNIT PRICE</b></td>
                        <td colspan="2" class="borderleft c-black" style="text-align:center;border-right:1px black solid;padding:5px">
                            <b>TOTAL
                                PRICE</b></td>
                    </tr>

                    <?php $no = 1;
                    $grand = 0;
                    $total = 0;
                    $materai = 0;
                    $bayar = 0;
                    $ppn = 0;
                    foreach ($isi as $row) {
                        if ($row['jenis_transaksi'] == "BI") {
                            $grand = $grand + $row['nominal'];
                            $total = $total + $row['nominal'];
                            echo '<tr>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">' . $no . '</h4>
                            </td>
                            <td class="borderleft" style="vertical-align:middle;padding-left:5px">
                                <h4 class="f-400" style="margin:0px;">' . $row['detail'] . '
                            </td>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;"></h4>
                            </td>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">1</h4>
                            </td>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">IDR</h4>
                            </td>
                            <td class="borderleft text-left" style="vertical-align:middle;">
                                Rp
                            </td>
                            <td class="text-right" style="vertical-align:middle;">
                            ' . number_format($row['nominal'], 0) . '
                            </td>
                            <td class="borderleft text-left" style="vertical-align:middle;">
                                Rp
                            </td>
                            <td class="borderright text-right" style="vertical-align:middle;">
                            ' . number_format($row['nominal'], 0) . '
                            </td>
                        </tr>';
                            $no++;
                        }
                        if ($row['jenis_transaksi'] == "LG") {
                            $grand = $grand + $row['nominal'];
                            $total = $total + $row['nominal'];
                            echo '<tr>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">' . $no . '</h4>
                            </td>
                            <td class="borderleft" style="vertical-align:middle;padding-left:5px">
                            <h4 class="f-400" style="margin:0px;">' . $row['detail'] . ' ' . $row['keterangan'] . '<br /> Periode ' . $this->Kamus_model->tanggal_indo($row['periode_dari'], 1) . ' s.d. ' . $this->Kamus_model->tanggal_indo($row['periode_sampai'], 1) . '
                            </td>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">' . $row['servid'] . '</h4>
                            </td>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">1</h4>
                            </td>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">IDR</h4>
                            </td>
                            <td class="borderleft text-left" style="vertical-align:middle;">
                                Rp
                            </td>
                            <td class="text-right" style="vertical-align:middle;">
                            ' . number_format($row['nominal'], 0) . '
                            </td>
                            <td class="borderleft text-left" style="vertical-align:middle;">
                                Rp
                            </td>
                            <td class="borderright text-right" style="vertical-align:middle;">
                            ' . number_format($row['nominal'], 0) . '
                            </td>
                        </tr>';
                            $no++;
                        }
                        if ($row['jenis_transaksi'] == "LL") {
                            $grand = $grand + $row['nominal'];
                            $total = $total + $row['nominal'];
                            echo '<tr>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">' . $no . '</h4>
                            </td>
                            <td class="borderleft" style="vertical-align:middle;padding-left:5px">
                            <h4 class="f-400" style="margin:0px;">' . $row['detail'] . '
                            </td>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">' . $row['servid'] . '</h4>
                            </td>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">1</h4>
                            </td>
                            <td class="borderleft" style="text-align:center;">
                                <h4 class="f-400" style="margin:0px;">IDR</h4>
                            </td>
                            <td class="borderleft text-left" style="vertical-align:middle;">
                                Rp
                            </td>
                            <td class="text-right" style="vertical-align:middle;">
                            ' . number_format($row['nominal'], 0) . '
                            </td>
                            <td class="borderleft text-left" style="vertical-align:middle;">
                                Rp
                            </td>
                            <td class="borderright text-right" style="vertical-align:middle;">
                            ' . number_format($row['nominal'], 0) . '
                            </td>
                        </tr>';
                            $no++;
                        }
                        if ($row['jenis_transaksi'] == "PN") {
                            $grand = $grand + $row['nominal'];
                            $ppn = $ppn + $row['nominal'];
                        }
                        if ($row['jenis_transaksi'] == "MT") {
                            $materai = $materai + $row['nominal'];
                            if ($materai >= 6000) {
                                $materai = 6000;
                            }
                        }
                        if ($row['jenis_transaksi'] == "DP") {
                            $grand = $grand - $row['nominal'];
                            $bayar = $bayar + $row['nominal'];
                        }
                    }
                    $grand = $grand + $materai;
                    ?>

                    <tr>
                        <?php if (!empty($materai) && !empty($bayar)) { ?>
                            <td colspan="5" style="vertical-align:bottom;border-left:1px black solid;border-bottom:1px black solid;" rowspan="5">
                                <b>Terbilang / In Words </b>: <b>
                                    <h4 class="t-uppercase f-800" style="margin-top:5px;margin-bottom:0px"><b>#
                                            <?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?>
                                            RUPIAH #</b></h4>
                                </b>
                            </td>
                        <?php } else if (!empty($materai) || !empty($bayar)) { ?>
                            <td colspan="5" style="vertical-align:bottom;border-left:1px black solid;border-bottom:1px black solid;" rowspan="4">
                                <b>Terbilang / In Words </b>: <b>
                                    <h4 class="t-uppercase f-800" style="margin-top:5px;margin-bottom:0px"><b>#
                                            <?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?>
                                            RUPIAH #</b></h4>
                                </b>
                            </td>
                        <?php } else { ?>
                            <td colspan="5" style="vertical-align:bottom;border-left:1px black solid;border-bottom:1px black solid;" rowspan="3">
                                <b>Terbilang / In Words </b>: <b>
                                    <h4 class="t-uppercase f-800" style="margin-top:5px;margin-bottom:0px"><b>#
                                            <?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?>
                                            RUPIAH #</b></h4>
                                </b>
                            </td>
                        <?php } ?>
                        <td colspan="2" class="borderleft" style="text-align:center;">
                            <h4 class="t-uppercase f-400" style="margin:0px"><b>AMOUNT</b></h4>
                        </td>
                        <td class="borderleft  text-left" style="vertical-align:middle;">
                            <b>Rp</b></td>
                        <td class=" borderright text-right" style="vertical-align:middle;">
                            <b><?= number_format($total, 0) ?></b></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="borderleft" style="text-align:center;">
                            <h4 class="t-uppercase f-400" style="margin:0px;"><b>PPN </b></h4>
                        </td>
                        <td class="borderleft  text-left" style="vertical-align:middle;">
                            <b>Rp</b></td>
                        <td class=" borderright text-right" style="vertical-align:middle;">
                            <b><?= number_format($ppn, 0) ?></b></td>
                    </tr>
                    <?php if (!empty($materai)) {
                        echo  '<tr>
                        <td colspan="2" class="borderleft" style="text-align:center;">
                            <h4 class="t-uppercase f-400" style="margin:0px;"><b>STAMP DUTY FEE</b></h4>
                        </td>
                        <td class="borderleft  text-left" style="vertical-align:middle;">
                            <b>Rp</b></td>
                        <td class=" borderright text-right" style="vertical-align:middle;">
                            <b>' . number_format($materai, 0) . '</b></td>
                    </tr>';
                    } ?>
                    <?php if (!empty($bayar)) {
                        echo  '<tr>
                        <td colspan="2" class="borderleft" style="text-align:center;">
                            <h4 class="t-uppercase f-400" style="margin:0px;"><b>DOWN PAYMENT</b></h4>
                        </td>
                        <td class="borderleft  text-left" style="vertical-align:middle;">
                            <b>Rp</b></td>
                        <td class=" borderright text-right" style="vertical-align:middle;">
                            <b>- ' . number_format($bayar, 0) . '</b></td>
                    </tr>';
                    } ?>
                    <tr>
                        <td colspan="2" class="borderleft borderbottom" style="text-align:center;">
                            <h4 class="t-uppercase f-400" style="margin:0px;"><b>PAY THIS AMOUNT</b></h4>
                        </td>
                        <td class="borderleft borderbottom text-left" style="vertical-align:middle;">
                            <b>Rp</b></td>
                        <td class=" borderright borderbottom text-right" style="vertical-align:middle;">
                            <b><?= number_format($grand, 0) ?></b></td>
                    </tr>
                </tbody>
            </table>
        </small>
        <div>
            <small>
                <div style="width:100%;display:inline-block;">
                    <h4 style="font-size: 12px;
                line-height: 16px;font-weight: 400;margin:0;">Please make payment to : </h4>
                    <span>
                        <center>
                            <table style="border:0;">
                                <tbody>
                                    <tr>
                                        <td style="padding:0px;"><b>Account Bank</b> </td>
                                        <td style="text-align:center;padding:0px;width:170px"> : </td>
                                        <td style="padding:0px;"><b>Bank BCA Jend. Sudirman Yogyakarta</b> </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0px;"><b>Account Name</b> </td>
                                        <td style="text-align:center;padding:0px;"> : </td>
                                        <td style="padding:0px;"><b>PT. Media Sarana Data</b> </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:0px;"><b> Account No</b> </td>
                                        <td style="text-align:center;padding:0px;"> : </td>
                                        <td style="padding:0px;"><b>037-7799899</b> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </center>
                    </span>
                    <br />
                    <div class="i-to">
                        <div class="text-justify">
                            <center>
                                <div class="i-to">
                                    <span>
                                        <address style="font-size: 11px">
                                            Note : Please send your confirmation transfer payment to : <br /><b>Fax :
                                                024-8509696 or email : finance.smg@gmedia.co.id </b><br />Sebutkan nomor
                                            tagihan pada pembayaran/<i>please notify bill number on payment</i><br />Tagihan
                                            ini berlaku sebagai tanda terima yang sah stelah pembayaran diterima/<br /><i>this
                                                invoice can be treated as official receipt upon acceptance of payment</i>
                                        </address>
                                    </span>
                                    <b>** <u>Please transfer in full amount</u></b>
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </small>
        </div>
        <div class="tandatangan">
            <h5 class="f-400" style="margin:0px;">
                <center>Approved by :</center><br /><br /><br /><br /><br /><br />
                <center><u><b>Priyo Suyono</b></u><br />( Director )<br /></center>
            </h5>
        </div>
    </div>
</div>