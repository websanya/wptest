<?php
/**
 * The main template file.
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
	}

}
?>

<?php
get_sidebar();
get_footer();
