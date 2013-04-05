<?php
    class EtapaProceso extends AppModel {
        public $useTable = "log_proceso_etapa";
        public $belongsTo = array(
            "Etapa" => array(
                'className' => 'Etapa',
                'foreignKey' => 'id_etapa',                
            )
        );
    }
?>
