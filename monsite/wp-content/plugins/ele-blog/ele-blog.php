<?php

/**
 * Ele Blog
 *
 * @package     ele-blog
 * @author      SolverWP
 * @copyright   2020 solverwp
 * @license     GPL-2.0-or-later
 *
 * Plugin Name: Eleblog - Elementor Blog And Magazine Addons
 * Plugin URI:  https://solverwp.com/
 * Description: Ele blog is an ultimate posts addon or element pack for the Elementor page builder. You can display the blog posts on the WordPress web site the way you want.
 * Version:     1.7
 * Author:      solverwp.com
 * Author URI:  https://1.envato.market/mgODEX
 * Text Domain: ele-blog
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */


if (!defined('ABSPATH')) {
  die;
}

if (function_exists('eleblog_dynamic_styles')) {
  return;
}


/*
 * Define Plugin Dir Path
 * @since 1.0.0
 * */
define('ELE_BLOG_ROOT_PATH', plugin_dir_path(__FILE__));
define('ELE_BLOG_ROOT_URL', plugin_dir_url(__FILE__));
define('ELE_BLOG_INC', ELE_BLOG_ROOT_PATH . '/inc');
define('ELE_BLOG_CSS', ELE_BLOG_ROOT_URL . 'assets/css');
define('ELE_BLOG_JS', ELE_BLOG_ROOT_URL . 'assets/js');
define('ELE_BLOG_ELEMENTOR', ELE_BLOG_ROOT_PATH . '/elementor');


/** Plugin version **/
define('ELE_BLOG_VERSION', '1.0.0');



/**
 * Load plugin textdomain.
 */
add_action('plugins_loaded', 'ele_blog_textdomain');
if (!function_exists('ele_blog_textdomain')) {

  function ele_blog_textdomain()
  {
    load_plugin_textdomain('ele-blog', false, plugin_basename(dirname(__FILE__)) . '/language');
  }
}


/*
 * require file
*/

if (file_exists(ELE_BLOG_INC . '/class-ele-blog-init.php')) {
  require_once ELE_BLOG_INC . '/class-ele-blog-init.php';
}

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'eleblog_pro_link');
function eleblog_pro_link($links)
{
  $links[] = '<a target="_blank" href="https://1.envato.market/ele-blog">Go Pro</a>';
  return $links;
}


function eleblog_quick_feedback_init()
{
  if (is_admin()) {
    $eleblog_feedback = new Eleblog_Quck_Feedback(
      __FILE__,
      'solverwp21@gmail.com',
      false,
      true
    );
  }
}
add_action('plugins_loaded', 'eleblog_quick_feedback_init');


register_activation_hook(__FILE__,  'eleblog_activation');


function eleblog_activation()
{
  update_option("eleblog_active_date", date('Y-m-d h:i:s'));
}


function swp_eleblog_notice()
{
  $user_id = get_current_user_id();
  if (!get_user_meta($user_id, 'swp_eleblog_notice_dismissed'))
    echo '<div class="notice-success notice"><h3><a target="_blank" style="text-decoration: none;line-height: 20px;color: #3c434a;font-size:13px" href="https://1.envato.market/vnq6Ky"  >Get access to 60+ million creative assets Like WordPress Themes/PLugins, Html/React,Vue Templates,Android Scripts, Graphics templates,Sound,After Effects And more only at <span style="font-size:15px;color:blue; text-decoration:underline">$16.50</span></a><a style="text-decoration:none;float:right" href="?swp_eleblog-dismissed"><span class="dashicons dashicons-no"></span></a></h3></div>';
}
add_action('admin_notices', 'swp_eleblog_notice');

function swp_eleblog_notice_dismissed()
{
  $user_id = get_current_user_id();
  if (isset($_GET['swp_eleblog-dismissed']))
    add_user_meta($user_id, 'swp_eleblog_notice_dismissed', 'true', true);
}
add_action('admin_init', 'swp_eleblog_notice_dismissed');
