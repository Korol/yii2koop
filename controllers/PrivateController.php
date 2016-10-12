<?php
/**
 * Created by PhpStorm.
 * User: korol
 * Date: 12.10.16
 * Time: 20:02
 */

namespace app\controllers;
use Yii;

class PrivateController extends FrontendController {

    public function actionIndex()
    {
        return $this->render('index');
    }
} 