<?php

class Kamus_model extends CI_Model
{
        function __construct()
        {
                parent::__construct();
        }

        function getBulan_angka($bln)
        {
                switch ($bln) {
                        case "Jan":
                                return "01";
                                break;
                        case "Feb":
                                return "02";
                                break;
                        case "Mar":
                                return "03";
                                break;
                        case "Apr":
                                return "04";
                                break;
                        case "May":
                                return "05";
                                break;
                        case "Jun":
                                return "06";
                                break;
                        case "Jul":
                                return "07";
                                break;
                        case "Aug":
                                return "08";
                                break;
                        case "Sep":
                                return "09";
                                break;
                        case "Oct":
                                return "10";
                                break;
                        case "Nov":
                                return "11";
                                break;
                        case "Des":
                                return "12";
                                break;
                }
        }
        function baca_angka($n)
        {
                $this->dasar    = array(1 => 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
                $this->angka    = array(1000000000, 1000000, 1000, 100, 10, 1);
                $this->satuan   = array('Milyar', 'Juta', 'Ribu', 'Ratus', 'Puluh', '');
                $str = "";
                $i = 0;
                if ($n == 0) {
                        $str = "Nol";
                } else {
                        while ($n != 0) {
                                $count = (int) ($n / $this->angka[$i]);
                                if ($count >= 10) {
                                        $str .= $this->baca_angka($count) . " " . $this->satuan[$i] . " ";
                                } else if ($count > 0 && $count < 10) {
                                        $str .= $this->dasar[$count] . " " . $this->satuan[$i] . " ";
                                }
                                $n -= $this->angka[$i] * $count;
                                $i++;
                        }
                        $str = preg_replace("/satu puluh (\w+)/i", "\\1 belas", $str);
                        $str = preg_replace("/satu (ribu|ratus|puluh|belas)/i", "se\\1", $str);
                }
                return $str;
        }

        function selisihtanggal($tgl1, $tgl2)
        {
                $tgl1 = (is_string($tgl1) ? strtotime($tgl1) : $tgl1);
                $tgl2 = (is_string($tgl2) ? strtotime($tgl2) : $tgl2);
                $diff_secs = abs($tgl1 - $tgl2);
                $base_year = min(date("Y", $tgl1), date("Y", $tgl2));
                $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);
                return array(
                        "years" => date("Y", $diff) - $base_year,
                        "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
                        "months" => date("n", $diff) - 1,
                        "days_total" => floor($diff_secs / (3600 * 24)),
                        "days" => date("j", $diff) - 1,
                        "hours_total" => floor($diff_secs / 3600),
                        "hours" => date("G", $diff),
                        "minutes_total" => floor($diff_secs / 60),
                        "minutes" => (int) date("i", $diff),
                        "seconds_total" => $diff_secs,
                        "seconds" => (int) date("s", $diff)
                );
        }
        function downtime($startdate, $starttime, $enddate, $endtime)
        {
                $a = explode("-", $startdate);
                $b = explode(":", $starttime);
                $startdate = mktime($b[0], $b[1], $b[2], $a[1], $a[2], $a[0]);

                $c = explode("-", $enddate);
                $d = explode(":", $endtime);
                $enddate = mktime($d[0], $d[1], $d[2], $c[1], $c[2], $c[0]);

                $selisih = $enddate - $startdate;

                $sisa = $selisih % 86400;
                $jam = floor($sisa / 3600);

                $sisa = $sisa % 3600;
                $menit = floor($sisa / 60);

                $sisa = $sisa % 60;
                $detik = floor($sisa / 1);

                return $jam . ' Jam, ' . $menit . ' Menit';
        }
        function usia($birthday)
        {
                list($year, $month, $day) = explode("-", $birthday);
                $year_diff = date("Y") - $year;
                $month_diff = date("m") - $month;
                $day_diff = date("d") - $day;
                if ($month_diff < 0) $year_diff--;
                elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;
                return $year_diff;
        }
        function scroll_bulan()
        {
                $result['1'] = 'Januari';
                $result['2'] = 'Februari';
                $result['3'] = 'Maret';
                $result['4'] = 'April';
                $result['5'] = 'Mei';
                $result['6'] = 'Juni';
                $result['7'] = 'Juli';
                $result['8'] = 'Agustus';
                $result['9'] = 'September';
                $result['10'] = 'Oktober';
                $result['11'] = 'November';
                $result['12'] = 'Desember';

                return $result;
        }
        function scroll_tahun()
        {
                $awal = '2015';
                $now = date('Y');
                $selisih = $awal - $now;
                $result[$awal] = $awal;
                for ($g = 1; $g <= $selisih; $g++) {
                        $result[$awal + g] = $awal + g;
                }

                return $result;
        }

        function kirim_email($title, $from, $to,  $subject, $email, $cc = '', $attch = '', $flag = 0, $bcc = '')
        {
                $this->load->library('email');
                $this->email->clear(TRUE);
                $config['protocol']  = 'smtp';
                $config['smtp_host'] = '111.68.27.2';
                $config['smtp_port'] = '25';
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = '';
                $config['smtp_pass']    = '';

                $config['mailtype'] = 'html';
                $config['charset'] = 'iso-8859-1';

                $this->email->initialize($config);

                $this->email->from($from, $title);

                $this->email->to($to);
                if ($cc != '' || $bcc != '') {
                        $this->email->cc($cc);
                        $this->email->bcc($bcc);
                }
                $this->email->subject($subject);
                $this->email->message($email);
                if ($attch != '') {
                        if ($flag > 0) {
                                foreach ($attch as $row) {
                                        $this->email->attach($row);
                                }
                        } else {
                                $this->email->attach($attch);
                        }
                }
                $this->email->send();

                return TRUE;
        }

        function random_word($id = 10)
        {
                $pool = '1234567890abcdefghijkmnpqrstuvwxyz';

                $word = '';
                for ($i = 0; $i < $id; $i++) {
                        $word .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
                }

                return $word;
        }
        function random_numeric($id = 5)
        {
                $pool = '123456789';

                $word = '';
                for ($i = 0; $i < $id; $i++) {
                        $word .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
                }

                return $word;
        }
        function harus_angka()
        {
                //      'onKeyPress' => "return numbersonly(this, event)",
                return '
            <SCRIPT TYPE="text/javascript">
            <!--
            // copyright 1999 Idocs, Inc. http://www.idocs.com
            // Distribute this script freely but keep this notice in place
            function numbersonly(myfield, e, dec)
            {
            var key;
            var keychar;
            if (window.event)
            key = window.event.keyCode;
            else if (e)
            key = e.which;
            else
            return true;
            keychar = String.fromCharCode(key);

            // control keys
            if ((key==null) || (key==0) || (key==8) ||
            (key==9) || (key==13) || (key==27) )
            return true;

            // numbers
            else if ((("0123456789").indexOf(keychar) > -1))
            return true;

            // decimal point jump
            else if (dec && (keychar == "."))
            {
            myfield.form.elements[dec].focus();
            return false;
            }
            else
            return false;
            }

            //-->
            </SCRIPT>';
        }

        function round_up($value, $places = 0)
        {
                // echo 'a2';exit;
                $mult = pow(10, abs($places));
                return $places < 0 ?
                        ceil($value / $mult) * $mult : ceil($value * $mult) / $mult;
        }
        function uang($number = 0, $fractional = false)
        {
                //      if ($fractional) { 
                //          $number = sprintf('%,2f', $number); 
                //      } 
                //      while (true) { 
                //          $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1.$2', $number); 
                //          if ($replaced != $number) { 
                //              $number = $replaced; 
                //          } else { 
                //              break; 
                //          } 
                //      } 
                if ((empty($number)) or (!is_numeric($number))) {
                        $res = 0;
                } else {
                        $res = number_format(trim($number));
                }
                // if($number<0){
                // $res = '-'.$res;
                // }
                return $res;
        }

        function tanggal($tanggal, $a = 0)
        {
                $hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                $hr = date('w', strtotime($tanggal));
                $hari = $hari_array[$hr];
                $tgl = date('d-m-Y', strtotime($tanggal));
                $hr_tgl = "$hari, $tgl";
                if ($a > 0) {
                        $hr_tgl     = "$tgl";
                }
                return $hr_tgl;
        }

        function tanggal_indo($tgl, $a = 0)
        {
                // $hari_array = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                // $hr         = date('w', strtotime($tgl));
                // $hari       = $hari_array[$hr];
                $tanggal    = substr($tgl, 8, 2);
                // $bulan      = $this->getBulan(substr($tgl, 5, 2));
                $bulan      = substr($tgl, 5, 2);
                $tahun      = substr($tgl, 0, 4);
                $arr = explode(' ', $tgl);
                // $hr_tgl     = "$hari, $tanggal $bulan $tahun";
                if ($a == 0) {
                        if (!empty($arr[1])) {
                                $hr_tgl     = $tanggal . '/' . $bulan . '/' . $tahun . ' ' . $arr[1];
                        } else {
                                $hr_tgl     = $tanggal . '/' . $bulan . '/' . $tahun;
                        }
                } else {
                        $bulan      = $this->getBulan(substr($tgl, 5, 2));
                        $hr_tgl     = $tanggal . ' ' . $bulan . ' ' . $tahun;
                }
                if ($tgl != '0000-00-00') {
                        return $hr_tgl;
                } else {
                        return '';
                }
        }

        function tanggal_email($tgl)
        {
                $tanggal    = substr($tgl, 8, 2);
                $bulan      = substr($tgl, 5, 2);
                $tahun      = substr($tgl, 0, 4);
                $bulan2 = $this->get_bulan($bulan);
                if (!empty($tgl)) {
                        return $tanggal . ' ' . $bulan2 . ' ' . $tahun;
                } else {
                        return '00-00-0000';
                }
        }
        function get_bulan($bulan)
        {
                if ($bulan == '01') {
                        $bulan = 'Januari';
                } else if ($bulan == '02') {
                        $bulan = 'Februari';
                } else if ($bulan == '03') {
                        $bulan = 'Maret';
                } else if ($bulan == '04') {
                        $bulan = 'April';
                } else if ($bulan == '05') {
                        $bulan = 'Mei';
                } else if ($bulan == '06') {
                        $bulan = 'Juni';
                } else if ($bulan == '07') {
                        $bulan = 'Juli';
                } else if ($bulan == '08') {
                        $bulan = 'Agustus';
                } else if ($bulan == '09') {
                        $bulan = 'September';
                } else if ($bulan == '10') {
                        $bulan = 'Oktober';
                } else if ($bulan == '11') {
                        $bulan = 'November';
                } else {
                        $bulan = 'Desember';
                }
                return $bulan;
        }
        function getBulan($bln)
        {
                switch ($bln) {
                        case 1:
                                return "Januari";
                                break;
                        case 2:
                                return "Februari";
                                break;
                        case 3:
                                return "Maret";
                                break;
                        case 4:
                                return "April";
                                break;
                        case 5:
                                return "Mei";
                                break;
                        case 6:
                                return "Juni";
                                break;
                        case 7:
                                return "Juli";
                                break;
                        case 8:
                                return "Agustus";
                                break;
                        case 9:
                                return "September";
                                break;
                        case 10:
                                return "Oktober";
                                break;
                        case 11:
                                return "November";
                                break;
                        case 12:
                                return "Desember";
                                break;
                }
        }
        function bulan_romawi($bln)
        {
                switch ($bln) {
                        case 1:
                                return "I";
                                break;
                        case 2:
                                return "II";
                                break;
                        case 3:
                                return "III";
                                break;
                        case 4:
                                return "IV";
                                break;
                        case 5:
                                return "V";
                                break;
                        case 6:
                                return "VI";
                                break;
                        case 7:
                                return "VII";
                                break;
                        case 8:
                                return "VIII";
                                break;
                        case 9:
                                return "IX";
                                break;
                        case 10:
                                return "X";
                                break;
                        case 11:
                                return "XI";
                                break;
                        case 12:
                                return "XII";
                                break;
                }
        }

        function seo_title($s)
        {
                $c = array(' ');
                $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+');

                $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

                $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
                return $s;
        }

        function scripttiny_mce()
        {
                return '
        <!-- TinyMCE -->
        <script type="text/javascript" src="' . base_url() . 'script/tiny_mce/tiny_mce_src.js"></script>
        <script type="text/javascript">
        tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

        // Theme options
        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        //theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        //theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        //theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Example content CSS (should be your site CSS)
        content_css : "' . base_url() . 'system/application/views/themes/css/BrightSide.css",

        // Drop lists for link/image/media/template dialogs
        //"' . base_url() . 'media/lists/image_list.js"
        template_external_list_url : "lists/template_list.js",
        external_link_list_url : "lists/link_list.js",
        external_image_list_url : "' . base_url() . 'index.php/adminweb/image_list/",
        media_external_list_url : "lists/media_list.js",

        // Style formats
        style_formats : [
                {title : \'Bold text\', inline : \'b\'},
                {title : \'Red text\', inline : \'span\', styles : {color : \'#ff0000\'}},
                {title : \'Red header\', block : \'h1\', styles : {color : \'#ff0000\'}},
                {title : \'Example 1\', inline : \'span\', classes : \'example1\'},
                {title : \'Example 2\', inline : \'span\', classes : \'example2\'},
                {title : \'Table styles\'},
                {title : \'Table row 1\', selector : \'tr\', classes : \'tablerow1\'}
        ],

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
	});
        </script>';
        }

        function slide_tanggal()
        {
                return '
        <link type="text/css" href="' . base_url() . 'script/development-bundle/themes/base/ui.all.css" rel="stylesheet" />   
        <script type="text/javascript" src="' . base_url() . 'script/development-bundle/jquery-1.3.2.js"></script>
        <script type="text/javascript" src="' . base_url() . 'script/development-bundle/ui/ui.core.js"></script>
        <script type="text/javascript" src="' . base_url() . 'script/dialog_box.js"></script>
        <script type="text/javascript" src="' . base_url() . 'script/development-bundle/ui/ui.datepicker.js"></script>
        <script type="text/javascript" src="' . base_url() . 'script/development-bundle/ui/i18n/ui.datepicker-id.js"></script>
        <script type="text/javascript" src="' . base_url() . 'script/development-bundle/ui/effects.core.js"></script>
        <script type="text/javascript" src="' . base_url() . 'script/development-bundle/ui/effects.drop.js"></script>
        <script type="text/javascript">
          $(function(){
            $("#tanggal").datepicker({
               changeMonth : true,
               changeYear : true,
               dateFormat : \'yy-mm-dd\',
               showAnim    : "drop",
               showOptions : { direction: "up" }
            });
            $("#tanggal1").datepicker({
               changeMonth : true,
               changeYear : true,
               dateFormat : \'yy-mm-dd\',
               showAnim    : "drop",
               showOptions : { direction: "up" }
            });
            $("#tanggal2").datepicker({
               changeMonth : true,
               changeYear : true,
               dateFormat : \'yy-mm-dd\',
               showAnim    : "drop",
               showOptions : { direction: "up" }
            });
            $("#tanggal3").datepicker({
               changeMonth : true,
               changeYear : true,
               dateFormat : \'yy-mm-dd\',
               showAnim    : "drop",
               showOptions : { direction: "up" }
            });
            $("#tanggal4").datepicker({
               changeMonth : true,
               changeYear : true,
               dateFormat : \'yy-mm-dd\',
               showAnim    : "drop",
               showOptions : { direction: "up" }
            });
          }); 
        </script>
        ';
        }

        function cal_prestasi($end, $last_update)
        {
                $strend1 = strtotime($end);
                $strend2 = strtotime($last_update);
                if ($strend1 < $strend2) {
                        $min = $strend2 - $strend1;
                        $floor = floor($min / (60 * 60 * 24));
                        if ($floor == 0) {
                                $selisih = 'Tepat Waktu';
                        } else {
                                $selisih = 'Lebih Lambat ' . floor($min / (60 * 60 * 24)) . ' hari';
                        }
                } else {
                        $min = $strend1 - $strend2;
                        $floor = floor($min / (60 * 60 * 24));
                        if ($floor == 0) {
                                $selisih = 'Tepat Waktu';
                        } else {
                                $selisih = 'Lebih Cepat ' . $floor . ' hari';
                        }
                }
                return $selisih;
        }

        function kursi($seat)
        {
                if ($seat == '1') {
                        $kursi = 'B1';
                } else if ($seat == '2') {
                        $kursi = 'B2';
                } else if ($seat == '3') {
                        $kursi = 'B3';
                } else if ($seat == '4') {
                        $kursi = 'B4';
                } else if ($seat == '5') {
                        $kursi = 'B5';
                } else if ($seat == '6') {
                        $kursi = 'B6';
                } else if ($seat == '7') {
                        $kursi = 'B7';
                } else if ($seat == '8') {
                        $kursi = 'B8';
                } else if ($seat == '9') {
                        $kursi = 'B9';
                } else if ($seat == '10') {
                        $kursi = 'B10';
                } else if ($seat == '11') {
                        $kursi = 'B11';
                } else if ($seat == '12') {
                        $kursi = 'B12';
                } else if ($seat == '13') {
                        $kursi = 'A1';
                } else if ($seat == '14') {
                        $kursi = 'A2';
                } else if ($seat == '15') {
                        $kursi = 'A3';
                } else if ($seat == '16') {
                        $kursi = 'A4';
                } else if ($seat == '17') {
                        $kursi = 'A5';
                } else if ($seat == '18') {
                        $kursi = 'A6';
                } else if ($seat == '19') {
                        $kursi = 'A7';
                } else if ($seat == '20') {
                        $kursi = 'A8';
                } else if ($seat == '21') {
                        $kursi = 'A9';
                } else if ($seat == '22') {
                        $kursi = 'A10';
                } else if ($seat == '23') {
                        $kursi = 'A11';
                } else if ($seat == '24') {
                        $kursi = 'A12';
                } else if ($seat == '25') {
                        $kursi = 'A13';
                } else if ($seat == '26') {
                        $kursi = 'A14';
                } else if ($seat == '27') {
                        $kursi = 'A15';
                } else if ($seat == '28') {
                        $kursi = 'A16';
                } else if ($seat == '29') {
                        $kursi = 'A17';
                } else if ($seat == '30') {
                        $kursi = 'A18';
                } else if ($seat == '31') {
                        $kursi = 'A19';
                } else if ($seat == '32') {
                        $kursi = 'A20';
                } else if ($seat == '33') {
                        $kursi = 'A21';
                } else if ($seat == '34') {
                        $kursi = 'A22';
                } else if ($seat == '35') {
                        $kursi = 'A23';
                } else if ($seat == '36') {
                        $kursi = 'A24';
                } else if ($seat == '37') {
                        $kursi = 'A25';
                } else if ($seat == '38') {
                        $kursi = 'A26';
                } else if ($seat == '39') {
                        $kursi = 'A27';
                } else if ($seat == '40') {
                        $kursi = 'A28';
                }
                return $kursi;
        }
        function seat($seat)
        {
                if ($seat == 'B1') {
                        $kursi = '1';
                } else if ($seat == 'B2') {
                        $kursi = '2';
                } else if ($seat == 'B3') {
                        $kursi = '3';
                } else if ($seat == 'B4') {
                        $kursi = '4';
                } else if ($seat == 'B5') {
                        $kursi = '5';
                } else if ($seat == 'B6') {
                        $kursi = '6';
                } else if ($seat == 'B7') {
                        $kursi = '7';
                } else if ($seat == 'B8') {
                        $kursi = '8';
                } else if ($seat == 'B9') {
                        $kursi = '9';
                } else if ($seat == 'B10') {
                        $kursi = '10';
                } else if ($seat == 'B11') {
                        $kursi = '11';
                } else if ($seat == 'B12') {
                        $kursi = '12';
                } else if ($seat == 'A1') {
                        $kursi = '13';
                } else if ($seat == 'A2') {
                        $kursi = '14';
                } else if ($seat == 'A3') {
                        $kursi = '15';
                } else if ($seat == 'A4') {
                        $kursi = '16';
                } else if ($seat == 'A5') {
                        $kursi = '17';
                } else if ($seat == 'A6') {
                        $kursi = '18';
                } else if ($seat == 'A7') {
                        $kursi = '19';
                } else if ($seat == 'A8') {
                        $kursi = '20';
                } else if ($seat == 'A9') {
                        $kursi = '21';
                } else if ($seat == 'A10') {
                        $kursi = '22';
                } else if ($seat == 'A11') {
                        $kursi = '23';
                } else if ($seat == 'A12') {
                        $kursi = '24';
                } else if ($seat == 'A13') {
                        $kursi = '25';
                } else if ($seat == 'A14') {
                        $kursi = '26';
                } else if ($seat == 'A15') {
                        $kursi = '27';
                } else if ($seat == 'A16') {
                        $kursi = '28';
                } else if ($seat == 'A17') {
                        $kursi = '29';
                } else if ($seat == 'A18') {
                        $kursi = '30';
                } else if ($seat == 'A19') {
                        $kursi = '31';
                } else if ($seat == 'A20') {
                        $kursi = '32';
                } else if ($seat == 'A21') {
                        $kursi = '33';
                } else if ($seat == 'A22') {
                        $kursi = '34';
                } else if ($seat == 'A23') {
                        $kursi = '35';
                } else if ($seat == 'A24') {
                        $kursi = '36';
                } else if ($seat == 'A25') {
                        $kursi = '37';
                } else if ($seat == 'A26') {
                        $kursi = '38';
                } else if ($seat == 'A27') {
                        $kursi = '39';
                } else if ($seat == 'A28') {
                        $kursi = '40';
                }
                return $kursi;
        }
        function decode_string($str)
        {
                //split the reply in chunks of 4 characters (each 4 character is hex encoded), use | as separator
                $str = str_replace(" ", "", $str); // remove normal space, you might have better ways of doing this
                $chunk = chunk_split($str, 4, '|');
                $coded_array = explode('|', $chunk);
                $n = count($coded_array);
                $decoded = '';
                for ($i = 0; $i < $n; $i++) {
                        $decoded .= chr(hexdec($coded_array[$i]));
                }
                return $decoded;
        }

        function make_period($start, $end)
        {
                $periode = null;
                $date_awal = substr($start, 8, 2);
                $date_akhir = substr($end, 8, 2);
                $bulan = substr($start, 5, 2);
                $tahun = substr($start, 0, 4);
                $textbulan = $this->get_bulan($bulan);
                $periode = $date_awal . ' - ' . $date_akhir . ' ' . $textbulan . ' ' . $tahun;
                return $periode;
        }
}
