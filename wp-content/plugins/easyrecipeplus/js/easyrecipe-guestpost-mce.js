/*! EasyRecipe Plus 3.2.2925 Copyright (c) 2014 BoxHill LLC */
!function(e){tinymce.create("tinymce.plugins.EasyRecipeGuestPost",{init:function(t,i){t.addCommand("WP_Link",function(){e(window).trigger("guestpostlink")}),i=i.replace(/js$/g,"images/"),t.onLoadContent.add(function(t,i){"mce_fullscreen"!==t.editorId&&e(window).trigger("guestpostloaded",[t,i])}),t.onSetContent.add(function(t,i){"mce_fullscreen"!==t.editorId||i.initial||e(window).trigger("guestpostloaded",[t,i])}),t.addButton("easyrecipeImage",{title:"Upload an image",image:i+"uploadimage.gif",onclick:function(){e(window).trigger("easyrecipeguestimage")}})},getInfo:function(){return{longname:"Guest Post",author:"The Orgasmic Chef",authorurl:"http://www.orgasmicchef.com",infourl:"http://www.easyrecipeplugin.com/",version:"1.0"}}}),tinymce.PluginManager.add("guestpost",tinymce.plugins.EasyRecipeGuestPost)}(jQuery);