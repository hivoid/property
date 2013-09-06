/*
 * jQuery级联选择框
 *
 * Copyright 2013 Xiao XinMing <xming.xiao@gmail.com>
 * Date: 2013-07-01
 */
(function($){
	var MSCALLFN = function(){$.multiSelector.callback();};
	$.extend({multiSelector:function(options){
		$.multiSelector.options  = $.extend({}, $.multiSelector.defaults, options);
		var options  = $.multiSelector.options;
		var data     = options.source.data;
		var relation = options.source.relation;
		if(relation == undefined || data == undefined || relation.length == 0 || data.length == 0 || relation[0] == undefined || relation[0].length == 0) {alert('ERROR: No data to display.'); return false;}
		options.choicemax = Math.max(1, options.choicemax);
		options.minlevel = Math.min(3, options.minlevel);
		if($.isFunction(options.selected)){options.selected = options.selected();}
		if($.multiSelector.options.choicemax == 1) options.selected = $.isFunction(options.selected) || $.isArray(options.selected) || $.isPlainObject(options.selected) || !options.selected ? [] : [options.selected];
		if(!$.isArray(options.selected)){options.selected = [];}
		$.multiSelector.result = $.multiSelector.options.choicemax == 1 ? {values:'',pairs:{}} : {values:[],pairs:{}};
		$.multiSelector.selector = $('<div class="multi-selector"><div class="select-toolbar"><a id="multi-selector-closer">&#215;</a></div><div class="select-area"><ul level="1"></ul></div><div class="selector-result"><h3 class="select-rs-hd">您的选择</h3><ul></ul></div><div class="selector-decision"><input type="button" class="selector-button" value="确定" /></div></div>');
		var startul = $('ul[level="1"]', $.multiSelector.selector);
		$(relation[0]).each(function(k,v){
			if(relation[v] == undefined || relation[v].length == 0){
				if(1 >= options.minlevel){
					startul.append('<li rel="0" val="'+v+'" level="1" title="'+data[v].name+'"><input type="checkbox" id="chb_'+v+'" name="multi-chb" rel="0" value="'+v+'" />'+data[v].name+'</li>');
				}else{
					startul.append('<li rel="0" val="'+v+'" level="1" title="'+data[v].name+'">'+data[v].name+'</li>');
				}
			}else{
				if(1 >= options.minlevel){
					startul.append('<li rel="0" val="'+v+'" level="1" title="'+data[v].name+'" class="have-children"><input type="checkbox" id="chb_'+v+'" name="multi-chb" rel="0" value="'+v+'" />'+data[v].name+'</li>');
				}else{
					startul.append('<li rel="0" val="'+v+'" level="1" title="'+data[v].name+'" class="have-children">'+data[v].name+'</li>');
				}
			}
		});
		if(options.selected.length > 0){
			$(options.selected).each(function(k, v){$.multiSelector.select(v);});
		}
		$("body").append($.multiSelector.overlay);$("body").append($.multiSelector.selector);
		var topMeasure  = parseInt($.multiSelector.selector.css('top'));
		var topOffset = $.multiSelector.selector.height() + topMeasure;

		$.multiSelector.selector.bind('open', function(){
			if(!$.multiSelector.locked){
				lock();$.multiSelector.selector.css({'top': $(document).scrollTop()-topOffset,'opacity':0,'visibility':'visible'});$.multiSelector.overlay.fadeIn(options.speed/2);
				$.multiSelector.selector.delay(options.speed/2).animate({"top":$(document).scrollTop()+topMeasure+'px',"opacity":1},options.speed,function(){$.multiSelector.closed = false;unlock();});
			}
			$.multiSelector.selector.unbind('open');
		}).bind('close', function(){
			if(!$.multiSelector.locked){
				lock();$.multiSelector.overlay.delay(options.speed).fadeOut(options.speed);
				$.multiSelector.selector.animate({"top":$(document).scrollTop()-topOffset+'px',"opacity":0},options.speed/2,function(){$.multiSelector.selector.css({'top':topMeasure,'opacity':1,'visibility':'hidden'});$.multiSelector.overlay.remove();$.multiSelector.selector.remove();$.multiSelector.closed = true;unlock();});
			}
		});
		$.multiSelector.selector.trigger('open');
		if(options.bgclose){$.multiSelector.overlay.css({"cursor":"pointer"});$.multiSelector.overlay.bind('click', function(){$.multiSelector.selector.trigger('close')});}
		function unlock(){$.multiSelector.locked = false;}
		function lock(){$.multiSelector.locked = true;}
	}});
	$.extend($.multiSelector,{
		locked: false,
		defaults: {bgclose: true, choicemax:3, minlevel: 1, speed: 300, source: {relation:{},data:{}}, selected:[], callback: MSCALLFN, trigger:null},
		options: {},
		overlay: $('<div class="selector-overlay"></div>'),
		selector: {},
		result: {},
		closed: true,
		close: function(){
			if($.multiSelector.closed) return;
			$.multiSelector.selector.trigger('close');
		},
		allparents: function(v, m){var ps = []; if(m == undefined){m=true;}else{ps.push(v);} if($.multiSelector.options.source.data[v].parent != 0){$.merge(ps, this.allparents($.multiSelector.options.source.data[v].parent, m));} return ps;},
		select: function(v, ov){
			var data = $.multiSelector.options.source.data;
			var relation = $.multiSelector.options.source.relation;
			if(!data[v]) return false;
			var li = $('.select-area li[val="'+v+'"]', $.multiSelector.selector);
			if(!ov){ ov = v;
				var seledchd = [];
				var handledlen = $('.selector-result li', $.multiSelector.selector).length
				$('input:checkbox[name="select-result"]', $.multiSelector.selector).each(function(k,sr){
					var chdv = $(sr).val(); seledchd.push(chdv); var ps = $.multiSelector.allparents(chdv);
					if($.inArray(v, ps) >= 0){handledlen--;}
				});
				// 如果限制选择一个，则自动删除已选项.
				if($.multiSelector.options.choicemax == 1){$(seledchd).each(function(ck,chval){$.multiSelector.deselect(chval);});}
				else if($.multiSelector.options.choicemax <= handledlen) return 'upper'; // 抛除已选子元素, 达到设定可选最大数量
				if(li.length > 0){$('input:checkbox', li).attr('checked',true);}
				var resul = $('.selector-result ul', $.multiSelector.selector);
				if($('li[val="'+v+'"]', resul).length == 0){resul.append('<li rel="'+data[v].parent+'" val="'+v+'" level="'+data[v].level+'" title="'+data[v].name+'"><input type="checkbox" id="selected_'+v+'" name="select-result" rel="'+data[v].parent+'" value="'+v+'" checked="checked" />'+data[v].name+'</li>');}
				if(relation[v]){$(relation[v]).each(function(k, v){$.multiSelector.downwarddeselect(v);});}
				$('ul', $.multiSelector.selector).filter(function(k,o){return parseInt($(o).attr('level')) > parseInt(data[v].level)}).remove(); // 移除后边ul列表
				$('li.spreaded', $.multiSelector.selector).filter(function(k,o){return parseInt($(o).attr('level')) >= parseInt(data[v].level)}).removeClass('spreaded');
			}
			if(parseInt(data[v].level) > 1){$.multiSelector.select(data[v].parent, ov);}
			if(li.length > 0){li.addClass('selected');}
		},
		downwarddeselect: function(v){
			var data = $.multiSelector.options.source.data;
			var relation = $.multiSelector.options.source.relation;
			if(!data[v]) return;
			if(relation[v]){$(relation[v]).each(function(k, v){$.multiSelector.downwarddeselect(v);});}
			var li = $('.select-area li[val="'+v+'"]', $.multiSelector.selector);
			if(li.length > 0){li.removeClass('selected');$('input:checkbox', li).attr('checked',false);}
			var resli = $('.selector-result li[val="'+v+'"]', $.multiSelector.selector);
			if(resli.length > 0) resli.remove();
		},
		deselect: function(v, ov){
			var data = $.multiSelector.options.source.data;
			var relation = $.multiSelector.options.source.relation;
			if(!data[v]) return;
			if(!ov) ov = v;
			if(parseInt(data[v].level) > 1){$.multiSelector.deselect(data[v].parent, ov);}
			var li = $('.select-area li[val="'+v+'"]', $.multiSelector.selector);
			var resul = $('.selector-result ul', $.multiSelector.selector);
			if(ov == v){
				if(li.length > 0){$('input:checkbox', li).attr('checked',false);}
				var resli = $('.selector-result li[val="'+v+'"]', $.multiSelector.selector);
				if(resli.length > 0) resli.remove();
			}
			if(li.length > 0){
				if(ov == v){li.removeClass('selected');}
				else{
					var noChild = true;
					$('input:checkbox[name="select-result"]', $.multiSelector.selector).each(function(k,sr){
						var ps = $.multiSelector.allparents($(sr).val());
						if($.inArray(v, ps) >= 0){noChild = false;}
					});
					if(noChild){li.removeClass('selected');}
				}
			}
		},
		spread: function(v){
			var data = $.multiSelector.options.source.data;
			var relation = $.multiSelector.options.source.relation;
			if(!data[v]) return;
			var li = $('.select-area li[val="'+v+'"]', $.multiSelector.selector);
			var chkbox = $('#chb_'+v, li);
			// 如果当前已经选中 不展开
			if(chkbox.length > 0 && chkbox.attr('checked')){return;}
			if(relation[v] && relation[v].length > 0){
				$('ul', $.multiSelector.selector).filter(function(k,o){return parseInt($(o).attr('level')) > parseInt(data[v].level)}).remove();
				$('li.spreaded', $.multiSelector.selector).filter(function(k,o){return parseInt($(o).attr('level')) >= parseInt(data[v].level)}).removeClass('spreaded');
				li.addClass('spreaded');
				var newlevel = parseInt(data[v].level) + 1;
				var newul = $('<ul level="'+newlevel+'"></ul>');
				var seled = []; $('input:checkbox[name="select-result"]', $.multiSelector.selector).each(function(k,sr){seled.push($(sr).val());});
				$(relation[v]).each(function(k,cv){
					if(relation[cv] == undefined || relation[cv].length == 0){
						if(parseInt(data[cv].level) >= parseInt($.multiSelector.options.minlevel)){
							var appclass = $.inArray(cv, seled) >= 0 ? ' class="selected"' : '';
							var appstr = $.inArray(cv, seled) >= 0 ? ' checked="checked"' : '';
							newul.append('<li rel="0" val="'+cv+'" level="'+newlevel+'" title="'+data[cv].name+'"'+appclass+'><input type="checkbox" id="chb_'+cv+'" name="multi-chb" rel="0" value="'+cv+'"'+appstr+' />'+data[cv].name+'</li>');
						}else{
							newul.append('<li rel="0" val="'+cv+'" level="'+newlevel+'" title="'+data[cv].name+'">'+data[cv].name+'</li>');
						}
					}else{
						var appclass = '';
						if($.inArray(cv, seled) >= 0){appclass = ' selected';}
						else{for(var i=0;i<seled.length;i++){var ps = $.multiSelector.allparents(seled[i]);if($.inArray(cv, ps) >= 0){appclass = ' selected';break;}}}
						if(parseInt(data[cv].level) >= parseInt($.multiSelector.options.minlevel)){
							var appstr = $.inArray(cv, seled) >= 0 ? ' checked="checked"' : '';
							newul.append('<li rel="0" val="'+cv+'" level="'+newlevel+'" title="'+data[cv].name+'" class="have-children'+appclass+'"><input type="checkbox" id="chb_'+cv+'" name="multi-chb" rel="0" value="'+cv+'"'+appstr+' />'+data[cv].name+'</li>');
						}else{
							newul.append('<li rel="0" val="'+cv+'" level="'+newlevel+'" title="'+data[cv].name+'" class="have-children'+appclass+'">'+data[cv].name+'</li>');
						}
					}
				});
				newul.appendTo($('ul[level="1"]', $.multiSelector.selector).parent().eq(0));
			}
		},
		callback: function(){if($.multiSelector.options.trigger) $.multiSelector.options.trigger.val($.multiSelector.result.values.join(','));},
		complete: function(){
			$('input:checkbox[name="select-result"]', $.multiSelector.selector).each(function(k,sr){
				var rval = $(sr).val();
				if($.multiSelector.options.choicemax == 1)
					$.multiSelector.result.values = rval;
				else
					$.multiSelector.result.values.push(rval);
				$.multiSelector.result.pairs[rval] = $(sr).parent('li').eq(0).attr('title');
			});
			$.multiSelector.close();
			if($.isFunction($.multiSelector.options.callback)){$.multiSelector.options.callback($.multiSelector.result.values,$.multiSelector.result.pairs);}
			else{$.multiSelector.prompt('您定义了一个无效的回调函数.');}
		},
		prompt: function(msg){alert(msg);}
	});
	$.fn.extend({multiSelector:function(options){
		return this.each(function(){
			$(this).click(function(){options.trigger = $(this);$.multiSelector(options);});
		});
	}});
	$('html').undelegate('#multi-selector-closer', 'click').delegate('#multi-selector-closer', 'click', function(){$.multiSelector.close();});
	$('html').keyup(function(e){if(e.which===27){$.multiSelector.close();}});
	$('html').undelegate('.multi-selector input:checkbox', 'click').delegate('.multi-selector input:checkbox', 'click', function(e){e.stopPropagation();});
	$(document).on({'mouseout':function(){$(this).removeClass('hover');},'mouseover':function(){$(this).addClass('hover');}}, '.multi-selector .select-area li');
	// 选择与取消操作
	$('html').undelegate('.multi-selector .select-area input:checkbox', 'change').delegate('.multi-selector .select-area input:checkbox', 'change', function(){
		var val = $(this).val();
		if($(this).attr('checked')){
			var res = $.multiSelector.select(val);
			if(res == 'upper'){
				$(this).attr('checked', false);
				$.multiSelector.prompt('您最多允许选择 '+$.multiSelector.options.choicemax+' 项.');
			}else if(res == false){
				$(this).attr('checked', false);
				$.multiSelector.prompt('error.');
			}
		}else{
			$.multiSelector.deselect(val);
			$.multiSelector.spread(val);
		}
	});
	// 在结果中删除选项
	$('html').undelegate('.multi-selector .selector-result input:checkbox', 'change').delegate('.multi-selector .selector-result input:checkbox', 'change', function(){
		$.multiSelector.deselect($(this).val());
	});
	// 点击展开下一级 没有子级则执行选择或取消操作
	$('html').undelegate('.multi-selector .select-area li', 'click').delegate('.multi-selector .select-area li', 'click', function(){
		if($(this).hasClass('have-children')){$.multiSelector.spread($(this).attr('val'));}
		else{
			var tgr = $('input:checkbox', $(this)).eq(0);
			if(tgr.length > 0){
				var val = tgr.val();
				if(tgr.attr('checked')){
					tgr.attr('checked',false);
					$.multiSelector.deselect(val);
					$.multiSelector.spread(val);
				}else{
					tgr.attr('checked',true);
					var res = $.multiSelector.select(val);
					if(res == 'upper'){
						tgr.attr('checked', false);
						$.multiSelector.prompt('您最多允许选择 '+$.multiSelector.options.choicemax+' 项.');
					}else if(res == false){
						tgr.attr('checked', false);
						$.multiSelector.prompt('error.');
					}
				}
			}
		}
	});
	// 提交
	$('html').undelegate('.multi-selector input.selector-button', 'click').delegate('.multi-selector input.selector-button', 'click', function(){
		$(this).hide();
		$.multiSelector.complete();
	});
})(jQuery);