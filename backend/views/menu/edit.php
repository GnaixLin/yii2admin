<?php

use yii\helpers\Html;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $form ActiveForm */
?>

<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption font-red-sunglo">
            <i class="icon-settings font-red-sunglo"></i>
            <span class="caption-subject bold uppercase"> 内容信息</span>
        </div>
        <div class="actions">
            <div class="btn-group">
                <a class="btn btn-sm green dropdown-toggle" href="javascript:;" data-toggle="dropdown"> 工具箱
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="javascript:;"><i class="fa fa-pencil"></i> 导出Excel </a></li>
                    <li class="divider"> </li>
                    <li><a href="javascript:;"> 其他 </a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <?php $form = ActiveForm::begin([
            'options'=>[
                'class'=>"form-aaa "
            ]
        ]); ?>

        <?=$form->field($model, 'title')->textInput(['class'=>'form-control c-md-2'])->label('标题')->hint('栏目的标题')?>

        <?=$form->field($model, 'sort')->textInput(['class'=>'form-control c-md-1'])->label('排序值')->hint('数值越小排序越前')?>

        <?=$form->field($model, 'url')->textInput()->label('链接')->hint('格式：index/index&id=2&type=1')?>

        <?=$form->field($model, 'pid')->selectList(
            ArrayHelper::merge(['0'=>'一级栏目'],ArrayHelper::map( ArrayHelper::format_tree($menu_tree), 'id', 'title')),
            ['class'=>'form-control select2','widthclass'=>'c-md-2'])->label('上级菜单')->hint('上级菜单描述') ?>

        <?=$form->field($model, 'group')->textInput(['class'=>'form-control c-md-3'])->label('分组')->hint('格式为：分组名称|图标样式 ，例如：系统|icon-comment')?>

        <?= $form->field($model, 'hide')->radioList(['0'=>'显示','1'=>'隐藏'])->label('是否隐藏') ?>

        <div class="form-actions">
            <?= Html::submitButton('<i class="icon-ok"></i> 确定', ['class' => 'btn blue ajax-post','target-form'=>'form-aaa']) ?>
            <?= Html::Button('取消', ['class' => 'btn']) ?>
        </div>
        <?php ActiveForm::end(); ?>

        <!-- END FORM-->
    </div>
</div>



<?php
/* ===========================以下为本页配置信息================================= */
/* 页面基本属性 */
$this->title = ($this->context->action->id == 'add' ? '添加' : '编辑') . '菜单';
$this->context->title_sub = '';

/* 渲染其他文件 */
//echo $this->renderFile('@app/views/public/login.php');

/* 加载页面级别CSS */
$this->registerCssFile('@web/metronic/global/plugins/select2/css/select2.min.css');
$this->registerCssFile('@web/metronic/global/plugins/select2/css/select2-bootstrap.min.css');

/* 加载页面级别JS */
$this->registerJsFile('@web/metronic/global/plugins/select2/js/select2.full.min.js');
$this->registerJsFile('@web/metronic/pages/scripts/components-select2.min.js');
?>

<!-- 定义数据块 -->
<?php $this->beginBlock('test'); ?>

$(function() {
    /* 子导航高亮 */
    highlight_subnav('menu/index');
});

<?php $this->endBlock() ?>
<!-- 将数据块 注入到视图中的某个位置 -->
<?php $this->registerJs($this->blocks['test'], \yii\web\View::POS_END); ?>
