<td colspan="6">
  <?php echo __('%%username%% - %%created_at%% - %%updated_at%% - %%last_login%% - %%sede%% - %%area%%', array('%%username%%' => link_to($sf_guard_user->getUsername(), 'sf_guard_user_edit', $sf_guard_user), '%%created_at%%' => false !== strtotime($sf_guard_user->getCreatedAt()) ? format_date($sf_guard_user->getCreatedAt(), "dd/M/yyyy") : '&nbsp;', '%%updated_at%%' => false !== strtotime($sf_guard_user->getUpdatedAt()) ? format_date($sf_guard_user->getUpdatedAt(), "dd/M/yyyy") : '&nbsp;', '%%last_login%%' => false !== strtotime($sf_guard_user->getLastLogin()) ? format_date($sf_guard_user->getLastLogin(), "dd/M/yyyy hh:mm") : '&nbsp;', '%%sede%%' => $sf_guard_user->getSede(), '%%area%%' => $sf_guard_user->getArea()), 'messages') ?>
</td>
