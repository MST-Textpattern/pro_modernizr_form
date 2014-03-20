Companion plugin for zem_contact_reborn - pro_modernizr_form

Textpattern plugin Modernizr HTML5 form input fallback, this outputs the Jquery solutions for unsupported HTML5 inputs, code included for the list below

Download a copy of Modernizr with HTML5 input attributes and input types compatibility, host this via your own web site. It is not recommended to use the CDN for Modernizr, however there is a production copy available for temporary use only:

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>
Modernizr input type fallback

Input types currently supported for Modernizr fallback include:

    input type=date
    input type=range
    input type=number

Jquery code for fallback solutions

Insert the Jquery and Modernizr links before the /head tag of your page. (I would usually prefer to load before /body for speed, however testing in IE7-IE9 revealed it only recognises the .js links in the head of the page, typical IE behaviour!) This includes a css file needed to style the Jquery fallbacks.

Jquery themes, including ‘roll your own’ available at themes web site.

Latest Google Jquery versions available here.

<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

Download Modernizr as instructed above and insert link:

<script type="text/javascript" src="<txp:site_url />js/modernizr.mycustomnumber.js"></script>
New tag to execute Modernizr check and Jquery fallback

Insert the tag below before the /body :

<txp:pro_modernizr_form />

This tag will load the Modernizr checks to see if the fallback Jquery is needed, and if it is it will execute that code.

Tested in Firefox, Safari, IE 7-10, Chrome

See how it works on my web design cork page, includes slider/date input etc, and do comment below with any queries or suggestions!