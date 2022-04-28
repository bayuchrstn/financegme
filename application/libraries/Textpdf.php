<?php

// Include Composer autoloader if not already done.

class Textpdf
{
    function __construct()
    {
        require_once APPPATH . 'vendor/autoload.php';
    }
    function file_pdf_parser($file)
    {
        $parser = new \Smalot\PdfParser\Parser();
        $pdf = $parser->parseFile($file);
        $text = $pdf->getText();
        return $text;
    }

    function text_pdf($filename, $halaman)
    {
        // Parse pdf file and build necessary objects.
        $parser = new \Smalot\PdfParser\Parser();
        $pdf    = $parser->parseFile($filename);

        // Retrieve all pages from the pdf file.
        $pages  = $pdf->getPages();
        $a = 1;
        $z = null;
        // Loop over each page to extract text.
        foreach ($pages as $page) {
            if ($halaman == $a) {
                $z = $page->getText();
            }
            $a++;
        }
        return $z;
    }
}
