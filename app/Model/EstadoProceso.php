<?php
    class EstadoProceso extends AppModel {
        public $useTable = "log_proceso_estado";
        public $belongsTo = array(
            "Estado" => array(
                'className' => 'Estado',
                'foreignKey' => 'id_estado',                
            )
        );
    }
?>
