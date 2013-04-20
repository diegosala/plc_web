<script type="text/javascript">
$(document).ready(function(){
    $("#barraNavegacion").children().removeClass("active");
});
</script>
<h1>Proceso <?php echo $proceso['Proceso']['id'] ?></h1> 
<br />
<table class="table" style="width: 550px">
    <tr>
        <td><strong>Producto elaborado</strong></td>
        <td><?php echo $proceso['Proceso']['d_producto']?></td>
    </tr>
    <tr>
        <td><strong>Número de lote</strong></td>
        <td><?php echo $proceso['Proceso']['d_lote']?></td>
    </tr>
    <tr>
        <td><strong>Operario a cargo</strong></td>
        <td><?php echo $proceso['Proceso']['d_operario']?></td>
    </tr>
    <tr>
        <td><strong>Fecha y hora de inicio</strong></td>
        <td><?php echo date("d/m/Y H:i:s", strtotime($proceso['Proceso']['f_inicio']))?></td>
    </tr>    
</table>
<h3>Detalle pasos de proceso</h3>
<table class="table table-bordered table-striped">
    <tr>
        <td><strong>Paso</strong></td>
        <td><strong>Fecha y hora inicio</strong></td>
        <td><strong>Fecha y hora fin</strong></td>
    </tr>
    <?php for($i=0; $i < count($etapas); $i++) { 
        $etapa = $etapas[$i];
        if (@$etapas[$i - 1] == null)
            $f_inicio = $proceso['Proceso']['f_inicio'];        
        else
            $f_inicio = $etapas[$i - 1]['EtapaProceso']['f_fin'];
    ?>
    <tr>
        <td><?php echo $etapa['Etapa']['d_etapa'] ?></td>
        <td><?php echo date("d/m/Y H:i:s", strtotime($f_inicio)) ?></td>
        <td><?php echo date("d/m/Y H:i:s", strtotime($etapa['EtapaProceso']['f_fin'])) ?></td>
    </tr>
    <?php } ?>
</table>
<h3>Velocidades</h3>
<table class="table table-bordered">    
    <?php for($i=0; $i < count($velocidades); $i++) { 
        $velocidad = $velocidades[$i];        
    ?>
    <tr>
        <td><?php echo $velocidad['Velocidad']['d_velocidad'] ?></td>
        <td><?php echo $velocidad['VelocidadProceso']['n_velocidad'] ?> RPM</td>
    </tr>
    <?php } ?>
</table>
<div class="well">
<?php echo $this->Html->link("<i class='icon-print'></i> Generar informe", array(
                    'controller'=>"Procesos",
                    'action'=>"reporte",
                    $proceso['Proceso']['id']
                    ),
                    array('escape' => false)
                );
?>
</div>
