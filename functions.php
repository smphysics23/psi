<?php
/**
 * Twenty Thirteen functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Add support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Twenty Thirteen setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen', get_template_directory() . '/languages' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'fonts/genericons.css', twentythirteen_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );

/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2013-07-18', true );

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/fonts/genericons.css', array(), '2.09' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'PSI SHIPPING & COURIER', 'twentythirteen' ),
		'id'            => 'psi_shipping_home',
		'description'   => __( 'PSI SHIPPING & COURIER', 'twentythirteen' ),
		'before_title'  => '<div class="psiShippingBg">',
		'after_title'   => '</div><div class="clearx"> </div>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Left Menu', 'twentythirteen' ),
		'id'            => 'left_menu',
		'description'   => __( 'Left Menu', 'twentythirteen' ),
		
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'PSI SHIPPING & COURIER IMAGE', 'twentythirteen' ),
		'id'            => 'psi_shipping_home_image',
		'description'   => __( 'PSI SHIPPING & COURIER IMAGE', 'twentythirteen' ),
		
	) );
	
	register_sidebar( array(
		'name'          => __( 'MEDIA & NEWS', 'twentythirteen' ),
		'id'            => 'media_and_news',
		'description'   => __( 'MEDIA & NEWS', 'twentythirteen' ),
		'before_title'  => '<span class="mediaNews">',
		'after_title'   => '</span>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'REQUEST A FREE QUOTE', 'twentythirteen' ),
		'id'            => 'request_a_free',
		'description'   => __( 'REQUEST A FREE QUOTE', 'twentythirteen' ),
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'INSTANT LIVE TRACKING', 'twentythirteen' ),
		'id'            => 'instant_live_tracking',
		'description'   => __( 'INSTANT LIVE TRACKING', 'twentythirteen' ),
		'before_title'  => '',
		'after_title'   => '',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Ocean-Flight-Schedule', 'twentythirteen' ),
		'id'            => 'ocean-flight-schedule',
		'description'   => __( 'Ocean-Flight-Schedule', 'twentythirteen' ),
	) );
	
	register_sidebar( array(
		'name'          => __( 'NewsLetter', 'twentythirteen' ),
		'id'            => 'news_letter',
		'description'   => __( 'NewsLetter', 'twentythirteen' ),
	) );
	
	
	
	register_sidebar( array(
		'name'          => __( 'Copyright Text', 'twentythirteen' ),
		'id'            => 'copy_right',
		'description'   => __( 'Copyright Text', 'twentythirteen' ),
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'Footer Social Links', 'twentythirteen' ),
		'id'            => 'footer_social_links',
		'description'   => __( 'Footer Social Links', 'twentythirteen' ),
	) );
	
	register_sidebar( array(
		'name'          => __( 'Home Social Links', 'twentythirteen' ),
		'id'            => 'home_social_links',
		'description'   => __( 'Home Social Links', 'twentythirteen' ),
	) );
	
	register_sidebar( array(
		'name'          => __( 'Bottom Left Links', 'twentythirteen' ),
		'id'            => 'bottom_left_menu',
		'description'   => __( 'Bottom Left Menu', 'twentythirteen' ),
		'before_title'  => '<div class="footerBoldTxt">',
		'after_title'   => '</div>',
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'Bottom Center Links', 'twentythirteen' ),
		'id'            => 'bottom_center_menu',
		'description'   => __( 'Bottom Center Menu', 'twentythirteen' ),
		'before_title'  => '<div class="footerBoldTxt">',
		'after_title'   => '</div>',
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'Bottom right Links', 'twentythirteen' ),
		'id'            => 'bottom_right_menu',
		'description'   => __( 'Bottom right Menu', 'twentythirteen' ),
		'before_title'  => '<div class="footerBoldTxt">',
		'after_title'   => '</div>',
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'Banners', 'twentythirteen' ),
		'id'            => 'banners',
		'description'   => __( 'banners', 'twentythirteen' ),
	) );
	
	
	register_sidebar( array(
		'name'          => __( 'Login Section', 'twentythirteen' ),
		'id'            => 'login_section',
		'description'   => __( 'Login Section', 'twentythirteen' ),
	) );
	
	register_sidebar( array(
		'name'          => __( 'SIGNUP', 'twentythirteen' ),
		'id'            => 'text_above_signup',
		'description'   => __( 'Appears Text Above SIGNUP Page', 'twentythirteen' ),
		'before_widget' => '<div class="sign_up_txt">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="user_head2">',
		'after_title'   => '</div>',
	) );
	
	
	
	
	
	
	
	
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
*
* @since Twenty Thirteen 1.0
*
* @return void
*/
function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;
  
if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void 
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date(); 
 
 
	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	} 

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
 
function twentythirteen_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Twenty thirteen 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 * @return void
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );


define("RECAPTCHA_API_SERVER", "http://www.google.com/recaptcha/api");
define("RECAPTCHA_API_SECURE_SERVER", "https://www.google.com/recaptcha/api");
define("RECAPTCHA_VERIFY_SERVER", "www.google.com");

/**
 * Encodes the given data into a query string format
 * @param $data - array of string elements to be encoded
 * @return string - encoded request
 */
function _recaptcha_qsencode ($data) {
        $req = "";
        foreach ( $data as $key => $value )
                $req .= $key . '=' . urlencode( stripslashes($value) ) . '&';

        // Cut the last '&'
        $req=substr($req,0,strlen($req)-1);
        return $req;
}



/**
 * Submits an HTTP POST to a reCAPTCHA server
 * @param string $host
 * @param string $path
 * @param array $data
 * @param int port
 * @return array response
 */
function _recaptcha_http_post($host, $path, $data, $port = 80) {

        $req = _recaptcha_qsencode ($data);

        $http_request  = "POST $path HTTP/1.0\r\n";
        $http_request .= "Host: $host\r\n";
        $http_request .= "Content-Type: application/x-www-form-urlencoded;\r\n";
        $http_request .= "Content-Length: " . strlen($req) . "\r\n";
        $http_request .= "User-Agent: reCAPTCHA/PHP\r\n";
        $http_request .= "\r\n";
        $http_request .= $req;

        $response = '';
        if( false == ( $fs = @fsockopen($host, $port, $errno, $errstr, 10) ) ) {
                die ('Could not open socket');
        }

        fwrite($fs, $http_request);

        while ( !feof($fs) )
                $response .= fgets($fs, 1160); // One TCP-IP packet
        fclose($fs);
        $response = explode("\r\n\r\n", $response, 2);

        return $response;
}



/**
 * Gets the challenge HTML (javascript and non-javascript version).
 * This is called from the browser, and the resulting reCAPTCHA HTML widget
 * is embedded within the HTML form it was called from.
 * @param string $pubkey A public key for reCAPTCHA
 * @param string $error The error given by reCAPTCHA (optional, default is null)
 * @param boolean $use_ssl Should the request be made over ssl? (optional, default is false)

 * @return string - The HTML to be embedded in the user's form.
 */
function recaptcha_get_html ($pubkey, $error = null, $use_ssl = false)
{
	if ($pubkey == null || $pubkey == '') {
		die ("To use reCAPTCHA you must get an API key from <a href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a>");
	}
	
	if ($use_ssl) {
                $server = RECAPTCHA_API_SECURE_SERVER;
        } else {
                $server = RECAPTCHA_API_SERVER;
        }

        $errorpart = "";
        if ($error) {
           $errorpart = "&amp;error=" . $error;
        }
        return '<script type="text/javascript" src="'. $server . '/challenge?k=' . $pubkey . $errorpart . '"></script>

	<noscript>
  		<iframe src="'. $server . '/noscript?k=' . $pubkey . $errorpart . '" height="300" width="500" frameborder="0"></iframe><br/>
  		<textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
  		<input type="hidden" name="recaptcha_response_field" value="manual_challenge"/>
	</noscript>';
}




/**
 * A ReCaptchaResponse is returned from recaptcha_check_answer()
 */
class ReCaptchaResponse {
        var $is_valid;
        var $error;
}


/**
  * Calls an HTTP POST function to verify if the user's guess was correct
  * @param string $privkey
  * @param string $remoteip
  * @param string $challenge
  * @param string $response
  * @param array $extra_params an array of extra variables to post to the server
  * @return ReCaptchaResponse
  */
function recaptcha_check_answer ($privkey, $remoteip, $challenge, $response, $extra_params = array())
{
	if ($privkey == null || $privkey == '') {
		die ("To use reCAPTCHA you must get an API key from <a href='https://www.google.com/recaptcha/admin/create'>https://www.google.com/recaptcha/admin/create</a>");
	}

	if ($remoteip == null || $remoteip == '') {
		die ("For security reasons, you must pass the remote ip to reCAPTCHA");
	}

	
	
        //discard spam submissions
        if ($challenge == null || strlen($challenge) == 0 || $response == null || strlen($response) == 0) {
                $recaptcha_response = new ReCaptchaResponse();
                $recaptcha_response->is_valid = false;
                $recaptcha_response->error = 'incorrect-captcha-sol';
                return $recaptcha_response;
        }

        $response = _recaptcha_http_post (RECAPTCHA_VERIFY_SERVER, "/recaptcha/api/verify",
                                          array (
                                                 'privatekey' => $privkey,
                                                 'remoteip' => $remoteip,
                                                 'challenge' => $challenge,
                                                 'response' => $response
                                                 ) + $extra_params
                                          );

        $answers = explode ("\n", $response [1]);
        $recaptcha_response = new ReCaptchaResponse();

        if (trim ($answers [0]) == 'true') {
                $recaptcha_response->is_valid = true;
        }
        else {
                $recaptcha_response->is_valid = false;
                $recaptcha_response->error = $answers [1];
        }
        return $recaptcha_response;

}

/**
 * gets a URL where the user can sign up for reCAPTCHA. If your application
 * has a configuration page where you enter a key, you should provide a link
 * using this function.
 * @param string $domain The domain where the page is hosted
 * @param string $appname The name of your application
 */
function recaptcha_get_signup_url ($domain = null, $appname = null) {
	return "https://www.google.com/recaptcha/admin/create?" .  _recaptcha_qsencode (array ('domains' => $domain, 'app' => $appname));
}

function _recaptcha_aes_pad($val) {
	$block_size = 16;
	$numpad = $block_size - (strlen ($val) % $block_size);
	return str_pad($val, strlen ($val) + $numpad, chr($numpad));
}

/* Mailhide related code */

function _recaptcha_aes_encrypt($val,$ky) {
	if (! function_exists ("mcrypt_encrypt")) {
		die ("To use reCAPTCHA Mailhide, you need to have the mcrypt php module installed.");
	}
	$mode=MCRYPT_MODE_CBC;   
	$enc=MCRYPT_RIJNDAEL_128;
	$val=_recaptcha_aes_pad($val);
	return mcrypt_encrypt($enc, $ky, $val, $mode, "\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0");
}


function _recaptcha_mailhide_urlbase64 ($x) {
	return strtr(base64_encode ($x), '+/', '-_');
}

/* gets the reCAPTCHA Mailhide url for a given email, public key and private key */
function recaptcha_mailhide_url($pubkey, $privkey, $email) {
	if ($pubkey == '' || $pubkey == null || $privkey == "" || $privkey == null) {
		die ("To use reCAPTCHA Mailhide, you have to sign up for a public and private key, " .
		     "you can do so at <a href='http://www.google.com/recaptcha/mailhide/apikey'>http://www.google.com/recaptcha/mailhide/apikey</a>");
	}
	

	$ky = pack('H*', $privkey);
	$cryptmail = _recaptcha_aes_encrypt ($email, $ky);
	
	return "http://www.google.com/recaptcha/mailhide/d?k=" . $pubkey . "&c=" . _recaptcha_mailhide_urlbase64 ($cryptmail);
}

/**
 * gets the parts of the email to expose to the user.
 * eg, given johndoe@example,com return ["john", "example.com"].
 * the email is then displayed as john...@example.com
 */
function _recaptcha_mailhide_email_parts ($email) {
	$arr = preg_split("/@/", $email );

	if (strlen ($arr[0]) <= 4) {
		$arr[0] = substr ($arr[0], 0, 1);
	} else if (strlen ($arr[0]) <= 6) {
		$arr[0] = substr ($arr[0], 0, 3);
	} else {
		$arr[0] = substr ($arr[0], 0, 4);
	}
	return $arr;
}

/**
 * Gets html to display an email address given a public an private key.
 * to get a key, go to:
 *
 * http://www.google.com/recaptcha/mailhide/apikey
 */
function recaptcha_mailhide_html($pubkey, $privkey, $email) {
	$emailparts = _recaptcha_mailhide_email_parts ($email);
	$url = recaptcha_mailhide_url ($pubkey, $privkey, $email);
	
	return htmlentities($emailparts[0]) . "<a href='" . htmlentities ($url) .
		"' onclick=\"window.open('" . htmlentities ($url) . "', '', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=500,height=300'); return false;\" title=\"Reveal this e-mail address\">...</a>@" . htmlentities ($emailparts [1]);

}



function reg_func2( $atts ) {
$publickey = "6LeU5OsSAAAAAP4yMGhGS_5Z4ltwfty7IyW2An_M";
$privatekey = "6LeU5OsSAAAAAGCwrdaBAk98IN9jaLFj6XjGFydA";
# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;


if( is_active_sidebar( 'text_above_signup' ) ) : dynamic_sidebar( 'text_above_signup' ); endif; 

     echo '
	 <div class="user_head">* required fields</div>
	 <div class="reg_form">
<form name="reg_form" action="" method="post" onsubmit="return register_validation();">

<div class="re_field"><div class="left_column">User Name:<span class="manda_tory">*</span></div><div class="tight_column"><input type="text" name="user_nm" size="56" id="user_nm"></div></div>

<div class="re_field"><div class="left_column">Password:<span class="manda_tory">*</span></div><div class="tight_column"><input type="password" name="password" id="password" size="56" id="na_me"></div></div>

<div class="re_field"><div class="left_column">First Name:</div><div class="tight_column"><input type="text" name="na_me" size="56" id="na_me"></div></div>

<div class="re_field"><div class="left_column">Last Name:</div><div class="tight_column"><input type="text" name="last_nm" size="56" id="last_nm"></div></div>

<div class="re_field"><div class="left_column">E-mail address:<span class="manda_tory">*</span></div><div class="tight_column"><input type="text" name="e_mail" size="56" id="e_mail"></div></div>


<div class="re_field"><div class="left_column">International passport number:</div><div class="tight_column"><input type="text" name="inter_pass" size="56" id="inter_pass"></div></div>

<div class="re_field"><div class="left_column">Tax ID/EIN(USA only):</div><div class="tight_column"><input type="text" name="tax_id" size="56" id="tax_id"></div></div>

<div class="re_field"><div class="left_column">Phone Number:</div><div class="tight_column"><input type="text" name="pho_ne_num" size="56" id="pho_ne_num"></div></div>



<div class="re_field"><div class="left_column">Security:<span class="manda_tory">*</span></div><div class="tight_column">'.recaptcha_get_html($publickey, $error).'</div></div>


<div class="re_field-r"><div class="left_column"></div><div class="tight_column"><input type="submit" name="sub_mit" class="reg_submit" value="Register" style="width: 100px; height: 40px; margin-left: 65px;"></div></div>

</form>
</div>';
}
add_shortcode('reg_form2', 'reg_func2');




function reg_func_profile( $atts ) {
if(isset($_REQUEST['sub_mit_edit']))
{
get_currentuserinfo();
global $current_user;
$u_serID = $current_user->ID;
$e_mail = $_POST['e_mail'];
$f_name = $_POST['na_me'];
$l_name = $_POST['last_nm'];
global $wpdb;	
$table_name = $wpdb->prefix . "users";
$run_query = "UPDATE ".$table_name." SET user_email='".$e_mail."' WHERE ID=".$u_serID;
$wpdb->query($wpdb->prepare($run_query));

update_user_meta( $u_serID, 'first_name', $f_name); 
update_user_meta( $u_serID, 'user_first_name', $f_name); 

update_user_meta( $u_serID, 'last_name', $l_name); 
update_user_meta( $u_serID, 'user_last_name', $l_name); 

update_user_meta( $u_serID, 'int_pass', $_POST['inter_pass']); 
update_user_meta( $u_serID, 'tax_id_usa', $_POST['tax_id']); 
update_user_meta( $u_serID, 'pho_ne_num', $_POST['pho_ne_num']); 


$pass_w_ord = $_POST['password'];
if($pass_w_ord != "")
{
wp_set_password( $pass_w_ord, $u_serID );
}

?><h2>Profile Updated Successfully, <a href="<?php echo get_permalink( 569 ); ?>" style="color:#000000">click here</a> to go Account</h2><?php 
}
else
{
$current_user_id = get_current_user_id( );
$current_user = get_userdata($current_user_id);
     echo '
	 <div class="user_head">* required fields</div>
	 <div class="reg_form">
<form name="reg_form" action="" method="post" onsubmit="return register_validation2();">

<div class="re_field"><div class="left_column">User Name:<span class="manda_tory">*</span></div><div class="tight_column"><input type="text" name="user_nm" size="56" id="user_nm" value="'.$current_user->user_login.'" readonly="readonly"></div></div>

<div class="re_field"><div class="left_column">Password:<span class="manda_tory">*</span></div><div class="tight_column"><input type="password" name="password" id="password" size="56" id="na_me"><br><span class="leave_blank_pass">&nbsp;&nbsp;(Leave blank if you dont want to change)</span></div></div>

<div class="re_field"><div class="left_column">First Name:</div><div class="tight_column"><input type="text" name="na_me" size="56" id="na_me" value="'.$current_user->user_firstname.'"></div></div>

<div class="re_field"><div class="left_column">Last Name:</div><div class="tight_column"><input type="text" name="last_nm" size="56" id="last_nm" value="'.$current_user->user_lastname.'"></div></div>

<div class="re_field"><div class="left_column">E-mail address:<span class="manda_tory">*</span></div><div class="tight_column"><input type="text" name="e_mail" size="56" id="e_mail" value="'.$current_user->user_email.'"></div></div>


<div class="re_field"><div class="left_column">International passport number:</div><div class="tight_column"><input type="text" name="inter_pass" size="56" id="inter_pass" value="'.$current_user->int_pass.'"></div></div>
<div class="re_field"><div class="left_column">Tax ID/EIN(USA only):</div><div class="tight_column"><input type="text" name="tax_id" size="56" id="tax_id" value="'.$current_user->tax_id_usa.'"></div></div>

<div class="re_field"><div class="left_column">Phone Number:</div><div class="tight_column"><input type="pho_ne_num" name="pho_ne_num" size="56" id="tax_id" value="'.$current_user->pho_ne_num.'"></div></div>



<div class="re_field-r"><div class="left_column"></div><div class="tight_column"><input type="submit" name="sub_mit_edit" class="reg_submit" value="Update" style="width: 100px; height: 40px; margin-left: 65px;"></div></div>

</form>
</div>';
}
}
add_shortcode('reg_edit_profile', 'reg_func_profile');



















function reg_func_edit_files()
{
if(isset($_REQUEST['file_sub']))
{
global $wpdb;
$current_userg = wp_get_current_user();
$curr_userID = $current_userg->ID;
$get_file_num = $_POST['file_number'];


$querystr_file = "SELECT * FROM psi_usermeta where meta_value = '$get_file_num' and user_id = '$curr_userID'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$unique_file_number_meta_id = $recent_ids_query->umeta_id ;
}
// deleting the records except upload file URL
$delete_user_file_name = $unique_file_number_meta_id-7;
$wpdb->query("delete from psi_usermeta where umeta_id = $delete_user_file_name");
$delete_user_deli_date = $unique_file_number_meta_id-6;
$wpdb->query("delete from psi_usermeta where umeta_id = $delete_user_deli_date");
$delete_user_ship_name = $unique_file_number_meta_id-5;
$wpdb->query("delete from psi_usermeta where umeta_id = $delete_user_ship_name");
$delete_user_cons_name = $unique_file_number_meta_id-4;
$wpdb->query("delete from psi_usermeta where umeta_id = $delete_user_cons_name");
$user_export_pre_name = $unique_file_number_meta_id-3;
$wpdb->query("delete from psi_usermeta where umeta_id = $user_export_pre_name");
$user_dest_add_name = $unique_file_number_meta_id-2;
$wpdb->query("delete from psi_usermeta where umeta_id = $user_dest_add_name");
$user_phone_num_name = $unique_file_number_meta_id-1;
$wpdb->query("delete from psi_usermeta where umeta_id = $user_phone_num_name");
$delete_unique_file_nm = $unique_file_number_meta_id;// deleting file number
$wpdb->query("delete from psi_usermeta where umeta_id = $delete_unique_file_nm");
$delete_upload_by = $unique_file_number_meta_id+2;
$wpdb->query("delete from psi_usermeta where umeta_id = $delete_upload_by");
$delete_upload_date = $unique_file_number_meta_id+3;
$wpdb->query("delete from psi_usermeta where umeta_id = $delete_upload_date");
// add user data
add_user_meta( $curr_userID, 'user_file_name', $_POST['file_name']);
add_user_meta( $curr_userID, 'user_deli_date', $_POST['deli_date']);
add_user_meta( $curr_userID, 'user_ship_name', $_POST['ship_name']);
add_user_meta( $curr_userID, 'user_cons_name', $_POST['cons_name']);
add_user_meta( $curr_userID, 'user_export_pre', $_POST['export_pre']);
add_user_meta( $curr_userID, 'user_dest_add', $_POST['dest_add']);
add_user_meta( $curr_userID, 'user_phone_num', $_POST['ph_number']);
add_user_meta( $curr_userID, 'unique_file_nm', $_POST['file_number']);
//file upload manuipulation 
// delete file url
if($_FILES["file_uplad"]["error"] == 4)
{
// Getting file url 
echo "Not upload file";
$delete_file_url_meta_id = $unique_file_number_meta_id+1;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$delete_file_url_meta_id' and meta_key = 'file_url'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$file_url_meta_value = $recent_ids_query->meta_value;
}
$wpdb->query("delete from psi_usermeta where umeta_id = $delete_file_url_meta_id");
add_user_meta( $curr_userID, 'file_url', $file_url_meta_value);
}
else
{
echo "upload file";
$delete_file_url_meta_id = $unique_file_number_meta_id+1;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$delete_file_url_meta_id' and meta_key = 'file_url'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$file_url_meta_value = $recent_ids_query->meta_value ;
}
unlink('upload/'.$file_url_meta_value) ;
// upload file/////
$wpdb->query("delete from psi_usermeta where umeta_id = $delete_file_url_meta_id"); // asso add user meta
////////////////////#############////////////////////////////
$logged_in_user_id = $current_userg->ID;
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
	  
      $get_file_url = get_site_url()."/upload/" .$logged_in_user_id. $_FILES["file_uplad"]["name"];
	  add_user_meta( $logged_in_user_id, 'file_url', $get_file_url);
	  add_user_meta( $logged_in_user_id, 'upload_by', 'U');
	  $today_date = date("m/d/Y");
	  add_user_meta( $logged_in_user_id, 'upload_date', $today_date);
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
	  echo '<div class="invalid">'."Failed! Please upload only document file like doc, pdf".'</div>';  
	  }
	  else
      {
      echo '<div class="invalid">'."Failed! Invalid file".'</div>';
      }
    }
////////////////////#############////////////////////////////

// upload file Over/////
}










add_user_meta( $curr_userID, 'upload_by', 'U');
add_user_meta( $curr_userID, 'upload_date', date("m/d/Y"));




?><h2>File Updated Successfully, <a href="<?php echo get_permalink( 569 ); ?>" style="color:#000000">click here</a> to go Account</h2><?php 
}
else
{ 
global $wpdb;
$current_user = wp_get_current_user();
$current_userg = wp_get_current_user();
$curr_userID = $current_userg->ID;
echo '<div class="welcome_user">  '; 
//echo $ffname = $current_userg->user_firstname."&nbsp;&nbsp;";
//echo $llnname = $current_userg->user_lastname;

//////////////////////////Getting file information////////////////////////////////////
$get_file_num = $_GET['un'];
$querystr_file = "SELECT * FROM psi_usermeta where meta_value = '$get_file_num' and user_id = '$curr_userID'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$unique_file_number_meta_id = $recent_ids_query->umeta_id ;
}
//file name
$file_name_id = $unique_file_number_meta_id-7;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$file_name_id' and meta_key = 'user_file_name'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$file_name_file_meta_value = $recent_ids_query->meta_value ;
}




//Delivery Date
$file_dilvery_date_id = $unique_file_number_meta_id-6;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$file_dilvery_date_id' and meta_key = 'user_deli_date'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$dilivery_date_file_meta_value = $recent_ids_query->meta_value ;
}

//Shipper Name
$file_ship_name_id = $unique_file_number_meta_id-5;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$file_ship_name_id' and meta_key = 'user_ship_name'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$user_ship_name_meta_value = $recent_ids_query->meta_value ;
}


//Phone Number
$phone_num_id = $unique_file_number_meta_id-1;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$phone_num_id' and meta_key = 'user_phone_num'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$user_phone_num_meta_value = $recent_ids_query->meta_value ;
}

//Consignee Namee
$user_cons_name_id = $unique_file_number_meta_id-4;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$user_cons_name_id' and meta_key = 'user_cons_name'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$user_cons_name_meta_value = $recent_ids_query->meta_value ;
}
//Export Preference
$user_export_pre_id = $unique_file_number_meta_id-3;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$user_export_pre_id' and meta_key = 'user_export_pre'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$user_export_pre_meta_value = $recent_ids_query->meta_value ;
}

//Destination Address
$user_dest_add_id = $unique_file_number_meta_id-2;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$user_dest_add_id' and meta_key = 'user_dest_add'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$recent_ids_query_meta_value = $recent_ids_query->meta_value ;
}
//File URL
$user_dest_add_id_url = $unique_file_number_meta_id+1;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$user_dest_add_id_url' and meta_key = 'file_url'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$recent_ids_query_file_meta_value = $recent_ids_query->meta_value ;
}

//////////////////////////////Additional 2 fields//////////////////
//user_passport
$user_passport_add_id_url = $unique_file_number_meta_id+4;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$user_passport_add_id_url' and meta_key = 'user_passport'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$recent_ids_user_passport_value = $recent_ids_query->meta_value ;
}


//user_tax_id
$user_tax_id_id_url = $unique_file_number_meta_id+5;
$querystr_file = "SELECT * FROM psi_usermeta where umeta_id = '$user_tax_id_id_url' and meta_key = 'user_tax_id'";
$recent_ids_query = $wpdb->get_results($querystr_file);
foreach ($recent_ids_query as $recent_ids_query)
{
$recent_ids_user_tax_id_value = $recent_ids_query->meta_value ;
}








//////////////////////////OVER Getting file information////////////////////////////////////

echo '<span style="float:right">Customer Number: '; 
if(get_user_meta($current_user->ID, 'customer_number', true) != "")
{
echo get_user_meta($current_user->ID, 'customer_number', true);
}
else
{
echo "N/A";
}
echo '</span>';
echo '<span class="back_class"><a href="'.get_permalink( 569 ).'">Back</a></span></div>
<script type="text/javascript">
function check_file_upload()
{
if(document.getElementById("file_name").value == "")
{
alert("File name can not be empty");
document.getElementById("file_name").focus();
return false
}
}
</script>
<div id="fields_add">
<form name="upload_section" action="" method="post" enctype="multipart/form-data" onsubmit="return check_file_upload();">
<input type="hidden" name="file_number" value="'.$get_file_num.'" />
<div class="upload_fields">
<div class="upload_section">
<div class="re_field2"><div class="type_name">File name:</div><div class="type_field">'.$file_name_file_meta_value.'&nbsp;&nbsp;</div></div>
<link type="text/css" href="'.get_site_url().'/wp-content/themes/PSI/jquery.datepick.css" rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="'.get_site_url().'/wp-content/themes/PSI/js/jquery.datepick.js"></script>
<script type="text/javascript">
$(function() {
	$("#popupDatepicker").datepick();
	$("#inlineDatepicker").datepick({onSelect: showDate});
});

function showDate(date) {
	alert("The date chosen is " + date);
}
</script>



<div class="re_field2"><div class="type_name">Delivery Date:</div><div class="type_field">'.$dilivery_date_file_meta_value.'&nbsp;&nbsp;</div></div>

<div class="re_field2"><div class="type_name">Shipper Name:</div><div class="type_field">'.$user_ship_name_meta_value.'&nbsp;&nbsp;</div></div>

<div class="re_field2"><div class="type_name">Phone Number:</div><div class="type_field">'.$user_phone_num_meta_value.'&nbsp;&nbsp;</div></div>

<div class="re_field2"><div class="type_name">Consignee Namee:</div><div class="type_field">'.$user_cons_name_meta_value.'&nbsp;&nbsp;</div></div>

<div class="re_field2"><div class="type_name">Export Preference:</div><div class="type_field">'.$user_export_pre_meta_value.'&nbsp;&nbsp;</div></div>

<div class="re_field2"><div class="type_name">Destination Address:</div><div class="type_field">'.$recent_ids_query_meta_value.'&nbsp;&nbsp;</div></div>




<div class="re_field2"><div class="type_name">Uploaded File:</div><div class="type_field"><a href="'.$recent_ids_query_file_meta_value.'" target="_blank">View.</a></div></div>
<div class="re_field2"><div class="type_name_submit"><!--<input type="submit" name="file_sub" value="Update">--></div></div>
</div>
</div>
</form>
</div>';
}

}

add_shortcode('reg_edit_account_files', 'reg_func_edit_files');





function log_func( $atts ) {
     echo '<div class="reg_form">
<form name="reg_form" action="'.get_permalink( 572 ).'" method="post">

<div class="left_column">User Name</div><div class="tight_column"><input type="text" name="user_nm" size="40" id="user_nm"></div>

<div class="left_column">Password</div><div class="tight_column"><input type="password" name="password" size="40" id="na_me"></div>

<div class="left_column"></div><div class="tight_column"><input type="submit" name="log_in" value="Login"></div>
</form>
</div>';
}
add_shortcode('log_form', 'log_func');

function defer_parsing_of_js ( $url ) {
    if ( FALSE === strpos( $url, '.js' ) ) return $url;
    if ( strpos( $url, 'jquery.js' ) ) return $url;
    return "$url' async onload='myinit()";
}
add_filter( 'clean_url', 'defer_parsing_of_js', 11, 1 );



function send_activation_link($user_id){
//$hash = md5( rand(0,1000));
//add_user_meta( $user_id, 'hash', $hash );
$user_info = get_userdata($user_id);
$to = $user_info->user_email;   
$un = $user_info->user_login;
$md5pass = $user_info->user_pass;           
$subject = 'Member Verification'; 
$message = 'Hello,';
$message .= "\n\n";
$message .= 'Welcome...';
$message .= "\n\n";
$message .= 'Username: '.$un;
$message .= "\n";
$message .= 'Password: '.$pw;
$message .= "\n\n";
$message .= 'Please click this link to activate your account:';
$message .= home_url('/').'activate?id='.$un.'&key='.$hash;
$headers = 'From: noreply@test.com' . "\r\n";  

global $wpdb;	
//$wpdb->query(
//	"
//	UPDATE $wpdb->posts 
//	SET post_parent = 7
//	WHERE ID = 15 
//		AND post_status = 'static'
//	"
//);

         
//wp_mail($to, $subject, $message, $headers); 

}


add_action ( 'user_register', 'send_activation_link');



function my_login_redirect( $redirect_to, $request, $user ){
    //is there a user to check?
    global $user;
    if( isset( $user->roles ) && is_array( $user->roles ) ) {
        //check for admins
        if( in_array( "administrator", $user->roles ) ) {
            // redirect them to the default place
            return get_site_url().'wp-admin/';
        } else {
            return home_url();
        }
    }
    else {
        return $redirect_to;
    }
}
add_filter("login_redirect", "my_login_redirect", 10, 3);





add_action('edit_user_profile_update', 'update_extra_profile_fields');
function update_extra_profile_fields($user_id)
{
if ( current_user_can('edit_user',$user_id) )
{
update_user_meta( $user_id, 'pho_ne_num', $_POST['phone_num_ber'] );
update_user_meta( $user_id, 'tax_id_usa', $_POST['tax_usa_only'] );
update_user_meta( $user_id, 'int_pass', $_POST['inter_passport'] );

if(get_user_meta($user_id, 'psi_ul_disabled', true) == "")
{
$cc = "empty";
if(get_user_meta($user_id, 'send_first_mail', true) == "inactive")
{
update_user_meta( $user_id, 'send_first_mail', 'active');

$user_info_email = get_userdata($user_id);
$get_user_active_mail = $user_info_email->user_email;
$content_approved = "Your account is approved by PSI Shipping admin <br><br>Thanks<br>PSI Team";
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: PSI admin <admin@psi.com>\r\n";
wp_mail($get_user_active_mail,'Account Approved',$content_approved,$headers);
}


}
else
{
$cc = (get_user_meta($user_id, 'psi_ul_disabled', true));
}




//wp_mail('alex@123789.org','subject',$cc);
}// current user can
}














