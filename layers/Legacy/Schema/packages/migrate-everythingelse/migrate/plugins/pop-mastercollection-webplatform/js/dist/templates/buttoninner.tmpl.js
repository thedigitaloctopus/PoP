!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{}).buttoninner=l({1:function(l,n,e,t,a){var s;return'<i class="fa '+l.escapeExpression((s=null!=(s=e.fontawesome||(null!=n?n.fontawesome:n))?s:e.helperMissing,"function"==typeof s?s.call(null!=n?n:l.nullContext||{},{name:"fontawesome",hash:{},data:a}):s))+'"></i>'},3:function(l,n,e,t,a){var s,u,i=null!=n?n:l.nullContext||{},o=e.helperMissing,f=l.escapeExpression,c=l.lambda;return" "+(null!=(u=null!=(u=e["textfield-open"]||(null!=n?n["textfield-open"]:n))?u:o,s="function"==typeof u?u.call(i,{name:"textfield-open",hash:{},data:a}):u)?s:"")+'<span class="'+f((u=null!=(u=e.dbKey||(null!=n?n.dbKey:n))?u:o,"function"==typeof u?u.call(i,{name:"dbKey",hash:{},data:a}):u))+"-"+f((u=null!=(u=e["text-field"]||(null!=n?n["text-field"]:n))?u:o,"function"==typeof u?u.call(i,{name:"text-field",hash:{},data:a}):u))+"-"+f(c(null!=(s=null!=n?n.dbObject:n)?s.id:s,n))+" "+f(c(null!=(s=null!=n?n.classes:n)?s["text-field"]:s,n))+'" style="'+f(c(null!=(s=null!=n?n.styles:n)?s["text-field"]:s,n))+'">'+(null!=(s=(e.get||n&&n.get||o).call(i,null!=n?n.dbObject:n,null!=n?n["text-field"]:n,{name:"get",hash:{},data:a}))?s:"")+"</span>"+(null!=(u=null!=(u=e["textfield-close"]||(null!=n?n["textfield-close"]:n))?u:o,s="function"==typeof u?u.call(i,{name:"textfield-close",hash:{},data:a}):u)?s:"")},compiler:[7,">= 4.0.0"],main:function(l,n,e,t,a){var s,u,i=null!=n?n:l.nullContext||{},o=e.helperMissing,f=l.escapeExpression,c=l.lambda;return"<"+f((u=null!=(u=e.tag||(null!=n?n.tag:n))?u:o,"function"==typeof u?u.call(i,{name:"tag",hash:{},data:a}):u))+' class="btn-inner '+f((u=null!=(u=e.class||(null!=n?n.class:n))?u:o,"function"==typeof u?u.call(i,{name:"class",hash:{},data:a}):u))+'" style="'+f((u=null!=(u=e.style||(null!=n?n.style:n))?u:o,"function"==typeof u?u.call(i,{name:"style",hash:{},data:a}):u))+'">\n\t'+(null!=(s=e.if.call(i,null!=n?n.fontawesome:n,{name:"if",hash:{},fn:l.program(1,a,0),inverse:l.noop,data:a}))?s:"")+'<span class="pop-btn-title '+f(c(null!=(s=null!=n?n.classes:n)?s["btn-title"]:s,n))+'" style="'+f(c(null!=(s=null!=n?n.styles:n)?s["btn-title"]:s,n))+'">'+(null!=(s=c(null!=(s=null!=n?n.titles:n)?s.btn:s,n))?s:"")+(null!=(s=e.if.call(i,null!=n?n["text-field"]:n,{name:"if",hash:{},fn:l.program(3,a,0),inverse:l.noop,data:a}))?s:"")+"</span>\n</"+f((u=null!=(u=e.tag||(null!=n?n.tag:n))?u:o,"function"==typeof u?u.call(i,{name:"tag",hash:{},data:a}):u))+">"},useData:!0})}();