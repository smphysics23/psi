<?php
/**
 * Template Name: Important Links Page
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
          <div class="row">
		<!-- International Support Block Including slideshow - starts here -->
				<div class="internationalSupportBlock">
				
                
                <div class="col-md-4 col-sm-4">
                
<div class="leftContainer">
<div class="txtBold"><img src="<?php echo get_template_directory_uri(); ?>/images/smallArrow.gif">
REQUEST A FREE QUOTE</div>

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
					
?></span>

	</h2>
<div class="PostContent">
<div class="article">
<?php 
 
   
   $post_detail = get_post($current_page_id); 
 echo $post_detail->post_content; 
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
           </div>
    
<div class="clearx"></div>







<?php get_footer(); ?>