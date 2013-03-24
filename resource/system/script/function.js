$.extend($.fn,{
	Tips:function(opt){
		var st=$.extend({
				type: 'load',   //okay,warn,error,load
				text: '系统繁忙请稍后...',
				time: 3
			},opt),c='.jquery_tips',color={okay:'#080',warn:'#808',error:'#800',load:'#008'};
		if($(c).length>0)
			$(c).remove();
			
		var w=st.text.length*14+65,
			pleft=$(document).width()/2-w/2,
			ptop=$(document).scrollTop()+200;
		
		return $('<div class="jquery_tips"><span class="right"></span><span class="left"></span><p class="main" style="width:'+(w-19)+'px"><span class="stat '+st.type+'"></span>'+st.text+'</p></div>').css({width:w,left:pleft,top:ptop,color:color[st.type]}).appendTo('body').delay((st.time-1)*1000).fadeOut(1000,function(){$(c).remove()});
	}
});

String.prototype.trim=function(){
    return this.replace(/^\s*|\s*$/g,'');
}

function syncTag(p){
    var _=this;
    if(!p.tagName || p.tagName.toLowerCase()!='input')return;
    _.input=p;
    _.value=function(v){if(v!==undefined)_.input.value=v;return _.input.value};
    _.separator=",";
    
    _.check=function(){return true;};
    
    var oa=$(_.input);
    _.oninit=function(){
        if(_.value().length>0){
            var va=_.value().split(_.separator);
            _.value('');
            $.each(va,function(i,a){
                _.makeTag(a);
            });
        }
        var addNew=$('<span class="addtag">添加</span>');
        addNew.click(function(){
            var fn=arguments.callee,text=$(this).text();
            $(this).unbind('click');
            $(this).html('').append(p=$('<input type="text" class="mini" size="8" />'));
            p.focus().keydown(function(e){
                if(e.keyCode==13){
                    e.preventDefault();
                    e.stopPropagation();
                    var val=p.val().trim();
                    
                    if(val!=''){
                        if(val.indexOf(_.separator)>-1){
                            $.each(val.split(_.separator),function(i,a){
                                _.makeTag(a);
                            });
                        }else{
                            _.makeTag(val);
                        }
                    }
                    addNew.html(text).click(fn);
                };
            });
        });
        oa.after(addNew);
    };
    
    _.onchange=function(){
        var tags=$(_.input).siblings('span.tag');
        var label=[];
        if(tags.length){
            tags.each(function(i,a){
                var text=$(a).attr('tag').trim();
                if(text.length)label.push(text);
            });
            oa=tags.eq(-1);
        }else{
            oa=$(_.input);
        }
        _.value(label.join(_.separator));
    }
    
    _.makeTag=function(a){
        var b,tags=$(_.input).siblings('span.tag'),has=false;
        a=a.trim();
        if(a=='')return false;
        
        //查找是否已经存在
        tags.each(function(i,t){
            if($(t).attr('tag')==a){
                $(t).addClass('taghover');
                setTimeout(function(){$(t).removeClass('taghover');},3000)
                tip('标签已存在',1);
                has=true;
                return false;
            }
        })
        
        if(!has && _.check(a)){
            oa.after(b=$('<span class="tag">'+a+'<a href="javascript:void(0)">X</a></span>'));
            b.attr('tag',a);
            var valuearray=[];
            if(_.value()!='')valuearray=_.value().split(_.separator);
            valuearray.push(a);
            _.value(valuearray.join(_.separator));
            b.find('a').click(function(){
                b.remove();
                _.onchange();
            });
            oa.after(b);
            oa=b;
            return true;
        }
        
        return false;
    };
    
    _.oninit();
}


function tip(msg,type,t,c){
	var types=['okay','warn','load','error'];
	if(!t)t=3;
	$.fn.Tips({text:msg,type:types[type],time:t});
	if(c!==undefined)setTimeout(c,(t-1)*1000);
}

function Eval(str){
    try{
        eval(str);
    }catch(e){
    
    }
}

//自动保存草稿
function autosave(opt){
    this.option={
        'url':'',   //提交网址
        'time':30,  //间隔时间
        'form':null,    //表单
        'bar':null,     //一个控制是否自动保存的a链接
        'autosave':false,   //是否自动保存
        'init':function(){},    //第一次初始化调用
        'before':function(){return true},   //提交前的动作，如果返回false,则取消本次提交
        'after':function(d){}   //提交返回后的回调,传入一个返回数据
    };
    this.t=null;
    var _=this,inited=false;
    _.option=$.extend(_.option,opt);
    
    this.submit=function(force){
        _.init();
        _.stop();
        rtn=_.option.before();
        if(rtn || force){
            $.ajax({
                'url':_.option.url,
                'data':$(_.option.form).serialize(),
                'type':'post',
                'dataType':'json',
                'error':function(){
                    if(_.option.autosave)_.start();
                    _.option.after(null);
                },
                'success':function(d){
                    if(_.option.autosave)_.start();
                    _.option.after(d);
                }
            });
            return true;
        }else{
            if(_.option.autosave)_.start();
            return false;
        }
    };
    
    this.start=function(){
        _.stop();
        _.t=setTimeout(this.submit,_.option.time*1000);
    };
    this.stop=function(){
        clearTimeout(_.t);
    };
    
    this.init=function(){
        if(!inited){
            _.option.init();
            inited=true;
        }
    }
    
    if(_.option.autosave){
        _.init();
        _.start();
    }
    if(_.option.bar){
        _.option.bar.text(_.option.autosave?'停止自动保存':'开始自动保存')
        .click(function(){
            if(_.option.autosave){
                _.stop();
                _.option.bar.text('开始自动保存');
                _.option.autosave=false;
            }else{
                _.start();
                _.option.bar.text('停止自动保存');
                _.option.autosave=true;
            }
        });
    }
}



/*End javascript file*/
