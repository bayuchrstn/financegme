<?php if (!defined('BASEPATH')) exit('No dire	ct script access allowed');

class ImportFile
{
    var $ext_array = [];

    public function __construct()
    {
        $this->ext_array = array(
            'excel' => ['xls', 'xlsx', 'XLS', 'XLSX', 'csv']
        );
    }
    public function Excel($input_post = null, $colums_start = null, $callback = null)
    {
        // $filename = $_FILES[$input_post]['name'];
        $location_file = $input_post['location_file'];
        CII()->load->helper('string');
        CII()->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
        try {
            $inputFileType = IOFactory::identify($location_file);
            $objReader = IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($location_file);
        } catch (Exception $e) {
            //die('Error loading file "'.pathinfo($dir_name.$nama_file,PATHINFO_BASENAME).'": '.$e->getMessage());
            $jsonData  = 'Error loading file "' . $e->getMessage();
        }

        $total_halaman = $objPHPExcel->getSheetCount();
        $data_excel = [];
        $total_data = 0;

        for ($i = 0; $i < $total_halaman; $i++) {
            $sheet = $objPHPExcel->getSheet($i);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            $data_excel['data'][$i]['sheet_name'] = $sheet->getTitle();
            $data_excel['data'][$i]['sheet_data'] = $sheet->rangeToArray($colums_start . ':' . $highestColumn . $highestRow, null, true, false);
        }
        $data_excel['input_post'] = $input_post;
        return $callback($data_excel);
    }
    public function CekExcel($name_input = '', $folder = '', $colums_validate = '', $validate = [], $highcol)
    {

        CII()->load->helper('string');
        $jsonData = '';
        if ($_FILES[$name_input]["error"] == 0) {
            $filename = $_FILES[$name_input]['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (in_array($ext, $this->ext_array['excel'])) {
                $randname = md5_file($_FILES[$name_input]['tmp_name']);
                $cek_filename = str_replace(" ", "", $_FILES[$name_input]["name"]);
                $nama_file = $randname . '.' . $ext;
                $tmp_name = $_FILES[$name_input]["tmp_name"];
                $tanggal = getdate();
                $bulan = $tanggal['month'];
                $tahun = $tanggal['year'];
                if (!file_exists('./assets/generate/excel/' . $folder)) {
                    // mkdir('./assets/generate/excel/' . $folder . '/' . $tahun, 777, true);
                    mkdir('./assets/generate/excel/' . $folder, true);
                }
                if (!file_exists('./assets/generate/excel/' . $folder)) {
                    // mkdir('./assets/generate/excel/' . $folder . '/' . $tahun . '/' . $bulan, 777, true);
                    mkdir('./assets/generate/excel/' . $folder, 777, true);
                }
                // $dir_name = './assets/generate/excel/' . $folder . '/' . $tahun . '/' . $bulan . '/';
                $dir_name = './assets/generate/excel/' . $folder . '/';
                move_uploaded_file($tmp_name, $dir_name . $nama_file);
                CII()->load->library(array('PHPExcel', 'PHPExcel/IOFactory'));
                // Read your Excel workbook
                try {
                    $inputFileType = IOFactory::identify($dir_name . $nama_file);
                    $objReader = IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($dir_name . $nama_file);
                } catch (Exception $e) {
                    //die('Error loading file "'.pathinfo($dir_name.$nama_file,PATHINFO_BASENAME).'": '.$e->getMessage());
                    $jsonData  = 'Error loading file "' . pathinfo($dir_name . $nama_file, PATHINFO_BASENAME) . '": ' . $e->getMessage();
                }
                $total_halaman = $objPHPExcel->getSheetCount();
                $data_excel = [];
                $total_data = 0;
                for ($i = 0; $i < $total_halaman; $i++) {
                    $sheet = $objPHPExcel->getSheet($i);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $highcol;
                    $data_excel[$i]['sheet_name'] = $sheet->getTitle();

                    $data_excel[$i]['data'] = $sheet->rangeToArray('A1:' . $highestColumn . $highestRow, null, true, false);

                    $data_excel[$i]['cek_data'] = array_map('strtolower', $sheet->rangeToArray($colums_validate, null, true, false)[0]);

                    if ($data_excel[$i]['cek_data'] == $validate ? true : false) {
                        $data_excel[$i]['cekformat'] = 'format diterima';
                    } else {
                        $data_excel[$i]['cekformat'] = 'format tidak diterima';
                    }

                    $data_excel[$i]['jumlah_data'] = (int) $highestRow;

                    $total_data = $total_data + $highestRow;
                }

                $jsonData = array(
                    'status' => true,
                    'message' => 'data import berhasil di baca',
                    'data' => $data_excel,
                    'total_data' => $total_data,
                    'total_halaman' => $total_halaman,
                    'excel_tmp' => $dir_name . $nama_file,
                    // 'message'=>'Format Excel Dapat Terima'
                );
                // $this->db->trans_start();
            } else {
                $jsonData  = array(
                    'status' => false,
                    'message' => 'data import tidak berhasil di baca',
                );
            }
        } else {
            // $jsonData  = 'Format harus'
            $jsonData  = array(
                'status' => false,
                'message' => 'data import tidak berhasil di simpan',
            );
        }
        return $jsonData;
    }
}
