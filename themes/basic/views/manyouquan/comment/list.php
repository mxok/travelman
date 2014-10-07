<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">查看计划的详细</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'photoId') ?></td>
        <td>
            <?php echo $form->textField($model, 'photoId') ?>
            <?php echo $form->error($model, 'photoId') ?>
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
        'commentId',
        'userId',
        'photoId',
        'content',
        array(
            'name' => '用户头像',
            'value' => '
            CHtml::image(Yii::app()->request->hostInfo.
            "/manyouren/uploads/".$data->user->avatar->getDefaultAvatar()["avatar0"],"",
            array("width"=>130,"height"=>130))', //这里显示图片
            'type' => 'raw', //这里是原型输出
            'htmlOptions' => array(
                'width' => '200',
                'style' => 'text-align:center',
            ) ,
        ) ,
        array( // display a column with "view", "update" and "delete" buttons
            'class' => 'CButtonColumn',
            'template' => '{view}',
            'buttons' => array(
                'view' => array(
                    'label' => '查看评论',
                    'imageUrl' => null,
                    'url' => 'Yii::app()->createUrl("photo/detail",array("photoId"=>$data->photoId))'
                ) ,
            )
        ) ,
    ) ,
));
}
?>
