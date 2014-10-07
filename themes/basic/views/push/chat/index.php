<!DOCTYPE html>
<meta  charset="utf-8">
<html>
<head>
    <title>用户注册</title>
    <link rel="stylesheet " type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/assets/css/public.css"/>

</head>
<body>
<body>

<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">单独向某个人发送消息</td>
    </tr>
   
    <tr>
        <td><?php echo $form->labelEx($message, 'receiver') ?></td>
        <td>
            <?php echo $form->textField($message, 'receiver', array('maxlength'=>20)) ?>
            <?php echo $form->error($message, 'receiver') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($message, 'text') ?></td>
        <td>
            <?php echo $form->textField($message, 'text', array('minlength'=>9)) ?>
            <?php echo $form->error($message, 'text') ?>
        </td>
    </tr>
   <tr>
        <td><?php echo $form->labelEx($message, 'file') ?></td>
        <td>
            <?php echo $form->fileField($message, 'file', array('minlength'=>9)) ?>
            <?php echo $form->error($message, 'file') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($message, 'plan') ?></td>
        <td>
            <?php echo $form->textField($message, 'plan', array('minlength'=>9)) ?>
            <?php echo $form->error($message, 'plan') ?>
        </td>
    </tr>
      <tr>
        <td><?php echo $form->labelEx($message, 'length') ?></td>
        <td>
            <?php echo $form->textField($message, 'length', array('minlength'=>9)) ?>
            <?php echo $form->error($message, 'length') ?>
        </td>
    </tr>
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="发送"/></td>
    </tr>
</table>
<?php $this->endWidget() ?>
</body>
</html>