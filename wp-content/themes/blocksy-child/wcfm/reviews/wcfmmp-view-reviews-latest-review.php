<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WCfM Markeplace Views Store new review form
 *
 * For edit coping this to yourtheme/wcfm/reviews 
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $WCFM, $WCFMmp, $wpdb,$i;
$i=0;
if( !$total_review_count ) return;
if( empty( $latest_reviews ) ) return;

//获取所有的评论
$args = array(
    'post_type' => 'product',
    'post_status' => 'publish',
);

$comments_query = new WP_Comment_Query( $args );
$comments = $comments_query->get_comments();
// var_dump($comments);
// echo "<br>";
// var_dump($latest_reviews);
// echo "<br>";
// 创建新数组
$new_array_reviews = [];
//对两个插件的评论进行比对，把一样的放置到新数组当中
foreach ($comments as $item1) {
    foreach ($latest_reviews as $item2) {
        if ($item1->comment_author_email === $item2->author_email && $item1->comment_content === $item2->review_description && $item1->user_id === $item2->author_id && $item1->comment_date === $item2->created) {
			$new_array_reviews[] = [
                "comment_ID" => $item1->comment_ID,
            ];
        }
    }
}
?>
<style>
    
</style>
<?php foreach( $latest_reviews as $latest_review ) { 
		
	?>
	<div class="review_section">
		<div class="rgt user_review_sec">
		  <div class="user_review_sec_left" >
		  		<div style="display:flex;align-items: center;">
					<div class="user_name wcfm_custom_user_name" ><?php echo apply_filters( 'wcfmmp_review_author_name', $latest_review->author_name, $latest_review ); ?></div>
					<div class="user_review_area">
					  <span class="user_date wcfm_custom_user_date">
					  <?php 
						$date = date_i18n('F j', strtotime($latest_review->created));
						echo "&nbspon ".$date;
					  ?>
					  </span>
					</div>
				</div>
				<?php
					if( apply_filters( 'wcfm_is_allow_review_rating', true ) && apply_filters( 'wcfmmp_is_allow_review_categories', true ) ) {
						$wcfm_review_categories = get_wcfm_marketplace_active_review_categories();
						$category_review_rating = $store_user->get_review_meta( $latest_review->ID );
						if( $category_review_rating && !empty( $category_review_rating ) && is_array( $category_review_rating ) ) {
							echo '<div class="bd_rating_area" >';
							foreach( $wcfm_review_categories as $wcfm_review_cat_key => $wcfm_review_category ) {
								if( isset( $category_review_rating[$wcfm_review_cat_key] ) ) {
									?>
									<div class="rating_box wcfm_custom_rating_box">
										<i class="wcfmfa fa-star" aria-hidden="true"></i><i class="wcfmfa fa-star" aria-hidden="true"></i><i class="wcfmfa fa-star" aria-hidden="true"></i><i class="wcfmfa fa-star" aria-hidden="true"></i><i class="wcfmfa fa-star" aria-hidden="true"></i>
										<span>
										</span>
										<input type="hidden" class="store_rating_value" name="wcfm_saved_store_review_category[<?php echo esc_attr($wcfm_review_cat_key); ?>]" value="<?php echo wc_format_decimal( $category_review_rating[$wcfm_review_cat_key], 1 ); ?>" />
									</div>
									<?php
								}
								break;
							}
							echo '</div>';
						}
					}
				?>	
				<div class="user_review_text wcfm_custom_user_review_text">
					<p><?php echo wp_kses_post($latest_review->review_description); ?></p>
					<?php 
					$comment_id = $new_array_reviews[$i]['comment_ID'];
                    $i++;
                    $image_metadata = get_comment_meta( $comment_id, 'reviews-images', true );
                    if (is_array($image_metadata) && !empty($image_metadata)) {
                        echo '<div class="wcfm_img_container" style="display:flex">';
                        foreach ($image_metadata as $img_post_ids_k => $img_post_id) {
                            $src = wp_get_attachment_image_url($img_post_id, 'full');
                            echo '<div class="wcfm_img_column" style="margin:10px">';
                            echo '<img src="' . $src . '">';
                            echo '</div>';
                        }
                        echo '</div>';
                    }

					if( apply_filters( 'wcfm_is_allow_review_product', true ) ) {
						$product_id = $wpdb->get_var( $wpdb->prepare( "SELECT `value` FROM {$wpdb->prefix}wcfm_marketplace_review_rating_meta WHERE `review_id` = %d AND `key` = 'product' AND `type` = 'rating_product'", $latest_review->ID ) );
						if( $product_id ) {
							echo '<p><i class="wcfmfa fa-cube img_tip" data-tip="'. __( 'Review via Product', 'wc-multivendor-marketplace' ) .'"></i>&nbsp;<a style="display: inline-block;color:#17a2b8;" href="'. get_permalink($product_id) .'" target="_blank">'.get_the_title($product_id).'</a></p>';
						}
					} 
					?>
				</div>
				<?php if( apply_filters( 'wcfm_is_allow_review_reply', false ) ) { ?>
					<div class="reply_bt"><button><?php _e('Reply', 'wc-multivendor-marketplace' ); ?></button></div>
				<?php } ?>
			</div>
		</div>
		<div class="spacer"></div>    
	</div>
<?php } ?>
