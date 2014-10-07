
<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">发布照片</td>
    </tr>

     <tr>
        <td><?php echo $form->labelEx($model, 'scenicId') ?></td>
        <td>
            <?php echo $form->textField($model, 'scenicId') ?>
            <?php echo $form->error($model, 'scenicId') ?>
        </td>
    </tr>
     <tr>
        <td>注意 </td>
        <td>景点号,系统将自动判断这个景点是否已经是一个Guide</td>
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
