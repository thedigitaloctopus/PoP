!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{}).htmlcode=l({1:function(l,a,n,e,t){var s,u,o,r=null!=a?a:l.nullContext||{},c=n.helperMissing,h="function",i=l.escapeExpression,d="\t<"+i((u=null!=(u=n["html-tag"]||(null!=a?a["html-tag"]:a))?u:c,typeof u===h?u.call(r,{name:"html-tag",hash:{},data:t}):u))+" ";return u=null!=(u=n.generateId||(null!=a?a.generateId:a))?u:c,o={name:"generateId",hash:{},fn:l.program(2,t,0),inverse:l.noop,data:t},s=typeof u===h?u.call(r,o):u,n.generateId||(s=n.blockHelperMissing.call(a,s,o)),null!=s&&(d+=s),d+' class="'+i((u=null!=(u=n.class||(null!=a?a.class:a))?u:c,typeof u===h?u.call(r,{name:"class",hash:{},data:t}):u))+'" style="'+i((u=null!=(u=n.style||(null!=a?a.style:a))?u:c,typeof u===h?u.call(r,{name:"style",hash:{},data:t}):u))+'">'+(null!=(u=null!=(u=n.code||(null!=a?a.code:a))?u:c,s=typeof u===h?u.call(r,{name:"code",hash:{},data:t}):u)?s:"")+"</"+i((u=null!=(u=n["html-tag"]||(null!=a?a["html-tag"]:a))?u:c,typeof u===h?u.call(r,{name:"html-tag",hash:{},data:t}):u))+">\n"},2:function(l,a,n,e,t){var s;return l.escapeExpression((s=null!=(s=n.id||(null!=a?a.id:a))?s:n.helperMissing,"function"==typeof s?s.call(null!=a?a:l.nullContext||{},{name:"id",hash:{},data:t}):s))},4:function(l,a,n,e,t){var s,u;return"\t"+(null!=(u=null!=(u=n.code||(null!=a?a.code:a))?u:n.helperMissing,s="function"==typeof u?u.call(null!=a?a:l.nullContext||{},{name:"code",hash:{},data:t}):u)?s:"")+"\n"},compiler:[7,">= 4.0.0"],main:function(l,a,n,e,t){var s;return null!=(s=n.if.call(null!=a?a:l.nullContext||{},null!=a?a["html-tag"]:a,{name:"if",hash:{},fn:l.program(1,t,0),inverse:l.program(4,t,0),data:t}))?s:""},useData:!0})}();