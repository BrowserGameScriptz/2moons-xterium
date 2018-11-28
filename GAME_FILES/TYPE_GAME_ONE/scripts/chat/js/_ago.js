(function(e){
e.fn.updateChatTime=function(tzo,f){
	this.each(function(){
			var g=e(this);
			f=f?((String(f).length<=10)?f*1000:f):"";
			if(g.parent().hasClass("stopUpdateTime")===false){
				e.update(tzo,g,f);
			}
		}
	)
};
var c={0:"few seconds ago",1:"1 min ago",59:"%m mins ago",118:"an hour ago",1439:"%H hours ago",2879:"Yesterday at %h:%i",14567:"%l at %h:%i",},
a="%d %f%y at %h:%i",
d=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],	b=["January","February","March","April","May","June","July","August","September","October","November","December"];
e.update=function(tzo,p,q){
	if(p.attr("data-ts")!="undefined"){
		if(tzo===undefined){
			tzo=0;
		}
		var D=new Date;
		var gmt=D.toGMTString();
		var now=Date.parse(gmt);
		var h=(String(p.attr("data-ts")).length<=10)?new Date(p.attr("data-ts")*1000):new Date(p.attr("data-ts"));
		var l=(String(p.attr("data-ts")).length<=10)?p.attr("data-ts")*1000:p.attr("data-ts");
		var j=(q=="")?new Date():new Date(q);
		var n=Math.round((Number(now)+(tzo*3600000)-Number(l))/60000);
		var m="",tmp="",em="";
		for(i in c){
			if(m==""&&n<=i){
				var o=Math.round(n/60),
				t=((h.getHours()<10)?"0":"")+h.getHours();
				var s=((h.getMinutes()<10)?"0":"")+h.getMinutes();
				var r=d[h.getDay()];
				m=c[i].replace(/%m/,n).replace(/%H/,o).replace(/%h/,t).replace(/%i/,s).replace(/%l/,r)	
			}
		}
			if(m==""){
				var g=((h.getDate()<10)?"0":"")+h.getDate(),
				f=b[h.getMonth()],
				k=(j.getFullYear()==h.getFullYear())?"":" "+h.getFullYear(),					t=((h.getHours()<10)?"0":"")+h.getHours(),	
				s=((h.getMinutes()<10)?"0":"")+h.getMinutes();
				p.html(a.replace(/%d/i,g).replace(/%f/i,f).replace(/%y/i,k).replace(/%h/i,t).replace(/%i/i,s))
			}else{p.html(m)}
	}
}})(jQuery);

/*!
 * jQuery TextChange Plugin
 * http://www.zurb.com/playground/jquery-text-change-custom-event
 * Copyright 2010, ZURB
 * Released under the MIT License
 */
 (function(a){a.event.special.textchange={setup:function(){a(this).data("lastValue",this.contentEditable==="true"?a(this).html():a(this).val());a(this).bind("keyup.textchange",a.event.special.textchange.handler);a(this).bind("cut.textchange paste.textchange input.textchange",a.event.special.textchange.delayedHandler)},teardown:function(){a(this).unbind(".textchange")},handler:function(){a.event.special.textchange.triggerIfChanged(a(this))},delayedHandler:function(){var c=a(this);setTimeout(function(){a.event.special.textchange.triggerIfChanged(c)},
 25)},triggerIfChanged:function(a){var b=a[0].contentEditable==="true"?a.html():a.val();b!==a.data("lastValue")&&(a.trigger("textchange",[a.data("lastValue")]),a.data("lastValue",b))}};a.event.special.hastext={setup:function(){a(this).bind("textchange",a.event.special.hastext.handler)},teardown:function(){a(this).unbind("textchange",a.event.special.hastext.handler)},handler:function(c,b){b===""&&b!==a(this).val()&&a(this).trigger("hastext")}};a.event.special.notext={setup:function(){a(this).bind("textchange",
 a.event.special.notext.handler)},teardown:function(){a(this).unbind("textchange",a.event.special.notext.handler)},handler:function(c,b){a(this).val()===""&&a(this).val()!==b&&a(this).trigger("notext")}}})(jQuery);

