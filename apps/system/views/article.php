<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
<?php echo anchor('article/add','添加文章');?>
<?php echo anchor('article/craft',"草稿箱({$craftcount})");?>
</div>

<?php echo form_open('article/batch',array('name'=>'list','method'=>'post'))?>
    <div class="container noborder">
        <table id="listtable">
            <thead>
                <tr>
                    <th width="60">#</th>
                    <th>标题</th>
                    <th>作者</th>
                    <th>日期</th>
                    <th>评论</th>
                    <th>状态</th>
                    <th>管理</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($list->result_array() as $row):?>
                <tr>
                    <td><input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" /></td>
                    <td><?php echo anchor('',$row['title']);?></td>
                    <td><?php echo $row['author'];?></td>
                    <td><?php echo date('Y-m-d',$row['date']);?></td>
                    <td><?php echo $row['cmtcount']?></td>
                    <td><?php echo show_state((int)$row['state']);?></td>
                    <td class="operat"><?php echo anchor('article/del/'.$row['id'],'删除',array('rel'=>'ajax','confirm'=>'您确定要删除这篇文章?','tip'=>'正在处理...'));?><?php echo anchor('article/edit/'.$row['id'],'修改');?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
            	<tr><td colspan="7" align="right"><?php echo $page;?></td></tr>
            </tfoot>
        </table>
    </div>
    <div id="foot" class="container">
    	<span class="label"><a href="javascript:void($(document.list['id[]']).attr('checked',true))">全选</a> / <a href="javascript:void($(document.list['id[]']).attr('checked',false))">取消</a></span>
        <label><input type="radio" name="action" value="del" checked />删除</label>
        <span class="group">
        <label><input type="radio" name="action" value="state" />状态</label>
        <label><input type="checkbox" name="state[]" value="<?php echo STATE_SHOW;?>" checked />显示</label>
        <label><input type="checkbox" name="state[]" value="<?php echo STATE_FILT;?>" checked />审核</label>
        <label><input type="checkbox" name="state[]" value="<?php echo STATE_TOP;?>" />置顶</label>
        </span>
        <input type="submit" class="button" value="提交更改" />
    </div>
</form>
<?php include('include/foot.php');?>
