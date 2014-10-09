<?php
echo $this->renderPartial('_searchForm', array(
    'search' => $search
));

echo '当前城市:' .Yii::app()->user->currentCity.'<br/>';
echo '用户居住地:' .Yii::app()->user->residence.'<br/>';

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider' => $dataProvider,
    'summaryText' => '一共{count}条数据',
    'columns' => array(
        'planId',
        'userId',
        'destination',
        'startDate',
        'endDate',
        array(
            'name' => '用户头像',
//            'value' => '
//            CHtml::image(
//            "/manyouren/uploads/".$data->user->avatar->getDefaultAvatar()["avatar0"],"",
//            array("width"=>130,"height"=>130))', //这里显示图片
//            'type' => 'raw', //这里是原型输出
//            'htmlOptions' => array(
//                'width' => '200',
//                'style' => 'text-align:center',
//            ) ,
        ) ,
        array( // display a column with "view", "update" and "delete" buttons
            'class' => 'CButtonColumn',
            'template'=>'{view}',
            'buttons'=>array(
                 'view'=>array(
                   'label'=>'查看评论',
                    'imageUrl'=>null,
                    'url'=>'Yii::app()->createUrl("plan/detail",array("planId"=>$data->planId))'

                    ),

                )
        ) ,
    ) ,
));
?>