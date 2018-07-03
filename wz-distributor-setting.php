<?php
//Example from Codex page : http://codex.wordpress.org/Function_Reference/add_submenu_page

add_action('admin_menu', 'wz_register_distributor_setting_page');
function wz_register_distributor_setting_page() {
    $capabilities = 'manage_options';
	add_submenu_page(
		'edit.php?post_type=wz_distributor',
		__( 'Settings', 'wz-distributor' ),
		__( 'Settings', 'wz-distributor' ),
		$capabilities,
		'wz-distributor-setting',
		'wz_distributor_setting_page_callback'
	);
}

function wz_distributor_setting_page_callback() {
    /* Set default setting's tab */
    if(!isset($_GET['tab']) || $_GET['tab'] == '' || $_GET['tab'] == 'settings'){
        $nav_tab_active = 'settings';
    }elseif($_GET['tab'] == 'license'){
        $nav_tab_active = 'license';
    }else{
        $nav_tab_active = 'settings';
    }
    //$seed_confirm_optional = json_decode( get_option( 'seed_confirm_optional' ), true );
    ?>

    <div class="wrap">
        <form method="post" action="" name="form">
            <h2 class="nav-tab-wrapper wz-distributor-tab-wrapper">
                <a href="<?php echo admin_url('edit.php?post_type=wz_distributor&page=wz-distributor-setting&tab=settings'); ?>" class="nav-tab <?php if($nav_tab_active == 'settings') echo 'nav-tab-active'; ?>">
                    <?php _e( 'WZ Distributor Settings', 'wz-distributor' ); ?>
                </a>
                <!--a href="<?php echo admin_url('edit.php?post_type=wz_distributor&page=wz-distributor-setting&tab=license'); ?>" class="nav-tab <?php if($nav_tab_active == 'license') echo 'nav-tab-active'; ?>">
                    <?php _e( 'License', 'wz-distributor' ); ?>
                </a-->
            </h2>
            <?php if( isset($_SESSION['saved']) && $_SESSION['saved'] == 'true' ){ ?>
                <div class="updated inline">
                    <p>
                        <strong>
                            <?php _e('Your settings have been saved.', 'wz-distributor'); ?>
                        </strong>
                    </p>
                </div>
                <?php unset($_SESSION['saved']); ?>
            <?php } ?>

            <!-- Settings tab -->
            <?php if($nav_tab_active == 'settings'){?>
                <h2 class="title"><?php _e('WZ Distributor Option', 'wz-distributor'); ?></h2>  
                <table class="form-table" width="100%">
                    <tbody>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e('Shortcode', 'wz-distributor'); ?> 
                            </th>
                            <td>
                                <input type="text" value="[wz-distributor]" id="wz-shortcode">
                                <div class="wz-tooltip">
                                    <button onclick="myFunction()" onmouseout="outFunc()">
                                        <span class="wz-tooltiptext" id="wz-Tooltip"></span>
                                        <span class="dashicons dashicons-admin-page"></span>
                                    </button>
                                </div>
                                <p class="description" id="wz_distributor_pp_enable_description"><?php _e('Your can copy shortcode to insert in any page.', 'wz-distributor');?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php } ?>
            <!-- License tab -->
            <?php if($nav_tab_active == 'license'){ 
                $license = get_option( 'wz_distributor_license_key' );
                $status  = get_option( 'wz_distributor_license_status' );
            ?>
                <h2 class="title"><?php _e('License', 'wz-distributor');?></h2>

                <table class="form-table" width="100%">
                    <tbody>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e('License Key', 'wz-distributor'); ?>
                            </th>
                            <td>
                                <input id="wz_distributorlicense_key" name="wz_distributor_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
                                <label class="description" for="wz_distributor_license_key"><?php _e('Enter your license key', 'wz-distributor'); ?></label>
                            </td>
                        </tr>
                        <?php if( false !== $license ) { ?>
                        <tr valign="top">
                            <th scope="row" valign="top">
                                <?php _e('Activate License', 'wz-distributor'); ?>
                            </th>
                            <td>
                                <?php if( $status !== false && $status == 'valid' ) { ?>
                                <span style="color:green;"><?php _e('active', 'wz-distributor'); ?></span>
                                <input type="submit" class="button-secondary" name="wz_distributor_license_deactivate" value="<?php _e('Deactivate License', 'wz-distributor'); ?>"/>
                                <?php } else { ?>
                                <input type="submit" class="button-secondary" name="wz_distributor_license_activate" value="<?php _e('Activate License', 'wz-distributor'); ?>"/>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>          
            <?php } ?>
            <!-- Submit form -->
            <!--p class="submit">
                <?php wp_nonce_field( 'wz-distributor' ) ?>
                <?php submit_button(); ?>
            </p-->
        </form>
    </div>
    <?php
}
?>