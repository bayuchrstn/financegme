<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once("./third_party/dompdf/autoload.inc.php");
require_once APPPATH . 'libraries/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdfgenerator
{

    public function generate($html, $filename = '', $stream, $paper = 'A4', $orientation = "portrait")
    {
        $options = new Options();
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename . ".pdf", array("Attachment" => false));
            return TRUE;
        } else {
            return $dompdf->output();
        }
    }

    public function create_report($html, $filename)
    {
        $dompdf = new Dompdf([
            'enable_remote' => true,
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dir = './assets/generate/report/invoice/';

        // if ($stream) {
        // $dompdf->stream($filename . ".pdf", array("Attachment" => 0));
        file_put_contents($dir . $filename . '.pdf', $dompdf->output());

        // } else {
        //     return $dompdf->output();
        // }

        return [
            'path' => $dir . $filename . '.pdf',
            'file' => $filename . '.pdf'
        ];
    }
}
