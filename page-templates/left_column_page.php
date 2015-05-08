<?php
/**
 * Template Name: Left Column Page
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>


<div class="row">
<div class="contentLayout">
		<div class="cleared"></div>
		<!-- International Support Block Including slideshow - starts here -->
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
<h2 class="PostHeaderIcon-wrapper"> 	<span class="PostHeader">
<?php 
global $post;
$current_page_id = $post->ID;
echo get_the_title($current_page_id);
?>
</span>
</h2>
<div class="PostContent">
<div class="article">
<?php 


$post_detail = get_post($current_page_id); 
echo do_shortcode($post_detail->post_content); 


if(($current_page_id == 280))
{
?><div class="file_claim"><?php 
echo do_shortcode( '[contact-form-7 id="615" title="File a claim"]' );
?></div><?php }



if(($current_page_id == 69))
{
?><div class="Care_ers"><?php 
echo do_shortcode( '[contact-form-7 id="130" title="Careers"]' );
?></div><?php }

if(($current_page_id == 68))
{
?><div class="leave_message"><?php 
echo do_shortcode( '[contact-form-7 id="613" title="contact"]' );
?></div><?php }

if(($current_page_id == 676))
{
?>
<div class="schedule_pick_up"><div class="re_field">
<?php 
echo do_shortcode( '[contact-form-7 id="682" title="SCHEDULE A PICK UP"]' );
?></div><?php }


if(($current_page_id == 288)||($current_page_id == 209)||($current_page_id == 738))
{
?>
<?php echo do_shortcode( '[contact-form-7 id="346" title="ENTERPRISE ACCOUNT"]' ); ?>
<p></p>
</div>
<?php 
}
?>
</div>
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

<div class="clearx"></div>







<?php get_footer(); ?>