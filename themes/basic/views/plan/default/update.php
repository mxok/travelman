<!DOCTYPE html>
<meta  charset="utf-8">
<html>
<head>
    <title>发布计划</title>
    <link rel="stylesheet " type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/assets/css/public.css"/>

</head>
<body>
<body>

<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">更新Plan</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($planForm, 'planid') ?></td>
        <td>
            <?php echo $form->textField($planForm, 'planid') ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($planForm, 'file1') ?></td>
        <td>
            <?php echo $form->fileField($planForm, 'file1') ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($planForm, 'file2') ?></td>
        <td>
            <?php echo $form->fileField($planForm, 'file2') ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($planForm, 'file3') ?></td>
        <td>
            <?php echo $form->fileField($planForm, 'file3') ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($planForm, 'postscript') ?></td>
        <td>
            <?php echo $form->textField($planForm, 'postscript') ?>

        </td>
    </tr>
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="发布"/></td>
    </tr>
</table>
<?php $this->endWidget() ?>
</body>
</html>