<?php
    class ProcesosController extends AppController {
        public $helpers = array ('Paginator', 'Js');
        public $components = array('Paginator', 'RequestHandler');
        
        public function listado() {
            $this->loadModel('Proceso');
            $this->loadModel('Etapa');
            $this->loadModel('EtapaProceso');
            $this->loadModel('VelocidadProceso');
            
            $this->Proceso->recursive = 2;
            
            
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
            
            $this->set("proceso", $this->Proceso->findById($idProceso));
        }
    }
?>
