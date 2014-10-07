    <?php
    $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'userId',
        'email', 
        'password',
        'username',
        'birthday',
        'registerDate',
        'sessionId' , 
         array(             
            'label'=>'好友',
            'type'=>'raw',
             'value'=>CHtml::link(CHtml::encode('查看好友'),array('relations/friendsList')),
        ),
         array(               
            'label'=>'关注',
            'type'=>'raw',
             'cssClass'=>'null',
          'value'=>CHtml::link(CHtml::encode('查看我关注的人'),array('relations/followList')),
        ),
         array(              
            'label'=>'粉丝',
            'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode('查看我的粉丝'), array('relations/fansList')), 'itemCssClass'=>'null'
        ),
      array(
          'name'=>'用户头像',
          'type'=>'raw',
          'value'=>CHtml::image('/manyouren/uploads/'.$userInfo->smallAvatar,'个人头像',array("width"=>200,"height"=>200)),
          
      ),
        )
            ));

    ?>
 