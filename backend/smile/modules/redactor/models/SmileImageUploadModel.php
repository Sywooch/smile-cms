<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\smile\modules\redactor\models;

use yii\helpers\VarDumper;
use Yii;

/**
 * @author Nghia Nguyen <yiidevelop@hotmail.com>
 * @since 2.0
 */
class SmileImageUploadModel extends SmileFileUploadModel
{
    const IMG_MAX_WIDTH = 2048;
    const IMG_MAX_HEIGHT = 1536;
    public function rules()
    {
        return [
            ['file', 'file', 'extensions' => Yii::$app->controller->module->imageAllowExtensions]
        ];
    }
    public function upload()
    {
        if ($this->validate()) {
            $path = Yii::$app->controller->module->getFilePath($this->getFileName());
            $file = $this->file->saveAs($path, true);
//            VarDumper::dump($this->file,6,1);
//            VarDumper::dump($file,6,1);
//            die();
            if($file){
                $image = Yii::$app->image->load($path);
                if($image){
                    $image->resize(self::IMG_MAX_WIDTH,self::IMG_MAX_HEIGHT)->save($path,80);
                }
            }
            return $file;
        }
        return false;
    }
}