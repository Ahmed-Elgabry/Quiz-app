<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" @if(App::isLocale('ar')) dir="rtl" @endif  >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>{{ __('almiqias') }}</title>

    @if(App::isLocale('ar'))
    <link href="https://fonts.googleapis.com/css?family=Tajawal&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css" rel="stylesheet">
    @else
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
    @endif

    <!-- CSS Reset : BEGIN -->
    <style type="text/css">

        /* What it does: Remove spaces around the email design added by some email clients. */
        /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
html,
body {
    margin: 0 auto !important;
    padding: 0 !important;
    height: 100% !important;
    width: 100% !important;
    background: #f1f1f1;
}

/* What it does: Stops email clients resizing small text. */
* {
    -ms-text-size-adjust: 100%;
    -webkit-text-size-adjust: 100%;
}

/* What it does: Centers email on Android 4.4 */
div[style*="margin: 16px 0"] {
    margin: 0 !important;
}

/* What it does: Stops Outlook from adding extra spacing to tables. */
table,
td {
    mso-table-lspace: 0pt !important;
    mso-table-rspace: 0pt !important;
}

/* What it does: Fixes webkit padding issue. */
table {
    border-spacing: 0 !important;
    border-collapse: collapse !important;
    table-layout: fixed !important;
    margin: 0 auto !important;
}

/* What it does: Uses a better rendering method when resizing images in IE. */
img {
    -ms-interpolation-mode:bicubic;
}

/* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
a {
    text-decoration: none;
}

/* What it does: A work-around for email clients meddling in triggered links. */
*[x-apple-data-detectors],  /* iOS */
.unstyle-auto-detected-links *,
.aBn {
    border-bottom: 0 !important;
    cursor: default !important;
    color: inherit !important;
    text-decoration: none !important;
    font-size: inherit !important;
    font-family: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
}

/* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
.a6S {
    display: none !important;
    opacity: 0.01 !important;
}

/* What it does: Prevents Gmail from changing the text color in conversation threads. */
.im {
    color: inherit !important;
}

/* If the above doesn't work, add a .g-img class to any image in question. */
img.g-img + div {
    display: none !important;
}

/* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
/* Create one of these media queries for each additional viewport size you'd like to fix */

/* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
@media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
    u ~ div .email-container {
        min-width: 320px !important;
    }
}
/* iPhone 6, 6S, 7, 8, and X */
@media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
    u ~ div .email-container {
        min-width: 375px !important;
    }
}
/* iPhone 6+, 7+, and 8+ */
@media only screen and (min-device-width: 414px) {
    u ~ div .email-container {
        min-width: 414px !important;
    }
}

    </style>

    <!-- CSS Reset : END -->

    <!-- Progressive Enhancements : BEGIN -->
    <style type="text/css">

	    .primary{
	background: #30e3ca;
}
.bg_white{
	background: #ffffff;
}
.bg_light{
	background: #fafafa;
}
.bg_black{
	background: #000000;
}
.bg_dark{
	background: rgba(0,0,0,.8);
}
.email-section{
	padding:2.5em;
}

/*BUTTON*/
.btn{
	padding: 10px 15px;
	display: inline-block;
}
.btn.btn-primary{
	border-radius: 5px;
	background: #30e3ca;
	color: #ffffff;
}
.btn.btn-white{
	border-radius: 5px;
	background: #ffffff;
	color: #000000;
}
.btn.btn-white-outline{
	border-radius: 5px;
	background: transparent;
	border: 1px solid #fff;
	color: #fff;
}
.btn.btn-black-outline{
	border-radius: 0px;
	background: transparent;
	border: 2px solid #000;
	color: #000;
	font-weight: 700;
}

h1,h2,h3,h4,h5,h6{
	font-family: 'Lato', sans-serif;
	color: #000000;
	margin-top: 0;
	font-weight: 400;
}

body{
	font-family: 'Lato', sans-serif;
	font-weight: 400;
	font-size: 15px;
	line-height: 1.8;
	color: rgba(0,0,0,.4);
}

a{
	color: #30e3ca;
}

table{
}
/*LOGO*/

.logo h1{
	margin: 0;
}
.logo h1 a{
	color: #30e3ca;
	font-size: 24px;
	font-weight: 700;
	font-family: 'Lato', sans-serif;
}

/*HERO*/
.hero{
	position: relative;
	z-index: 0;
}

.hero .text{
	color: rgba(0,0,0,.3);
}
.hero .text h2{
	color: #000;
	font-size: 40px;
	margin-bottom: 0;
	font-weight: 400;
	line-height: 1.4;
}
.hero .text h3{
	font-size: 24px;
	font-weight: 300;
}
.hero .text h2 span{
	font-weight: 600;
	color: #30e3ca;
}


/*HEADING SECTION*/
.heading-section{
}
.heading-section h2{
	color: #000000;
	font-size: 28px;
	margin-top: 0;
	line-height: 1.4;
	font-weight: 400;
}
.heading-section .subheading{
	margin-bottom: 20px !important;
	display: inline-block;
	font-size: 13px;
	text-transform: uppercase;
	letter-spacing: 2px;
	color: rgba(0,0,0,.4);
	position: relative;
}
.heading-section .subheading::after{
	position: absolute;
	left: 0;
	right: 0;
	bottom: -10px;
	content: '';
	width: 100%;
	height: 2px;
	background: #30e3ca;
	margin: 0 auto;
}

.heading-section-white{
	color: rgba(255,255,255,.8);
}
.heading-section-white h2{
	font-family:
	line-height: 1;
	padding-bottom: 0;
}
.heading-section-white h2{
	color: #ffffff;
}
.heading-section-white .subheading{
	margin-bottom: 0;
	display: inline-block;
	font-size: 13px;
	text-transform: uppercase;
	letter-spacing: 2px;
	color: rgba(255,255,255,.4);
}


ul.social{
	padding: 0;
}
ul.social li{
	display: inline-block;
	margin-right: 10px;
}

/*FOOTER*/

.footer{
	border-top: 1px solid rgba(0,0,0,.05);
	color: rgba(0,0,0,.5);
}
.footer .heading{
	color: #000;
	font-size: 20px;
}
.footer ul{
	margin: 0;
	padding: 0;
}
.footer ul li{
	list-style: none;
	margin-bottom: 10px;
}
.footer ul li a{
	color: rgba(0,0,0,1);
}
.crumina-icon {
    padding: 2px;
    font-size: 30px;
    width: 30px;
    text-align: center;
    text-decoration: none;
    margin: 5px 2px;
    border-radius: 50%;
  }

  .crumina-icon:hover {
      opacity: 0.7;
  }
  ul#menu li{
  display: inline;

}


@media screen and (max-width: 500px) {


}


    </style>


</head>

<body  width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
	<center style="width: 100%; background-color: #f1f1f1;">
    <div @if(App::isLocale('ar'))  style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: 'Droid Arabic Kufi', serif;" @else style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;" @endif>
      &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
    </div>
    <div style="max-width: 600px; margin: 0 auto;" class="email-container">
    	<!-- BEGIN BODY -->
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
          	<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
          		<tr>
          			<td class="logo" style="text-align: center;">
			            <h1><b>{{ __("Welcome to Almiqias") }}</b>.</h1>
			          </td>
          		</tr>
          	</table>
          </td>
	      </tr><!-- end tr -->
	      <tr>
          <td valign="middle" class="hero bg_white" style="padding: 3em 0 2em 0;">
            <img src="{{ asset('../storage/images/email.png') }}" alt="" style="width: 300px; max-width: 600px; height: auto; margin: auto; display: block;">
          </td>
	      </tr><!-- end tr -->
				<tr>
          <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
            <table>
            	<tr>
            		<td>
            			<div class="text" style="padding: 0 2.5em; text-align: center;">
            				<h3><b>{{ __('Dear') }} {{ $data  }} @if(App::isLocale('ar'))،@else,@endif</b></h3>
            				<h3>{{ __('Welcome to Almiqias, now you are a part of our family and you can enjoy our services') }}</h3>
                            <p> <a @if(App::isLocale('ar')) href="{{route('home' , ['lang'=>'ar'] )}}" @else href="{{route('home' , ['lang'=>'en'] )}}" @endif class="btn btn-primary">{{ __('Home') }}</a></p>
                            <h3><b>{{ __('Let’s keep in touch') }}</b></h3>
                            <ul id ="menu" style="padding-inline-start: 0px;">
                                <li><a href="{{ \App\Models\Settings::first()->twitter }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/twitter.svg')}}" alt="twitter"></a></li>
                                <li><a href="{{ \App\Models\Settings::first()->facebook }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/facebook.svg')}}" alt="facebook"></a></li>
                                <li><a href="{{ \App\Models\Settings::first()->instagram }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/instagram.svg')}}" alt="instagram"></a></li>
                                <li><a href="{{ \App\Models\Settings::first()->snapshat }}"><img class="crumina-icon " loading="lazy" src="{{ asset('../asset1/img/theme-content/social-icons/snapchat.svg')}}" alt="instagram"></a></li>
                            </ul>
            			</div>
            		</td>
            	</tr>
            </table>
          </td>
	      </tr><!-- end tr -->
      <!-- 1 Column Text + Button : END -->
      </table>
      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      	<tr>
          <td valign="middle" class="bg_light footer email-section">
            <table>
            	<tr>
                <td valign="top" width="33.333%" style="padding-top: 20px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td @if(App::isLocale('ar')) style="text-align: right; padding-left: 10px;" @else style="text-align: left; padding-right: 10px;"@endif >
                      	<h3 class="heading"> @if(App::isLocale('ar')) {{ \App\Models\Settings::first()->sitename_ar }} @else {{ \App\Models\Settings::first()->sitename_en }} @endif</h3>
                      	<p>@if(App::isLocale('ar')) {{ \App\Models\Settings::first()->description_ar }} @else {{ \App\Models\Settings::first()->description_en }} @endif</p>
                      </td>
                    </tr>
                  </table>
                </td>
                <td valign="top" width="33.333%" style="padding-top: 20px;">
                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                    <tr>
                      <td @if(App::isLocale('ar')) style="text-align: right; padding-right: 10px;" @elsestyle="text-align: left; padding-left: 10px;" @endif>
                      	{{--  <h3 class="heading">Useful Links</h3>  --}}
                      	<ul>
                            <li><a  @if(App::isLocale('ar')) <a href="{{route('about' , ['lang'=>'ar'] )}}" @else <a href="{{route('about' , ['lang'=>'en'] )}}" @endif >{{ __("About Almiqias") }}</a></li>
                            <li><a  @if(App::isLocale('ar')) <a href="{{route('common' , ['lang'=>'ar'] )}}" @else <a href="{{route('common' , ['lang'=>'en'] )}}" @endif {{--  target="_blank"  --}}>{{ __("Common Questions") }}</a></li>
                            <li><a  @if(App::isLocale('ar')) <a href="{{route('privacy_policy' , ['lang'=>'ar'] )}}" @else <a href="{{route('privacy_policy' , ['lang'=>'en'] )}}" @endif>{{ __("Privacy Policy") }}</a></li>
                            <li><a  @if(App::isLocale('ar')) <a href="{{route('terms_of_service' , ['lang'=>'ar'] )}}" @else <a href="{{route('terms_of_service' , ['lang'=>'en'] )}}" @endif>{{ __("Instructions for use") }}</a></li>
                            <li><a  @if(App::isLocale('ar')) <a href="{{route('contact' , ['lang'=>'ar'] )}}" @else <a href="{{route('contact' , ['lang'=>'en'] )}}" @endif>{{ __("Contact us") }}</a></li>
					    </ul>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr><!-- end: tr -->
        <tr>
          <td class="bg_light" style="text-align: center;">
          	<p>{{ __("Copyright")}} &copy; 2020 {{ __("Almiqias") }} | {{ __("All rights Reserved.") }}</p>
          </td>
        </tr>
      </table>

    </div>
  </center>
</body>
</html>
