<?php

// This is a PLUGIN TEMPLATE for Textpattern CMS.

// Copy this file to a new name like abc_myplugin.php.  Edit the code, then
// run this file at the command line to produce a plugin for distribution:
// $ php abc_myplugin.php > abc_myplugin-0.1.txt

// Plugin name is optional.  If unset, it will be extracted from the current
// file name. Plugin names should start with a three letter prefix which is
// unique and reserved for each plugin author ("abc" is just an example).
// Uncomment and edit this line to override:
$plugin['name'] = 'pro_modernizr_form';

// Allow raw HTML help, as opposed to Textile.
// 0 = Plugin help is in Textile format, no raw HTML allowed (default).
// 1 = Plugin help is in raw HTML.  Not recommended.
# $plugin['allow_html_help'] = 1;

$plugin['version'] = '0.1';
$plugin['author'] = 'Hilary Quinn';
$plugin['author_uri'] = 'http://www.proximowebdesign.ie';
$plugin['description'] = 'Companion plugin for zem_contact_reborn - Modernizr fallback for HTML5 form input';

// Plugin load order:
// The default value of 5 would fit most plugins, while for instance comment
// spam evaluators or URL redirectors would probably want to run earlier
// (1...4) to prepare the environment for everything else that follows.
// Values 6...9 should be considered for plugins which would work late.
// This order is user-overrideable.
$plugin['order'] = '5';

// Plugin 'type' defines where the plugin is loaded
// 0 = public              : only on the public side of the website (default)
// 1 = public+admin        : on both the public and admin side
// 2 = library             : only when include_plugin() or require_plugin() is called
// 3 = admin               : only on the admin side (no AJAX)
// 4 = admin+ajax          : only on the admin side (AJAX supported)
// 5 = public+admin+ajax   : on both the public and admin side (AJAX supported)
$plugin['type'] = '0';

// Plugin "flags" signal the presence of optional capabilities to the core plugin loader.
// Use an appropriately OR-ed combination of these flags.
// The four high-order bits 0xf000 are available for this plugin's private use
if (!defined('PLUGIN_HAS_PREFS')) define('PLUGIN_HAS_PREFS', 0x0001); // This plugin wants to receive "plugin_prefs.{$plugin['name']}" events
if (!defined('PLUGIN_LIFECYCLE_NOTIFY')) define('PLUGIN_LIFECYCLE_NOTIFY', 0x0002); // This plugin wants to receive "plugin_lifecycle.{$plugin['name']}" events

$plugin['flags'] = '0';

// Plugin 'textpack' is optional. It provides i18n strings to be used in conjunction with gTxt().
// Syntax:
// ## arbitrary comment
// #@event
// #@language ISO-LANGUAGE-CODE
// abc_string_name => Localized String

/** Uncomment me, if you need a textpack
$plugin['textpack'] = <<< EOT
#@admin
#@language en-gb
abc_sample_string => Sample String
abc_one_more => One more
#@language de-de
abc_sample_string => Beispieltext
abc_one_more => Noch einer
EOT;
**/
// End of textpack

if (!defined('txpinterface'))
        @include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
function pro_modernizr_form($atts)
{
	
$var1 = escape_js(gps('param'));
$var2 = escape_js(gps('param'));
        $var1 = "
        <script type=\"text/javascript\">
            var placeholder = $( \".zemText, .zemTextarea\" );
                if (!Modernizr.input.placeholder) {
                    var placeholder = $( \".zemText, .zemTextarea\" ).each(function() {
                        if ($(this).val() == '') {
                        $(this).val($(this).attr('placeholder'));
                        $(this).addClass('placeholder');
                    }
                    $(this).focus(function() {
                        if ($(this).val() == $(this).attr('placeholder') && $(this).hasClass('placeholder')) {
                        $(this).val('');
                        $(this).removeClass('placeholder');
                    }
                    }).blur(function() {
                        if($(this).val() == '') {
                         $(this).val($(this).attr('placeholder'));
                        $(this).addClass('placeholder');
                    }
                    });
                    });
                    $('[placeholder]').parents('form').submit(function() {
                        $(this).find('[placeholder]').each(function() {
                        if ($(this).val() == $(this).attr('placeholder') && $(this).hasClass('placeholder')) {
                            $(this).val('');
                        }
                    });
                    });
                    window.onbeforeunload = function() {
                        $('[placeholder]').each(function() {
                            if ($(this).val() == $(this).attr('placeholder') && $(this).hasClass('placeholder')) {
                            $(this).val('');
                            }
                    });
                    };   
}
        </script>";
        $var2 = "
        <script type=\"text/javascript\">
                if (!Modernizr.input.date) {
                    $(function() {
		        var date = $( \"#date\" ).datepicker({
                        dateFormat: 'yy-mm-dd'
                        });
                 });
                } 
                if (!Modernizr.input.number) {
                    $(function() {
                        var number = $( \"#number\" ).spinner();
                    });
                }
                if (!Modernizr.input.range) {
                    $(function() {
                        var range = $(\"#range\");
		        $(\"#range\").each(function(){
                            var range = $(this);
            
                        var sliderDiv = $(\"<div/>\");
                        sliderDiv.width(range.width());
            
                        range.after(
                            sliderDiv.slider({
                            min: parseFloat(range.attr(\"min\")),
                            max: parseFloat(range.attr(\"max\")),
                            value: parseFloat(range.val()),
                            step: parseFloat(range.attr(\"step\")),
                            slide: function(evt, ui) {
                                range.val(ui.value);
                            },
                            change: function(evt, ui) {
                                range.val(ui.value);
                            }
                            })
                        ).
                        hide();
                    });
                    });
                }
        </script>";

return "$var1 $var2";
}
# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---
h4. Modernizr placeholder fallback

Download a copy of "Modernizr":http://modernizr.com/download/ with HTML5 input attributes and input types compatibility, host this via your own web site. It is not recommended to use the CDN for Modernizr, however there is a production copy available for temporary use only:

@<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>@

h4. Modernizr input type fallback

Input types currently supported for Modernizr fallback include:

* input type=date
* input type=range
* input type=number

h4. Jquery code for fallback solutions

Insert the Jquery and Modernizr links before the /head tag of your page. (I would usually prefer to load before /body for speed, however testing in IE7-IE9 revealed it only recognises the .js links in the head of the page, typical IE behaviour!) This includes a css file needed to style the Jquery fallbacks.

Jquery themes, including 'roll your own' "available here.":http://jqueryui.com/themeroller/

Latest Google Jquery versions "available here.":https://developers.google.com/speed/libraries/devguide#jquery

@<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">@
@<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>@
@<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>@

Download Modernizr as instructed above and insert link:

@<script type="text/javascript" src="<txp:site_url />js/modernizr.mycustomnumber.js"></script>@

h4. New tag to execute Modernizr check and Jquery fallback

Insert the tag below before the /body :

@<txp:pro_modernizr_form />@

This tag will load the Modernizr checks to see if the fallback Jquery is needed, and if it is it will execute that code.

Tested in Firefox, Safari, IE 7-10, Chrome
# --- END PLUGIN HELP ---
-->
<?php
}
?>
