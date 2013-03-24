<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
<?php echo anchor('system/adminmanage','管理员管理');?>
</div>
<?php echo form_open('system/adminrightsave/'.$admin['id'],array('name'=>'edit','method'=>'post'));?>
	<div class="container noborder">
    <table id="edittable">
        <tbody>
            <tr>
                <th>修改管理员&nbsp;<font color="red"><?php echo $admin['account'];?>&nbsp;[<?php echo $admin['name'];?>]</font>&nbsp;的权限</th>
            </tr>
        	<?php foreach($menu as $m):?>
        	<tr>
        	    <th><label><input type="checkbox" name="rights[]" value="<?php echo $m['right'];?>" <?php if($m['hasright'])echo 'checked';?> /><?php echo $m['name'];?></label></th>
        	</tr>
        	<tr>
        	    <td>
        	        <?php foreach($m['submenu'] as $sm):?>
        	        <label><input type="checkbox" name="rights[]" value="<?php echo $sm['right'];?>" <?php if($sm['hasright'])echo 'checked';?> /><?php echo $sm['name'];?></label>
        	        <?php endforeach;?>
        	    </td>
        	</tr>
        	<?php endforeach;?>
        </tbody>
        <tfoot>
            <tr>
                <td class="aligncenter"><a href="javascript:void($('input[type=checkbox]').attr('checked',true))"> 全选 </a> / <a href="javascript:void($('input[type=checkbox]').attr('checked',false))"> 取消 </a>&nbsp;&nbsp;<input type="submit" class="button" value="保存权限" /></td>
            </tr>
        </tfoot>
    </table>
    </div>
</form>
<script type="text/javascript">
$('tr th input[type=checkbox]').click(function(){
    var tr=$(this).parents('tr');
    tr.next('tr').find('input[type=checkbox]').attr('checked',!!$(this).attr('checked'));
});
$('tr td input[type=checkbox]').click(function(){
    var tr=$(this).parents('tr');
    if(!$(this).attr('checked')){
        var up=true;
        tr.find('input').each(function(i,a){
            if($(a).attr('checked')){
                return up=false;
            }
        });
        if(up)tr.prev('tr').find('input[type=checkbox]').attr('checked',false);
    }else{
        tr.prev('tr').find('input[type=checkbox]').attr('checked',true);
    }
});
</script>
<?php include('include/foot.php');?>
