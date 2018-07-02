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

/* Add Post Type Distributor */
function cptui_register_my_cpts() {
	/**
	 * Post Type: Distributors.
	 */
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
		"publicly_queryable" => true,
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


/* Add Taxonomy Role for Distributor */
function cptui_register_my_taxes() {
	/**
	 * Taxonomy: Role.
	 */
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


/* Add custom field */
require_once( dirname( __FILE__ ) . '/vendor/advanced-custom-fields/acf.php');
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


/**
* Enqueue css for WZ-Distributor shortcode page.
* CSS for feel good.
* CSS Bootstrap 4
*/
add_action( 'wp_enqueue_scripts', 'wz_distributor_scripts' );
function wz_distributor_scripts() {
	if(!is_admin()) {
        wp_enqueue_style( 'wz-distributor-bootstrap', plugin_dir_url( __FILE__ ) . '/vendor/bootstrap-4/css/bootstrap-grid.min.css' , array() );
        wp_enqueue_style( 'wz-distributor', plugin_dir_url( __FILE__ ) . 'wz-distributor.css' , array() );
    }
}

// Function shortcode to add Distributor list grid
function wz_distributor_shortcode() {?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-6 align-items-center justify-content-between text-center wz-col">
                <img src="/wp-content/plugins/wz-distributor/img/wz-not-img.png" class="img-fluid rounded mx-auto d-block wz-img" alt="">
                <h6 class="wz-name">Medileen Skincare by Kade</h6>
                <h6 class="wz-id">EX013</h6>
                <ul>
                    <li>
                        <a href="">
                            <img class="wz-social" src="/wp-content/plugins/wz-distributor/img/icon256.png" alt="Line">
                        </a>        
                    </li>
                    <li>
                        <a href="">
                            <img class="wz-social" src="/wp-content/plugins/wz-distributor/img/inst.png" alt="Instragran">
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img class="wz-social" src="/wp-content/plugins/wz-distributor/img/icon-facebook.png" alt="Facebook">
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <img class="wz-social" src="/wp-content/plugins/wz-distributor/img/web.png" alt="Website">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

<?php }
add_shortcode('wz-distributor', 'wz_distributor_shortcode');

?>