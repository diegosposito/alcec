<script>
$(document).ready(function(){
 
    $('#botonlista').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('personas/obtenerrecibosgenerados'); ?>",
          { permite_seleccionar: '1', idmes: $('#idmes').val(), idanio: $('#idanio').val()},
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
<h3 align="center">Generar recibos del mes actual </h3>
<h4>Observaciones: </h4>
<h5>Se pueden marcar registros que se considere no deberían generarse para este mes, por el motivo que corresponda. </h5>

<form action="<?php echo url_for('personas/grabarrecibosgenerados') ?>" method="post" id="formLista">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
      <td align="center" colspan="4"><b>Mes     : </b>
      <select id="idmes" name="idmes">
      <?php for ($mes = 1; $mes <= 12; $mes++) { ?>
        <option value="<?php echo $mes ?>" <?php if ($mes == $messeleccionado) { ?>selected<?php } ?>><?php echo $mes ?></option>
      <?php } ?>
      </select>        
      </td>
      </tr> 
      <tr>
      <td align="center" colspan="4"><b>Año     : </b>
      <select id="idanio" name="idanio">
      <?php for ($anio = date("Y")-1; $anio < date("Y")+2; $anio=$anio+1) { ?>
        <option value="<?php echo $anio ?>" <?php if ($anio == $anioseleccionado) { ?>selected<?php } ?>><?php echo $anio ?></option>
      <?php } ?>
      </select>        
      </td>
      </tr>     
      <tr>
        <td colspan="2" align="center">
          <input type="button" value="Mostrar recibos a generar" name="botonlista" id="botonlista" />
        </td>
        <td colspan="2" align="center">
          <input type="submit" value="Generar recibos" id="botonasignar" />
        </td>
      </tr>
    </tfoot>
  </table>
  <br>
  <div id="idresultados" name="resultados" align="center"></div>
</form>

