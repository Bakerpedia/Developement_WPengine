/*! EasyRecipe 3.2.2802 Copyright (c) 2014 BoxHill LLC */
!function(e){var n,t,i="mceNonEditable";tinymce.create("tinymce.plugins.EasyRecipe",{init:function(o,r){n=tinymce.VK||tinymce.util.VK,r=r.replace(/js$/g,"images/"),o.onSaveContent.add(function(){}),o.onLoadContent.add(function(n,t){"mce_fullscreen"!==n.editorId&&e(window).trigger("easyrecipeload",[n,t])}),o.onSetContent.add(function(n,t){"mce_fullscreen"!==n.editorId||t.initial||e(window).trigger("easyrecipeload",[n,t])}),o.addButton("easyrecipeEdit",{title:"Edit an EasyRecipe",image:r+"chef20edit.png",onclick:function(){e(window).trigger("easyrecipeedit")}}),o.addButton("easyrecipeAdd",{title:"Add an EasyRecipe",image:r+"chef20add.png",onclick:function(){e(window).trigger("easyrecipeadd")}}),o.addButton("easyrecipeTest",{title:"Test Rich Snippet Formatting at Google",image:r+"google.png",onclick:function(){""!==t.testURL&&window.open("http://www.google.com/webmasters/tools/richsnippets?url="+t.testURL)}}),o.onKeyDown.addToTop(function(t,o){function r(e){for(;e;){if(e.id===f)return e;e=e.parentNode}}function a(e){var n;if(1===e.nodeType){if(n=e.getAttribute(g),n&&"inherit"!==n)return n;if(n=e.contentEditable,"inherit"!==n)return n}return null}function c(e){for(var n;e;){if(n=a(e))return"false"===n?e:null;e=e.parentNode}}function d(e){function n(){var n,i,r=t.schema.getNonEmptyElements();for(i=new tinymce.dom.TreeWalker(o,t.getBody());(n=e?i.prev():i.next())&&!r[n.nodeName.toLowerCase()]&&!(3===n.nodeType&&tinymce.trim(n.nodeValue).length>0);)if("false"===a(n))return!0;return c(n)?!0:!1}var i,o,d;if(u.isCollapsed()){if(i=u.getRng(!0),o=i.startContainer,d=i.startOffset,o=r(o)||o,c(o))return!1;if(3==o.nodeType&&(e?d>0:d<o.nodeValue.length))return!0;if(1==o.nodeType&&(o=o.childNodes[d]||o),n())return!1}return!0}var s,l,u=t.selection,f="mce_noneditablecaret",p="contenteditable",g="data-mce-"+p;return o.keyCode!=n.BACKSPACE&&o.keyCode!=n.DELETE||d(o.keyCode==n.BACKSPACE)?o.keyCode!=n.LEFT&&o.keyCode!=n.RIGHT&&o.keyCode!=n.UP&&o.keyCode!=n.DOWN&&(s=t.selection.getNode(),l=e(s),l.hasClass(i))?tinymce.dom.Event.cancel(o):!0:(o.preventDefault(),!1)}),o.on("BeforeExecCommand",function(n){var i,r,a,c;return"mceInsertLink"===n.command&&t.isEntryDialog?(t.insertLink(n.value),void n.preventDefault()):void("mceInsertContent"===n.command&&(i=o.selection.getNode(),r=e(i),a=r.hasClass("easyrecipe")?r:r.parents(".easyrecipe"),a.length>0&&(c=e("<p>Stuff</p>").insertAfter(a),o.selection.select(c[0]))))}),o.onPreProcess.add(function(n,t){t.get&&e(".value-title, .ERRatingInner",t.node).html("#ERDeleteMe#")}),o.onPostProcess.add(function(e,n){n.get&&(n.content=n.content.replace(/#ERDeleteMe#/gi," "))})},getInfo:function(){return{longname:"EasyRecipe",author:"The Orgasmic Chef",authorurl:"http://www.orgasmicchef.com",infourl:"http://www.easyrecipeplugin.com/",version:"1.2"}}}),t=EASYRECIPE,tinymce.PluginManager.add("easyrecipe",tinymce.plugins.EasyRecipe)}(jQuery);