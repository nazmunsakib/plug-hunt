<?php
/**
 * Plugin Name: Plug Hunt
 * Description: Plug Hunt is a wordpress Plugin
 * Author: Nazmun Sakib
 * Author URI: https://namunsakib.com
 * Version: 1.0
 * License: GPL2
 * Text Domain: phunt
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( is_admin() ) {
	require_once dirname( __FILE__ ) . '/inc/admin/profile.php';
}

/**
 * author Bio
 * Parametar @$contact
 */
function phunt_author_bio( $contact ) {
	global $post;

	$author = get_user_by( 'id', $post->post_author );

	$bio      = get_user_meta( $author->ID, 'description', true );
	$facebook = get_user_meta( $author->ID, 'facebook', true );
	$twitter  = get_user_meta( $author->ID, 'twitter', true );
	$linkedin = get_user_meta( $author->ID, 'linkedin', true );

	ob_start();
	?>

    <div class="author-wrapper">
        <div class="author-image">
			<?php echo get_avatar( $author->ID, 96 ); ?>
        </div>
        <div class="author-info">
            <h3><?php echo $author->display_name; ?></h3>
            <p><?php echo esc_html( $bio ); ?></p>
            <ul class="author-social">
                <li><a href="<?php echo esc_url( $facebook ); ?>"><?php _e( 'Facebook', 'phunt' ); ?></a></li>
                <li><a href="<?php echo esc_url( $twitter ); ?>"><?php _e( 'Twitter', 'phunt' ); ?></a></li>
                <li><a href="<?php echo esc_url( $linkedin ); ?>"><?php _e( 'Linkedin', 'phunt' ); ?></a></li>
            </ul>
        </div>
    </div>

	<?php
	$markup = ob_get_clean();

	return $contact . $markup;
}

add_filter( 'the_content', 'phunt_author_bio' );

function phunt_plugin_script() {
	wp_enqueue_style( 'phunt-style', plugins_url( 'assets/css/style.css', __FILE__ ) );
}

add_action( 'wp_enqueue_scripts', 'phunt_plugin_script' );