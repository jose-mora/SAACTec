<?php

class controladorReporte {

    function __construct() {
        
    }
    
    public function crearReporteDeCursosMasSolicitados() {
        $controlador = new controladorBaseDatos();
        $resultado= $controlador->retornarCursosMasSolicitados();
        $this->crearReporteGeneral("Reporte de los cursos más solicitados", $resultado);
        return 0;
    }

    public function crearReporteDeCursosMenosSolicitados() {
        $controlador = new controladorBaseDatos();
        $resultado= $controlador->retornarCursosMenosSolicitados();
        $this->crearReporteGeneral("Reporte de los cursos más solicitados", $resultado);
        return 0;
    }
    
    public function crearReporteGeneral($tituloReporte, $resultadoConsulta) {
        try {
            $p = new PDFlib();

            if ($p->begin_document("", "") == 0) {
                die("Error: " . $p->get_errmsg());
            }

            $p->set_info("Creator", "Erick");
            $p->set_info("Author", "Rainer Schaaf");
            $p->set_info("Title", $tituloReporte);

            $p->begin_page_ext(595, 842, "");

            $font = $p->load_font("Helvetica-Bold", "winansi", "");

            $p->setfont($font, 24.0);
            $p->set_text_pos(50, 700);
            $p->show($resultadoConsulta);
            $p->end_page_ext("");

            $p->end_document("");

            $buf = $p->get_buffer();
            $len = strlen($buf);

            header("Content-type: application/pdf");
            header("Content-Length: $len");
            header("Content-Disposition: inline; filename=reporte.pdf");
            print $buf;
        } catch (PDFlibException $e) {
            die("Ha ocurrido un problema:\n" .
                    "[" . $e->get_errnum() . "] " . $e->get_apiname() . ": " .
                    $e->get_errmsg() . "\n");
        } catch (Exception $e) {
            die("Problema!!!!!!!!!!!! ".$e);
        }
        $p = 0;
    }

}

//try {
//    $p = new PDFlib();
//
//    /*  open new PDF file; insert a file name to create the PDF on disk */
//    if ($p->begin_document("", "") == 0) {
//        die("Error: " . $p->get_errmsg());
//    }
//
//    $p->set_info("Creator", "hello.php");
//    $p->set_info("Author", "Rainer Schaaf");
//    $p->set_info("Title", "Hello world (PHP)!");
//
//    $p->begin_page_ext(595, 842, "");
//
//    $font = $p->load_font("Helvetica-Bold", "winansi", "");
//
//    $p->setfont($font, 24.0);
//    $p->set_text_pos(50, 700);
//    $p->show("Este es mi primer PDF");
//    $p->continue_text("generado con PDFLib");
//    $p->end_page_ext("");
//
//    $p->end_document("");
//
//    $buf = $p->get_buffer();
//    $len = strlen($buf);
//
//    header("Content-type: application/pdf");
//    header("Content-Length: $len");
//    header("Content-Disposition: inline; filename=hello.pdf");
//    print $buf;
//}
//catch (PDFlibException $e) {
//    die("PDFlib exception occurred in hello sample:\n" .
//    "[" . $e->get_errnum() . "] " . $e->get_apiname() . ": " .
//    $e->get_errmsg() . "\n");
//}
//catch (Exception $e) {
//    die($e);
//}
//$p = 0;
?>