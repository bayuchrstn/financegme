<?php

/**
 * Split PDF file
 *
 * <p>Split all of the pages from a larger PDF files into
 * single-page PDF files.</p>
 *
 * @package FPDF required http://www.fpdf.org/
 * @package FPDI required http://www.setasign.de/products/pdf-php-solutions/fpdi/
 * @param string $filename The filename of the PDF to split
 * @param string $end_directory The end directory for split PDF (original PDF's directory by default)
 * @return void
 */
class Splitpdf
{
    function __construct()
    {
        require_once APPPATH . 'vendor/autoload.php';
        require_once APPPATH . 'vendor/setasign/fpdi/fpdi.php';
        require_once APPPATH . 'vendor/setasign/fpdf/fpdf.php';
    }

    function split_pdf($filename, $directory, $page)
    {

        $pdf = new FPDI();
        $pagecount = $pdf->setSourceFile($filename); // How many pages?
        if (!file_exists($directory)) {
            // Split each page into a new PDF
            for ($i = 1; $i <= $pagecount; $i++) {
                if ($i == $page) {
                    $new_pdf = new FPDI();
                    $new_pdf->AddPage();
                    $new_pdf->setSourceFile($filename);
                    $new_pdf->useTemplate($new_pdf->importPage($i));
                    try {
                        $new_pdf->Output($directory, "F");
                        $a = 'sukses';
                    } catch (Exception $e) {
                        $a = 'error';
                    }
                }
            }
            return $a;
        } else {
            return false;
        }
    }
    function get_page($filename)
    {
        $pdf = new FPDI();
        $pagecount = $pdf->setSourceFile($filename);
        return $pagecount;
    }
}
