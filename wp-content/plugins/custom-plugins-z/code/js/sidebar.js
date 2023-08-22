// 使用jQuery发送Ajax请求获取菜单HTML
function loadCustomMenuLayoutAjax() {
    jQuery.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'custom_menu_layout_ajax',
            menu_id: jQuery('.custom-menu-layout-ajax').data('menu-id')
        },
        success: function(response) {
            // 将菜单HTML插入到页面
            jQuery('.custom-menu-layout-ajax').html(response);
        }
    });
}

// 页面加载完成后调用Ajax加载菜单
jQuery(document).ready(function() {
    loadCustomMenuLayoutAjax();
});
