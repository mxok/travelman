

<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">用户资料更新</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($editForm, 'username') ?></td>
        <td>
            <?php echo $form->textField($editForm, 'username', array('maxlength'=>20)) ?>
            <?php echo $form->error($editForm, 'username') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($editForm, 'residence') ?></td>
        <td>
            <?php echo $form->textField($editForm, 'residence', array('maxlength'=>20)) ?>
            <?php echo $form->error($editForm, 'residence') ?>
        </td>
    </tr>
     <tr>
        <td><?php echo $form->labelEx($editForm, 'gender') ?></td>
        <td>
            <?php
            echo $form->radioButtonList(
                $editForm,
                'gender',
                array(0=>'男生',1=>'女生'),
                array('separator'=>'&nbsp')
            )
            ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($editForm, 'bigAvatar') ?></td>
        <td>
            <?php echo $form->fileField($editForm, 'bigAvatar') ?>
            <?php echo $form->error($editForm, 'bigAvatar') ?>
        </td>
    </tr>
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="更新"/></td>
    </tr>
    
    <tr>
                <td><label>
                    特别说明
            </label>
                </td>
                <td>
                    用户密码不在这里修改，有专门的密码修改URL
                </td>
    </tr>
</table>
<?php $this->endWidget() ?>
