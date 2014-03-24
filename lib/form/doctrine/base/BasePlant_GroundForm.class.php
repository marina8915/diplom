<?php

/**
 * Plant_Ground form base class.
 *
 * @method Plant_Ground getObject() Returns the current form's model object
 *
 * @package    marina
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlant_GroundForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'plant_id'  => new sfWidgetFormInputHidden(),
      'ground_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'plant_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('plant_id')), 'empty_value' => $this->getObject()->get('plant_id'), 'required' => false)),
      'ground_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('ground_id')), 'empty_value' => $this->getObject()->get('ground_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('plant_ground[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plant_Ground';
  }

}
