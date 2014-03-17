<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($field->getId(), 'field_edit', $field) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $field->getName() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_prev_plant_id">
  <?php echo $field->getPlant()->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_prev_width">
    <?php echo $field->getWidth() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_prev_length">
    <?php echo $field->getLength() ?>
</td>
