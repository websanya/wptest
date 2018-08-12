<?php
/**
 * The header for our theme.
 *
 * @package wp-test
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

	<header id="masthead">
		<section class="site-header">
			<div class="site-header-inner">
				<div class="site-header-logo">
					<a href="<?= get_home_url(); ?>">
						<?php
						$custom_logo_id = get_theme_mod( 'custom_logo' );
						$image          = wp_get_attachment_image_src( $custom_logo_id, 'full' );
						?>
						<img class="site-logo-img" src="<?= $image[0]; ?>" alt="<?= get_bloginfo( 'name' ) ?>">
					</a>
				</div>
				<div class="site-header-phone">
					<span>+380 689 89 90</span>
				</div>
			</div>
		</section><!-- .site-header -->

		<nav class="site-navigation">
			<section class="site-navigation-inner">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu',
					'menu_id'        => 'site-menu',
					'menu_class'     => 'site-navigation-menu',
					'container'      => false
				) );
				?>
				<?php the_widget( 'WP_Widget_Search' ); ?>
			</section>
		</nav><!-- .site-navigation -->

		<?php
		$args     = array(
			'post_type'      => 'carousel',
			'posts_per_page' => - 1,
			//* To include future post of 2020 year.
			'post_status'    => array(
				'publish',
				'future',
			)
		);
		$wp_query = new WP_Query( $args );

		if ( $wp_query->have_posts() ) {
			?>
			<div id="siteCarousel" class="site-carousel slide carousel" data-ride="carousel">
				<?php
				$i = 1;
				while ( $wp_query->have_posts() ) {
					$wp_query->the_post();
					$post_id = get_the_ID();
					?>
					<div class="carousel-item <?php if ( $i == 1 ) {
						echo 'active';
					} ?>">
						<div class="carousel-item-inner">
							<div class="carousel-desc">
								<?php the_content(); ?>
							</div>
							<div class="carousel-time">
								<i class="far fa-clock"></i>
								<?= get_the_time( 'j F' ) . ', ' . get_the_time( 'Y' ); ?>
							</div>
							<div class="carousel-category">
								<?= get_the_category()[0]->name; ?>
							</div>
						</div>
						<img class="site-carousel-image" src="<?= get_the_post_thumbnail_url( $post_id, 'full' ) ?>"
						     alt="<?= get_the_title() ?>">
					</div>
					<?php
					$i ++;
				}
				?>
				<div class="carousel-controls">
					<a href="#siteCarousel" role="button" data-slide="prev">
						<i class="fas fa-caret-left"></i>
						<span class="sr-only">Previous</span>
					</a>
					<a href="#siteCarousel" role="button" data-slide="next">
						<i class="fas fa-caret-right"></i>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
			<?php
			wp_reset_query();
		}
		?>
	</header><!-- #masthead -->

	<main id="content" class="site-content">