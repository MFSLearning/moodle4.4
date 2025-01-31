<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * User: Eduardo Kraus
 * Date: 01/04/2023
 * Time: 11:38
 */

namespace theme_boost_magnific\template;


use theme_boost_magnific\fonts\font_util;

class footer_data {

    /**
     * @return array
     *
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public static function get_data() {
        global $CFG;

        $data = array_merge(
            self::description(),
            self::links(),
            self::social(),
            self::contact(),
            self::copywriter(),
            self::footer_html()
        );

        $footerenableblock = $data['enable_block_description'] +
            $data['enable_block_links'] +
            $data['enable_block_social'] +
            $data['enable_block_contact'];

        switch ($footerenableblock) {
            case 1:
                $footerblockclass = 'col-md-12';
                break;
            case 2:
                $footerblockclass = 'col-md-6';
                break;
            case 3:
                $footerblockclass = 'col-md-4';
                break;
            case 4:
                $footerblockclass = 'col-md-3';
                break;
            default:
                $footerblockclass = '';
        }

        $data['footer_enable_block'] = $footerenableblock;
        $data['footer_block_class'] = $footerblockclass;
        if (has_capability('moodle/site:config', \context_system::instance())) {
            $data['footer_settings_edit'] =
                "{$CFG->wwwroot}/admin/settings.php?section=themesettingboost_magnific#theme_boost_magnific_footer";
        }
        $data['logourl_footer'] = theme_boost_magnific_get_logo("footer");

        return $data;
    }

    /**
     * @throws \coding_exception
     */
    private static function description() {
        $footerdescription = theme_boost_magnific_get_setting('footer_description');
        $footerdescription = !empty($footerdescription) ? $footerdescription : '';

        return [
            'enable_block_description' => 1,
            'footer_description' => $footerdescription,
        ];
    }

    /**
     * @return array
     *
     * @throws \coding_exception
     * @throws \moodle_exception
     */
    private static function links() {
        $footerlinkstitle = theme_boost_magnific_get_setting('footer_links_title');
        $footerlinkstitle = !empty($footerlinkstitle) ? $footerlinkstitle : '';
        $footerlinks = theme_boost_magnific_generate_links('footer_links');

        return [
            'enable_block_links' => 0 + ($footerlinks != ''),
            'footer_links' => $footerlinks,
            'footer_links_title' => $footerlinkstitle,
        ];
    }

    /**
     * @return array
     *
     * @throws \coding_exception
     */
    private static function social() {
        $footersocialtitle = theme_boost_magnific_get_setting('footer_social_title');
        $footersocialtitle = !empty($footersocialtitle) ? $footersocialtitle : '';

        $socialfacebook = trim(theme_boost_magnific_get_setting('social_facebook'));
        $socialyoutube = trim(theme_boost_magnific_get_setting('social_youtube'));
        $sociallinkedin = trim(theme_boost_magnific_get_setting('social_linkedin'));
        $socialtwitter = trim(theme_boost_magnific_get_setting('social_twitter'));
        $socialinstagram = trim(theme_boost_magnific_get_setting('social_instagram'));

        $socialurls = (
            $socialfacebook != '' ||
            $socialyoutube != '' ||
            $sociallinkedin != '' ||
            $socialinstagram != '' ||
            $socialtwitter != '') ? 1 : 0;

        return [
            'enable_block_social' => 0 + ($socialurls != 0),
            'footer_social_title' => $footersocialtitle,

            'social_youtube' => $socialyoutube,
            'youtube_name' => "Youtube",

            'social_linkedin' => $sociallinkedin,
            'linkedin_name' => "Linkedin",

            'social_facebook' => $socialfacebook,
            'facebook_name' => "Facebook",

            'social_instagram' => $socialinstagram,
            'instagram_name' => "Instagram",

            'social_twitter' => $socialtwitter,
            'twitter_name' => "Twitter",
        ];
    }

    /**
     * @return array
     *
     * @throws \coding_exception
     */
    private static function contact() {
        $contactfootertitle = theme_boost_magnific_get_setting('contact_footer_title');
        $contactfootertitle = !empty($contactfootertitle) ? $contactfootertitle : '';

        $contactaddress = theme_boost_magnific_get_setting('contact_address') ?
            theme_boost_magnific_get_setting('contact_address') : '';
        $contactemail = theme_boost_magnific_get_setting('contact_email');
        $contactphone = theme_boost_magnific_get_setting('contact_phone');

        return [
            'enable_block_contact' => 0 + ($contactaddress != '' || $contactemail != '' || $contactphone != ''),
            'contact_footer_title' => $contactfootertitle,
            'contact_address' => $contactaddress,
            'contact_phone' => $contactphone,
            'contact_email' => $contactemail,
        ];
    }

    /**
     * @return array
     *
     * @throws \coding_exception
     */
    private static function copywriter() {
        return [
            'enable_copywriter' => theme_boost_magnific_get_setting('footer_show_copywriter'),
            'footerblock_copywriter_text' => get_string('footerblock_copywriter', 'theme_boost_magnific')
        ];
    }

    /**
     * @return array
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    private static function footer_html() {
        $footer_type = get_config("theme_boost_magnific", "footer_type");
        $chave = optional_param('chave', false, PARAM_TEXT);

        if ($footer_type == 1 || $chave == "footer") {
            if ($chave == 'footer') {
                $htmldata = optional_param('htmldata', false, PARAM_RAW);
                $cssdata = optional_param('cssdata', false, PARAM_RAW);

                $htmldata = "{$htmldata}\n<style>{$cssdata}</style>";
            } else {
                $lang = current_language();
                $htmldata = get_config("theme_boost_magnific", "footer_htmleditor_{$lang}");
                if (!isset($htmldata[3])) {
                    $htmldata = get_config("theme_boost_magnific", "footer_htmleditor_all");
                }
                if (!isset($htmldata[3])) {
                    $htmldata = get_string('content_type_empty', 'theme_boost_magnific');
                }
            }

            $htmldata .= font_util::print_only_unique();
            return [
                'footer_html' => true,
                'footer_htmleditor' => $htmldata,
            ];
        } else {
            return [
                'footer_html' => false,
            ];
        }
    }
}
