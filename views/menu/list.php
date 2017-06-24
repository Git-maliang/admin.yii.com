<?php

use app\components\helpers\Html;
use app\components\widgets\GridView;
use app\components\widgets\ActiveForm;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\MenuSearch */

$this->title = '菜单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['module' => ActiveForm::TYPE_SEARCH]); ?>
<?= $form->field($searchModel, 'name'); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('common', 'Search'), ['class' => 'btn btn-info']); ?>
    <?= Html::a(Yii::t('common', 'Create'), ['menu/create'], ['class' => 'btn btn-success', 'target' => '_blank']); ?>
    <?= Html::a(Yii::t('common', 'Menu Sort'), ['menu/sort'], ['class' => 'btn btn-warning', 'target' => '_blank']); ?>
</div>
<?php ActiveForm::end(); ?>
<div class="hr dotted"></div>
<?= GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'id',
        'name',
        'icon:icon',
        'route',
        'created_at:datetime',
        ['class' => 'app\components\grid\ActionColumn']
    ]
]); ?>
