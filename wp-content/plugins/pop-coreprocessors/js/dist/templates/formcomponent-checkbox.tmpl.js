!function(){var l=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["formcomponent-checkbox"]=l({1:function(l,e,a,n,t){return'checked="checked"'},3:function(l,e,a,n,t){var s;return l.escapeExpression((s=null!=(s=a.id||(null!=e?e.id:e))?s:a.helperMissing,"function"==typeof s?s.call(null!=e?e:l.nullContext||{},{name:"id",hash:{},data:t}):s))},5:function(l,e,a,n,t){return"readonly"},7:function(l,e,a,n,t){return'disabled="disabled"'},9:function(l,e,a,n,t){var s,u=l.escapeExpression;return" "+u((s=null!=(s=a.key||t&&t.key)?s:a.helperMissing,"function"==typeof s?s.call(null!=e?e:l.nullContext||{},{name:"key",hash:{},data:t}):s))+'="'+u(l.lambda(e,e))+'"'},11:function(l,e,a,n,t,s,u){var r,o=null!=e?e:l.nullContext||{},c=a.helperMissing,i=l.escapeExpression;return" "+i((r=null!=(r=a.key||t&&t.key)?r:c,"function"==typeof r?r.call(o,{name:"key",hash:{},data:t}):r))+'="#'+i((a.lastGeneratedId||e&&e.lastGeneratedId||c).call(o,{name:"lastGeneratedId",hash:{template:e,context:u[1]},data:t}))+'"'},compiler:[7,">= 4.0.0"],main:function(l,e,a,n,t,s,u){var r,o,c,i=null!=e?e:l.nullContext||{},p=a.helperMissing,d="function",h=l.escapeExpression,m='<label>\n\t<input type="checkbox" '+(null!=(r=a.if.call(i,null!=e?e.value:e,{name:"if",hash:{},fn:l.program(1,t,0,s,u),inverse:l.noop,data:t}))?r:"")+' name="'+h((o=null!=(o=a.name||(null!=e?e.name:e))?o:p,typeof o===d?o.call(i,{name:"name",hash:{},data:t}):o))+'" ';return o=null!=(o=a.generateId||(null!=e?e.generateId:e))?o:p,c={name:"generateId",hash:{},fn:l.program(3,t,0,s,u),inverse:l.noop,data:t},r=typeof o===d?o.call(i,c):o,a.generateId||(r=a.blockHelperMissing.call(e,r,c)),null!=r&&(m+=r),m+' class="'+h((o=null!=(o=a.class||(null!=e?e.class:e))?o:p,typeof o===d?o.call(i,{name:"class",hash:{},data:t}):o))+" "+h((o=null!=(o=a["input-class"]||(null!=e?e["input-class"]:e))?o:p,typeof o===d?o.call(i,{name:"input-class",hash:{},data:t}):o))+'" style="'+h((o=null!=(o=a.style||(null!=e?e.style:e))?o:p,typeof o===d?o.call(i,{name:"style",hash:{},data:t}):o))+'" '+(null!=(r=a.if.call(i,null!=e?e.readonly:e,{name:"if",hash:{},fn:l.program(5,t,0,s,u),inverse:l.noop,data:t}))?r:"")+" "+(null!=(r=a.if.call(i,null!=e?e.disabled:e,{name:"if",hash:{},fn:l.program(7,t,0,s,u),inverse:l.noop,data:t}))?r:"")+" "+(null!=(r=a.each.call(i,null!=e?e.params:e,{name:"each",hash:{},fn:l.program(9,t,0,s,u),inverse:l.noop,data:t}))?r:"")+" "+(null!=(r=a.each.call(i,null!=e?e["previoustemplates-ids"]:e,{name:"each",hash:{},fn:l.program(11,t,0,s,u),inverse:l.noop,data:t}))?r:"")+"> "+(null!=(o=null!=(o=a.label||(null!=e?e.label:e))?o:p,r=typeof o===d?o.call(i,{name:"label",hash:{},data:t}):o)?r:"")+"\n</label>"},useData:!0,useDepths:!0})}();