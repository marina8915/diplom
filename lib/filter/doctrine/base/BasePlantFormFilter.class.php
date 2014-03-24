<?php

/**
 * Plant filter form base class.
 *
 * @package    marina
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasePlantFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'seed_price'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'price'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fertilizer_mass'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'seeding_rate'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'growing_rate'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fuel'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'man_hours'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'fertilizer_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fertilizer'), 'add_empty' => true)),
      'prevs_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Plant')),
      'nexts_list'        => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Plant')),
      'ground_types_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'GroundType')),
      'heavens_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Heaven')),
    ));

    $this->setValidators(array(
      'name'              => new sfValidatorPass(array('required' => false)),
      'seed_price'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'fertilizer_mass'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'seeding_rate'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'growing_rate'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fuel'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'man_hours'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'fertilizer_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Fertilizer'), 'column' => 'id')),
      'prevs_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Plant', 'required' => false)),
      'nexts_list'        => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Plant', 'required' => false)),
      'ground_types_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'GroundType', 'required' => false)),
      'heavens_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Heaven', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('plant_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addPrevsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.PlantRelation PlantRelation')
      ->andWhereIn('PlantRelation.prev_plant_id', $values)
    ;
  }

  public function addNextsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.PlantRelation PlantRelation')
      ->andWhereIn('PlantRelation.next_plant_id', $values)
    ;
  }

  public function addGroundTypesListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->andWhereIn('Plant_Ground.ground_id', $values)
    ;
  }

  public function addHeavensListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.Plant_Heaven Plant_Heaven')
      ->andWhereIn('Plant_Heaven.heaven_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'Plant';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'name'              => 'Text',
      'seed_price'        => 'Number',
      'price'             => 'Number',
      'fertilizer_mass'   => 'Number',
      'seeding_rate'      => 'Number',
      'growing_rate'      => 'Number',
      'fuel'              => 'Number',
      'man_hours'         => 'Number',
      'fertilizer_id'     => 'ForeignKey',
      'prevs_list'        => 'ManyKey',
      'nexts_list'        => 'ManyKey',
      'ground_types_list' => 'ManyKey',
      'heavens_list'      => 'ManyKey',
    );
  }
}
