<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">查看个人发布的计划</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'userId') ?></td>
        <td>
            <?php echo $form->textField($model, 'userId') ?>
            <?php echo $form->error($model, 'userId') ?>
        </td>
    </tr>
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="提交"/></td>
    </tr>
</table>
<?php 
$this->endWidget() ;
if($model->validate()){


$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'summaryText' => '一共{count}条数据',
    'columns' => array(
        'userId',
        'photoId',
        'content',
        array(
            'name' => '照片',
            'value' => '
            CHtml::image(Yii::app()->request->hostInfo.
            "/manyouren/uploads/".$data->images,"",
            array("width"=>260,"height"=>260))', //这里显示图片
            'type' => 'raw', //这里是原型输出
            'htmlOptions' => array(
                'width' => '200',
                'style' => 'text-align:center',
            ) ,
        ) ,
    ) ,
));
}
?>