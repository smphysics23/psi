<?php
/**
 * Template Name: Full Page
 *
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
<div>

    <div class="col-md-12 col-sm-8">
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
echo $post_detail->post_content; 


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