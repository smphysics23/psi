<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
</div>
<div class="footerBg">
<div class="footer row">
<div class="footer-sec">
<div style="float: left;"><img class="psi-icons" src="<?php echo get_template_directory_uri(); ?>/images/logo-small.gif" width="72" height="34"></div>
<div style="float: right;">
<div class="flag"><img src="<?php echo get_template_directory_uri(); ?>/images/US-flag.png" width="16" height="11"> United States <img src="<?php echo get_template_directory_uri(); ?>/images/Nigeria-flag.png" width="16" height="11"> Nigeria</div>
</div>
</div>
	<div class="clearx"></div>
    <div class="siteSearch">		
    <div class="moduletable_box">


    <form action="<?php echo get_permalink( 18 ); ?>" method="get">
	<div class="search_box">
	<input name="s" id="s" maxlength="27" alt="Go" class="inputbox_box" size="27" value="Search here..." onblur="if(this.value=='') this.value='Search here...';" onfocus="if(this.value=='Search here...') this.value='';" type="text">
    <input value="Go" class="button_box" src="<?php echo get_template_directory_uri(); ?>/images/searchButton.gif" onclick="this.form.searchword.focus();" type="image">	</div>
	</form>		



</div>
	</div>
    <div class="clearx"></div>
<div class="footerInnerWrapper">
                        <div class="footerBlockA col-md-3 col-sm-3">
							
                            <?php if( is_active_sidebar( 'footer_social_links' ) ) : dynamic_sidebar( 'footer_social_links' ); endif;  ?>
                            
                            
							<div class="clearx"></div>
							<?php if( is_active_sidebar( 'news_letter' ) ) : dynamic_sidebar( 'news_letter' ); endif;  ?>
<input name="redirect" value="#" type="hidden">
<input name="errorredirect" value="#" type="hidden">
<div id="SignUp">
<script type="text/javascript" src="<?php echo get_site_url();?>/wp-content/plugins/wysija-newsletters/js/validate/languages/jquery.validationEngine-en.js?ver=2.5.9"></script>
<script type="text/javascript" src="<?php echo get_site_url();?>/wp-content/plugins/wysija-newsletters/js/validate/jquery.validationEngine.js?ver=2.5.9"></script>
<script type="text/javascript" src="<?php echo get_site_url();?>/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.5.9"></script>
<script type="text/javascript">
 /* <![CDATA[ */
var wysijaAJAX = {"action":"wysija_ajax","controller":"subscribers","ajaxurl":"<?php echo get_site_url();?>/wp-admin/admin-ajax.php","loadingTrans":"Loading..."};
/* ]]> */
</script><script type="text/javascript" src="<?php echo get_site_url();?>/wp-content/plugins/wysija-newsletters/js/front-subscribers.js?ver=2.5.9"></script>
<!--END Scripts-->
<div class="widget_wysija_cont html_wysija"><div id="msg-form-wysija-html527cdbd166b92-1" class="wysija-msg ajax"></div><form id="form-wysija-html527cdbd166b92-1" method="post" action="#wysija" class="widget_wysija html_wysija"><div class="wysija-msg"><div class="notice-msg"><ul><li><!--Your form has been saved--></li></ul></div></div><div class="wysija-msg ajax"></div><input type="hidden" value="81194d3f96" id="wysijax" />
<p class="wysija-paragraph">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="signupframe">
<tr><td width="33%">
    <label><span class="wysija-required">*</span>Email </label> 
</td><td> 
    <input type="text" name="wysija[user][email]" class="wysija-input validate[required,custom[email]]" title="Email"  value="" />
    <span class="abs-req">
        <input type="text" name="wysija[user][abs][email]" class="wysija-input validated[abs][email]" value="" />
    </span>
</td></tr></table>       
</p>
<p class="wysija-paragraph">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="signupframe">
<tr><td width="33%">
    <label>First name</label>
</td><td>    
    <input type="text" name="wysija[user][firstname]" class="wysija-input " title="First name"  value="" />
    <span class="abs-req">
        <input type="text" name="wysija[user][abs][firstname]" class="wysija-input validated[abs][firstname]" value="" />
    </span>
</td></tr></table>    
</p>
<p class="wysija-paragraph">
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="signupframe">
<tr><td width="33%">
    <label>Last name</label> 
</td><td>        
    <input type="text" name="wysija[user][lastname]" class="wysija-input " title="Last name"  value="" />
    <span class="abs-req">
        <input type="text" name="wysija[user][abs][lastname]" class="wysija-input validated[abs][lastname]" value="" />
    </span>
</td></tr>
<tr><td width="33%"></td><td><input class="wysija-submit wysija-submit-field" type="submit" value="Submit" /></td></tr>
</table>     
</p>
    <input type="hidden" name="form_id" value="1" />
    <input type="hidden" name="action" value="save" />
    <input type="hidden" name="controller" value="subscribers" />
    <input type="hidden" value="1" name="wysija-page" />
    <input type="hidden" name="wysija[user_list][list_ids]" value="1" />
    </form></div>  
</div>
</form>
<script type="text/javascript">
var icpForm3788 = document.getElementById('icpsignup3788');
if (document.location.protocol === "https:")
icpForm3788.action = "https://app.icontact.com/icp/signup.php";
function verifyRequired3788() {
  if (icpForm3788["fields_email"].value == "") {
    icpForm3788["fields_email"].focus();
    alert("The Email field is required.");
    return false;
  }
return true;
}
</script>
							<?php if( is_active_sidebar( 'banners' ) ) : dynamic_sidebar( 'banners' ); endif;  ?>
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        </div><!--end of footerBlockA-->
                        <div class="footerBlockB col-md-3 col-sm-3">
                        	
					<?php if( is_active_sidebar( 'bottom_left_menu' ) ) : dynamic_sidebar( 'bottom_left_menu' ); endif;  ?>		</div>
                        
                        <div class="footerBlockC col-md-3 col-sm-3">
                        	
<?php //wp_nav_menu( array( 'menu' => 'Footer center menu', 'menu_class'=> 'latestnews_sol' ) );?>
<?php if( is_active_sidebar( 'bottom_center_menu' ) ) : dynamic_sidebar( 'bottom_center_menu' ); endif;  ?>


                        </div><!--end of footerBlockC-->
                      <div class="footerBlockD col-md-3 col-sm-3">
                      
                    <?php //wp_nav_menu( array( 'menu' => 'Footer right menu', 'menu_class'=> 'latestnews_updates2' ) );?>
                    
                    
                    <?php if( is_active_sidebar( 'bottom_right_menu' ) ) : dynamic_sidebar( 'bottom_right_menu' ); endif;  ?>
                    
                    




                    
                    
                      </div><!--end of footerBlockD-->
                        <div class="clearx"></div>
					</div><!--end of footerInnerWrapper-->                </div>
                    <div class="clearx"></div>
				<!--Footer Copyright section starts here-->
                <div class="footerCopyright">
<?php wp_nav_menu( array( 'menu' => 'footer_menu' ) );?>
<div class="footerInnerWrapperCopyright"><br><span class="footercpr">
  <?php if( is_active_sidebar( 'copy_right' ) ) : dynamic_sidebar( 'copy_right' ); endif;  ?>
</span> </div>
                </div>
                <!--Footer Copyright section ends here-->
</div>
</div>
</div>
</div>
</div></div>
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
  jQuery("#MobMenu").click(function(){
    jQuery("#megaUber").slideToggle();
  });
});


</script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lightbox-2.6.min.js"></script>
</body></html>