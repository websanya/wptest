<?php
/**
 * Generic page template file.
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
		<section class="page-area">
			<h2 class="page-area-title">
				<?= get_the_title(); ?>
			</h2>
			<article class="page-area-content"><?= get_the_content(); ?></article>
		</section>
		<?php
	}

}
?>

<?php
get_footer();
