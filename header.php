<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

if($_GET['delete_url'] != "")
{
$current_user = wp_get_current_user();
$logged_in_user_id = $current_user->ID;
$fil_url = $_GET['delete_url'];
$get_file_id = mysql_query("select * from psi_usermeta where meta_value = '$fil_url' and user_id = '$logged_in_user_id' limit 1");
while ($row_get_file_id = mysql_fetch_object($get_file_id)) 
{
$get_file_id_num1 = $row_get_file_id->umeta_id; 
$max_limit = $get_file_id_num1+4;
// check max limit for old record//
$get_file_id_meta = mysql_query("select * from psi_usermeta where umeta_id = '$max_limit'");
while ($row_get_meta_id = mysql_fetch_object($get_file_id_meta)) 
{
$get_file_num_meta = $row_get_meta_id->meta_key;
}
if($get_file_num_meta != "user_tax_id")
{
$max_limit = $get_file_id_num1+2;
}
// check max limit for old record OVER//

$min_limit = $get_file_id_num1-8;
// getting detail of deleted file/////

$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$min_limit' and meta_key = 'user_file_name'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$file_name_file_meta_value = $recent_ids_query->meta_value ;
}
// getting detail of deleted file OVER /////


mysql_query("delete from psi_usermeta where umeta_id >= '$min_limit' and umeta_id <= '$max_limit'");

//unlink($_GET['delete_url']);
$get_file_name = $_GET['delete_url'];
$get_file_name_array = explode("upload/", $get_file_name);
$file_name2 = $get_file_name_array[1];
unlink('upload/'.$file_name2) ;
// send mail to admin to deleted by user
$content_mail = 'A file has been uploaded by User - '.$current_user->user_login."<br>";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: PSI Shipping <warehouse@psishipping.com>' . "\r\n";

$content_mail = "A file has been deleted by user: ".$current_user->user_login."<br>";
$content_mail .= "File name is: ".$file_name_file_meta_value;

$content_mail .= "<br><br><br><b>Thanks<br>PSI mail delivery System</b>";


wp_mail("alex@123789.org","File Deleted",$content_mail,$headers);
wp_mail("warehouse@psishipping.com","File Deleted",$content_mail,$headers);


?><script type="text/javascript">window.location.href = '<?php echo get_permalink( 569 );?>'; </script><?php 
}
} 
 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->

<html class="ui-mobile ui-mobile-rendering" xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">

<head>
<?php if ( is_user_logged_in() ) { ?>
<style type="text/css">
body{margin-top:-27px !important;}
</style>
<?php } ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon"> 
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="index, follow">
  <meta name="keywords" content="Courier, small packages, import, export documentation, Air, Ocean freight, Cargo, Heavy equipment, Nigeria, West Africa, Europe, Dubai and Middle East">
  <meta name="description" content="PSI Shipping
Courier for Letters and small packages, Shipment documentations and inspections, Shipping of Machineries and Industrials Equipments, Freight forwarding to Africa,Nigeria at the speed of commerce">
  <meta name="generator" content="PSI">
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <!--<link href=" feed/rss.html" rel="alternate" type="application/rss+xml" title="RSS 2.0">
  <link href=" feed/atom.html" rel="alternate" type="application/atom+xml" title="Atom 1.0">-->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/front.css" type="text/css" media="screen">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/calendar.css" type="text/css" media="screen">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/front.css" type="text/css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/diapo.css" type="text/css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/djmultitreemenu.css" type="text/css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/djmultitreemenu_fx.css" type="text/css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/lightbox.css" media="screen"/>
   <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.css" type="text/css" media="screen">
  <!--<script async="" src="PSI%20SHIPPING_files/cbgapi.loaded_1"></script>-->
  <!--<script async="" src="js/cbgapi.loaded_0"></script>-->
  <script src="<?php echo get_template_directory_uri(); ?>/js/all.js" id="facebook-jssdk"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/functions.js" defer="defer"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/mootools.js" defer="defer"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/caption.js" defer="defer"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/functions.js" defer="defer"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/djmultitreemenu.js" defer="defer"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js" defer="defer"></script>
    
  <script type="text/javascript">

	(function($){ // Mootools Safe Mode ON
	
	window.addEvent('domready',function(){
		var DJTreeMenusAll = $('dj-mtmenu81').getChildren('li.dj-up');
		var wrapper = $('');
		DJTreeMenusAll.each(function(djmenu){
			if(djmenu.getElement('.dj-drop')) {
				DJTreeMenus.include(new DJTreeMenu(djmenu,0,wrapper,{transition: Fx.Transitions.Cubic.easeOut, duration: 300, delay: 2000, submenu_tree: 0,
		height_fx: true, width_fx: true, opacity_fx: true, mid: 81 }));
			} else {
				djmenu.addEvent('mouseenter',function(){
					djmenu.addClass('hover');
				});
				djmenu.addEvent('mouseleave',function(){
					djmenu.removeClass('hover');
				});
			}
		});	
	});
	
	})(document.id);
  </script>

  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/system.css" type="text/css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/general.css" type="text/css">
 

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/script.js" defer="defer"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/calendarDateInput.js" defer="defer"></script><style>
td.calendarDateInput {letter-spacing:normal;line-height:normal;font-family:Tahoma,Sans-Serif;font-size:11px;}
select.calendarDateInput {letter-spacing:.06em;font-family:Verdana,Sans-Serif;font-size:11px;}
input.calendarDateInput {letter-spacing:.06em;font-family:Verdana,Sans-Serif;font-size:11px;}
</style>

<!-- <script src="getAppDefault.esi" type="text/javascript"></script>
 <script src="checkOAuth.esi" type="text/javascript"></script>-->
 <link href="<?php echo get_template_directory_uri(); ?>/css/buttons.css" type="text/css" rel="stylesheet">
 <script gapi_processed="true" src="<?php echo get_template_directory_uri(); ?>/js/plusone.js" type="text/javascript" defer="defer"></script>
 
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
<?php wp_head(); ?>
<script type="text/javascript">
function register_validation()
{
if(document.getElementById('user_nm').value == "")
{
alert("User name can not be empty");
document.getElementById("user_nm").focus();
return false
}
if(document.getElementById('password').value == "")
{
alert("Password can not be empty");
document.getElementById("password").focus();
return false
}
if(document.getElementById('e_mail').value == "")
{
alert("User E-mail can not be empty");
document.getElementById("e_mail").focus();
return false
}
}
function register_validation2()
{
if(document.getElementById('user_nm').value == "")
{
alert("User name can not be empty");
document.getElementById("user_nm").focus();
return false
}
if(document.getElementById('e_mail').value == "")
{
alert("User E-mail can not be empty");
document.getElementById("e_mail").focus();
return false
}
}
</script>
<!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//v2.zopim.com/?2I5mPr5UQTKrNGRLzJRUnRN1GWfXiUxl';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>
<!--End of Zopim Live Chat Script-->
</head>
<body>
<?php 
global $post;
?>

<div class="container">

<div class="header-main row">




<div class="row">

<div class="Header">
<div class="log_in_data"><ul>
<?php if ( is_user_logged_in()) { ?>
<li><a href="<?php echo get_permalink( 740 ); ?>"> <span class="user_account_head">Profile</span></a></li>
<?php } ?>

<!-- li><a href="<?php echo get_permalink( 569 ); ?>"><?php if ( is_user_logged_in() ) { ?> <span class="user_account_head">PSI VBX</span><?php } else {?>Login<?php } ?></a></li -->
<!-- li><?php if ( !is_user_logged_in() ) { ?><a href="<?php echo get_permalink( 562 ); ?>">Signup</a><?php } else {  
?>
<span class="top_login"><?php 
if( is_active_sidebar( 'login_section' ) ) : dynamic_sidebar( 'login_section' ); endif; 
?></span>
<?php 
 } ?> </li --></ul></div>

<div class="col-md-4 col-sm-3">
 <a href="<?php echo get_site_url();?>"><div class="Header-jpeg"></div></a>

</div>

<div class="col-md-8 col-sm-9 header-menu">

<?php 
   
   $defaults12 = array(
	'theme_location'  => '',
	'menu'            => 'Main Menu',
	'container'       => 'div',
	'container_class' => 'menuItem',
	'container_id'    => '',
	'menu_class'      => 'dj-mtmenu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => ''
);
?>

  <div id="window_menu"><?php uberMenu_easyIntegrate(); ?> </div>
<!--
<div id="mobile_menu"><?php  
   // wp_nav_menu(  $defaults12 );
   ?></div>
-->
<!--<div class="menuItem"><ul id="dj-mtmenu81" class="dj-mtmenu">
   
   
   <?php //echo get_permalink( 18 ); ?>
   
<li class="dj-up Itemid1 first <?php if($post->ID == 18) {?>active<?php } ?>"><a href="<?php echo get_permalink( 18 ); ?>" class="dj-up_a active"><span>Home</span></a></li>


<li class="dj-up Itemid3 "><a href="<?php echo get_permalink( 18 ); ?>" class="dj-up_a "><span class=" dj-drop  item3">Ship</span></a>
<div class="djsubwrap" style="left:0px;"><div class="cols_3"><div class="sub-bg">
<ul class="dj-submenu clearfix">
<li class=" Itemid79 separator"><a class="dj-more">Express Freight</a>
<ul class="dj-submenu2">
<li class=" Itemid83"><a href="<?php echo get_permalink( 144 ); ?>" class="">Get rates</a></li>
<li class=" Itemid84"><a href="<?php echo get_permalink( 134 ); ?>" class="">Courier</a></li>
<li class=" Itemid85"><a href="<?php echo get_permalink( 33 ); ?>" class="">Door to Door</a></li>
<li class=" Itemid86"><a href="<?php echo get_permalink( 142 ); ?>" class="">Ground Transportation</a></li>
</ul>
</li>
<li class=" Itemid80"><a href="#" class="dj-more">Air Freight</a>
<ul class="dj-submenu2">
<li class=" Itemid88"><a href="<?php echo get_permalink( 195 ); ?>" class="">Get rates</a></li>
<li class=" Itemid89"><a href="<?php echo get_permalink( 146 ); ?>" class="">Freight Forwarding</a></li>
<li class=" Itemid90"><a href="<?php echo get_permalink( 148 ); ?>" class="">Packaging and Crating</a></li>
<li class=" Itemid92"><a href="<?php echo get_permalink( 172 ); ?>" class="">Warehousing</a></li>
<li class=" Itemid93"><a href="<?php echo get_permalink( 188 ); ?>" class="">Custom Clearing</a></li>
<li class=" Itemid94"><a href="<?php echo get_permalink( 192 ); ?>" class="">Package Protection</a></li>
</ul>
</li>
<li class=" Itemid81"><a href="#" class="dj-more">Ocean Freight</a>
<ul class="dj-submenu2">
<li class=" Itemid96"><a href="<?php echo get_permalink( 197 ); ?>" class="">Get rates</a></li>
<li class=" Itemid97"><a href="<?php echo get_permalink( 199 ); ?>" class="">Ocean tracking</a></li>
<li class=" Itemid18"><a href="<?php echo get_permalink( 293 ); ?>" class="">Get a custom quote</a></li>
<li class=" Itemid98"><a href="<?php echo get_permalink( 202 ); ?>" class="">Cargo Insurance</a></li>
<li class=" Itemid99"><a href="<?php echo get_permalink( 207 ); ?>" class="">Package Protection</a></li>
<li class=" Itemid100"><a href="<?php echo get_permalink( 288 ); ?>" class="">Enterprise clients</a></li>
</ul>
</li>
</ul>
 </div></div></div></li>
 
 
<li class="dj-up Itemid75 "><a href="<?php echo get_permalink( 146 ); ?>" class="dj-up_a "><span class=" dj-drop  item75">What We Do</span></a>
<div class="djsubwrap" style="left:0px;"><div class="cols_3"><div class="sub-bg">
									<ul class="dj-submenu clearfix">
<li class=" Itemid77"><a href="#" class="dj-more">Industries</a>
<ul class="dj-submenu2">
<li class=" Itemid102"><a href="<?php echo get_permalink( 211 ); ?>" class="">Oil &amp; Gas Projects</a></li>
<li class=" Itemid103"><a href="<?php echo get_permalink( 222 ); ?>" class="">Construction</a></li>
<li class=" Itemid104"><a href="<?php echo get_permalink( 228 ); ?>" class="">Automotive</a></li>
<li class=" Itemid108"><a href="<?php echo get_permalink( 238 ); ?>" class="">Customized Solutons</a></li>
<li class=" Itemid109"><a href="<?php echo get_permalink( 240 ); ?>" class="">Retail</a></li>
<li class=" Itemid121"><a href="<?php echo get_permalink( 242 ); ?>" class="">Telecommunications</a></li>
</ul>
</li>
<li class=" Itemid105"><a href="#" class="dj-more">Solutions</a>
<ul class="dj-submenu2">
<li class=" Itemid106"><a href="<?php echo get_permalink( 249 ); ?>" class="">Ecommerce</a></li>
<li class=" Itemid107"><a href="<?php echo get_permalink( 251 ); ?>" class="">Project Cargo</a></li>
<li class=" Itemid110"><a href="<?php echo get_permalink( 259 ); ?>" class="">Financial Services</a></li>
<li class=" Itemid111"><a href="<?php echo get_permalink( 261 ); ?>" class="">Global Logistics</a></li>
<li class=" Itemid112"><a href="<?php echo get_permalink( 291 ); ?>" class="">Easy Billing</a></li>
</ul>
</li>
<li class=" Itemid113"><a href="#" class="dj-more">Partner Programs</a>
<ul class="dj-submenu2">
<li class=" Itemid114"><a href="<?php echo get_permalink( 264 ); ?>" class="">Referral Program</a></li>
<li class=" Itemid115"><a href="<?php echo get_permalink( 209 ); ?>" class="">Enterprise Program</a></li>
<li class=" Itemid116"><a href="<?php echo get_permalink( 267 ); ?>" class="">Brand Partner</a></li>
</ul>
</li>
</ul>
 </div></div></div></li>
 
 
 
<li class="dj-up Itemid130  separator"><a class="dj-up_a"><span class=" dj-drop  item130">Charter</span></a>
<div class="djsubwrap" style="left:0px;"><div class="cols_1"><div class="sub-bg">
									<ul class="dj-submenu clearfix">
<li class=" Itemid137 separator"><a class="dj-more">Project Charter</a>
<ul class="dj-submenu2">
<li class=" Itemid133"><a href="<?php echo get_permalink( 269 ); ?>" class="">Air Charter</a></li>
<li class=" Itemid135"><a href="<?php echo get_permalink( 275 ); ?>" class="">Ocean Charter</a></li>
</ul>
</li>
</ul>
 </div></div></div></li>
 
 
 
<li class="dj-up Itemid136 "><a href="<?php echo get_permalink( 24 ); ?>" class="dj-up_a "><span>E-Client</span></a></li>



<li class="dj-up Itemid7 last "><a class="dj-up_a"><span class=" dj-drop  item7">Help</span></a>
<div class="djsubwrap" style="left:0px;"><div class="cols_1"><div class="sub-bg">
									<ul class="dj-submenu clearfix">
<li class=" Itemid101"><a href="#" class="">Help</a>

<ul class="dj-submenu2">
<li class=" Itemid50"><a href="<?php echo get_permalink( 286 ); ?>" class="">Support Desk</a>
</li>
<li class=" Itemid56"><a href="<?php echo get_permalink( 280 ); ?>" class="">File a Claim</a></li>
<li class=" Itemid59"><a href="<?php echo get_permalink( 284 ); ?>" class="">Got Questions ?</a>
</li>
<li class=" Itemid60"><a href="<?php echo get_permalink( 282 ); ?>" class="">Current Updates</a>
</li>
<li class=" Itemid145"><a href="<?php echo get_permalink( 68 ); ?>" class="">Contact Us</a></li>
</ul>
</li>
</ul>
 </div></div></div></li>
 
 
 
</ul></div>-->



</div>


</div>


</div>

<div class="row">
	<!-- div class="loginBg">
	<a href="/psi-virtual-box-account"><img src="<?php echo get_template_directory_uri(); ?>/images/vbx_banner.jpg">	</a>
	</div -->

</div>

</div>
<script type="text/javascript">
//$( '<div Id="MobMenu"> <a href="#">MENU </a> </div>' ).insertBefore( '#megaUber' );

jQuery('#megaUber').before('<div Id="MobMenu"> <a href="javascript:void(0);" id="MobMenu2">MENU </a> </div>');



</script>


<div class="Main ">
<div class="Sheet">