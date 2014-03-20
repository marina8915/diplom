<?php

/**
 * PlantRelation filter form base class.
 *
 * @package    marina
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePlantRelationFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'value'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'prev_plant_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('prev_plant'), 'add_empty' => true)),
      'next_plant_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('next_plant'), 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'value'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'prev_plant_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('prev_plant'), 'column' => 'id')),
      'next_plant_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('next_plant'), 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('plant_relation_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'PlantRelation';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'value'         => 'Number',
      'prev_plant_id' => 'ForeignKey',
      'next_plant_id' => 'ForeignKey',
    );
  }
}
