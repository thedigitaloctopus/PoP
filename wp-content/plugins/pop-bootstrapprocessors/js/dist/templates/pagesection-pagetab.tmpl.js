!function(){var e=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["pagesection-pagetab"]=e({1:function(e,t,l,n,a,r,s){var u;return null!=(u=(l.withBlock||t&&t.withBlock||l.helperMissing).call(null!=t?t:e.nullContext||{},s[1],t,{name:"withBlock",hash:{},fn:e.program(2,a,0,r,s),inverse:e.noop,data:a}))?u:""},2:function(e,t,l,n,a,r,s){var u,p=e.lambda,i=e.escapeExpression,o=null!=t?t:e.nullContext||{},c=l.helperMissing;return'\t\t<div class="'+i(p(null!=s[2]?s[2].class:s[2],t))+'" style="'+i(p(null!=s[2]?s[2].style:s[2],t))+'" '+(null!=(u=(l.generateId||t&&t.generateId||c).call(o,{name:"generateId",hash:{group:"unit",targetId:null!=(u=null!=s[2]?s[2].pss:s[2])?u.pssId:u,context:s[2]},fn:e.program(3,a,0,r,s),inverse:e.noop,data:a}))?u:"")+"  "+(null!=(u=l.each.call(o,null!=s[2]?s[2].params:s[2],{name:"each",hash:{},fn:e.program(5,a,0,r,s),inverse:e.noop,data:a}))?u:"")+'>\n\t\t\t<div class="btn-group">\n\t\t\t\t<a '+(null!=(u=(l.generateId||t&&t.generateId||c).call(o,{name:"generateId",hash:{group:"pagetab-btn",targetId:null!=(u=null!=s[2]?s[2].pss:s[2])?u.pssId:u,context:s[2]},fn:e.program(3,a,0,r,s),inverse:e.noop,data:a}))?u:"")+' href="'+(null!=(u=(l.withSublevel||t&&t.withSublevel||c).call(o,null!=s[2]?s[2].template:s[2],{name:"withSublevel",hash:{context:null!=(u=null!=(u=null!=s[2]?s[2].pss:s[2])?u.feedback:u)?u["intercept-urls"]:u},fn:e.program(7,a,0,r,s),inverse:e.noop,data:a}))?u:"")+'" role="button" class="pop-pagetab-btn '+i(p(null!=(u=null!=s[2]?s[2].classes:s[2])?u.btn:u,t))+'" style="'+i(p(null!=(u=null!=s[2]?s[2].styles:s[2])?u.btn:u,t))+'">\n\t\t\t\t\t'+i((l.enterModule||t&&t.enterModule||c).call(o,t,{name:"enterModule",hash:{parentContext:s[2]},data:a}))+'\n\t\t\t\t</a>\n\t\t\t\t<button type="button" class="pop-closepagetab-btn '+i(p(null!=(u=null!=s[2]?s[2].classes:s[2])?u.btn:u,t))+' btn-narrow" style="'+i(p(null!=(u=null!=s[2]?s[2].styles:s[2])?u.btn:u,t))+'" '+(null!=(u=(l.generateId||t&&t.generateId||c).call(o,{name:"generateId",hash:{group:"remove",targetId:null!=(u=null!=s[2]?s[2].pss:s[2])?u.pssId:u,context:s[2]},fn:e.program(3,a,0,r,s),inverse:e.noop,data:a}))?u:"")+' data-url="'+(null!=(u=(l.withSublevel||t&&t.withSublevel||c).call(o,null!=s[2]?s[2].template:s[2],{name:"withSublevel",hash:{context:null!=(u=null!=(u=null!=s[2]?s[2].pss:s[2])?u.feedback:u)?u["intercept-urls"]:u},fn:e.program(7,a,0,r,s),inverse:e.noop,data:a}))?u:"")+'">\n\t\t\t\t\t<small><span class="glyphicon glyphicon-remove"></span></small>\n\t\t\t\t</button>\n\t\t\t</div>\n\t\t\t<a '+i((l.interceptAttr||t&&t.interceptAttr||c).call(o,{name:"interceptAttr",hash:{context:s[2]},data:a}))+" "+(null!=(u=(l.generateId||t&&t.generateId||c).call(o,{name:"generateId",hash:{group:"activate-interceptor",targetId:null!=(u=null!=s[2]?s[2].pss:s[2])?u.pssId:u,context:s[2]},fn:e.program(3,a,0,r,s),inverse:e.noop,data:a}))?u:"")+' data-target="#'+i((l.lastGeneratedId||t&&t.lastGeneratedId||c).call(o,{name:"lastGeneratedId",hash:{group:"pagetab-btn",targetId:null!=(u=null!=s[2]?s[2].pss:s[2])?u.pssId:u,context:s[2]},data:a}))+'" '+(null!=(u=l.if.call(o,null!=s[2]?s[2]["intercept-skipstateupdate"]:s[2],{name:"if",hash:{},fn:e.program(9,a,0,r,s),inverse:e.noop,data:a}))?u:"")+' data-intercept-url="'+(null!=(u=(l.withSublevel||t&&t.withSublevel||c).call(o,null!=s[2]?s[2].template:s[2],{name:"withSublevel",hash:{context:null!=(u=null!=(u=null!=s[2]?s[2].pss:s[2])?u.feedback:u)?u["intercept-urls"]:u},fn:e.program(7,a,0,r,s),inverse:e.noop,data:a}))?u:"")+'" data-title="'+(null!=(u=p(null!=(u=null!=(u=null!=s[2]?s[2].tls:s[2])?u.feedback:u)?u.title:u,t))?u:"")+'"></a>\n'+(null!=(u=(l.withSublevel||t&&t.withSublevel||c).call(o,null!=s[2]?s[2].template:s[2],{name:"withSublevel",hash:{context:null!=(u=null!=(u=null!=s[2]?s[2].pss:s[2])?u.feedback:u)?u["extra-intercept-urls"]:u},fn:e.program(11,a,0,r,s),inverse:e.noop,data:a}))?u:"")+"\n\t\t\t<a "+i((l.interceptAttr||t&&t.interceptAttr||c).call(o,{name:"interceptAttr",hash:{context:s[2]},data:a}))+" "+(null!=(u=(l.generateId||t&&t.generateId||c).call(o,{name:"generateId",hash:{group:"destroy-interceptor",targetId:null!=(u=null!=s[2]?s[2].pss:s[2])?u.pssId:u,context:s[2]},fn:e.program(3,a,0,r,s),inverse:e.noop,data:a}))?u:"")+' data-target="#'+i((l.lastGeneratedId||t&&t.lastGeneratedId||c).call(o,{name:"lastGeneratedId",hash:{group:"unit",targetId:null!=(u=null!=s[2]?s[2].pss:s[2])?u.pssId:u,context:s[2]},data:a}))+'" data-intercept-url="'+(null!=(u=(l.withSublevel||t&&t.withSublevel||c).call(o,null!=s[2]?s[2].template:s[2],{name:"withSublevel",hash:{context:null!=(u=null!=(u=null!=s[2]?s[2].pss:s[2])?u.feedback:u)?u["intercept-urls"]:u},fn:e.program(16,a,0,r,s),inverse:e.noop,data:a}))?u:"")+'" data-intercept-skipstateupdate="true"></a>\n'+(null!=(u=l.each.call(o,null!=(u=null!=s[2]?s[2]["template-ids"]:s[2])?u.insideextensions:u,{name:"each",hash:{},fn:e.program(19,a,0,r,s),inverse:e.noop,data:a}))?u:"")+"\t\t</div>\n"},3:function(e,t,l,n,a,r,s){var u,p=e.lambda,i=e.escapeExpression;return i(p(null!=s[2]?s[2].id:s[2],t))+i(p(null!=(u=null!=(u=null!=s[2]?s[2].tls:s[2])?u.feedback:u)?u["unique-id"]:u,t))+"-"+i(p(s[1],t))},5:function(e,t,l,n,a){var r,s=e.escapeExpression;return" "+s((r=null!=(r=l.key||a&&a.key)?r:l.helperMissing,"function"==typeof r?r.call(null!=t?t:e.nullContext||{},{name:"key",hash:{},data:a}):r))+'="'+s(e.lambda(t,t))+'"'},7:function(e,t,l,n,a,r,s){return e.escapeExpression((l.get||t&&t.get||l.helperMissing).call(null!=t?t:e.nullContext||{},t,null!=s[3]?s[3].template:s[3],{name:"get",hash:{},data:a}))},9:function(e,t,l,n,a){return'data-intercept-skipstateupdate="true"'},11:function(e,t,l,n,a,r,s){var u;return null!=(u=(l.withget||t&&t.withget||l.helperMissing).call(null!=t?t:e.nullContext||{},t,null!=s[3]?s[3].template:s[3],{name:"withget",hash:{},fn:e.program(12,a,0,r,s),inverse:e.noop,data:a}))?u:""},12:function(e,t,l,n,a,r,s){var u;return null!=(u=l.each.call(null!=t?t:e.nullContext||{},t,{name:"each",hash:{},fn:e.program(13,a,0,r,s),inverse:e.noop,data:a}))?u:""},13:function(e,t,l,n,a,r,s){var u,p=null!=t?t:e.nullContext||{},i=l.helperMissing,o=e.escapeExpression,c=e.lambda;return"\t\t\t\t\t\t<a "+o((l.interceptAttr||t&&t.interceptAttr||i).call(p,{name:"interceptAttr",hash:{context:s[5]},data:a}))+" "+(null!=(u=(l.generateId||t&&t.generateId||i).call(p,{name:"generateId",hash:{group:"activate-interceptor",targetId:null!=(u=null!=s[5]?s[5].pss:s[5])?u.pssId:u,context:s[5]},fn:e.program(14,a,0,r,s),inverse:e.noop,data:a}))?u:"")+' data-target="#'+o((l.lastGeneratedId||t&&t.lastGeneratedId||i).call(p,{name:"lastGeneratedId",hash:{group:"pagetab-btn",targetId:null!=(u=null!=s[5]?s[5].pss:s[5])?u.pssId:u,context:s[5]},data:a}))+'" '+(null!=(u=l.if.call(p,null!=s[5]?s[5]["intercept-skipstateupdate"]:s[5],{name:"if",hash:{},fn:e.program(9,a,0,r,s),inverse:e.noop,data:a}))?u:"")+' data-intercept-url="'+o(c(t,t))+'" data-title="'+(null!=(u=c(null!=(u=null!=(u=null!=s[3]?s[3].tls:s[3])?u.feedback:u)?u.title:u,t))?u:"")+'"></a>\n'},14:function(e,t,l,n,a,r,s){var u,p,i=e.lambda,o=e.escapeExpression;return o(i(null!=s[5]?s[5].id:s[5],t))+o(i(null!=(u=null!=(u=null!=s[5]?s[5].tls:s[5])?u.feedback:u)?u["unique-id"]:u,t))+"-"+o(i(s[4],t))+"-"+o((p=null!=(p=l.index||a&&a.index)?p:l.helperMissing,"function"==typeof p?p.call(null!=t?t:e.nullContext||{},{name:"index",hash:{},data:a}):p))},16:function(e,t,l,n,a,r,s){var u;return null!=(u=(l.withSublevel||t&&t.withSublevel||l.helperMissing).call(null!=t?t:e.nullContext||{},null!=s[3]?s[3].template:s[3],{name:"withSublevel",hash:{},fn:e.program(17,a,0,r,s),inverse:e.noop,data:a}))?u:""},17:function(e,t,l,n,a){return e.escapeExpression((l.destroyUrl||t&&t.destroyUrl||l.helperMissing).call(null!=t?t:e.nullContext||{},t,{name:"destroyUrl",hash:{},data:a}))},19:function(e,t,l,n,a,r,s){return"\t\t\t\t"+e.escapeExpression((l.applyLightTemplate||t&&t.applyLightTemplate||l.helperMissing).call(null!=t?t:e.nullContext||{},t,{name:"applyLightTemplate",hash:{context:s[3]},data:a}))+"\n"},21:function(e,t,l,n,a,r,s){return"\t"+e.escapeExpression((l.applyLightTemplate||t&&t.applyLightTemplate||l.helperMissing).call(null!=t?t:e.nullContext||{},t,{name:"applyLightTemplate",hash:{context:s[1]},data:a}))+"\n"},compiler:[7,">= 4.0.0"],main:function(e,t,l,n,a,r,s){var u,p=null!=t?t:e.nullContext||{};return(null!=(u=l.each.call(p,null!=(u=null!=t?t["block-settings-ids"]:t)?u.blockunits:u,{name:"each",hash:{},fn:e.program(1,a,0,r,s),inverse:e.noop,data:a}))?u:"")+(null!=(u=l.each.call(p,null!=(u=null!=t?t["template-ids"]:t)?u.extensions:u,{name:"each",hash:{},fn:e.program(21,a,0,r,s),inverse:e.noop,data:a}))?u:"")},useData:!0,useDepths:!0})}();