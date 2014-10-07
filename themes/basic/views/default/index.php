                        <?php
        $form = $this->beginWidget('CActiveForm', array('htmlOptions' => array('enctype' => 'multipart/form-data')));
        ?>
                    <table class="table">
                       
                 
                    <tr>
                <td><?php echo $form->labelEx($searchForm, 'location') ?></td>
                <td>
                    <?php echo $form->textField($searchForm, 'location', array('maxlength' => 20,'value'=>'')) ?>
                    <?php echo $form->error($searchForm, 'location') ?>
                </td>
            </tr>
                          <tr>
                <td><?php echo $form->labelEx($searchForm, 'gender') ?></td>
                <td>
                    <?php
                    echo $form->radioButtonList(
                            $searchForm, 'gender', array(0 => '男生', 1 => '女生'), array('separator' => '&nbsp')
                    )
                    ?>

                </td>
            </tr>
                        <tr>
                <td><?php echo $form->labelEx($searchForm, 'residence') ?></td>
                <td>
                      <?php
                    echo $form->radioButtonList(
                            $searchForm, 'residence', array(0 => '本地', 1 => '外地'), array('separator' => '&nbsp')
                    )
                    ?>

                </td>
            </tr> 
                        <tr>
        <td colspan="10"><input type="submit" class="input_button" value="筛选"/></td>
    </tr>
                  </table>
                   <?php $this->endWidget() ?>
                    <table class="table">
                        <tr>
                            <td class="th" colspan="10">漫游人主界面</td>
                            说明：
                                1.这里的列表就相当于详细页面。只不过web端没有显示
                                2.结束日期必须大于当前日期。显示的是附近的人发布的
                        </tr>
                        <tr>
                            <td class="th" colspan="10">
                            </td>
                        </tr>
                        <tr>
                            <td>用户ID</td>
                            <td>计划ID</td>
                            <td>昵称</td>
                            <td>头像</td>
                            <td>目的地</td>
                            <td>目的地所在城市</td>
                           
                            <td>结束日期 </td>
                             <td>FROM</td>
                            <td>查看详细</td>
                        </tr>
                        <?php foreach ($planList as $v):
                           
                            ?>

                            <tr>
                                <td><a href="<?php echo $this->createUrl('user/profile', array('userId' => $v['userId'])) ?>"><?php echo $v['userId'] ?></a>
                                </td>
                                <td><?php echo $v['planId'] ?></td>
                                <td><?php echo $v['username'] ?></td>
                                <td><img src="<?php echo '/uploads/'. $v['smallAvatar'] ?>"></td>
                                <td><?php echo $v['destination'] ?></td>
                                <td><?php echo $v['city'] ?></td>
                                
                                <td><?php echo $v['endDate'] ?></td>
                                <td><?php echo $v['residence'] ?></td>
                                <td>
                                    [<a href="<?php echo $this->createUrl('chat/send') ?>">聊天</a>]
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                    <div class="page">
                        <?php
                        $this->widget('CLinkPager', array(
                            'header' => 'Go to page',
                            'firstPageLabel' => '首页',
                            'lastPageLabel' => '末页',
                            'prevPageLabel' => '上一页',
                            'nextPageLabel' => '下一页',
                            'pages' => $pages,
                            'maxButtonCount' => 5,
                        ));
                        ?>
                    </div>
               