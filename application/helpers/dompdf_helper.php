<?php   if(!defined('BASEPATH')) exit('No direct script access allowed');

function pdf_create($html, $filename='',$stream=false) 
{
    require_once(APPPATH.'libraries/dompdf/dompdf_config.inc.php');
    ob_start();
    spl_autoload_register('DOMPDF_autoload');
    
    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
     ob_end_clean();
    $dompdf->stream($filename.".pdf");
    /*
    } else {
        $filename.='.pdf';
        $CI =& get_instance();
        $CI->load->helper('file');
        write_file("$filename", $dompdf->output());
       // redirect('http://prefecomorelia.edu.mx/juegos-nacionales-2012/cedula.pdf', 'refresh');
       
        $dompdf->stream($filename);
        
        //header('Content-Disposition: attachment; filename="'.$filename.'"');
        //readfile($filename);

       // $data['filename']=$filename.'pdf';
        //$CI->load->view('includes/pdf_viwe',$data);
    }
    //$dompdf->stream($filename.".pdf",array('Attachment' => $down));*/
        
}