!function(){var t=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["aal-layout-notificationtime"]=t({1:function(t,n,a,e,l,i,s){var r,m,o=t.lambda,u=t.escapeExpression,d=null!=n?n:t.nullContext||{},c=a.helperMissing;return'\t<div class="time '+u(o(null!=s[1]?s[1].class:s[1],n))+'" style="'+u(o(null!=s[1]?s[1].style:s[1],n))+'" data-time="'+u((m=null!=(m=a["hist-time-nogmt"]||(null!=n?n["hist-time-nogmt"]:n))?m:c,"function"==typeof m?m.call(d,{name:"hist-time-nogmt",hash:{},data:l}):m))+'" data-format="'+u(o(null!=s[1]?s[1].format:s[1],n))+'" '+(null!=(r=(a.generateId||n&&n.generateId||c).call(d,{name:"generateId",hash:{context:s[1]},fn:t.program(2,l,0,i,s),inverse:t.noop,data:l}))?r:"")+'><span class="hidden">'+u((m=null!=(m=a["hist-time-formatted-string"]||(null!=n?n["hist-time-formatted-string"]:n))?m:c,"function"==typeof m?m.call(d,{name:"hist-time-formatted-string",hash:{},data:l}):m))+"</span></div>\n"},2:function(t,n,a,e,l,i,s){return t.escapeExpression(t.lambda(null!=s[1]?s[1].id:s[1],n))},compiler:[7,">= 4.0.0"],main:function(t,n,a,e,l,i,s){var r;return null!=(r=a.with.call(null!=n?n:t.nullContext||{},null!=n?n.itemObject:n,{name:"with",hash:{},fn:t.program(1,l,0,i,s),inverse:t.noop,data:l}))?r:""},useData:!0,useDepths:!0})}();