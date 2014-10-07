<?php
    $form = $this->beginWidget('CActiveForm', array('htmlOptions' => array('enctype' => 'multipart/form-data')));
?>
        <table class="table">
            <tr >
                <td class="th" colspan="10">版本更新</td>
            </tr>
             <tr>
                <td><?php
echo $form->labelEx($model, 'versionCode') ?></td>
                <td>
                    <?php
echo $form->textField($model, 'versionCode', array('value' => '1')) ?>
                    <?php
echo $form->error($model, 'versionCode') ?>
                </td>         
             <tr>
                <td><?php
echo $form->labelEx($model, 'updateContent') ?></td>
                <td>
<?php
echo $form->textField($model, 'updateContent', array(
    'value' => '更新了一些小的BUG'
)) ?>
<?php
echo $form->error($model, 'updateContent') ?>
                </td>
            </tr>   
         
        </table>
<?php
$this->endWidget() ?>
