<?php
/**
 * The Template for displaying all store header
 *
 * @package WCfM Markeplace Views Store Header
 *
 * For edit coping this to yourtheme/wcfm/store 
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $WCFM, $WCFMmp, $wpdb;

/**
	 * Get the shop address
	 *
	 * @return array
	 */
	// 在你的主题或插件中添加新的函数

$gravatar = $store_user->get_avatar();
$email    = $store_user->get_email();
$phone    = $store_user->get_phone(); 
$address  = $store_user->get_address_string(); 

$store_lat    = isset( $store_info['store_lat'] ) ? esc_attr( $store_info['store_lat'] ) : 0;
$store_lng    = isset( $store_info['store_lng'] ) ? esc_attr( $store_info['store_lng'] ) : 0;

$store_address_info_class = '';
$store_id=$store_user->get_id();

//获取评价分数
$avg_review_rating = $store_user->get_avg_review_rating();
if(empty($avg_review_rating)){
	$avg_review_rating="0.00";
}else{
	$avg_review_rating = number_format($avg_review_rating, 2); // 保留两位小数
}
?>

<?php do_action( 'wcfmmp_store_before_header', $store_user->get_id() ); ?>

<style>
	#logo_area_img {
		border-radius:15%!important;
	}
	.bd_icon_box a:hover{
  		/* 鼠标悬停时的样式 */
  		transform: scale(1.1); /* 将元素放大到原来的1.2倍 */
	}
	.custom_time span{
		margin-left: 0px!important;
		font-size:15px!important;
	}
		.wcfm_vendor_badges{
			margin:0px;
		}
	.product_title_badges{
		display:flex;	
	}
	@media screen and (max-width: 667px) {
		.product_title_badges{
				justify-content: center;
		}
	}
	<?php if(empty($avg_review_rating)){ ?>
		@media screen and (min-width: 1025) {
			.logo_area_after{
			left:5%!important;
			}
		}
		@media screen and (min-width: 668px),(max-width:1024px) {
			.logo_area_after{
			left:10%!important;
			}
		}
		@media screen and (max-width: 667px) {
			.logo_area_after{
				left:15%!important;
			}
		}
	<?php	}else{ ?>
		@media screen and (min-width: 1025) {
			.logo_area_after{
			left:5%!important;
			}
		}
		@media screen and (min-width: 668px),(max-width:1024px) {
			.logo_area_after{
				left:5%!important;
			}
			.address{
				margin-left:40px!important;
			}
		}
		@media screen and (max-width: 667px) {
			.logo_area_after{
			left:33.5%!important;
			}
			.address{
				margin-left:0px!important;
			}
		}
	<?php	} ?>
		.bd_icon_area .wcfm_store_enquiry{
			border:1px solid black;
		}
</style>

<div id="wcfm_store_header">
	<div class="header_wrapper">
		<div class="header_area">
			<div class="lft header_left">
			
				<?php do_action( 'wcfmmp_store_before_avatar', $store_user->get_id() ); ?>
				
				<div class="logo_area lft"><img id="logo_area_img" src="<?php echo esc_url($gravatar); ?>" alt="Logo"/></div>
					<div class="logo_area_after" style="">
						<?php do_action( 'wcfmmp_store_after_avatar', $store_user->get_id() ); ?>

						<?php if( apply_filters( 'wcfm_is_pref_vendor_reviews', true ) && apply_filters( 'wcfm_is_allow_review_rating', true ) ) { $WCFMmp->wcfmmp_reviews->show_star_rating( 0, $store_user->get_id() ); } 
								echo "<strong>".$avg_review_rating."</strong>";
						?>
						<div class="spacer"></div> 
						<div>
						<div>
							<?php 					
								// 执行数据库查询
								$results = $wpdb->get_results(
								    $wpdb->prepare(
								        "SELECT * FROM {$wpdb->prefix}wcfm_marketplace_orders WHERE vendor_id = %d",
								        $store_id
								    ),
								    ARRAY_A
								);
								// 获取供应商订单数
								$order_count = count($results);
								echo "(".$order_count." Sales)";

								// 真实的供应商销量
								// $sql = "SELECT order_id FROM {$wpdb->prefix}wcfm_marketplace_orders";
								// $sql .= " WHERE ";
								// $sql .= " vendor_id = %d";
								// $sql .= " GROUP BY order_id";
								// $number_of_orders = count( $wpdb->get_results( $wpdb->prepare( $sql, $store_id ) ) );
								// echo "(".$number_of_orders." Sales)";
							?>
						</div>
						<div>
							<?php if( !apply_filters( 'wcfm_is_allow_badges_with_store_name', false ) ) { ?>
								<div class="wcfmmp_store_mobile_badges">
									<?php do_action( 'wcfmmp_store_mobile_badges', $store_user->get_id() ); ?>
									<div class="spacer"></div> 
								</div>
							<?php } ?>
						</div>
					</div> 
					</div>
				<div class="address rgt">
				  <?php if( ( $WCFMmp->wcfmmp_vendor->get_vendor_name_position( $store_user->get_id() ) == 'on_header' ) || apply_filters( 'wcfm_is_allow_store_name_on_header', false ) ) { ?>
				  	<div class="product_title_badges" style="margin-top:20px;">
						<h1 class="wcfm_store_title">
				  			<?php echo apply_filters( 'wcfmmp_store_title', esc_html( $store_info['store_name'] ), $store_user->get_id() ); ?>
				  		<?php if( apply_filters( 'wcfm_is_allow_badges_with_store_name', false ) ) { ?>
									<div class="wcfmmp_store_mobile_badges wcfmmp_store_mobile_badges_with_store_name">
										 <?php do_action( 'wcfmmp_store_mobile_badges', $store_user->get_id() ); ?>
										<div class="spacer"></div> 
									</div>
						
				  		</h1><?php } ?>
					</div>
				  <?php $store_address_info_class = 'header_store_name'; }else{
					  echo "<style>
					  			@media (max-width:768px){
									.wcfmmp_store_header_address{
										padding-top:15px!important;
									}
								}
					  		</style>";
				  } ?>
				  
				  <?php do_action( 'before_wcfmmp_store_header_info', $store_id ); ?>
					<?php do_action( 'wcfmmp_store_before_address', $store_user->get_id() ); ?>
					
					<?php if( $address && ( $store_info['store_hide_address'] == 'no' ) && wcfm_vendor_has_capability( $store_user->get_id(), 'vendor_address' ) ) { ?>
						<p class="<?php echo esc_attr($store_address_info_class); ?> wcfmmp_store_header_address">
						  <!--导航栏定位标签隐藏
						  <i class="wcfmfa fa-map-marker" style="color:#000!important;" aria-hidden="false"></i>-->
						    <span style="color:#000!important;margin:0px;"><?php echo esc_attr($address); ?></span>
						</p>
					<?php } ?>
					
					<?php do_action( 'wcfmmp_store_after_address', $store_user->get_id() ); ?>
					
					<div class="<?php echo esc_attr($store_address_info_class); ?>">
						
					  <?php do_action( 'wcfmmp_store_before_phone', $store_user->get_id() ); ?>
						
					  <?php if( $phone && ( $store_info['store_hide_phone'] == 'no' ) && wcfm_vendor_has_capability( $store_user->get_id(), 'vendor_phone' ) ) { ?>
							<div class="store_info_parallal wcfmmp_store_header_phone" style="margin-right: 10px;">
							  <i class="wcfmfa fa-phone" aria-hidden="true"></i>
							  <span>
							    <?php if( apply_filters( 'wcfmmp_is_allow_tel_linked', true ) ) { ?>
							      <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_attr($phone); ?></a>
							    <?php } else { ?>
							    	<?php echo esc_attr($phone); ?>
							   <?php } ?>
							  </span>
							</div>
						<?php } ?>
						
						<?php do_action( 'wcfmmp_store_after_phone', $store_user->get_id() ); ?>
						<?php do_action( 'wcfmmp_store_before_email', $store_user->get_id() ); ?>
						
						<?php if( $email && ( $store_info['store_hide_email'] == 'no' ) && wcfm_vendor_has_capability( $store_user->get_id(), 'vendor_email' ) ) { ?>
							<div class="store_info_parallal wcfmmp_store_header_email">
							  <i class="wcfmfa fa-envelope" aria-hidden="true"></i>
							  <span>
							    <?php if( apply_filters( 'wcfmmp_is_allow_mailto_linked', true ) ) { ?>
							      <a href="mailto:<?php echo apply_filters( 'wcfmmp_mailto_email', $email, $store_user->get_id() ); ?>"><?php echo esc_attr($email); ?></a>
							    <?php } else { ?>
							    	<?php echo esc_attr($email); ?>
							    <?php } ?>
							  </span>
							</div>
						<?php } ?>
						
						<?php do_action( 'wcfmmp_store_after_time', $store_user->get_id() ); ?>
						
						<div class="spacer"></div>  
					</div>
					<?php do_action( 'after_wcfmmp_store_header_info', $store_user->get_id() ); ?>
				</div>
			  <div class="spacer"></div>    
			</div>
			<div class="header_right cutsom_header_right">
				<div class="bd_icon_area lft ">
				
				  <?php do_action( 'before_wcfmmp_store_header_actions', $store_user->get_id() ); ?>
				
					<?php do_action( 'wcfmmp_store_before_enquiry', $store_user->get_id() ); ?>
					
					<?php if( apply_filters( 'wcfm_is_pref_enquiry', true ) && apply_filters( 'wcfmmp_is_allow_store_header_enquiry', true ) && wcfm_vendor_has_capability( $store_user->get_id(), 'enquiry' ) ) { ?>
						<?php do_action( 'wcfmmp_store_enquiry', $store_user->get_id() ); ?>
					<?php } ?>
					
					<?php do_action( 'wcfmmp_store_after_enquiry', $store_user->get_id() ); ?>
					<?php do_action( 'wcfmmp_store_before_follow_me', $store_user->get_id() ); ?>
					
					<?php 
					if( apply_filters( 'wcfm_is_pref_vendor_followers', true ) && apply_filters( 'wcfm_is_allow_store_followers', true ) && wcfm_vendor_has_capability( $store_user->get_id(), 'vendor_follower' ) ) {
						do_action( 'wcfmmp_store_follow_me', $store_user->get_id() );
					}

					?>
					
					<?php do_action( 'wcfmmp_store_after_follow_me', $store_user->get_id() ); ?>
					
					<?php do_action( 'after_wcfmmp_store_header_actions', $store_user->get_id() ); ?>
					
					<div class="spacer"></div>   
				</div>
				<?php if( !empty( $store_info['social'] ) && $store_user->has_social() && wcfm_vendor_has_capability( $store_user->get_id(), 'vendor_social' ) ) { ?>
					<div class="social_area rgt" >
						<?php $WCFMmp->template->get_template( 'store/wcfmmp-view-store-social.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) ); ?>
					</div>
					 <div class="spacer"></div>
				<?php } ?>
				<div class="spacer"></div>
			</div>
		  <div class="spacer">
		  </div>    
		</div>
	</div>
</div>

<?php
	// 在你的主题或插件中添加新的函数
 
?>

<?php do_action( 'wcfmmp_store_after_header', $store_user->get_id() ); ?>
