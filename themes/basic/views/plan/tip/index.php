<?php
$form = $this->beginWidget('CActiveForm', array(
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
));
?>
                    <table class="table">              
                     <tr>
                <td><?php
echo $form->labelEx($dropList, 'scenicName') ?></td>
                <td>
                    <?php
echo $form->textField($dropList, 'scenicName', array(
    'maxlength' => 20,
    'value' => ''
)) ?>
                    <?php
echo $form->error($dropList, 'scenicName') ?>
                </td>
            </tr>    
                        <tr>
        <td colspan="10"><input type="submit" class="input_button" value="筛选"/></td>
    </tr>
                  </table>
<?php
$this->endWidget() ?>
                 