!function(){var e=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["layout-multiple"]=e({1:function(e,l,t,n,a,u,i){var s;return'\t<div class="'+e.escapeExpression(e.lambda(null!=i[1]?i[1].class:i[1],l))+'">\n'+(null!=(s=(t.withLayout||l&&l.withLayout||t.helperMissing).call(null!=l?l:{},null!=i[1]?i[1].itemDBKey:i[1],null!=l?l.id:l,null!=i[1]?i[1]["multiple-layouts"]:i[1],i[1],{name:"withLayout",hash:{},fn:e.program(2,a,0,u,i),inverse:e.noop,data:a}))?s:"")+"\t</div>\n"},2:function(e,l,t,n,a,u,i){return"\t\t\t"+e.escapeExpression((t.enterModule||l&&l.enterModule||t.helperMissing).call(null!=l?l:{},i[2],{name:"enterModule",hash:{itemObjectId:null!=l?l.itemObjectId:l,itemDBKey:null!=l?l.itemDBKey:l},data:a}))+"\n"},compiler:[7,">= 4.0.0"],main:function(e,l,t,n,a,u,i){var s;return null!=(s=t.with.call(null!=l?l:{},null!=l?l.itemObject:l,{name:"with",hash:{},fn:e.program(1,a,0,u,i),inverse:e.noop,data:a}))?s:""},useData:!0,useDepths:!0})}();