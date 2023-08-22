<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WCfM Markeplace Views Store review ratings
 *
 * For edit coping this to yourtheme/wcfm/reviews 
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $WCFM, $WCFMmp;

//$total_review_rating = $store_user->get_total_review_rating();
$avg_review_rating = $store_user->get_avg_review_rating();
$total_review_count = $store_user->get_total_review_count();

if( !apply_filters( 'wcfm_is_allow_review_rating', true ) ) return;
?>

<?php if( $avg_review_rating ) { 
?>
	<div class="wcfm_custom_rating">
		<div class="rgt rating_count">
			<div class="rating_number wcfm_custom_rating_number"><?php echo wc_format_decimal( $avg_review_rating, 1 ); ?><sub>/5</sub></div>
		</div>
		<div class="rating_count_text"><?php echo $total_review_count." Ratings"; ?><sub></sub></div>
	</div>
<?php } ?>
