<?php
$this->breadcrumbs = [
    'G people' => ['index'],
    $model->id,
];

$this->menu4 = [
    ['label' => 'Home', 'icon' => 'home', 'url' => ['/m1/gLeave']],
    ['icon' => 'calendar', 'label' => 'Leave Calendar', 'url' => ['/m1/gLeave/leaveCalendar']],
    ['label' => 'Link to', 'icon' => 'user', 'items' => [
        ['label' => 'Link to Person', 'icon' => 'user', 'url' => ['/m1/gPerson/view', 'id' => $model->id]],
        ['label' => 'Link to Permission', 'icon' => 'hand-o-up', 'url' => ['/m1/gPermission/view', 'id' => $model->id]],
        ['label' => 'Link to Attendance', 'icon' => 'bell', 'url' => ['/m1/gAttendance/view', 'id' => $model->id]],
        ['label' => 'Link to Medical', 'icon' => 'hospital-o', 'url' => ['/m1/gMedical/view', 'id' => $model->id]],
        ['label' => 'Link to Performance', 'icon' => 'fire', 'url' => ['/m1/gPerformance/view', 'id' => $model->id]],
    ]],
    ['label' => 'Help', 'icon' => 'bullhorn', 'url' => ['/sHelp/page/to/' . $this->module->id . '.' . $this->id . '.' . $this->action->id], 'linkOptions' => ['target' => '_blank']],
];

$this->menu7 = [
    ['label' => 'AGL ' . date('Y'), 'icon' => 'barcode', 'url' => ['/m1/gLeave/autoGeneratedLeave', "id" => $model->id]],
    ['label' => 'AGL ' . date('Y',strtotime('last year')) , 'icon' => 'barcode', 'url' => ['/m1/gLeave/LeaveManual', "id" => $model->id,"year"=> date('Y') - 1]],
    ['label' => 'AGL ' . date('Y',strtotime('2 year ago')) , 'icon' => 'barcode', 'url' => ['/m1/gLeave/LeaveManual', "id" => $model->id,"year"=> date('Y') - 2]],
];

$this->menu1 = [
    ['label' => 'Print Summary', 'icon' => 'print', 'url' => ['/m1/gLeave/summaryLeave', "pid" => $model->id]],
];

//$this->menu1=gLeave::getTopUpdated();
//$this->menu2=gLeave::getTopCreated();
$this->menu5 = ['Leave'];

$this->menu9 = ['model' => $model, 'action' => Yii::app()->createUrl('m1/gLeave/list')];

?>

<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h1>
                <i class="fa fa-suitcase fa-fw"></i>
                <?php echo $model->employee_name; ?>
            </h1>
        </div>

        <?php
        echo $this->renderPartial("/gLeave/_leaveBalance", ["model" => $model], true);
        ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php
        $this->widget('booster.widgets.TbTabs', [
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => [
                ['label' => 'Leave History', 'content' => $this->renderPartial("_tabList", ["model" => $model], true), 'active' => true],
                ['label' => 'Profile', 'content' => $this->renderPartial("/gPerson/_personalInfo2", ["model" => $model], true)],
                //array('label' => 'Temporary Action', 'content' => $this->renderPartial("_tabTemporaryAction", array("model" => $model), true)),
            ],
        ]);
        ?>
    </div>
</div>
