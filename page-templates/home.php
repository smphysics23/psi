<?php
/**
 * Template Name: Home Page
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


<div class="contentLayout homepage">
		<div class="cleared"></div>
		<!-- International Support Block Including slideshow - starts here -->
   
        <div class="row">
        
				<div class="internationalSupportBlock ">
                
                <div class="col-md-4 col-sm-4">
                <div class="leftContainer">
                <div class="sideLogo">
                <img class="img-responsive" mce_src="<?php echo get_template_directory_uri(); ?>/images/international-support.gif" src="<?php echo get_template_directory_uri(); ?>/images/international-support.gif" width="281" height="126">
                </div>
                
                <div class="sideMenu1">
                <div class="ImportantLinksTxt">
                <img src="<?php echo get_template_directory_uri(); ?>/images/smallArrow.gif" mce_src="<?php echo get_template_directory_uri(); ?>/images/smallArrow.gif" width="4" height="5">&nbsp; Important links</div>
                
                
                
                 <?php if( is_active_sidebar( 'left_menu' ) ) : dynamic_sidebar( 'left_menu' ); endif;  ?>
                
                
                
                
                
                </div>
                </div>
                </div>
                <div class="col-md-8 col-sm-8">
                
                
                  <div class="rightContainer">
                  <div class="slideshowBg">
                  
                
				













<script src="<?php echo get_template_directory_uri(); ?>/js/diapo.js" type="text/javascript"></script>
	  <script type="text/javascript">
	  var ins69 = jQuery.noConflict();
     ins69(window).load(function() {
	ins69('.pix_diapo69').diapo({
selector			: 'div',
		fx					: 'scrollBottom',
		mobileFx			: '',	
		slideOn				: 'random',	
		gridDifference		: 250,	
		easing				: 'linear',	
		mobileEasing		: '',	
		loader				: 'none',
		loaderOpacity		: 0.8,	
		loaderColor			: '#ffff00', 
		loaderBgColor		: '#222222', 
		pieDiameter			: 50,
		piePosition			: 'top:5px; right:5px',	
		pieStroke			: 8,
		barPosition			: 'top',	
		barStroke			: 5,
		navigation			: false,	
		mobileNavigation	: true,	
		navigationHover		: true,	
		mobileNavHover		: true,
		commands			: false,
		mobileCommands		: true,	
		pagination			: true, 
		mobilePagination	: true,	
		thumbs				: false,	
		hover				: false,
		pauseOnClick		: false,
		rows				: 4,
		cols				: 6,
		slicedRows			: 8,	
		slicedCols			: 12,	
		time				: 5000,	
		transPeriod			: 1500,	
		autoAdvance			: true,	
		mobileAutoAdvance	: true, 
		onStartLoading		: function() {  },
		onLoaded			: function() {  },
		onEnterSlide		: function() {  },
		onStartTransition	: function() {  }
	});
});
   </script>
<div class="joomla_ins" style="overflow:hidden !important;" align="center">
                <div class="pix_diapo69 diapostarted">

<?php 
$get_query = $wpdb->get_results("
	SELECT *
	FROM sss_slider
	WHERE active = '1'
	ORDER BY animation asc");
foreach ($get_query as $rr) {	?>
<div class="" style="z-index: 1; margin-left: 0px; margin-top: 0px; display: none; width:100%">
<div class="pix_relativize"><img src="<?php echo get_site_url();?>/wp-content/uploads/<?php echo $rr->filename;?>" alt="<?php echo $rr->title;?>" title="<?php echo $rr->title;?>" width="664" height="332">

<div style="visibility: hidden; width: 330px; left: 283px; right: auto;" class="caption elemHover fromRight">



<h5><?php echo $rr->title;?></h5>

</div></div></div>
            
<?php  } ?>            
            
            




</div><div id="pix_pag">
<ul id="pix_pag_ul">
<?php 
$dot_count = 0;
foreach ($get_query as $pagination) {
?>

<?php  $dot_count++; } ?> 
</ul></div>










</div>
</div>

			
                  
                  </div>
                  
                  </div>
                
                
				
		   </div>
           
           </div>
           
           
           
           
           
           
              
		   <!-- International Support Block Including slideshow - ends here -->  
        <div class="cleared"></div>
		
		<!-- Media - Instant - Request section - starts here -->
        <div class="centerBg">
        <div class="row">
	      <div class="col-md-5 col-sm-5">
        
        <div class="youtubeSection">
        
 
 <?php if( is_active_sidebar( 'media_and_news' ) ) : dynamic_sidebar( 'media_and_news' ); endif;  ?>

<p class="share">Share</p>
<script type="text/javascript">var switchTo5x=true;</script>
<!--<script type="text/javascript" src="js/buttons.js"></script>-->
<script type="text/javascript">stLight.options({publisher:''});</script>

<div class="joomla_sharethis">

<!-- SHARETHIS BUTTON BEGIN -->

<span class='st_facebook' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span><span class='st_twitter' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span><span class='st_linkedin' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span><span class='st_email' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span><span class='st_sharethis' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span><span class='st_fblike' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span><span class='st_plusone' st_title='<?php the_title(); ?>' st_url='<?php the_permalink(); ?>'></span>


<!-- SHARETHIS BUTTON END -->
<p class="dnn">By A<a href="http://www.autson.com/" title="Website Design">Web Design</a></p>


</div></div>


</div>




  <div class="col-md-4 col-sm-4 centerBgSeperator1">
<div class="centerBgSeperator" rowspan="2"> </div>

<div class="trackingSection">

       <?php if( is_active_sidebar( 'instant_live_tracking' ) ) : dynamic_sidebar( 'instant_live_tracking' ); endif;  
	  
	  ?>
      <?php if( is_active_sidebar( 'ocean-flight-schedule' ) ) : dynamic_sidebar( 'ocean-flight-schedule' ); endif;  ?>
     
      
      </div>
  
      </div>
        <div class="col-md-3 col-sm-3">
       
      <div class="quoteSection">
      
      <div><?php if( is_active_sidebar( 'request_a_free' ) ) : dynamic_sidebar( 'request_a_free' ); endif;  ?></div>
      <div class="rfq"><div class="rsform">
      
	  <?php echo do_shortcode( '[contact-form-7 id="9" title="REQUEST A FREE QUOTE"]' ); ?>
      </div></div></div>
      </div>
        
        
        
</div>
</div>






<div class="cleared"></div>
<div class="psiShippingpsiShipping">
<div class="row">




<div class="col-md-8 col-sm-8">

	<div class="psiShippingText">
    
	
    
    <?php if( is_active_sidebar( 'psi_shipping_home' ) ) : dynamic_sidebar( 'psi_shipping_home' ); endif;  ?>
    
    </div>

    </div>
    
   
    
    <div class="col-md-4 col-sm-4">
    <div class="armoredSeperator armoredSeperatorimg ">
    
    <?php if( is_active_sidebar( 'psi_shipping_home_image' ) ) : dynamic_sidebar( 'psi_shipping_home_image' ); endif;  ?>
    
    </div>
    </div>
    <div class="clearx"></div>
    
</div>

</div>







<?php get_footer(); ?>