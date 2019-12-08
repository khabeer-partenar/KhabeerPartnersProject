$(document).ready(function() {


            function megaHoverOver() {
                $(this).find(".dropdown").stop().slideDown('fast', 0).show();

                //Calculate width of all ul's
                (function($) {
                    jQuery.fn.calcdropdownWidth = function() {
                        rowWidth = 0;
                        //Calculate row
                        $(this).find("ul").each(function() {
                            rowWidth += $(this).width();
                        });
                    };
                })(jQuery);

                if ($(this).find(".row").length > 0) { //If row exists...
                    var biggestRow = 0;
                    //Calculate each row
                    $(this).find(".row").each(function() {
                        $(this).calcdropdownWidth();
                        //Find biggest row
                        if (rowWidth > biggestRow) {
                            biggestRow = rowWidth;
                        }
                    });
                    //Set width
                    $(this).find(".dropdown").css({ 'width': biggestRow });
                    $(this).find(".row:last").css({ 'margin': '0' });

                } else { //If row does not exist...

                    $(this).calcdropdownWidth();
                    //Set Width
                    $(this).find(".dropdown").css({ 'width': rowWidth });

                }
            }

            function megaHoverOut() {
                $(this).find(".dropdown").stop().slideUp('fast', 0, function() {
                    $(this).hide();
                });
            }


            var config = {
                sensitivity: 2, // number = sensitivity threshold (must be 1 or higher)    
                interval: 100, // number = milliseconds for onMouseOver polling interval    
                over: megaHoverOver, // function = onMouseOver callback (REQUIRED)    
                timeout: 100, // number = milliseconds delay before onMouseOut    
                out: megaHoverOut // function = onMouseOut callback (REQUIRED)    
            };

            $("ul#menu li .dropdown").css({ 'opacity': '1' });
            $("ul#menu li").hoverIntent(config);
        });
		
(function($){$.fn.hoverIntent=function(f,g){var cfg={sensitivity:7,interval:100,timeout:0};cfg=$.extend(cfg,g?{over:f,out:g}:f);var cX,cY,pX,pY;var track=function(ev){cX=ev.pageX;cY=ev.pageY;};var compare=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);if((Math.abs(pX-cX)+Math.abs(pY-cY))<cfg.sensitivity){$(ob).unbind("mousemove",track);ob.hoverIntent_s=1;return cfg.over.apply(ob,[ev]);}else{pX=cX;pY=cY;ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}};var delay=function(ev,ob){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);ob.hoverIntent_s=0;return cfg.out.apply(ob,[ev]);};var handleHover=function(e){var p=(e.type=="mouseover"?e.fromElement:e.toElement)||e.relatedTarget;while(p&&p!=this){try{p=p.parentNode;}catch(e){p=this;}}if(p==this){return false;}var ev=jQuery.extend({},e);var ob=this;if(ob.hoverIntent_t){ob.hoverIntent_t=clearTimeout(ob.hoverIntent_t);}if(e.type=="mouseover"){pX=ev.pageX;pY=ev.pageY;$(ob).bind("mousemove",track);if(ob.hoverIntent_s!=1){ob.hoverIntent_t=setTimeout(function(){compare(ev,ob);},cfg.interval);}}else{$(ob).unbind("mousemove",track);if(ob.hoverIntent_s==1){ob.hoverIntent_t=setTimeout(function(){delay(ev,ob);},cfg.timeout);}}};return this.mouseover(handleHover).mouseout(handleHover);};})(jQuery);