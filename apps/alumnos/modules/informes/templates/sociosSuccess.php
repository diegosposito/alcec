<br>
<h1 align="center" style="color:black;">Padron de Socios <?php echo $modoactivo ?></h1>
<br>


<a target="_blank" href="<?php echo url_for('informes/padronsocios?idcobrador='.$idcobrador.'&idmodopago='.$idmodopago) ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>

<form action="<?php echo url_for('informes/socios') ?>" method="post" id="formLista">
<table cellspacing="0" class="stats">
 <tr>
    <td colspan="2" width="10%"><b>Seleccionar Modo Pago:</b></td>
    <td>
    <?php
       echo "<select id='seleccionar3' name='seleccionar3' >";
       echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
       foreach ($modos as $k => $v){
          echo "<option value=".$k.">".$v."</option>";
       }
       echo "</select>";
     ?>
    </td>
  </tr> 
  <tr>
    <td colspan="2" width="10%"><b>Seleccionar Activos o Todos:</b></td>
    <td>
    <?php
       echo "<select id='seleccionar4' name='seleccionar4' >";
       echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
       foreach ($socios as $k => $v){
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
        <td colspan="2" align="center">
          <input type="submit" value="Mostrar Socios" id="botonimprimir" />
        </td>
        <td colspan="2" align="center">
          <p><?php echo ($idcobrador>0) ? $oCobrador->getApellido().", ".$oCobrador->getNombre() : ''; echo ' ('.$modopago.')' ?></p>
        </td>
  </tr>
     <tr>
                  <td width="30%" align="center" class="hed">Nombre</td>
                  <td width="20%" align="center" class="hed">Dirección</td>
                  <td width="10%" align="center" class="hed">Documento</td>
                  <td width="8%" align="center" class="hed">Teléfono</td>
                  <td width="7%" align="center" class="hed">Monto</td>
                  <td width="20%" align="center" class="hed">Pago</td>
      </tr>
    <tbody>
      <?php $i=0; $ciudad='NULL';?>
      <?php foreach ($profesionaless as $profesionales){ ?>
  
      <tr class="fila_<?php echo $i%2 ; ?>">
          <td width="30%" align="left"><?php echo $profesionales['apellido'].', '.$profesionales['nombre']  ?></td>
          <td width="20%" align="left"><?php echo $profesionales['direccion']  ?></td>
          <td width="10%" align="left"><?php echo $profesionales['numerodoc']  ?></td>
          <td width="8%" align="left"><?php echo $profesionales['telefono']  ?></td>
          <td width="7%" align="left"><?php echo $profesionales['monto'] ?></td>
          <td width="20%" align="left"><?php echo $profesionales['tipopago'] ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
    
  </table>
  <?php echo "Total: ".$i; ?>
  </form>