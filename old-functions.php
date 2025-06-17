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

/*  Sorting Products by Stock Status First, Then by Date by DILIP using Chatgpt updated on 18th Dec 2024*/
// add_filter('posts_clauses', 'sort_instock_products_first_then_by_date', 20, 2);

function sort_instock_products_first_then_by_date($clauses, $query)
{
  if (is_admin() || !$query->is_main_query()) {
    return $clauses; // Exit for admin or non-main queries
  }

  // Apply only on WooCommerce product archive pages
  if (is_shop() || is_product_category() || is_product_tag()) {
    global $wpdb;

    // Modify the ORDER BY clause to sort in-stock products first, then by date
    $clauses['orderby'] = "
            (CASE WHEN {$wpdb->postmeta}.meta_value = 'instock' THEN 1 ELSE 2 END) ASC,
            {$wpdb->posts}.post_date DESC
        ";

    // Join the stock status meta to the query
    $clauses['join'] .= " LEFT JOIN {$wpdb->postmeta} ON {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id AND {$wpdb->postmeta}.meta_key = '_stock_status'";
  }

  return $clauses;
}

/* Adding option to display 'order products by stock' added by DILIP@criatixinfotech.com */

add_filter('woocommerce_get_catalog_ordering_args', 'bbloomer_first_sort_by_stock_amount', 9999);

function bbloomer_first_sort_by_stock_amount($args)
{
  $args['orderby'] = 'meta_value';
  $args['meta_key'] = '_stock_status';
  return $args;
}
