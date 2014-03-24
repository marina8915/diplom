<?php

/**
 * GroundType filter form base class.
 *
 * @package    marina
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseGroundTypeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'plants_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Plant')),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorPass(array('required' => false)),
      'plants_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Plant', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ground_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addPlantsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.Plant_Ground Plant_Ground')
      ->andWhereIn('Plant_Ground.plant_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'GroundType';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'name'        => 'Text',
      'plants_list' => 'ManyKey',
    );
  }
}
