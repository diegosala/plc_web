<?php
    class ProcesosController extends AppController {
        public $helpers = array ('Paginator', 'Js');
        public $components = array('Paginator', 'RequestHandler');
        
        public function listado() {
            $this->loadModel('Proceso');
            $this->loadModel('Etapa');
            $this->loadModel('EtapaProceso');
            $this->loadModel('VelocidadProceso');
            
            $this->Paginator->settings = array('limit' => 5);                        
            $procesos = $this->Paginator->paginate('Proceso');            
            
            $this->set("procesos", $procesos);
            $this->set("isAjax", $this->request->is('ajax'));
        }
        
        public function detalle($idProceso) {
            $this->loadModel('Proceso');
            $this->loadModel('Etapa');
            $this->loadModel('EtapaProceso');
            $this->loadModel('VelocidadProceso');
            
            $this->Proceso->recursive = 2;
            $this->set("proceso", $this->Proceso->findById($idProceso));
            $this->set("etapas", $this->EtapaProceso->findAllByidProceso($idProceso));
        }
        
        private function formatearHora($dateTimeSQL) {
            return date("d/m/Y H:i:s", strtotime($dateTimeSQL));
        }
        
        public function reporte($idProceso) {        
            App::import('Vendor','EzPDF', array('file' => '/ezpdf/Cezpdf.php'));
            
            $this->loadModel('Proceso');
            $this->loadModel('Etapa');
            $this->loadModel('EtapaProceso');
            $this->loadModel('VelocidadProceso');
                        
            $proceso = $this->Proceso->findById($idProceso);
            $etapas = $this->EtapaProceso->findAllByidProceso($idProceso);            
            $fechaHoraInicio = $this->formatearHora($proceso['Proceso']['f_inicio']);
                    
            $filename = "reporte_proceso_{$idProceso}";

            ## PDF - INICIO ##
            $pdf = new Cezpdf('a4', 'portrait');
            $pdf->selectFont(APP . 'Vendor' . DS . 'ezpdf/fonts/Helvetica');
            $pdf->ezSetCmMargins(3.2, 1.5, 2, 1);
            
            $encabezado = $pdf->openObject();
            $pdf->saveState();            
            $pdf->addPngFromFile("img/logo_tetrafarm.png", 350, 750, 209, 71);
            $pdf->setStrokeColor(0.6,0.6,0.6);
            
            $pdf->restoreState();
            $pdf->closeObject();
            $pdf->addObject($encabezado, 'all');
            
            $fuente = 11;
            
            $pdf->ezText("<u>INFORME DE OPERACION</u>", 16, array('justification'=>"center"));
            $pdf->ezSetDy(-$fuente);
            $pdf->ezText("Por el presente documento se certifica la operación de la granuladora marca: PKalp21", $fuente, array('justification'=>"left"));            
            $pdf->ezText("<u>Producto elaborado:</u> <i>{$proceso['Proceso']['d_producto']}</i>", $fuente, array('spacing'=>2));
            $pdf->ezText("<u>Numero de lote:</u> <i>{$proceso['Proceso']['d_lote']}</i>", $fuente, array('spacing'=>2));
            $pdf->ezText("<u>Operario a cargo:</u> <i>{$proceso['Proceso']['d_operario']}</i>", $fuente, array('spacing'=>2));
            $pdf->ezText("<u>Fecha y hora inicio proceso:</u> <i>{$fechaHoraInicio}</i>", $fuente, array('spacing'=>2));
            
            $pdf->ezSetDy(-30);
            $pdf->ezText("<u>Detalle pasos de proceso:</u>");            
                        
            $data = array();
            foreach($etapas as $i=>$etapa) {
                $data[$i][0] = $etapa['Etapa']['d_etapa'];
                $data[$i][1] = @$data[$i-1] == null ? $this->formatearHora($proceso['Proceso']['f_inicio']) : $data[$i-1][2];
                $data[$i][2] = $this->formatearHora($etapa['EtapaProceso']['f_fin']);
            }
            
            $cols = array();
            $cols[0] = "Paso";
            $cols[1] = "Fecha y hora inicio";
            $cols[2] = "Fecha y hora fin";
            
            $pdf->ezSetDy(-10);
            $pdf->ezTable($data, $cols,"",array('showLines'=>2,'shaded'=>0,'cols'=>array(array('width'=>250), array('width'=>125), array('width'=>125))));
            
            $pdf->ezSetDy(-30);
            $pdf->ezText("<u>Alarmas y novedades:</u>");
            $pdf->addText($pdf->ez['leftMargin'], 100, $fuente, "Firma y aclaración responsable Producción:");
            $pdf->line(350, 100, $pdf->ez['pageWidth'] - $pdf->ez['leftMargin'], 100);
                    
            $output = $pdf->ezOutput();
            ## PDF - FIN ##
            
            header("Cache-Control: public, must-revalidate", true);
            header("Pragma: hack", true);
            header("Content-Type: application/pdf");

            header("Content-Disposition: attachment; filename={$filename}.pdf");
            header("Content-Length: ".strlen(ltrim($output)));
            
            echo $output;
            
            $this->autoRender = false;
        }
    }
?>
