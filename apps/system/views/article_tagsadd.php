<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
    <?php echo anchor('article/tags','标签管理');?>
    <?php echo anchor('article/tagsadd','添加标签');?>
    <?php #echo anchor('article/cateadd','批量添加');?>
</div>
<?php echo form_open('article/tagsbatch',array('method'=>'post','name'=>'list'));?>
<div class="container noborder">
    <table id="listtable">
        <thead>
            <tr>
                <th width="50">#</th>
                <th>名称</th>
                <th>副名</th>
                <th>点击</th>
                <th>计数</th>
                <th width="180">管理</th>
            </tr>
        </thead>
        <tbody>
        
            <?php foreach($tags->result_array() as $c):?>
            <tr>
                <td><input type="checkbox" name="id[]" value="<?php echo $c['id'];?>" /></td>
                <td><?php echo $c['tag'];?></td>
                <td><?php echo $c['vice'];?></td>
                <td><?php echo $c['hits'];?></td>
                <td><?php echo $c['count'];?></td>
                <td>
                <?php echo anchor('article/tagsdel/'.$c['id'],'删除',array('rel'=>'ajax','confirm'=>'确定删除该标签?'));?>
                <?php echo anchor('article/tagsedit/'.$c['id'],'修改');?>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>

<div id="submit" class="container">
	<label><input type="checkbox" value="1" name="del" checked="checked" />删除</label><input type="submit" class="button" value="提交更改" />
</div>
</form>
<?php include('include/foot.php');?>