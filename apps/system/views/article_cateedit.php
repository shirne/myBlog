<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
    <?php echo anchor('article/cate','分类管理');?>
</div>
<?php echo form_open('article/catesave/'.$cate['id'],array('method'=>'post','name'=>'edit'));?>
<div class="container noborder">
    <table id="edittable">
        <tbody>
            <tr>
                <th width="80">分类名称</th>
                <td><input type="text" class="text" name="name" value="<?php echo $cate['name'];?>" /></td>
            </tr>
            <tr>
                <th>父级分类</th>
                <td><select name="pid">
                    <option value="0">作为顶级分类</option>
                    <?php foreach($pcate as $p):?>
                    <option value="<?php echo $p['id'];?>"><?php echo $p['name'];?></option>
                    <?php endforeach;?>
                </select></td>
            </tr>
            <tr>
                <th>排序</th>
                <td><input type="text" class="text" name="sort" value="<?php echo $cate['sort'];?>"</td>
            </tr>
            <tr>
                <th>图标</th>
                <td><input type="text" class="text" name="thumb" value="<?php echo $cate['thumb'];?>"</td>
            </tr>
            <tr>
                <th>说明</th>
                <td><input type="text" class="text" name="detail" value="<?php echo $cate['detail'];?>"</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" class="button" value="<?php echo $action;?>分类"</td>
            </tr>
        </tfoot>
    </table>
</div>
</form>
<?php include('include/foot.php');?>
