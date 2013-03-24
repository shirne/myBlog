<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<p class="tips container"><b class="ico warning"></b>系统菜单根据程序功能配置，非专业人员请勿修改</p>
<div id="links" class="container">
<?php echo anchor('system/menuadd','添加菜单');?>
</div>
<?php echo form_open('system/menusavebatch',array('name'=>'list','method'=>'post'));?>
<div class="container noborder">
<table id="listtable">
	<thead>
    	<tr>
        	<th width="50">排序</th>
            <th width="200">菜单名称</th>
            <th width="120">控制器</th>
            <th width="160">动作</th>
            <th>权限</th>
            <th width="180">管理</th>
        </tr>
    </thead>
    <tbody>
	<?php foreach($menu as $m):?>
    <tr>
    	<th><input type="hidden" name="id[]" value="<?php echo $m['id'];?>" /><input type="text" class="mini" name="sort[<?php echo $m['id'];?>]" size="2" value="<?php echo $m['sort'];?>" /></th>
        <th><?php echo $m['name'];?></th>
        <th><?php echo $m['control'];?></th>
        <th><?php echo $m['action'];?></th>
        <th><input type="hidden" name="right[<?php echo $m['id'];?>]" value="<?php echo $m['right'];?>" /></th>
        <th class="operat"><?php echo anchor('system/menudel/'.$m['id'],'删除',array('rel'=>'ajax','confirm'=>'您确定要删除菜单:'.$m['name'],'tip'=>'正在删除...'));?><?php echo anchor('system/menuedit/'.$m['id'],'修改');?><?php echo anchor('system/menustat/'.$m['id'].'/'.$m['show'],$m['show']?'<font color="green">隐藏</font>':'<font color="red">显示</font>',array('rel'=>'ajax','tip'=>'正在处理...'));?></th>
    </tr>
		<?php if(isset($m['submenu']) && is_array($m['submenu'])):foreach($m['submenu'] as $s):?>
        <tr>
            <td><input type="hidden" name="id[]" value="<?php echo $s['id'];?>" /><input type="text" class="mini" name="sort[<?php echo $s['id'];?>]" size="2" value="<?php echo $s['sort'];?>" /></td>
            <td><?php echo $s['name'];?></td>
            <td><?php echo $s['control'];?></td>
            <td><?php echo $s['action'];?></td>
            <td><input type="hidden" name="right[<?php echo $s['id'];?>]" value="<?php echo $s['right'];?>" /></td>
            <td class="operat"><?php echo anchor('system/menudel/'.$s['id'],'删除',array('rel'=>'ajax','confirm'=>'您确定要删除菜单:'.$s['name'],'tip'=>'正在删除...'));?><?php echo anchor('system/menuedit/'.$s['id'],'修改');?><?php echo anchor('system/menustat/'.$s['id'].'/'.$s['show'],$s['show']?'<font color="green">隐藏</font>':'<font color="red">显示</font>',array('rel'=>'ajax','tip'=>'正在处理...'));?></td>
        </tr>
        <?php endforeach;endif;?>
    <?php endforeach;?>
    </tbody>
</table>
</div>

<div id="submit" class="container">
	<label><input type="checkbox" value="1" name="savesort" checked="checked" />保存排序</label><label><input type="checkbox" value="1" name="saveright" />保存权限</label><input type="submit" class="button" value="提交更改" />
</div>
</form>
<script type="text/javascript">
$('input[name^=right]').each(function(i,a){
    new syncTag(a).check=function(v){
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
