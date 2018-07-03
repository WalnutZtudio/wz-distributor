<?php
/*
Plugin Name: WZ Distributor
Plugin URI: https://walnutztudio.com
Description: Create list Distributor contact page for wordpress, with shortcode.
Version: 1.0
Author: WalnutZtudio
Author URI: https://walnutztudio.com
License: GPL2
Text Domain: wz-distributor
*/

/*
Copyright 2018 WalnutZtudio  (email : walnutztudio@gmail.com)
*/

/* Include file setting page. */
require_once( dirname( __FILE__ ) . '/wz-distributor-setting.php' );
/* Add Post Type: Distributors. */
function cptui_register_my_cpts() {
	$labels = array(
		"name" => __( "Distributors"),
		"singular_name" => __( "Distributor"),
		"menu_name" => __( "Distributor"),
		"all_items" => __( "All Distributors"),
		"add_new" => __( "Add Distributor"),
		"add_new_item" => __( "Add New Distributor"),
		"edit_item" => __( "Edit"),
		"new_item" => __( "New Distributor"),
		"view_item" => __( "View"),
		"view_items" => __( "View"),
		"search_items" => __( "Search Distributors"),
		"not_found" => __( "No Distributor found"),
		"not_found_in_trash" => __( "No Distributor found in trash"),
		"featured_image" => __( "Featured image for Distributor"),
		"set_featured_image" => __( "Set featured image for Distributor"),
		"remove_featured_image" => __( "Remove featured image for Distributor"),
		"use_featured_image" => __( "Use featured image for Distributor"),
		"archives" => __( "Distributor archives"),
		"insert_into_item" => __( "Insert into Distributor"),
		"uploaded_to_this_item" => __( "Uploaded to Distributor"),
		"filter_items_list" => __( "Filter Distributor list"),
		"items_list_navigation" => __( "Distributor list navigation"),
		"items_list" => __( "Distributor list"),
		"attributes" => __( "Distributor Attributes"),
	);
	$args = array(
		"label" => __( "Distributors"),
		"labels" => $labels,
		"description" => "Create list Distributor contact page for wordpress.",
		"public" => true,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => false,
		"rest_base" => "",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => true,
		"rewrite" => array( "slug" => "wz_distributor", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 26,
		"menu_icon" => "dashicons-businessman",
		"supports" => array( "title", "thumbnail" ),
	);
	register_post_type( "wz_distributor", $args );
}
add_action( 'init', 'cptui_register_my_cpts' );


/* Add Taxonomy: Role for Distributor 
function cptui_register_my_taxes() {
	$labels = array(
		"name" => __( "Role"),
		"singular_name" => __( "Role"),
		"menu_name" => __( "Role"),
		"all_items" => __( "All Role"),
		"edit_item" => __( "Edit Role"),
		"view_item" => __( "View Role"),
		"update_item" => __( "Update Role"),
		"add_new_item" => __( "Add New Role"),
		"new_item_name" => __( "New Role"),
		"parent_item" => __( "Parent Role"),
		"parent_item_colon" => __( "Parent Role"),
		"search_items" => __( "Search Role"),
		"popular_items" => __( "Popular Role"),
		"add_or_remove_items" => __( "Add or Remove Role"),
		"not_found" => __( "No role found"),
		"no_terms" => __( "No role"),
		"items_list_navigation" => __( "Role list navigation"),
		"items_list" => __( "Role list"),
	);
	$args = array(
		"label" => __( "Role"),
		"labels" => $labels,
		"public" => true,
		"hierarchical" => true,
		"label" => "Role",
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'role_member', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => false,
		"rest_base" => "role_member",
		"show_in_quick_edit" => true,
	);
	register_taxonomy( "role_member", array( "wz_distributor" ), $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
*/


/* Add custom field to Distributor post type */
require_once( dirname( __FILE__ ) . '/vendor/advanced-custom-fields/acf.php');
define( 'ACF_LITE', true );
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_info-distributor',
		'title' => 'Info Distributor',
		'fields' => array (
			array (
				'key' => 'field_5b39e78c1a313',
				'label' => 'Distributor ID',
				'name' => 'distributor_id',
                'type' => 'text',
                'instructions' => '"insert for Distributor ID"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b39e8c71a315',
				'label' => 'Line',
				'name' => 'line',
				'type' => 'text',
				'instructions' => 'Sample link "https://line.me/R/ti/p/%40walnutztudio"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b39ebef1a316',
				'label' => 'Instragram',
				'name' => 'instragram',
				'type' => 'text',
				'instructions' => 'Sample link "https://www.instagram.com/walnutztudio/"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b39ec021a317',
				'label' => 'Facebook',
				'name' => 'facebook',
				'type' => 'text',
				'instructions' => 'Sample link "https://www.facebook.com/walnutztudio"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_5b39ec0c1a318',
				'label' => 'Website',
				'name' => 'website',
				'type' => 'text',
				'instructions' => 'Sample link "https://walnutztudio.com"',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'wz_distributor',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}

/*
 * Add custom field to admin column
 */
function add_acf_columns( $columns ) {
 	$column_id = array( 'distributor_id' => 'ID' );
    $columns = array_slice( $columns, 0, 2, true ) + $column_id + array_slice( $columns, 1, NULL, true );
    
    $column_thumbs = array( the_post_thumbnail() => 'Image Distributor' );
	$columns = array_slice( $columns, 0, 3, true ) + $column_thumbs + array_slice( $columns, 1, NULL, true );
	
	return $columns;
}
add_filter ( 'manage_wz_distributor_posts_columns', 'add_acf_columns', 10, 1 );

/*
 * Add data custom field to admin column
 */
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
add_action ( 'manage_wz_distributor_posts_custom_column', 'exhibition_custom_column', 10, 2 );

/*
 * Remove Date in admin cloumn
 */
function my_manage_columns( $columns ) {
    unset($columns['date']);
    return $columns;
}
function my_column_init() {
    add_filter( 'manage_wz_distributor_posts_columns' , 'my_manage_columns' );
}
add_action( 'admin_init' , 'my_column_init' );


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

/**
* Enqueue javascript for settings on admin page.
*/
add_action( 'admin_enqueue_scripts', 'wz_distributor_admin_scripts' );

function wz_distributor_admin_scripts() {
	if(is_admin()){
        wp_enqueue_style( 'wz-distributor', plugin_dir_url( __FILE__ ) . 'wz-distributor-admin.css' , array() );
        wp_enqueue_script( 'wz-distributor', plugin_dir_url( __FILE__ ) . 'wz-distributor-admin.js' , array('jquery'), '2018-1', true );
	}
}

// Function shortcode to add Distributor list grid
function wz_distributor_shortcode() {?>

    <?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $distributor = new WP_Query(array(
            'post_type' => 'wz_distributor',
            'orderby' => 'rand',
            'posts_per_page' => -1,
            'paged' => $paged,
            'page' => $paged,
            /*'tax_query' => array(
                    array(
                        'taxonomy' => 'role_member',
                        'field' => 'slug',
                        'terms' => '*'
                    ),
                ),*/
        )); ?>

    <?php if ($distributor -> have_posts() ): ?>
        <div class="container-fluid">
            <div class="row">
                <?php while($distributor->have_posts()) : $distributor->the_post(); ?>
                    <div class="col-lg-3 col-md-4 col-6 align-items-center justify-content-between text-center wz-col">
                        <?php if(has_post_thumbnail()) { 
                           the_post_thumbnail( 'full', array( 'alt' => get_the_title() ) );
                        } 
                        else 
                            { echo '<img class="img-fluid rounded mx-auto d-block wz-img" src="/wp-content/plugins/wz-distributor/img/wz-not-img.png" alt="'. get_the_title() .'" />'; }
                        ?>
                        <h6 class="wz-name"><?php the_title(); ?></h6>
                        <h6 class="wz-id"><?php the_field('distributor_id'); ?></h6>
                        <ul>
                            <li><a href="<?php the_field('line'); ?>"><img class="wz-social" src="/wp-content/plugins/wz-distributor/img/icon256.png" alt="Line"></a></li>
                            <li><a href="<?php the_field('instragram'); ?>"><img class="wz-social" src="/wp-content/plugins/wz-distributor/img/inst.png" alt="Instragran"></a></li>
                            <li><a href="<?php the_field('facebook'); ?>"><img class="wz-social" src="/wp-content/plugins/wz-distributor/img/icon-facebook.png" alt="Facebook"></a></li>
                            <li><a href="<?php the_field('website'); ?>"><img class="wz-social" src="/wp-content/plugins/wz-distributor/img/web.png" alt="Website"></a></li>
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
    <?php endif ; ?>
<?php }
add_shortcode('wz-distributor', 'wz_distributor_shortcode');

?>