<?php
/*
 * Sets up the custom header feature
 *
 * @package fang
 */

function fang_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'fang_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 960,
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'fang_header_style',
		'admin-head-callback'    => 'fang_admin_header_style',
		'admin-preview-callback' => 'fang_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'fang_custom_header_setup' );

if ( ! function_exists( 'fang_header_style' ) ) :

function fang_header_style() {
	$header_text_color = get_header_textcolor();

	if ( HEADER_TEXTCOLOR == $header_text_color ) {
		return;
	}

	?>
	<style type="text/css">
	<?php
		// If the hide text option has been selected
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that color
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // fang_header_style

if ( ! function_exists( 'fang_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 */
function fang_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // fang_admin_header_style

if ( ! function_exists( 'fang_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 */
function fang_admin_header_image() {
	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );
?>
	<div id="headimg">
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<div class="displaying-header-text" id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // fang_admin_header_image