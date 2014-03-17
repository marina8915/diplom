<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($plant_relation->getId(), 'plant_relation_edit', $plant_relation) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_value">
  <?php echo $plant_relation->getValue() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_prev_plant_id">
  <?php echo $plant_relation->getPrevPlant()->getName() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_next_plant_id">
  <?php echo $plant_relation->getNextPlant()->getName() ?>
</td>
