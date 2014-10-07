      <?php $form = $this->beginWidget('CActiveForm') ?>
<table class="table">
    <tr >
        <td class="th" colspan="10">用户位置刷新</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($stateForm, 'latitude') ?></td>
        <td><?php echo $form->textField($stateForm, 'latitude' ) ?>    
             <?php echo $form->error($stateForm,'latitude') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($stateForm, 'longitude') ?></td>
        <td><?php echo $form->textField($stateForm, 'longitude')?>
                <?php echo $form->error($stateForm,'longitude') ?>        
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($stateForm, 'currentCity') ?></td>
        <td><?php echo $form->textField($stateForm, 'currentCity')?>
                <?php echo $form->error($stateForm,'currentCity') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($stateForm, 'status') ?></td>
        <td><?php echo $form->textField($stateForm, 'status')?>
                <?php echo $form->error($stateForm,'status') ?>       
        </td>
    </tr>
     <tr>
        <td colspan="10"><input type="submit" class="input_button" value="更新"/></td>
    </tr>
    <?php $this->endWidget() ?>   
</table>
