<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($menu->getId(), 'menu_edit', $menu) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_credencial">
  <?php echo $menu->getCredencial() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_modulo">
  <?php echo $menu->getModulo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_descripcion">
  <?php echo $menu->getDescripcion() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_parametro">
  <?php echo $menu->getParametro() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_idgrupomenu">
  <?php echo $menu->getIdgrupomenu() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_orden">
  <?php echo $menu->getOrden() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_idsistema">
  <?php echo $menu->getIdsistema() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($menu->getCreatedAt()) ? format_date($menu->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($menu->getUpdatedAt()) ? format_date($menu->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_created_by">
  <?php echo $menu->getCreatedBy() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_updated_by">
  <?php echo $menu->getUpdatedBy() ?>
</td>
