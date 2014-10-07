   <form enctype="multipart/form-data" id="yw0" action="/manyouren/new/index.php/user/profile" method="post"><table class="table">
    <tr >
        <td class="th" colspan="10">用户详细的资料页面</td>
    </tr>
    <tr>
        <td><label class="error required" for="User_userId">用户的ID</label></td>
        <td>
            <input name="User[userId]" id="User_userId" type="text" class="error" /></td>
    </tr>
    <tr>
        <td colspan="10"><input type="submit" class="input_button" value="提交"/></td>
    </tr>
</table>
</form>
    <?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'userId',
        'username',
        'birthday',
        array(
            'name' => '用户头像',
            'type' => 'raw',
            'value' => CHtml::image($this->savePath.json_decode($model['avatar0'])->origin,'个人头像', array(
                "width" => 200,
                "height" => 200
            )) ,
        ) ,
    )
));
?>
 