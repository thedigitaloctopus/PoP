!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["scroll-inner"]=l({1:function(l,n,e,a,r,o,t){var u,i=null!=n?n:{},s=l.lambda,m=l.escapeExpression;return(null!=(u=e.if.call(i,null!=(u=null!=t[1]?t[1]["layout-grid"]:t[1])?u["row-items"]:u,{name:"if",hash:{},fn:l.program(2,r,0,o,t),inverse:l.noop,data:r}))?u:"")+'\t<div class="pop-elem '+m(s(null!=t[1]?t[1].class:t[1],n))+" blockinner-elem scroll-elem "+m(s(null!=(u=null!=t[1]?t[1]["layout-grid"]:t[1])?u.class:u,n))+'">\n'+(null!=(u=e.each.call(i,null!=(u=null!=t[1]?t[1]["template-ids"]:t[1])?u.layouts:u,{name:"each",hash:{},fn:l.program(5,r,0,o,t),inverse:l.noop,data:r}))?u:"")+"\t</div>\n"+(null!=(u=e.if.call(i,null!=(u=null!=t[1]?t[1]["layout-grid"]:t[1])?u["row-items"]:u,{name:"if",hash:{},fn:l.program(8,r,0,o,t),inverse:l.noop,data:r}))?u:"")},2:function(l,n,e,a,r,o,t){var u;return"\t\t"+(null!=(u=(e.mod||n&&n.mod||e.helperMissing).call(null!=n?n:{},r&&r.index,null!=(u=null!=t[1]?t[1]["layout-grid"]:t[1])?u["row-items"]:u,{name:"mod",hash:{},fn:l.program(3,r,0,o,t),inverse:l.noop,data:r}))?u:"")+"\n"},3:function(l,n,e,a,r,o,t){return'<div class="pop-blockinner-row row blockinner-row scroll-row '+l.escapeExpression(l.lambda(null!=t[2]?t[2]["extend-class"]:t[2],n))+' pop-structureinner">'},5:function(l,n,e,a,r,o,t){var u;return null!=(u=(e.withModule||n&&n.withModule||e.helperMissing).call(null!=n?n:{},t[2],n,{name:"withModule",hash:{},fn:l.program(6,r,0,o,t),inverse:l.noop,data:r}))?u:""},6:function(l,n,e,a,r,o,t){return"\t\t\t\t"+l.escapeExpression((e.enterModule||n&&n.enterModule||e.helperMissing).call(null!=n?n:{},t[3],{name:"enterModule",hash:{itemObjectId:t[2],itemDBKey:null!=t[3]?t[3].itemDBKey:t[3]},data:r}))+"\n"},8:function(l,n,e,a,r,o,t){var u;return"\t\t"+(null!=(u=(e.mod||n&&n.mod||e.helperMissing).call(null!=n?n:{},r&&r.index,null!=(u=null!=t[1]?t[1]["layout-grid"]:t[1])?u["row-items"]:u,{name:"mod",hash:{offset:1},fn:l.program(9,r,0,o,t),inverse:l.noop,data:r}))?u:"")+"\n"},9:function(l,n,e,a,r){return"</div>"},11:function(l,n,e,a,r){var o;return null!=(o=e.if.call(null!=n?n:{},null!=(o=null!=n?n["layout-grid"]:n)?o["row-items"]:o,{name:"if",hash:{},fn:l.program(12,r,0),inverse:l.noop,data:r}))?o:""},12:function(l,n,e,a,r){var o;return"\t\t"+(null!=(o=(e.mod||n&&n.mod||e.helperMissing).call(null!=n?n:{},null!=(o=null!=n?n.items:n)?o.length:o,null!=(o=null!=n?n["layout-grid"]:n)?o["row-items"]:o,{name:"mod",hash:{},fn:l.program(13,r,0),inverse:l.program(9,r,0),data:r}))?o:"")+"\n"},13:function(l,n,e,a,r){return""},compiler:[7,">= 4.0.0"],main:function(l,n,e,a,r,o,t){var u,i=null!=n?n:{};return(null!=(u=e.each.call(i,null!=n?n.items:n,{name:"each",hash:{},fn:l.program(1,r,0,o,t),inverse:l.noop,data:r}))?u:"")+(null!=(u=e.if.call(i,null!=n?n.items:n,{name:"if",hash:{},fn:l.program(11,r,0,o,t),inverse:l.noop,data:r}))?u:"")},useData:!0,useDepths:!0})}();