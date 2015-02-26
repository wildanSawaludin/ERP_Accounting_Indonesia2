<?php
$this->breadcrumbs = [
    'U Sos' => ['index'],
    $model->id,
];


$this->menu = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m2/uSo']],
    ['label' => 'Update', 'icon' => 'pencil', 'url' => ['update', 'id' => $model->id], 'visible' => $model->state_id != 2],
    ['label' => 'Delete', 'icon' => 'trash-o', 'url' => '#', 'linkOptions' => ['submit' => ['delete', 'id' => $model->id], 'confirm' => 'Are you sure you want to delete this item?'], 'visible' => $model->state_id != 2],
];

$this->menu5 = ['Sales Order'];

$this->menu1 = uSo::getTopUpdated();
$this->menu2 = uSo::getTopCreated();

//$this->menu9 = array('model' => $model, 'action' => Yii::app()->createUrl('m2/uSo/index'));
?>


<div class="page-header">
    <h1><?php echo $model->system_ref; ?></h1>
</div>


<?php
$this->widget('booster.widgets.TbDetailView', [
    'data' => $model,
    'attributes' => [
        //'entity_id',
        [
            'label' => 'Customer',
            'name' => 'customer.company_name',
        ],
        'input_date',
        'system_ref',
        'periode_date',
        'so_type_id',
        'remark',
        [
            'label' => 'Total',
            'value' => peterFunc::indoFormat((int)$model->soSum)
        ],
        //'approved_date',
        //'approved_by',
    ],
]);
?>

<?php
$this->widget('TbGridView', [
    'id' => 'bporder-detail-grid',
    'dataProvider' => uSoDetail::model()->search($model->id),
    'itemsCssClass' => 'table table-striped table-bordered',
    'template' => '{items}{pager}{summary}',
    'columns' => [
        [
            'header' => 'Item',
            'value' => '$data->item->item_name',
        ],
        'description',
        'qty',
        'uom',
        [
            'value' => '$data->amountf()',
            'name' => 'amount',
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
        ],
        [
            'class' => 'ext.gridcolumns.TotalColumn',
            'name' => 'amount',
            'output' => 'peterFunc::indoFormat($value)',
            'type' => 'raw',
            'footer' => true,
            'htmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px;'
            ],
            'footerHtmlOptions' => [
                'style' => 'text-align: right; padding-right: 5px; font-weight:bold'
            ],
        ],
    ],
]);
?>
<br/>
