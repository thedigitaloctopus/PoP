!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["ure-layoutuser-memberprivileges"]=l({1:function(l,e,n,a,t,s,r){var i,u=l.lambda,p=l.escapeExpression,m=null!=e?e:l.nullContext||{};return'\t<span class="'+p(u(null!=r[1]?r[1].class:r[1],e))+'" style="'+p(u(null!=r[1]?r[1].style:r[1],e))+'">\n\t\t'+(null!=(i=n.if.call(m,null!=(i=null!=r[1]?r[1].titles:r[1])?i.description:i,{name:"if",hash:{},fn:l.program(2,t,0,s,r),inverse:l.noop,data:t}))?i:"")+p((n.labelize||e&&e.labelize||n.helperMissing).call(m,null!=e?e["memberprivileges-strings"]:e,null!=(i=null!=r[1]?r[1].classes:r[1])?i.label:i,{name:"labelize",hash:{},data:t}))+"\n\t</span>\n"},2:function(l,e,n,a,t,s,r){var i;return(null!=(i=l.lambda(null!=(i=null!=r[1]?r[1].titles:r[1])?i.description:i,e))?i:"")+" "},compiler:[7,">= 4.0.0"],main:function(l,e,n,a,t,s,r){var i;return null!=(i=n.with.call(null!=e?e:l.nullContext||{},null!=e?e.itemObject:e,{name:"with",hash:{},fn:l.program(1,t,0,s,r),inverse:l.noop,data:t}))?i:""},useData:!0,useDepths:!0})}();