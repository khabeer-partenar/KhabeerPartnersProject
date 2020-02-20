var Layout=function(){var e="layouts/layout/img/",a="layouts/layout/css/",t=App.getResponsiveBreakpoint("md"),i=[],s=[],o=function(){var e,a=$(".page-content"),i=$(".page-sidebar"),s=$("body");if(s.hasClass("page-footer-fixed")===!0&&s.hasClass("page-sidebar-fixed")===!1){var o=App.getViewPort().height-$(".page-footer").outerHeight()-$(".page-header").outerHeight(),n=i.outerHeight();n>o&&(o=n+$(".page-footer").outerHeight()),a.height()<o&&a.css("min-height",o)}else{if(s.hasClass("page-sidebar-fixed"))e=l(),s.hasClass("page-footer-fixed")===!1&&(e-=$(".page-footer").outerHeight());else{var r=$(".page-header").outerHeight(),d=$(".page-footer").outerHeight();e=App.getViewPort().width<t?App.getViewPort().height-r-d:i.height()+20,e+r+d<=App.getViewPort().height&&(e=App.getViewPort().height-r-d)}a.css("min-height",e)}},n=function(e,a,i){var s=location.hash.toLowerCase(),o=$(".page-sidebar-menu");if("click"===e||"set"===e?a=$(a):"match"===e&&o.find("li > a").each(function(){var e=$(this).attr("ui-sref");if(i&&e){if(i.is(e))return void(a=$(this))}else{var t=$(this).attr("href");if(t&&(t=t.toLowerCase(),t.length>1&&s.substr(1,t.length-1)==t.substr(1)))return void(a=$(this))}}),a&&0!=a.size()&&"javascript:;"!=a.attr("href")&&"javascript:;"!=a.attr("ui-sref")&&"#"!=a.attr("href")&&"#"!=a.attr("ui-sref")){parseInt(o.data("slide-speed")),o.data("keep-expanded");o.hasClass("page-sidebar-menu-hover-submenu")===!1?o.find("li.nav-item.open").each(function(){var e=!1;$(this).find("li").each(function(){var t=$(this).attr("ui-sref");if(i&&t){if(i.is(t))return void(e=!0)}else if($(this).find(" > a").attr("href")===a.attr("href"))return void(e=!0)}),e!==!0&&($(this).removeClass("open"),$(this).find("> a > .arrow.open").removeClass("open"),$(this).find("> .sub-menu").slideUp())}):o.find("li.open").removeClass("open"),o.find("li.active").removeClass("active"),o.find("li > a > .selected").remove(),a.parents("li").each(function(){$(this).addClass("active"),$(this).find("> a > span.arrow").addClass("open"),1===$(this).parent("ul.page-sidebar-menu").size()&&$(this).find("> a").append('<span class="selected"></span>'),1===$(this).children("ul.sub-menu").size()&&$(this).addClass("open")}),"click"===e&&App.getViewPort().width<t&&$(".page-sidebar").hasClass("in")&&$(".page-header .responsive-toggler").click()}},r=function(){$(".page-sidebar-mobile-offcanvas .responsive-toggler").click(function(e){$("body").toggleClass("page-sidebar-mobile-offcanvas-open"),e.preventDefault(),e.stopPropagation()}),$("body").hasClass("page-sidebar-mobile-offcanvas")&&$(document).on("click",function(e){$("body").hasClass("page-sidebar-mobile-offcanvas-open")&&0===$(e.target).closest(".page-sidebar-mobile-offcanvas .responsive-toggler").length&&0===$(e.target).closest(".page-sidebar-wrapper").length&&($("body").removeClass("page-sidebar-mobile-offcanvas-open"),e.preventDefault(),e.stopPropagation())}),$(".page-sidebar-menu").on("click","li > a.nav-toggle, li > a > span.nav-toggle",function(e){var a=$(this).closest(".nav-item").children(".nav-link");if(!(App.getViewPort().width>=t&&!$(".page-sidebar-menu").attr("data-initialized")&&$("body").hasClass("page-sidebar-closed")&&1===a.parent("li").parent(".page-sidebar-menu").size())){var i=a.next().hasClass("sub-menu");if(!(App.getViewPort().width>=t&&1===a.parents(".page-sidebar-menu-hover-submenu").size())){if(i===!1)return void(App.getViewPort().width<t&&$(".page-sidebar").hasClass("in")&&$(".page-header .responsive-toggler").click());var s=a.parent().parent(),n=a,r=$(".page-sidebar-menu"),l=a.next(),d=r.data("auto-scroll"),p=parseInt(r.data("slide-speed")),c=r.data("keep-expanded");c||(s.children("li.open").children("a").children(".arrow").removeClass("open"),s.children("li.open").children(".sub-menu:not(.always-open)").slideUp(p),s.children("li.open").removeClass("open"));var h=-200;l.is(":visible")?($(".arrow",n).removeClass("open"),n.parent().removeClass("open"),l.slideUp(p,function(){d===!0&&$("body").hasClass("page-sidebar-closed")===!1&&($("body").hasClass("page-sidebar-fixed")?r.slimScroll({scrollTo:n.position().top}):App.scrollTo(n,h)),o()})):i&&($(".arrow",n).addClass("open"),n.parent().addClass("open"),l.slideDown(p,function(){d===!0&&$("body").hasClass("page-sidebar-closed")===!1&&($("body").hasClass("page-sidebar-fixed")?r.slimScroll({scrollTo:n.position().top}):App.scrollTo(n,h)),o()})),e.preventDefault()}}}),App.isAngularJsApp()&&$(".page-sidebar-menu li > a").on("click",function(e){App.getViewPort().width<t&&$(this).next().hasClass("sub-menu")===!1&&$(".page-header .responsive-toggler").click()}),$(".page-sidebar").on("click"," li > a.ajaxify",function(e){e.preventDefault(),App.scrollTop();var a=$(this).attr("href"),i=$(".page-sidebar ul");i.children("li.active").removeClass("active"),i.children("arrow.open").removeClass("open"),$(this).parents("li").each(function(){$(this).addClass("active"),$(this).children("a > span.arrow").addClass("open")}),$(this).parents("li").addClass("active"),App.getViewPort().width<t&&$(".page-sidebar").hasClass("in")&&$(".page-header .responsive-toggler").click(),Layout.loadAjaxContent(a,$(this))}),$(".page-content").on("click",".ajaxify",function(e){e.preventDefault(),App.scrollTop();var a=$(this).attr("href");App.getViewPort().width<t&&$(".page-sidebar").hasClass("in")&&$(".page-header .responsive-toggler").click(),Layout.loadAjaxContent(a)}),$(document).on("click",".page-header-fixed-mobile .page-header .responsive-toggler",function(){App.scrollTop()}),p(),$(".page-sidebar").on("click",".sidebar-search .remove",function(e){e.preventDefault(),$(".sidebar-search").removeClass("open")}),$(".page-sidebar .sidebar-search").on("keypress","input.form_control",function(e){if(13==e.which)return $(".sidebar-search").submit(),!1}),$(".sidebar-search .submit").on("click",function(e){e.preventDefault(),$("body").hasClass("page-sidebar-closed")&&$(".sidebar-search").hasClass("open")===!1?(1===$(".page-sidebar-fixed").size()&&$(".page-sidebar .sidebar-toggler").click(),$(".sidebar-search").addClass("open")):$(".sidebar-search").submit()}),0!==$(".sidebar-search").size()&&($(".sidebar-search .input-group").on("click",function(e){e.stopPropagation()}),$("body").on("click",function(){$(".sidebar-search").hasClass("open")&&$(".sidebar-search").removeClass("open")}))},l=function(){var e=App.getViewPort().height-$(".page-header").outerHeight(!0);return $("body").hasClass("page-footer-fixed")&&(e-=$(".page-footer").outerHeight()),e},d=function(){var e=$(".page-sidebar-menu");return o(),0===$(".page-sidebar-fixed").size()?void App.destroySlimScroll(e):void(App.getViewPort().width>=t&&!$("body").hasClass("page-sidebar-menu-not-fixed")&&(e.attr("data-height",l()),App.destroySlimScroll(e),App.initSlimScroll(e),o()))},p=function(){$("body").hasClass("page-sidebar-fixed")&&$(".page-sidebar").on("mouseenter",function(){$("body").hasClass("page-sidebar-closed")&&$(this).find(".page-sidebar-menu").removeClass("page-sidebar-menu-closed")}).on("mouseleave",function(){$("body").hasClass("page-sidebar-closed")&&$(this).find(".page-sidebar-menu").addClass("page-sidebar-menu-closed")})},c=function(){$("body").on("click",".sidebar-toggler",function(e){var a=$("body"),t=$(".page-sidebar"),i=$(".page-sidebar-menu");$(".sidebar-search",t).removeClass("open"),a.hasClass("page-sidebar-closed")?(a.removeClass("page-sidebar-closed"),i.removeClass("page-sidebar-menu-closed"),Cookies&&Cookies.set("sidebar_closed","0")):(a.addClass("page-sidebar-closed"),i.addClass("page-sidebar-menu-closed"),a.hasClass("page-sidebar-fixed")&&i.trigger("mouseleave"),Cookies&&Cookies.set("sidebar_closed","1")),$(window).trigger("resize")})},h=function(){$(".page-header").on("click",'.hor-menu a[data-toggle="tab"]',function(e){e.preventDefault();var a=$(".hor-menu .nav"),t=a.find("li.current");$("li.active",t).removeClass("active"),$(".selected",t).remove();var i=$(this).parents("li").last();i.addClass("current"),i.find("a:first").append('<span class="selected"></span>')}),$(".page-header").on("click",".search-form",function(e){$(this).addClass("open"),$(this).find(".form_control").focus(),$(".page-header .search-form .form_control").on("blur",function(e){$(this).closest(".search-form").removeClass("open"),$(this).unbind("blur")})}),$(".page-header").on("keypress",".hor-menu .search-form .form_control",function(e){if(13==e.which)return $(this).closest(".search-form").submit(),!1}),$(".page-header").on("mousedown",".search-form.open .submit",function(e){e.preventDefault(),e.stopPropagation(),$(this).closest(".search-form").submit()}),$(document).on("click",".mega-menu-dropdown .dropdown-menu",function(e){e.stopPropagation()})},u=function(){$("body").on("shown.bs.tab",'a[data-toggle="tab"]',function(){o()})},g=function(){var e=300,a=500;navigator.userAgent.match(/iPhone|iPad|iPod/i)?$(window).bind("touchend touchcancel touchleave",function(t){$(this).scrollTop()>e?$(".scroll-to-top").fadeIn(a):$(".scroll-to-top").fadeOut(a)}):$(window).scroll(function(){$(this).scrollTop()>e?$(".scroll-to-top").fadeIn(a):$(".scroll-to-top").fadeOut(a)}),$(".scroll-to-top").click(function(e){return e.preventDefault(),$("html, body").animate({scrollTop:0},a),!1})},f=function(){$(".full-height-content").each(function(){var e,a=$(this);if(e=App.getViewPort().height-$(".page-header").outerHeight(!0)-$(".page-footer").outerHeight(!0)-$(".page-title").outerHeight(!0)-$(".page-bar").outerHeight(!0),a.hasClass("portlet")){var i=a.find(".portlet-body");App.destroySlimScroll(i.find(".full-height-content-body")),e=e-a.find(".portlet-title").outerHeight(!0)-parseInt(a.find(".portlet-body").css("padding-top"))-parseInt(a.find(".portlet-body").css("padding-bottom"))-5,App.getViewPort().width>=t&&a.hasClass("full-height-content-scrollable")?(e-=35,i.find(".full-height-content-body").css("height",e),App.initSlimScroll(i.find(".full-height-content-body"))):i.css("min-height",e)}else App.destroySlimScroll(a.find(".full-height-content-body")),App.getViewPort().width>=t&&a.hasClass("full-height-content-scrollable")?(e-=35,a.find(".full-height-content-body").css("height",e),App.initSlimScroll(a.find(".full-height-content-body"))):a.css("min-height",e)})};return{initHeader:function(){h()},setSidebarMenuActiveLink:function(e,a){n(e,a,null)},setAngularJsSidebarMenuActiveLink:function(e,a,t){n(e,a,t)},initSidebar:function(e){d(),r(),c(),App.isAngularJsApp()&&n("match",null,e),App.addResizeHandler(d)},initContent:function(){f(),u(),App.addResizeHandler(o),App.addResizeHandler(f)},initFooter:function(){g()},init:function(){this.initHeader(),this.initSidebar(null),this.initContent(),this.initFooter()},loadAjaxContent:function(e,a){var t=$(".page-content .page-content-body");App.startPageLoading({animate:!0}),$.ajax({type:"GET",cache:!1,url:e,dataType:"html",success:function(e){App.stopPageLoading(),t.html(e);for(var s=0;s<i.length;s++)i[s].call(e);a.size()>0&&0===a.parents("li.open").size()&&$(".page-sidebar-menu > li.open > a").click(),Layout.fixContentHeight(),App.initAjax()},error:function(e,a,i){App.stopPageLoading(),t.html("<h4>Could not load the requested content.</h4>");for(var o=0;o<s.length;o++)s[o].call(e)}})},addAjaxContentSuccessCallback:function(e){i.push(e)},addAjaxContentErrorCallback:function(e){s.push(e)},fixContentHeight:function(){o()},initFixedSidebarHoverEffect:function(){p()},initFixedSidebar:function(){d()},getLayoutImgPath:function(){return App.getAssetsPath()+e},getLayoutCssPath:function(){return App.getAssetsPath()+a}}}();App.isAngularJsApp()===!1&&jQuery(document).ready(function(){Layout.init()});

var Demo=function(){var e=function(){var e=$(".theme-panel");$("body").hasClass("page-boxed")===!1&&$(".layout-option",e).val("fluid"),$(".sidebar-option",e).val("default"),$(".page-header-option",e).val("fixed"),$(".page-footer-option",e).val("default"),$(".sidebar-pos-option").attr("disabled")===!1&&$(".sidebar-pos-option",e).val(App.isRTL()?"right":"left");var a=function(){$("body").removeClass("page-boxed").removeClass("page-footer-fixed").removeClass("page-sidebar-fixed").removeClass("page-header-fixed").removeClass("page-sidebar-reversed"),$(".page-header > .page-header-inner").removeClass("container"),1===$(".page-container").parent(".container").size()&&$(".page-container").insertAfter("body >.page-wrapper > .clearfix"),1===$(".page-footer > .container").size()?$(".page-footer").html($(".page-footer > .container").html()):1===$(".page-footer").parent(".container").size()&&($(".page-footer").insertAfter(".page-container"),$(".scroll-to-top").insertAfter(".page-footer")),$(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark"),$("body > .page-wrapper > .container").remove()},o="",t=function(){var t=$(".layout-option",e).val(),i=$(".sidebar-option",e).val(),r=$(".page-header-option",e).val(),d=$(".page-footer-option",e).val(),s=$(".sidebar-pos-option",e).val(),n=$(".sidebar-style-option",e).val(),p=$(".sidebar-menu-option",e).val(),l=$(".page-header-top-dropdown-style-option",e).val();if("fixed"==i&&"default"==r&&(alert("Default Header with Fixed Sidebar option is not supported. Proceed with Fixed Header with Fixed Sidebar."),$(".page-header-option",e).val("fixed"),$(".sidebar-option",e).val("fixed"),i="fixed",r="fixed"),a(),"boxed"===t){$("body").addClass("page-boxed"),$(".page-header > .page-header-inner").addClass("container");$("body > .page-wrapper > .clearfix").after('<div class="container"></div>');$(".page-container").appendTo("body > .page-wrapper > .container"),"fixed"===d?$(".page-footer").html('<div class="container">'+$(".page-footer").html()+"</div>"):$(".page-footer").appendTo("body > .page-wrapper > .container")}o!=t&&App.runResizeHandlers(),o=t,"fixed"===r?($("body").addClass("page-header-fixed"),$(".page-header").removeClass("navbar-static-top").addClass("navbar-fixed-top")):($("body").removeClass("page-header-fixed"),$(".page-header").removeClass("navbar-fixed-top").addClass("navbar-static-top")),$("body").hasClass("page-full-width")===!1&&("fixed"===i?($("body").addClass("page-sidebar-fixed"),$("page-sidebar-menu").addClass("page-sidebar-menu-fixed"),$("page-sidebar-menu").removeClass("page-sidebar-menu-default"),Layout.initFixedSidebarHoverEffect()):($("body").removeClass("page-sidebar-fixed"),$("page-sidebar-menu").addClass("page-sidebar-menu-default"),$("page-sidebar-menu").removeClass("page-sidebar-menu-fixed"),$(".page-sidebar-menu").unbind("mouseenter").unbind("mouseleave"))),"dark"===l?$(".top-menu > .navbar-nav > li.dropdown").addClass("dropdown-dark"):$(".top-menu > .navbar-nav > li.dropdown").removeClass("dropdown-dark"),"fixed"===d?$("body").addClass("page-footer-fixed"):$("body").removeClass("page-footer-fixed"),"light"===n?$(".page-sidebar-menu").addClass("page-sidebar-menu-light"):$(".page-sidebar-menu").removeClass("page-sidebar-menu-light"),"hover"===p?"fixed"==i?($(".sidebar-menu-option",e).val("accordion"),alert("Hover Sidebar Menu is not compatible with Fixed Sidebar Mode. Select Default Sidebar Mode Instead.")):$(".page-sidebar-menu").addClass("page-sidebar-menu-hover-submenu"):$(".page-sidebar-menu").removeClass("page-sidebar-menu-hover-submenu"),App.isRTL()?"left"===s?($("body").addClass("page-sidebar-reversed"),$("#frontend-link").tooltip("destroy").tooltip({placement:"right"})):($("body").removeClass("page-sidebar-reversed"),$("#frontend-link").tooltip("destroy").tooltip({placement:"left"})):"right"===s?($("body").addClass("page-sidebar-reversed"),$("#frontend-link").tooltip("destroy").tooltip({placement:"left"})):($("body").removeClass("page-sidebar-reversed"),$("#frontend-link").tooltip("destroy").tooltip({placement:"right"})),Layout.fixContentHeight(),Layout.initFixedSidebar()},i=function(e){var a=App.isRTL()?e+"-rtl":e;$("#style_color").attr("href",Layout.getLayoutCssPath()+"themes/"+a+".min.css"),"light2"==e?$(".page-logo img").attr("src",Layout.getLayoutImgPath()+"logo-invert.png"):$(".page-logo img").attr("src",Layout.getLayoutImgPath()+"logo.png")};$(".toggler",e).click(function(){$(".toggler").hide(),$(".toggler-close").show(),$(".theme-panel > .theme-options").show()}),$(".toggler-close",e).click(function(){$(".toggler").show(),$(".toggler-close").hide(),$(".theme-panel > .theme-options").hide()}),$(".theme-colors > ul > li",e).click(function(){var a=$(this).attr("data-style");i(a),$("ul > li",e).removeClass("current"),$(this).addClass("current")}),$("body").hasClass("page-boxed")&&$(".layout-option",e).val("boxed"),$("body").hasClass("page-sidebar-fixed")&&$(".sidebar-option",e).val("fixed"),$("body").hasClass("page-header-fixed")&&$(".page-header-option",e).val("fixed"),$("body").hasClass("page-footer-fixed")&&$(".page-footer-option",e).val("fixed"),$("body").hasClass("page-sidebar-reversed")&&$(".sidebar-pos-option",e).val("right"),$(".page-sidebar-menu").hasClass("page-sidebar-menu-light")&&$(".sidebar-style-option",e).val("light"),$(".page-sidebar-menu").hasClass("page-sidebar-menu-hover-submenu")&&$(".sidebar-menu-option",e).val("hover");$(".sidebar-option",e).val(),$(".page-header-option",e).val(),$(".page-footer-option",e).val(),$(".sidebar-pos-option",e).val(),$(".sidebar-style-option",e).val(),$(".sidebar-menu-option",e).val();$(".layout-option, .page-header-option, .page-header-top-dropdown-style-option, .sidebar-option, .page-footer-option, .sidebar-pos-option, .sidebar-style-option, .sidebar-menu-option",e).change(t)},a=function(e){var a="rounded"===e?"components-rounded":"components";a=App.isRTL()?a+"-rtl":a,$("#style_components").attr("href",App.getGlobalCssPath()+a+".min.css"),"undefined"!=typeof Cookies&&Cookies.set("layout-style-option",e)};return{init:function(){e(),$(".theme-panel .layout-style-option").change(function(){a($(this).val())}),"undefined"!=typeof Cookies&&"rounded"===Cookies.get("layout-style-option")&&(a(Cookies.get("layout-style-option")),$(".theme-panel .layout-style-option").val(Cookies.get("layout-style-option")))}}}();App.isAngularJsApp()===!1&&jQuery(document).ready(function(){Demo.init()});

var QuickSidebar=function(){var i=function(){$(".dropdown-quick-sidebar-toggler a, .page-quick-sidebar-toggler, .quick-sidebar-toggler").click(function(i){$("body").toggleClass("page-quick-sidebar-open")})},a=function(){var i=$(".page-quick-sidebar-wrapper"),a=i.find(".page-quick-sidebar-chat"),e=function(){var e,t=i.find(".page-quick-sidebar-chat-users");e=i.height()-i.find(".nav-tabs").outerHeight(!0),App.destroySlimScroll(t),t.attr("data-height",e),App.initSlimScroll(t);var r=a.find(".page-quick-sidebar-chat-user-messages"),s=e-a.find(".page-quick-sidebar-chat-user-form").outerHeight(!0);s-=a.find(".page-quick-sidebar-nav").outerHeight(!0),App.destroySlimScroll(r),r.attr("data-height",s),App.initSlimScroll(r)};e(),App.addResizeHandler(e),i.find(".page-quick-sidebar-chat-users .media-list > .media").click(function(){a.addClass("page-quick-sidebar-content-item-shown")}),i.find(".page-quick-sidebar-chat-user .page-quick-sidebar-back-to-list").click(function(){a.removeClass("page-quick-sidebar-content-item-shown")});var t=function(i){i.preventDefault();var e=a.find(".page-quick-sidebar-chat-user-messages"),t=a.find(".page-quick-sidebar-chat-user-form .form_control"),r=t.val();if(0!==r.length){var s=function(i,a,e,t,r){var s="";return s+='<div class="post '+i+'">',s+='<img class="avatar" alt="" src="'+Layout.getLayoutImgPath()+t+'.jpg"/>',s+='<div class="message">',s+='<span class="arrow"></span>',s+='<a href="#" class="name">Bob Nilson</a>&nbsp;',s+='<span class="datetime">'+a+"</span>",s+='<span class="body">',s+=r,s+="</span>",s+="</div>",s+="</div>"},n=new Date,c=s("out",n.getHours()+":"+n.getMinutes(),"Bob Nilson","avatar3",r);c=$(c),e.append(c),e.slimScroll({scrollTo:"1000000px"}),t.val(""),setTimeout(function(){var i=new Date,a=s("in",i.getHours()+":"+i.getMinutes(),"Ella Wong","avatar2","Lorem ipsum doloriam nibh...");a=$(a),e.append(a),e.slimScroll({scrollTo:"1000000px"})},3e3)}};a.find(".page-quick-sidebar-chat-user-form .btn").click(t),a.find(".page-quick-sidebar-chat-user-form .form_control").keypress(function(i){if(13==i.which)return t(i),!1})},e=function(){var i=$(".page-quick-sidebar-wrapper"),a=function(){var a,e=i.find(".page-quick-sidebar-alerts-list");a=i.height()-80-i.find(".nav-justified > .nav-tabs").outerHeight(),App.destroySlimScroll(e),e.attr("data-height",a),App.initSlimScroll(e)};a(),App.addResizeHandler(a)},t=function(){var i=$(".page-quick-sidebar-wrapper"),a=function(){var a,e=i.find(".page-quick-sidebar-settings-list");a=i.height()-80-i.find(".nav-justified > .nav-tabs").outerHeight(),App.destroySlimScroll(e),e.attr("data-height",a),App.initSlimScroll(e)};a(),App.addResizeHandler(a)};return{init:function(){i(),a(),e(),t()}}}();App.isAngularJsApp()===!1&&jQuery(document).ready(function(){QuickSidebar.init()});

var QuickNav=function(){return{init:function(){if($(".quick-nav").length>0){var i=$(".quick-nav");i.each(function(){var i=$(this),n=i.find(".quick-nav-trigger");n.on("click",function(n){n.preventDefault(),i.toggleClass("nav-is-visible")})}),$(document).on("click",function(n){!$(n.target).is(".quick-nav-trigger")&&!$(n.target).is(".quick-nav-trigger span")&&i.removeClass("nav-is-visible")})}}}}();QuickNav.init();
