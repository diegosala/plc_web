<?php
    class VelocidadProceso extends AppModel {
        public $useTable = "log_proceso_velocidad";
        public $belongsTo = array(
            "Velocidad" => array(
                'className' => 'Velocidad',
                'foreignKey' => 'id_velocidad',                
            )
        );
    }
?>
