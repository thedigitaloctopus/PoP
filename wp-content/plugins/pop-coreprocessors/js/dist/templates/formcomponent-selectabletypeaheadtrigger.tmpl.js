!function(){var n=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["formcomponent-selectabletypeaheadtrigger"]=n({1:function(n,e,l,a,t){var s;return n.escapeExpression((s=null!=(s=l.id||(null!=e?e.id:e))?s:l.helperMissing,"function"==typeof s?s.call(null!=e?e:{},{name:"id",hash:{},data:t}):s))},3:function(n,e,l,a,t){var s;return null!=(s=l.if.call(null!=e?e:{},null!=e?e["cannot-close-ids"]:e,{name:"if",hash:{},fn:n.program(4,t,0),inverse:n.program(7,t,0),data:t}))?s:""},4:function(n,e,l,a,t){var s;return null!=(s=(l.compare||e&&e.compare||l.helperMissing).call(null!=e?e:{},null!=(s=null!=e?e.itemObject:e)?s.id:s,null!=e?e["cannot-close-ids"]:e,{name:"compare",hash:{operator:"notin"},fn:n.program(5,t,0),inverse:n.noop,data:t}))?s:""},5:function(n,e,l,a,t){return'\t\t\t\t<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n'},7:function(n,e,l,a,t){return'\t\t\t<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n'},9:function(n,e,l,a,t,s,r){return"\t\t"+n.escapeExpression((l.enterModule||e&&e.enterModule||l.helperMissing).call(null!=e?e:{},r[1],{name:"enterModule",hash:{},data:t}))+"\n"},compiler:[7,">= 4.0.0"],main:function(n,e,l,a,t,s,r){var u,i,o,c=null!=e?e:{},p=l.helperMissing,d="function",h=n.lambda,m=n.escapeExpression,f="<div ";return i=null!=(i=l.generateId||(null!=e?e.generateId:e))?i:p,o={name:"generateId",hash:{},fn:n.program(1,t,0,s,r),inverse:n.noop,data:t},u=typeof i===d?i.call(c,o):i,l.generateId||(u=l.blockHelperMissing.call(e,u,o)),null!=u&&(f+=u),f+' class="alert in '+m(h(null!=(u=null!=e?e.classes:e)?u.alert:u,e))+" "+m((i=null!=(i=l.class||(null!=e?e.class:e))?i:p,typeof i===d?i.call(c,{name:"class",hash:{},data:t}):i))+' pop-typeahead-selected">\n\t'+(null!=(i=null!=(i=l.description||(null!=e?e.description:e))?i:p,u=typeof i===d?i.call(c,{name:"description",hash:{},data:t}):i)?u:"")+"\n"+(null!=(u=l.if.call(c,null!=e?e["show-close-btn"]:e,{name:"if",hash:{},fn:n.program(3,t,0,s,r),inverse:n.noop,data:t}))?u:"")+(null!=(u=(l.withModule||e&&e.withModule||p).call(c,e,"layout-selected",{name:"withModule",hash:{},fn:n.program(9,t,0,s,r),inverse:n.noop,data:t}))?u:"")+'\t<input type="hidden" value="'+m(h(null!=(u=null!=e?e.itemObject:e)?u.id:u,e))+'" name="'+m((i=null!=(i=l["input-name"]||(null!=e?e["input-name"]:e))?i:p,typeof i===d?i.call(c,{name:"input-name",hash:{},data:t}):i))+'[]" class="'+m((i=null!=(i=l["input-class"]||(null!=e?e["input-class"]:e))?i:p,typeof i===d?i.call(c,{name:"input-class",hash:{},data:t}):i))+'">\n</div>\n'},useData:!0,useDepths:!0})}();