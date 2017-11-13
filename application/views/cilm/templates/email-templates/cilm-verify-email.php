<?php
/**
 * cilm_email.php
 *
 * @author Bayu Syaits Dhin Anwar
 * @link limomonoto.com
 * @version 1.0
 * @date 10-Juny-2017
 * @package PHPMailer Templates
 **/
?>
<!-- Inliner Build Version 4380b7741bb759d6cb997545f3add21ad48f010b -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
  <head>
 	<title><?php echo $title ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width" />
  </head>
  <script type="text/javascript">
	 $(document).ready(function () {
	  $('img').mousedown(function (e) {
	  if(e.button == 2) { // right click
	    return false; // do nothing!
	  }
	})
	});
  </script>
  <body style="width: 100% !important; min-width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 1.6em; font-size: 1em; text-decoration: none; margin: 0; padding: 0;"><style type="text/css">
::selection {
	background: rgba(77,79,81,0.11);
	text-shadow: none;
}
a {
	text-decoration: none;
}
a:hover {
background-color: #e63737 !important;
}
a:active {
background-color: #e63737 !important;
}
a:visited {
background-color: #e63737 !important;
}
h1 a:active {
color: #f0503f !important;
}
h2 a:active {
color: #f0503f !important;
}
h3 a:active {
color: #f0503f !important;
}
h4 a:active {
color: #f0503f !important;
}
h5 a:active {
color: #f0503f !important;
}
h6 a:active {
color: #f0503f !important;
}
h1 a:visited {
color: #f0503f !important;
}
h2 a:visited {
color: #f0503f !important;
}
h3 a:visited {
color: #f0503f !important;
}
h4 a:visited {
color: #f0503f !important;
}
h5 a:visited {
color: #f0503f !important;
}
h6 a:visited {
color: #f0503f !important;
}
table.button:hover td {
background: #f0503f !important;
}
table.button:visited td {
background: #f0503f !important;
}
table.button:active td {
background: #f0503f !important;
}
table.button:hover td a {
color: #c0bebc !important;
}
table.button:visited td a {
color: #f0503f !important;
}
table.button:active td a {
color: #f0503f !important;
}
table.button:hover td {
background: #f0503f !important;
}
table.tiny-button:hover td {
background: #f0503f !important;
}
table.small-button:hover td {
background: #f0503f !important;
}
table.medium-button:hover td {
background: #f0503f !important;
}
table.large-button:hover td {
background: #f0503f !important;
}
table.button:hover td a {
color: #c0bebc !important;
}
table.button:active td a {
color: #f0503f !important;
}
table.button td a:visited {
color: #f0503f !important;
}
table.tiny-button:hover td a {
color: #c0bebc !important;
}
table.tiny-button:active td a {
color: #f0503f !important;
}
table.tiny-button td a:visited {
color: #f0503f !important;
}
table.small-button:hover td a {
color: #c0bebc !important;
}
table.small-button:active td a {
color: #f0503f !important;
}
table.small-button td a:visited {
color: #f0503f !important;
}
table.medium-button:hover td a {
color: #c0bebc !important;
}
table.medium-button:active td a {
color: #f0503f !important;
}
table.medium-button td a:visited {
color: #f0503f !important;
}
table.large-button:hover td a {
color: #c0bebc !important;
}
table.large-button:active td a {
color: #f0503f !important;
}
table.large-button td a:visited {
color: #f0503f !important;
}
table.secondary:hover td {
background: #d0d0d0 !important; color: #4d4f51;
}
table.secondary:hover td a {
color: #4d4f51 !important;
}
table.secondary td a:visited {
color: #4d4f51 !important;
}
table.secondary:active td a {
color: #4d4f51 !important;
}
table.success:hover td {
background: #457a1a !important;
}
table.alert:hover td {
background: #f0503f !important;
}
table.facebook:hover td {
background: #c0bebc !important;
}
table.twitter:hover td {
background: #0087bb !important;
}
table.google-plus:hover td {
background: #CC0000 !important;
}
.lm-em-verify-submit {
	width: 100%;
    outline: 0;
    border: 0;
}
@media only screen and (max-width: 600px) {
  table[class="body"] img {
    width: auto !important; height: auto !important;
  }
  table[class="body"] center {
    min-width: 0 !important;
  }
  table[class="body"] .container {
    width: 95% !important;
  }
  table[class="body"] .row {
    width: 100% !important; display: block !important;
  }
  table[class="body"] .wrapper {
    display: block !important; padding-right: 0 !important;
  }
  table[class="body"] .columns {
    table-layout: fixed !important; float: none !important; width: 100% !important; padding-right: 0px !important; padding-left: 0px !important; display: block !important;
  }
  table[class="body"] .column {
    table-layout: fixed !important; float: none !important; width: 100% !important; padding-right: 0px !important; padding-left: 0px !important; display: block !important;
  }
  table[class="body"] .wrapper.first .columns {
    display: table !important;
  }
  table[class="body"] .wrapper.first .column {
    display: table !important;
  }
  table[class="body"] table.columns td {
    width: 100% !important;
  }
  table[class="body"] table.column td {
    width: 100% !important;
  }
  table[class="body"] .columns td.one {
    width: 8.333333% !important;
  }
  table[class="body"] .column td.one {
    width: 8.333333% !important;
  }
  table[class="body"] .columns td.two {
    width: 16.666666% !important;
  }
  table[class="body"] .column td.two {
    width: 16.666666% !important;
  }
  table[class="body"] .columns td.three {
    width: 25% !important;
  }
  table[class="body"] .column td.three {
    width: 25% !important;
  }
  table[class="body"] .columns td.four {
    width: 33.333333% !important;
  }
  table[class="body"] .column td.four {
    width: 33.333333% !important;
  }
  table[class="body"] .columns td.five {
    width: 41.666666% !important;
  }
  table[class="body"] .column td.five {
    width: 41.666666% !important;
  }
  table[class="body"] .columns td.six {
    width: 50% !important;
  }
  table[class="body"] .column td.six {
    width: 50% !important;
  }
  table[class="body"] .columns td.seven {
    width: 58.333333% !important;
  }
  table[class="body"] .column td.seven {
    width: 58.333333% !important;
  }
  table[class="body"] .columns td.eight {
    width: 66.666666% !important;
  }
  table[class="body"] .column td.eight {
    width: 66.666666% !important;
  }
  table[class="body"] .columns td.nine {
    width: 75% !important;
  }
  table[class="body"] .column td.nine {
    width: 75% !important;
  }
  table[class="body"] .columns td.ten {
    width: 83.333333% !important;
  }
  table[class="body"] .column td.ten {
    width: 83.333333% !important;
  }
  table[class="body"] .columns td.eleven {
    width: 91.666666% !important;
  }
  table[class="body"] .column td.eleven {
    width: 91.666666% !important;
  }
  table[class="body"] .columns td.twelve {
    width: 100% !important;
  }
  table[class="body"] .column td.twelve {
    width: 100% !important;
  }
  table[class="body"] td.offset-by-one {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-two {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-three {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-four {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-five {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-six {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-seven {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-eight {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-nine {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-ten {
    padding-left: 0 !important;
  }
  table[class="body"] td.offset-by-eleven {
    padding-left: 0 !important;
  }
  table[class="body"] table.columns td.expander {
    width: 1px !important;
  }
  table[class="body"] .right-text-pad {
    padding-left: 10px !important;
  }
  table[class="body"] .text-pad-right {
    padding-left: 10px !important;
  }
  table[class="body"] .left-text-pad {
    padding-right: 10px !important;
  }
  table[class="body"] .text-pad-left {
    padding-right: 10px !important;
  }
  table[class="body"] .hide-for-small {
    display: none !important;
  }
  table[class="body"] .show-for-desktop {
    display: none !important;
  }
  table[class="body"] .show-for-small {
    display: inherit !important;
  }
  table[class="body"] .hide-for-desktop {
    display: inherit !important;
  }
  table[class="body"] .right-text-pad {
    padding-left: 10px !important;
  }
  table[class="body"] .left-text-pad {
    padding-right: 10px !important;
  }
}
</style>
  <table class="body" width="100%" height="100%" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; 
    background-color: #fff; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 1em; margin: 0; padding: 0;">
    <tbody>
    <tr style="vertical-align: top; text-align: left; padding: 0;" align="left">
  <td class="center" align="center" valign="top" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 1.6rem; font-size: 1me; margin: 0; padding: 40px 0 0;">
        <center style="width: 100%; min-width: 600px; padding-bottom:20px;">

          <table class="row header" style="height: 100%; width: 100%; max-width: 600px; min-width: 320px; border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; position: relative; background: #fff; padding: 0px;" bgcolor="#fff"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td class="center" align="center" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: center; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" valign="top">
                <center style="width: 100%; min-width: 600px;">

                  <table class="container" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: inherit; width: 600px; margin: 0 auto; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">

                        <table class="twelve columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 600px; margin: 0 auto; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td class="six sub-columns" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; min-width: 0px; width: 50%; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 10px 10px 0px;" align="left" valign="top">
                              
                              <img src="https://cdn.limononoto.com/cilm/images/favicon/logo.png" style="outline: none; text-decoration: none; -ms-interpolation-mode: bicubic; width: 100%; max-width: 36px; float: left; clear: both; display: block;" align="left" />

</td>
                            <td class="six sub-columns last" style="text-align: right; vertical-align: middle; word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; min-width: 0px; width: 50%; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="right" valign="middle">
                              <span class="template-label" style="color: #f0503f; font-weight: bold; font-size: 11px;"><a class="a-web-content" style="color: #f0503f; font-size: 1em; text-decoration:none; letter-spacing:0.25px; text-transform:lowecase; " href="https://limononoto.com">limononoto.com</a></span>
                            </td>
                            <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
                          </tr></table></td>
                    </tr></table></center>
              </td>
            </tr></table><table class="container" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: inherit; width: 600px; margin: 0 auto; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top">

                <table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 10px 0px 0px;" align="left" valign="top">

                      <table class="twelve columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 600px; margin: 0 auto; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
                      
                      
<h1 style="color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif;  text-align: left; line-height: 2.8rem; word-break: normal; font-size: 1em; font-weight:500; border: 1px solid  #e7e7e7; -webkit-border: 1px solid #e7e7e7; text-transform: uppercase; letter-spacing: 1px; border-width: 1px 0px 1px 0; margin: 10px 0 40px; padding: 0;" align="left">
   <?php echo $subject ?>
</h1>
<p style="font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: justify; text-decoration: none; line-height: 24px; font-size: 16px; font-weight:500; letter-spacing: 0.25px; margin: 0 0 10px; padding: 20px 0; color: #676767" align="left"><strong style="color: #676767">Dear</strong><strong style="color: #337ab7 text-decoration:underline;"> <?php echo $email?></strong>
     <br/><br/>
<?php echo $paragraph ?><a class="lm-em-verify-submit lm-em-link-verify" id="lm-button-template-email" style="
	-webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    display: block;
    text-decoration: none;
    background-color: #f3202a;
    font-weight: 500;
    padding: 5px 30px 5px 30px;
    border-radius: 5px;
    letter-spacing: 0.3px;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    color: #fff;
    font-size: 18px;
    line-height: 36px;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(0,0,0,0.3);
    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);" href="<?php echo $link ?>">Verification Code</a><br/><br/>
                      
                      
</td>
  <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
</tr></table></td>
</tr></table><table class="row footer" style="text-decoration:none; border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; background: #fff; border: 1px solid  #e7e7e7; -webkit-border: 1px solid #e7e7e7; border-width: 0px 0 1px ; margin: 0; padding: 10px 0px 0px;" align="left" bgcolor="#fff" valign="top">

<table class="twelve columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 600px; margin: 0 auto; padding: 0;"><tr style="vertical-align: middle; text-align: left; padding: 0;" align="left"><td style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; color: #222222; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 1.4em; font-size: 1em; margin: 0; padding: 0px 0px 10px;" align="left" valign="top">
    <h5 style="color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: 600; text-align: left; line-height: 1.4; word-break: normal; font-size: 1em; margin: 0; padding: 0 0 15px;" align="left">Regard,</h5>
    <p style="color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 1.4; font-size: 0.88em; margin: 0 0 5px; padding: 0;" align="left">Bayu Syaits Dhin Anwar</p>
    <p style="color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; text-align: left; line-height: 1.4em; font-size: 0.88em; margin: 0 0 20px; padding: 0;" align="left">CEO & Founder Limononoto Design <!--<a href="" style="color: #2ba6cb; text-decoration: none;">yourweb</a>--></p> 
  </td>
  <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 1.8em; font-size: 1em; margin: 0; padding: 0;" align="left" valign="top"></td>
</tr></table></td>
</tr></table><table class="row" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 100%; position: relative; display: block; padding: 0px; text-decoration: none;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td class="wrapper last" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; position: relative; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 1.6rem; font-size: 1em; margin: 0; padding: 00px 0px 0px; text-decoration: none;" align="left" valign="top">

<table class="twelve columns" style="border-spacing: 0; border-collapse: collapse; vertical-align: top; text-align: left; width: 600px; margin: 0 auto; padding: 0;"><tr style="vertical-align: top; text-align: left; padding: 0;" align="left"><td align="left" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: middle; text-align: left; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 1.4rem; font-size: 0.78em; margin: 0; padding: 0px 0px 0px; text-decoration: none;" valign="middle">
    <center style="width: 100%; min-width: 600px; text-decoration:none; color: #4d4f51;">
      <p style="text-align: left; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; line-height: 1.4rem; font-size: 0.83em; letter-spacing:0.25px; font=weight: 300; margin: 0 0 10px; padding: 20px 0px; text-decoration: none;" align="left">&copy;  <?php echo date('Y');?>  Limononoto Design. All Right Reserved<!--<a href="#" style="color: #4d4f51; text-decoration: none;">medsos</a>--></p>
    </center>
  </td>
  <td class="expander" style="word-break: break-word; -webkit-hyphens: auto; -moz-hyphens: auto; hyphens: auto; border-collapse: collapse !important; vertical-align: top; text-align: left; visibility: hidden; width: 0px; color: #4d4f51; font-family: 'Helvetica', 'Arial', sans-serif; font-weight: normal; line-height: 19px; font-size: 14px; margin: 0; padding: 0;" align="left" valign="top"></td>
</tr></table></td>
</tr></table><!-- container end below --></td>
</tr></table></center>
</td>
</tr></tbody></table></body>
</html>