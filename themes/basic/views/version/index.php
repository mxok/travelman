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
                </tr>   
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
    <tr>
                <td><?php
echo $form->labelEx($model, 'download') ?></td>
                <td>
<?php
echo $form->textField($model, 'download') ?>
<?php
echo $form->error($model, 'download') ?>
                </td>
            </tr> 
             <tr>
                <td colspan="10"><input type="submit" class="input_button" value="提交"/></td>
            </tr>         
        </table>
<?php
$this->endWidget() ?>
