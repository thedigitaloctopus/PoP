!function(){var t=Handlebars.template;(Handlebars.templates=Handlebars.templates||{})["script-latestcount"]=t({1:function(t,n,e,a,s){return'\t<script type="text/javascript">\n\t(function($){\n\t\tvar targets = $(\''+t.escapeExpression((e.latestCountTargets||n&&n.latestCountTargets||e.helperMissing).call(null!=n?n:{},n,{name:"latestCountTargets",hash:{},data:s}))+"');\n\t\ttargets.find('.pop-count').each(function() {\n\n\t\t\tvar count = $(this);\n\t\t\tvar plusone = parseInt(count.text()) + 1;\n\t\t\tcount.text(plusone);\n\n\t\t\t// Name: either singular (View 1 new project) or plural (View 3 new projects)\n\t\t\tif (plusone === 1) {\n\t\t\t\tcount.siblings('.pop-plural').addClass('hidden');\n\t\t\t\tcount.siblings('.pop-singular').removeClass('hidden');\n\t\t\t}\n\t\t\telse {\n\t\t\t\tcount.siblings('.pop-plural').removeClass('hidden');\n\t\t\t\tcount.siblings('.pop-singular').addClass('hidden');\n\t\t\t}\n\t\t});\n\t\ttargets.removeClass('hidden');\n\t})(jQuery);\n\t<\/script>\n"},compiler:[7,">= 4.0.0"],main:function(t,n,e,a,s){var l;return null!=(l=e.with.call(null!=n?n:{},null!=n?n.itemObject:n,{name:"with",hash:{},fn:t.program(1,s,0),inverse:t.noop,data:s}))?l:""},useData:!0})}();