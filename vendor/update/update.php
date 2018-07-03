<?php
/**
 * The remote host file to process update requests
 *
 */
if ( !isset( $_POST['action'] ) ) {
    echo '0';
	exit;
}

//set up the properties common to both requests
$obj = new stdClass();
$obj->slug = 'wz-distributor.php';
$obj->name = 'WZ Distributor';
$obj->plugin_name = 'wz-distributor.php';
$obj->new_version = '1.1.0';
// the url for the plugin homepage
$obj->url = 'https://walnutztudio.com';
//the download location for the plugin zip file (can be any internet host)
$obj->package = 'https://codeload.github.com/nuttaruj/wz-distributor/zip/master';

switch ( $_POST['action'] ) {

case 'version':
	echo serialize( $obj );
	break;
case 'info':
	$obj->requires = '4.0';
	$obj->tested = '4.9.6';
	$obj->downloaded = 12540;
	$obj->last_updated = '2018-03-07';
	$obj->sections = array(
		'description' => 'The new version of the Auto-Update plugin function',
		'another_section' => 'WalnutZtudio',
		'changelog' => 'Auto-Update plugin function'
	);
	$obj->download_link = $obj->package;
	echo serialize($obj);
case 'license':
	echo serialize( $obj );
	break;
}

?>
