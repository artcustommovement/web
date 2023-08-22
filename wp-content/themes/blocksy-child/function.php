<?php
// 将此代码添加到子主题的 functions.php 文件中

// 加载父主题的样式表
function blocksy_child_enqueue_styles() {
    // 获取父主题样式表的版本号
    $parent_style_version = wp_get_theme('blocksy')->get('Version');

    // 加载父主题样式表
    wp_enqueue_style('blocksy-parent-style', get_template_directory_uri() . '/style.css', array(), $parent_style_version);
}
add_action('wp_enqueue_scripts', 'blocksy_child_enqueue_styles');

function remove_product_description_tab( $tabs ) {
    // 移除产品介绍选项卡
    unset( $tabs['description'] );

    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'remove_product_description_tab', 99 );

// 设置供应商名称链接跳转方式
add_filter('wcfm_vendor_store', function($store) {
return str_replace(' target="_blank"', '', $store);
});

// 设置登录注册的文字
function add_custom_register_js() {
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/static/js/custom_vendor.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'add_custom_register_js');

// 设置供应商商店页面商品的sold by的信息显示
add_action('woocommerce_after_shop_loop_item', function () {
    global $WCFMmp, $product;
    
    $wcfm_store_url = wcfm_get_option( 'wcfm_store_url', 'store' );
    $store_name = apply_filters( 'wcfmmp_store_query_var', get_query_var( $wcfm_store_url ) );
    if ( ! empty( $store_name ) ) {
        $store_user = get_user_by( 'slug', $store_name );
        $store_id = $store_user->ID;
        $product_id = $product->get_id();
        if( apply_filters( 'wcfmmp_is_allow_archive_sold_by_advanced', false ) ) { 
            $WCFMmp->template->get_template( 'sold-by/wcfmmp-view-sold-by-advanced.php', array( 'product_id' => $product_id, 'vendor_id' => $store_id ) );
        } else {
            $WCFMmp->template->get_template( 'sold-by/wcfmmp-view-sold-by-simple.php', array( 'product_id' => $product_id, 'vendor_id' => $store_id ) );
        }
    }
} );

// 获取wcfm处理时间
add_action('wcfmmp_store_after_time','before_wcfmmp_store_header_info'); 
function before_wcfmmp_store_header_info($vendor_id) { 
    $wcfmmp_shipping = get_user_meta( $vendor_id, '_wcfmmp_shipping', true ); 
    $processing_times = wcfmmp_get_shipping_processing_times(); 
    $processing_time = isset($wcfmmp_shipping['_wcfmmp_pt']) ? $wcfmmp_shipping['_wcfmmp_pt'] : ''; 
    if(empty($processing_time)){
        echo '<div class="custom_time"><span style="color:#000!important;">Processing Time 2-3 weeks</span></div>'; 
    }else{
        echo '<div class="custom_time"><span style="color:#000!important;">Processing Time '.$processing_times ["$processing_time"].'</span></div>'; 
    }
}

do_action( 'after_wcfm_products_manage_meta_save', $new_product_id, $wcfm_products_manage_form_data );

// 修改供应商商店inquiry按钮文字
add_filter('wcfm_is_allow_store_inquiry_custom_button_label', '__return_true');

// 处理注册供应商发送验证码时多次发送
// Stop automatic sending email verification code
add_action('wp_enqueue_scripts', function () {
    if (is_wcfm_membership_page()) {
        $current_step = wcfm_membership_registration_current_step();

        switch ($current_step) {
            case 'registration':
                ob_start();
                ?>
                <script>
                    (function($) {
                        $('#user_email').off('blur');
                    })(jQuery);
                </script>
                <?php
                $script = ob_get_clean();
                break;
        }
    }

    if (is_wcfm_registration_page()) {
        ob_start();
        ?>
        <script>
            jQuery(document).ready(function($) {
                $('#user_email').off('blur');
            });
        </script>
        <?php
        $script = ob_get_clean();
    }

    wp_add_inline_script('wcfm_membership_registration_js', $script, 'after');
}, 999);

// 处理wcfm添加产品时添加两个默认的自定义字段
add_filter('wcfm_is_allow_catalog', '__return_false');

//处理艺术家注册页面如果注册了跳转到新页面
add_action( 'template_redirect', function () {
    if ( ! is_page() ) {
        return;
    }
    $user_id = get_current_user_id();
    if(wcfm_is_vendor($user_id) && is_user_logged_in()) {
        if (is_wcfm_registration_page()){
			var_dump(1);
            wp_safe_redirect( 'https://artcustommovement.com/store-manager/' );
            exit();
        }
    }
});
