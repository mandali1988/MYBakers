<?php



function my_theme_enqueue_styles()
{
  wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');



include 'dashboard-functions.php';
include 'dashboard-styles.php';
include 'admin-menu-functions.php';



// Redirect to the home page on logout - swm 01/02/2022 
add_action('wp_logout', 'auto_redirect_after_logout');
function auto_redirect_after_logout()
{
  wp_safe_redirect(home_url());
  exit();
}

/**
 * Make standard form fields to make read-only
 * To apply, add CSS class 'wpf-disable-field' (no quotes) to field in form builder
 *
 * @link https://wpforms.com/developers/disable-a-form-field-to-prevent-user-input/
 */

function wpf_dev_disable_field()
{
?>
  <script type="text/javascript">
    jQuery(function($) {

      $('.wpf-disable-field input, .wpf-disable-field textarea').attr({
        readonly: "readonly",
        tabindex: "-1"
      });

    });
  </script>
<?php
}
add_action('wpforms_wp_footer_end', 'wpf_dev_disable_field', 30); 

/* Adding option to display 'order products by stock' first & then by published date added by DILIP@criatixinfotech.com */

add_filter('woocommerce_get_catalog_ordering_args', 'bbloomer_first_sort_by_date_then_stock_status', 9999);
function bbloomer_first_sort_by_date_then_stock_status($args)
{
  // Order first by date (publish date) and then by stock status (in-stock first)
  $args['orderby'] = array(
	'meta_value' => 'ASC',    // First, order by stock status (in-stock first)
    'date' => 'DESC'        // Second, order by publish date in descending order (newest first)
  );
  // Set the meta_key to '_stock_status' to sort by the stock status
  $args['meta_key'] = '_stock_status';
  return $args;
}


