<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('documentacion/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?iddocumentacion='.$form->getObject()->getIddocumentacion() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Eliminar', 'documentacion/delete?iddocumentacion='.$form->getObject()->getIddocumentacion(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Guardar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td><?php echo $form['descripcion']->renderLabel() ?></td>
        <td>
          <?php echo $form['descripcion']->renderError() ?>
          <?php echo $form['descripcion'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idtipodocumentacion']->renderLabel() ?></td>
        <td>
          <?php echo $form['idtipodocumentacion']->renderError() ?>
          <?php echo $form['idtipodocumentacion'] ?>
        </td>
      </tr>      
      <tr>
        <td><?php echo $form['orden']->renderLabel() ?></td>
        <td>
          <?php echo $form['orden']->renderError() ?>
          <?php echo $form['orden'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['activo']->renderLabel() ?></td>
        <td>
          <?php echo $form['activo']->renderError() ?>
          <?php echo $form['activo'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('documentacion/index') ?>'"></p>
<br>