<?php
/**
 * The Template for displaying store tabs.
 *
 * @package WCfM Markeplace Views Store
 *
 * For edit coping this to yourtheme/wcfm/store 
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $WCFM, $WCFMmp,$count;

$store_tabs = $store_user->get_store_tabs();
// 去除数组的最后一个值
array_pop($store_tabs);
$store_tabs['products']="Customs";
$store_tabs['policies']="Policies";
?>

<?php do_action( 'wcfmmp_store_before_tabs', $store_user->get_id() ); ?>

<style>
	@media screen and (max-width: 667px) {
		.li_a{
			font-size:8px!important;
		}
		#wcfmmp-store .tab_area .tab_links li.active {
	        border-top: 1px solid #000!important;
	        border-bottom: 0!important;
	        border-left: 4px solid #000!important
	    }
	}
	#wcfmmp-store .tab_area .tab_links {
	    border-bottom: 1px solid #000000;
	}
	#wcfmmp-store .tab_area .tab_links li {
	    border: 1px solid #000;
	    border-bottom: 0px solid #000;
	}
	@media screen and (max-width: 667px) {
		.tab_links{
			width:auto!important;
		}
	}
</style>
<div id="tab_links_area" class="tab_links_area">
	<ul class="tab_links" style="display:flex;margin-left:-10px;">
		<?php foreach( $store_tabs as $store_tab_key => $store_tab_label ) {  
		  	$userAgent = $_SERVER['HTTP_USER_AGENT'];
    		$pattern = '/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i';
		 	if(preg_match($pattern, $userAgent)){
				if($store_tab_key==="reviews"){ 
	  	?>
	  	<li class="<?php if( $store_tab_key == $store_tab ) echo 'active';echo $store_tab_key; ?>" style="width:95px;"><a class="li_a" href="<?php echo esc_url($store_user->get_store_tabs_url( $store_tab_key )); ?>/#tab_links_area"><?php echo wp_kses_post($store_tab_label); ?></a></li>
	  	<?php }else{ ?>
		  	<li class="<?php if( $store_tab_key == $store_tab ) echo 'active';echo $store_tab_key; ?>" style="width:85px;"><a class="li_a" href="<?php echo esc_url($store_user->get_store_tabs_url( $store_tab_key )); ?>/#tab_links_area"><?php echo wp_kses_post($store_tab_label); ?></a></li>
	  	<?php	
		  		}
	   		}else{
		?>
		
				   <li class="<?php if( $store_tab_key == $store_tab ) echo 'active';echo $store_tab_key; ?>"><a class="li_a" href="<?php echo esc_url($store_user->get_store_tabs_url( $store_tab_key )); ?>/#tab_links_area"><?php echo wp_kses_post($store_tab_label); ?></a></li>
		<?php
			   }
		} 
		?> 
	</ul>
</div>
<div class="wcfm-clearfix"></div>

<?php do_action( 'wcfmmp_store_after_tabs', $store_user->get_id() ); ?>
