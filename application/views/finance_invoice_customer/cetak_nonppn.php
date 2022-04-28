<!-- CSS -->

<head>
    <title> Cetak Invoice</title>
    <style>
        .invoice2 {
            font: 400 14px/17px "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        b {
            font-weight: 750;
            font-size: 12px;
        }

        .table3 {
            margin-bottom: 20px;
            border-collapse: collapse;
            font-size: 12px;
            font-family: sans-serif;
            border-spacing: 0px;
            font-weight: 400;
            display: table;
            vertical-align: middle;
            border: 1px solid black;
            margin: 0px;
        }

        .table4 {
            border-collapse: collapse;
            font-size: 12px;
            font-family: sans-serif;
            border-spacing: 0px;
            line-height: 1.2;
            border: 1px solid black;
            margin: 0px;
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

        .f-800 {
            font-weight: 800 !important
        }

        .m-0 {
            margin: 0px !important;
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


        .bgm-navy {
            background-color: #062C54 !important;
        }

        .navytd {
            background-color: #062C54 !important;
            color: white !important;
        }

        .terbilang {
            margin-left: 0px;
            margin-right: 0px;
            margin-top: 10px !important;
            margin-bottom: 15px !important;
        }

        /* h5,
    h4 {
        font-size: 14px;
    } */


        .table3>thead>tr>th,
        .table3>tbody>tr>th,
        .table3>tfoot>tr>th,
        .table3>thead>tr>td,
        .table3>tbody>tr>td,
        .table3>tfoot>tr>td {
            border-top: 1px solid black;
            padding: 5px;
            table-layout: fixed;
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

        @media print {
            .mutih {
                color: white !important;
                font-weight: bold !important;
            }

            tr {
                -webkit-print-color-adjust: exact;
            }

            .bgm-navy {
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<div style="page-break-after : always;">
    <div class="invoice2">
        <div style=width:50%;display:inline-block;>
            <div style="height:65px;"><img class="i-logo" style="height:55px;" alt="">&nbsp;</div>
        </div>
        <div style="width:49%;float:right;text-align:right;padding-bottom:10px">
            <h1>INVOICE</h1>
        </div>
        <br><br>
        <hr style="margin-top:0px;border:1px solid black;">
        <div style="width:100%;display:inline-block">
            <div style="padding-left:15px">
                <b>CUSTOMER</b>
            </div>
        </div>
        <br>
        <?php
        foreach ($isi as $row) {

            if (!empty($row['kota'])) {
                $alamat_cust = $row['alamat'] . ' , ' . $row['kota'];
            } else {
                $alamat_cust = $row['alamat'];
            }

            $nilai_voucher = $voucher = null;
            if (!empty($row['voucher'])) {
                $voucher = $row['voucher'];
            }
            if (!empty($row['nilai_voucher'])) {
                $nilai_voucher = $row['nilai_voucher'];
            }
            $attention = $row['attention'];
            $cust_id = $row['cust_id'];
            $no_invoice = $row['nomor'];
            $date_invoice = $row['tanggal_invoice'];
            $date_due = $row['due_date'];
            $nama_invoice = $row['nama'];
            $no_telp = $row['phone'];
            $periode =  $this->Kamus_model->tanggal_indo($row['periode_dari'], 1) . ' s.d. ' . $this->Kamus_model->tanggal_indo($row['periode_sampai'], 1);
        } ?>
        <!-- datapelanggan dan invoice -->
        <div style="width:100%;padding-top:5px;clear:both;">
            <div style="width:50%;border-radius:15px;border:1px solid black;float:left;height:110px">
                <table class="table4" style="border:0;width:100%;padding-left:5px;padding-bottom:10px;padding-top:5px;min-height:110px">
                    <tr>
                        <td style="width: 60px"><b>NAME</b></td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td>
                            <h4 class="text-left f-400" style="margin:0px"><?= strtoupper($nama_invoice); ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60px"><b>ADDRESS</b></td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td>
                            <h4 class="text-left f-400" style="margin:0px"><?= $alamat_cust ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60px"><b>ATTENTION</b></td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td>
                            <h4 class="text-left f-400" style="margin:0px"><?= $attention; ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60px"><b>PHONE</b></td>
                        <td style="width:20px;text-align:center;"> : </td>
                        <td>
                            <h4 class="text-left f-400" style="margin:0px"><?= $no_telp; ?></h4>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="width:48%;border-radius:15px;border:1px solid black;float:left;margin-left:12px;height:110px">
                <table class="table4" style="border:0;width:100%;padding-left:5px;padding-bottom:10px;padding-top:5px;min-height:110px">
                    <tr>
                        <td style="width:75px"><b>NO</b></td>
                        <td style="width:5px;text-align:center;"> : </td>
                        <td>
                            <h4 class="text-left f-400" style="margin:0px"><?= $no_invoice; ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td><b>CUST ID</b></td>
                        <td style="text-align:center;"> : </td>
                        <td>
                            <h4 class="text-left f-400" style="margin:0px"><?= $cust_id; ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td><b>DATE</b></td>
                        <td style="text-align:center;"> : </td>
                        <td>
                            <h4 class="text-left f-400" style="margin:0px"><?= $this->Kamus_model->tanggal_indo($date_invoice, 1); ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td><b>DUE DATE</b> </td>
                        <td style="text-align:center;"> : </td>
                        <td>
                            <h4 class="text-left f-400" style="margin:0px"><?= $this->Kamus_model->tanggal_indo($date_due, 1); ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td><b>PERIODE</b> </td>
                        <td style="text-align:center;"> : </td>
                        <td>
                            <h4 class="text-left f-400" style="margin:0px"><?= $periode; ?></h4>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="clear:both;">
        </div>
        <div style="position:relative;top:5px">
            <table class="table3" style="width:100%">
                <tr>
                    <td rowspan="2" width="13px" class="navytd borderleft borderbottom" style="vertical-align:middle;color:white;border-right: 1px solid white;font-weight: bold;text-align:center;">
                        NO
                    </td>
                    <td colspan="2" width="460px" class="navytd" style="color:white;text-align:center;font-weight: bold;">
                        DESCRIPTION</td>
                    <td rowspan="2" width="95px" class="navytd borderbottom" style="vertical-align:middle;color:white;text-align:center;border-left: 1px solid white;font-weight: bold;">
                        SERVICE ID</td>
                    <td colspan="2" rowspan="2" class="navytd borderright borderbottom" style="vertical-align:middle;color:white;text-align:center;border-left: 1px solid white;font-weight: bold;">
                        TOTAL PRICE</td>
                </tr>
                <tr>
                    <td colspan="2" class="navytd borderbottom" style="border-right:1.5px solid white;border-top:1px solid white;font-weight:bold;text-align:center">BANDWIDTH
                    </td>
                </tr>

                <?php $no = 1;
                $grand = 0;
                $total = 0;
                $materai = 0;
                $bayar = 0;
                foreach ($isi as $row) {
                    if ($row['jenis_transaksi'] == "BI") {
                        $grand = $grand + $row['nominal'];
                        $total = $total + $row['nominal'];
                        echo ' <tr>
                            <td class="borderleft" style="text-align:center;">' . $no . '</td>
                            <td style="text-align:center;border-left: 1px solid black;" colspan="2">
                                <span class="f-400">' . $row['detail'] . '</span>
                            </td>
                            <td style="text-align:center;vertical-align:middle;border-left: 1px solid black;">
                            ' . $row['servid'] . '</td>
                            <td class="borderbottom borderleft text-left" style="vertical-align:middle;width:10px;padding:0px;padding-left:5px;">
                                Rp</td>
                            <td class="borderright borderbottom text-right" style="vertical-align:middle;">
                            ' . number_format($row['nominal'], 0) . '</td>
                        </tr>';
                        $no++;
                    }
                    if ($row['jenis_transaksi'] == "LG") {
                        $grand = $grand + $row['nominal'];
                        $total = $total + $row['nominal'];
                        echo ' <tr>
                            <td class="borderleft" style="text-align:center;">' . $no . '</td>
                            <td style="text-align:center;border-left: 1px solid black;" colspan="2">
                                <span class="f-400">' . $row['detail'] . ' ' . $row['keterangan'] . '</span>
                            </td>
                            <td style="text-align:center;vertical-align:middle;border-left: 1px solid black;">
                            ' . $row['servid'] . '</td>
                            <td class="borderbottom borderleft text-left" style="vertical-align:middle;width:10px;padding:0px;padding-left:5px;">
                                Rp</td>
                            <td class="borderright borderbottom text-right" style="vertical-align:middle;">
                            ' . number_format($row['nominal'], 0) . '</td>
                        </tr>
                        <tr>
                            <td class="borderleft"></td>
                            <td style="text-align:center;border-left: 1px solid black;" colspan="2">' . $this->Kamus_model->tanggal_indo($row['periode_dari'], 1) . ' s.d. ' . $this->Kamus_model->tanggal_indo($row['periode_sampai'], 1) . '
                            </td>
                            <td class="borderright" style="border-left: 1px solid black;"></td>
                            <td class="borderbottom" style="width:10px;padding:0px;padding-left:5px;"></td>
                            <td class="borderright"></td>
                        </tr>';
                        $no++;
                    }
                    if ($row['jenis_transaksi'] == "LL") {
                        $grand = $grand + $row['nominal'];
                        $total = $total + $row['nominal'];
                        echo ' <tr>
                            <td class="borderleft" style="text-align:center;">' . $no . '</td>
                            <td style="text-align:center;border-left: 1px solid black;" colspan="2">
                                <span class="f-400">' . $row['detail'] . '</span>
                            </td>
                            <td style="text-align:center;vertical-align:middle;border-left: 1px solid black;">
                            ' . $row['servid'] . '</td>
                            <td class="borderbottom borderleft text-left" style="vertical-align:middle;width:10px;padding:0px;padding-left:5px;">
                                Rp</td>
                            <td class="borderright borderbottom text-right" style="vertical-align:middle;">
                            ' . number_format($row['nominal'], 0) . '</td>
                        </tr>';
                        $no++;
                    }
                    if ($row['jenis_transaksi'] == "MT") {
                        if ($materai > 6000) {
                            $materai = 6000;
                        } else {
                            $materai = $materai + $row['nominal'];
                        }
                    }
                    if ($row['jenis_transaksi'] == "DP") {
                        $grand = $grand - $row['nominal'];
                        $bayar = $bayar + $row['nominal'];
                    }
                }
                $grand = $grand + $materai; ?>
                <!-- total -->
                <tr>
                    <td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
                    <td style="text-align:center;" class="borderleft navytd f-700">
                        AMOUNT
                    </td>
                    <td class="navytd borderleft text-left f-700" style="vertical-align:middle;border-left: 1px solid white;width:10px;padding:0px;padding-left:5px;">
                        Rp</td>
                    <td class="navytd borderright text-right f-700" style="vertical-align:middle;"><?= number_format($total, 0) ?></td>
                </tr>
                <?php if (!empty($materai)) {
                    echo '<tr>
                    <td style="border-left: 1px solid white;border-bottom: 1px solid white;border-top: 1px solid white;" colspan="3"></td>
                    <td style="text-align:center;border-top: 1px solid white;" class="borderleft navytd f-700">
                    STAMP DUTY
                    </td>
                    <td class="navytd borderleft text-left f-700" style="border-top: 1px solid white;vertical-align:middle;border-left: 1px solid white;width:10px;padding:0px;padding-left:5px;">
                        Rp</td>
                    <td class="navytd borderright text-right f-700" style="border-top: 1px solid white;vertical-align:middle;">' . number_format($materai, 0) . '</td>
                </tr>';
                } ?>
                <?php if (!empty($bayar)) {
                    echo '<tr>
                    <td style="border-left: 1px solid white;border-bottom: 1px solid white;border-top: 1px solid white;" colspan="3"></td>
                    <td style="text-align:center;border-top: 1px solid white;" class="borderleft navytd f-700">
                    DOWN PAYMENT
                    </td>
                    <td class="navytd borderleft text-left f-700" style="border-top: 1px solid white;vertical-align:middle;border-left: 1px solid white;width:10px;padding:0px;padding-left:5px;">
                        Rp</td>
                    <td class="navytd borderright text-right f-700" style="border-top: 1px solid white;vertical-align:middle;">' . number_format($bayar, 0) . '</td>
                </tr>';
                } ?>
                <tr>
                    <td style="border-left: 1px solid white;border-bottom: 1px solid white;" colspan="3"></td>
                    <td class="navytd borderbottom f-700" style="font-size:11px;border-top: 1px solid white;text-align:center;border-left: 1px solid black;vertical-align: middle;padding-bottom: 10px;padding-top: 10px">
                        TOTAL AMOUNT
                    </td>
                    <td class="navytd borderbottom borderleft text-left f-700" style="width:10px;padding:0px;padding-left:5px;vertical-align:middle;border-left: 1px solid white;border-top: 1px solid white;">
                        Rp</td>
                    <td class="navytd borderright borderbottom text-right f-700" style="border-top: 1px solid white;vertical-align:middle;">
                        <?= number_format($grand, 0) ?></td>
                </tr>

            </table>
        </div>
        <!-- list layanan -->
        <!-- terbilang -->
        <div class="terbilang" style="width:100.5%;position:relative;top:0px">
            <div class="bgm-navy bd-2" style="border:2;padding:10px 10px">
                <center>
                    <div class="c-white" style="margin-bottom: 5px;font-size:10px"><strong>TERBILANG / IN WORDS</strong></div>
                    <h3 class="m-0 c-white f-300"><strong class="mutih f-800" style="font-size:13px">## <?php echo strtoupper($this->Kamus_model->baca_angka(round($grand))); ?>
                            RUPIAH ##</strong></h3>
                </center>
            </div>
        </div>
        <!-- Pembayaran -->
        <?php
        if ($nilai_voucher > 0) {
            ?>
            <div class="row m-t-10 p-0 m-b-25">
                <div class="col-xs-12">
                    <div class="bgm-navy brd-2 p-15">
                        <center>
                            <div class="c-white m-b-5">PAYMENT VIA VOUCHER</div>
                        </center>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        <?php
        }
        ?>

        <?php
        if ($voucher == 2) {
            ?>
            <div class="row m-t-10 p-0 m-b-25">
                <div class="col-xs-12">
                    <div class="bgm-navy brd-2 p-15">
                        <center>
                            <div class="c-white m-b-5">PAYMENT VIA VOUCHER</div>

                        </center>
                    </div>
                </div>
            </div>
            <br>
            <div class="clearfix"></div>
        <?php
        }
        ?>

        <?php
        if ($voucher == 1) {
            $bank = $this->finance_invoice_customer->get('ms_bank', 1)->row();
            ?>
            <div>
                <div style="width:90%;display:inline-block;">
                    <h5 class="f-400" style="margin:0px;margin-left:2px;font-size:12px">Please make payment to :</h5>
                    <span>
                        <small style="line-height: 1.2;margin:0px;font-size:12px">
                            <table style="border:0;font-weight: 700;padding-left:0px">
                                <tr>
                                    <td style="text-align:left;padding-left:0px"> Account Bank </td>
                                    <td style="text-align:center;" width="50px"> : </td>
                                    <td> Bank <?php echo $bank->bank; ?> <?php echo $bank->cabang; ?> </td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;padding-left:0px"> Account No </td>
                                    <td style="text-align:center;"> : </td>
                                    <td> <?php echo $bank->rekening; ?> </td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;padding-left:0px"> Account Name </td>
                                    <td style="text-align:center;"> : </td>
                                    <td> <?php echo $bank->an; ?> </td>
                                </tr>
                            </table>
                        </small>
                    </span>
                </div>
            </div>

        <?php
        }
        ?>
        <h5 class="f-400" style="margin:0px;margin-bottom:3px;margin-left:1px;font-size:12px">Note :</h5>
        <div>
            <span>
                <small style="font-weight: 600;line-height: 1.3;font-size:12px">
                    Please send your confirmation transfer payment to : Fax : 024-8509696 or email :
                    finance.smg@gmedia.co.id <br>This invoice can be treated as official receipt upon acceptance
                    of
                    payment <br>(Tagihan ini berlaku sebagai tanda terima yang sah setelah pembayaran diterima)
                </small>
            </span>
            <br><br>
            <span style="font-size:16px">
                <b>** <u>Please transfer in full amount</u></b>
            </span>
        </div>
        <br><br>
        <!-- tandatangan -->
        <div style="display: inline-block;margin-left:0px;width:50%">
            <h5 class="text-center">
                <b>Prepared by :</b><br><br><br><br><br><br><br>
                <b>Retno Dwi Ningsih<br>( Finance Administration )</b>
            </h5>
        </div>
        <div style="display: inline-block;width:40%">
            <h5 class="text-center">
                <b>Approved by :</b><br><br><br><br><br><br><br>
                <b>Adhi Darminto<br>( General Manager )</b>
            </h5>
        </div>
    </div>
</div>