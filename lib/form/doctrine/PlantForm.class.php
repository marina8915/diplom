<?php

/**
 * Plant form.
 *
 * @package    marina
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PlantForm extends BasePlantForm
{
  public function configure()
  {
      unset($this['prevs_list']);
      unset($this['nexts_list']);
  }
}
