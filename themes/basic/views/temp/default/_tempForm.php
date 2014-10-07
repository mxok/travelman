
      <?php $form = $this->beginWidget('CActiveForm') ?>
<table class="table">
    <tr >
        <td class="th" colspan="10">用户临时上传数据</td>
    </tr>
    </tr>
    <tr>
                <td>latitude *</td>
                <td> <input type="text"  name="TempForm[latitude]" value="34.196306"/></td>
            </tr>
            <tr>
                <td>longitude *</td>
                <td>  
                <input type="text"  name="TempForm[longitude]" value="108.967506"/> <td>
            </tr>
    <tr>
        <td><?php echo $form->labelEx($tempForm, 'currentCity') ?></td>
        <td><?php echo $form->textField($tempForm, 'currentCity')?>
                <?php echo $form->error($tempForm,'currentCity') ?>
        
        </td>
    </tr>
     <td><?php echo $form->labelEx($tempForm, 'location') ?></td>
                <td>
                    <?php
echo $form->textField($tempForm, 'location', array(
    'maxlength' => 20,
    'value' => ''
)) ?>
                    <?php
echo $form->error($tempForm, 'location') ?>
                </td>
            </tr>
                          <tr>
                <td><?php
echo $form->labelEx($tempForm, 'gender') ?></td>
                <td>
                    <?php
echo $form->radioButtonList($tempForm, 'gender', array(
    0 => '男生',
    1 => '女生'
) , array(
    'separator' => '&nbsp'
))?>

<tr>
                <td><?php
echo $form->labelEx($tempForm, 'residence') ?></td>
                <td>
                      <?php
echo $form->radioButtonList($tempForm, 'residence', array(
    0 => '本地',
    1 => '外地'
) , array(
    'separator' => '&nbsp'
))
?>

                </td>
            </tr> 
     <tr>
        <td colspan="10"><input type="submit" class="input_button" value="提交"/></td>
    </tr>
    <?php $this->endWidget() ?>
   
  
    
</table>
