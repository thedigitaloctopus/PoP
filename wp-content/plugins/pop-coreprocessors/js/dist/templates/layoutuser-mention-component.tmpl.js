!function(){var a=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["layoutuser-mention-component"]=a({compiler:[7,">= 4.0.0"],main:function(a,n,l,e,s){var t,i,m=a.lambda,u=a.escapeExpression,c=null!=n?n:a.nullContext||{},p=l.helperMissing;return'<span class="media clearfix">\n\t<span class="media-left">\n\t\t<img width="'+u(m(null!=(t=null!=n?n["avatar-40"]:n)?t.size:t,n))+'" height="'+u(m(null!=(t=null!=n?n["avatar-40"]:n)?t.size:t,n))+'" src="'+u(m(null!=(t=null!=n?n["avatar-40"]:n)?t.src:t,n))+'">\n\t</span>\n\t<span class="media-body">\n\t\t<h4 class="media-heading">'+(null!=(i=null!=(i=l["display-name"]||(null!=n?n["display-name"]:n))?i:p,t="function"==typeof i?i.call(c,{name:"display-name",hash:{},data:s}):i)?t:"")+"<br/><small>"+u((i=null!=(i=l.nicename||(null!=n?n.nicename:n))?i:p,"function"==typeof i?i.call(c,{name:"nicename",hash:{},data:s}):i))+"</small></h4>\n\t</span>\n</span>"},useData:!0})}();