<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
<?php echo anchor('article/index','管理文章');?>
<?php echo anchor('article/add','添加文章');?>
</div>

<?php echo form_open('article/craftdel',array('name'=>'list','method'=>'post','after'=>'top.getcraft()'))?>
    <div class="container noborder">
        <table id="listtable">
            <thead>
                <tr>
                    <th width="60">#</th>
                    <th>标题</th>
                    <th>创建日期</th>
                    <th>最后保存</th>
                    <th>管理</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($craft->result_array() as $row):?>
                <tr>
                    <td><input type="checkbox" name="id[]" value="<?php echo $row['id'];?>" /></td>
                    <td><?php echo anchor('',$row['title']);?></td>
                    <td><?php echo date('Y-m-d H:i:s',$row['created']);?></td>
                    <td><?php echo date('Y-m-d H:i:s',$row['saved']);?></td>
                    <td class="operat"><?php echo anchor('article/craftdel/'.$row['id'],'删除',array('rel'=>'ajax','confirm'=>'您确定要删除这篇草稿?','tip'=>'正在处理...','after'=>'top.getcraft()'));?><?php echo anchor('article/craftread/'.$row['id'],'恢复');?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <div id="foot" class="container">
        <span class="label"><a href="javascript:void($(document.list['id[]']).attr('checked',true))">全选</a> / <a href="javascript:void($(document.list['id[]']).attr('checked',false))">取消</a></span>
        <label><input type="radio" name="action" value="del" checked />删除</label>
        <input type="submit" class="button" value="提交更改" />
    </div>
</form>
<script type="text/javascript">
</script>
<?php include('include/foot.php');?>
