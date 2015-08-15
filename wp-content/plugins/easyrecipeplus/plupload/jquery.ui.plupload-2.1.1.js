!function(t,e,i,l,s){function o(t){return i.translate(t)||t}function a(t){t.id=t.attr("id"),t.html('<div class="plupload_wrapper"><div class="ui-widget-content plupload_container"><div class="ui-state-default ui-widget-header plupload_header"><div class="plupload_header_content"><div class="plupload_logo"> </div><div class="plupload_header_title">'+o("Select files")+'</div><div class="plupload_header_text">'+o("Add files to the upload queue and click the start button.")+'</div><div class="plupload_view_switch"><input type="radio" id="'+t.id+'_view_list" name="view_mode_'+t.id+'" checked="checked" /><label class="plupload_button" for="'+t.id+'_view_list" data-view="list">'+o("List")+'</label><input type="radio" id="'+t.id+'_view_thumbs" name="view_mode_'+t.id+'" /><label class="plupload_button"  for="'+t.id+'_view_thumbs" data-view="thumbs">'+o("Thumbnails")+'</label></div></div></div><table class="plupload_filelist plupload_filelist_header ui-widget-header"><tr><td class="plupload_cell plupload_file_name">'+o("Filename")+'</td><td class="plupload_cell plupload_file_status">'+o("Status")+'</td><td class="plupload_cell plupload_file_size">'+o("Size")+'</td><td class="plupload_cell plupload_file_action">&nbsp;</td></tr></table><div class="plupload_content"><div class="plupload_droptext">'+o("Drag files here.")+'</div><ul class="plupload_filelist_content"> </ul><div class="plupload_clearer">&nbsp;</div></div><table class="plupload_filelist plupload_filelist_footer ui-widget-header"><tr><td class="plupload_cell plupload_file_name"><div class="plupload_buttons"><!-- Visible --><a class="plupload_button plupload_add">'+o("Add Files")+'</a>&nbsp;<a class="plupload_button plupload_start">'+o("Start Upload")+'</a>&nbsp;<a class="plupload_button plupload_stop plupload_hidden">'+o("Stop Upload")+'</a>&nbsp;</div><div class="plupload_started plupload_hidden"><!-- Hidden --><div class="plupload_progress plupload_right"><div class="plupload_progress_container"></div></div><div class="plupload_cell plupload_upload_status"></div><div class="plupload_clearer">&nbsp;</div></div></td><td class="plupload_file_status"><span class="plupload_total_status">0%</span></td><td class="plupload_file_size"><span class="plupload_total_file_size">0 kb</span></td><td class="plupload_file_action"></td></tr></table></div><input class="plupload_count" value="0" type="hidden"></div>')}var n={};s.widget("ui.plupload",{widgetEventPrefix:"",contents_bak:"",options:{browse_button_hover:"ui-state-hover",browse_button_active:"ui-state-active",dragdrop:!0,multiple_queues:!0,buttons:{browse:!0,start:!0,stop:!0},views:{list:!0,thumbs:!1,active:"list",remember:!0},autostart:!1,sortable:!1,rename:!1,max_file_count:0},FILE_COUNT_ERROR:-9001,_create:function(){var t=this.element.attr("id");t||(t=i.guid(),this.element.attr("id",t)),this.id=t,this.contents_bak=this.element.html(),a(this.element),this.container=s(".plupload_container",this.element).attr("id",t+"_container"),this.content=s(".plupload_content",this.element),s.fn.resizable&&this.container.resizable({handles:"s",minHeight:300}),this.filelist=s(".plupload_filelist_content",this.container).attr({id:t+"_filelist",unselectable:"on"}),this.browse_button=s(".plupload_add",this.container).attr("id",t+"_browse"),this.start_button=s(".plupload_start",this.container).attr("id",t+"_start"),this.stop_button=s(".plupload_stop",this.container).attr("id",t+"_stop"),this.thumbs_switcher=s("#"+t+"_view_thumbs"),this.list_switcher=s("#"+t+"_view_list"),s.ui.button&&(this.browse_button.button({icons:{primary:"ui-icon-circle-plus"},disabled:!0}),this.start_button.button({icons:{primary:"ui-icon-circle-arrow-e"},disabled:!0}),this.stop_button.button({icons:{primary:"ui-icon-circle-close"}}),this.list_switcher.button({text:!1,icons:{secondary:"ui-icon-grip-dotted-horizontal"}}),this.thumbs_switcher.button({text:!1,icons:{secondary:"ui-icon-image"}})),this.progressbar=s(".plupload_progress_container",this.container),s.ui.progressbar&&this.progressbar.progressbar(),this.counter=s(".plupload_count",this.element).attr({id:t+"_count",name:t+"_count"}),this._initUploader()},_initUploader:function(){var t,e=this,a=this.id,d={container:a+"_buttons",browse_button:a+"_browse"};s(".plupload_buttons",this.element).attr("id",a+"_buttons"),e.options.dragdrop&&(this.filelist.parent().attr("id",this.id+"_dropbox"),d.drop_element=this.id+"_dropbox"),t=this.uploader=n[a]=new i.Uploader(s.extend(this.options,d)),e.options.views.thumbs&&(t.settings.required_features.display_media=!0),t.bind("Error",function(t,s){var a,n="";switch(a="<strong>"+s.message+"</strong>",s.code){case i.FILE_EXTENSION_ERROR:n=l.sprintf(o("File: %s"),s.file.name);break;case i.FILE_SIZE_ERROR:n=l.sprintf(o("File: %s, size: %d, max file size: %d"),s.file.name,s.file.size,i.parseSize(e.options.max_file_size));break;case i.FILE_DUPLICATE_ERROR:n=l.sprintf(o("%s already present in the queue."),s.file.name);break;case e.FILE_COUNT_ERROR:n=l.sprintf(o("Upload element accepts only %d file(s) at a time. Extra files were stripped."),e.options.max_file_count);break;case i.IMAGE_FORMAT_ERROR:n=o("Image format either wrong or not supported.");break;case i.IMAGE_MEMORY_ERROR:n=o("Runtime ran out of available memory.");break;case i.HTTP_ERROR:n=o("Upload URL might be wrong or doesn't exist.")}a+=" <br /><i>"+n+"</i>",e._trigger("error",null,{up:t,error:s}),s.code===i.INIT_ERROR?setTimeout(function(){e.destroy()},1):e.notify("error",a)}),t.bind("PostInit",function(t){e.options.buttons.browse?e.browse_button.button("enable"):(e.browse_button.button("disable").hide(),t.disableBrowse(!0)),e.options.buttons.start||e.start_button.button("disable").hide(),e.options.buttons.stop||e.stop_button.button("disable").hide(),!e.options.unique_names&&e.options.rename&&e._enableRenaming(),e.options.dragdrop&&t.features.dragdrop&&e.filelist.parent().addClass("plupload_dropbox"),e._enableViewSwitcher(),e.start_button.click(function(t){s(this).button("option","disabled")||e.start(),t.preventDefault()}),e.stop_button.click(function(t){e.stop(),t.preventDefault()}),e._trigger("ready",null,{up:t})}),e.options.max_file_count&&(e.options.multiple_queues=!1,t.bind("FilesAdded",function(t,i){var l=i.length,s=t.files.length+l-e.options.max_file_count;s>0&&(i.splice(l-s,s),t.trigger("Error",{code:e.FILE_COUNT_ERROR,message:o("File count error.")}))})),t.init(),t.bind("FileFiltered",function(t,i){e._addFiles(i)}),t.bind("FilesAdded",function(t,i){e._trigger("selected",null,{up:t,files:i}),e.options.sortable&&s.ui.sortable&&e._enableSortingList(),e._trigger("updatelist",null,{filelist:e.filelist}),e.options.autostart&&setTimeout(function(){e.start()},10)}),t.bind("FilesRemoved",function(t,i){e._trigger("removed",null,{up:t,files:i})}),t.bind("QueueChanged StateChanged",function(){e._handleState()}),t.bind("UploadFile",function(t,i){e._handleFileStatus(i)}),t.bind("FileUploaded",function(t,i){e._handleFileStatus(i),e._trigger("uploaded",null,{up:t,file:i})}),t.bind("UploadProgress",function(t,i){e._handleFileStatus(i),e._updateTotalProgress(),e._trigger("progress",null,{up:t,file:i})}),t.bind("UploadComplete",function(t,i){e._addFormFields(),e._trigger("complete",null,{up:t,files:i})})},_setOption:function(t,e){var i=this;"buttons"==t&&"object"==typeof e&&(e=s.extend(i.options.buttons,e),e.browse?(i.browse_button.button("enable").show(),i.uploader.disableBrowse(!1)):(i.browse_button.button("disable").hide(),i.uploader.disableBrowse(!0)),e.start?i.start_button.button("enable").show():i.start_button.button("disable").hide(),e.stop?i.start_button.button("enable").show():i.stop_button.button("disable").hide()),i.uploader.settings[t]=e},start:function(){this.uploader.start(),this._trigger("start",null,{up:this.uploader})},stop:function(){this.uploader.stop(),this._trigger("stop",null,{up:this.uploader})},enable:function(){this.browse_button.button("enable"),this.uploader.disableBrowse(!1)},disable:function(){this.browse_button.button("disable"),this.uploader.disableBrowse(!0)},getFile:function(t){var e;return e="number"==typeof t?this.uploader.files[t]:this.uploader.getFile(t)},getFiles:function(){return this.uploader.files},removeFile:function(t){"string"===i.typeOf(t)&&(t=this.getFile(t)),this._removeFiles(t)},clearQueue:function(){this.uploader.splice()},getUploader:function(){return this.uploader},refresh:function(){this.uploader.refresh()},notify:function(t,e){var i=s('<div class="plupload_message"><span class="plupload_message_close ui-icon ui-icon-circle-close" title="'+o("Close")+'"></span><p><span class="ui-icon"></span>'+e+"</p></div>");i.addClass("ui-state-"+("error"===t?"error":"highlight")).find("p .ui-icon").addClass("ui-icon-"+("error"===t?"alert":"info")).end().find(".plupload_message_close").click(function(){i.remove()}).end(),s(".plupload_header",this.container).append(i)},destroy:function(){this._removeFiles([].slice.call(this.uploader.files)),this.uploader.destroy(),s(".plupload_button",this.element).unbind(),s.ui.button&&s(".plupload_add, .plupload_start, .plupload_stop",this.container).button("destroy"),s.ui.progressbar&&this.progressbar.progressbar("destroy"),s.ui.sortable&&this.options.sortable&&s("tbody",this.filelist).sortable("destroy"),this.element.empty().html(this.contents_bak),this.contents_bak="",s.Widget.prototype.destroy.apply(this)},_handleState:function(){var t=this.uploader;t.state===i.STARTED?(s(this.start_button).button("disable"),s([]).add(this.stop_button).add(".plupload_started").removeClass("plupload_hidden"),s(".plupload_upload_status",this.element).html(l.sprintf(o("Uploaded %d/%d files"),t.total.uploaded,t.files.length)),s(".plupload_header_content",this.element).addClass("plupload_header_content_bw")):t.state===i.STOPPED&&(s([]).add(this.stop_button).add(".plupload_started").addClass("plupload_hidden"),this.options.multiple_queues?s(".plupload_header_content",this.element).removeClass("plupload_header_content_bw"):(s([]).add(this.browse_button).add(this.start_button).button("disable"),t.disableBrowse()),t.files.length===t.total.uploaded+t.total.failed?this.start_button.button("disable"):this.start_button.button("enable"),this._updateTotalProgress()),0===t.total.queued?s(".ui-button-text",this.browse_button).html(o("Add Files")):s(".ui-button-text",this.browse_button).html(l.sprintf(o("%d files queued"),t.total.queued)),t.refresh()},_handleFileStatus:function(t){var e,l,o=this;if(s("#"+t.id).length){switch(t.status){case i.DONE:e="plupload_done",l="ui-icon ui-icon-circle-check";break;case i.FAILED:e="ui-state-error plupload_failed",l="ui-icon ui-icon-alert";break;case i.QUEUED:e="plupload_delete",l="ui-icon ui-icon-circle-minus";break;case i.UPLOADING:e="ui-state-highlight plupload_uploading",l="ui-icon ui-icon-circle-arrow-w";var a=s(".plupload_scroll",this.container),n=a.scrollTop(),d=a.height(),r=s("#"+t.id).position().top+s("#"+t.id).height();r>d&&a.scrollTop(n+r-d),s("#"+t.id).find(".plupload_file_percent").html(t.percent+"%").end().find(".plupload_file_progress").css("width",t.percent+"%").end().find(".plupload_file_size").html(i.formatSize(t.size))}e+=" ui-state-default plupload_file",s("#"+t.id).attr("class",e).find(".ui-icon").attr("class",l).end().filter(".plupload_delete, .plupload_done, .plupload_failed").find(".ui-icon").click(function(e){o._removeFiles(t),e.preventDefault()})}},_updateTotalProgress:function(){var t=this.uploader;this.filelist[0].scrollTop=this.filelist[0].scrollHeight,this.progressbar.progressbar("value",t.total.percent),this.element.find(".plupload_total_status").html(t.total.percent+"%").end().find(".plupload_total_file_size").html(i.formatSize(t.total.size)).end().find(".plupload_upload_status").html(l.sprintf(o("Uploaded %d/%d files"),t.total.uploaded,t.files.length))},_displayThumbs:function(){function t(t,e,i){var l;t.on(e,function(){clearTimeout(l),l=setTimeout(function(){clearTimeout(l),i()},300)})}function e(){if(!d||!r){var t=s(".plupload_file:eq(0)",p.filelist);d=t.outerWidth(!0),r=t.outerHeight(!0)}var e=p.content.width(),i=p.content.height();u=Math.floor(e/d),_=u*(Math.ceil(i/r)+1)}function i(){var t=Math.floor(p.content.scrollTop()/r)*u;c=s(".plupload_file",p.filelist).slice(t,t+_).filter(":not(.plupload_file_thumb_loaded)").get()}function o(){function l(){"thumbs"===p.view_mode&&(e(),i(),n())}s.fn.resizable&&t(p.container,"resize",l),t(p.window,"resize",l),t(p.content,"scroll",l),p.element.on("viewchanged selected",l),l()}function a(t,e){var i=new l.Image;i.onload=function(){var e=s("#"+t.id+" .plupload_file_thumb",p.filelist).html("");this.embed(e[0],{width:100,height:60,crop:!0,swf_url:l.resolveUrl(p.options.flash_swf_url),xap_url:l.resolveUrl(p.options.silverlight_xap_url)})},i.bind("embedded error",function(){s("#"+t.id,p.filelist).addClass("plupload_file_thumb_loaded"),this.destroy(),setTimeout(e,1)}),i.load(t.getSource())}function n(){"thumbs"!==p.view_mode||h||(i(),c.length&&(h=!0,a(p.getFile(s(c.shift()).attr("id")),function(){h=!1,n()})))}var d,r,u,p=this,_=0,c=[],h=!1;this.options.views.thumbs&&this.element.on("selected",function f(){p.element.off("selected",f),o()})},_addFiles:function(t){var e,o=this;e='<li class="plupload_file ui-state-default" id="%id%"><div class="plupload_file_thumb"><div class="plupload_file_dummy ui-widget-content"><span class="ui-state-disabled">%ext%</span></div></div><div class="plupload_file_name" title="%name%"><span class="plupload_file_namespan">%name%</span></div><div class="plupload_file_action"><div class="ui-icon"> </div></div><div class="plupload_file_size">%size% </div><div class="plupload_file_status"><div class="plupload_file_progress ui-widget-header" style="width: 0%"> </div><span class="plupload_file_percent">%percent% </span></div><div class="plupload_file_fields"> </div></li>',"array"!==i.typeOf(t)&&(t=[t]),s.each(t,function(t,s){var a=l.Mime.getFileExtension(s.name)||"none";o.filelist.append(e.replace(/%(\w+)%/g,function(t,e){return"size"===e?i.formatSize(s.size):"ext"===e?a:s[e]||""})),o._handleFileStatus(s)})},_removeFiles:function(t){var e=this,l=this.uploader;"array"!==i.typeOf(t)&&(t=[t]),s.ui.sortable&&this.options.sortable&&s("tbody",e.filelist).sortable("destroy"),s.each(t,function(t,e){s("#"+e.id).toggle("highlight",function(){this.remove()}),l.removeFile(e)}),l.files.length&&this.options.sortable&&s.ui.sortable&&this._enableSortingList(),this._trigger("updatelist",null,{filelist:this.filelist})},_addFormFields:function(){var t=this;s(".plupload_file_fields",this.filelist).html(""),i.each(this.uploader.files,function(e,l){var o="",a=t.id+"_"+l;e.target_name&&(o+='<input type="hidden" name="'+a+'_tmpname" value="'+i.xmlEncode(e.target_name)+'" />'),o+='<input type="hidden" name="'+a+'_name" value="'+i.xmlEncode(e.name)+'" />',o+='<input type="hidden" name="'+a+'_status" value="'+(e.status===i.DONE?"done":"failed")+'" />',s("#"+e.id).find(".plupload_file_fields").html(o)}),this.counter.val(this.uploader.files.length)},_viewChanged:function(t){this.options.views.remember&&s.cookie&&s.cookie("plupload_ui_view",t,{expires:7,path:"/"}),"IE"===l.Env.browser&&l.Env.version<7&&this.content.attr("style",'height:expression(document.getElementById("'+this.id+'_container").clientHeight - '+("list"===t?133:103)+");"),this.container.removeClass("plupload_view_list plupload_view_thumbs").addClass("plupload_view_"+t),this.view_mode=t,this._trigger("viewchanged",null,{view:t})},_enableViewSwitcher:function(){var t,e,l,o=this,a=s(".plupload_view_switch",this.container);i.each(["list","thumbs"],function(t){o.options.views[t]||a.find('[for="'+o.id+"_view_"+t+'"], #'+o.id+"_view_"+t).remove()}),e=a.find(".plupload_button"),1===e.length?(a.hide(),t=e.eq(0).data("view"),this._viewChanged(t)):s.ui.button&&e.length>1?(this.options.views.remember&&s.cookie&&(t=s.cookie("plupload_ui_view")),~i.inArray(t,["list","thumbs"])||(t=this.options.views.active),a.show().buttonset().find(".ui-button").click(function(e){t=s(this).data("view"),o._viewChanged(t),e.preventDefault()}),l=a.find('[for="'+o.id+"_view_"+t+'"]'),l.length&&l.trigger("click")):(a.show(),this._viewChanged(this.options.views.active)),this.options.views.thumbs&&this._displayThumbs()},_enableRenaming:function(){var t=this;this.filelist.dblclick(function(e){var i,l,o,a,n=s(e.target),d="";n.hasClass("plupload_file_namespan")&&(l=t.uploader.getFile(n.closest(".plupload_file")[0].id),a=l.name,o=/^(.+)(\.[^.]+)$/.exec(a),o&&(a=o[1],d=o[2]),i=s('<input class="plupload_file_rename" type="text" />').width(n.width()).insertAfter(n.hide()),i.val(a).blur(function(){n.show().parent().scrollLeft(0).end().next().remove()}).keydown(function(t){var e=s(this);-1!==s.inArray(t.keyCode,[13,27])&&(t.preventDefault(),13===t.keyCode&&(l.name=e.val()+d,n.html(l.name)),e.blur())})[0].focus())})},_enableSortingList:function(){var t=this;s(".plupload_file",this.filelist).length<2||(s("tbody",this.filelist).sortable("destroy"),this.filelist.sortable({items:".plupload_delete",cancel:"object, .plupload_clearer",stop:function(){var e=[];s.each(s(this).sortable("toArray"),function(i,l){e[e.length]=t.uploader.getFile(l)}),e.unshift(e.length),e.unshift(0),Array.prototype.splice.apply(t.uploader.files,e)}}))}})}(window,document,plupload,mOxie,jQuery);