<?php

global $WCFM, $WCFMmp, $wpdb;

$wcfmmp_shipping          = get_user_meta( $vendor_id, '_wcfmmp_shipping', true );
$processing_times         = wcfmmp_get_shipping_processing_times();
$processing_time          = isset($wcfmmp_shipping['_wcfmmp_pt']) ? $wcfmmp_shipping['_wcfmmp_pt'] : '';
$processing_time          = get_post_meta( $product_id, '_wcfmmp_processing_time', true ) ? get_post_meta( $product_id, '_wcfmmp_processing_time', true ) : $processing_time;
$substring = "day";
$matches=array();

if( isset( $wcfmmp_shipping['_wcfmmp_user_shipping_enable'] ) && $processing_time && isset( $processing_times[$processing_time] ) ) {
	if(stristr($processing_times[$processing_time], $substring)){
		$pattern = '/(\d+)(?:-(\d+))?/'; // 匹配 "3-4 weeks" 格式的正则表达式模式
		if (preg_match($pattern, $processing_times[$processing_time], $matches)) {
    		$startNumber = $matches[0]+7; // 第一个数字
    		$endNumber = isset($matches[1]) ? $matches[1]+21 : $startNumber+21; // 第二个数字（如果存在）或者默认为第一个数字
		}
		$current_time = date('Y-m-d');
    	$future_time_start = strftime('%d %b', strtotime('+'.$startNumber .'days')); // Add 24 days to the current time and format as "29 mry"
		$future_time_end = strftime('%d %b', strtotime('+'.$endNumber.'days')); // Add 31 days to the current time and format as "29 mry"
    	$future_time_start = ltrim($future_time_start, '0');
		$future_time_end = ltrim($future_time_end, '0');
		$future_time = $future_time_start . '-' . $future_time_end;
		echo '<div class="wcfm_clearfix"></div><div class="custom_time">ESTIMATED ARRIVAL TIME: '.$future_time.'</div><div class="wcfm_clearfix"></div>';
	}else{
		$pattern = '/(\d+)(?:-(\d+))?/'; // 匹配 "3-4 weeks" 格式的正则表达式模式
		if (preg_match($pattern, $processing_times[$processing_time], $matches)) {
    		$startNumber = $matches[0]*7+7; // 第一个数字
    		$endNumber = isset($matches[1]) ? $matches[2]*7+21 : $startNumber*7+21; // 第二个数字（如果存在）或者默认为第一个数字
		}
		$current_time = date('Y-m-d');
    	$future_time_start = strftime('%d %b', strtotime('+'.$startNumber .'days')); // Add 24 days to the current time and format as "29 mry"
		$future_time_end = strftime('%d %b', strtotime('+'.$endNumber.'days')); // Add 31 days to the current time and format as "29 mry"
    	$future_time_start = ltrim($future_time_start, '0');
		$future_time_end = ltrim($future_time_end, '0');
		$future_time = $future_time_start . '-' . $future_time_end;
		echo '<div class="wcfm_clearfix"></div><div class="custom_time">ESTIMATED ARRIVAL TIME: '.$future_time.'</div><div class="wcfm_clearfix"></div>';
	}
	
}else{
    $current_time = date('Y-m-d');
    $future_time_start = strftime('%d %b', strtotime('+7 days')); // Add 24 days to the current time and format as "29 mry"
    $future_time_end = strftime('%d %b', strtotime('+21 days')); // Add 31 days to the current time and format as "29 mry"
    $future_time_start = ltrim($future_time_start, '0');
		$future_time_end = ltrim($future_time_end, '0');
	$future_time = $future_time_start . '-' . $future_time_end;
	echo '<div class="wcfm_clearfix"></div><div class="custom_time">ESTIMATED ARRIVAL TIME: '.$future_time.'</div><div class="wcfm_clearfix"></div>';
}

if( !apply_filters( 'wcfm_is_allow_product_free_shipping_info', true ) ) return;


?>
