!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["layout-menu-multitargetindent"]=l({1:function(l,n,a,e,t){var s;return l.escapeExpression((s=null!=(s=a.id||(null!=n?n.id:n))?s:a.helperMissing,"function"==typeof s?s.call(null!=n?n:l.nullContext||{},{name:"id",hash:{},data:t}):s))},3:function(l,n,a,e,t,s,u){var i,r,o=null!=n?n:l.nullContext||{},c=a.helperMissing,p=l.escapeExpression;return'\t\t<li id="menu-item-'+p((a.lastGeneratedId||n&&n.lastGeneratedId||c).call(o,{name:"lastGeneratedId",hash:{context:u[1]},data:t}))+"-"+p((r=null!=(r=a.id||(null!=n?n.id:n))?r:c,"function"==typeof r?r.call(o,{name:"id",hash:{},data:t}):r))+"\" class='"+p((r=null!=(r=a.classes||(null!=n?n.classes:n))?r:c,"function"==typeof r?r.call(o,{name:"classes",hash:{},data:t}):r))+"'>\n"+(null!=(i=(a.compare||n&&n.compare||c).call(o,null!=n?n.title:n,"divider",{name:"compare",hash:{},fn:l.program(4,t,0,s,u),inverse:l.program(6,t,0,s,u),data:t}))?i:"")+"\t\t</li>\n"},4:function(l,n,a,e,t){return"\t\t\t\t<hr />\n"},6:function(l,n,a,e,t,s,u){var i,r,o=null!=n?n:l.nullContext||{},c=a.helperMissing,p=l.escapeExpression;return(null!=(i=a.each.call(o,null!=u[1]?u[1].targets:u[1],{name:"each",hash:{},fn:l.program(7,t,0,s,u),inverse:l.noop,data:t}))?i:"")+'\t\t\t\t<a href="'+p((r=null!=(r=a.url||(null!=n?n.url:n))?r:c,"function"==typeof r?r.call(o,{name:"url",hash:{},data:t}):r))+'" title="'+p((r=null!=(r=a.alt||(null!=n?n.alt:n))?r:c,"function"==typeof r?r.call(o,{name:"alt",hash:{},data:t}):r))+'" '+(null!=(r=null!=(r=a["additional-attrs"]||(null!=n?n["additional-attrs"]:n))?r:c,i="function"==typeof r?r.call(o,{name:"additional-attrs",hash:{},data:t}):r)?i:"")+">"+(null!=(r=null!=(r=a.title||(null!=n?n.title:n))?r:c,i="function"==typeof r?r.call(o,{name:"title",hash:{},data:t}):r)?i:"")+"</a>\n"},7:function(l,n,a,e,t,s,u){var i,r,o=l.lambda,c=l.escapeExpression,p=null!=n?n:l.nullContext||{},d=a.helperMissing;return'\t\t\t\t\t<a href="'+c(o(null!=u[1]?u[1].url:u[1],n))+'" class="pop-multitarget-link pop-multitarget-link-'+c((r=null!=(r=a.index||t&&t.index)?r:d,"function"==typeof r?r.call(p,{name:"index",hash:{},data:t}):r))+" "+c(o(null!=(i=null!=u[2]?u[2].classes:u[2])?i.multitarget:i,n))+'" style="'+c(o(null!=(i=null!=u[2]?u[2].styles:u[2])?i.multitarget:i,n))+'" '+(null!=(i=a.if.call(p,null!=(i=null!=u[2]?u[2].titles:u[2])?i.tooltip:i,{name:"if",hash:{},fn:l.program(8,t,0,s,u),inverse:l.noop,data:t}))?i:"")+' target="'+c((r=null!=(r=a.key||t&&t.key)?r:d,"function"==typeof r?r.call(p,{name:"key",hash:{},data:t}):r))+'">'+(null!=(i=o(n,n))?i:"")+"</a>\n"},8:function(l,n,a,e,t,s,u){var i;return' title="'+l.escapeExpression(l.lambda(null!=(i=null!=u[2]?u[2].titles:u[2])?i.tooltip:i,n))+'" '+(null!=(i=(a.generateId||n&&n.generateId||a.helperMissing).call(null!=n?n:l.nullContext||{},{name:"generateId",hash:{group:"tooltip",context:u[2]},fn:l.program(9,t,0,s,u),inverse:l.noop,data:t}))?i:"")+" "},9:function(l,n,a,e,t,s,u){var i=l.lambda,r=l.escapeExpression;return r(i(null!=u[3]?u[3].id:u[3],n))+"-"+r(i(null!=u[2]?u[2].id:u[2],n))},compiler:[7,">= 4.0.0"],main:function(l,n,a,e,t,s,u){var i,r,o,c=null!=n?n:l.nullContext||{},p=a.helperMissing,d=l.escapeExpression,h='<ul class="nav '+d((r=null!=(r=a.class||(null!=n?n.class:n))?r:p,"function"==typeof r?r.call(c,{name:"class",hash:{},data:t}):r))+'" style="'+d((r=null!=(r=a.style||(null!=n?n.style:n))?r:p,"function"==typeof r?r.call(c,{name:"style",hash:{},data:t}):r))+'" role="menu" ';return r=null!=(r=a.generateId||(null!=n?n.generateId:n))?r:p,o={name:"generateId",hash:{},fn:l.program(1,t,0,s,u),inverse:l.noop,data:t},i="function"==typeof r?r.call(c,o):r,a.generateId||(i=a.blockHelperMissing.call(n,i,o)),null!=i&&(h+=i),h+">\n"+(null!=(i=a.each.call(c,null!=(i=null!=n?n.dbObject:n)?i.items:i,{name:"each",hash:{},fn:l.program(3,t,0,s,u),inverse:l.noop,data:t}))?i:"")+"</ul>"},useData:!0,useDepths:!0})}();