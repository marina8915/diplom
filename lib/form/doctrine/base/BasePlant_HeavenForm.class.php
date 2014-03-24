<?php

/**
 * Plant_Heaven form base class.
 *
 * @method Plant_Heaven getObject() Returns the current form's model object
 *
 * @package    marina
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlant_HeavenForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'plant_id'  => new sfWidgetFormInputHidden(),
      'heaven_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'plant_id'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('plant_id')), 'empty_value' => $this->getObject()->get('plant_id'), 'required' => false)),
      'heaven_id' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('heaven_id')), 'empty_value' => $this->getObject()->get('heaven_id'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('plant_heaven[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plant_Heaven';
  }

}
