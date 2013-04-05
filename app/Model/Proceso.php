<?php
    class Proceso extends AppModel {
        public $useTable = "log_proceso";        
        public $hasMany = array(
        'EtapaProceso' => array(
            'className' => 'EtapaProceso',
            'foreignKey' => 'id_proceso',
            )
        ,        
        'VelocidadProceso' => array(
            'className' => 'VelocidadProceso',
            'foreignKey' => 'id_proceso',
            )
        );
    }
?>
