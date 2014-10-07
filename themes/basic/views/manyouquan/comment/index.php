
<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">发布分享</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($commentForm, 'content' ) ?></td>
        <td>
            <?php echo $form->textArea($commentForm, 'content',array('cols' => 50, 'rows' => 5, 'maxlength' => 500)) ?>
            <?php echo $form->error($commentForm, 'content') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($commentForm, 'photoId') ?></td>
        <td>
            <?php echo $form->textField($commentForm, 'photoId') ?>
            <?php echo $form->error($commentForm, 'photoId') ?>
        </td>
    </tr>
  <tr>
        <td><?php echo $form->labelEx($commentForm, 'replyId') ?></td>
        <td>
            <?php echo $form->textField($commentForm, 'replyId') ?>
            <?php echo $form->error($commentForm, 'replyId') ?>
        </td>
    </tr>
        
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="发布"/></td>
    </tr>
</table>
<?php $this->endWidget() ?>
