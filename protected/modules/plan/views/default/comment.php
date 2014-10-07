
<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">评论</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'content' ) ?></td>
        <td>
            <?php echo $form->textArea($model, 'content',array('cols' => 50, 'rows' => 5, 'maxlength' => 500)) ?>
            <?php echo $form->error($model, 'content') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'planId') ?></td>
        <td>
            <?php echo $form->textField($model, 'planId') ?>
            <?php echo $form->error($model, 'planId') ?>
        </td>
    </tr>
  <tr>
        <td><?php echo $form->labelEx($model, 'replyId') ?></td>
        <td>
            <?php echo $form->textField($model, 'replyId') ?>
            <?php echo $form->error($model, 'replyId') ?>
        </td>
    </tr>
        
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="发布"/></td>
    </tr>
</table>
<?php $this->endWidget() ?>
</body>
</html>
