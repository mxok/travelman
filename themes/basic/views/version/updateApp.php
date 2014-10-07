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
        <td class="th" colspan="10">设置强制用户更新的版本</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($update, 'newestVersionId') ?></td>
        <td>
            <?php echo $form->textField($update, 'newestVersionId') ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($update, 'updateContent') ?></td>
        <td>
            <?php echo $form->textField($update, 'updateContent') ?>

        </td>
    </tr>
</table>
<?php $this->endWidget() ?>
</body>
</html>