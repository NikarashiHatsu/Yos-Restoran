<?php
/**
 *    Filemanager PHP connector
 *  This file should at least declare auth() function
 *  and instantiate the Filemanager as '$fm'
 *
 *  IMPORTANT : by default Read and Write access is granted to everyone
 *  Copy/paste this file to 'user.config.php' file to implement your own auth() function
 *  to grant access to wanted users only
 *
 *    filemanager.php
 *    use for ckeditor filemanager
 *
 *    @license    MIT License
 *  @author        Simon Georget <simon (at) linea21 (dot) com>
 *    @copyright    Authors
 */

ob_start();
include '../../../../../../../index.php';
ob_end_clean();
$CI = &get_instance();
$CI->load->driver('session');
$session = @$_SESSION['logged_in_kominfo'];
if ($session == true) {
    $codeigniterAuth = true;
} else {
    $codeigniterAuth = false;
}
/**
 *    Check if user is authorized
 *
 *
 *    @return boolean true if access granted, false if no access
 */
function auth()
{
    return $GLOBALS['codeigniterAuth'];
}

$fm = new Filemanager();
