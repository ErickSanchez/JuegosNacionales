<?php
if(!defined('BASEPATH'))exit('No direct script access allowed');

/*helper funcion ayuda a definir los margenes tipografía y creación del footer y números de pagína*/
function prep_pdf($orientation = 'portrait'){
    $CI =&get_instance();
    $CI->cezpdf->selectFont(APPPATH.'libraries/fonts/Helvetica.afm');

    $all = $CI->cezpdf->openObject();
    $CI->cezpdf->saveState();
    $CI->cezpdf->setStrokeColor(0,0,0,1);
    if($orientation == 'portrait') {
        $CI->cezpdf->ezSetMargins(20,70,20,20);
        $CI->cezpdf->ezStartPageNumbers(570,28,8,'','{PAGENUM}',1);
        $CI->cezpdf->line(20,40,578,40);
        $CI->cezpdf->addText(25,32,8,'Impreso ' . date('m/d/Y h:i:s a'));
    }
    else {
        $CI->cezpdf->ezStartPageNumbers(750,28,8,'','{PAGENUM}',1);
        $CI->cezpdf->line(20,40,800,40);
        $CI->cezpdf->addText(25,32,8,'Impreso '.date('m/d/Y h:i:s a'));
    }
    $CI->cezpdf->restoreState();
    $CI->cezpdf->closeObject();
    $CI->cezpdf->addObject($all,'all');
} 



class concat_pdf extends FPDI 

{

        var $files = array();

    function setFiles($files) 
    {
        $this->files = $files;
    }

    function concat() 
    {
            foreach($this->files AS $file) 
            {
                $pagecount = $this->setSourceFile('Files/'.$file);
                  for ($i = 1; $i <= $pagecount; $i++) 
                    {
                        $tplidx = $this->ImportPage($i);
                        $s = $this->getTemplatesize($tplidx);
                         $this->AddPage($s['h'] > $s['w'] ? 'P' : 'L');
                            $this->useTemplate($tplidx);
                    }
            }
    }
}

function pdf_concat($content=array())
{
 
   
        $pdf =& new concat_pdf();
        $pdf->setFiles($content);
        $pdf->concat();
        $pdf->Output('paginas.pdf','F');
//$CI =&get_instance();
    
  //  $CI->fpdi->AddPage();
   // $CI->fpdi->SetFont('Arial','B',16);
   // $CI->fpdi->Cell(40,10,$content);
   // $CI->fpdi->Output();
    
}

