<?php $form = $this->beginWidget('CActiveForm')?>
<table class="table">
    <tr >
        <td class="th" colspan="10">用户登录</td>
    </tr>
    <tr>
        <td><?php
            echo $form->labelEx($loginForm, 'type') ?></td>
        <td>
            <?php
            echo $form->textField($loginForm,'type',array('value' => '0')) ?>
            <?php
            echo $form->error($loginForm,'type') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($loginForm, 'username') ?></td>
        <td><?php echo $form->textField($loginForm, 'username' ) ?>    
                 <?php echo $form->error($loginForm,'username') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($loginForm, 'password') ?></td>
        <td><?php echo $form->passwordField($loginForm, 'password')?>
                <?php echo $form->error($loginForm,'password') ?>
        
        </td>
    </tr>

<tr>
        <td><?php echo $form->labelEx($loginForm, 'latitude') ?></td>
        <td><?php echo $form->textField($loginForm, 'latitude',array('value'=>"34.196306"))?>
                <?php echo $form->error($loginForm,'latitude') ?>
        
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($loginForm, 'longitude') ?></td>
        <td><?php echo $form->textField($loginForm,'longitude',array('value'=>"108.967506"))?>
            <?php echo $form->error($loginForm,'longitude') ?>
        
        </td>

    </tr>

    <tr>
        <td><?php echo $form->labelEx($loginForm, 'objectId') ?></td>
        <td><?php echo $form->textField($loginForm,'objectId',array('value'=>"0"))?>
            <?php echo $form->error($loginForm,'objectId') ?>

        </td>
    </tr>
     <tr>
        <td colspan="10"><input type="submit" class="input_button" value="登 录"/></td>
    </tr>
    <?php $this->endWidget() ?>
   
  
    
</table>

