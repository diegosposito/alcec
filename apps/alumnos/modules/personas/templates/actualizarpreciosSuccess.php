<script>
$(document).ready(function(){
 
    $('#botonlista').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('personas/obtenersociosporprecio'); ?>",
          { permite_seleccionar: '1', idprecio: $('#idprecio').val()},
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
<h3 align="center">Actualizar precios en forma masiva </h3>
<h4>IMPORTANTE: </h4>
<h5>Lo ideal es utilizar este módulo actualizando primero el mayor precio y asi sucesivamente hasta el menor precio, para evitar mezclar grupos. </h5>

<form action="<?php echo url_for('personas/grabarrecibosgenerados') ?>" method="post" id="formLista">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
      <td align="center" colspan="4"><b>Precios     : </b>
      <select id="idprecio" name="idprecio">
      <?php foreach ($precios as $precio) { ?>
        <option value="<?php echo $precio['monto']  ?>" <?php if ($precio['monto'] == $precioseleccionado) { ?>selected<?php } ?>><?php echo $precio['monto'] ?></option>
      <?php } ?>
      </select>        
      </td>
      </tr> 
      <tr>
      <td align="center" colspan="4"><b>Nuevo Precio     : </b>
      <input type="text" size="10" id="nuuevoprecio" name="nuevoprecio" />      
      </td>
      </tr> 
      <tr>
        <td colspan="2" align="center">
          <input type="button" value="Mostrar socios con precio seleccionado" name="botonlista" id="botonlista" />
        </td>
        <td colspan="2" align="center">
          <input type="submit" value="Actualizar precios" id="botonasignar" />
        </td>
      </tr>
    </tfoot>
  </table>
  <br>
  <div id="idresultados" name="resultados" align="center"></div>
</form>

