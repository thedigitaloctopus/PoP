!function(){var e=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["em-calendar"]=e({1:function(e,l,a,n,t){var s;return e.escapeExpression((s=null!=(s=a.id||(null!=l?l.id:l))?s:a.helperMissing,"function"==typeof s?s.call(null!=l?l:e.nullContext||{},{name:"id",hash:{},data:t}):s))},3:function(e,l,a,n,t){var s,r=e.escapeExpression;return" "+r((s=null!=(s=a.key||t&&t.key)?s:a.helperMissing,"function"==typeof s?s.call(null!=l?l:e.nullContext||{},{name:"key",hash:{},data:t}):s))+'="'+r(e.lambda(l,l))+'"'},5:function(e,l,a,n,t,s,r){var d=null!=l?l:e.nullContext||{},u=a.helperMissing,o=e.escapeExpression;return'\t<div class="pop-calendar-controls" data-target="#'+o((a.lastGeneratedId||l&&l.lastGeneratedId||u).call(d,{name:"lastGeneratedId",hash:{context:r[1]},data:t}))+'">\n\t\t'+o((a.enterModule||l&&l.enterModule||u).call(d,r[1],{name:"enterModule",hash:{},data:t}))+"\n\t</div>\n"},7:function(e,l,a,n,t,s,r){return"\t\t"+e.escapeExpression((a.enterModule||l&&l.enterModule||a.helperMissing).call(null!=l?l:e.nullContext||{},r[1],{name:"enterModule",hash:{items:null!=r[1]?r[1].items:r[1],itemDBKey:null!=r[1]?r[1].itemDBKey:r[1]},data:t}))+"\n"},compiler:[7,">= 4.0.0"],main:function(e,l,a,n,t,s,r){var d,u,o,i=null!=l?l:e.nullContext||{},c=a.helperMissing,h="function",p=e.escapeExpression,m="<div ";return u=null!=(u=a.generateId||(null!=l?l.generateId:l))?u:c,o={name:"generateId",hash:{},fn:e.program(1,t,0,s,r),inverse:e.noop,data:t},d=typeof u===h?u.call(i,o):u,a.generateId||(d=a.blockHelperMissing.call(l,d,o)),null!=d&&(m+=d),m+' class="calendar make-fullcalendar '+p((u=null!=(u=a.class||(null!=l?l.class:l))?u:c,typeof u===h?u.call(i,{name:"class",hash:{},data:t}):u))+'" style="'+p((u=null!=(u=a.style||(null!=l?l.style:l))?u:c,typeof u===h?u.call(i,{name:"style",hash:{},data:t}):u))+'" '+(null!=(d=a.each.call(i,null!=l?l.params:l,{name:"each",hash:{},fn:e.program(3,t,0,s,r),inverse:e.noop,data:t}))?d:"")+"></div>\n"+(null!=(d=(a.withModule||l&&l.withModule||c).call(i,l,"controlgroup",{name:"withModule",hash:{},fn:e.program(5,t,0,s,r),inverse:e.noop,data:t}))?d:"")+'\n<div class="calendar-inner '+p((u=null!=(u=a["class-merge"]||(null!=l?l["class-merge"]:l))?u:c,typeof u===h?u.call(i,{name:"class-merge",hash:{},data:t}):u))+'" id="'+p((u=null!=(u=a.lastGeneratedId||(null!=l?l.lastGeneratedId:l))?u:c,typeof u===h?u.call(i,{name:"lastGeneratedId",hash:{},data:t}):u))+'-merge">\n'+(null!=(d=(a.withModule||l&&l.withModule||c).call(i,l,"inner",{name:"withModule",hash:{},fn:e.program(7,t,0,s,r),inverse:e.noop,data:t}))?d:"")+"</div>"},useData:!0,useDepths:!0})}();