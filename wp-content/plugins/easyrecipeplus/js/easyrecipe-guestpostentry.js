/*! EasyRecipe Plus 3.2.2925 Copyright (c) 2014 BoxHill LLC */
window.EASYRECIPE=window.EASYRECIPE||{},function(e){function t(t){return e.trim(t.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/ /g,"%20"))}function i(e){return e.replace(/%20/g," ").replace(/&quot;/g,'"').replace(/&gt/g,">").replace(/&lt;/g,"<").replace(/&amp;/g,"&").replace(/%22/g,'"').replace(/%3C/gi,"<").replace(/%3E/gi,">")}function a(e){var i,a,l,n,o;switch(e.target.id){case"btnERGPLCancel":k.dialog(q);break;case"btnERGPLAdd":i=t(A.val()),a=t(Y.val()),""!==a&&(a=' title="'+a+'"'),l=O.is(":checked")?' target="_blank"':"",o=F||v.selection.getContent(),n='<a href="'+i+'"'+a+l+">"+o+"</a>",M.isEntryDialog?M.insertLink(n):v.selection.setContent(n),k.dialog(q)}}function l(){var e=v.selection.getNode();"A"===e.tagName.toUpperCase()?(A.val(i(e.href)),Y.val(i(e.title)),O.attr("checked","_blank"===e.target),v.selection.select(e),F=e.innerHTML):(A.val("http://"),Y.val(""),O.attr("checked",!0),F=!1),k.dialog(V,$,E).dialog(Q)}function n(){var t,i,a,l,n,o=v.selection.getNode();if(t=e(".ERGPAlignment input:radio[name=rbERGPAlign]:checked").val(),i=e(".ERGPSize input:radio[name=rbERGPSize]:checked").val(),"full"===i?(a=y.meta.width,l=y.meta.height,n=y.meta.file):(a=y.meta.sizes[i].width,l=y.meta.sizes[i].height,n=y.meta.sizes[i].file),g="aligncenter"===t?'<p style="text-align:center">':"",g+='<img class="'+t+" size-"+i+" wp-image-"+y.id+'"',g+=' title="'+x.val()+'"',g+=' alt="'+z.val()+'"',g+=' width="'+a+'"',g+=' height="'+l+'"',g+=' src="'+y.baseurl+n+'"',g+=" />",g+="aligncenter"===t?"</p>":"",M.isEntryDialog)M.insertUploadedImage(null,g);else if("#document"===o.nodeName&&(o=e("body",m)[0]),"BODY"===o.nodeName.toUpperCase())e(o).hasClass("mceContentBody")||(o=e("body",m)[0]),e(o).append("&nbsp;"+g);else{for(;o.parentNode&&"BODY"!==o.parentNode.nodeName.toUpperCase();)o=o.parentNode;o.parentNode?"DIV"===o.nodeName.toUpperCase()||"SPAN"===o.nodeName.toUpperCase()?e(o,m).after(g):e(o,m).before(g):(o=e("body",m)[0],e(o).append(g))}d.dialog("close")}function o(t,i){return f=!1,typeof tinyMCE!==J&&tinyMCE.activeEditor&&!tinyMCE.activeEditor.isHidden()&&(f=!0),f?(v=tinyMCE.activeEditor,i.editorId===h?(m=e("#"+h+"_ifr").contents(),E=1e4):(m=e("#mce_fullscreen_ifr").contents(),E=200001),void 0):(alert("You must use the Visual Editor to add or update an EasyRecipe"),void 0)}function r(){var t="html5,flash,silverlight,html4";b.hide(),P.hide(),p.show(),w.show(),G.text(""),x.val(""),z.val(""),U.val(""),d.dialog(V,$,E),d.dialog(Q),B.hide(),e("#ERGPplupload").html(""),plupload.VERSION&&plupload.ua&&"1.5.4"==plupload.VERSION&&plupload.ua.gecko&&(t="flash,silverlight,html4"),K=new plupload.Uploader({runtimes:t,browse_button:"btnERGPSelect",max_file_size:"10mb",container:"easyrecipeUpload",url:ajaxurl,flash_swf_url:M.wpurl+"/wp-includes/js/plupload/plupload.flash.swf",silverlight_xap_url:M.wpurl+"/wp-includes/js/plupload/plupload.silverlight.xap",multipart_params:{postID:R,action:"easyrecipeUpload"},filters:[{title:"Image files",extensions:"jpg,gif,png"}]}),K.init(),K.bind("FilesAdded",function(e,t){G.text("File: "+t[0].name),T.text(0),u.show(),p.hide(),b.show(),K.start()}),K.bind("UploadProgress",function(e,t){T.text(t.percent),u.progressbar("value",t.percent),100===t.percent&&B.show()}),K.bind("Error",function(e){e.refresh()}),K.bind("FileUploaded",function(t,i,a){var l,n,o,r,s,d;y=e.parseJSON(a.response),w.hide(),P.show(),y.meta.sizes.thumbnail?(l=y.meta.sizes.thumbnail.file,r=y.meta.sizes.thumbnail.width,s=y.meta.sizes.thumbnail.height):(l=y.meta.file,s=y.meta.height,r=y.meta.width),j.attr("src",y.baseurl+l),s=130*s/r,j.css("top",Math.floor((140-s)/2)),y.postID&&e('.ERGuestPost form input[name="postID"]').val(y.postID);for(n in W)W.hasOwnProperty(n)&&(o=W[n],y.meta.sizes[n]?(o.attr(X,!1),o.next("span").text(" ("+y.meta.sizes[n].width+" x "+y.meta.sizes[n].height+")")):(o.attr(X,!0),o.next("span").text("")));W.medium.attr(X)?I.attr(Z,!0):W.medium.attr(Z,!0),C.text(" ("+y.meta.width+" x "+y.meta.height+")"),d=y.meta,e("#divERGPFIName").text(d.file),e("#divERGPFIDim").text(d.width+" x "+d.height),e("#divERGPFISize").text(d.filesize),B.hide()}),K.refresh()}function s(){var t,i,a,l=!1;t=e("#spnERGPNameErr"),i=e("#spnERGPURLErr"),a=e("#spnERGPEmailErr"),t.text(""),i.text(""),i.text(""),""===e.trim(S.val())&&(t.text("You must enter your name"),l=!0),""===e.trim(_.val())?(a.text("You must enter your email"),l=!0):et.test(e.trim(_.val()))||(a.text("You must enter a valid email address"),l=!0),""===e.trim(D.val())&&(i.text("You must enter your website URL"),l=!0),l||(N.hide(),L.show())}var d,p,u,c,m,h,g,E,v,f,R,P,w,b,G,y,x,z,U,I,C,k,N,L,S,_,D,A,Y,O,F,M,T,j,B,V="option",$="zIndex",q="close",H="click",J="undefined",Q="open",K=null,W={},X="disabled",Z="checked",et=/[a-z0-9!#$%&'*+\/=?\^_`{|}~\-]+(?:\.[a-z0-9!#$%&'*+\/=?\^_`{|}~\-]+)*@(?:[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9\-]*[a-z0-9])?/i;e(function(){var t;M=EASYRECIPE,d=e("#easyrecipeUpload"),k=e("#easyrecipeLinks"),d.dialog({autoOpen:!1,width:500,height:600,title:"Upload an image",modal:!0,dialogClass:"easyrecipeUpload",close:function(){e(".easyrecipeUpload").filter(function(){return""===e(this).text()}).remove(),K&&(K.destroy(),K=null)},open:function(){p.show(),u.progressbar("value",0),e(".ui-widget-overlay").wrap('<div class="easyrecipeUI" />')}}),d.parent(".ui-dialog").wrap('<div class="easyrecipeUI" />'),e('input[type="button"]',k).button(),e("#divERGPLBtns").on(H,"input",a),k.dialog({autoOpen:!1,width:480,title:"Insert/edit link",modal:!0,dialogClass:"easyrecipeLinks",close:function(){e(".easyrecipeLinks").filter(function(){return""===e(this).text()}).remove()},open:function(){e(".ui-widget-overlay").wrap('<div class="easyrecipeUI" />')}}),k.parent(".ui-dialog").wrap('<div class="easyrecipeUI" />'),P=e("#divERGPUploaded"),w=e("#divERGPUploadContainer"),b=e("#divERGPUploading"),G=e("#divERGPFile"),x=e("#inpERGPTitle"),z=e("#inpERGPAltText"),U=e("#inpERGPLinkURL"),p=e("#btnERGPSelect").button(),O=e("#cbERGPLTarget"),Y=e("#fldERGPLTitle"),A=e("#fldERGPLURL"),L=e("#divERGPPost"),N=e("#divERGPData"),S=e("#fldERGPName"),_=e("#fldERGPEmail"),D=e("#fldERGPURL"),W.thumbnail=e('.ERGPSize input[value="thumbnail"]'),W.medium=e('.ERGPSize input[value="medium"]'),W.large=e('.ERGPSize input[value="large"]'),I=e('.ERGPSize input[value="full"]'),C=I.next("span"),c=e("#btnERGPInsert").button().on(H,n),u=e("#divERGPProgress").progressbar().hide(),e(window).bind("easyrecipeguestimage",r),e(window).bind("guestpostloaded",o),e(window).bind("guestpostlink",l),e(".wp-media-buttons").hide(),R=e("#ERGPpostID").val(),h=e(".wp-editor-wrap").attr("id").replace(/^wp-(.*)-wrap$/gi,"$1"),e(".ERGuestPost .ERGPButton").button(),e("#btnERGPContinue").on(H,s),j=e("#imgERGPThumb"),T=e("#spnERGComplete"),B=e("#divERGPSpinner"),M.isGuest=!0,M.doLink=l,M.doUpload=r,t=e("#inpERGPAuthor").val(),t&&(M.author='"'+t+'"')})}(jQuery);