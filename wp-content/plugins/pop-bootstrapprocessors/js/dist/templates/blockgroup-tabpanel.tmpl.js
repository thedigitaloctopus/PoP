!function(){var t=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["blockgroup-tabpanel"]=t({1:function(t,a,e,n,l){var r;return t.escapeExpression((r=null!=(r=e.id||(null!=a?a.id:a))?r:e.helperMissing,"function"==typeof r?r.call(null!=a?a:{},{name:"id",hash:{},data:l}):r))},3:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{},p=e.helperMissing,d=t.escapeExpression;return'\t\t<ul id="'+d((e.lastGeneratedId||a&&a.lastGeneratedId||p).call(u,{name:"lastGeneratedId",hash:{group:null!=a?a["bootstrap-type"]:a},data:l}))+'-panel-title" class="nav nav-tabs '+d((i=null!=(i=e["panelheader-class"]||(null!=a?a["panelheader-class"]:a))?i:p,"function"==typeof i?i.call(u,{name:"panelheader-class",hash:{},data:l}):i))+'" role="tablist" '+(null!=(o=e.each.call(u,null!=a?a["panelheader-params"]:a,{name:"each",hash:{},fn:t.program(4,l,0,r,s),inverse:t.noop,data:l}))?o:"")+">\n"+(null!=(o=e.each.call(u,null!=a?a["panel-headers"]:a,{name:"each",hash:{},fn:t.program(6,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"\t\t</ul>\n"},4:function(t,a,e,n,l){var r,s=t.escapeExpression;return" "+s((r=null!=(r=e.key||l&&l.key)?r:e.helperMissing,"function"==typeof r?r.call(null!=a?a:{},{name:"key",hash:{},data:l}):r))+'="'+s(t.lambda(a,a))+'"'},6:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{},p=e.helperMissing;return'\t\t\t\t<li role="presentation" class="'+t.escapeExpression(t.lambda(null!=(o=null!=s[1]?s[1].classes:s[1])?o["panelheader-item"]:o,a))+" "+(null!=(o=(e.compare||a&&a.compare||p).call(u,null!=s[1]?s[1].active:s[1],null!=a?a["settings-id"]:a,{name:"compare",hash:{},fn:t.program(7,l,0,r,s),inverse:t.program(9,l,0,r,s),data:l}))?o:"")+" "+(null!=(o=e.if.call(u,null!=a?a.subheaders:a,{name:"if",hash:{},fn:t.program(12,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'" '+(null!=(o=e.if.call(u,null!=a?a.tooltip:a,{name:"if",hash:{},fn:t.program(14,l,0,r,s),inverse:t.noop,data:l}))?o:"")+">\n"+(null!=(o=e.if.call(u,null!=s[1]?s[1].intercept:s[1],{name:"if",hash:{},fn:t.program(17,l,0,r,s),inverse:t.program(21,l,0,r,s),data:l}))?o:"")+"\t\t\t\t\t\t"+(null!=(o=e.if.call(u,null!=a?a.fontawesome:a,{name:"if",hash:{},fn:t.program(23,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'<span class="tab-title">'+(null!=(i=null!=(i=e.title||(null!=a?a.title:a))?i:p,o="function"==typeof i?i.call(u,{name:"title",hash:{},data:l}):i)?o:"")+"</span>"+(null!=(o=e.if.call(u,null!=a?a.subheaders:a,{name:"if",hash:{},fn:t.program(25,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"\n\t\t\t\t\t</a>\n"+(null!=(o=e.if.call(u,null!=a?a.subheaders:a,{name:"if",hash:{},fn:t.program(27,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"\t\t\t\t</li>\n"},7:function(t,a,e,n,l){return"active"},9:function(t,a,e,n,l,r,s){var o;return null!=(o=e.each.call(null!=a?a:{},null!=a?a.subheaders:a,{name:"each",hash:{},fn:t.program(10,l,0,r,s),inverse:t.noop,data:l}))?o:""},10:function(t,a,e,n,l,r,s){var o;return null!=(o=(e.compare||a&&a.compare||e.helperMissing).call(null!=a?a:{},null!=s[2]?s[2].active:s[2],null!=a?a["settings-id"]:a,{name:"compare",hash:{},fn:t.program(7,l,0,r,s),inverse:t.noop,data:l}))?o:""},12:function(t,a,e,n,l){return"dropdown"},14:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{},p=e.helperMissing;return" "+(null!=(o=(e.generateId||a&&a.generateId||p).call(u,{name:"generateId",hash:{group:"tooltip",context:s[1]},fn:t.program(15,l,0,r,s),inverse:t.noop,data:l}))?o:"")+' title="'+t.escapeExpression((i=null!=(i=e.tooltip||(null!=a?a.tooltip:a))?i:p,"function"==typeof i?i.call(u,{name:"tooltip",hash:{},data:l}):i))+'"'},15:function(t,a,e,n,l,r,s){var o,i=t.escapeExpression;return i(t.lambda(null!=s[1]?s[1].id:s[1],a))+"-"+i((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:e.helperMissing,"function"==typeof o?o.call(null!=a?a:{},{name:"settings-id",hash:{},data:l}):o))},17:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{};return"\t\t\t\t\t\t<a "+(null!=(o=(e.generateId||a&&a.generateId||e.helperMissing).call(i,{name:"generateId",hash:{group:"tablink",context:s[1]},fn:t.program(15,l,0,r,s),inverse:t.noop,data:l}))?o:"")+' href="'+(null!=(o=e.with.call(i,null!=(o=null!=(o=null!=s[1]?s[1].bs:s[1])?o.feedback:o)?o["intercept-urls"]:o,{name:"with",hash:{},fn:t.program(18,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'">\n'},18:function(t,a,e,n,l,r,s){var o;return null!=(o=(e.withSublevel||a&&a.withSublevel||e.helperMissing).call(null!=a?a:{},null!=(o=null!=s[2]?s[2].bs:s[2])?o.bsId:o,{name:"withSublevel",hash:{},fn:t.program(19,l,0,r,s),inverse:t.noop,data:l}))?o:""},19:function(t,a,e,n,l,r,s){return t.escapeExpression((e.get||a&&a.get||e.helperMissing).call(null!=a?a:{},a,null!=s[2]?s[2]["settings-id"]:s[2],{name:"get",hash:{},data:l}))},21:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{},u=e.helperMissing,p=t.escapeExpression;return'\t\t\t\t\t\t<a href="#'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[1]?s[1]["bootstrap-type"]:s[1],context:s[1]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" aria-controls="'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[1]?s[1]["bootstrap-type"]:s[1],context:s[1]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" role="tab" data-toggle="tab">\n'},23:function(t,a,e,n,l){var r;return'<i class="fa fa-fw '+t.escapeExpression((r=null!=(r=e.fontawesome||(null!=a?a.fontawesome:a))?r:e.helperMissing,"function"==typeof r?r.call(null!=a?a:{},{name:"fontawesome",hash:{},data:l}):r))+'"></i>'},25:function(t,a,e,n,l){return' <span class="caret"></span>'},27:function(t,a,e,n,l,r,s){var o;return'\t\t\t\t\t\t<ul class="dropdown-menu pull-right" role="menu">\n'+(null!=(o=e.each.call(null!=a?a:{},null!=a?a.subheaders:a,{name:"each",hash:{},fn:t.program(28,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"\t\t\t\t\t\t</ul>\n"},28:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{},p=e.helperMissing;return'\t\t\t\t\t\t\t\t<li role="presentation" class="'+(null!=(o=(e.compare||a&&a.compare||p).call(u,null!=s[2]?s[2].active:s[2],null!=a?a["settings-id"]:a,{name:"compare",hash:{},fn:t.program(7,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'">\n'+(null!=(o=e.if.call(u,null!=s[2]?s[2].intercept:s[2],{name:"if",hash:{},fn:t.program(29,l,0,r,s),inverse:t.program(32,l,0,r,s),data:l}))?o:"")+"\t\t\t\t\t\t\t\t\t\t"+(null!=(o=e.if.call(u,null!=a?a.fontawesome:a,{name:"if",hash:{},fn:t.program(23,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'<span class="tab-subtitle">'+(null!=(i=null!=(i=e.title||(null!=a?a.title:a))?i:p,o="function"==typeof i?i.call(u,{name:"title",hash:{},data:l}):i)?o:"")+"</span>\n\t\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t\t</li>\n"},29:function(t,a,e,n,l,r,s){var o;return'\t\t\t\t\t\t\t\t\t\t<a href="'+(null!=(o=e.with.call(null!=a?a:{},null!=(o=null!=(o=null!=s[2]?s[2].bs:s[2])?o.feedback:o)?o["intercept-urls"]:o,{name:"with",hash:{},fn:t.program(30,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'">\n'},30:function(t,a,e,n,l,r,s){var o;return null!=(o=(e.withSublevel||a&&a.withSublevel||e.helperMissing).call(null!=a?a:{},null!=(o=null!=s[3]?s[3].bs:s[3])?o.bsId:o,{name:"withSublevel",hash:{},fn:t.program(19,l,0,r,s),inverse:t.noop,data:l}))?o:""},32:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{},u=e.helperMissing,p=t.escapeExpression;return'\t\t\t\t\t\t\t\t\t\t<a href="#'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[2]?s[2]["bootstrap-type"]:s[2],context:s[2]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" aria-controls="'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[2]?s[2]["bootstrap-type"]:s[2],context:s[2]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" role="tab" data-toggle="tab">\n'},34:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{},p=e.helperMissing,d=t.escapeExpression;return'\t\t<div id="'+d((e.lastGeneratedId||a&&a.lastGeneratedId||p).call(u,{name:"lastGeneratedId",hash:{group:null!=a?a["bootstrap-type"]:a},data:l}))+'-panel-title" class="'+d((i=null!=(i=e["panelheader-class"]||(null!=a?a["panelheader-class"]:a))?i:p,"function"==typeof i?i.call(u,{name:"panelheader-class",hash:{},data:l}):i))+'" role="group" '+(null!=(o=e.each.call(u,null!=a?a["panelheader-params"]:a,{name:"each",hash:{},fn:t.program(4,l,0,r,s),inverse:t.noop,data:l}))?o:"")+">\n"+(null!=(o=e.each.call(u,null!=a?a["panel-headers"]:a,{name:"each",hash:{},fn:t.program(35,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"\t\t</div>\n"},35:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{},p=e.helperMissing;return'\t\t\t\t<a class="'+(null!=(o=(e.compare||a&&a.compare||p).call(u,null!=s[1]?s[1].active:s[1],null!=a?a["settings-id"]:a,{name:"compare",hash:{},fn:t.program(7,l,0,r,s),inverse:t.program(9,l,0,r,s),data:l}))?o:"")+" "+t.escapeExpression(t.lambda(null!=(o=null!=s[1]?s[1].classes:s[1])?o["panelheader-item"]:o,a))+'" '+(null!=(o=e.if.call(u,null!=s[1]?s[1].intercept:s[1],{name:"if",hash:{},fn:t.program(36,l,0,r,s),inverse:t.program(38,l,0,r,s),data:l}))?o:"")+">\n\t\t\t\t\t"+(null!=(o=e.if.call(u,null!=a?a.fontawesome:a,{name:"if",hash:{},fn:t.program(23,l,0,r,s),inverse:t.noop,data:l}))?o:"")+(null!=(i=null!=(i=e.title||(null!=a?a.title:a))?i:p,o="function"==typeof i?i.call(u,{name:"title",hash:{},data:l}):i)?o:"")+"\n\t\t\t\t</a>\n"+(null!=(o=e.if.call(u,null!=a?a.subheaders:a,{name:"if",hash:{},fn:t.program(40,l,0,r,s),inverse:t.noop,data:l}))?o:"")},36:function(t,a,e,n,l,r,s){var o;return' href="'+(null!=(o=e.with.call(null!=a?a:{},null!=(o=null!=(o=null!=s[1]?s[1].bs:s[1])?o.feedback:o)?o["intercept-urls"]:o,{name:"with",hash:{},fn:t.program(18,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'" '},38:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{},u=e.helperMissing,p=t.escapeExpression;return' href="#'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[1]?s[1]["bootstrap-type"]:s[1],context:s[1]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" aria-controls="'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[1]?s[1]["bootstrap-type"]:s[1],context:s[1]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" role="tab" data-toggle="tab"'},40:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{};return'\t\t\t\t\t<span class="btn-group-dropdown dropdown">\n\t\t\t\t\t\t<button type="button" class="'+(null!=(o=(e.compare||a&&a.compare||e.helperMissing).call(i,null!=s[1]?s[1].active:s[1],null!=a?a["settings-id"]:a,{name:"compare",hash:{},fn:t.program(7,l,0,r,s),inverse:t.program(9,l,0,r,s),data:l}))?o:"")+" "+t.escapeExpression(t.lambda(null!=(o=null!=a?a.classes:a)?o["panelheader-item"]:o,a))+' dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>\n\t\t\t\t\t\t<ul class="dropdown-menu pull-right" role="menu">\n'+(null!=(o=e.each.call(i,null!=a?a.subheaders:a,{name:"each",hash:{},fn:t.program(41,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"\t\t\t\t\t\t</ul>\n\t\t\t\t\t</span>\n"},41:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{},p=e.helperMissing;return'\t\t\t\t\t\t\t\t<li role="presentation" class="'+(null!=(o=(e.compare||a&&a.compare||p).call(u,null!=s[2]?s[2].active:s[2],null!=a?a["settings-id"]:a,{name:"compare",hash:{},fn:t.program(7,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'">\n\t\t\t\t\t\t\t\t\t<a '+(null!=(o=e.if.call(u,null!=s[2]?s[2].intercept:s[2],{name:"if",hash:{},fn:t.program(42,l,0,r,s),inverse:t.program(44,l,0,r,s),data:l}))?o:"")+"</a>\n\t\t\t\t\t\t\t\t\t\t"+(null!=(o=e.if.call(u,null!=a?a.fontawesome:a,{name:"if",hash:{},fn:t.program(23,l,0,r,s),inverse:t.noop,data:l}))?o:"")+(null!=(i=null!=(i=e.title||(null!=a?a.title:a))?i:p,o="function"==typeof i?i.call(u,{name:"title",hash:{},data:l}):i)?o:"")+"\n\t\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t\t</li>\n"},42:function(t,a,e,n,l,r,s){var o;return'\n\t\t\t\t\t\t\t\t\t\thref="'+(null!=(o=e.with.call(null!=a?a:{},null!=(o=null!=(o=null!=s[2]?s[2].bs:s[2])?o.feedback:o)?o["intercept-urls"]:o,{name:"with",hash:{},fn:t.program(30,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'" '},44:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{},u=e.helperMissing,p=t.escapeExpression;return' href="#'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[2]?s[2]["bootstrap-type"]:s[2],context:s[2]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" aria-controls="'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[2]?s[2]["bootstrap-type"]:s[2],context:s[2]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" role="tab" data-toggle="tab" '},46:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{},p=e.helperMissing,d=t.escapeExpression;return'\t\t<div id="'+d((e.lastGeneratedId||a&&a.lastGeneratedId||p).call(u,{name:"lastGeneratedId",hash:{group:null!=a?a["bootstrap-type"]:a},data:l}))+'-panel-title" class="clearfix '+d((i=null!=(i=e["panelheader-class"]||(null!=a?a["panelheader-class"]:a))?i:p,"function"==typeof i?i.call(u,{name:"panelheader-class",hash:{},data:l}):i))+'" '+(null!=(o=e.each.call(u,null!=a?a["panelheader-params"]:a,{name:"each",hash:{},fn:t.program(4,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'>\n\t\t\t<div class="dropdown pull-right">\n\t\t\t\t<a href="#" class="dropdown-toggle close close-sm" data-toggle="dropdown" role="button">'+(null!=(o=t.lambda(null!=(o=null!=a?a.titles:a)?o.dropdown:o,a))?o:"")+'</a>\n\t\t\t\t<ul class="dropdown-menu" role="menu">\n'+(null!=(o=e.each.call(u,null!=a?a["panel-headers"]:a,{name:"each",hash:{},fn:t.program(47,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n"},47:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{};return'\t\t\t\t\t\t<li role="presentation">\n'+(null!=(o=e.if.call(u,null!=s[1]?s[1].intercept:s[1],{name:"if",hash:{},fn:t.program(48,l,0,r,s),inverse:t.program(50,l,0,r,s),data:l}))?o:"")+"\t\t\t\t\t\t\t\t"+(null!=(o=e.if.call(u,null!=a?a.fontawesome:a,{name:"if",hash:{},fn:t.program(23,l,0,r,s),inverse:t.noop,data:l}))?o:"")+(null!=(i=null!=(i=e.title||(null!=a?a.title:a))?i:e.helperMissing,o="function"==typeof i?i.call(u,{name:"title",hash:{},data:l}):i)?o:"")+"\n\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t</li>\n"+(null!=(o=e.each.call(u,null!=a?a.subheaders:a,{name:"each",hash:{},fn:t.program(52,l,0,r,s),inverse:t.noop,data:l}))?o:"")},48:function(t,a,e,n,l,r,s){var o;return'\t\t\t\t\t\t\t\t<a href="'+(null!=(o=e.with.call(null!=a?a:{},null!=(o=null!=(o=null!=s[1]?s[1].bs:s[1])?o.feedback:o)?o["intercept-urls"]:o,{name:"with",hash:{},fn:t.program(18,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'">\n'},50:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{},u=e.helperMissing,p=t.escapeExpression;return'\t\t\t\t\t\t\t\t<a href="#'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[1]?s[1]["bootstrap-type"]:s[1],context:s[1]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" aria-controls="'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[1]?s[1]["bootstrap-type"]:s[1],context:s[1]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" role="tab" data-toggle="tab">\n'},52:function(t,a,e,n,l,r,s){var o,i,u=null!=a?a:{};return'\t\t\t\t\t\t\t<li role="presentation" class="menu-item-parent">\n'+(null!=(o=e.if.call(u,null!=s[2]?s[2].intercept:s[2],{name:"if",hash:{},fn:t.program(53,l,0,r,s),inverse:t.program(55,l,0,r,s),data:l}))?o:"")+"\t\t\t\t\t\t\t\t\t"+(null!=(o=e.if.call(u,null!=a?a.fontawesome:a,{name:"if",hash:{},fn:t.program(23,l,0,r,s),inverse:t.noop,data:l}))?o:"")+(null!=(i=null!=(i=e.title||(null!=a?a.title:a))?i:e.helperMissing,o="function"==typeof i?i.call(u,{name:"title",hash:{},data:l}):i)?o:"")+"\n\t\t\t\t\t\t\t\t</a>\n\t\t\t\t\t\t\t</li>\n"},53:function(t,a,e,n,l,r,s){var o;return'\t\t\t\t\t\t\t\t\t<a href="'+(null!=(o=e.with.call(null!=a?a:{},null!=(o=null!=(o=null!=s[2]?s[2].bs:s[2])?o.feedback:o)?o["intercept-urls"]:o,{name:"with",hash:{},fn:t.program(30,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'">\n'},55:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{},u=e.helperMissing,p=t.escapeExpression;return'\t\t\t\t\t\t\t\t\t<a href="#'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[2]?s[2]["bootstrap-type"]:s[2],context:s[2]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" aria-controls="'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[2]?s[2]["bootstrap-type"]:s[2],context:s[2]},data:l}))+"-"+p((o=null!=(o=e["settings-id"]||(null!=a?a["settings-id"]:a))?o:u,"function"==typeof o?o.call(i,{name:"settings-id",hash:{},data:l}):o))+'" role="tab" data-toggle="tab">\n'},57:function(t,a,e,n,l,r,s){var o;return'\t\t<div class="tab-content">\n'+(null!=(o=e.each.call(null!=a?a:{},null!=(o=null!=a?a["settings-ids"]:a)?o.blockunits:o,{name:"each",hash:{},fn:t.program(58,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"\t\t</div>\n"},58:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{},u=e.helperMissing,p=t.escapeExpression,d=t.lambda;return'\t\t\t\t<div id="'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[1]?s[1]["bootstrap-type"]:s[1],context:s[1]},data:l}))+"-"+p(d(a,a))+'" role="tabpanel" class="tab-pane '+p(d(null!=(o=null!=s[1]?s[1].classes:s[1])?o["bootstrap-component"]:o,a))+" "+(null!=(o=(e.compare||a&&a.compare||u).call(i,null!=s[1]?s[1].active:s[1],a,{name:"compare",hash:{},fn:t.program(7,l,0,r,s),inverse:t.noop,data:l}))?o:"")+" "+p(d(null!=s[1]?s[1]["panel-class"]:s[1],a))+" "+p((e.get||a&&a.get||u).call(i,null!=s[1]?s[1]["custom-panel-class"]:s[1],a,{name:"get",hash:{},data:l}))+'" '+(null!=(o=e.each.call(i,null!=s[1]?s[1]["panel-params"]:s[1],{name:"each",hash:{},fn:t.program(4,l,0,r,s),inverse:t.noop,data:l}))?o:"")+" "+(null!=(o=(e.withget||a&&a.withget||u).call(i,null!=s[1]?s[1]["custom-panel-params"]:s[1],a,{name:"withget",hash:{},fn:t.program(59,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'>\n\t\t\t\t\t<div id="'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[1]?s[1]["bootstrap-type"]:s[1],context:s[1]},data:l}))+"-"+p(d(a,a))+'-container" class="body '+p((e.get||a&&a.get||u).call(i,null!=s[1]?s[1]["body-class"]:s[1],a,{name:"get",hash:{},data:l}))+" "+p(d(null!=(o=null!=s[1]?s[1].classes:s[1])?o.container:o,a))+'">\n'+(null!=(o=(e.withBlock||a&&a.withBlock||u).call(i,null!=s[1]?s[1]["root-context"]:s[1],a,{name:"withBlock",hash:{},fn:t.program(61,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"\t\t\t\t\t</div>\n\t\t\t\t</div>\n"},59:function(t,a,e,n,l){var r;return null!=(r=e.each.call(null!=a?a:{},a,{name:"each",hash:{},fn:t.program(4,l,0),inverse:t.noop,data:l}))?r:""},61:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{},u=e.helperMissing,p=t.escapeExpression;return"\t\t\t\t\t\t\t"+p((e.enterModule||a&&a.enterModule||u).call(i,a,{name:"enterModule",hash:{parentContext:s[2]},data:l}))+"\n\t\t\t\t\t\t\t<a "+p((e.interceptAttr||a&&a.interceptAttr||u).call(i,{name:"interceptAttr",hash:{context:s[2]},data:l}))+" "+(null!=(o=(e.generateId||a&&a.generateId||u).call(i,{name:"generateId",hash:{group:"interceptor",context:s[2]},fn:t.program(62,l,0,r,s),inverse:t.noop,data:l}))?o:"")+' href="#'+p((e.lastGeneratedId||a&&a.lastGeneratedId||u).call(i,{name:"lastGeneratedId",hash:{group:null!=s[2]?s[2]["bootstrap-type"]:s[2],context:s[2]},data:l}))+"-"+p(t.lambda(s[1],a))+'" data-toggle="tab" role="tab" data-intercept-url="'+(null!=(o=(e.withSublevel||a&&a.withSublevel||u).call(i,null!=s[2]?s[2].template:s[2],{name:"withSublevel",hash:{context:null!=(o=null!=(o=null!=s[2]?s[2].bs:s[2])?o.feedback:o)?o["intercept-urls"]:o},fn:t.program(64,l,0,r,s),inverse:t.noop,data:l}))?o:"")+'"></a>\n'},62:function(t,a,e,n,l,r,s){var o=t.lambda,i=t.escapeExpression;return i(o(null!=s[2]?s[2].id:s[2],a))+"-"+i(o(s[1],a))},64:function(t,a,e,n,l,r,s){return t.escapeExpression((e.get||a&&a.get||e.helperMissing).call(null!=a?a:{},a,null!=s[1]?s[1].template:s[1],{name:"get",hash:{},data:l}))},compiler:[7,">= 4.0.0"],main:function(t,a,e,n,l,r,s){var o,i=null!=a?a:{},u=e.helperMissing;return"<div "+(null!=(o=(e.generateId||a&&a.generateId||u).call(i,{name:"generateId",hash:{group:null!=a?a["bootstrap-type"]:a},fn:t.program(1,l,0,r,s),inverse:t.noop,data:l}))?o:"")+' role="tabpanel">\n'+(null!=(o=(e.compare||a&&a.compare||u).call(i,null!=a?a["panel-header-type"]:a,"tab",{name:"compare",hash:{},fn:t.program(3,l,0,r,s),inverse:t.noop,data:l}))?o:"")+(null!=(o=(e.compare||a&&a.compare||u).call(i,null!=a?a["panel-header-type"]:a,"btn-group",{name:"compare",hash:{},fn:t.program(34,l,0,r,s),inverse:t.noop,data:l}))?o:"")+(null!=(o=(e.compare||a&&a.compare||u).call(i,null!=a?a["panel-header-type"]:a,"dropdown",{name:"compare",hash:{},fn:t.program(46,l,0,r,s),inverse:t.noop,data:l}))?o:"")+(null!=(o=e.if.call(i,null!=(o=null!=a?a["settings-ids"]:a)?o.blockunits:o,{name:"if",hash:{},fn:t.program(57,l,0,r,s),inverse:t.noop,data:l}))?o:"")+"</div>"},useData:!0,useDepths:!0})}();