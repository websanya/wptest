<?php
/**
 * The front page template file.
 *
 * @package wp-test
 */

get_header();
?>

<?php
if ( have_posts() ) {

	/* Start the Loop */
	while ( have_posts() ) {
		the_post();
		?>
		<section class="page-area page-front">
			<h2 class="page-area-title">
				<?= get_the_title(); ?>
			</h2>
			<article class="page-area-content"><?php the_content(); ?></article>
		</section>
		<?php
	}

}

$args     = array(
	'post_type'      => 'news',
	'posts_per_page' => - 1,
	//* To include future post of December 2018 year.
	'post_status'    => array(
		'publish',
		'future',
	)
);
$wp_query = new WP_Query( $args );

if ( $wp_query->have_posts() ) {
	?>
	<div class="site-news">
		<h2 class="site-news-title">
			Новости
		</h2>
		<?php
		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();
			$post_id = get_the_ID();
			?>
			<article class="site-news-item">
				<img class="site-news-item-image" src="<?= get_the_post_thumbnail_url( $post_id, 'full' ) ?>"
					 alt="<?= get_the_title() ?>">
				<div class="site-news-item-inner">
					<div class="site-news-item-time">
						<a href="<?= get_the_permalink(); ?>">
							<?= get_the_time( 'j F' ) . ', ' . get_the_time( 'Y' ); ?>
						</a>
					</div>
					<div class="site-news-item-content">
						<?php the_content(); ?>
					</div>
				</div>
			</article>
			<?php
		}
		?>
	</div>
	<?php
	wp_reset_query();
}
?>

<?php
get_footer();
