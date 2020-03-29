$(document).ready(function() {

    // Remove Error when changing Values
    $('input').not(".date-picker,.timepicker").change(function () {
        var helpBlockDiv = $(this).parent().find('.help-block');
        $(helpBlockDiv).remove();
        var formGroup = $(this).closest('.form-group');
        $(formGroup).removeClass('has-error');
    });

    $('.timepicker').timepicker().on('changeTime.timepicker', function (e) {
        var helpBlockDiv = $(this).parent().find('.help-block');
        $(helpBlockDiv).remove();
        var formGroup = $(this).closest('.form-group');
        $(formGroup).removeClass('has-error');
    });

    $(".hijri-date-input").on('dp.change', function (arg) {
        var helpBlockDiv = $(this).parent().find('.help-block');
        $(helpBlockDiv).remove();
        var formGroup = $(this).closest('.form-group');
        $(formGroup).removeClass('has-error');
    });

    $('select').change(function () {
        var helpBlockDiv = $(this).parent().find('.help-block');
        $(helpBlockDiv).remove();
        var formGroup = $(this).closest('.form-group');
        $(formGroup).removeClass('has-error');
    });

    $(".hijri-date-input").on('dp.change', function (arg) {
        var helpBlockDiv = $(this).parent().find('.help-block');
        $(helpBlockDiv).remove();
        var formGroup = $(this).closest('.form-group');
        $(formGroup).removeClass('has-error');
    });

    $('.accept_phone_numbers_only').change(function () {
        var formGroup = $(this).closest('.form-group');
        
        if (/[^0-9-\s]+/.test($(this).val())) {
            $(formGroup).removeClass('has-error').addClass('has-error');
            $(formGroup).append('<span class="help-block"><strong>رقم الجوال يجب ان يكون من ارقام فقط</strong></span>');
            return false;
        }

        if($(this).val().length != 10) {
            $(formGroup).removeClass('has-error').addClass('has-error');
            $(formGroup).append('<span class="help-block"><strong>رقم الجوال يجب ان يكون مكون من 10 ارقام</strong></span>');
            return false;
        }

        if($(this).val().slice(0,1) != 0 || $(this).val().slice(1,2) != 5) {
            $(formGroup).removeClass('has-error').addClass('has-error');
            $(formGroup).append('<span class="help-block"><strong>رقم الجوال يجب ان صحيح البنية</strong></span>');
            return false; 
        }
        
    });


    $('.accept_saudi_national_id_only').change(function () {
        var formGroup = $(this).closest('.form-group');
        
        if (/[^0-9-\s]+/.test($(this).val())) {
            $(formGroup).removeClass('has-error').addClass('has-error');
            $(formGroup).append('<span class="help-block"><strong>رقم الهوية يجب ان يكون من ارقام فقط</strong></span>');
            return false;
        }

        if($(this).val().length != 10) {
            $(formGroup).removeClass('has-error').addClass('has-error');
            $(formGroup).append('<span class="help-block"><strong>رقم الهوية يجب ان يكون مكون من 10 ارقام</strong></span>');
            return false;
        }

        if($(this).val().slice(0,1) != 1) {
            $(formGroup).removeClass('has-error').addClass('has-error');
            $(formGroup).append('<span class="help-block"><strong>رقم الهوية يجب ان يكون سعودي</strong></span>');
            return false; 
        }

        let nCheck = 0, bEven = false, value = $(this).val().replace(/\D/g, "");

        for (var n = value.length - 1; n >= 0; n--) {
            var cDigit = value.charAt(n),
                nDigit = parseInt(cDigit, 10);

            if (bEven && (nDigit *= 2) > 9) nDigit -= 9;

            nCheck += nDigit;
            bEven = !bEven;
        }

        if(!((nCheck % 10) == 0)) {
            $(formGroup).removeClass('has-error').addClass('has-error');
            $(formGroup).append('<span class="help-block"><strong>رقم الهوية غير صحيح</strong></span>');
            return false; 
        }
        
    });

    $('.accept_gov_email_only').change(function () {
        var formGroup = $(this).closest('.form-group');
        var email = $(this).val();

        if(!/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)) {
            $(formGroup).removeClass('has-error').addClass('has-error');
            $(formGroup).append('<span class="help-block"><strong>البريد الإلكتروني غير صحيح</strong></span>');
            return false; 
        }

        email = email.split('.');
        var govEmail = email[email.length-2] + '.' + email[email.length-1];
        if(govEmail.toLowerCase() != 'gov.sa') {
            $(formGroup).removeClass('has-error').addClass('has-error');
            $(formGroup).append('<span class="help-block"><strong>البريد الإلكتروني يجب ان ينتهي بإمتداد gov.sa</strong></span>');
            return false;  
        }
    });

});