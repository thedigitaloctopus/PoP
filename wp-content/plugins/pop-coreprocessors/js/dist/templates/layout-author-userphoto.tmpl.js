!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["layout-author-userphoto"]=l({1:function(l,n,a,e,t,s,u){var i,r,o=l.lambda,h=l.escapeExpression,p=null!=n?n:{},m=a.helperMissing;return'\t<div class="'+h(o(null!=u[1]?u[1].class:u[1],n))+'">\n\t\t<a href="'+h(o(null!=(i=null!=n?n.userphoto:n)?i.src:i,n))+'" rel="'+h(o(null!=(i=null!=n?n.userphoto:n)?i.rel:i,n))+'" title="'+(null!=(r=null!=(r=a["display-name"]||(null!=n?n["display-name"]:n))?r:m,i="function"==typeof r?r.call(p,{name:"display-name",hash:{},data:t}):r)?i:"")+'"><img src="'+h(o(null!=(i=null!=n?n.userphoto:n)?i.src:i,n))+'" class="img-responsive thumbnail" alt="'+(null!=(r=null!=(r=a["display-name"]||(null!=n?n["display-name"]:n))?r:m,i="function"==typeof r?r.call(p,{name:"display-name",hash:{},data:t}):r)?i:"")+'" width="'+h(o(null!=(i=null!=n?n.userphoto:n)?i.width:i,n))+'" height="'+h(o(null!=(i=null!=n?n.userphoto:n)?i.height:i,n))+'"></a>\n\t</div>\n'},compiler:[7,">= 4.0.0"],main:function(l,n,a,e,t,s,u){var i;return null!=(i=a.with.call(null!=n?n:{},null!=n?n.itemObject:n,{name:"with",hash:{},fn:l.program(1,t,0,s,u),inverse:l.noop,data:t}))?i:""},useData:!0,useDepths:!0})}();