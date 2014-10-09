
        <?php
        $form = $this->beginWidget('CActiveForm', array('htmlOptions' => array('enctype' => 'multipart/form-data')));
        ?>
        <table class="table">
            <tr >
                <td class="th" colspan="10">添加一个用户关系</td>
            </tr>

            <tr>
                <td>您要添加的用户ID</td>
                <td>
                    <?php echo $form->textField($relation, 'subUserId', array('maxlength' => 10)) ?>
                    <?php echo $form->error($relation, 'subUserId') ?>
                </td>
            </tr>
           
            <tr>
                <td>您要操作的内容</td>
                <td>
                    <?php
                    echo $form->radioButtonList(
                            $relation, 'type', array(0 => '取消拉黑', 1 => '取消关注'), array('separator' => '&nbsp')
                    )

                    ?>
                    <?php echo $form->error($relation, 'type') ?>
                </td>
            </tr>
            <tr>
                <td colspan="10"><input type="submit" class="input_button" value="提交"/></td>
            </tr>

            <tr>
                <td><label>
                        特别说明：0表示拉黑，1表示关注
                    </label>
                </td>
                <td>
                </td>
            </tr>
        </table>
<?php $this->endWidget() ?>
 