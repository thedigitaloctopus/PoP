!function(){var n=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["formcomponent-featuredimage-inner"]=n({1:function(n,l,e,a,t){var s;return n.escapeExpression((s=null!=(s=e.id||(null!=l?l.id:l))?s:e.helperMissing,"function"==typeof s?s.call(null!=l?l:{},{name:"id",hash:{},data:t}):s))},3:function(n,l,e,a,t){var s,r=n.lambda,i=n.escapeExpression;return'\t\t\t<img src="'+i(r(null!=(s=null!=l?l.img:l)?s.src:s,l))+'" width="'+i(r(null!=(s=null!=l?l.img:l)?s.width:s,l))+'" height="'+i(r(null!=(s=null!=l?l.img:l)?s.height:s,l))+'" class="'+i(r(null!=(s=null!=l?l.classes:l)?s.img:s,l))+'">\n'},5:function(n,l,e,a,t){var s,r=n.lambda,i=n.escapeExpression;return'\t\t\t<img src="'+i(r(null!=(s=null!=l?l["default-img"]:l)?s.src:s,l))+'" width="'+i(r(null!=(s=null!=l?l["default-img"]:l)?s.width:s,l))+'" height="'+i(r(null!=(s=null!=l?l["default-img"]:l)?s.height:s,l))+'" class="'+i(r(null!=(s=null!=l?l.classes:l)?s.img:s,l))+'">\n'},7:function(n,l,e,a,t){var s,r=n.lambda,i=n.escapeExpression;return"\t\t\t<a "+(null!=(s=(e.generateId||l&&l.generateId||e.helperMissing).call(null!=l?l:{},{name:"generateId",hash:{group:"remove"},fn:n.program(1,t,0),inverse:n.noop,data:t}))?s:"")+' href="#" class="loggedin-btn pop-featuredimage-btn remove '+i(r(null!=(s=null!=l?l.classes:l)?s["remove-btn"]:s,l))+'"><span class="glyphicon glyphicon-remove-sign"></span> '+i(r(null!=(s=null!=l?l.titles:l)?s["btn-remove"]:s,l))+"</a>\n"},compiler:[7,">= 4.0.0"],main:function(n,l,e,a,t){var s,r,i,o=null!=l?l:{},u=e.helperMissing,d="function",m=n.lambda,p=n.escapeExpression,g='<div class="featuredimage-container pull-left" ';return r=null!=(r=e.generateId||(null!=l?l.generateId:l))?r:u,i={name:"generateId",hash:{},fn:n.program(1,t,0),inverse:n.noop,data:t},s=typeof r===d?r.call(o,i):r,e.generateId||(s=e.blockHelperMissing.call(l,s,i)),null!=s&&(g+=s),g+">\n\t<a "+(null!=(s=(e.generateId||l&&l.generateId||u).call(o,{name:"generateId",hash:{group:"set"},fn:n.program(1,t,0),inverse:n.noop,data:t}))?s:"")+' href="#" class="visible-loggedin">\n'+(null!=(s=e.if.call(o,null!=l?l.value:l,{name:"if",hash:{},fn:n.program(3,t,0),inverse:n.program(5,t,0),data:t}))?s:"")+'\t</a>\n\t<span class="visible-notloggedin">\n'+(null!=(s=e.if.call(o,null!=l?l.value:l,{name:"if",hash:{},fn:n.program(3,t,0),inverse:n.program(5,t,0),data:t}))?s:"")+'\t</span>\n\t<div class="'+p(m(null!=(s=null!=l?l.classes:l)?s.options:s,l))+' visible-loggedin">\n\t\t<a '+(null!=(s=(e.generateId||l&&l.generateId||u).call(o,{name:"generateId",hash:{group:"set"},fn:n.program(1,t,0),inverse:n.noop,data:t}))?s:"")+' href="#" class="loggedin-btn pop-featuredimage-btn set '+p(m(null!=(s=null!=l?l.classes:l)?s["set-btn"]:s,l))+'"><span class="glyphicon glyphicon-upload"></span> '+p(m(null!=(s=null!=l?l.titles:l)?s["btn-add"]:s,l))+"</a>\n"+(null!=(s=e.if.call(o,null!=l?l.value:l,{name:"if",hash:{},fn:n.program(7,t,0),inverse:n.noop,data:t}))?s:"")+'\t</div>\n\t<div class="'+p(m(null!=(s=null!=l?l.classes:l)?s.options:s,l))+' visible-notloggedin">\n\t\t'+(null!=(s=m(null!=(s=null!=l?l.titles:l)?s.usernotloggedin:s,l))?s:"")+'\n\t</div>\n</div>\n<input type="hidden" value="'+p((r=null!=(r=e.value||(null!=l?l.value:l))?r:u,typeof r===d?r.call(o,{name:"value",hash:{},data:t}):r))+'" name="'+p((r=null!=(r=e["formcomponent-name"]||(null!=l?l["formcomponent-name"]:l))?r:u,typeof r===d?r.call(o,{name:"formcomponent-name",hash:{},data:t}):r))+'" id="'+p((r=null!=(r=e.lastGeneratedId||(null!=l?l.lastGeneratedId:l))?r:u,typeof r===d?r.call(o,{name:"lastGeneratedId",hash:{},data:t}):r))+"-"+p((r=null!=(r=e["formcomponent-name"]||(null!=l?l["formcomponent-name"]:l))?r:u,typeof r===d?r.call(o,{name:"formcomponent-name",hash:{},data:t}):r))+'" class="form-control">\n<div class="clearfix"></div>'},useData:!0})}();