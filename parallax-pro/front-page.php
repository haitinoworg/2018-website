<?php
/**
 * This file adds the Home Page to the Parallax Pro Theme.
 *
 * @author StudioPress
 * @package Parallax
 * @subpackage Customizations
 */
/*add_action( 'genesis_meta', 'parallax_home_genesis_meta' );*/
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
//* Force full width content layout
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );

global $post;
$post_slug=$post->post_name;

// * Add the featured image after post title
add_action( 'genesis_before_entry', 'get_involved_featured_image' );
function get_involved_featured_image() {
	echo '<div class="programs-hero-image"><div class="wrap"><div class="hero-content"><div class="donate-desc">';
	echo the_field("donate_text");
	/*echo '<h3 class="page-title">';
	echo the_title() . '</h3></div>'; */
	/* echo the_field("donate_shortcode");*/
	echo '</div></div>';
	if ($video_url = get_field("video_url", false, false)) {
		echo'<video autoplay="" muted="" loop="" width="100%" height="100%" id="myVideo"> <source src="'.$video_url.'" type="video/mp4"> <img src="/wp-content/uploads/2016/12/haiti-now-home-page.jpg" title="Your browser does not support the<video> tag"></video>';
		echo '</div></div>';
	}
	elseif ( $image = genesis_get_image( 'format=url&size=programs' ) ) {
		printf( '<img class="firstimg" src="%s" alt="%s" />', $image, the_title_attribute( 'echo=0' ) );
		echo '</div>';
	} else {
		echo '<img class="secondimg" src="' . get_bloginfo( 'stylesheet_directory' )
		. '/images/empty-image.png" /></div>';
	}
}

/*add_action( 'genesis_loop', 'get_involved_loop' );
function get_involved_loop() {
	global $post;
	$post_slug=$post->post_name;
	?>

	<!-- Program Post Images -->
	<section class="program-posts">
		<div class="entry">
			<?php
			get_template_part( 'template-parts/page/content', 'pages' );
			?>
		</div>
	</section>
	<?php
}*/

remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
remove_action( 'genesis_footer', 'genesis_do_footer' );
genesis();


/*function parallax_home_genesis_meta() {

	if ( is_active_sidebar( 'home-section-1' ) || is_active_sidebar( 'home-section-2' ) || is_active_sidebar( 'home-section-3' ) || is_active_sidebar( 'home-section-4' ) || is_active_sidebar( 'home-section-5' ) || is_active_sidebar( 'home-section-6' ) || is_active_sidebar( 'home-section-7' ) || is_active_sidebar( 'home-section-8' ) || is_active_sidebar( 'home-section-9' ) || is_active_sidebar( 'home-section-10' ) ) {

		//* Enqueue parallax script
		add_action( 'wp_enqueue_scripts', 'parallax_enqueue_parallax_script' );
		function parallax_enqueue_parallax_script() {

			if ( ! wp_is_mobile() ) {

				wp_enqueue_script( 'parallax-script', get_bloginfo( 'stylesheet_directory' ) . '/js/parallax.js', array( 'jquery' ), '1.0.0' );
			}
		}

		//* Add parallax-home body class
		add_filter( 'body_class', 'parallax_body_class' );
		function parallax_body_class( $classes ) {

			$classes[] = 'parallax-home';
			return $classes;

		}

		//* Force full width content layout
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		// //* Remove primary navigation
		remove_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_nav' );

		// //* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');

		// //* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add homepage widgets
		add_action( 'genesis_loop', 'parallax_homepage_widgets' );

		// * Remove Footer
		remove_action( 'genesis_footer', 'genesis_do_footer' );


	}
}

//* Add markup for homepage widgets
function parallax_homepage_widgets() {

	genesis_widget_area( 'home-section-1', array(
		'before' => '<div class="home-odd home-section-1 widget-area"><div class="wrap"><video autoplay muted loop  width="100%" height="100%" id="myVideo">
  <source src="/wp-content/uploads/2018/10/HAITI-NOW-WEBSITE-LOOP_color-draft.webm" type="video/webm">
  <source src="/wp-content/uploads/2018/10/HAITI-NOW-WEBSITE-LOOP_color_draft.mp4" type="video/mp4">
  <!--Your browser does not support the video tag. -->
  <img src="/wp-content/uploads/2016/12/haiti-now-home-page.jpg" title="Your browser does not support the <video> tag">
</video>',
		'after'  => '</div></div>',
		) );

	genesis_widget_area( 'home-section-2', array(
		'before' => '<div class="home-even home-section-2 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
		) );

	genesis_widget_area( 'home-section-3', array(
		'before' => '<div class="home-odd home-section-3 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
		) );

	genesis_widget_area( 'home-section-4', array(
		'before' => '<div class="home-even home-section-4 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
		) );

	genesis_widget_area( 'home-section-5', array(
		'before' => '<div class="home-odd home-section-5 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
		) );

	genesis_widget_area( 'home-section-6', array(
		'before' => '<div class="home-even home-section-6 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
		) );

	genesis_widget_area( 'home-section-7', array(
		'before' => '<div class="home-odd home-section-7 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
		) );

	genesis_widget_area( 'home-section-8', array(
		'before' => '<div class="home-even home-section-8 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
		) );

	genesis_widget_area( 'home-section-10', array(
		'before' => '<div class="home-even home-section-10 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

genesis();*/