<?php
/**
 * The Template for displaying store.
 *
 * @package WCfM Markeplace Views Store Sold By Simple
 *
 * For edit coping this to yourtheme/wcfm/sold-by
 *
 */
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $WCFM, $WCFMmp;

if( empty($product_id) && empty($vendor_id) ) return;

if( empty($vendor_id) && $product_id ) {
	$vendor_id = wcfm_get_vendor_id_by_post( $product_id );
}
if( !$vendor_id ) return;

if( $vendor_id ) {
	if( apply_filters( 'wcfmmp_is_allow_sold_by', true, $vendor_id ) && wcfm_vendor_has_capability( $vendor_id, 'sold_by' ) ) {
		// Check is store Online
		$is_store_offline = get_user_meta( $vendor_id, '_wcfm_store_offline', true );
		if ( $is_store_offline ) {
			return;
		}
		
		$sold_by_text = $WCFMmp->wcfmmp_vendor->sold_by_label( absint($vendor_id) );
		if( apply_filters( 'wcfmmp_is_allow_sold_by_linked', true ) ) {
			$store_name = wcfm_get_vendor_store( absint($vendor_id) );
		} else {
			$store_name = wcfm_get_vendor_store_name( absint($vendor_id) );
		}

		echo '<div class="wcfmmp_sold_by_container">';
		echo '<div class="wcfm-clearfix"></div>';
		do_action('before_wcfmmp_sold_by_label_product_page', $vendor_id );
		echo '<div class="wcfmmp_sold_by_wrapper">';
		
		if( apply_filters( 'wcfmmp_is_allow_sold_by_label', true ) ) {
			echo '<span class="wcfmmp_sold_by_label">' . $sold_by_text . ':&nbsp;</span>';
		}

		echo wp_kses_post($store_name);

		if( apply_filters( 'wcfmmp_is_allow_sold_by_badges', true ) ) {
			if( !apply_filters( 'wcfm_is_allow_badges_with_store_name', false ) ) {
				do_action('custom_wcfmmp_store_mobile_badges', $vendor_id );
			}
		}
		
		if( apply_filters( 'wcfmmp_is_allow_sold_by_badges', true ) ) {
			if( apply_filters( 'wcfm_is_allow_badges_with_store_name', false ) ) {
				echo '<div class="wcfmmp_sold_by_badges_with_store_name" style="display:inline-block;margin-left:10px;">';
				do_action('wcfmmp_store_mobile_badges', $vendor_id );
				echo '</div>';
			}
		}

		echo '</div>';
		
		if ( apply_filters( 'wcfm_is_pref_vendor_reviews', true ) && apply_filters( 'wcfmmp_is_allow_sold_by_review', true ) ) {
		    echo '<div class="wcfm-clearfix" style="margin-top:-5px">';
		    $WCFMmp->wcfmmp_reviews->show_star_rating( 0, $vendor_id );
			 // 获取评价分数和总数
			$store_user  = wcfmmp_get_store( $vendor_id );
		    $review_rating = $store_user->get_avg_review_rating();
		    $review_count = $store_user->get_total_review_count();
		    if ( $review_rating && $review_count ) {
		        $rating_text = wc_format_decimal( $review_rating, 1 ) . ' (' . $review_count . ')';
		        echo '<div class="review_rating_count">' . $rating_text . '</div>';
		    }
		    echo '<div class="wcfm-clearfix"></div></div>';
		}
		
		do_action('wcfmmp_sold_by_label_product_page_after', $vendor_id );
		
		echo '<div class="wcfm-clearfix"></div>';
		echo '</div>';
	}
}

