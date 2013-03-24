<?php include('include/head.php');?>
<?php include('include/nav.php');?>
<div id="links" class="container">
<?php echo anchor('article/index','管理文章');?>
<?php echo anchor('article/craft',"草稿箱({$craftcount})");?>
</div>
<?php echo form_open('article/save/'.(isset($art['id'])?$art['id']:''),array('method'=>'post','name'=>'edit'));?>
<?php if(isset($art['craft_id'])):?>
    <input type="hidden" name="craft_id" value="<?php echo $art['craft_id'];?>" />
<?php endif;?>
<div class="container noborder">
    <table id="edittable">
        <tbody>
            <tr>
                <th width="80">标题</th>
                <td><input type="text" class="text" name="title" size="60" value="<?php echo $art['title']?>" /></td>
            </tr>
            <tr>
                <th>设置</th>
                <td><label>分类：<select name="cate">
					<?php foreach($cate as $c):?>
                    <option value="<?php echo $c['id']?>"><?php echo $c['name']?></option>
					<?php if(isset($c['subcate'])):foreach($c['subcate'] as $s):?>
					<option value="<?php echo $s['id']?>"><?php echo $s['name']?></option>
					<?php endforeach;endif;?>
					<?php endforeach;?>
                </select></label>&nbsp;&nbsp;属性：<label><input type="checkbox" name="state[]" value="<?php echo STATE_SHOW?>" <?php if((intval($art['state']) & STATE_SHOW)==STATE_SHOW) echo 'checked'?>/>显示</label>
                <label><input type="checkbox" name="state[]" value="<?php echo STATE_FILT?>" <?php if((intval($art['state']) & STATE_FILT)==STATE_FILT) echo 'checked'?>/>审核</label>
                <label><input type="checkbox" name="state[]" value="<?php echo STATE_TOP?>" <?php if((intval($art['state']) & STATE_TOP)==STATE_TOP) echo 'checked'?>/>置顶</label></td>
            </tr>
            
            <tr>
                <th>内容</th>
                <td><textarea name="content"><?php echo htmlspecialchars($art['content']);?></textarea></td>
            </tr>
            <tr>
                <th>摘要</th>
                <td><textarea name="summary" class="text" style="width:90%;height:40px"><?php echo $art['summary']?></textarea></td>
            </tr>
            <?php if(!empty($art['id']) && empty($art['craft_id'])):?><tr>
                <th>信息</th>
                <td>添加日期：<?php echo date('Y-m-d H:i:s',$art['date']);?>　修改日期：<?php echo date('Y-m-d H:i:s',$art['mdate']);?>　点击：<?php echo $art['hits'];?></td>
            </tr><?php endif;?>
            <tr>
                <th>图集</th>
                <td><input type="hidden" name="images" value="<?php echo $art['thumb']?>" /><input type="button" class="button" value="上传" id="uploadimg" /></td>
            </tr>
            <tr>
                <th>缩略图</th>
                <td><input type="hidden" name="thumb" value="<?php echo $art['thumb']?>" /><input type="button" class="button" value="上传" id="uploadview" /></td>
            </tr>
            <tr>
                <th>标签</th>
                <td><input type="hidden" name="tags" value="<?php echo $art['tags']?>" /></td>
            </tr>
            <tr>
                <th>来源</th>
                <td><input type="text" class="text" name="refer" size="60" value="<?php echo $art['refer']?>" /></td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" class="button" value="<?php echo $action;?>文章" /><input type="button" class="button" id="savecraft" value="保存草稿" /><span class="tip" id="autosave"></span></td>
            </tr>
        </tfoot>
    </table>
</div>
</form>
<?php echo create_editor('editor');?>
<script type="text/javascript">
$(function(){
    new syncTag(document.edit.tags).check=function(){
        return true;
    };
	//上传按钮
	$('#uploadimg').upload({
			'name':'picdata',
			'maxNum':20,
			'action':'<?php echo site_url('system/imageupload') ?>'
		});
	$('#uploadview').upload({
			'name':'picdata',
			'action':'<?php echo site_url('system/imageupload') ?>'
		});
    
    //自动保存功能
    tipelement=$('#autosave');
    a=$('<a href="javascript:void(0)"></a>');
    tipelement.before(a);
    var changed=false;
	//编辑器内容发生改变时才保存草稿
    window.editor.addListener('contentchange',function(){
		var cl=arguments.callee;
        changed=true;
		window.onbeforeunload=function(){return '文章已经修改，您确定要退出吗?'};
		window.editor.removeListener('contentchange',cl);
    });
	
    var asart=new autosave({
        'url':'<?php echo site_url('article/craftsave/'.(isset($art['id'])?$art['id']:''));?>',
        'form':document.edit,
        'time':60,
        'bar':a,
        'autosave':true,
        'before':function(){
            window.editor.sync();
            if(changed){
                tipelement.html('正在自动保存草稿...');
                return true;
            }
            return false;
        },
        'after':function(d){
            if(d){
                if(d.message){
                    tipelement.html(d.message);
                }else{
                    tipelement.html('服务器错误,草稿保存失败');
                }
                if(d.data && !document.edit.craft_id){
					//保存草稿成功后将草稿的ID添加到表单
                    $('<input type="hidden" name="craft_id" value="'+d.data+'" />').appendTo(document.edit);
                    //同步草稿数目
					top.getcraft && top.getcraft();
					//文章保存成功后会删除对应的草稿，这里添加保存成功后同步草稿的操作
					$(document.edit).attr('after','top.getcraft()');
                }
            }else{
                tipelement.html('服务器错误,没能自动保存成功');
            }
        }
    });
    $('#savecraft').click(function(){
        asart.submit(true);
    });
});
</script>
<?php include('include/foot.php');?>
