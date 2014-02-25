<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($plant->getId(), 'plant_edit', $plant) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $plant->getName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_seed_price">
  <?php echo $plant->getSeedPrice() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_price">
  <?php echo $plant->getPrice() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_fertilizer_mass">
  <?php echo $plant->getFertilizerMass() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_seeding_rate">
  <?php echo $plant->getSeedingRate() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_growing_rate">
  <?php echo $plant->getGrowingRate() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_fuel">
  <?php echo $plant->getFuel() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_man_hours">
  <?php echo $plant->getManHours() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_fertilizer_id">
  <?php echo $plant->getFertilizer()->getName() ?>
</td>
