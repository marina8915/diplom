<?php

/**
 * Heaven form base class.
 *
 * @method Heaven getObject() Returns the current form's model object
 *
 * @package    marina
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHeavenForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'name'        => new sfWidgetFormInputText(),
      'plants_list' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Plant')),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'        => new sfValidatorString(array('max_length' => 255)),
      'plants_list' => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'Plant', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Heaven', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('heaven[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Heaven';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['plants_list']))
    {
      $this->setDefault('plants_list', $this->object->Plants->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePlantsList($con);

    parent::doSave($con);
  }

  public function savePlantsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['plants_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Plants->getPrimaryKeys();
    $values = $this->getValue('plants_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Plants', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Plants', array_values($link));
    }
  }

}
