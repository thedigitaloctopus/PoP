!function(){var t=Handlebars.template;(Handlebars.templates=Handlebars.templates||{}).table=t({1:function(t,e,n,l,a){var s;return t.escapeExpression((s=null!=(s=n.id||(null!=e?e.id:e))?s:n.helperMissing,"function"==typeof s?s.call(null!=e?e:t.nullContext||{},{name:"id",hash:{},data:a}):s))},3:function(t,e,n,l,a){var s,r=null!=e?e:t.nullContext||{};return"\t\t<thead>\n"+(null!=(s=n.if.call(r,null!=e?e.description:e,{name:"if",hash:{},fn:t.program(4,a,0),inverse:t.noop,data:a}))?s:"")+"\t\t\t<tr>\n"+(null!=(s=n.each.call(r,null!=(s=null!=e?e.header:e)?s.titles:s,{name:"each",hash:{},fn:t.program(6,a,0),inverse:t.noop,data:a}))?s:"")+"\t\t\t</tr>\n\t\t</thead>\n"},4:function(t,e,n,l,a){var s,r;return'\t\t\t\t<tr>\n\t\t\t\t\t<td colspan="'+t.escapeExpression(t.lambda(null!=(s=null!=(s=null!=e?e.header:e)?s.titles:s)?s.length:s,e))+'">\n\t\t\t\t\t\t'+(null!=(r=null!=(r=n.description||(null!=e?e.description:e))?r:n.helperMissing,s="function"==typeof r?r.call(null!=e?e:t.nullContext||{},{name:"description",hash:{},data:a}):r)?s:"")+"\n\t\t\t\t\t</td>\n\t\t\t\t</tr>\n"},6:function(t,e,n,l,a){return"\t\t\t\t\t<th>"+t.escapeExpression(t.lambda(e,e))+"</th>\n"},8:function(t,e,n,l,a,s,r){var u=t.escapeExpression,o=null!=e?e:t.nullContext||{},i=n.helperMissing;return'\t\t<tbody class="'+u(t.lambda(null!=r[1]?r[1]["class-merge"]:r[1],e))+' table-inner" id="'+u((n.lastGeneratedId||e&&e.lastGeneratedId||i).call(o,{name:"lastGeneratedId",hash:{context:r[1]},data:a}))+'-merge">\n\t\t\t'+u((n.enterModule||e&&e.enterModule||i).call(o,r[1],{name:"enterModule",hash:{dbObjectIDs:null!=r[1]?r[1].dbObjectIDs:r[1],dbKey:null!=r[1]?r[1].dbKey:r[1]},data:a}))+"\n\t\t</tbody>\n"},compiler:[7,">= 4.0.0"],main:function(t,e,n,l,a,s,r){var u,o,i,d=null!=e?e:t.nullContext||{},c=n.helperMissing,h=t.escapeExpression,p="<table ";return o=null!=(o=n.generateId||(null!=e?e.generateId:e))?o:c,i={name:"generateId",hash:{},fn:t.program(1,a,0,s,r),inverse:t.noop,data:a},u="function"==typeof o?o.call(d,i):o,n.generateId||(u=n.blockHelperMissing.call(e,u,i)),null!=u&&(p+=u),p+' class="table table-hover '+h((o=null!=(o=n.class||(null!=e?e.class:e))?o:c,"function"==typeof o?o.call(d,{name:"class",hash:{},data:a}):o))+'" style="'+h((o=null!=(o=n.style||(null!=e?e.style:e))?o:c,"function"==typeof o?o.call(d,{name:"style",hash:{},data:a}):o))+'">\n'+(null!=(u=n.if.call(d,null!=(u=null!=e?e.header:e)?u.titles:u,{name:"if",hash:{},fn:t.program(3,a,0,s,r),inverse:t.noop,data:a}))?u:"")+(null!=(u=(n.withModule||e&&e.withModule||c).call(d,e,"inner",{name:"withModule",hash:{},fn:t.program(8,a,0,s,r),inverse:t.noop,data:a}))?u:"")+"</table>"},useData:!0,useDepths:!0})}();