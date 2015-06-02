<?php

include ('/../dataLayer/controladorBaseDatos.php');
include ('/../objetos/obj_reporte.php');

/* This is where the data files are. Adjust as necessary. */
$outfile = "";
$title = "Cursos menos solictados";

$tf=0; $tbl=0;

$sum = 0; $total = 0; $subtotal = 0; $tabheight = 0;

$pagewidth = 595; $pageheight = 842;
$fontsize = 12;
$capheight = 8.5;
$rowheight = 16;
$margin = 4;
$leading = "120%";
$ystart = $pageheight - 50;
$yoffset = 15;
$ycontinued = 40;
$nfooters = 1; $nheaders = 1;

/* The table coordinates are fixed; only the height of the table may differ
 */
$llx = 55; $urx = 505; $lly = 80;
   
/* The widths of the individual columns is fixed */
$maxcol = 5;

$c1 = 130; $c2 = 100; $c3 = 70; $c4 = 70; $c5 = 80;

/* Get the current date */
setlocale(LC_TIME, "C");
date_default_timezone_set("America/Costa_Rica");
$fulldate = date("F j, Y");

/* Text to output after the table */
$closingtext =
    "En el anterior reporte se muestran los cursos menos solicitados por los profesores.";

//$address = array(
//    "John Q. Doe", "255 Customer Lane", "Suite B",
//    "12345 User Town", "Everland"
//);

/* Used to format the prices to a maximum of to fraction digits */

try {
    $p = new PDFlib();
    
    $controlador = new controladorReporte();
    $resultado = $controlador->retornarCursosMenosSolicitados();

    //$p->set_option("searchpath={" . $searchpath . "}");

    /* This means we must check return values of load_font() etc. */
    $p->set_option("errorpolicy=return");
    $p->set_option("stringformat=utf8");

    if ($p->begin_document($outfile, "") == 0)
        throw new Exception("Error: " . $p->get_errmsg());

    $p->set_info("Creator", "SAACTec");
    $p->set_info("Title", $title );

    /* Open the PDF document */
//    $stationery = $p->open_pdi_document($infile, "");
//    if ($stationery == 0)
//        throw new Exception("Error: " . $p->get_errmsg());
    
    /* Open the first page of the PDF */
//    $page = $p->open_pdi_page($stationery, 1, "");
//    if ($page == 0)
//        throw new Exception("Error: " . $p->get_errmsg());
  
    /* Load the bold and regular styles of a font */
    $boldfont = $p->load_font("Helvetica-Bold", "unicode", "");
    if ($boldfont == 0)
        throw new Exception("Error: " . $p->get_errmsg());
    
    $regularfont = $p->load_font("Helvetica", "unicode", "");
    if ($regularfont == 0)
        throw new Exception("Error: " . $p->get_errmsg());
    
    /* Start the output page */
    $p->begin_page_ext($pagewidth, $pageheight, "");

    /* Fit and close the imported PDF page */
//    $p->fit_pdi_page($page, 0, 0, "");
//    $p->close_pdi_page($page);

    /* Output the customer's address */
    $y = $ystart;
    
    $p->setfont($regularfont, $fontsize);

//    for ($i = 0; $i < count($address); $i++) {
//        $p->fit_textline($address[$i], $llx, $y, "");
//        $y -= $yoffset;
//    }
    
    $y -= 3 * $yoffset;
    
    $p->setfont($boldfont, $fontsize);
    
    $p->fit_textline("REPORTE DE CURSOS MENOS SOLICITADOS", $llx, $y, "position {left top}");
    $p->fit_textline($fulldate, $urx, $y, "position {right top}");
    
    $y -= 3 * $yoffset;
    
    $head_opts_right = "fittextline={position={right top} " .
        " font=" . $boldfont . " fontsize={capheight=" . $capheight . "}} " .
        " rowheight=" . $rowheight . " margin=" . $margin;
    
    $head_opts_center = "fittextline={position={center top} " .
        " font=" . $boldfont . " fontsize={capheight=" . $capheight . "}} " .
        " rowheight=" . $rowheight . " margin=" . $margin;
    
    $head_opts_left = "fittextline={position={left top} " .
        " font=" . $boldfont . " fontsize={capheight=" . $capheight . "}} " .
        " rowheight=" . $rowheight . " margin=" . $margin;
         
    $col = 1; $row = 1;
              
    $tbl = $p->add_table_cell($tbl, $col++, $row, "CURSO", 
        $head_opts_center . " colwidth=" . $c1);
    if ($tbl == 0)
        throw new Exception("Error adding cell: " . $p->get_errmsg());
    
    $tbl = $p->add_table_cell($tbl, $col++, $row, "NIVEL", 
        $head_opts_center . " colwidth=" . $c2);
        if ($tbl == 0)
            throw new Exception("Error adding cell: " . $p->get_errmsg());
    
    $tbl = $p->add_table_cell($tbl, $col++, $row, "NOMBRE PROFESOR", 
        $head_opts_center . " colwidth=" . $c3);
        if ($tbl == 0)
            throw new Exception("Error adding cell: " . $p->get_errmsg());
        
    $tbl = $p->add_table_cell($tbl, $col++, $row, "DEPARTAMENTO", 
        $head_opts_center . " colwidth=" . $c4);
        if ($tbl == 0)
            throw new Exception("Error adding cell: " . $p->get_errmsg());
        
    $tbl = $p->add_table_cell($tbl, $col++, $row, "CORREO", 
            $head_opts_center . " colwidth=" . $c5);
        if ($tbl == 0)
            throw new Exception("Error adding cell: " . $p->get_errmsg());
        
    $row++;
    
    $body_opts = "fittextline={position={right top} " .
        " font=" . $regularfont . 
        " fontsize={capheight=" . $capheight . "}} " .
        " rowheight=" . $rowheight . " margin=" . $margin;
    
    for ($i= 1; $i<=count($resultado); $i++, $row++){
        
        $col = 1;
        
        $tbl = $p->add_table_cell($tbl, $col++, $row, $resultado[$i-1]->nombreCurso, $body_opts);
        if ($tbl == 0)
            throw new Exception("Error adding cell: " . $p->get_errmsg());
        
        $tf_opts = "font=" . $regularfont . 
            " fontsize={capheight=" . $capheight . "} leading=" . $leading;
        $bodytf_opts = "fittextflow={firstlinedist=capheight}" . 
            " colwidth=" . $c2 . " margin=" . $margin;
        
        /* Add the Textflow with the options defined above */
        $tf = $p->add_textflow(0, $resultado[$i-1]->nivelCurso, $tf_opts);
        
        if ($tf == 0)
            throw new Exception("Error: " . $p->get_errmsg());
            
        /* Add the Textflow table cell with the options defined above */
        $tbl = $p->add_table_cell($tbl, $col++, $row, "", 
            $bodytf_opts . " textflow=" . $tf);
            
        if ($tbl == 0)
            throw new Exception("Error adding cell: " . $p->get_errmsg());
        
        $tf = 0;
        
        $tbl = $p->add_table_cell($tbl, $col++, $row, $resultado[$i-1]->nombreProfesor." ".$resultado[$i-1]->apellido1Profesor." ".$resultado[$i-1]->apellido2Profesor, 
            $body_opts);
        if ($tbl == 0)
            throw new Exception("Error adding cell: " . $p->get_errmsg());
        
        $tbl = $p->add_table_cell($tbl, $col++, $row, $resultado[$i-1]->departamentoEscuelaProfesor, 
            $body_opts);
        if ($tbl == 0)
            throw new Exception("Error adding cell: " . $p->get_errmsg());
        
        $tbl = $p->add_table_cell($tbl, $col++, $row, $resultado[$i-1]->emailProfesor, 
            $body_opts);
        if ($tbl == 0)
            throw new Exception("Error adding cell: " . $p->get_errmsg());
    }
    
    /* Add an empty footer row containing a matchbox called "subtotal".
     * It will be filled with the subtotal or total later. The matchbox 
     * starts in the column before last and spans two columns.
     */
    $footer_opts = 
        "rowheight=" . $rowheight . " colspan=2 margin =" . $margin .
        " matchbox={name=subtotal}";
    
    $tbl = $p->add_table_cell($tbl, $maxcol-1, $row, "", $footer_opts . "");
              
    if ($tbl == 0)
        throw new Exception("Error adding cell: " . $p->get_errmsg());

        
    /* ------------------------------------
     * Place the table on one or more pages
     * ------------------------------------
     */

    /* Loop until all of the table is placed; create new pages as long as
     * more table instances need to be placed
     */
    do {
        /* The first row is the header row which will be repeated on each
         * new page. The last row is the footer and will be repeated on each
         * new page. The header row is filled with a light blue, and the
         * footer row is filled with a light orange. Each odd row is filled
         * with a light gray.
         */
        $fit_opts = 
            "header=" . $nheaders . " footer=" . $nfooters . 
            " fill={{area=rowodd fillcolor={gray 0.9}} " .
            "{area=header fillcolor={rgb 0.90 0.90 0.98}} " .
            "{area=footer fillcolor={rgb 0.98 0.92 0.84}}}";

        /* Place the table instance */
        $result = $p->fit_table($tbl, $llx, $lly, $urx, $y, $fit_opts);
        
        /* An error occurred or the table's fitbox is too small to keep any
         * contents 
         */
        if ($result == "_error" || $result == "_boxempty")
            throw new Exception ("Couldn't place table : " .
                $p->get_errmsg());
        
        /* If all rows have been placed output the total in the matchbox
         * defined for the footer row. Since the matchbox cannot be supplied
         * directly to fit_textline(), we retrieve the matchbox coordinates
         * and fit the text accordingly.
         */
        if ($result != "_boxfull") {
            /* Format the total to a maximum of two fraction digits */
            $roundedValue = sprintf("%.2f", $total);
            $contents = "total:   " . $roundedValue;
            
            /* Retrieve the coordinates of the third (upper right) corner of
             * the "subtotal" matchbox. The parameter "1" indicates the 
             * first instance of the matchbox.
             */
            $x3 = 0; $y3 = 0;
                         
            if ($p->info_matchbox("subtotal", 1, "exists") == 1) {
                $x3 = $p->info_matchbox("subtotal", 1, "x3");
                $y3 = $p->info_matchbox("subtotal", 1, "y3");
            }
            else {
                throw new Exception("Error: " . $p->get_errmsg());
            }
            
            /* Start the text line at the corner coordinates retrieved
             * (x2, y2) with a small margin. Right-align the text.
             */
            $p->setfont($boldfont, $fontsize);
//            $p->fit_textline($contents, $x3 - $margin, $y3 - $margin,
//                "position={right top}");
        }
        
        /* Print the subtotal for all rows in the table instance on the
         * current page below the last table column before we place the 
         * remaining rows on the next page 
         */
        else if ($result == "_boxfull") {
            /* Get the last body row output in the table instance */
            $lastrow = $p->info_table($tbl, "lastbodyrow");
            
            /* Calculate the subtotal */
            $subtotal = 0;
            for ($i = 0 ; $i < $lastrow - $nfooters; $i++) {
                $subtotal += $items[$i][1] * $items[$i][2];
            }
           
            /* Output the subtotal in the matchbox defined for the footer 
             * row. Since the matchbox cannot be directly referenced we 
             * retrieve the matchbox coordinates and fit the text
             *  accordingly.
             */
            
            /* Format the subtotal to a maximum of two fraction digits*/
            $roundedValue = sprintf("%.2f", $subtotal);
            
            $contents = "subtotal:   " . $roundedValue;
            
            /* Retrieve the coordinates of the third (upper right) corner of
             * the "subtotal" matchbox. The parameter "1" indicates the 
             * first instance of the matchbox.
             */
            $x3 = 0; $y3 = 0;
            
            if ($p->info_matchbox("subtotal", 1, "exists") == 1) {
                $x3 = $p->info_matchbox("subtotal", 1, "x3");
                $y3 = $p->info_matchbox("subtotal", 1, "y3");
            }
            else {
                throw new Exception("Error: " . $p->get_errmsg());
            }
            
            /* Start the text line at the corner coordinates retrieved in
             * (x3, y3) with a small margin. Right-align the text.
             */
            $p->setfont($boldfont, $fontsize);
            $p->fit_textline($contents, $x3 - $margin, $y3 - $margin,
                "position={right top}");
    
            /* Output the "Continued" remark */               
            $p->setfont($regularfont, $fontsize);
            $p->fit_textline("-- Continued --", $urx, $ycontinued, 
                "position {right top}");
            
            $p->end_page_ext("");
            $p->begin_page_ext($pagewidth, $pageheight, "");
            $y = $ystart;
        }
    } while ($result == "_boxfull");
    
    
    /* -----------------------------------------------
     * Place the closing text directly after the table
     * -----------------------------------------------
     */
    
    /* Get the table height of the current table instance */
    $tabheight = $p->info_table($tbl, "height");
    
    $y = $y - (int) $tabheight - $yoffset;
            
    /* Add the closing Textflow to be placed after the table */
    $tf_opts = "font=" . $regularfont . " fontsize=" . $fontsize .
        " leading=" . $leading . " alignment=justify";
    
    $tf = $p->add_textflow(0, $closingtext, $tf_opts);
    if ($tf == 0)
        throw new Exception("Error: " . $p->get_errmsg());
    
    /* Loop until all text has been fit which is indicated by the "_stop"
     * return value of fit_textflow()
     */
    do {
        /* Place the Textflow */
        $result = $p->fit_textflow($tf, $llx, $lly, $urx, $y, "");
        
        if ($result == "_error")
            throw new Exception ("Couldn't place table : " .
                $p->get_errmsg());
        
        if ($result == "_boxfull" || $result == "_boxempty") {
            $p->setfont($regularfont, $fontsize);
            $p->fit_textline("-- Continued --", $urx, $ycontinued,
                "position {right top}");
            
            $p->end_page_ext("");
            $p->begin_page_ext($pagewidth, $pageheight, "");
            $y = $ystart;
        }
    } while (!$result == "_stop");
    
    $p->end_page_ext("");
   
    $p->end_document("");
    //$p->close_pdi_document($stationery);

    $buf = $p->get_buffer();
    $len = strlen($buf);

    header("Content-type: application/pdf");
    header("Content-Length: $len");
    header("Content-Disposition: inline; filename=table_invoice.php.pdf");
    print $buf;


} catch (PDFlibException $e){
    die("PDFlib exception occurred:\n" .
        "[" . $e->get_errnum() . "] " . $e->get_apiname() .
        ": " . $e->get_errmsg() . "\n");
} catch (Exception $e) {
    die($e->getMessage());
}
$p = 0;

class controladorReporte {

    function __construct() {
        
    }

    function retornarCursosMasSolicitados() {
        $cont = new controladorBaseDatos();
        return $cont->retornarCursosMasSolicitados();
    }
    
    function retornarCursosMenosSolicitados() {
        $cont = new controladorBaseDatos();
        return $cont->retornarCursosMenosSolicitados();
    }

}
?>