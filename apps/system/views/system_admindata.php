<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<?php echo form_open('system/admindatasave',array('name'=>'edit','method'=>'post'));?>
	<div class="container noborder">
    <table id="edittable">
        <tbody>
        	<tr>
        	<th width="80">账号</th>
            <td><input type="text" class="text" disabled value="<?php echo $admin['account'];?>" /><span class="tip">账号不可修改</span></td>
            </tr>
            <tr>
        	<th>名称</th>
            <td><input type="text" class="text" name="name" value="<?php echo $admin['name'];?>" /><span class="tip">用于显示的称呼</span></td>
            </tr>
            <tr>
        	<th>密码</th>
            <td><input type="password" class="text" name="password" value="" /><span class="tip">输入密码才能保存</span></td>
            </tr>
            <tr>
        	<th>新密码</th>
            <td><input type="password" class="text" name="newpassword" /><span class="tip">不修改密码请留空</span></td>
            </tr>
            <tr>
        	<th>确认新密码</th>
            <td><input type="password" class="text" name="newpasswordconfirm" /><span class="tip">不修改密码请留空</span></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" class="button" value="保存资料" /></td>
            </tr>
        </tfoot>
    </table>
    </div>
</form>
<?php include('include/foot.php');?>
