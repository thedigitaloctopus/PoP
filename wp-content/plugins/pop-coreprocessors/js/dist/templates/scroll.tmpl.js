!function(){var e=Handlebars.template;(Handlebars.templates=Handlebars.templates||{}).scroll=e({1:function(e,l,a,n,s){var t;return e.escapeExpression((t=null!=(t=a.id||(null!=l?l.id:l))?t:a.helperMissing,"function"==typeof t?t.call(null!=l?l:{},{name:"id",hash:{},data:s}):t))},3:function(e,l,a,n,s){var t,r=e.escapeExpression;return" "+r((t=null!=(t=a.key||s&&s.key)?t:a.helperMissing,"function"==typeof t?t.call(null!=l?l:{},{name:"key",hash:{},data:s}):t))+'="'+r(e.lambda(l,l))+'"'},5:function(e,l,a,n,s,t,r){var i,c=null!=l?l:{},u=a.helperMissing,o=e.escapeExpression;return" "+o((i=null!=(i=a.key||s&&s.key)?i:u,"function"==typeof i?i.call(c,{name:"key",hash:{},data:s}):i))+'="#'+o((a.lastGeneratedId||l&&l.lastGeneratedId||u).call(c,{name:"lastGeneratedId",hash:{template:l,context:r[1]},data:s}))+'"'},7:function(e,l,a,n,s,t,r){return e.escapeExpression((a.applyLightTemplate||l&&l.applyLightTemplate||a.helperMissing).call(null!=l?l:{},l,{name:"applyLightTemplate",hash:{context:r[1]},data:s}))},9:function(e,l,a,n,s,t,r){return"\t\t\t"+e.escapeExpression((a.enterModule||l&&l.enterModule||a.helperMissing).call(null!=l?l:{},r[1],{name:"enterModule",hash:{items:null!=r[1]?r[1].items:r[1],itemDBKey:null!=r[1]?r[1].itemDBKey:r[1]},data:s}))+"\n"},compiler:[7,">= 4.0.0"],main:function(e,l,a,n,s,t,r){var i,c,u,o=null!=l?l:{},p=a.helperMissing,d=e.escapeExpression,h="<div ";return c=null!=(c=a.generateId||(null!=l?l.generateId:l))?c:p,u={name:"generateId",hash:{},fn:e.program(1,s,0,t,r),inverse:e.noop,data:s},i="function"==typeof c?c.call(o,u):c,a.generateId||(i=a.blockHelperMissing.call(l,i,u)),null!=i&&(h+=i),h+' class="'+d((c=null!=(c=a.class||(null!=l?l.class:l))?c:p,"function"==typeof c?c.call(o,{name:"class",hash:{},data:s}):c))+' scroll" '+(null!=(i=a.each.call(o,null!=l?l.params:l,{name:"each",hash:{},fn:e.program(3,s,0,t,r),inverse:e.noop,data:s}))?i:"")+" "+(null!=(i=a.each.call(o,null!=l?l["previoustemplates-ids"]:l,{name:"each",hash:{},fn:e.program(5,s,0,t,r),inverse:e.noop,data:s}))?i:"")+">\n\t"+(null!=(c=null!=(c=a.description||(null!=l?l.description:l))?c:p,i="function"==typeof c?c.call(o,{name:"description",hash:{},data:s}):c)?i:"")+'\n\t<div class="'+(null!=(i=a.each.call(o,null!=(i=null!=l?l["template-ids"]:l)?i["class-extensions"]:i,{name:"each",hash:{},fn:e.program(7,s,0,t,r),inverse:e.noop,data:s}))?i:"")+" "+d((c=null!=(c=a["class-merge"]||(null!=l?l["class-merge"]:l))?c:p,"function"==typeof c?c.call(o,{name:"class-merge",hash:{},data:s}):c))+" "+d(e.lambda(null!=(i=null!=l?l.classes:l)?i.inner:i,l))+' scroll-inner clearfix">\n'+(null!=(i=(a.withModule||l&&l.withModule||p).call(o,l,"inner",{name:"withModule",hash:{},fn:e.program(9,s,0,t,r),inverse:e.noop,data:s}))?i:"")+"\t</div>\n</div>"},useData:!0,useDepths:!0})}();