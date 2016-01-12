<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\smile\modules\dropzone\controllers;
use backend\smile\modules\dropzone\models\SmileDropZoneModel;
use yii\helpers\VarDumper;
use Yii;
use yii\web\Response;
use backend\smile\controllers\SmileBackendController;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class DropZoneController extends SmileBackendController
{
    const IMG_MAX_WIDTH = 2048;
    const IMG_MIN_WIDTH = 156;
    const IMG_MAX_HEIGHT = 1536;
    const IMG_MIN_HEIGHT = 156;

    public function actionLoad(){

    }

    public function actionUpload()
    {
        Yii::$app->response->getHeaders()->set('Vary', 'Accept');
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isset($_FILES['images']) && Yii::$app->request->get('id') && Yii::$app->request->get('class')) {
            $model_id = Yii::$app->request->get('id');
            $model_class = Yii::$app->request->get('class');

            $model =  new SmileDropZoneModel();
            $response = $model->saveImage($model_id, $model_class);
            if($response){
                return $response;
            }
        }
        return ['error' => Yii::t('backend', 'Невозможно сохранить картинку')];
   }

    public function actionDelete(){
        if(Yii::$app->request->isAjax){
            $model = new SmileDropZoneModel();
            $model->initFields(Yii::$app->request->get('id'),Yii::$app->request->get('class'));
            if(Yii::$app->request->get('id_image')){
                $model = $model->findOne(Yii::$app->request->get('id_image'))->delete();
                return $model;
            }
        }
        return 0;
    }

    public function actionSort(){
        if(Yii::$app->request->isAjax){
            $images = Yii::$app->request->get('image',[]);
            if($images){
                foreach($images as $id=>$param){
                    $model = new SmileDropZoneModel();
                    $model->initFields($param['class_id'],$param['class']);
                    $model = $model->findOne($id);
                    $model->order = $param['order'];
                    $model->save();
                }
            }
        }
    }
}
