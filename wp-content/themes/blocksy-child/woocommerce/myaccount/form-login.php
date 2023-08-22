<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>
<style type="text/css">

/*外层*/
.Box {
	width: auto;
	margin: 10px auto;
	padding: 20px;
}

/*选项卡*/

@media (max-width:768px) {
	.con{
		width:100%;
	}
}
@media (min-width:768px) and (max-width:1024px){
	.con{
		width:75%;
	}
}
@media (min-width:1024px) {
	.con{
		width:50%;
	}
}
.con {
	margin: 0 auto;
	height: auto;
	margin-top: 10px;
	display: none;
}

/*当前按钮的效果*/

.Box button {
	font-size:15px;
	width:105px;
  padding: 13.66px 20px;
  background-color: #000;
  color: #fff;
  border: none;
  border-radius: 5px;
  /* cursor: pointer; */
  /* transition: background-color 0.3s ease-in-out; */
}

.Box button:hover {
  background-color: #fff; /* 鼠标悬停时的背景颜色 */
  color:#000;
  border:1px solid #000;
}

.Box button.current {
  background-color: #fff; /* 当前选中按钮的背景颜色 */
  color:#000;
  border:1px solid #000;
}

</style>


<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>
<div class="" id="customer_login">

	<div class="Box" id="box">


    <div class="con con1" style="display:block">
		 <div class="u-column1 col-1">

			<?php endif; ?>

			<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

			<form class="woocommerce-form woocommerce-form-login login" method="post">

				<?php do_action( 'woocommerce_login_form_start' ); ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required="required"/><?php // @codingStandardsIgnoreLine ?>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" required="required"/>
				</p>

				<?php do_action( 'woocommerce_login_form' ); ?>

				<p class="form-row">
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
						<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
					</label>
					<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
					<button type="submit" class="woocommerce-button button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
					<button type="button" class="click_btn" data-tab="con2">Register</button>
				</p>
				<p class="woocommerce-LostPassword lost_password">
					<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
				</p>

				<?php do_action( 'woocommerce_login_form_end' ); ?>

			</form>

			<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

		</div>
	</div>
    <div class="con con2">
		<div class="u-column2 col-2">

			<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

			<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?> >

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required="required"/><?php // @codingStandardsIgnoreLine ?>
					</p>

				<?php endif; ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required="required" /><?php // @codingStandardsIgnoreLine ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

					<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
						<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required="required"/>
					</p>

				<?php else : ?>

					<p><?php esc_html_e( 'A link to set a new password will be sent to your email address.', 'woocommerce' ); ?></p>

				<?php endif; ?>
				<div class="woocommerce-privacy-policy-text">
					<p style="font-size:14px;">
						By continuing, you agree to our
						<a href="https://artcustommovement.com/privacy-policy/" class="woocommerce-privacy-policy-link" target="_blank">
							privacy policy
						</a> 
					</p>
				</div>

				<p class="woocommerce-form-row form-row">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="woocommerce-Button woocommerce-button button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?> woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
					<button type="button" class="click_btn current" data-tab="con1">Login</button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>

		</div>
	</div>
	</div>
</div>
<script>
  /* 获取盒子 */
  var box = document.getElementById("box");

  /* 获取盒子内的按钮和选项卡 */
  var btns = box.getElementsByClassName("click_btn");
  var divs = box.getElementsByClassName("con");

  /* 遍历按钮，分别设置按钮index属性为从0到按钮长度-1的数字 */
  for (var i = 0; i < btns.length; i++) {
    btns[i].setAttribute("index", i);

    /* 当按钮被点击时，执行动画 */
    btns[i].addEventListener("click", tabButtonClick);
    btns[i].addEventListener("touchend", tabButtonClick);
  }

  function tabButtonClick(e) {
	  e.preventDefault();
    /* 把所有按钮上的class去掉，隐藏选项卡（通过迭代的方式） */
    for (var j = 0; j < divs.length; j++) {
      btns[j].classList.remove("current");
      divs[j].style.display = "none";
    }

    /* 设置被点击的按钮的class为current，被点击按钮对应的选项卡为显示状态 */
    this.setAttribute("class", "click_btn current");
    var targetTab = this.getAttribute("data-tab");
    var targetDiv = document.getElementsByClassName(targetTab)[0]; // 使用 [0] 来选择第一个匹配的元素
    targetDiv.style.display = "block";
  }
</script>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
