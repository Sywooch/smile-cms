<?php
/**
 * Created by PhpStorm.
 * User: Kate
 * Date: 10.02.15
 * Time: 15:05
 * @var $model backend\modules\leader\models\leaderTranslate
 * @var $form yii\widgets\ActiveForm
 * @var $language string
 */
use yii\helpers\Html;
use yii\helpers\VarDumper;
use yii\helpers\StringHelper;
use yii\redactor\widgets\Redactor;
?>
<?php
$className = StringHelper::basename(get_class($model));
?>
    <?= $form->field($model, 'first_name')->textInput(array(
        'name' => $className.'['.$language.'][first_name]',
        'id' => $className.'_'.$language.'_'.'first_name'
    )); ?>
    <?= $form->field($model, 'last_name')->textInput(array(
        'name' => $className.'['.$language.'][last_name]',
        'id' => $className.'_'.$language.'_'.'last_name'
    )); ?>
<?php if(!$model->isNewRecord){
    ?>
    <?= $form->field($model, 'description')->widget(Redactor::className(), [
        'options' => [
            'name' => $className.'['.$language.'][description]',
            'id' => $className.'_'.$language.'_'.'description'
        ],
        'clientOptions' => [
            'minHeight'=>300,
            'placeholder'=>'Enter your text here...',
            'plugins' => [
                'fontsize','fontfamily','fontcolor','table','video','clips','counter','textdirection','fullscreen'
            ],
        ],
    ])?>
    <?php
    Yii::$app->session->set('redactorModuleName',$className);
    ?>
    <?php
}?>
    <?= $form->field($model, 'seotitle')->textInput(array(
        'name' => $className.'['.$language.'][seotitle]',
        'id' => $className.'_'.$language.'_'.'seotitle'
    )); ?>
    <?= $form->field($model, 'seokeywords')->textarea(array(
        'name' => $className.'['.$language.'][seokeywords]',
        'id' => $className.'_'.$language.'_'.'seokeywords'
    )); ?>
    <?= $form->field($model, 'seodescription')->textarea(array(
        'name' => $className.'['.$language.'][seodescription]',
        'id' => $className.'_'.$language.'_'.'seodescription'
    )); ?>
