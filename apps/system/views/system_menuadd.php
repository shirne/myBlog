<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
<?php echo anchor('system/menumanage','菜单管理');?>
</div>
<?php echo form_open('system/menusave/'.$menu['id'],array('name'=>'edit','method'=>'post'));?>
<div class="container noborder">
<table id="edittable">
    <tbody>
        <tr>
            <th width="80">菜单名称</th>
            <td><input type="text" class="text" name="name" value="<?php echo $menu['name']?>" /></td>
        </tr>
        <tr>
            <th>父级菜单</th>
            <td><select name="parent">
                <option value="0">作为一级菜单</option>
                <?php foreach($pmenu->result_array() as $pm):?>
                <option value="<?php echo $pm['id']?>"<?php if($menu['parent']==$pm['id']) echo 'selected';?>><?php echo $pm['name']?></option>
                <?php endforeach;?>
            </select></td>
        </tr>
        <tr>
            <th>是否显示</th>
            <td><label><input type="radio" name="show" value="1" <?php if($menu['show']=='1')echo 'checked';?> />是</label><label><input type="radio" name="show" value="0" <?php if($menu['show']=='0')echo 'checked';?> />否</label></td>
        </tr>
        <tr>
            <th>排序</th>
            <td><input type="text" class="text" name="sort" value="<?php echo $menu['sort']?>" /></td>
        </tr>
        <tr>
            <th>控制器</th>
            <td><input type="text" class="text" name="control" value="<?php echo $menu['control']?>" /></td>
        </tr>
        <tr>
            <th>动作</th>
            <td><input type="text" class="text" name="action" value="<?php echo $menu['action']?>" /></td>
        </tr>
        <tr>
            <th>权限</th>
            <td><input type="hidden" name="right" value="<?php echo $menu['right']?>" /></td>
        </tr>
    </tbody>
    <tfoot>
        <tr><td>&nbsp</td><td><input type="submit" class="button" value="<?php echo $action?>菜单" /></td></tr>
    </tfoot>
</table>
</div>
</form>
<script type="text/javascript">
$(function(){
    new syncTag(document.edit.right).check=function(v){
        var n=parseInt(v);
        if(n && n>0 && n<51){
            return true;
        }
        tip('权限值请填写0-50的数字',1);
        return false;
    };
})
</script>
<?php include('include/foot.php');?>
