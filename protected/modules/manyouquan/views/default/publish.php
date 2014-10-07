
<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">发布照片</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'content' ) ?></td>
        <td>
            <?php echo $form->textArea($model, 'content',array('cols' => 50, 'rows' => 5, 'maxlength' => 500)) ?>
            <?php echo $form->error($model, 'content') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'score') ?></td>
        <td>
            <?php echo $form->textField($model, 'score') ?>
            <?php echo $form->error($model, 'score') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'city') ?></td>
        <td>
            <?php echo $form->textField($model, 'city') ?>
            <?php echo $form->error($model, 'city') ?>
        </td>
    </tr>
     <tr>
        <td><?php echo $form->labelEx($model, 'location') ?></td>
        <td>
            <?php echo $form->textField($model, 'location') ?>
            <?php echo $form->error($model, 'location') ?>
        </td>
    </tr>
    <tr>
       <?php echo $form->labelEx($model,'images'); ?>
        <?php
          $this->widget('CMultiFileUpload', array(
             'model'=>$model,
             'name'=>'image',
             'attribute'=>'image',
             'accept'=>'jpg|gif|png',
          ));
        ?>
        <?php echo $form->error($model,'images'); ?>
    </tr>
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="发布"/></td>
    </tr>
</table>
<?php $this->endWidget() ?>
</body>
</html>
