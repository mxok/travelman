        <?php
$form = $this->beginWidget('CActiveForm', array(
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
));
?>
        <table class="table">
            <tr >
                <td class="th" colspan="10">修改个人资料</td>
            </tr>

             <tr>
                <td><?php
echo $form->labelEx($user, 'username') ?></td>
                <td><?php
echo $form->textField($user, 'username') ?>
                <?php
echo $form->error($user, 'username') ?>
                </td>
            </tr>
   <tr>
                <td><?php
echo $form->labelEx($user, 'signText') ?></td>
                <td><?php
echo $form->textField($user, 'signText') ?>
                <?php
echo $form->error($user, 'signText') ?>
                </td>
            </tr>
        <tr>
                <td><?php
echo $form->labelEx($user, 'school') ?></td>
                <td><?php
echo $form->textField($user, 'school') ?>
                <?php
echo $form->error($user, 'school') ?>
                </td>
            </tr>
        
            
   <tr>
                <td><?php
echo $form->labelEx($user, 'hobbyText') ?></td>
                <td><?php
echo $form->textField($user, 'hobbyText') ?>
                <?php
echo $form->error($user, 'hobbyText') ?>
                </td>
            </tr>
        
        <tr>
                <td><?php
echo $form->labelEx($user, 'vehicleText') ?></td>
                <td><?php
echo $form->textField($user, 'vehicleText') ?>
                <?php
echo $form->error($user, 'vehicleText') ?>
                </td>
            </tr>   

<tr>
                <td><?php
echo $form->labelEx($user, 'frequency') ?></td>
                <td><?php
echo $form->textField($user, 'frequency') ?>
                <?php
echo $form->error($user, 'frequency') ?>
                </td>
            </tr>


<tr>
                <td><?php
echo $form->labelEx($user, 'beenThere') ?></td>
                <td><?php
echo $form->textField($user, 'beenThere') ?>
                <?php
echo $form->error($user, 'beenThere') ?>
                </td>
            </tr>

<tr>
                <td><?php
echo $form->labelEx($user, 'magazine') ?></td>
                <td><?php
echo $form->textField($user, 'magazine') ?>
                <?php
echo $form->error($user, 'magazine') ?>
                </td>
            </tr>

<tr>
                <td><?php
echo $form->labelEx($user, 'company') ?></td>
                <td><?php
echo $form->textField($user, 'company') ?>
                <?php
echo $form->error($user, 'company') ?>
                </td>
            </tr>

<tr>
                <td><?php
echo $form->labelEx($user, 'profession') ?></td>
                <td><?php
echo $form->textField($user, 'profession') ?>
                <?php
echo $form->error($user, 'profession') ?>
                </td>
            </tr>



<tr>
                <td><?php
echo $form->labelEx($user, 'homeland') ?></td>
                <td><?php
echo $form->textField($user, 'homeland') ?>
                <?php
echo $form->error($user, 'homeland') ?>
                </td>
            </tr>
            <tr>

                <td><?php
echo $form->labelEx($user, 'gender') ?></td>
                <td> <?php
echo $form->radioButtonList($user, 'gender', array(
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
echo $form->labelEx($user, 'birthday') ?></td>
                <td>
<?php
echo $form->textField($user, 'birthday') ?>
<?php
echo $form->error($user, 'birthday') ?>
                </td>
            </tr>
            <tr>
                <td><?php
echo $form->labelEx($user, 'want2Go') ?></td>
                <td>
<?php
echo $form->textField($user, 'want2Go') ?>
<?php
echo $form->error($user, 'want2Go') ?>
                </td>
            </tr>

            <tr>
                <td><?php
echo $form->labelEx($user, 'avatar0') ?></td>
                <td>
<?php
echo $form->fileField($user, 'avatar0') ?>
<?php
echo $form->error($user, 'avatar0') ?>
                </td>
            </tr>
            <tr>
                <td><?php
echo $form->labelEx($user, 'avatar1') ?></td>
                <td>
<?php
echo $form->fileField($user, 'avatar1') ?>
<?php
echo $form->error($user, 'avatar1') ?>
                </td>
            </tr>
            <tr>
                <td><?php
echo $form->labelEx($user, 'avatar2') ?></td>
                <td>
<?php
echo $form->fileField($user, 'avatar2') ?>
<?php
echo $form->error($user, 'avatar2') ?>
                </td>
            </tr>
            <tr>
                <td><?php
echo $form->labelEx($user, 'avatar3') ?></td>
                <td>
<?php
echo $form->fileField($user, 'avatar3') ?>
<?php
echo $form->error($user, 'avatar3') ?>
                </td>

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
