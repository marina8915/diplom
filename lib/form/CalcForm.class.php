<?php

/**
 * Base project form.
 * 
 * @package    marina
 * @subpackage form
 * @author     Your name here 
 * @version    SVN: $Id: BaseForm.class.php 20147 2009-07-13 11:46:57Z FabianLange $
 */
class CalcForm extends sfFormSymfony
{
    public function configure()
    {
        $this->setWidgets(array(
          'years'          => new sfWidgetFormInputText(array('default'=>1)),
            'fuel_price'          => new sfWidgetFormInputText(),
            'hour_price'          => new sfWidgetFormInputText(),
     //      'ground_type'   => new sfWidgetFormDoctrineChoice(array('model' => 'GroundType')),
            'heaven'   => new sfWidgetFormDoctrineChoice(array('model' => 'Heaven')),
         //   'plant' => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'Plant')),
            'plant' => new sfWidgetFormDoctrineChoice(array( 'model' => 'Plant')),
        ));

        $this->setValidators(array(
         'years'    => new sfValidatorInteger(array('required' => true)),
            'fuel_price'    => new sfValidatorNumber(array('required' => true)),
            'hour_price'    => new sfValidatorNumber(array('required' => true)),
   //        'ground_type' => new sfValidatorDoctrineChoice(array('model' => 'GroundType', 'required' => true)),
            'heaven' => new sfValidatorDoctrineChoice(array('model' => 'Heaven', 'required' => true)),
            'plant' => new sfValidatorDoctrineChoice(array('model' => 'Plant', 'required' => true)),
        ));

        $this->getWidgetSchema()->setLabels(array(
             'years'          => ' ',
            'fuel_price'          => 'Вартість топлива (грн/л)',
            'hour_price'          => 'Вартість години роботи (грн/годину)',
      //      'ground_type'   => 'Тип грунту',
            'heaven'   => 'Кліматична зона',
            'plant'   => 'Культура обов`язкова для посіву',
        ));

        $this->widgetSchema->setNameFormat('calc_form[%s]');

    }


}
