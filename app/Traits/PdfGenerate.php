<?php

namespace App\Traits;

use PDF;

trait PdfGenerate
{
    public function getInvoice($view, $data)
    {
        $pdf = PDF::loadView($view,compact('data'));
        return $pdf->download('invoice.pdf');
    }
}
