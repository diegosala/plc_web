<?php
    $this->Paginator->options(array(
        'update' => '#listado',
        'evalScripts' => true
    ));      
?>       
<?php    
    if(!$isAjax) { ?>
<h1>Procesos</h1>
<?php 
    } 
?>               
<div id="listado">
    <table class="table table-bordered table-hover">        
            <tr style="font-weight: bold;">
                <td style="width: 5%;"><?php echo $this->Paginator->sort('id') ?></td>
                <td style="width: 23%;"><?php echo $this->Paginator->sort('d_producto', "Producto") ?></td>
                <td style="width: 21%;"><?php echo $this->Paginator->sort('d_lote', "Lote") ?></td>
                <td style="width: 21%;"><?php echo $this->Paginator->sort('d_operario', "Operario") ?></td>
                <td style="width: 16%;"><?php echo $this->Paginator->sort('f_inicio', "Inicio") ?></td>
                <td style="width: 7%; text-align: center;">Ver</td>
                <td style="width: 7%; text-align: center;">Exportar</td>
            </tr>        
<?php
    foreach($procesos as $proceso) {
?>   
        <tr>
            <td><?php echo $proceso['Proceso']['id']?></td>
            <td><?php echo $proceso['Proceso']['d_producto']?></td>
            <td><?php echo $proceso['Proceso']['d_lote']?></td>
            <td><?php echo $proceso['Proceso']['d_operario']?></td>            
            <td><?php echo $proceso['Proceso']['f_inicio']?></td>
            <td style="text-align: center;">
                <?php echo $this->Html->link("<i class='icon-zoom-in'></i>", array(
                    'controller'=>"Procesos",
                    'action'=>"detalle",
                    $proceso['Proceso']['id']
                    ),
                    array('escape' => false)
                );
                ?>
            </td>
            <td style="text-align: center;"><a href="#"><i class="icon-print"></i></a></td>
        </tr>     
<?php  
    }        
?>    
    </table>
    <div style="text-align: center" class="pagination">
    <ul>
<?php
    echo $this->Paginator->prev(
        "<<",        
        array(
            'class' =>"",
            'tag'=>"li",
            'disabledTag'=>"a",
        ),
        null,
        array(
            'class' =>"disabled",
            'tag'=>"li",
            'disabledTag'=>"a",
        )
    );
    
    echo $this->Paginator->numbers(
        array(
            'before'=>"",
            'after'=>"",
            'tag'=>"li",
            'class'=>"",
            'currentClass'=>"disabled",
            'currentTag'=>"a",
            'separator'=>"",        
        )    
    );       
    
    echo $this->Paginator->next(
        ">>",        
        array(
            'class' =>"",
            'tag'=>"li",
            'disabledTag'=>"a",
        ),
        null,
        array(
            'class' =>"disabled",
            'tag'=>"li",
            'disabledTag'=>"a",
        )
    ); 
?>    
    </ul>
</div>
</div>
<?php        
    echo $this->Js->writeBuffer();    
?>