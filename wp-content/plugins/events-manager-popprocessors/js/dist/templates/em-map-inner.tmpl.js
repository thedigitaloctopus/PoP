!function(){var e=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["em-map-inner"]=e({1:function(e,n,a,l,t,r,u){return"\t"+e.escapeExpression((a.enterModule||n&&n.enterModule||a.helperMissing).call(null!=n?n:{},u[1],{name:"enterModule",hash:{},data:t}))+"\n"},3:function(e,n,a,l,t,r,u){var s;return null!=(s=a.each.call(null!=n?n:{},null!=(s=null!=u[1]?u[1]["template-ids"]:u[1])?s.layouts:s,{name:"each",hash:{},fn:e.program(4,t,0,r,u),inverse:e.noop,data:t}))?s:""},4:function(e,n,a,l,t,r,u){var s;return null!=(s=(a.withModule||n&&n.withModule||a.helperMissing).call(null!=n?n:{},u[2],n,{name:"withModule",hash:{},fn:e.program(5,t,0,r,u),inverse:e.noop,data:t}))?s:""},5:function(e,n,a,l,t,r,u){return"\t\t\t"+e.escapeExpression((a.enterModule||n&&n.enterModule||a.helperMissing).call(null!=n?n:{},u[3],{name:"enterModule",hash:{itemObjectId:u[2],itemDBKey:null!=u[3]?u[3].itemDBKey:u[3]},data:t}))+"\n"},compiler:[7,">= 4.0.0"],main:function(e,n,a,l,t,r,u){var s,i=null!=n?n:{},o=a.helperMissing;return(null!=(s=(a.withModule||n&&n.withModule||o).call(i,n,"map-script-resetmarkers",{name:"withModule",hash:{},fn:e.program(1,t,0,r,u),inverse:e.noop,data:t}))?s:"")+"\n"+(null!=(s=a.each.call(i,null!=n?n.items:n,{name:"each",hash:{},fn:e.program(3,t,0,r,u),inverse:e.noop,data:t}))?s:"")+"\n"+(null!=(s=(a.withModule||n&&n.withModule||o).call(i,n,"map-script-drawmarkers",{name:"withModule",hash:{},fn:e.program(1,t,0,r,u),inverse:e.noop,data:t}))?s:"")},useData:!0,useDepths:!0})}();