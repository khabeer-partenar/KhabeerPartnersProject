(function ($) {
    $(function () {

        $('ul.tabs').each(function () {
            $(this).find('li').each(function (i) {
                $(this).click(function () {
                    $(this).addClass('current').siblings().removeClass('current')
                        .parents('div.section').find('div.box').removeClass('visible').end().find('div.box:eq(' + i + ')').addClass('visible');
                    $("#servicesSections").attr("data-tabIndex", i);
                });
            });
        });
        $('ul.subtabs').each(function () {
            $(this).find('li').each(function (i) {
                $(this).click(function () {
                    $(this).addClass('subcurrent').siblings().removeClass('subcurrent')
                        .parents('div.subsection').find('div.subbox').removeClass('visible').end().find('div.subbox:eq(' + i + ')').addClass('visible');
                });
            });
        });

    })
})(jQuery)



