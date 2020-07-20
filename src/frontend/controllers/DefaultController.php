<?php

namespace afashio\pages\frontend\controllers;

use \afashio\pages\models\Page;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    /**
     * @return mixed|string
     */
    public function getViewPath()
    {
        return \Yii::getAlias('@frontend/views/page');
    }


    public function actionView($slug)
    {
        $model = $this->findModel($slug);

        return $this->render('view', compact('model'));
    }


    /**
     * @param $slug string
     *
     * @return \afashio\pages\models\Page
     * @throws NotFoundHttpException
     */
    private function findModel($slug): \afashio\pages\models\Page
    {
        if ($model = Page::findBySlug($slug)) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }

}
