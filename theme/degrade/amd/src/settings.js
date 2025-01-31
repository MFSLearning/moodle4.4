define(["jquery"], function($) {
    var theme_degrade = {

        theme_color         : function() {
            var degrade_theme_color = $("#id_s_theme_degrade_theme_color");

            $(".seletor-de-theme-degrade").click(function() {
                var themename = $(this).attr("data-name");
                theme_degrade._theme_color_select(themename);

                degrade_theme_color.val(themename);
            });
            degrade_theme_color.change(function() {
                var themename = degrade_theme_color.val();
                theme_degrade._theme_color_select(themename);

                degrade_theme_color.val(themename);
            });
        },
        _theme_color_select : function(themename) {
            var $themename = $("#theme-" + themename);

            var color_primary = $themename.find(".color_primary").attr('data-color');
            var color_secondary = $themename.find(".color_secondary").attr('data-color');
            var color_buttons = $themename.find(".color_buttons").attr('data-color');
            var color_names = $themename.find(".color_names").attr('data-color');
            var color_titles = $themename.find(".color_titles").attr('data-color');

            $("#id_s_theme_degrade_theme_color__color_primary").val(color_primary);
            $("#id_s_theme_degrade_theme_color__color_secondary").val(color_secondary);
            $("#id_s_theme_degrade_theme_color__color_buttons").val(color_buttons);
            $("#id_s_theme_degrade_theme_color__color_names").val(color_names);
            $("#id_s_theme_degrade_theme_color__color_titles").val(color_titles);
        },

        login : function() {
            var login_theme = $("#id_s_theme_degrade_login_theme");

            login_theme.change(function() {
                theme_degrade._login_changue(login_theme.val());
            });

            theme_degrade._login_changue(login_theme.val());
        },

        _login_changue : function(themename) {
            var login_backgroundfoto = $("#admin-login_backgroundfoto");
            var login_description = $("#admin-login_login_description, #admin-login_forgot_description, #admin-login_signup_description");
            var login_backgroundcolor = $("#admin-login_backgroundcolor");

            login_backgroundfoto.hide();
            login_description.hide();
            login_backgroundcolor.hide();

            switch (themename) {
                case 'login_theme_block':
                    login_backgroundfoto.show();
                    login_backgroundcolor.show();
                    break;
                case 'login_theme_image_login' :
                    login_backgroundfoto.show();
                    break;
                case 'login_theme_imagetext_login' :
                    login_backgroundfoto.show();
                    login_description.show();
                    break;
                case  'login_theme_login' :
                    break;
                case 'theme_login_branco' :
                    break;
            }
        },

        about : function() {
            var about_enable = $("#id_s_theme_degrade_frontpage_about_enable");

            about_enable.change(theme_degrade._about_changue);
            about_enable.click(theme_degrade._about_changue);
            theme_degrade._about_changue();
        },

        _about_changue : function() {
            var about_enable = $("#id_s_theme_degrade_frontpage_about_enable");
            if (about_enable.is(":checked")) {
                $("#theme_degrade_about > fieldset > div").show();
                $("#theme_degrade_about > fieldset > h3").show();
            } else {
                $("#theme_degrade_about > fieldset > div").hide();
                $("#theme_degrade_about > fieldset > h3").hide();
            }

            $("#admin-frontpage_about_enable").show();
            setTimeout(function() {
                $("#admin-frontpage_about_enable").show();
            }, 200);
        },

        icons : function() {
            var settings_icons_num = $("#id_s_theme_degrade_settings_icons_num");

            settings_icons_num.change(theme_degrade._icons_changue);
            theme_degrade._icons_changue();
        },

        _icons_changue : function() {
            var settings_icons_num = $("#id_s_theme_degrade_settings_icons_num");
            for (var i = 0; i <= 50; i++) {
                if (settings_icons_num.val() >= i) {
                    $("#admin-settings_icons_block_" + i).parent().show(300);
                    $("#admin-settings_icons_name_" + i).show(300);
                    $("#admin-settings_icons_image_" + i).show(300);
                } else {
                    $("#admin-settings_icons_block_" + i).parent().hide(300);
                    $("#admin-settings_icons_name_" + i).hide(300);
                    $("#admin-settings_icons_image_" + i).hide(300);
                }
            }
        },

        autosubmit : function(element_id) {
            $("#" + element_id).change(function() {
                $("#adminsettings").submit();
            });
        }
    };

    return theme_degrade;
});



