<?php
$form = $this->beginWidget('CActiveForm', array('htmlOptions'=>array('enctype'=>'multipart/form-data')));
?>
<table class="table">
    <tr >
        <td class="th" colspan="10">发布Plan</td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'destination') ?></td>
        <td>
            <?php echo $form->textField($model, 'destination', array('maxlength'=>20)) ?>
            <?php echo $form->error($model, 'destination') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'startDate') ?></td>
        <td>
            <?php echo $form->textField($model, 'startDate') ?>
            <?php echo $form->error($model, 'startDate') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'endDate') ?></td>
        <td>
            <?php echo $form->textField($model, 'endDate') ?>
            <?php echo $form->error($model, 'endDate') ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'together') ?></td>
        <td>
            <?php
            echo $form->radioButtonList(
                $model,
                'together',
                array(0=>'朋友',1=>'家人',2=>'单独',3=>'情侣'),
                array('separator'=>'&nbsp')
            )
            ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'purpose') ?></td>
        <td>
            <?php
            echo $form->radioButtonList(
                $model,
                'purpose',
                array(0=>'找人',1=>'建议'),
                array('separator'=>'&nbsp')
            )
            ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'type') ?></td>
        <td>
            <?php
            echo $form->radioButtonList(
                $model,
                'type',
                array(0=>'度假',1=>'游玩',2=>'出差',3=>'返乡'),
                array('separator'=>'&nbsp')
            )
            ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'vehicle') ?></td>
        <td>
            <?php
            echo $form->radioButtonList(
                $model,
                'vehicle',
                array(0=>'飞机',1=>'火车',2=>'徒行',3=>'自驾'),
                array('separator'=>'&nbsp')
            )
            ?>

        </td>
    </tr>
    <tr>
       <?php echo $form->labelEx($model,'images'); ?>
        <?php
          $this->widget('CMultiFileUpload', array(
             'model'=>$model,
             'name'=>'image',
             'attribute'=>'image',
             'accept'=>'jpg|gif|png',
          ));
        ?>
        <?php echo $form->error($model,'images'); ?>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'flightNumber') ?></td>
        <td>
            <?php echo $form->textField($model, 'flightNumber') ?>

        </td>
    </tr>
    <tr>
        <td><?php echo $form->labelEx($model, 'postscript') ?></td>
        <td>
            <?php echo $form->textArea($model, 'postscript',array('cols'=>50,'rows'=>10,'maxlength'=>100)) ?>

        </td>
    </tr>
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="发布"/></td>
    </tr>
</table>
<?php $this->endWidget() ?>
