<?php
/**
* Template Name: Two Column Layout
* Author: PRDXN
*/
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav' );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );


// echo get_page_template_slug( $post_id );
global $post;
$post_slug=$post->post_name;


if($post_slug == "our-programs") {
	// * Add the featured image after post title
	add_action( 'genesis_before_entry', 'programs_featured_image' );
	function programs_featured_image() {
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

	add_action( 'genesis_loop', 'programs_loop' );
	function programs_loop() {
		global $post;
		$post_slug=$post->post_name;
		?>

		<!-- Program Post Images -->
		<section class="program-posts">
			<div class="entry">
				<?php
				get_template_part( 'template-parts/page/content', 'default' );
				?>
			</div>
		</section>
		<?php
	}

} 

/*
* Movies Post Setup with Load More
*/
else {
	global $post;
	$post_slug=$post->post_name;


	/* Page Title */
	add_action( 'genesis_entry_header', 'genesis_do_post_title' );

	/* Post Section Start*/
	add_action('genesis_before_loop','section_structure');
	function section_structure() {
		echo '<section class="program-posts columns-page">';
	}

	
	add_action( 'genesis_loop', 'new_loop' );
	function new_loop() {

		global $post;
		$post_slug=$post->post_name;

		$scroller_query = array( 
			'post_type' => $post_slug,
			'posts_per_page' => 8,
			);

			?>

			<div class="entry" id="loadmore-data">
				<?php
				$loop = new WP_Query( $scroller_query );
				$max = $loop->max_num_pages;
				if( $loop->have_posts() ): 
					while( $loop->have_posts() ): $loop->the_post();
				?>
				<div class="post-images two-columns movies" >
					<div class="image">
						<?php 
						if ( has_post_thumbnail() ) { 
							the_post_thumbnail();	
						} else {
							echo '<img src="' . get_bloginfo( 'stylesheet_directory' )
							. '/images/movies-empty.png" />';
						}
						?>
					</div>
					<div class="entry-content">
						<h3><?php the_title(); ?></h3>
						<div class="detailed-content">
							<?php the_content(); ?>
						</div>
					</div>

				</div>
				<?php
				endwhile; endif; wp_reset_postdata();
				?>
			</div>
			<?php

			echo '<button class="loadmore" data-total="'. $max .'" data-page="1" data-category="'. $post_slug .'" data-url="' . admin_url('admin-ajax.php') .'">View More</button></section>';
		}

	}



	remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
	remove_action( 'genesis_footer', 'genesis_do_footer' );


	genesis();


