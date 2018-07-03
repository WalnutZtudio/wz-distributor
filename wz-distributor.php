<?php
/*
Plugin Name: WZ Distributor
Plugin URI: https://walnutztudio.com
Description: Create list Distributor contact page for wordpress, with shortcode.
Version: 1.1.0
Author: WalnutZtudio
Author URI: https://walnutztudio.com
License: GPL2
Text Domain: wz-distributor
*/

/*
Copyright 2018 WalnutZtudio  (email : walnutztudio@gmail.com)
*/

// Include file setting page.
require_once( dirname( __FILE__ ) . '/wz-distributor-setting.php' );

// Include Post Type Distributor.
require_once( dirname( __FILE__ ) . '/wz-distributor-postype.php' );


// Add custom field to admin column
add_filter ( 'manage_wz_distributor_posts_columns', 'add_acf_columns', 10, 1 );
function add_acf_columns( $columns ) {
 	$column_id = array( 'distributor_id' => 'ID' );
    $columns = array_slice( $columns, 0, 2, true ) + $column_id + array_slice( $columns, 1, NULL, true );
    
    $column_thumbs = array( the_post_thumbnail() => 'Image Distributor' );
	$columns = array_slice( $columns, 0, 3, true ) + $column_thumbs + array_slice( $columns, 1, NULL, true );
	
	return $columns;
}


// Add data custom field to admin column
add_action ( 'manage_wz_distributor_posts_custom_column', 'exhibition_custom_column', 10, 2 );
function exhibition_custom_column ( $column, $post_id ) {
    switch ( $column ) {
      case 'distributor_id':
        echo get_post_meta ( $post_id, 'distributor_id', true );
        break;
      case the_post_thumbnail( array(100, 100)):
        echo get_post_meta ( $post_id, 'featured-thumbnail', true );
        break;
    }
}


// Remove Date in admin cloumn
add_action( 'admin_init' , 'my_column_init' );
function my_manage_columns( $columns ) {
    unset($columns['date']);
    return $columns;
}
add_action( 'admin_init' , 'my_column_init' );
function my_column_init() {
    add_filter( 'manage_wz_distributor_posts_columns' , 'my_manage_columns' );
}


/**
* Enqueue css and javascript for WZ Distributor.
* CSS for Distributor page.
* CSS Bootstrap 4
* Javascript for copy shortcode in admin page.
*/
add_action( 'wp_enqueue_scripts', 'wz_distributor_scripts' );
function wz_distributor_scripts() {
	if(!is_admin()) {
        wp_enqueue_style( 'wz-distributor-bootstrap', plugin_dir_url( __FILE__ ) . '/vendor/bootstrap-4/css/bootstrap-grid.min.css' , array() );
        wp_enqueue_style( 'wz-distributor', plugin_dir_url( __FILE__ ) . 'wz-distributor.css' , array() );
    }
}


//Enqueue javascript for settings on admin page.
add_action( 'admin_enqueue_scripts', 'wz_distributor_admin_scripts' );
function wz_distributor_admin_scripts() {
	if(is_admin()){
        wp_enqueue_style( 'wz-distributor', plugin_dir_url( __FILE__ ) . 'wz-distributor-admin.css' , array() );
        wp_enqueue_script( 'wz-distributor', plugin_dir_url( __FILE__ ) . 'wz-distributor-admin.js' , array('jquery'), '2018-1', true );
	}
}


// Function shortcode to add Distributor list grid
add_shortcode('wz-distributor', 'wz_distributor_shortcode');
function wz_distributor_shortcode( $atts) {?>

    <?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        // get all terms in the taxonomy
        $terms = get_terms( 'role_member' ); 
        // convert array of term objects to array of term IDs
        $term_ids = wp_list_pluck( $terms, 'term_id' );
        
        if ($atts !== '' ){
            $atts = shortcode_atts(
                array(
                    'category' => 'new-member',
                ), $atts, 'wz-distributor' );
    
            $atts = $atts['category'];

            $args = array(
                'post_type' => 'wz_distributor',
                'orderby' => 'rand',
                'posts_per_page' => -1,
                'paged' => $paged,
                'page' => $paged,
                'tax_query' => array(
                        array(
                            'taxonomy' => 'role_member',
                            'field' => 'slug',
                            'terms' => $atts,
                        ),
                    ),
            );
        }
        else {
            $args = array(
                'post_type' => 'wz_distributor',
                'orderby' => 'rand',
                'posts_per_page' => -1,
                'paged' => $paged,
                'page' => $paged,
                'tax_query' => array(
                        array(
                            'taxonomy' => 'role_member',
                            'field' => 'term_id',
                            'terms' => $term_ids,
                        ),
                    ),
            );
        }
        $distributor = new WP_Query($args);?>

    <?php if ($distributor -> have_posts() ): ?>
        <div class="container-fluid">
            <div class="row">
                <?php while($distributor->have_posts()) : $distributor->the_post(); ?>
                    <div class="col-lg-3 col-md-4 col-6 align-items-center justify-content-between text-center wz-col">
                        <?php if(has_post_thumbnail()) { 
                           the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
                        } 
                        else 
                            { echo '<img class="img-fluid rounded mx-auto d-block wz-img" src="'.plugin_dir_url( __FILE__ ) .'/img/wz-not-img.png" alt="'. get_the_title() .'" />'; }
                        ?>
                        <h6 class="wz-name"><?php the_title(); ?></h6>
                        <h6 class="wz-id"><?php the_field('distributor_id'); ?></h6>
                        <ul>
                            <li><a href="<?php the_field('line'); ?>"><img class="wz-social" src="<?php echo plugin_dir_url( __FILE__ ) ?>/img/icon256.png" alt="Line"></a></li>
                            <li><a href="<?php the_field('instragram'); ?>"><img class="wz-social" src="<?php echo plugin_dir_url( __FILE__ ) ?>/img/inst.png" alt="Instragran"></a></li>
                            <li><a href="<?php the_field('facebook'); ?>"><img class="wz-social" src="<?php echo plugin_dir_url( __FILE__ ) ?>/img/icon-facebook.png" alt="Facebook"></a></li>
                            <li><a href="<?php the_field('website'); ?>"><img class="wz-social" src="<?php echo plugin_dir_url( __FILE__ ) ?>/img/web.png" alt="Website"></a></li>
                        </ul>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <!--?php
        if (function_exists(custom_pagination)) {
            custom_pagination($distributor->max_num_pages,"",$paged);
        }
    ?-->
    <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <p>You not have member</p>
	<?php endif ; 
} ?>
<?php


// Update plugin function
require_once( dirname( __FILE__ ) . '/vendor/update/wp_autoupdate.php' );
function snb_activate_au()
	{
		// set auto-update params
		$plugin_current_version = '1.0.0';
		$plugin_remote_path     = 'https://center.walnutztudio.com/plugin-update/wz-distributor/update.php';
		$plugin_slug            = plugin_basename(__FILE__);
		$license_user           = '<optional license username>';
		$license_key            = '<optional license key>';

		// only perform Auto-Update call if a license_user and license_key is given
		if ( $license_user && $license_key && $plugin_remote_path )
		{
			new wp_autoupdate ($plugin_current_version, $plugin_remote_path, $plugin_slug, $license_user, $license_key);
		}
	}
add_action('init', 'snb_activate_au');


if(!class_exists('WZ_Distributor')) {
	class WZ_Distributor {
		/* Construct the plugin object */
		public function __construct() {
			/* register actions */
		}

		/* Activate the plugin */
		public static function activate() {
			/* Add Default Distributor page. */
			$page = get_page_by_path('distributor');
			if (!is_object($page)) {
				global $user_ID;
				$page = array(
					'post_type'      => 'page',
					'post_name'      => 'distributor',
					'post_parent'    => 0,
					'post_author'    => $user_ID,
					'post_status'    => 'publish',
					'post_title'     => __('Distributor', 'wz-distributor'),
					'post_content'   => '[wz-distributor]',
					'ping_status'    => 'closed',
					'comment_status' => 'closed',
				);
				$page_id = wp_insert_post($page);
			} else {
				$page_id = $page->ID;
			}
		} /* END public static function activate */

		/* Deactivate the plugin */     
		public static function deactivate()
		{

		} /* END public static function deactivate */
	} /* END class WZ_Distributor */
} /* END if(!class_exists('WZ_Distributor')) */

if(class_exists('WZ_Distributor')) {
	register_activation_hook(__FILE__, array('WZ_Distributor', 'activate'));
	register_deactivation_hook(__FILE__, array('WZ_Distributor', 'deactivate'));
	$WZ_Distributor = new WZ_Distributor();
}
?>