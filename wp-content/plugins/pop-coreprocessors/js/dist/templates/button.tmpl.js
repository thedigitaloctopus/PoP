!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{}).button=l({1:function(l,n,e,a,t,s,u){var r,i,o=null!=n?n:l.nullContext||{},p=l.lambda,c=l.escapeExpression,d=e.helperMissing;return"\t<a "+(null!=(r=e.if.call(o,null!=u[1]?u[1]["url-field"]:u[1],{name:"if",hash:{},fn:l.program(2,t,0,s,u),inverse:l.noop,data:t}))?r:"")+" "+(null!=(r=e.if.call(o,null!=u[1]?u[1].linktarget:u[1],{name:"if",hash:{},fn:l.program(4,t,0,s,u),inverse:l.noop,data:t}))?r:"")+' class="'+c(p(null!=(r=null!=u[1]?u[1].classes:u[1])?r.link:r,n))+" "+c(p(null!=(r=null!=u[1]?u[1].classes:u[1])?r.btn:r,n))+" "+c(p(null!=u[1]?u[1].class:u[1],n))+" target-"+c((i=null!=(i=e.id||(null!=n?n.id:n))?i:d,"function"==typeof i?i.call(o,{name:"id",hash:{},data:t}):i))+'" style="'+c(p(null!=(r=null!=u[1]?u[1].styles:u[1])?r.link:r,n))+c(p(null!=(r=null!=u[1]?u[1].styles:u[1])?r.btn:r,n))+c(p(null!=u[1]?u[1].style:u[1],n))+'" '+(null!=(r=(e.generateId||n&&n.generateId||d).call(o,{name:"generateId",hash:{context:u[1]},fn:l.program(6,t,0,s,u),inverse:l.noop,data:t}))?r:"")+' title="'+c(p(null!=u[1]?u[1].title:u[1],n))+'" '+(null!=(r=e.each.call(o,null!=u[1]?u[1].params:u[1],{name:"each",hash:{},fn:l.program(8,t,0,s,u),inverse:l.noop,data:t}))?r:"")+" "+(null!=(r=e.each.call(o,null!=u[1]?u[1]["previoustemplates-ids"]:u[1],{name:"each",hash:{},fn:l.program(10,t,0,s,u),inverse:l.noop,data:t}))?r:"")+">\n"+(null!=(r=(e.withModule||n&&n.withModule||d).call(o,u[1],"buttoninner",{name:"withModule",hash:{},fn:l.program(12,t,0,s,u),inverse:l.noop,data:t}))?r:"")+"\t</a>\n"},2:function(l,n,e,a,t,s,u){return'href="'+l.escapeExpression((e.get||n&&n.get||e.helperMissing).call(null!=n?n:l.nullContext||{},n,null!=u[1]?u[1]["url-field"]:u[1],{name:"get",hash:{},data:t}))+'"'},4:function(l,n,e,a,t,s,u){return'target="'+l.escapeExpression(l.lambda(null!=u[1]?u[1].linktarget:u[1],n))+'"'},6:function(l,n,e,a,t,s,u){var r,i=l.escapeExpression;return i(l.lambda(null!=u[1]?u[1].id:u[1],n))+"-"+i((r=null!=(r=e.id||(null!=n?n.id:n))?r:e.helperMissing,"function"==typeof r?r.call(null!=n?n:l.nullContext||{},{name:"id",hash:{},data:t}):r))},8:function(l,n,e,a,t){var s,u=l.escapeExpression;return" "+u((s=null!=(s=e.key||t&&t.key)?s:e.helperMissing,"function"==typeof s?s.call(null!=n?n:l.nullContext||{},{name:"key",hash:{},data:t}):s))+'="'+u(l.lambda(n,n))+'"'},10:function(l,n,e,a,t,s,u){var r,i=null!=n?n:l.nullContext||{},o=e.helperMissing,p=l.escapeExpression;return" "+p((r=null!=(r=e.key||t&&t.key)?r:o,"function"==typeof r?r.call(i,{name:"key",hash:{},data:t}):r))+'="#'+p((e.lastGeneratedId||n&&n.lastGeneratedId||o).call(i,{name:"lastGeneratedId",hash:{template:n,context:u[2]},data:t}))+'"'},12:function(l,n,e,a,t,s,u){return"\t\t\t"+l.escapeExpression((e.enterModule||n&&n.enterModule||e.helperMissing).call(null!=n?n:l.nullContext||{},u[2],{name:"enterModule",hash:{},data:t}))+"\n"},compiler:[7,">= 4.0.0"],main:function(l,n,e,a,t,s,u){var r;return null!=(r=e.with.call(null!=n?n:l.nullContext||{},null!=n?n.itemObject:n,{name:"with",hash:{},fn:l.program(1,t,0,s,u),inverse:l.noop,data:t}))?r:""},useData:!0,useDepths:!0})}();