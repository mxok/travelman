
<?php
$form = $this->beginWidget('CActiveForm', 
    array(


       

        'htmlOptions'=>array('enctype'=>'multipart/form-data'

            )));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">评论一个计划</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($comment, 'content' ) ?></td>
        <td>
            <?php echo $form->textArea($comment, 'content',array('cols' => 50, 'rows' => 5, 'maxlength' => 500)) ?>
            <?php echo $form->error($comment, 'content') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($comment, 'planId') ?></td>
        <td>
            <?php echo $form->textField($comment, 'planId') ?>
            <?php echo $form->error($comment, 'planId') ?>
        </td>
    </tr>
  <tr>
        <td><?php echo $form->labelEx($comment, 'replyId') ?></td>
        <td>
            <?php echo $form->textField($comment, 'replyId') ?>
            <?php echo $form->error($comment, 'replyId') ?>
        </td>
    </tr>
        
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="提交"/></td>
    </tr>
</table>
<?php $this->endWidget() ?>

