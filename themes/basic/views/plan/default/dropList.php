<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
            <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl ?>/assets/css/public.css">
                <title>Document</title>
                </head>
                <body>
                        <?php
        $form = $this->beginWidget('CActiveForm', array('htmlOptions' => array('enctype' => 'multipart/form-data')));
        ?>
                    <table class="table">              
                     <tr>
                <td><?php echo $form->labelEx($dropList, 'scenicName') ?></td>
                <td>
                    <?php echo $form->textField($dropList, 'scenicName', array('maxlength' => 20,'value'=>'')) ?>
                    <?php echo $form->error($dropList, 'scenicName') ?>
                </td>
            </tr>    
                        <tr>
        <td colspan="10"><input type="submit" class="input_button" value="筛选"/></td>
    </tr>
                  </table>
                   <?php $this->endWidget() ?>
                    <div class="page">
                        <?php
//                        $this->widget('CLinkPager', array(
//                            'header' => 'Go to page',
//                            'firstPageLabel' => '首页',
//                            'lastPageLabel' => '末页',
//                            'prevPageLabel' => '上一页',
//                            'nextPageLabel' => '下一页',
//                            'pages' => $pages,
//                            'maxButtonCount' => 5,
//                        ));
                        ?>
                    </div>
                </body>
                </html>
