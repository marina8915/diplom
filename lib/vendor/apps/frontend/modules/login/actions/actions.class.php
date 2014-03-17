<?php

/**
 * login actions.
 *
 * @package    tm
 * @subpackage login
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class loginActions extends sfActions
{
    public function executeLoginform(sfWebRequest $request){
    }

    public function executeLogout(sfWebRequest $request){
        $this->getUser()->setAuthenticated(false);
        $this->getUser()->removeCredential('admin');
        $this->redirect('@homepage');
    }

    public function executeEditpass(sfWebRequest $request){
        $newpassword = $request->getParameter('newpassword');
        $oldpassword = $request->getParameter('oldpassword');
        if (isset($newpassword) && isset($oldpassword)){
            $pass = SettingsTable::getPassword();
            if( $oldpassword == $pass->getValue() ){
                $pass->setValue($newpassword);
                $pass->save();
                $this->redirect('@homepage');
            }
        }
    }

    public function executeLogin(sfWebRequest $request){
        $this->getUser()->setAuthenticated(false);
        $pass = SettingsTable::getPassword();
        $pass  = $pass->getValue();
        if( $request->getParameter('password') == $pass ){
            $this->getUser()->setAuthenticated(true);
            $this->getUser()->addCredential('admin');
            $this->redirect('@homepage');
        } else {
            //$this->getUser()->setFlash('notice', $request->getParameter('password') . '=');
            $this->setTemplate('loginform');
        }
    }

}
