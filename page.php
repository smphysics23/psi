<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
get_header(); ?>
	<div class="row">
<div class="contentLayout">
		<div class="cleared"></div>
        <div class="row">
<div class="internationalSupportBlock">
<div class="col-md-4 col-sm-4">
<div class="leftContainer">
                <div class="sideLogo">
                <img mce_src="<?php echo get_template_directory_uri(); ?>/images/international-support.gif" src="<?php echo get_template_directory_uri(); ?>/images/international-support.gif">
                </div>
                <div class="sideMenu1">
                <div class="ImportantLinksTxt">
                <img src="<?php echo get_template_directory_uri(); ?>/images/smallArrow.gif" mce_src="<?php echo get_template_directory_uri(); ?>/images/smallArrow.gif">&nbsp; Important links</div>
                <?php //wp_nav_menu( array( 'menu' => 'Home Left Menu', 'menu_class'=> 'ImportantLinks' ) );?>
                <?php if( is_active_sidebar( 'left_menu' ) ) : dynamic_sidebar( 'left_menu' ); endif;  ?>
                </div>
                <div class="sideForm">
                <?php echo do_shortcode( '[contact-form-7 id="9" title="REQUEST A FREE QUOTE"]' ); ?>
                </div>
                <div class="sideMenu2">
                <ul>
                <li> > <a href="<?php echo get_permalink( 336 ); ?>">INSTANT LIVE TRACKING</a></li>
                <li> > <a href="http://www.oceanschedules.com/schedules/search.do" target="_blank" mce_href="http://www.oceanschedules.com/schedules/search.do">OCEAN FREIGHT SCHEDULE</a></li>
                <li> > <a href="<?php echo get_permalink( 337 ); ?>">WE PROCURE &nbsp SHIP ARMORED VEHICLE</a></li>
                <li> > <a href="<?php echo get_permalink( 338 ); ?>">LIVE SUPPORT ONLINE</a></li>
                </ul>
                </div>
                </div>
                </div>
<div class="col-md-8 col-sm-8">
<div class="rightContainer">
<div class="content-wide">
<div class="Post">
    <div class="Post-body">
<div class="Post-inner">
<h2 class="PostHeaderIcon-wrapper"> 	
<span class="PostHeader">
<?php the_title();  ?>
</span>
</h2>
<div class="PostContent">


<?php 
global $post;
$current_page_id = $post->ID;
if($current_page_id == 562)
{
?>
<div class="article">

<?php while ( have_posts() ) : the_post(); ?>
				
<div class="entry-content">

<?php 
if(!isset($_REQUEST['sub_mit']))
{
the_content(); 
}
else
{
// do user registeration
$publickey = "6LeU5OsSAAAAAP4yMGhGS_5Z4ltwfty7IyW2An_M";
$privatekey = "6LeU5OsSAAAAAGCwrdaBAk98IN9jaLFj6XjGFydA";
if ($_POST["recaptcha_response_field"]) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
                // Captcha success
				$_SESSION['Username'] = $user_name = $_POST['user_nm'];
$password = $_POST['password'];
$_SESSION['e_mail'] = $user_email = $_POST['e_mail'];
$_SESSION['na_me'] = $username = $_POST['na_me'];
$_SESSION['last_nm'] = $user_last_name = $_POST['last_nm'];

$user_registered_id = wp_create_user( $user_name, $password, $user_email);
if(gettype($user_registered_id) != 'object')
{
update_usermeta( $user_registered_id, 'first_name', $_POST['na_me']);
update_usermeta( $user_registered_id, 'last_name', $_POST['last_nm']);
update_usermeta( $user_registered_id, 'psi_ul_disabled', 1);
update_usermeta( $user_registered_id, 'send_first_mail', 'inactive');

echo '<div class="login_success">User registered successfully, after getting approval from Admin you can Login to your account <!--<a href="'.get_permalink( 569 ).'">click here</a> to login--></div>'; 
// send mail to admin and user
$admin_mail = get_settings('admin_email');
///////////////////////////////////////////////////////////////////////////////////////////
$to = "admin@psi.com";
$subject_admin = "A new user registerd successfully";
$subject_user = "you have registerd successfully";
$from = "admin@psi.com";
$conte_nt_admin = "A new User is registered with the following details<br>
User name: ".$user_name."<br>
User E-mail: ".$user_email."<br>
User First Name: ".$username."<br>
User Last Name: ".$user_last_name."
<br><br>
Thanks<br>
PSI Team
";
$conte_nt_user = "You have registered with the following details<br>
User name: ".$user_name."<br>
User E-mail: ".$user_email."<br>
User First Name: ".$username."<br>
User Last Name: ".$user_last_name."
<br>
Please Note that after getting approval from Admin you can Login to your account.
<br><br>
Thanks<br>
PSI Team
";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
//$headers .= 'From: admin@psi.com' . "\r\n";
$headers .= "From: PSI admin <admin@psi.com>\r\n";

//mail($admin_mail,$subject_admin,$conte_nt_admin,$headers);
//mail($user_email,$subject_user,$conte_nt_user,$headers);
wp_mail($admin_mail,$subject_admin,$conte_nt_admin,$headers);
wp_mail($user_email,$subject_user,$conte_nt_user,$headers);

unset($_SESSION['e_mail']);
unset($_SESSION['na_me']);
unset($_SESSION['last_nm']);
unset($_SESSION['Username']);
// register user additional detail :
add_user_meta( $user_registered_id, 'user_first_name', $username);
add_user_meta( $user_registered_id, 'user_last_name', $user_last_name );

update_user_meta( $user_registered_id, 'int_pass', $_POST['inter_pass']); 
update_user_meta( $user_registered_id, 'tax_id_usa', $_POST['tax_id']); 
update_user_meta( $user_registered_id, 'pho_ne_num', $_POST['pho_ne_num']); 


}
else
{
echo '<div class="login_success">Registration failed  ';
echo $user_registered_id->errors['existing_user_login'][0];
echo $user_registered_id->errors['existing_user_email'][0];
echo $user_registered_id->errors['empty_user_login'][0];
echo '</div>';
}
        } 
		else 
		{
                # set the error code so that we can display it
                //echo $error = $resp->error;
				//echo "Failure";
echo '<span class="inc_code">Incorrect Security Code <a href="';?>javascript:window.history.back(); <?php echo '">Click here</a></span>';

        }
		}
else
{
echo '<span class="inc_code">Incorrect Security Code <a href="';?>javascript:window.history.back(); <?php echo '">Click here</a></span>';
}	


}
?>
</div>
<?php endwhile; ?> 


</div>
<?php 
}
else if($current_page_id == 569)
{

?>
<div class="article">

<?php while ( have_posts() ) : the_post(); ?>
				
<div class="entry-content">

<?php 
if(!isset($_REQUEST['log_in']))
{
//the_content(); 
?><ul class="psi_account"><?php if( is_active_sidebar( 'login_section' ) ) : dynamic_sidebar( 'login_section' ); endif; ?> </ul><?php 
if ( is_user_logged_in() ) 
{  
?>
<div class="user_account">
<div class="welcome_user">Welcome 
<?php 
$current_user = wp_get_current_user();
//echo $logged_in_user_id = $current_user->user_login;

// get logged in user id 
$current_userg = wp_get_current_user();
echo $ffname = $current_userg->user_firstname."&nbsp;";
echo $llnname = $current_userg->user_lastname;
if(($current_userg->user_firstname == "")&&($current_userg->user_lastname == ""))
{
echo $logged_in_user_id = $current_user->user_login;
}
?>
<span style="float:right">Customer Number: 
<?php 
if(get_user_meta($current_user->ID, 'customer_number', true) != "")
{
echo get_user_meta($current_user->ID, 'customer_number', true);
}
else
{
echo "N/A";
}
?>


</span>
</div>
<script type="text/javascript">
function check_file_upload()
{
if(document.getElementById('file_name').value == "")
{
alert("File name can not be empty");
document.getElementById("file_name").focus();
return false;
}

if(document.getElementById('popupDatepicker').value == "")
{
alert("Delivery Date can not be empty");
document.getElementById("popupDatepicker").focus();
return false;
}

if(document.getElementById('ship_name').value == "")
{
alert("Shipper Name can not be empty");
document.getElementById("ship_name").focus();
return false;
}

if(document.getElementById('ph_number').value == "")
{
alert("Phone Number can not be empty");
document.getElementById("ph_number").focus();
return false;
}


if(document.getElementById('cons_name').value == "")
{
alert("Consignee Namee can not be empty");
document.getElementById("cons_name").focus();
return false;
}
if(document.getElementById('dest_add').value == "")
{
alert("Destination Address can not be empty");
document.getElementById("dest_add").focus();
return false;
}

if(document.getElementById('file_uplad').value == "")
{
alert("You need to upload file");
document.getElementById("file_uplad").focus();
return false;
}




}
</script>
<div id="fields_add">
<form name="upload_section" action="<?php get_permalink( 569 ); ?>" method="post" enctype="multipart/form-data" onsubmit="return check_file_upload();">
<div class="upload_fields">
<div class="upload_section">
<div class="re_field2"><div class="type_name">File name:</div><div class="type_field"><input type="text" name="file_name" id="file_name" value="" />&nbsp;&nbsp;</div></div>





<link type="text/css" href="<?php echo get_site_url();?>/wp-content/themes/PSI/jquery.datepick.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_site_url();?>/wp-content/themes/PSI/js/jquery.datepick.js"></script>
<script type="text/javascript">
$.noConflict();
jQuery(function() {
	jQuery('#popupDatepicker').datepick();
	jQuery('#inlineDatepicker').datepick({onSelect: showDate});
});

function showDate(date) {
	alert('The date chosen is ' + date);
}
</script>



<div class="re_field2"><div class="type_name">Delivery Date:</div><div class="type_field"><input type="text" name="deli_date" id="popupDatepicker" value="" />&nbsp;&nbsp;</div></div>

<div class="re_field2"><div class="type_name">Shipper Name:</div><div class="type_field"><input type="text" name="ship_name" id="ship_name" value="" />&nbsp;&nbsp;</div></div>

<div class="re_field2"><div class="type_name">Phone Number:</div><div class="type_field"><input type="text" name="ph_number" id="ph_number" value="" />&nbsp;&nbsp;</div></div>

<div class="re_field2"><div class="type_name">Consignee Namee:</div><div class="type_field"><input type="text" name="cons_name" id="cons_name" value="" />&nbsp;&nbsp;</div></div>

<div class="re_field2"><div class="type_name">Export Preference:</div><div class="type_field"><select name="export_pre"><option value="Air">Air</option><option value="Ocean">Ocean</option></select>&nbsp;&nbsp;</div></div>


<div class="re_field2" style="display:none;"><div class="type_name">international passport number:</div><div class="type_field"><input type="hidden" name="inter_pass" id="inter_pass" value="N/A" />&nbsp;&nbsp;</div></div>

<div class="re_field2" style="display:none;"><div class="type_name">Tax ID/EIN(USA only):</div><div class="type_field"><input type="hidden" name="tax_id" id="tax_id" value="N/A" />&nbsp;&nbsp;</div></div>



<div class="re_field2"><div class="type_name">Destination Address:</div><div class="type_field"><textarea name="dest_add" id="dest_add" cols="38" rows="4"></textarea>&nbsp;&nbsp;</div></div>






<div class="re_field2"><div class="type_name">Upload File:</div><div class="type_field"><input type="file" name="file_uplad" id="file_uplad" />(max size - 2MB)</div></div>
<div class="re_field2"><div class="type_name_submit"><input type="submit" name="file_sub" value="Upload" /></div></div>
</div>
</div>
</form>
</div>
<?php 
if(isset($_REQUEST['file_sub']))
{
$current_user = wp_get_current_user();
$logged_in_user_id = $current_user->ID;
$allowedExts = array("pdf", "doc", "docx","jpg","jpeg","gif","png","bmp","txt","tiff","xml","rtf","txt","and","csv","xls","xlsx","ppt","pptx","PCX","PSD","SGV","WMF","DXF","MET","PGM","RAS","SVM","XBM","EMF","PBM","PLT","SDA","TGA","XPM","EPS","PCD","PNG","SDD","TIF","TIFF","GIF","PCT","PPM","SGF","VOR","sdw","vor","html","htm"); 
$temp = explode(".", $_FILES["file_uplad"]["name"]);
$extension = end($temp); 
if (($_FILES["file_uplad"]["size"] < 2097152)&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file_uplad"]["error"] > 0)
    {
    echo '<div class="invalid">'."Failed! Invalid file".'</div>';
    }
  else
    {
    if (file_exists("upload/" . $logged_in_user_id.$_FILES["file_uplad"]["name"]))
      {
      echo '<div class="error_upload">'.$_FILES["file_uplad"]["name"] . " file already exists.Please upload other file of rename file and upload ".'</div>';
      }
    else
      {
	   move_uploaded_file($_FILES["file_uplad"]["tmp_name"],
      "upload/" . $logged_in_user_id.$_FILES["file_uplad"]["name"]);
	  
      //echo "Stored in: " . "upload/" . $_FILES["file_uplad"]["name"];
	  echo '<div class="invalid2">'."File Uploaded successfully".'</div>';  
	  
	  $upload_file_name = $_POST['file_name'];
	  
	  $upload_deli_date = $_POST['deli_date'];
	  $upload_ship_name = $_POST['ship_name'];
	  $upload_cons_name = $_POST['cons_name'];
	  $upload_export_pre = $_POST['export_pre'];
	  $upload_dest_add = $_POST['dest_add'];
	  $upload_ph_number = $_POST['ph_number'];
	  
	  $upload_passport = $_POST['inter_pass'];
	  $upload_tax_id = $_POST['tax_id'];
	  
	  
	  
	  add_user_meta( $logged_in_user_id, 'user_file_name', $upload_file_name);
	  
	  
	  
	  add_user_meta( $logged_in_user_id, 'user_deli_date', $upload_deli_date);
	  add_user_meta( $logged_in_user_id, 'user_ship_name', $upload_ship_name);
	  add_user_meta( $logged_in_user_id, 'user_cons_name', $upload_cons_name);
	  add_user_meta( $logged_in_user_id, 'user_export_pre', $upload_export_pre);
	  add_user_meta( $logged_in_user_id, 'user_dest_add', $upload_dest_add);
	  add_user_meta( $logged_in_user_id, 'user_phone_num', $upload_ph_number);
	  $file_number = time();
	  add_user_meta( $logged_in_user_id, 'unique_file_nm', $file_number);
	  
	  
	  
	  // send mail to admin
	  $admin_mail = get_settings('admin_email');
$content_mail = 'A file has been uploaded by User - '.$current_user->user_login."<br>";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: PSI Shipping <warehouse@psishipping.com>' . "\r\n";


$content_mail .= "<b>Details are Given Below:</b>"."<br>";
$content_mail .= "<b>File Number:</b> ".$file_number."<br>";
$content_mail .= "<b>First Name:</b> ".get_user_meta($logged_in_user_id, 'user_first_name', true)."<br>";
$content_mail .= "<b>Last Name:</b> ".get_user_meta($logged_in_user_id, 'user_last_name', true)."<br>";	
$content_mail .= "<b>E-mail: </b>".$current_user->user_email."<br>";  
$content_mail .= "<b>Phone Number:</b> ".get_user_meta($logged_in_user_id, 'user_phone_num', true)."<br>";
$content_mail .= "<b>Delivery date:</b> ".$upload_deli_date."(mm/dd/yyyy)<br>";	
$content_mail .= "<b>Shipper Name:</b> ".$upload_ship_name."<br>";	
$content_mail .= "<b>Consignee Name:</b> ".$upload_cons_name."<br>";	
$content_mail .= "<b>Export preference:</b> ".$upload_export_pre."<br>";	
$content_mail .= "<b>Destination Address:</b> ".$upload_dest_add."<br>";	
$content_mail .= "<br><br><br><b>Thanks<br>PSI mail delivery System</b>";
//$content_mail .= "<b>File Link:</b> ".get_site_url()."/upload/" .$logged_in_user_id. $_FILES["file_uplad"]["name"]."<br>";	
	   
	   //mail($admin_mail,"Upload File",$content_mail,$headers);
	   
	   $attachment = get_site_url()."/upload/" .$logged_in_user_id. $_FILES["file_uplad"]["name"];
	   wp_mail("alex@123789.org","File uploaded information",$content_mail,$headers,$attachment);
	   wp_mail("warehouse@psishipping.com","File uploaded information",$content_mail,$headers,$attachment);
	   
	   
	   
	  
    
	
	  $get_file_url = get_site_url()."/upload/" .$logged_in_user_id. $_FILES["file_uplad"]["name"];
	  add_user_meta( $logged_in_user_id, 'file_url', $get_file_url);
	  add_user_meta( $logged_in_user_id, 'upload_by', 'U');
	  $today_date = date("m/d/Y");
	  add_user_meta( $logged_in_user_id, 'upload_date', $today_date);
	  // additional fields//
	  add_user_meta( $logged_in_user_id, 'user_passport', $upload_passport);
	  add_user_meta( $logged_in_user_id, 'user_tax_id', $upload_tax_id);
	  
      }
    }
  }
else
  {
      if($_FILES["file_uplad"]["size"] > 2097152)
      {
      echo '<div class="invalid">'."Failed! Maximum allowed file size is 2MB".'</div>';  
      }
	  elseif(!in_array($extension, $allowedExts))
	  {
	  echo '<div class="invalid">'."Failed! Invalid file".'</div>';  
	  }
	  else
      {
      echo '<div class="invalid">'."Failed! Invalid file".'</div>';
      }
    }

}
$current_user = wp_get_current_user();
$logged_in_user_id = $current_user->ID;
$get_all_user = mysql_query("select * from psi_users where ID='$logged_in_user_id'");
while ($row = mysql_fetch_array($get_all_user)) {
$use_rid = $row['ID'];
$file_unique_num_array = get_user_meta($use_rid, 'unique_file_nm', false);
$file_name_array = get_user_meta($use_rid, 'user_file_name', false);
$file_url_array = get_user_meta($use_rid, 'file_url', false);
$file_upload_by_array = get_user_meta($use_rid, 'upload_by', false);

///////////////Paging//////////////////
$item_per_page = 10;
$total_records = count($file_unique_num_array);
if($_GET['pageid'] == "")
{
$curr_page = 0;
}
else
{
$curr_page = $_GET['pageid'];
}

if($curr_page < 0)
{
$curr_page = 0;
}
//echo $curr_page;
//echo (ceil($total_records/$item_per_page)*$item_per_page)-$item_per_page;
if($curr_page > ((ceil($total_records/$item_per_page)*$item_per_page)-$item_per_page))
{
$curr_page = (ceil($total_records/$item_per_page)*$item_per_page)-$item_per_page;
}




?>
<?php if($total_records > 0) { ?>
<div>
<ul class="top_paging">
<li><a href="<?php echo get_permalink( 569 );?>?pageid=0">&laquo;</a></li>
<?php 
$previous_page = $curr_page-$item_per_page;
if($previous_page<0)
{
$previous_page = 0;
}
$last_page = (ceil($total_records/$item_per_page)*$item_per_page)-$item_per_page;
?>
<li><a href="<?php echo get_permalink( 569 );?>?pageid=<?php echo $previous_page; ?>">&lt;</a></li>
<script type="text/javascript">
function change_val()
{
var item_per_page = <?php echo $item_per_page; ?>;
var last_page = <?php echo $last_page; ?>;
var req_page = document.getElementById("current_user_paging").value;
var now_val = (req_page * item_per_page)-item_per_page;
document.getElementById("pageid_pageid").value = now_val;
}
function sub_form()
{

}
</script>


<?php 
for($pag=1;$pag<=ceil($total_records/$item_per_page);$pag++)
{
$start_limit = ($pag*$item_per_page)-$item_per_page;
$current_page_hover = ($curr_page/$item_per_page)+1;
?><!--<li <?php if($current_page_hover == $pag){echo 'class = "current_page_hover"';}?>><a href="<?php echo get_permalink( 569 );?>?pageid=<?php echo $start_limit; ?><?php if($_GET['sort_date'] != ""){echo "&sort_date=".$_GET['sort_date'];}?>"><?php echo $pag;  ?></a></li>-->


<?php if($current_page_hover == $pag){ ?>
<li style="background-color:#FFFFFF !important;">
<form method="get" action="<?php echo get_permalink( 569 ); ?>" onsubmit="return sub_form()">
<input type="text" name="current_user_paging" id="current_user_paging" size="1" value="<?php echo $pag;?>" style="width:20px; height:18px; text-align:center;" onkeyup="javascript:change_val();" />
<input type="hidden" name="pageid" id="pageid_pageid" size="1" value="<?php echo $pag*$item_per_page;?>" style="width:20px; height:20px;" />
</form>


</li> <li style="background:none !important; font-weight:normal !important; width:40px !important; margin-left:15px !important; background-color:#FFFFFF !important">of  <?php echo ceil($total_records/$item_per_page); ?></li>
<?php } ?>



<?php 
}

// sratt limit will be from url, and limit will be item per page//
?>

<?php 
$nxt_page = $curr_page+$item_per_page;
if($nxt_page>$last_page)
{
$nxt_page = $last_page;
}
?>

<li><a href="<?php echo get_permalink( 569 );?>?pageid=<?php echo $nxt_page; ?>">&gt;</a></li>
<?php 


?>
<li><a href="<?php echo get_permalink( 569 );?>?pageid=<?php echo $last_page;?>">&raquo;</a></li>


</ul></div>
<?php } ?>

<div class="files_show_section">
<div class="user_column">
<div class="user_head">F.No</div>
<div class="user_head">Filename</div>
<div class="user_head">Action</div>

</div>

<?php 
///////////////Paging OVER//////////////////

$limit_rec = $curr_page+$item_per_page;
if($limit_rec>=count($file_unique_num_array))
{
$limit_rec = count($file_unique_num_array);
}

if(count($file_name_array) == 0)
{
?><div class="user_head_norecord">No record found currently</div><?php 
}
if(!count($file_name_array) == 0)
{
for($i=$curr_page;$i<$limit_rec;$i++) { 
?><div class="user_column">
<div><?php echo $file_unique_num_array[$i];?></div>
<div><a href="<?php echo $file_url_array[$i];?>" target="_blank"><?php echo $file_name_array[$i];?></a>&nbsp;&nbsp;<!--(--><?php if($file_upload_by_array[$i] == 'A'){ //echo "Upload by admin";
} else { //echo "upload by user"; 
}?><!--)--></div>
<div><a href="<?php echo get_permalink( 752 ); ?>?un=<?php echo $file_unique_num_array[$i];?>">View</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo get_permalink( 569 ); ?>?delete_url=<?php echo $file_url_array[$i];?>">Delete</a></div>

</div>
<?php  
}// for
}
}

?>
</div>
<?php 
}
}

?>
</div>
<?php endwhile; ?> 
</div>

</div>
<?php 
}
?>
<span class="article_separator">&nbsp;</span>
</div>
<div class="cleared"></div>
</div>
</div>
</div>
</div>
            
            
            
</div>                         
</div>
</div>
<?php get_footer(); ?>