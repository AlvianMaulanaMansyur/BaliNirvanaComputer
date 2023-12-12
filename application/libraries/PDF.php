<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once 'dompdf-master/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

class PDF
{
    public function generate($view, $filename = '', $paper = '', $orientation = '', $stream = TRUE)
    {
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.'.pdf', array('Attachment => 0'));
            exit();
        } else {
            return $dompdf->output();
        }
    }

    public function formatCurrency($amount)
    {
        return 'Rp' . number_format($amount, 0, ',', '.');
    }
}

/* End of file PDF.php */
