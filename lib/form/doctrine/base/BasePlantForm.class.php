<?php

/**
 * Plant form base class.
 *
 * @method Plant getObject() Returns the current form's model object
 *
 * @package    marina
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasePlantForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'seed_price'      => new sfWidgetFormInputText(),
      'price'           => new sfWidgetFormInputText(),
      'fertilizer_mass' => new sfWidgetFormInputText(),
      'seeding_rate'    => new sfWidgetFormInputText(),
      'growing_rate'    => new sfWidgetFormInputText(),
      'fuel'            => new sfWidgetFormInputText(),
      'man_hours'       => new sfWidgetFormInputText(),
      'fertilizer_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Fertilizer'), 'add_empty' => true)),
      'prevs_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Plant')),
      'nexts_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Plant')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 255)),
      'seed_price'      => new sfValidatorInteger(),
      'price'           => new sfValidatorNumber(),
      'fertilizer_mass' => new sfValidatorInteger(),
      'seeding_rate'    => new sfValidatorInteger(),
      'growing_rate'    => new sfValidatorInteger(),
      'fuel'            => new sfValidatorInteger(),
      'man_hours'       => new sfValidatorInteger(),
      'fertilizer_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Fertilizer'), 'required' => false)),
      'prevs_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Plant', 'required' => false)),
      'nexts_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Plant', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Plant', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('plant[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Plant';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['prevs_list']))
    {
      $this->setDefault('prevs_list', $this->object->Prevs->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['nexts_list']))
    {
      $this->setDefault('nexts_list', $this->object->Nexts->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePrevsList($con);
    $this->saveNextsList($con);

    parent::doSave($con);
  }

  public function savePrevsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['prevs_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Prevs->getPrimaryKeys();
    $values = $this->getValue('prevs_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Prevs', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Prevs', array_values($link));
    }
  }

  public function saveNextsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['nexts_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Nexts->getPrimaryKeys();
    $values = $this->getValue('nexts_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Nexts', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Nexts', array_values($link));
    }
  }

}
