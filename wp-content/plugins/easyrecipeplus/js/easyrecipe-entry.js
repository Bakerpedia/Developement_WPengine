/*! EasyRecipe Plus 3.2.2925 Copyright (c) 2014 BoxHill LLC */
window.EASYRECIPE=window.EASYRECIPE||{},EASYRECIPE.widget=EASYRECIPE.widget||jQuery.widget,EASYRECIPE.button=EASYRECIPE.button||jQuery.fn.button,function(e){function i(e,i){var t;switch(ji.show(),Et.hide(),zi.show(),t=i.newTab?i.newTab.index():i.index){case 0:Et.css("right","10px"),Et.show();break;case 3:Et.css("right","inherit"),zi.hide(),Et.show();break;case 4:ji.hide()}}function t(){Tt.off("change",t),fn=!0}function n(e){return e?(e+="",e.replace(/&lt;/g,"<").replace(/&gt;/g,">").replace(/&amp;/g,"&").replace(/&nbsp;/g," ")):""}function a(i){return i?e("<div />").text(i).html():""}function r(i){return e.trim(a(i.val()))||!1}function s(){var e=Di.tabs("option","active");Di.tabs("option","active",++e)}function o(e){var i,t=/\[img +(.*?) *\/?\]/i,n=/\[url ([^\]]+)\](.*?\[\/url\])/i;for(i=t.exec(e);null!==i;)Bt.push(i[1]),e=e.replace(t,"[img:"+Bt.length+"]"),i=t.exec(e);for(i=n.exec(e);null!==i;)Yt.push(i[1]),e=e.replace(n,"[url:"+Yt.length+"]$2"),i=n.exec(e);return e}function l(e){var i,t,n=/\[img:(\d+)\]/i,a=/\[url:(\d+)\](.*?)\[\/url\]/i;for(t=n.exec(e);null!==t;)i=Bt[t[1]-1],e=e.replace(n,"[img "+i+"]"),t=n.exec(e);for(t=a.exec(e);null!==t;)i=Yt[t[1]-1],e=e.replace(a,"[url "+i+"]$2[/url]"),t=a.exec(e);return e}function c(e,i){var t,n,a,r,s,o,l,d,p,u,h,v,f,g,m,y,E,R,b,w,C,I,T,S,N,x=0,k=1,_=2,U=0,A="",P="<!-- START REPEAT ",L="<!-- START INCLUDEIF ",M="<!-- END INCLUDEIF ";for(t=e,i=i||{};;){if(s=t.length,o=t.indexOf("#",U),-1!==o&&(s=o,l=x),d=t.indexOf(P,U),-1!==d&&s>d&&(s=d,l=k),p=t.indexOf(L,U),-1!==p&&s>p&&(s=p,l=_),s===t.length)return A+t.substr(U);switch(u=s-U,A+=t.substr(U,u),U=s,l){case _:if(a=t.substr(U,44),r=kt.exec(a),null===r)break;if(h=r[1],v="!"!==h,f=r[2],g=M+h+f+" -->",m=g.length,y=t.indexOf(g),-1===y){U++;break}E=typeof i[f]!==rn&&i[f]!==!1,E===v?(R="<!-- START INCLUDEIF "+h+f+" -->",b=R.length,t=t.substr(0,U)+t.substr(U+b,y-U-b)+t.substr(y+m)):t=t.substr(0,U)+t.substr(y+m);break;case x:if(a=t.substr(U,22),r=_t.exec(a),null===r){A+="#",U++;continue}if(w=r[1],""!==i[w]&&!i[w]){A+="#"+w+"#",U+=w.length+2;continue}A+=i[w],U+=w.length+2;break;case k:if(a=t.substr(U,45),r=Ut.exec(a),null===r){A+="<",U++;continue}if(C=r[1],!(i[C]&&i[C]instanceof Array)){A+="<",U++;continue}if(U+=C.length+22,I=t.indexOf("<!-- END REPEAT "+C+" -->",U),-1===I){A+="<!-- START REPEAT "+C+" -->";continue}for(T=I-U,S=t.substr(U,T),N=i[C],n=0;n<N.length;n++)A+=c(S,N[n]);U+=C.length+T+20}}}function d(i){var t,n,a=e.trim(i.val()),r=0,s=0;if(hi.hide(),""===a)return!0;if(Hi=Pt.exec(a),null===Hi){if(Hi=Lt.exec(a),null===Hi)return hi.show(),!1;r=0,s=Hi[1]}else r=Hi[1]?parseInt(Hi[1],10):0,s=Hi[2]?parseInt(Hi[2],10):0;return 0===r&&0===s?i.val(""):(t=r>0?r+" hour":"",r>1&&(t+="s"),n=s>0?s+" min":"",s>1&&(n+="s"),i.val(e.trim(t+" "+n))),!0}function p(i){var t,n,a,r="";for(t=0;t<i.length;t++)n=i[t],3!==n.nodeType?1===n.nodeType&&n.childNodes.length>0&&(r+=p(n.childNodes)):(a=e.trim(n.nodeValue),""!==a&&(r+=a+"\n"));return r}function u(){var i;if(e(Qt,Kt).remove(),i=q.selection.getNode(),"#document"===i.nodeName&&(i=Mi[0]),"BODY"===i.nodeName.toUpperCase())e(i).hasClass("mceContentBody")||(i=Mi[0]),e(i).append("&nbsp;"+Jt);else{for(;i.parentNode&&"BODY"!==i.parentNode.nodeName.toUpperCase();)i=i.parentNode;i.parentNode?"DIV"===i.nodeName.toUpperCase()||"SPAN"===i.nodeName.toUpperCase()?e(i,Kt).after(Jt):e(i,Kt).before(Jt):(i=Mi[0],e(i).append("&nbsp;"+Jt))}return vt=-1,e(Qt,Kt)}function h(){}function v(i){switch(i.type){case"js":e("head").append(e('<script type="text/javascript">'+i.js+"</script>")),ki[i.f]();break;case"html":e(i.dest).html(i.html)}}function f(){Vi.unbind(an),$i.unbind(an),Li.dialog(nn),xt=!0,wi()}function g(i,t){var a,r,s,o="";for(r=i.recipe,"success"!==t&&(Li.dialog(nn),xt=!0,wi()),ii.val(n(r.recipe_title)),r.rating&&e.isNumeric(r.rating)&&ei.val(r.rating),un=r.recipe_image,di.val(""),r.author?ci.val(n(r.author)):ci.val(""),pi.val(r.cuisine||""),di.val(r.mealType||""),ui.val(""),ti.val(n(r.summary)),Hi=Dt.exec(r.prep_time),null!==Hi?(a=Hi[1]?Hi[1]+"h ":"",ri.val(a+Hi[2]+"m")):ri.val(n(r.prep_time)),Hi=Dt.exec(r.cook_time),null!==Hi?(a=Hi[1]?Hi[1]+"h ":"",si.val(a+Hi[2]+"m")):si.val(n(r.cook_time)),oi.val(n(r.yield)),et.val(n(r.serving_size)),r.nutrition?(s=r.nutrition,it.val(n(s.calories)),tt.val(n(s.totalFat)),nt.val(n(s.saturatedFat)),at.val(n(s.unsaturatedFat)),rt.val(n(s.transFat)),st.val(n(s.totalCarbohydrates)),ot.val(n(s.sugars)),lt.val(n(s.sodium)),ct.val(n(s.dietaryFiber)),dt.val(n(s.protein)),pt.val(n(s.cholesterol))):(it.val(n(r.calories)),tt.val(n(r.fat))),a=0;a<i.ingredients.length;a++)o+=Nt(n(i.ingredients[a]))+"\n";ni.val(o),ai.val(n(r.instructions.replace("\r",""))),ut.val(n(r.notes)),Ui.dialog("option","title","Update Recipe"),Li.dialog(nn),Gi.hide(),Ji.show(),Yi.hide(),""!==un&&Ct(un,Fi.length,!0),gi=u(),Ui.parent(".ui-dialog").css(Xt,Oi),Ui.dialog(qt,Xt,Oi),Ui.dialog(sn)}function m(){var i;Bi.show(),Vi.unbind(an),$i.unbind(an),i={action:"easyrecipeConvert",id:Ri,type:bi},e.post(ajaxurl,i,g,"json")}function y(i){var t,n,a,r,s,o,l,c,d,u,h,v,f,g=0,m="",y="",E="",R="",b=["instruction","method","cooking method","procedure","direction"],w=["ingredients?"],C=["note","cooking note"];for(h=e.parseJSON(ki.ingredients),v=e.parseJSON(ki.instructions),f=e.parseJSON(ki.notes),-1===e.inArray(h,w)&&w.push(h),o="^\\s*(?:"+w.join("|")+")",d=new RegExp(o,"i"),-1===e.inArray(v,b)&&w.push(v),s="^\\s*(?:"+b.join("|")+")",c=new RegExp(s,"i"),-1===e.inArray(f,C)&&C.push(f),l="^\\s*(?:"+C.join("|")+")\\s*$",u=new RegExp(l,"i"),r=e("<div>"+i+"</div>"),t=p(r[0].childNodes),t=t.split("\n"),n=0;n<t.length;n++)if(a=e.trim(t[n]),""!==a)if(c.test(a))g=2;else if(d.test(a))g=1;else if(u.test(a))g=3;else switch(g){case 0:m+=a+"\n";break;case 1:y+=a+"\n";break;case 2:E+=a+"\n";break;case 3:R+=a+"\n"}return{summary:m,ingredients:y,instructions:E,notes:R}}function E(i){var t,n=e(".easyrecipe",Kt),a=e("#divERSELRecipes").find("ul");a.empty(),n.each(function(n){t=e(".ERName",this).text(),""===t&&(t="Recipe "+(n+1)),a.append(e("<li>"+t+"</li>").click(function(){Pi.dialog(nn),Ci(i,n)}))}),Pi.parent(".ui-dialog").css(Xt,Oi),Pi.dialog(qt,Xt,Oi),Pi.dialog(sn)}function R(i,t,n){var a,r=function(){var i,t,n,a,r=e.data(this,"index");i=this.width/150,t=this.height/112,i=i>t?i:t,n=Math.floor(this.height/i),a=Math.floor(this.width/i),Fi[r].height(n),Fi[r].width(a),Fi[r].css("top",(112-n)/2),Fi[r].attr("src",this.src),0===r&&e("#ERDTabs").find(".divERNoPhotos").remove()};Wi.append('<div class="ERPhoto"><img style="position:relative" id="ERPhoto_'+t+'" /></div>'),Fi[t]=e("#ERPhoto_"+t,Wi),Fi[t].data("src",i),n&&(e(".ERPhoto",Wi).removeClass(on),Fi[t].parent().addClass(on),mt=t,un=i),""===bt&&(bt=i),a=new Image,e.data(a,"index",t),a.onload=r,a.src=i}function b(){R(gt.val(),Fi.length,!0),gt.val(""),ft.hide(),e(".divERNoPhotos").remove()}function w(e,i){var t,n=!1;for(t=0;t<Fi.length;t++)if(Fi[t].data("src")===e){n=!0;break}n||R(e,Fi.length,i)}function C(i,a){var r,s,l,c,d,p,g,b,C,I,T,S,N,x,k,_,U,A,P={},L="",M="",O="",H="";if(!i||1===i.which){if(i&&i.data===pn&&(a=pn,i=i.delegateTarget),typeof a===rn&&en>1)return en=e(".easyrecipe",Kt).length,E(i),void 0;if(gi=e(".easyrecipe",Kt),a===pn){for(g=0;g<gi.length;g++)if(gi[g]===i){vt=g;break}gi=e(i)}if(typeof a===rn&&typeof i===rn&&(vt=0),a!==dn&&gi.length>1&&(gi=e(gi[a]),vt=a),s=0,s=1,S=e.support.cors?"json":"jsonp",e.ajax(ln,{dataType:S,data:{v:ki.version,p:s,u:ki.wpurl},success:v,error:h}),X=!1,typeof tinyMCE!==rn&&tinyMCE.activeEditor&&!tinyMCE.activeEditor.isHidden()&&(X=!0),!X)return alert("You must use the Visual Editor to add or update an EasyRecipe"),void 0;if(ii.val(""),di.val(""),pi.val(""),ui.val(""),ci.val(""),ti.val(""),ri.val(""),si.val(""),oi.val(""),ni.val(""),ai.val(""),et.val(""),it.val(""),tt.val(""),nt.val(""),at.val(""),rt.val(""),st.val(""),ot.val(""),lt.val(""),ct.val(""),dt.val(""),pt.val(""),ut.val(""),a!==dn&&1===gi.length)Ui.dialog("option","title","Update Recipe"),Yi.hide(),Gi.hide(),Ji.show(),mi=!0;else{if(fi=q.getContent(),!xt&&(I=Mt.exec(fi)||Ot.exec(fi)||Ht.exec(fi),I||(r=e("#hasRecipe").is(":checked")),I||r))return r?(bi="recipress",Ri=ki.postID):(bi=I[2],Ri=I[3]),Bi.hide(),Vi.click(f),$i.click(m),p=Wt[bi],C=e("#txtERCNVText1",Li),C.html(C.html().replace("#plugin#",p)),Wi.html(""),mt=-1,Fi=[],Wi.html(cn),Li.parent(".ui-dialog").css(Xt,Oi),Li.dialog(qt,Xt,Oi),Li.dialog(sn),void 0;ki.isGuest&&(_=e("#inpERAuthor").val()||"",ci.val(_)),Gi.show(),Ji.hide(),Yi.show(),Ui.dialog("option","title","Add a New Recipe"),mi=!1,Ii!==!1?P=y(Ii):(k=q.selection.getContent(),k.length>20&&(P=y(k))),P.summary&&(L=P.summary),P.ingredients&&(M=P.ingredients),P.instructions&&(O=P.instructions),P.notes&&(H=P.notes),gi=u()}for(gi.find(".hiddenGrammarError, .hiddenSpellError, .hiddenSuggestion").each(function(){var i;e(this).parent(".mceItemHidden").length>0&&e(this).unwrap(),i=e(this).text(),e(this).replaceWith(i)}),U=gi,gi=e("<div>"+gi.html()+"</div>"),e("#inpERCuisine").autocomplete({source:e.parseJSON(ki.cuisines)}).autocomplete("widget").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />'),e("#inpERType").autocomplete({source:e.parseJSON(ki.recipeTypes)}).autocomplete("widget").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />'),fn=!1,Tt.off("change",t).on("change",t),vi=!1,e(".hrecipe",Kt).length>0&&confirm("This post is already hrecipe microformatted\n\nDo you want me to try to convert it to an EasyRecipe?")&&(vi=!0),Rt=a!==dn?gi.find(".endeasyrecipe").text():ki.version,""===Rt&&(Rt="2.2"),un=e('link[itemprop="image"]',gi).attr("href")||"",Wi.html(""),mt=-1,bt="",Fi=[],Kt.find("img").each(function(i){var t=!1;"3">Rt?e(this).hasClass("photo")&&(t=!0):t=this.src===un,R(this.src,i,t)}),d=Kt.contents().text(),I=jt.exec(d),N=Fi.length;null!==I;)c=Ft.exec(I[0]),null!==c&&(l=c[1],R(l,N),Rt>"3"?un===l&&(Fi[N].parent().addClass(on),mt=N):zt.test(I[0])&&(Fi[N].parent().addClass(on),mt=N,un=l),N++),I=jt.exec(d);""!==un&&w(un,!0),Ei=e("#set-post-thumbnail").find("img").attr("src"),Ei&&w(Ei,-1===mt),-1===mt&&Fi.length>0&&(mt=0,un=bt,Fi[0].parent().addClass(on)),Wi.click(function(i){"IMG"===i.target.nodeName&&(e(".ERPhoto",Wi).removeClass(on),e(i.target).parent().addClass(on),un=i.target.src)}),0===Fi.length?Wi.html(cn):-1===mt&&Fi[0].parent().addClass(on),Bt=[],Yt=[],x=gi.find(".ERName .fn").html()||gi.find(".ERName").html(),x&&""!==x?ii.val(o(n(x))):ii.val(o(n(e("#title").val()))),di.val(o(n(gi.find(".type").html()))),ci.val(o(n(gi.find(".author").html()))),""===ci.val()&&ci.val(o(e.parseJSON(ki.author))),pi.val(o(n(gi.find(".cuisine").html()))),ti.val(o(L+n(gi.find(".summary").html()))),Rt>"3"?(T=gi.find('time[itemprop="prepTime"]').html()||"",ri.val(n(T)),T=gi.find('time[itemprop="cookTime"]').html()||"",si.val(n(T))):(T=gi.find(".preptime").html()||"",I=At.exec(T),null!==I?ri.val(n(I[1])):ri.val(""),T=gi.find(".cooktime").html()||"",I=At.exec(T),null!==I?si.val(n(I[1])):si.val("")),oi.val(n(gi.find(".yield").html())),gi.find(".ingredients li").each(function(i,t){M+=e(t).hasClass(Zt)?"!"+o(n(t.innerHTML))+"\n":o(n(t.innerHTML))+"\n"}),ni.val(M),gi.find(".instructions li, .instructions .ERSeparator").each(function(i,t){b=e.trim(t.innerHTML.replace(/^[ 0-9.]*(.*)$/gi,"$1")),O+=e(t).hasClass(Zt)?"!"+b+"\n":b+"\n"}),ai.val(o(n(O))),et.val(n(gi.find(".servingSize").html())),it.val(n(gi.find(".calories").html())),tt.val(n(gi.find(".fat").html())),nt.val(n(gi.find(".saturatedFat").html())),at.val(n(gi.find(".unsaturatedFat").html())),rt.val(n(gi.find(".transFat").html())),st.val(n(gi.find(".carbohydrates").html())),ot.val(n(gi.find(".sugar").html())),lt.val(n(gi.find(".sodium").html())),ct.val(n(gi.find(".fiber").html())),dt.val(n(gi.find(".protein").html())),pt.val(n(gi.find(".cholesterol").html())),A=U.parent().prop("data-rating"),ei.val(e.isNumeric(A)?A:"5"),b=(n(gi.find(".ERNotes").html())||"").replace(/<\/p>\n*<p>/gi,"\n\n").replace(/(?:<p>|<\/p>)/gi,"").replace(/<br *\/?>/gi,"\n"),""===b&&""!==H&&(b=H),b=o(b),b=b.replace(/\[br(?: ?\/)?\]/gi,"\n"),ut.val(o(b)),It&&(It.name&&ii.val(o(n(It.name))),It.author&&ci.val(o(It.author)),It.summary&&ti.val(o(It.summary)),It.yield&&oi.val(n(It.yield)),It.type&&di.val(o(n(It.type))),It.cuisine&&pi.val(o(n(It.cuisine))),It.prepTime&&ri.val(n(It.prepTime)),It.cookTime&&si.val(n(It.cookTime)),It.summary&&ti.val(o(It.summary))),gi=U,Ui.parent(".ui-dialog").css(Xt,Oi),Ui.dialog(qt,Xt,Oi),Ui.dialog(sn),Ui.dialog("option","position","center")}}function I(i){return en=e(".easyrecipe",Kt).length,tn||0===en?(C(i,dn),void 0):(Ai.parent(".ui-dialog").css(Xt,Oi),Ai.dialog(qt,Xt,Oi),Ai.dialog(sn),void 0)}function T(){Ui.dialog(nn)}function S(){Pi.dialog(nn)}function N(){var e=confirm("Are you sure you want to delete this recipe?");e&&(gi.remove(),gi=!1,fn=!1),Ui.dialog(nn)}function x(){var i,t=e("#inpERPaste"),n=t.val();i=y(n),(0!==i.ingredients.length||0!==i.instructions.length)&&(Ii=n,t.val(""),It={name:l(a(ii.val())),author:l(r(ci)),yield:r(oi),type:l(r(di)),cuisine:l(r(pi)),summary:l(r(ti)),servesize:r(et),prepTime:ri.val(),cookTime:si.val()},fn=!1,Ui.dialog(nn),I(null))}function k(i){var t=e(i.target).parent(),n=t.parent();t.hasClass("easyrecipeAbove")?n.before(hn):n.after(hn),t.remove(),_()}function _(){var i,t,n;t=e("<div>"+Kt[0].body.innerHTML+"</div>"),t.find(".easyrecipeAbove,.easyrecipeBelow").remove(),i=t.find(".easyrecipe"),i.each(function(){var i=e(this);i.parent().hasClass("easyrecipeWrapper")&&i.unwrap(),wt(i)}),n=t.html(),q.setContent(n),i=Kt.find(".easyrecipe"),i.on("mousedown",null,pn,C),Kt.find(".ERInsertLine").on(an,k)}function U(e){var i,t,n,a,r;if(a=e.prev(),r=e.next(),t=0===a.length||a.hasClass("easyrecipe")||a.hasClass("easyrecipeWrapper"))try{t=!(e[0].previousSibling&&3===e[0].previousSibling.nodeType)}catch(s){}if(n=0===r.length||r.hasClass("easyrecipe")||r.hasClass("easyrecipeWrapper"))try{n=!(e[0].nextSibling&&3===e[0].nextSibling.nodeType)}catch(s){}(t||n)&&(e.wrap('<div class="easyrecipeWrapper mceNonEditable" />'),i=e.parent(),t&&(i.prepend('<div class="easyrecipeAbove mceNonEditable"><input class="ERInsertLine mceNonEditable" type="button" value="Insert line above" /></div>'),i.find("input").on(an,k),vn.push(i.find(".easyrecipeAbove")[0])),n&&(i.append('<div class="easyrecipeBelow mceNonEditable"><input class="ERInsertLine mceNonEditable" type="button" value="Insert line below" /></div>'),i.find("input").on(an,k)))}function A(i){e(".easyrecipeAbove,.easyrecipeBelow",i).remove(),e(".easyrecipe",i).unwrap()}function P(){var i=e(".easyrecipe",Kt);0!==i.length&&(i.on("mousedown",null,pn,C),_())}function L(){var i,t,n,s,o,p,u,h,v,f,g,m,y,E,R="",b="",w=0,C="",I=[];if(d(ri)&&d(si)){for(t=e.trim(ri.val()),""!==t?(Hi=Pt.exec(t),n=Hi[1]?parseInt(Hi[1],10):0,s=Hi[2]?parseInt(Hi[2],10):0,w=60*n+s,o=n>0?n+"H":"",p=s>0?s+"M":"",b="PT"+o+p):t=!1,i=e.trim(si.val()),""!==i?(Hi=Pt.exec(i),n=Hi[1]?parseInt(Hi[1],10):0,s=Hi[2]?parseInt(Hi[2],10):0,o=n>0?n+"H":"",p=s>0?s+"M":"",w+=60*n+s,R="PT"+o+p):i=!1,w>0?(n=Math.floor(w/60),s=w%60,o=n>0?n+" hour":"",n>1&&(o+="s"),p=s>0?s+" min":"",s>1&&(p+="s"),w=e.trim(o+" "+p),o=n>0?n+"H":"",p=s>0?s+"M":"",C="PT"+o+p):w=!1,u=ni.val().split("\n"),v=0;v<u.length;v++)h=u[v],""!==h&&("!"===h.charAt(0)?(f=!0,h=h.substr(1)):f=!1,I.push({ingredient:l(a(h)),hasHeading:f}));for(u=ai.val().split("\n"),m=[],g={INSTRUCTIONS:[]},v=0;v<u.length;v++)h=e.trim(u[v].replace(/^[ 0-9\.]*(.*)$/gi,"$1")),""!==h&&("!"===h.charAt(0)?((g.INSTRUCTIONS.length>0||g.heading)&&m.push(g),h=h.substr(1),g={},g.INSTRUCTIONS=[],g.heading=l(a(h))):g.INSTRUCTIONS.push({instruction:l(a(h))}));(g.INSTRUCTIONS.length>0||g.heading)&&m.push(g),h=r(ut),h&&(h=h.replace(/\n/g,"[br]")),y={version:ki.version,hasPhoto:""!==un,photoURL:un,name:l(a(ii.val())),author:l(r(ci)),preptime:t,cooktime:i,totaltime:w,preptimeISO:b,cooktimeISO:R,totaltimeISO:C,yield:r(oi),type:l(r(di)),cuisine:l(r(pi)),summary:l(r(ti)),servesize:r(et),calories:r(it),fat:r(tt),satfat:r(nt),unsatfat:r(at),transfat:r(rt),carbs:r(st),sugar:r(ot),sodium:r(lt),fiber:r(ct),protein:r(dt),cholesterol:r(pt),notes:l(h),rating:ei.length?ei.val():"0",INGREDIENTS:I,STEPS:m},""===y.name&&(y.name=!1),E=c(ki.recipeTemplate,y),vi&&e(".hrecipe",Kt).remove(),-1===vt?gi=e(Qt,Kt):(gi=e(".easyrecipe",Kt),gi.length>0&&(gi=e(gi[vt]))),gi.before(E),gi.remove(),gi=!1,ht.show(),fn=!1,Ui.dialog(nn),en=e(".easyrecipe",Kt).length,P()}}function M(i,t){var n,a;if(It=!1,tinymce.majorVersion>"3"){if(t.id!==li&&"wp_mce_fullscreen"!==t.id)return e("#"+t.controlManager.buttons.easyrecipeTest._id).hide(),e("#"+t.controlManager.buttons.easyrecipeEdit._id).hide(),e("#"+t.controlManager.buttons.easyrecipeAdd._id).hide(),void 0;t.id===li?(Kt=e("#"+li+"_ifr").contents(),Oi=1e4,n=e("#"+t.controlManager.buttons.easyrecipeTest._id),ht=e("#"+t.controlManager.buttons.easyrecipeEdit._id)):(Kt=e("#wp_mce_fullscreen_ifr").contents(),Oi=200001,n=e("#mce_fullscreen_easyrecipeTest"),ht=e("#mce_fullscreen_easyrecipeEdit"))}else{if(t.editorId!==li&&"wp_mce_fullscreen"!==t.editorId)return e("#"+t.editorId+"_easyrecipeTest").hide(),e("#"+t.editorId+"_easyrecipeEdit").hide(),e("#"+t.editorId+"_easyrecipeAdd").hide(),void 0;t.editorId===li?(Kt=e("#"+li+"_ifr").contents(),Oi=1e4,n=e("#"+li+"_easyrecipeTest"),ht=e("#"+li+"_easyrecipeEdit")):(Kt=e("#wp_mce_fullscreen_ifr").contents(),Oi=200001,n=e("#mce_fullscreen_easyrecipeTest"),ht=e("#mce_fullscreen_easyrecipeEdit"))}Mi=e("body",Kt),a=e(".easyrecipe",Kt),q=tinyMCE.activeEditor,a.each(function(){e(this).addClass("mceNonEditable"),e(".ERRatingOuter",this).remove(),e(".ERHDPrint",this).remove(),e(".ERLinkback",this).remove()}),en=a.length,en>0&&""!==ki.testURL?n.show():n.hide(),en>0?ht.show():ht.hide(),Kt.hasERCSS||(e("head",Kt).append('<link rel="stylesheet" type="text/css" href="'+ki.easyrecipeURL+'/css/easyrecipe-entry.css" />'),Kt.hasERCSS=!0),P()}function O(){Zi.toggleClass("ERNone"),Ki.toggleClass("ERContract")}function H(){qi.toggleClass("ERNone"),Xi.toggleClass("ERContract")}function D(i){var t,n,a,r;t=e("#ertmp_"+Gt,Kt),n=i.title?' title="'+i.title+'"':"",a=i.target?' target="'+i.target+'"':"",r='href="'+i.href+'"'+a+n,Yt.push(r),xi.val(Ni.substring(0,Ti)+"[url:"+Yt.length+"]"+Ni.substring(Ti,Si)+"[/url]"+Ni.substring(Si)),xi[0].focus(),t.remove()}function j(i){var t,n,a,r,s,o;ki.isEntryDialog&&(t=e("#ertmp_"+Gt,Kt),"string"==typeof i?a=e(i):(o=t.html(),"link"===o?(a=t.parent("a"),t=a):a=e(t.html())),a.is("a")&&(n=a.attr("href"),r=a.attr("title"),s=a.attr("target"),r=r?' title="'+r+'"':"",s=s?' target="'+s+'"':"",i='href="'+n+'"'+s+r,Yt.push(i),xi.val(Ni.substring(0,Ti)+"[url:"+Yt.length+"]"+Ni.substring(Ti,Si)+"[/url]"+Ni.substring(Si))),xi[0].focus(),t.remove())}function z(e,i){var t,n,a,r,s,o;n=e.sizes[i.size],a=n.url,s=n.width,o=n.height,R(a,Fi.length),t=Ni.substring(0,Ti),Bt.push('src="'+a+'" width="'+s+'" height="'+o+'"class="align'+i.align+'"'),"none"===i.link?t+="[img:"+Bt.length+"]":("file"===i.link?r=a:"post"===i.link?r=e.link:"custom"===i.link&&(r=i.linkUrl),Yt.push('href="'+r+'"'),t+="[url:"+Yt.length+"][img:"+Bt.length+"][/url]"),t+=Ni.substring(Si),xi.val(t),xi[0].focus()}function F(){var e;St||(St=wp.media({title:"Select Image",multiple:!1,library:{type:"image"},button:{text:"add image"}}),St.on("content:create:browse",function(i){e=i.view,i.view.options.display=!0}),St.on("select",function(){var i=St.state().get("selection"),t=e.sidebar.get("display").model.attributes,n=i.models[0].attributes;z(n,t)}),St.$el.addClass("ui-dialog")),St.open()}function W(){var i,t,n,a=!1;if($t){if($t.focus(),Ti=$t[0].selectionStart,Si=$t[0].selectionEnd,Ni=$t.val(),t=e(this),t.hasClass("ERIconBold")?(a="[b]",n="[/b]"):t.hasClass("ERIconUnderline")?(a="[u]",n="[/u]"):t.hasClass("ERIconItalic")?(a="[i]",n="[/i]"):t.hasClass("ERIconLineBreak")&&(a="[br]",n=""),a)return(Ti!==Si||""===n)&&$t.val(Ni.substring(0,Ti)+a+Ni.substring(Ti,Si)+n+Ni.substring(Si)),$t[0].focus(),void 0;if(t.hasClass("ERIconImage")&&(xi=$t,F()),t.hasClass("ERIconLink")){if(Ti===Si)return;xi=$t,Gt++,i=e('<div class="erdeleteme" id="ertmp_'+Gt+'">link</div>'),i.appendTo(Mi),q.selection.select(i[0].firstChild),q.nodeChanged(),ki.isGuest?ki.doLink():(q.execCommand("WP_Link",!1),e("#wp-link-wrap").addClass("ui-dialog"))}}}function Y(){It=!1,I()}function B(){It=!1,C()}function V(){en>0&&!ki.noHTMLWarn&&(ki.noHTMLWarn=!0,_i.parent(".ui-dialog").css(Xt,Oi),_i.dialog(qt,Xt,Oi),_i.dialog(sn))}function $(i){var t,n,a,r,s=e("#wp-preview",i.target).val();return"dopreview"===s?!0:0===en?!0:(a=tinyMCE.activeEditor&&!tinyMCE.activeEditor.isHidden(),a?n=e("<div>"+q.getContent()+"</div>"):(r=e("#wp-content-editor-container").find("textarea"),n=e("<div>"+r.val()+"</div>")),A(e(".easyrecipeWrapper",n)),e(".easyrecipe",n).removeClass("mceNonEditable"),t=e.trim(n.html()),a?q.setContent(t):r.val(t),!0)}function G(i){var t,n,a,r,s,o,l,c,d;d=e("#easyrecipe-snippet").find(".ERRSP"),l=d.find(".ERRSPStatus"),o=e.parseJSON(i),s=e(o.html),c=s.find("#ires .vsc"),0===c.length&&(c=s.find("#ires .rc")),0===c.length?(l.text("No snippet data returned from Google"),l.css("color","#f99")):(a=c.find("h3.r").text(),r=c.find(".s").html(),n=d.find(".ERRSPResult"),t="<h3>"+a+'</h3><div class="s">'+r+"</div>",n.html(t),l.hide(),d.find(".ERRSPResult .f.slp .csb").css("background-image",""))}function J(){}function Q(i){e.ajax({url:ajaxurl,type:"POST",data:{action:"easyrecipeSnippet",id:i},success:G,error:J})}function Z(i){var t;""!=i.target.innerHTML&&(t=e(i.target).find("img").attr("src"),t&&w(t,!1))}function K(i){var t,n,a,r;for(t=i[0],n=0;n<t.addedNodes.length;n++)if(a=e(t.addedNodes[n].innerHTML),r=a.find("img").attr("src")){w(r,!1);break}}var q,X,ei,ii,ti,ni,ai,ri,si,oi,li,ci,di,pi,ui,hi,vi,fi,gi,mi,yi,Ei,Ri,bi,wi,Ci,Ii,Ti,Si,Ni,xi,ki,_i,Ui,Ai,Pi,Li,Mi,Oi,Hi,Di,ji,zi,Fi,Wi,Yi,Bi,Vi,$i,Gi,Ji,Qi,Zi,Ki,qi,Xi,et,it,tt,nt,at,rt,st,ot,lt,ct,dt,pt,ut,ht,vt,ft,gt,mt,yt,Et,Rt,bt,wt,Ct,It,Tt,St,Nt=jQuery.trim,xt=!1,kt=/<!-- START INCLUDEIF (!?)([_a-z][_0-9a-z]{0,19}) -->/i,_t=/^#([_a-z][_0-9a-z]{0,19})#/im,Ut=/<!-- START REPEAT ([_a-zA-Z][_0-9a-zA-Z]{0,19}) -->/m,At=/^([^<]*)/,Pt=/^(?:([0-9]+) *(?:h|hr|hrs|hour|hours))? *(?:([0-9]+) *(?:m|mn|mns|min|mins|minute|minutes))?$/i,Lt=/^([0-9]+)$/,Mt=/(.*)\[amd-(recipeseo|zlrecipe)-recipe:([0-9]+)\](.*)/,Ot=/(.*)\[(yumprint)-recipe\s+id='(\d+)'\](.*)/i,Ht=/(.*)\[(gmc)_recipe\s+([0-9]+)\](.*)/,Dt=/PT(?:([0-9]*)+H)?([0-9]+)+M/i,jt=/\[(?:img) +(?:[^\]]+?)\]/gi,zt=/class\s*=\s*"(?:[^"]+ )?photo[ "]/i,Ft=/src\s*=\s*" *([^"]+?) *"/i,Wt={recipeseo:"Recipe SEO",ziplist:"ZipList",zlrecipe:"ZipList",yumprint:"Yumprint Recipe Card",recipress:"ReciPress",gmc:"GetMeCooking"},Yt=[],Bt=[],Vt="Switch to the Visual Editor to add or edit an EasyRecipe",$t=null,Gt=0,Jt='<div class="easyrecipeholder">EasyRecipe</div>',Qt=".easyrecipeholder",Zt="ERSeparator",Kt=null,qt="option",Xt="zIndex",en=0,tn=!0,nn="close",an="click",rn="undefined",sn="open",on="ERPhotoSelected",ln="http://www.easyrecipeplugin.com/checkUpdates.php",cn='<div class="divERNoPhotos">There are no photos in this post<br />Add photos anywhere in the post</div>',dn=-1,pn=-2,un="",hn="&nbsp;",vn=[],fn=!1;e(function(){var t,n,a,r,o,l=null;ki=EASYRECIPE,ki.button!==e.fn.button&&(l=e.fn.button,e.fn.button=ki.button),Ui=e("#easyrecipeEntry"),Pi=e("#easyrecipeSelect"),_i=e("#easyrecipeHTMLWarn"),li=ki.isGuest?"guestpost":"content",Pi.dialog({autoOpen:!1,width:340,modal:!0,dialogClass:"easyrecipeSelect",close:function(){e(".easyrecipeSelect").filter(function(){return""===e(this).text()}).remove()},open:function(){e(".ui-widget-overlay").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />')}}),e("#divERSELContainer").show(),Pi.parent(".ui-dialog").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />'),Ui.dialog({autoOpen:!1,width:655,modal:!0,dialogClass:"easyrecipeEntry",beforeClose:function(){if(fn){if(!window.confirm("Are you sure you want to close without saving the recipe?"))return!1;fn=!1}return!0},close:function(){ki.isEntryDialog=!1,gi&&!mi&&gi.remove(),gi=!1,e(".easyrecipeEntry").filter(function(){return""===e(this).text()}).remove()},open:function(){ki.isEntryDialog=!0,e(".ui-widget-overlay").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />'),Di.tabs({active:0,beforeActivate:i}),setTimeout(function(){var i=e(".easyrecipeEntry"),t=i.offset();t.top<yt&&(t.top=yt,i.offset(t))},250)}}),Ui.parent(".ui-dialog").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />'),Tt=e("#divERContainer").show(),_i.dialog({autoOpen:!1,width:420,modal:!0,dialogClass:"easyrecipeHTMLWarn",close:function(){e(".easyrecipeHTMLWarn").filter(function(){return""===e(this).text()}).remove()},open:function(){e(".ui-widget-overlay").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />')}}),_i.parent(".ui-dialog").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />'),e(".divERHTMLWarnContainer").show(),Li=e("#easyrecipeConvert"),Bi=e("#divERCNVSpinner"),Vi=e("#btnERCNVCancel"),$i=e("#btnERCNVOK"),Bi.hide(),Li.dialog({autoOpen:!1,width:390,modal:!0,dialogClass:"easyrecipeConvert",close:function(){e(".easyrecipeConvert").filter(function(){return""===e(this).text()}).remove()},open:function(){e(".ui-widget-overlay").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />')}}),e("#divERCNVContainer").show(),Li.parent(".ui-dialog").wrap('<div id="easyrecipeUI" class="easyrecipeUI" />'),e(window).bind("easyrecipeadd",Y),e(window).bind("easyrecipeedit",B),e(window).bind("easyrecipeload",M),e(window).bind("easyrecipeimage",z),e(window).bind("easyrecipeguestimageuploaded",z),zi=e("#divERNext"),ji=e("#btnERButtons"),Di=e("#ERDTabs"),Wi=e("#divERPhotos"),e("input:submit",".easyrecipeUI").button(),yi=e("#ed_toolbar"),ei=e("#inpERRating"),ii=e("#inpERName"),ci=e("#inpERAuthor"),di=e("#inpERType"),pi=e("#inpERCuisine"),ui=e("#inpERTags"),ti=e("textarea#taERSummary"),ni=e("textarea#taERIngredients"),ai=e("textarea#taERInstructions"),ri=e("#inpERPrepTime"),si=e("#inpERCookTime"),oi=e("#inpERYield"),et=e("#inpERServeSize"),it=e("#inpERCalories"),tt=e("#inpERFat"),nt=e("#inpERSatFat"),at=e("#inpERUnsatFat"),rt=e("#inpERTransFat"),st=e("#inpERCarbs"),ot=e("#inpERSugar"),lt=e("#inpERSodium"),ct=e("#inpERFiber"),dt=e("#inpERProtein"),pt=e("#inpERCholesterol"),ut=e("textarea#taERNotes"),ft=e("#divERAddImageURL"),o=e("#lnkERPhotoURL"),hi=e(".ERTimeError"),Gi=e("#divERAdd"),Ji=e("#divERChange"),Qi=e("#divERHeader"),Zi=e("#divEROther"),Ki=e("#divEROtherLabel"),qi=e("#divERNotes"),Xi=e("#divERNotesLabel"),Yi=e("#ERDPasteTab"),gt=e("#fldERAPUImageURL"),e("#btnERAdd").click(L),e("#btnERNext").click(s),e("#btnERChange").click(L),e("#btnERDelete").click(N),e("#btnERCancel").click(T),o.click(function(){ft.show(500)}),e("#btnERAIUCancel").click(function(){ft.hide()}),e("#btnERAIUOK").click(b),Ki.click(O),Xi.click(H),ri.change(function(i){d(e(i.target))}),si.change(function(i){d(e(i.target))}),e("#btnERPaste").click(x),e("#btnERSELCancel").click(S),yt=e("#wpadminbar").height(),Et=e("#divEREditBtns").on("mousedown","li",W),Tt.find('input[type="text"], textarea').on("blur",function(){$t=null}).on("focus",function(){$t=e(this)}),e("#wp-link").bind("wpdialogclose",j),ki.insertLink=D,wi=I,Ci=C,Ii=!1,ki.insertUploadedImage=z,wt=U,Ct=R,ki.addListener=P,_i.find("input").on(an,function(){_i.dialog(nn)}),e("#wp-content-editor-tools").on(an,"#content-html",V),e("#post").on("submit",$),null!==l&&(e.fn.button=l),a=e("#easyrecipe-snippet"),"none"!==a.css("display")&&(r=a.find(".ERRSPStatus").attr("postid"),r&&Q(r)),t=e("#postimagediv").find(".inside"),window.MutationObserver&&t.length>0?(n=new MutationObserver(K),n.observe(t[0],{childList:!0})):t.on("DOMSubtreeModified",Z),window.QTags&&QTags.addButton("easyrecipe","EasyRecipe",function(){alert(Vt)},"","","",900)})}(jQuery);