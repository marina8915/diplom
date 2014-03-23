<?php

/**
 * Field form base class.
 *
 * @method Field getObject() Returns the current form's model object
 *
 * @package    marina
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseFieldForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'name'           => new sfWidgetFormInputText(),
      'prev_plant_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Plant'), 'add_empty' => true)),
      'width'          => new sfWidgetFormInputText(),
      'length'         => new sfWidgetFormInputText(),
      'ground_type_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('GroundType'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'           => new sfValidatorString(array('max_length' => 255)),
      'prev_plant_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Plant'), 'required' => false)),
      'width'          => new sfValidatorInteger(),
      'length'         => new sfValidatorInteger(),
      'ground_type_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('GroundType'), 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Field', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('field[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Field';
  }

}
