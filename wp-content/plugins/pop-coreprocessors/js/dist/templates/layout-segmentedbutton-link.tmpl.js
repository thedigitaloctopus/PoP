!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["layout-segmentedbutton-link"]=l({1:function(l,a,n,e,t,s,u){var r,o,i=null!=a?a:l.nullContext||{},c=n.helperMissing,m=l.escapeExpression,p=l.lambda;return'<a href="'+m((o=null!=(o=n.url||(null!=a?a.url:a))?o:c,"function"==typeof o?o.call(i,{name:"url",hash:{},data:t}):o))+'" title="'+m((o=null!=(o=n.alt||(null!=a?a.alt:a))?o:c,"function"==typeof o?o.call(i,{name:"alt",hash:{},data:t}):o))+'" class="segmentedbutton '+m(p(null!=u[1]?u[1].class:u[1],a))+'" style="'+m(p(null!=u[1]?u[1].style:u[1],a))+'" '+(null!=(r=n.each.call(i,null!=u[1]?u[1].params:u[1],{name:"each",hash:{},fn:l.program(2,t,0,s,u),inverse:l.noop,data:t}))?r:"")+">"+(null!=(r=n.if.call(i,null!=u[1]?u[1].fontawesome:u[1],{name:"if",hash:{},fn:l.program(4,t,0,s,u),inverse:l.noop,data:t}))?r:"")+"</a>"},2:function(l,a,n,e,t){var s,u=l.escapeExpression;return" "+u((s=null!=(s=n.key||t&&t.key)?s:n.helperMissing,"function"==typeof s?s.call(null!=a?a:l.nullContext||{},{name:"key",hash:{},data:t}):s))+'="'+u(l.lambda(a,a))+'"'},4:function(l,a,n,e,t,s,u){return'<i class="fa fa-fw '+l.escapeExpression(l.lambda(null!=u[1]?u[1].fontawesome:u[1],a))+'"></i>'},compiler:[7,">= 4.0.0"],main:function(l,a,n,e,t,s,u){var r;return null!=(r=n.with.call(null!=a?a:l.nullContext||{},null!=a?a.itemObject:a,{name:"with",hash:{},fn:l.program(1,t,0,s,u),inverse:l.noop,data:t}))?r:""},useData:!0,useDepths:!0})}();