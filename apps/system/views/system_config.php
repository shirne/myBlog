<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
<?php foreach($config->result_array() as $c):?>
<?php echo anchor('system/config/'.$c['name'],'添加配置');?>
<?php endforeach;?>
<?php echo anchor('system/configadd','添加配置');?>
</div>

<?php echo form_open('system/configsave/',array('name'=>'list','method'=>'post'));?>
<div class="container noborder">
<table id="listtable">
	<thead>
    	<tr>
        	<th width="50">配置名</th>
            <th width="200">配置值</th>
        </tr>
    </thead>
    <tbody>
	
    <tr>
    	<th>网站名称</th>
    	<td></td>
    </tr>
    <tr>
    	<th>网站地址</th>
    	<td></td>
    </tr>
    <tr>
    	<th>网站名称</th>
    	<td></td>
    </tr>
    <tr>
    	<th>网站名称</th>
    	<td></td>
    </tr>
    <tr>
    	<th>网站名称</th>
    	<td></td>
    </tr>
    <tr>
    	<th>网站名称</th>
    	<td></td>
    </tr>
    <tr>
    	<th>网站名称</th>
    	<td></td>
    </tr>
	
    </tbody>
</table>
</div>

<div id="submit" class="container">
	<label><input type="radio" name="action" checked="checked" value="del" />删除</label><input type="submit" class="button" value="提交更改" />
</div>
</form>
<?php include('include/foot.php');?>