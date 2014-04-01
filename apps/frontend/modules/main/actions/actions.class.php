<?php

/**
 * main actions.
 *
 * @package    marina
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
    public function preExecute(){
        $this->fields = FieldTable::getAll()->execute();
        $this->form = new CalcForm();
        $this->fertilizers = FertilizerTable::getAll()->execute();
       // $this->ground = GroundTypeTable::getAll()->execute();
    }

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        // створюємо форму в preExecute
    }

    public function executeCalcResult(sfWebRequest $request)
    {
        // створюємо форму в preExecute
        $this->form = new CalcForm();

        // біндимо в форму параметри запиту
        $this->form->bind($request->getPostParameter($this->form->getName()));

        if($this->form->isValid()){

            // беремо з форми параметри запиту
            $configData = $this->form->getValues();
            $this->yearsCount = $configData['years'];
                // створюємо DTO об"єкт
            $this->calcConfig = CalcConfig::hydrate(new CalcConfig(), $configData);
            // знаходимо всі поля
            $this->fields = FieldTable::getAll()->execute();
            $this->ground = GroundTypeTable::getAll()->execute();
            $this->rentableManager = new RentableManager();
            // далі рендериться відображення apps/frontend/modules/main/templates/calcResultSuccess.php
        }
        else{
            // якщо форма не валідна - назад на заповнення
            $this->setTemplate('index');
        }
    }

}
