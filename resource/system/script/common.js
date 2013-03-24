
$(function(){
	//表单异步提交
	$('form').submit(function(e){
		e.preventDefault();
		tip('正在提交请求',2)
		var fn=arguments.callee,_=$(this);
		_.unbind('submit').submit(function(e){e.preventDefault();tip('请勿重复提交,请等待服务器返回信息',1)});
		$.ajax({
			data:_.serialize(),
			dataType:'json',
			url:_.attr('action'),
			type:_.attr('method'),
			error:function(d){
				tip('服务器错误,请稍后再试',3);
				_.unbind('submit').submit(fn);
			},
			success:function(d){
			    var url='window.onbeforeunload=null;';
			    url += !d['url']?
			        'location.reload()':
			        d['url']==-1?
			        'history.back()':
			        'location.href=\''+d['url']+'\'';
				if(_.attr('after'))Eval(_.attr('after'));
				tip(d['message'],d['number'],2,d['number']==0?url:function(){_.unbind('submit').submit(fn);});
				
			}
		});
	});
	//链接异步提交
	$('a[rel=ajax]').click(
		function(e){
			e.preventDefault();
			var after=$(this).attr('after');
			if($(this).attr('confirm')){
			    if(!confirm($(this).attr('confirm')))return;
			}
			if($(this).attr('tip')){
			    tip($(this).attr('tip'),2,10);
			}
			
			$.get($(this).attr('href'),function(d){
			    if(after)Eval(after);
				tip(d['message'],d['number'],2,d['number']==0?'location.reload()':'');
			},'json')
		}
	);
	//底部操作选择
	$('#foot span.group input[type=radio]').change(function(){
		if(this.checked){
			$(this.parentNode.parentNode).find('input[type=checkbox]').attr('disabled',false);
		}else{
			$(this.parentNode.parentNode).find('input[type=checkbox]').attr('disabled',true);
		}
	}).trigger('change');
	$('#foot input[type=radio]').click(function(){$('#foot span.group input[type=radio]').trigger('change')});
	
	//表格行高亮
	$('#listtable tbody tr').hover(function(){
		$(this).addClass('hover');
	},function(){
		$(this).removeClass('hover');
	}).click(function(){
		var ck=$(this).children('td').eq(0).find('input[type=checkbox]');
		if(ck.length<1)return;
		if(ck.attr('checked')){
			ck.attr('checked',false);
			$(this).removeClass('select');
		}else{
			ck.attr('checked',true);
			$(this).addClass('select');
		}
	}).find('a,input').click(function(e){
		e.stopPropagation();
		if($(this).attr('type')=='checkbox'){
			if($(this).attr('checked')){
				$(this).parents('tr').addClass('select');
			}else{
				$(this).parents('tr').removeClass('select');
			}
		}
	});
	
	//表格头部跟随滚动
	var th=$('#listtable thead,#edittable thead').eq(0);
	if(th.length>0){
		var ht=th.offset()['top'],ftbl=$('<table class="fixedhold"><thead>'+th.html()+'</thead></table>');
		ftbl.css({'width':th.width()+4,'position':'fixed','top':0}).insertBefore(th.parent()).hide();
		$(window).bind('scroll',function(){
			if($(window).scrollTop()>ht){
				ftbl.show();
			}else{
				ftbl.hide();
			}
		})
	}
	//表格底部跟随滚动
	var tf=$('#listtable tfoot,#edittable tfoot,#submit').eq(0);
	if(tf.length>0){
		var ft=tf.offset()['top'];
		tf.css('width',tf.width());
		tf.find('td,th').each(function(i,d){$(d).css('width',$(d).width())});
		$(window).bind('scroll',function(){
			if($(window).scrollTop()+$(window).height()<ft){
				tf.css({'position':'fixed','bottom':0});
			}else{
				tf.css('position','');
			}
		});
	}
});
