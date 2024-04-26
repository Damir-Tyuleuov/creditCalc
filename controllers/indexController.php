<?php
namespace controllers;
use controllers\BaseController;
use models\funCredit;

class IndexController extends BaseController
{
    public function actionIndex()
    {
        $credit = new  funCredit();
        $this->render('views\credit\index.php',["credit"=>$credit]);
    }
}

?>