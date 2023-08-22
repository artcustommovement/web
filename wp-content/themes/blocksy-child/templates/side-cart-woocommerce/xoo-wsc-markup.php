<?php
/**
 * Side Cart Markup
 *
 * This template can be overridden by copying it to yourtheme/templates/side-cart-woocommerce/xoo-wsc-markup.php.
 *
 * HOWEVER, on occasion we will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 * @see     https://docs.xootix.com/side-cart-woocommerce/
 * @version 2.1
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="xoo-wsc-modal" id="custom_side_bar">

	<?php xoo_wsc_helper()->get_template( 'xoo-wsc-container.php' ); ?>

	<span class="xoo-wsc-opac">

</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
  // 获取类名为 'ct-cart-item' 的所有元素
  var cartItems = document.querySelectorAll('.ct-cart-item');
  var customSideBar = document.getElementById('custom_side_bar');

  // 给每个 'ct-cart-item' 元素添加点击事件监听器
  cartItems.forEach(function(item) {
    item.addEventListener('click', function() {
      // 为 'custom_side_bar' 元素添加类名 'xoo-wsc-cart-active'
      customSideBar.classList.add('xoo-wsc-cart-active');
    });
  });
});
</script>
