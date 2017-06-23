<?php
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\MenuSearch */
use app\components\helpers\Html;
use app\components\widgets\GridView;
use app\components\widgets\ActiveForm;

$this->title = '菜单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(['module' => ActiveForm::TYPE_SEARCH]); ?>
<?= $form->field($searchModel, 'name'); ?>
<div class="form-group">
    <?= Html::submitButton('搜 索', ['class' => 'btn btn-info']); ?>
    <?= Html::a('新 增', ['menu/add'], ['class' => 'btn btn-info', 'target' => '_blank']); ?>
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
