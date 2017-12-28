<br>
<h1 align="center" style="color:black;">Estadísticas - Cobradores</h1>
<br>
<form action="<?php echo url_for('informes/cobradores'); ?>" method="post" >
<p align="center"><b>Período     : </b>
      <select id="idanio" name="idanio">
      <?php for ($anio = date("Y")+1; $anio > date("Y")-20; $anio=$anio-1) { ?>
        <option value="<?php echo $anio ?>" <?php if ($anio == $anioseleccionado) { ?>selected<?php } ?>><?php echo $anio ?></option>
      <?php } ?>
      </select>
 </p>
 <br>
 <p align="center"><b>Mes     : </b>
    <select id="idmes" name="idmes">
    echo "<option value='0' selected='selected' >----SELECCIONAR----</option>";
    <?php foreach($arrMeses as $k => $v) { ?>
        <option value="<?php echo $k ?>" <?php if ($k == $meseleccionado) { ?>selected<?php } ?>><?php echo $v ?></option>
      <?php } ?>
      </select>
 </p>   
 <br>
<p align="center"><b>Cobrador    : </b>
    <?php
       echo "<select id='idcobrador' name='idcobrador' >";
       echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
       foreach ($cobradores as $cobrador){
        if ($cobrador["idpersona"]==$idcobrador){
           echo "<option value=".$cobrador["idpersona"]." SELECTED>".$cobrador["nombrecompleto"]."</option>";
        } else {
          echo "<option value=".$cobrador["idpersona"].">".$cobrador["nombrecompleto"]."</option>";
        }
       }
       echo "</select>"; ?>
 </p>  

 <?php if ($meseleccionado>0 && $anioseleccionado > 0 && $idcobrador>0) { ?>
 <a target="_blank" href="<?php echo url_for('informes/cobradorespdf?idcobrador='.$idcobrador.'&idmes='.$meseleccionado.'&idanio='.$anioseleccionado) ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
 <?php } ?>

  <br>
      <div align=center>
      <input type="submit" value="Mostrar" title="Mostrar" id="imprimir" class="form_consulta_enviar" name="Imprimir">       
      </div>
      <br>
   
 <div align=center>
<table align="center" cellspacing="0" class="stats">
     <tr>
                  <td width="30%" align="center" class="hed">Cantidad</td>
                  <td width="30%" align="center" class="hed">Monto</td>
                  <td width="20%" align="center" class="hed">Subtotal</td>
                 
      </tr>
    <?php foreach ($resultadoss as $data): ?>
    <tr>
      <td align="center"><?php echo $data['cantidad']; ?></td>
      <td align="center"><?php echo $data['monto']; ?></td>
      <td align="center" class="resaltar_amarillosolido"><?php echo '$'.$data['subtotal']; ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
      <td colspan=4><?php echo ''; ?></td>
    </tr>
    <?php foreach ($gruposs as $gp): ?>
     <tr>
      <td align="center"><?php echo 'Cantidad : '.$gp['cantidad']; ?></td>
      <td align="center"><?php echo ''; ?></td>
      <td align="center" class="resaltar_amarillosolido"><?php echo 'Total: $'.$gp['subtotal']; ?></td>
    </tr>
    <?php endforeach; ?>
    <tbody>
</table>
</div>
<br>

</form>