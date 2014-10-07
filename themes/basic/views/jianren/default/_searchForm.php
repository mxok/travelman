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
echo $form->labelEx($search, 'location') ?></td>
                <td>
                    <?php
echo $form->textField($search, 'location', array(
    'maxlength' => 20,
    'value' => ''
)) ?>
                    <?php
echo $form->error($search, 'location') ?>
                </td>
            </tr>
                          <tr>
                <td><?php
echo $form->labelEx($search, 'gender') ?></td>
                <td>
                    <?php
echo $form->radioButtonList($search, 'gender', array(
    0 => '男生',
    1 => '女生'
) , array(
    'separator' => '&nbsp'
))
?>

                </td>
            </tr>
                        <tr>
                <td><?php
echo $form->labelEx($search, 'residence') ?></td>
                <td>
                      <?php
echo $form->radioButtonList($search, 'residence', array(
    0 => '本地',
    1 => '外地'
) , array(
    'separator' => '&nbsp'
))
?>

                </td>
            </tr> 
                        <tr>
        <td colspan="10"><input type="submit" class="input_button" value="筛选"/></td>
    </tr>


                  </table>
                   <?php
$this->endWidget() ?>