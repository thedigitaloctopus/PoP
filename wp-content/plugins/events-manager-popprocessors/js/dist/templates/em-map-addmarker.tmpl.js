!function(){var e=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["em-map-addmarker"]=e({1:function(e,a,n,l,r,t,s){return"\t"+e.escapeExpression((n.enterModule||a&&a.enterModule||n.helperMissing).call(null!=a?a:{},s[1],{name:"enterModule",hash:{},data:r}))+"\n"},compiler:[7,">= 4.0.0"],main:function(e,a,n,l,r,t,s){var i,o=null!=a?a:{},u=n.helperMissing;return(null!=(i=(n.withModule||a&&a.withModule||u).call(o,a,"map-script-resetmarkers",{name:"withModule",hash:{},fn:e.program(1,r,0,t,s),inverse:e.noop,data:r}))?i:"")+"\n"+(null!=(i=(n.withModule||a&&a.withModule||u).call(o,a,"map-script-markers",{name:"withModule",hash:{},fn:e.program(1,r,0,t,s),inverse:e.noop,data:r}))?i:"")},useData:!0,useDepths:!0})}();