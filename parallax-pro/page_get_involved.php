<?php
/**
* Template Name: Get Involved
* Author: PRDXN
*/
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );

global $post;
$post_slug=$post->post_name;

// * Add the featured image after post title
add_action( 'genesis_before_entry', 'get_involved_featured_image' );
function get_involved_featured_image() {
	$video_url = get_field("video_url", false, false);
	$hasVideo = !empty($video_url); 	/*echo ('Video url: ' . $video_url . ' hasVideo: ' . $hasVideo); */
	if ($hasVideo) {
		$videoClass = ' video';
	}
	else {
		$videoClass = '';
	}
	echo '<div class="programs-hero-image'.$videoClass.'"><div class="wrap"><div class="hero-content"><div class="donate-desc">';
	echo the_field("donate_text");
	echo '<h3 class="page-title">';
	echo the_title() . '</h3></div>';
	echo the_field("donate_shortcode");
	echo '</div></div>';
	if ($hasVideo) {
		echo'<video autoplay="" muted="" loop="" width="100%" height="100%" id="myVideo"> <source src="'.$video_url.'" type="video/mp4"> <img src="/wp-content/uploads/2016/12/haiti-now-home-page.jpg" title="Your browser does not support the<video> tag"></video>';
		echo '</div>';
	}
	elseif ( $image = genesis_get_image( 'format=url&size=programs' ) ) {
		printf( '<img class="firstimg" src="%s" alt="%s" />', $image, the_title_attribute( 'echo=0' ) );
		echo '</div>';
	} else {
		echo '<img class="secondimg" src="' . get_bloginfo( 'stylesheet_directory' )
		. '/images/empty-image.png" /></div>';
	}
}

add_action( 'genesis_loop', 'get_involved_loop' );
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
}

remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
remove_action( 'genesis_footer', 'genesis_do_footer' );
genesis();


