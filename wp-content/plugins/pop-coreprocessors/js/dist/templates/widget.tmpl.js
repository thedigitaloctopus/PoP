!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{}).widget=l({1:function(l,a,e,n,t){var s;return l.escapeExpression((s=null!=(s=e.id||(null!=a?a.id:a))?s:e.helperMissing,"function"==typeof s?s.call(null!=a?a:{},{name:"id",hash:{},data:t}):s))},3:function(l,a,e,n,t,s,i){var u,r,o=null!=a?a:{},c=e.helperMissing,d="function",p=l.escapeExpression;return'\t\t<div class="'+p((r=null!=(r=e["title-wrapper"]||(null!=a?a["title-wrapper"]:a))?r:c,typeof r===d?r.call(o,{name:"title-wrapper",hash:{},data:t}):r))+' clearfix">\n'+(null!=(u=(e.withModule||a&&a.withModule||c).call(o,a,"quicklinkgroup",{name:"withModule",hash:{},fn:l.program(4,t,0,s,i),inverse:l.noop,data:t}))?u:"")+(null!=(u=e.if.call(o,null!=a?a.collapsible:a,{name:"if",hash:{},fn:l.program(6,t,0,s,i),inverse:l.noop,data:t}))?u:"")+"\t\t\t<"+p((r=null!=(r=e["title-htmltag"]||(null!=a?a["title-htmltag"]:a))?r:c,typeof r===d?r.call(o,{name:"title-htmltag",hash:{},data:t}):r))+' class="sidebar-title '+p((r=null!=(r=e["title-class"]||(null!=a?a["title-class"]:a))?r:c,typeof r===d?r.call(o,{name:"title-class",hash:{},data:t}):r))+'">\n\t\t\t\t'+(null!=(u=e.if.call(o,null!=a?a.fontawesome:a,{name:"if",hash:{},fn:l.program(8,t,0,s,i),inverse:l.noop,data:t}))?u:"")+(null!=(r=null!=(r=e["menu-title"]||(null!=a?a["menu-title"]:a))?r:c,u=typeof r===d?r.call(o,{name:"menu-title",hash:{},data:t}):r)?u:"")+"\n\t\t\t</"+p((r=null!=(r=e["title-htmltag"]||(null!=a?a["title-htmltag"]:a))?r:c,typeof r===d?r.call(o,{name:"title-htmltag",hash:{},data:t}):r))+">\n\t\t</div>\n"},4:function(l,a,e,n,t,s,i){var u,r=l.escapeExpression;return'\t\t\t\t<div class="quicklinkgroup '+r(l.lambda(null!=(u=null!=i[1]?i[1].classes:i[1])?u.quicklinkgroup:u,a))+'">\n\t\t\t\t\t'+r((e.enterModule||a&&a.enterModule||e.helperMissing).call(null!=a?a:{},i[1],{name:"enterModule",hash:{},data:t}))+"\n\t\t\t\t</div>\n"},6:function(l,a,e,n,t){var s,i,u=l.escapeExpression,r=l.lambda;return'\t\t\t\t<a href="#'+u((i=null!=(i=e.lastGeneratedId||(null!=a?a.lastGeneratedId:a))?i:e.helperMissing,"function"==typeof i?i.call(null!=a?a:{},{name:"lastGeneratedId",hash:{},data:t}):i))+'-body" data-toggle="collapse" class="'+u(r(null!=(s=null!=a?a.classes:a)?s["collapse-link"]:s,a))+'">'+(null!=(s=r(null!=(s=null!=a?a.titles:a)?s["collapse-link"]:s,a))?s:"")+"</a>\n"},8:function(l,a,e,n,t){var s;return'<i class="fa fa-fw '+l.escapeExpression((s=null!=(s=e.fontawesome||(null!=a?a.fontawesome:a))?s:e.helperMissing,"function"==typeof s?s.call(null!=a?a:{},{name:"fontawesome",hash:{},data:t}):s))+'"></i>'},10:function(l,a,e,n,t){var s;return"collapse "+l.escapeExpression((s=null!=(s=e.class||(null!=a?a.class:a))?s:e.helperMissing,"function"==typeof s?s.call(null!=a?a:{},{name:"class",hash:{},data:t}):s))},12:function(l,a,e,n,t,s,i){var u;return null!=(u=(e.withModule||a&&a.withModule||e.helperMissing).call(null!=a?a:{},i[1],a,{name:"withModule",hash:{},fn:l.program(13,t,0,s,i),inverse:l.noop,data:t}))?u:""},13:function(l,a,e,n,t,s,i){return"\t\t\t\t"+l.escapeExpression((e.enterModule||a&&a.enterModule||e.helperMissing).call(null!=a?a:{},i[2],{name:"enterModule",hash:{},data:t}))+"\n"},compiler:[7,">= 4.0.0"],main:function(l,a,e,n,t,s,i){var u,r,o,c=null!=a?a:{},d=e.helperMissing,p="function",h=l.escapeExpression,f='<div class="sidebar-widget '+h((r=null!=(r=e["widget-class"]||(null!=a?a["widget-class"]:a))?r:d,typeof r===p?r.call(c,{name:"widget-class",hash:{},data:t}):r))+" "+h((r=null!=(r=e.class||(null!=a?a.class:a))?r:d,typeof r===p?r.call(c,{name:"class",hash:{},data:t}):r))+'" ';return r=null!=(r=e.generateId||(null!=a?a.generateId:a))?r:d,o={name:"generateId",hash:{},fn:l.program(1,t,0,s,i),inverse:l.noop,data:t},u=typeof r===p?r.call(c,o):r,e.generateId||(u=e.blockHelperMissing.call(a,u,o)),null!=u&&(f+=u),f+">\n"+(null!=(u=e.if.call(c,null!=a?a["show-header"]:a,{name:"if",hash:{},fn:l.program(3,t,0,s,i),inverse:l.noop,data:t}))?u:"")+'\t<div class="'+h((r=null!=(r=e["body-class"]||(null!=a?a["body-class"]:a))?r:d,typeof r===p?r.call(c,{name:"body-class",hash:{},data:t}):r))+" "+(null!=(u=e.with.call(c,null!=a?a.collapsible:a,{name:"with",hash:{},fn:l.program(10,t,0,s,i),inverse:l.noop,data:t}))?u:"")+'" id="'+h((r=null!=(r=e.lastGeneratedId||(null!=a?a.lastGeneratedId:a))?r:d,typeof r===p?r.call(c,{name:"lastGeneratedId",hash:{},data:t}):r))+'-body">\n'+(null!=(u=e.each.call(c,null!=(u=null!=a?a["template-ids"]:a)?u.layouts:u,{name:"each",hash:{},fn:l.program(12,t,0,s,i),inverse:l.noop,data:t}))?u:"")+"\t</div>\n</div>"},useData:!0,useDepths:!0})}();