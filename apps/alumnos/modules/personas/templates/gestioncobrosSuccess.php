<script>

$(document).ready(function(){
    
   // $("#inicio").mask("99/99/9999");
   // $("#fin").mask("99/99/9999");
    
    $('#botonlista').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('personas/obtenerrecibosporestado'); ?>",
          { seleccionar: $("#seleccionar").val(), seleccionar2: $("#seleccionar2").val(), idmes: $("#idmes").val(), idanio: $("#idanio").val()},
        function(data){
            $('#idresultados').html(data);
        }
        );
    }); 

});    

</script>
<br>
<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>
<div align="left"><p style="color:green"><b> <?php echo $msgSuccess ?> </b></p></div>

</br>
<h3 align="center">Gestión de Cobros </h3>
<h4>Observaciones: </h4>
<h5>Debe marcar los registros que no pudieron cobrarse, dejando sin marcar los que pudieron cobrarse. </h5>

<form action="<?php echo url_for('personas/gestioncobros') ?>" method="post" id="formLista">
  <table cellspacing="0" class="stats" width="100%">
    <tr>
    <td colspan="2" width="10%"><b>Seleccionar Estado:</b></td>
    <td>
    <?php
      //el bucle para cargar las opciones
      echo "<select id='seleccionar' name='seleccionar' >";
      
      foreach ($estados as $k => $v){
        echo "<option value=".$k.">".$v."</option>";
      }
      echo "</select>";
    ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" width="10%"><b>Seleccionar Cobrador:</b></td>
    <td>
    <?php
       echo "<select id='seleccionar2' name='seleccionar2' >";
       echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
       foreach ($cobradores as $cobrador){
          echo "<option value=".$cobrador["idpersona"].">".$cobrador["nombrecompleto"]."</option>";
       }
       echo "</select>";
     ?>
    </td>
  </tr> 

  <tr>
      <td colspan="2" width="10%"><b>Mes:</b></td>
      <td>
      <select id="idmes" name="idmes">
      <?php for ($mes = 1; $mes <= 12; $mes++) { ?>
        <option value="<?php echo $mes ?>" <?php if ($mes == $messeleccionado) { ?>selected<?php } ?>><?php echo $mes ?></option>
      <?php } ?>
      </select>        
      </td>
      </tr> 
     
      <tr>
      <td colspan="2" width="10%"><b>Año:</b></td>
      <td>
      <select id="idanio" name="idanio">
      <?php for ($anio = date("Y")-1; $anio < date("Y")+2; $anio=$anio+1) { ?>
        <option value="<?php echo $anio ?>" <?php if ($anio == $anioseleccionado) { ?>selected<?php } ?>><?php echo $anio ?></option>
      <?php } ?>
      </select>        
      </td>
  </tr> 
    
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <input type="button" value="Mostrar recibos" name="botonlista" id="botonlista" />
        </td>
        <td colspan="2" align="center">
          <input type="submit" value="Marcar como Cobrados" id="botoncobrar" />
        </td>
      </tr>
    </tfoot>
  </table>
  <br>
  <div id="idresultados" name="resultados" align="center"></div>
</form>
</div><br>

