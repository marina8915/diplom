<?php

/**
 * PlantRelation form base class.
 *
 * @method PlantRelation getObject() Returns the current form's model object
 *
 * @package    marina
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlantRelationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'value'         => new sfWidgetFormInputText(),
      'prev_plant_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('prev_plant'), 'add_empty' => true)),
      'next_plant_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('next_plant'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'value'         => new sfValidatorInteger(),
      'prev_plant_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('prev_plant'), 'required' => false)),
      'next_plant_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('next_plant'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('plant_relation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PlantRelation';
  }

}
