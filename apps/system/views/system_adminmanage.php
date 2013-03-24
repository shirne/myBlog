<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
<?php echo anchor('system/adminadd','添加管理员');?>
</div>
<?php echo form_open('system/adminbatch',array('name'=>'list','method'=>'post'));?>
	<div class="container noborder">
    <table id="listtable">
    	<thead>
        	<tr>
        	<th width="20">#</th>
            <th>帐号</th>
            <th>名称</th>
            <th>登陆日期</th>
            <th>登陆IP</th>
            <th width="160">管理</th>
            </tr>
        </thead>
        <tbody>
        	<?php foreach($list as $r):?>
        	<tr>
        	<td><input type="checkbox" name="id[]" value="<?php echo $r['id'];?>" /></td>
            <td><?php echo $r['account'];?></td>
            <td><?php echo $r['name'];?></td>
            <td><?php echo date('Y-m-d H:i:s',$r['logintime']);?></td>
            <td><?php echo $r['loginip'];?></td>
            <td><?php if($userid == $r['id']):?>
            这是您自己
            <?php else:?>
            <?php echo anchor('system/admindel/'.$r['id'],'删除',array('rel'=>'ajax','confirm'=>'确定删除?'));?>
            <?php echo anchor('system/adminedit/'.$r['id'],'修改');?>
            <?php echo anchor('system/adminright/'.$r['id'],'权限');?>
            <?php endif;?>
            </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    </div>
</form>
<?php include('include/foot.php');?>
