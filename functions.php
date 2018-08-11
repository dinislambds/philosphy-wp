<?php

require_once( get_theme_file_path( '/inc/tgm.php' ) ); 
require_once( get_theme_file_path( '/inc/attachments.php' ) ); 
require_once( get_theme_file_path( '/inc/acf.php' ) ); 
require_once( get_theme_file_path( '/widgets/social-icons-widget.php' ) ); 

if ( ! isset( $content_width ) ) $content_width = 960;

function philosophy_theme_setup(){
	load_theme_textdomain( "philosophy", get_theme_file_path('/languages') );
	add_theme_support( "post-thumbnails" );
	add_theme_support( "custom-logo" );
	add_theme_support( "title-tag" );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'comment-list', 'search-form' ) );
	add_theme_support( "post-formats", array( "image", "link", "quote", "audio", "video", "gallery" ) );
	add_editor_style( "/assets/css/editor-style.css" );

	register_nav_menu( "topmenu", __( "Top Menu", "philosophy" ) );
	register_nav_menus( array(
		'footer-left' => __('Footer Bottom Left','philosophy'),
		'footer-middle' => __('Footer Bottom Middle','philosophy'),
		'footer-right' => __('Footer Bottom Right','philosophy')
	));
	add_image_size( 'philosophy-home-square', $width = 400, $height = 400, $crop = true );
}
add_action( "after_setup_theme", "philosophy_theme_setup" );


// Cache busting
if ( site_url() == "http://localhost/alpha" ) {
    define( "VERSION", time() );
} else {  // for live server
    define( "VERSION", wp_get_theme()->get( "Version" ) );
}

function philosophy_assets(){
	wp_enqueue_style( "fontsawesome", get_theme_file_uri( "/assets/css/font-awesome/css/font-awesome.min.css" ), null, "1.0" );
	wp_enqueue_style( "fonts-css", get_theme_file_uri( "/assets/css/fonts.css" ), null, "1.0" );
	wp_enqueue_style( "base-css", get_theme_file_uri( "/assets/css/base.css" ), null, "1.0" );
	wp_enqueue_style( "vendor-css", get_theme_file_uri( "/assets/css/vendor.css" ), null, "1.0" );
	wp_enqueue_style( "main-css", get_theme_file_uri( "/assets/css/main.css" ), null, "1.0" );
	wp_enqueue_style( "philosophy-css", get_stylesheet_uri(), null, VERSION );


	wp_enqueue_script( "jquery" );
	wp_enqueue_script( "modernizr-js", get_theme_file_uri("/assets/js/modernizr.js") , null, 1.0 );
	wp_enqueue_script( "pace-js", get_theme_file_uri("/assets/js/pace.min.js") , null, 1.0 );
	wp_enqueue_script( "modernizr-js", get_theme_file_uri("/assets/js/modernizr.js") , null, 1.0 );
	wp_enqueue_script( "plugins-js", get_theme_file_uri("/assets/js/plugins.js") , array( "jquery" ), true );
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	wp_enqueue_script( "main-js", get_theme_file_uri("/assets/js/main.js") , array( "jquery" ), 1.0, true );
}
add_action( "wp_enqueue_scripts", "philosophy_assets" );


// Home pagination
function philosophy_home_pagination(){
	global $wp_query;
	$links = paginate_links( array(
		'current' => max(1, get_query_var( 'paged' )),
		'total' => $wp_query->max_num_pages,
		'type' => 'list',
		'mid_size' => 3,
	) );
	$links = str_replace( 'page-numbers', 'pgn__num', $links);
	$links = str_replace( "<ul class='pgn__num'>", '<ul>', $links);
	$links = str_replace( 'next pgn__num', 'pgn__next', $links);
	$links = str_replace( 'prev pgn__num', 'pgn__prev', $links);
	echo wp_kses_post($links);
}

// Remove Extra p tag from category description
remove_action( 'term_description', 'wpautop');

// Sideebar
function philosophy_widgets(){
	register_sidebar( array(
        'name' => __( 'About Us page Sidebar', 'philosophy' ),
        'id' => 'about-us-sidebar',
        'description' => __( 'Widgets in this area will be shown on about us page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-block %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="quarter-top-margin">',
		'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Contact Us Map', 'philosophy' ),
        'id' => 'contact-us-map',
        'description' => __( 'Widgets in this area will be shown on contact us page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="map-wrap %2$s">',
		'after_widget'  => '</div>',
    ) );

    register_sidebar( array(
        'name' => __( 'Contact Us Contact Info', 'philosophy' ),
        'id' => 'contact-us-contact',
        'description' => __( 'Widgets in this area will be shown on contact us page.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="col-six tab-full "%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer About Us Widget', 'philosophy' ),
        'id' => 'footer-about-us',
        'description' => __( 'Widgets in this area will be shown on about us widget.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Newsletter', 'philosophy' ),
        'id' => 'footer-newsletter',
        'description' => __( 'Widgets in this area will be shown on footer.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4>',
		'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name' => __( 'Footer Copyright', 'philosophy' ),
        'id' => 'footer-copyright',
        'description' => __( 'Widgets in this area will be shown on footer.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="s-footer__copyright %2$s">',
		'after_widget'  => '</div>',
    ) );

    register_sidebar( array(
        'name' => __( 'Header Social', 'philosophy' ),
        'id' => 'header-social',
        'description' => __( 'Widgets in this area will be shown on header.', 'philosophy' ),
        'before_widget' => '<div id="%1$s" class="s-footer__copyright %2$s">',
		'after_widget'  => '</div>',
    ) );
}
add_action('widgets_init','philosophy_widgets');

function philosophy_search_form(){
	$homedir = home_url();
	$search = __('Search for:','philosophy');
	$searcha = __('Search','philosophy');
	$philosophy_form = <<<FORM
<form role="search" method="get" class="header__search-form" action="{$homedir}">
    <label>
        <span class="hide-content">{$search}</span>
        <input type="search" class="search-field" placeholder="Type Keywords" value="" name="s" title="{$search}" autocomplete="off">
    </label>
    <input type="submit" class="search-submit" value="{$searcha}">
</form>
FORM;
return $philosophy_form;
}
add_action('get_search_form','philosophy_search_form');
