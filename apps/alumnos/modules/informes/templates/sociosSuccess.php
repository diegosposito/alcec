<br>
<h1 align="center" style="color:black;">Padron de Socios</h1>

 <a target="_blank" href="<?php echo url_for('informes/padronsocios') ?>"><img src='<?php echo $sf_request->getRelativeUrlRoot();?>/images/printer.png' align='center' size='20' /></a>
<table cellspacing="0" class="stats">
     <tr>
                  <td width="30%" align="center" class="hed">Nombre</td>
                  <td width="20%" align="center" class="hed">Dirección</td>
                  <td width="10%" align="center" class="hed">Teléfono</td>
                  <td width="10%" align="center" class="hed">Móvil</td>
                  <td width="25%" align="center" class="hed">Email</td>
      </tr>
    <tbody>
      <?php $i=0; $ciudad='NULL';?>
      <?php foreach ($profesionaless as $profesionales){ ?>
  
      <tr class="fila_<?php echo $i%2 ; ?>">
          <td width="30%" align="left"><?php echo $profesionales->getApellido().', '.$profesionales->getNombre()  ?></td>
          <td width="20%" align="left"><?php echo $profesionales->getDireccion()  ?></td>
          <td width="10%" align="left"><?php echo $profesionales->getTelefono()  ?></td>
          <td width="10%" align="left"><?php echo $profesionales->getCelular() ?></td>
          <td width="25%" align="left"><?php echo $profesionales->getEmail() ?></td>
      </tr>
      <?php $i++; ?>
      <?php } ?>

      <br>
  
    </tbody>
  </table>