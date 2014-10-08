        <?php
    $form = $this->beginWidget('CActiveForm', array('htmlOptions' => array('enctype' => 'multipart/form-data')));
?>
        <table class="table">
            <tr >
                <td class="th" colspan="10">用户注册</td>
            </tr>
             <tr>
                <td><?php
echo $form->labelEx($registration, 'username') ?></td>
                <td>
                    <?php
echo $form->textField($registration, 'username', array('value' => '漫游人')) ?>
                    <?php
echo $form->error($registration, 'username') ?>
                </td>
            </tr>
            <tr>
                <td><?php
                    echo $form->labelEx($registration, 'type') ?></td>
                <td>
                    <?php
                    echo $form->textField($registration, 'type', array('value' => '0')) ?>
                    <?php
                    echo $form->error($registration, 'type') ?>
                </td>
            </tr>
            <tr>
                <td><?php
echo $form->labelEx($registration, 'email') ?></td>
                <td>
                    <?php
echo $form->textField($registration, 'email', array(
    'value' => 'admin@qq.com'
)) ?>
                    <?php
echo $form->error($registration, 'email') ?>
                </td>
            </tr>
            <tr>
                <td><?php
echo $form->labelEx($registration, 'password') ?></td>
                <td>
                    <?php
echo $form->textField($registration, 'password', array(
    'minlength' => 9,
    'value' => 'admin'
)) ?>
                    <?php
echo $form->error($registration, 'password') ?>
                </td>
            </tr>
            <tr>
                <td><?php
echo $form->labelEx($registration, 'gender') ?></td>
                <td>
                    <?php
echo $form->radioButtonList($registration, 'gender', array(
    1 => '男生',
    0 => '女生'
) , array(
    'separator' => '&nbsp'
))
?>

                </td>
            </tr>
             <tr>
                <td><?php
echo $form->labelEx($registration, 'residence') ?></td>
                <td>
<?php
echo $form->textField($registration, 'residence', array(
    'value' => '西安'
)) ?>
<?php
echo $form->error($registration, 'residence') ?>
                </td>
            </tr>
            <tr>
                <td><?php
echo $form->labelEx($registration, 'birthday') ?></td>
                <td>
<?php
echo $form->textField($registration, 'birthday', array(
    'value' => '1992-11-01'
)) ?>
<?php
echo $form->error($registration, 'birthday') ?>
                </td>
            </tr>
            <tr>
                <td><?php
echo $form->labelEx($registration, 'avatar0') ?></td>
                <td>
<?php
echo $form->fileField($registration, 'avatar0') ?>
<?php
echo $form->error($registration, 'avatar0') ?>
                </td>
            </tr>
                </td>
            </tr>
            <tr>
                <td colspan="10"><input type="submit" class="input_button" value="提交"/></td>
            </tr>
            <tr>
                <td><label>
                        特别说明
                    </label>
                </td>
                <td>1.如果username为空，那么username就显示为userid<br/>
                    2.去过哪些地方。该怎么填？<br/>
                    3.带*的表示必填
                </td>
            </tr>
        </table>
<?php
$this->endWidget() ?>
