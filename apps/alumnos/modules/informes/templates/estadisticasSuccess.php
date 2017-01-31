<br>
<h1 align="center" style="color:black;">Estadísticas - Recibos cobrados</h1>
<br>
<form action="<?php echo url_for('informes/estadisticas'); ?>" method="post" >
<p align="center"><b>Período     : </b>
      <select id="idanio" name="idanio">
      <?php for ($anio = date("Y"); $anio > date("Y")-20; $anio=$anio-1) { ?>
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
      <div align=center>
      <input type="submit" value="Mostrar" title="Mostrar" id="imprimir" class="form_consulta_enviar" name="Imprimir">       
      </div>
   

<table cellspacing="0" class="stats">
     <tr>
                  <td width="30%" align="center" class="hed">Mes</td>
                  <td width="20%" align="center" class="hed">Año</td>
                  <td width="10%" align="center" class="hed">Cant. Recibos</td>
                  <td width="10%" align="center" class="hed">Monto Total</td>
                 
      </tr>
    <?php foreach ($resultadoss as $data): ?>
    <tr>
      <td align="center"><?php echo $data['mesanio']; ?></td>
      <td align="center"><?php echo $data['anio']; ?></td>
      <td align="center"><?php echo $data['cantidad']; ?></td>
      <td align="center" class="resaltar_amarillosolido"><?php echo $data['monto']; ?></td>
    </tr>
    <?php endforeach; ?>
    <tbody>
</table>
<br>
<p>Detalle del período seleccionado</p>
<?php 
if(count($detalless) > 0) { ?>
	 
	 <table width="100%"cellspacing="0" class="stats">
     <tr>
                  <td width="40%" align="center" class="hed">Socio</td>
                  <td width="30%" align="center" class="hed">Período</td>
                  <td width="5%" align="center" class="hed">Importe</td>
                  <td width="25%" align="center" class="hed">Cobrador</td>
      </tr>
    <?php foreach ($detalless as $data): ?>
    <tr>
      <td align="left"><?php echo $data['apellidonombre']; ?></td>
      <td align="left"><?php echo $data['mesanio']; ?></td>
      <td align="center" class="resaltar_amarillosolido"><?php echo $data['monto']; ?></td>
      <td align="left"><?php echo $data['cobrador']; ?></td>
    </tr>
    <?php endforeach; ?>
    <tbody>
    </table>

<?php } ?>
</form>