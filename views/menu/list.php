<?php
/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \app\models\search\MenuSearch */
use yii\bootstrap\Html;
use app\components\widgets\GridView;

$this->title = '菜单管理';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dataTables_wrapper">
    <div class="row">
        <div class="col-sm-12">
            <?= Html::button('搜索', ['class' => 'btn btn-info']); ?>
            <div class="hr dotted"></div>
            <?= Html::a('新增', ['menu/add'], ['class' => 'btn btn-info fr']); ?>
        </div>
    </div>
</div>
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
