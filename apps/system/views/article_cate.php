<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
    <?php echo anchor('article/cateadd','添加分类');?>
</div>
<?php echo form_open('article/catebatch',array('method'=>'post','name'=>'list'));?>
<div class="container noborder">
    <table id="listtable">
        <thead>
            <tr>
                <th width="50">排序</th>
                <th>名称</th>
                <th>图标</th>
                <th>说明</th>
                <th width="180">管理</th>
            </tr>
        </thead>
        <tbody>
        
            <?php foreach($cate as $c):?>
            <tr>
                <td><input type="hidden" name="id[]" value="<?php echo $c['id'];?>" /><input type="text" class="mini" size="2" name="sort[]" value="<?php echo $c['sort'];?>" /></td>
                <td><?php echo $c['name'];?></td>
                <td><?php echo $c['thumb'];?></td>
                <td><?php echo $c['detail'];?></td>
                <td>
                <?php echo anchor('article/catedel/'.$c['id'],'删除',array('rel'=>'ajax','confirm'=>'确定删除该分类?'));?>
                <?php echo anchor('article/cateedit/'.$c['id'],'修改');?>
                </td>
            </tr>
			<?php if(isset($c['subcate'])):foreach($c['subcate'] as $s):?>
            <tr>
                <td><input type="hidden" name="id[]" value="<?php echo $s['id'];?>" /><input type="text" class="mini" size="2" name="sort[]" value="<?php echo $s['sort'];?>" /></td>
                <td><?php echo $s['name'];?></td>
                <td><?php echo $s['thumb'];?></td>
                <td><?php echo $s['detail'];?></td>
                <td>
                <?php echo anchor('article/catedel/'.$s['id'],'删除',array('rel'=>'ajax','confirm'=>'确定删除该分类?'));?>
                <?php echo anchor('article/cateedit/'.$s['id'],'修改');?>
                </td>
            </tr>
            <?php endforeach;endif;?>
            <?php endforeach;?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

<div id="submit" class="container">
	<label><input type="checkbox" value="1" name="savesort" checked="checked" />保存排序</label><input type="submit" class="button" value="提交更改" />
</div>
</form>
<?php include('include/foot.php');?>
