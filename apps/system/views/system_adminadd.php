<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
<?php echo anchor('system/adminmanage','管理管理员');?>
</div>
<?php echo form_open('system/adminsave/'.$admin['id'],array('name'=>'edit','method'=>'post'));?>
	<div class="container noborder">
    <table id="edittable">
        <tbody>
        	<tr>
        	<th width="80">账号</th>
            <td><input type="text" class="text" name="account" value="<?php echo $admin['account'];?>" /><span class="tip">账号请使用字母+数字的形式,可以包含_和-(半角)</span></td>
            </tr>
            <tr>
        	<th>名称</th>
            <td><input type="text" class="text" name="name" value="<?php echo $admin['name'];?>" /><span class="tip">用于显示的称呼</span></td>
            </tr>
            <tr>
        	<th>密码</th>
            <td><input type="password" class="text" name="password" value="" /><span class="tip"><?php if(empty($admin['id'])):?>请填写密码<?php else:?>不修改密码请留空<?php endif;?></span></td>
            </tr>
            <tr>
        	<th>权限</th>
            <td><input type="hidden" name="rights" value="<?php echo $admin['rights'];?>" /></td>
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
<script type="text/javascript">
$(function(){
    new syncTag(document.edit.rights).check=function(v){
        var n=parseInt(v);
        if(n && n>0 && n<51){
            return true;
        }
        tip('权限值请填写0-50的数字',1);
        return false;
    };
});
</script>
<?php include('include/foot.php');?>
