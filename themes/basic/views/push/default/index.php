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
        <td class="th" colspan="10">向所有人发消息</td>
    </tr>

    <tr>
        <td><?php echo $form->labelEx($registerForm, 'content') ?></td>
        <td>
            <?php echo $form->textField($registerForm, 'content', array('minlength'=>9)) ?>
            <?php echo $form->error($registerForm, 'content') ?>
        </td>
    </tr>


    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="发布"/></td>
    </tr>
</table>
<?php $this->endWidget() ?>
</body>
</html>