<?php
/**
 * Child Theme Customizations for WordPress
 *
 * This file is typically located in your child theme's directory as functions.php.
 * It's crucial to wrap functions in `if ( !function_exists() )` to prevent fatal errors
 * if a function with the same name is defined elsewhere (e.g., in the parent theme or another plugin).
 *
 * Ensure WP_DEBUG and WP_DEBUG_LOG are enabled in wp-config.php during development
 * to catch any potential errors.
 *
 * define( 'WP_DEBUG', true );
 * define( 'WP_DEBUG_LOG', true );
 * define( 'WP_DEBUG_DISPLAY', false ); // Set to false to avoid displaying errors on the frontend
 */

// Exit if accessed directly. This prevents direct access to the file.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Conditionally loads a Right-to-Left (RTL) stylesheet.
 * This is a common function found in child themes.
 *
 * @param string $uri The URI of the stylesheet.
 * @return string The modified URI for the RTL stylesheet if applicable.
 */
if ( ! function_exists( 'chld_thm_cfg_locale_css' ) ) :
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) ) {
            $uri = get_template_directory_uri() . '/rtl.css';
        }
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

/**
 * Displays the site tagline (blog description) centered in a custom div.
 * Hooked to 'wp_body_open' with a HIGHER priority to appear *after* the custom header bar.
 */
if ( ! function_exists( 'show_site_tagline' ) ) :

    function show_site_tagline() {
        echo '<div class="site-tagline" style="text-align:center; font-size:14px; color:#428ACF !important;">' . esc_html(get_bloginfo('description')) . '</div>';
// //         echo '<div class="site-tagline">' . esc_html( get_bloginfo( 'description' ) ) . '</div>';
    }
endif;
// Priority 15 ensures it runs AFTER functions with default priority (10) or lower (like custom_amazon_style_header at 5)
add_action( 'wp_body_open', 'show_site_tagline', 15 ); 


if ( ! function_exists( 'custom_remove_product_tabs' ) ) :
    function custom_remove_product_tabs( $tabs ) {
        unset( $tabs['installation-grade'] ); // Example tab ID to remove
        return $tabs;
    }
endif;
add_filter( 'woocommerce_product_tabs', 'custom_remove_product_tabs', 98 ); // Priority 98 to run after most other additions

/**
 * Adds a custom Amazon-style header bar with contact info, search, and social icons.
 * This HTML is injected right after the <body> opening tag.
 * Hooked to 'wp_body_open' with a LOWER priority to appear *before* the tagline.
 */
if ( ! function_exists( 'custom_amazon_style_header' ) ) :
    function custom_amazon_style_header() {
        ?>
        <div class="custom-top-bar">
            <!-- WhatsApp Icon and Number (Left) -->
            <div class="custom-left-icons">
                <a href="tel:+971509014421" target="_blank" aria-label="Call us" class="phone-link">
                    <!-- Phone Icon SVG. Fill is set to currentColor in CSS. -->
                    <svg fill="#000000" height="24px" width="24px" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 473.806 473.806">
                        <path d="M374.456,293.506c-9.7-10.1-21.4-15.5-33.8-15.5c-12.3,0-24.1,5.3-34.2,15.4l-31.6,31.5c-2.6-1.4-5.2-2.7-7.7-4 c-3.6-1.8-7-3.5-9.9-5.3c-29.6-18.8-56.5-43.3-82.3-75c-12.5-15.8-20.9-29.1-27-42.6c8.2-7.5,15.8-15.3,23.2-22.8 c2.8-2.8,5.6-5.7,8.4-8.5c21-21,21-48.2,0-69.2l-27.3-27.3c-3.1-3.1-6.3-6.3-9.3-9.5c-6-6.2-12.3-12.6-18.8-18.6 c-9.7-9.6-21.3-14.7-33.5-14.7s-24,5.1-34,14.7c-0.1,0.1-0.1,0.1-0.2,0.2l-34,34.3c-12.8,12.8-20.1,28.4-21.7,46.5 c-2.4,29.2,6.2,56.4,12.8,74.2c16.2,43.7,40.4,84.2,76.5,127.6c43.8,52.3,96.5,93.6,156.7,122.7c23,10.9,53.7,23.8,88,26 c2.1,0.1,4.3,0.2,6.3,0.2c23.1,0,42.5-8.3,57.7-24.8c0.1-0.2,0.3-0.3,0.4-0.5c5.2-6.3,11.2-12,17.5-18.1c4.3-4.1,8.7-8.4,13-12.9 c9.9-10.3,15.1-22.3,15.1-34.6c0-12.4-5.3-24.3-15.4-34.3L374.456,293.506z M410.256,398.806 C410.156,398.806,410.156,398.906,410.256,398.806c-3.9,4.2-7.9,8-12.2,12.2c-6.5,6.2-13.1,12.7-19.3,20 c-10.1,10.8-22,15.9-37.6,15.9c-1.5,0-3.1,0-4.6-0.1c-29.7-1.9-57.3-13.5-78-23.4c-56.6-27.4-106.3-66.3-147.6-115.6 c-34.1-41.1-56.9-79.1-72-119.9c-9.3-24.9-12.7-44.3-11.2-62.6c1-11.7,5.5-21.4,13.8-29.7l34.1-34.1c4.9-4.6,10.1-7.1,15.2-7.1 c6.3,0,11.4,3.8,14.6,7c0.1,0.1,0.2,0.2,0.3,0.3c6.1,5.7,11.9,11.6,18,17.9c3.1,3.2,6.3,6.4,9.5,9.7l27.3,27.3 c10.6,10.6,10.6,20.4,0,31c-2.9,2.9-5.7,5.8-8.6,8.6c-8.4,8.6-16.4,16.6-25.1,24.4c-0.2,0.2-0.4,0.3-0.5,0.5 c-8.6,8.6-7,17-5.2,22.7c0.1,0.3,0.2,0.6,0.3,0.9c7.1,17.2,17.1,33.4,32.3,52.7l0.1,0.1c27.6,34,56.7,60.5,88.8,80.8 c4.1,2.6,8.3,4.7,12.3,6.7c3.6,1.8,7,3.5,9.9,5.3c0.4,0.2,0.8,0.5,1.2,0.7c3.4,1.7,6.6,2.5,9.9,2.5c8.3,0,13.5-5.2,15.2-6.9 l34.2-34.2c3.4-3.4,8.8-7.5,15.1-7.5c6.2,0,11.3,3.9,14.4,7.3c0.1,0.1,0.1,0.1,0.2,0.2l55.1,55.1 C420.456,377.706,420.456,388.206,410.256,398.806z"/>
                    </svg>
                    <span class="phone-number">+971509014421</span>
                </a>
            </div>

            <!-- Search Bar (Center) -->
			<div class="custom-search-bar flipkart-style-search">
					<?php echo do_shortcode('[fibosearch]'); ?>
				</div>

<!--             <div class="custom-search-bar">
                <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                    <input type="search" class="search-field" placeholder="Search products…" value="<?php echo esc_attr(get_search_query()); ?>" name="s" />
                    <button type="submit" value="Search" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" class="search-icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M10 2a8 8 0 105.292 14.292l4.853 4.853a1 1 0 001.414-1.414l-4.853-4.853A8 8 0 0010 2zm0 2a6 6 0 110 12A6 6 0 0110 4z"/>
                        </svg>
                    </button>
                    <input type="hidden" name="post_type" value="product" />
                </form>
            </div> -->

            <!-- Social Icons (Right) -->
            <div class="custom-social-icons">
                <!-- Facebook -->
                <a href="https://facebook.com" target="_blank" aria-label="Facebook">
                    <svg width="24" height="24" viewBox="0 0 320 512" fill="#1877F2" xmlns="http://www.w3.org/2000/svg">
                        <path d="M279.14 288l14.22-92.66h-88.91V134.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S293.08 0 268.13 0c-73.22 0-121 44.38-121 124.72v70.62H89.09V288h58.04v224h100.2V288z"/>
                    </svg>
                </a>

                <!-- Instagram -->
                <a href="https://instagram.com" target="_blank" aria-label="Instagram">
                    <svg width="24" height="24" viewBox="0 0 448 512" fill="#E4405F" xmlns="http://www.w3.org/2000/svg">
                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9S160.5 370.8 224.1 370.8 339 319.5 339 255.9 287.7 141 224.1 141zm0 186c-39.4 0-71.1-31.7-71.1-71.1s31.7-71.1 71.1-71.1 71.1 31.7 71.1 71.1-31.7 71.1-71.1 71.1zm146.4-194.3c0 14.9-12 26.9-26.9 26.9s-26.9-12-26.9-26.9 12-26.9 26.9-26.9 26.9 12 26.9 26.9zm76.1 27.2c-1.7-35.3-9.9-66.6-36.2-92.9s-57.6-34.5-92.9-36.2C293.6 0 252.7 0 224.1 0s-69.5 0-93.4 1.8c-35.3 1.7-66.6 9.9-92.9 36.2S3.3 96.4 1.6 131.7C0 159.5 0 200.4 0 229s0 69.5 1.8 93.4c1.7 35.3 9.9 66.6 36.2 92.9s57.6 34.5 92.9 36.2c23.9 1.8 64.8 1.8 93.4 1.8s69.5 0 93.4-1.8c35.3-1.7 66.6-9.9 92.9-36.2s34.5-57.6 36.2-92.9c1.8-23.9 1.8-64.8 1.8-93.4s0-69.5-1.8-93.4zM398.8 388c-7.8 19.5-22.9 34.6-42.4 42.4-29.4 11.7-99.4 9-132.4 9s-103 2.6-132.4-9c-19.5-7.8-34.6-22.9-42.4-42.4-11.7-29.4-9-99.4-9-132.4s-2.6-103 9-132.4c7.8-19.5 22.9-34.6 42.4-42.4 29.4-11.7 99.4-9 132.4-9s103-2.6 132.4 9c19.5 7.8 34.6 22.9 42.4 42.4 11.7 29.4 9 99.4 9 132.4s2.7 103-9 132.4z"/>
                    </svg>
                </a>
                
                <!-- TikTok -->
                <a href="https://www.tiktok.com" target="_blank" aria-label="TikTok">
                    <svg viewBox="0 0 448 512" width="24" height="24" fill="#000000" xmlns="http://www.w3.org/2000/svg">
                        <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0h88a121.18,121.18,0,0,0,1.86,22.17A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/>
                    </svg>
                </a>
                
                <!-- YouTube -->
                <a href="https://youtube.com" target="_blank" aria-label="YouTube">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 576 512" fill="#FF0000">
                        <path d="M549.655 124.083c-6.281-23.65-24.791-42.292-48.132-48.639C456.243 64 288 64 288 64s-168.243 0-213.523 11.444c-23.341 6.347-41.851 24.99-48.132 48.639C16 168.933 16 256.004 16 256.004s0 87.069 10.345 131.921c6.281 23.649 24.791 42.292 48.132 48.639C119.757 448.009 288 448.009 288 448.009s168.243 0 213.523-11.445c23.341-6.347 41.851-24.99 48.132-48.639C560 343.073 560 256.004 560 256.004s0-87.071-10.345-131.921zM232 338.004V174.004l142 82.001-142 82z"/>
                    </svg>
                </a>
            </div>
        </div>
        <?php
    }
endif;
add_action( 'wp_body_open', 'custom_amazon_style_header', 5 );


function child_theme_reorder_woocommerce_tabs() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Wait for WooCommerce tabs to load
        setTimeout(function() {
            const tabsWrapper = document.querySelector('.wc-tabs-wrapper');
            const tabsList = document.querySelector('.wc-tabs');
            const tabPanels = document.querySelectorAll('.woocommerce-Tabs-panel');
            
            if (tabsList && tabPanels.length >= 3) {
                // Reorder tabs in the navigation
                const descriptionTab = tabsList.querySelector('.description_tab');
                const specificationsTab = tabsList.querySelector('.specifications_tab_tab');
                const reviewsTab = tabsList.querySelector('.reviews_tab');
                
                // Clear existing tabs
                tabsList.innerHTML = '';
                
                // Append in new order
                tabsList.appendChild(descriptionTab);
                tabsList.appendChild(specificationsTab);
                tabsList.appendChild(reviewsTab);
                
                // Update active classes
                descriptionTab.classList.add('active');
                specificationsTab.classList.remove('active');
                reviewsTab.classList.remove('active');
                
                // Reorder tab panels
                const panelsContainer = tabsWrapper.querySelector('.woocommerce-Tabs-panel:first-child').parentNode;
                
                // Get panels in current order
                const descriptionPanel = document.getElementById('tab-description');
                const specificationsPanel = document.getElementById('tab-specifications_tab');
                const reviewsPanel = document.getElementById('tab-reviews');
                
                // Remove all panels
                while (panelsContainer.firstChild) {
                    panelsContainer.removeChild(panelsContainer.firstChild);
                }
                
                // Append in new order
                panelsContainer.appendChild(descriptionPanel);
                panelsContainer.appendChild(specificationsPanel);
                panelsContainer.appendChild(reviewsPanel);
                
                // Update display
                descriptionPanel.style.display = 'block';
                specificationsPanel.style.display = 'none';
                reviewsPanel.style.display = 'none';
                
                // Update click handlers
                tabsList.querySelectorAll('a').forEach(tab => {
                    tab.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        // Remove active classes
                        tabsList.querySelectorAll('li').forEach(li => li.classList.remove('active'));
                        
                        // Add active class to clicked tab
                        this.parentNode.classList.add('active');
                        
                        // Hide all panels
                        tabPanels.forEach(panel => {
                            panel.style.display = 'none';
                        });
                        
                        // Show selected panel
                        const target = this.getAttribute('href');
                        document.querySelector(target).style.display = 'block';
                    });
                });
            }
        }, 500); // Delay to ensure WooCommerce tabs are loaded
    });
    </script>
    <?php
}
add_action('wp_footer', 'child_theme_reorder_woocommerce_tabs');

// add_filter('posts_where', 'include_specifications_in_search', 10, 2);
// function include_specifications_in_search($where, $wp_query) {
//     global $wpdb;

//     // Only modify product search on front-end
//     if (is_admin() || !$wp_query->is_main_query() || !$wp_query->is_search()) {
//         return $where;
//     }

//     // Only run for product search
//     if (isset($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === 'product') {
//         $search_term = esc_sql($wp_query->get('s'));

//         if ($search_term) {
//             // Search in post title, content, and our ACF field
//             $where .= $wpdb->prepare(
//                 " OR EXISTS (
//                     SELECT 1 FROM {$wpdb->postmeta}
//                     WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
//                     AND {$wpdb->postmeta}.meta_key = 'product_specifications'
//                     AND {$wpdb->postmeta}.meta_value LIKE %s
//                 )", '%' . $wpdb->esc_like($search_term) . '%'
//             );
//         }
//     }

//     return $where;
// }

// Include ACF product_specifications in WooCommerce product search
add_filter('posts_where', 'include_specifications_in_search', 10, 2);
function include_specifications_in_search($where, $wp_query) {
    global $wpdb;

    // Only modify search on frontend main query
    if (is_admin() || !$wp_query->is_main_query() || !$wp_query->is_search()) {
        return $where;
    }

    // Only run for product post type
    if (isset($wp_query->query_vars['post_type']) && $wp_query->query_vars['post_type'] === 'product') {
        $search_term = $wp_query->get('s');
        if (!empty($search_term)) {
            $escaped = '%' . $wpdb->esc_like($search_term) . '%';

            $where .= $wpdb->prepare(
                " OR EXISTS (
                    SELECT 1 FROM {$wpdb->postmeta}
                    WHERE {$wpdb->postmeta}.post_id = {$wpdb->posts}.ID
                    AND {$wpdb->postmeta}.meta_key = 'product_specifications'
                    AND {$wpdb->postmeta}.meta_value LIKE %s
                )", $escaped
            );
        }
    }

    return $where;
}



// 1. Hide review form for non-logged-in users
add_action('wp_head', 'custom_hide_review_form_for_guests');
function custom_hide_review_form_for_guests() {
    if (!is_product() || is_user_logged_in()) return;
    ?>
    <style>
        #review_form_wrapper { display: none !important; }
        .custom-login-to-review {
            display: block;
            padding: 20px;
            margin: 20px 0;
            background: #f8f8f8;
            border: 1px solid #ddd;
            text-align: center;
            border-radius: 5px;
        }
        .custom-login-to-review a {
            color: #0073aa;
            font-weight: 600;
            text-decoration: underline;
        }
    </style>
    <?php
}



// 2. Show login prompt where form would be
add_filter('woocommerce_product_review_form_args', 'custom_replace_review_form_with_login');
function custom_replace_review_form_with_login($args) {
    if (is_user_logged_in()) return $args;

    $args['comment_field'] = '<div class="custom-login-to-review">' . 
        __('Please <a href="#" class="wostify-show-login-popup">login or register</a> to leave a review.', 'wostify') . 
        '</div>';
    return $args;
}

// 3. Trigger Wostify login popup on click
add_action('wp_footer', 'custom_review_login_popup_script');
function custom_review_login_popup_script() {
    if (!is_product() || is_user_logged_in()) return;
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.wostify-show-login-popup').forEach(function (el) {
            el.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector('.wostify-login-popup')?.classList.add('active');
                document.querySelector('.wostify-popup-overlay')?.classList.add('active');

                setTimeout(() => {
                    document.querySelector('.wostify-login-popup input[name="username"]')?.focus();
                }, 300);
            });
        });
    });
    </script>
    <?php
}

// for the verify product 
 

add_action('woocommerce_after_shop_loop_item_title', 'add_marotix_tags_badges', 8);
add_action('woocommerce_single_product_summary', 'add_marotix_tags_badges', 6);

function add_marotix_tags_badges() {
    echo '<div class="marotix-tags">';
    echo '<span class="marotix-badge authentic">✔ Authentic</span>';
    echo '<span class="marotix-badge verified">✔ Marotix Verified</span>';
    echo '</div>';
}








// Fix pagination: make sure total results count includes specifications matches
add_filter('found_posts', 'fix_product_search_found_posts_for_specifications', 10, 2);
function fix_product_search_found_posts_for_specifications($found_posts, $query) {
    global $wpdb;

    if (
        is_admin() ||
        !$query->is_main_query() ||
        !$query->is_search() ||
        $query->get('post_type') !== 'product'
    ) {
        return $found_posts;
    }

    $search_term = $query->get('s');
    if (empty($search_term)) {
        return $found_posts;
    }

    $like = '%' . $wpdb->esc_like($search_term) . '%';

    // Count how many published products match in specifications
    $count = $wpdb->get_var($wpdb->prepare("
        SELECT COUNT(DISTINCT p.ID)
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
        WHERE p.post_type = 'product'
          AND p.post_status = 'publish'
          AND pm.meta_key = 'product_specifications'
          AND pm.meta_value LIKE %s
    ", $like));

    // Return total found posts (original + matched in ACF)
    return intval($found_posts) + intval($count);
}


if ( ! function_exists( 'get_custom_featured_products' ) ) :
    function get_custom_featured_products() {
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => 10, // Number of featured products to retrieve
            'meta_query'     => array(
                array(
                    'key'     => 'is_featured_product',
                    'value'   => '1',
                    'compare' => '='
                )
            ),
            'orderby'        => 'meta_value_num', // Order by the numeric value of meta_key
            'meta_key'       => 'internal_tag_number', // The meta key used for ordering
            'order'          => 'ASC', // Ascending order
            'suppress_filters' => true, // Good practice for custom WP_Query to avoid interference from other plugins
        );

        $query = new WP_Query( $args );

        if ( $query->have_posts() ) {
            echo '<ul class="featured-products">'; // Removed inline styles
            while ( $query->have_posts() ) {
                $query->the_post();
                global $product; // Access the global WooCommerce product object if needed for other product functions
                echo '<li>'; // Removed inline styles
                echo '<a href="' . esc_url( get_the_permalink() ) . '">' . esc_html( get_the_title() ) . '</a>'; // Removed inline styles
                echo '</li>';
            }
            echo '</ul>';
            wp_reset_postdata(); // Restore original post data
        } else {
            echo '<p>No featured products found.</p>'; // Removed inline styles
        }
    }

endif;


/* form.woocommerce-ordering {
    height: 40px!important;
} */

@media screen and (min-width: 1200px) {
  .custom-search-bar {
    width: 50%;
  }
}


/* Ensure price & meta info is always visible */
.product-loop-wrapper .product-loop-meta {
    height: auto !important;
}

/* Style the price clearly */
.product-loop-meta .price {
    font-weight: 600;
}

/* Unified button styles */
.loop-add-to-cart-btn,
.buy-now-button,
.wpcbn-btn-archive {
    display: inline-block !important;
    margin: 5px 5px 0 0;
    padding: 8px 14px;
    font-size: 14px;
    font-weight: 500;
    border-radius: 4px;
    text-align: center;
}
/* Hide Wishlist button in product grid */
.tinvwl-loop-button-wrapper {
    display: none !important;
}




/* Zoom Container */
.product-images-container {
  position: relative;
  overflow: hidden;
}

/* Zoomed Image Effect */
.product-images-container .image-item img {
  transition: transform 0.3s ease;
  transform-origin: center center;
}

/* Zoom on Hover */
.product-images-container:hover .image-item img {
  transform: scale(1.3); /* Adjust to your zoom level */
  cursor: zoom-in;
}

/* Prevent layout shift */
.product-images-container .image-item {
  overflow: hidden;
  position: relative;
}








/* product */
.marotix-tags {
    margin-top: 6px;
}

.marotix-badge.authentic {
    border-color: #28a745;
    color: #28a745;
}
.marotix-badge.verified {
    color: #007bff;
}


/* Reduce top spacing on WooCommerce Cart page */
body.woocommerce-cart .site-content {
    padding-top: 0px !important;
    margin-top: 0px !important;
}

/* Optional: If using Elementor or page builder spacing */
body.woocommerce-cart .elementor-section {
    padding-top: 0px !important;
    margin-top: 0px !important;
}


/* pagination */
.pagination, .woocommerce-pagination {
     margin-top: 0 !important
}

/* space  */
.elementor-element.elementor-element-b77b17a.e-flex.e-con-boxed.e-con.e-parent.e-lazyloaded {
    top: -65px;
}

/* button of product details page */

.wpcbn-btn-single {
	background-color: #fb641b !important;
	color: #fff !important;
	border: none;
}

.wpcbn-btn-single:hover {
	background-color: #d35400 !important;
}

.woocommerce div.product .cart .quantity,.variations_button .button {
    width: 25%;
    display: block;
    margin-bottom: 15px;
}


/* login popup */

img.xoo-el-head-img {
	height: 125px;
}

.xoo-el-form-container ul.xoo-el-tabs li.xoo-el-active {
    background-color: #428ACF;
    color: #fff;
}

@media only screen and (max-width: 768px) {
  h5.elementor-heading-title.elementor-size-default {
    font-size: 16px;
  }
}


.specifications-grid {
    display: grid;
    grid-template-columns: 200px 1fr;
    gap: 12px 20px;
    line-height: 1.6;
}

.spec-label {
    font-weight: 600;
}



/* Cart Fix */
.spg-product {
    position: relative;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.spg-product > p {
    flex: 1 0 auto; 
    min-height: 40px;
    margin-bottom: 15px;
}

.price-wrapper {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 0 15px 15px; 
}

.add-to-cart {
    margin-top: 10px;
}

/* Override for .price-wrapper */

.price-wrapper {
    position: static; 
    margin-bottom: 10px; 
    min-height: auto;    
}

.price-wrapper .price {
    opacity: 1 !important; 
    transition: none;   
}

.price-wrapper .add-to-cart {
    position: static;  
    top: auto;      
    left: auto;    
    right: auto;   
	  opacity: 1 !important; 

}


/*	Header  */

header#masthead {
    margin-top: -22px;
}

.tools-icon.my-account {
    display: none;
}

/*  Cart Page */

.woocommerce .woocommerce-cart-form {
    display: flex; /* Use flexbox for main layout */
    flex-wrap: wrap;
    gap: 20px;
}


.woocommerce .woocommerce-cart-form .shop_table.woocommerce-cart-form__contents {
    flex: 2; /* Takes more space */
    min-width: 60%; /* Ensure it's not too squished on smaller screens */
    background-color: #fff;
    border: 1px solid #ddd; /* Subtle border */
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    margin-bottom: 0;
}

.woocommerce-cart-form__contents thead {
    display: none; /* Amazon doesn't have a visible table header for cart items */
}

.woocommerce-cart-form__contents tbody tr {
    display: flex; /* Make each row a flex container */
    flex-wrap: wrap; /* Allow items to wrap */
    align-items: center;
    border-bottom: 1px solid #eee; /* Separator between items */
    padding: 15px 0;
    position: relative; /* For remove button positioning */
}

.woocommerce-cart-form__contents .product-remove a.remove {
    font-size: 24px;
    line-height: 1;
    color: #c00; 
    text-decoration: none;
    background: none;
    padding: 0;
    position: absolute;
    top: 5px;
    right: 5px;
    z-index: 10;
}


.woocommerce-cart-form__contents .product-thumbnail {
    order: 2; 
    width: 100px; 
    padding-right: 15px;
}
.woocommerce-cart-form__contents .product-thumbnail img {
    max-width: 100px;
    height: auto;
    border-radius: 4px;
}

.woocommerce-cart-form__contents .product-name {
    order: 3;
    flex-grow: 1;
    min-width: 150px; 
    font-weight: bold;
    font-size: 1.1em;
}
.woocommerce-cart-form__contents .product-name a {
    color: #007185;
    text-decoration: none;
}


.woocommerce-cart-form__contents .product-price,
.woocommerce-cart-form__contents .product-subtotal {
    order: 5; 
    min-width: 100px; 
    text-align: right;
    font-weight: bold;
    color: #B12704; 
    font-size: 1.1em;
}
.woocommerce-cart-form__contents .product-price {
    order: 4; 
    min-width: 80px;
    text-align: left;
    padding-left: 0;
}
.woocommerce-cart-form__contents .product-subtotal {
    order: 6;
    width: 120px;
    font-size: 1.2em;
}

.woocommerce-cart-form__contents .product-quantity {
    order: 5; 
    width: 120px;
}

.woocommerce-cart-form__contents .quantity .product-qty {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f2f2;
    cursor: pointer;
    transition: background-color 0.2s ease;
}
.woocommerce-cart-form__contents .quantity .product-qty[data-qty="plus"] {
    border-right: none;
}
.woocommerce-cart-form__contents .quantity .product-qty:hover {
    background-color: #e0e2e2;
}
.woocommerce-cart-form__contents .quantity .woostify-svg-icon svg {
    width: 14px; /* Adjust SVG icon size */
    height: 14px;
    fill: #333;
}

.woocommerce-cart-form__contents .actions {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #eee;
    width: 100%; 
}

.woocommerce-cart-form__contents .coupon {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}
.woocommerce-cart-form__contents .coupon .input-text {
    flex-grow: 1;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 10px;
}
.woocommerce-cart-form__contents .coupon .button {
    color: #111;
    border-radius: 4px;
    padding: 8px 15px;
    cursor: pointer;
}

.woocommerce-cart-form__contents .button[name="update_cart"] {
    border: 1px solid #a88734;
    border-radius: 4px;
    padding: 8px 15px;
    cursor: pointer;
}
.woocommerce-cart-form__contents .button[name="update_cart"]:hover {
    background-color: black;
    border-color: #9c7e31;
}
.woocommerce-cart-form__contents .button[name="update_cart"]:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    background-color: #ccc;
    border-color: #aaa;
}

.woocommerce .cart_totals h2 {
    font-size: 1.5em;
    font-weight: bold;
    margin-bottom: 15px;
    text-align: left; /* Ensure heading aligns left */
    border-bottom: 1px solid #eee;
    padding-bottom: 10px;
}

.woocommerce .cart_totals table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse; /* Remove space between cells */
}

.woocommerce .cart_totals table tr {
    border-bottom: 1px solid #eee;
}
.woocommerce .cart_totals table tr:last-child {
    border-bottom: none;
}

.woocommerce .cart_totals table th,
.woocommerce .cart_totals table td {
    padding: 10px 0;
    text-align: left; /* Align text left */
    vertical-align: top;
    border: none; /* Remove default table cell borders */
}

.woocommerce .cart_totals table th {
    font-weight: normal;
    color: #555;
}

.woocommerce .cart_totals table .woocommerce-Price-amount {
    font-weight: bold;
    color: #B12704; /* Amazon price color */
}

.woocommerce .cart_totals .order-total th,
.woocommerce .cart_totals .order-total td {
    font-size: 1.2em; /* Larger total */
    font-weight: bold;
    padding-top: 15px;
    color: #111; /* Stronger color for total */
}
.woocommerce .cart_totals .order-total td {
    text-align: right;
}


/* --- Shipping Calculator --- */
.woocommerce .shipping-calculator-button {
    color: #007185;
    text-decoration: none;
    font-weight: normal;
    margin-top: 10px;
    display: inline-block;
}
.woocommerce .shipping-calculator-button:hover {
    text-decoration: underline;
    color: #c7511f;
}

.woocommerce .shipping-calculator-form {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 15px;
    margin-top: 10px;
    background-color: #fcfcfc;
}
.woocommerce .shipping-calculator-form p {
    margin-bottom: 10px;
}
.woocommerce .shipping-calculator-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 0.9em;
}

.wc-proceed-to-checkout .checkout-button {
    color: white;
    font-size: 1.2em;
    font-weight: bold;
    padding: 12px 20px;
    border-radius: 8px;
    display: inline-block;
    width: 100%;
    box-sizing: border-box;
    text-align: center;
    text-decoration: none;
    line-height: 1.5; 
}

/* Second Design */

/* .woocommerce-cart-form__contents .product-remove {
  position: absolute;
  top: 10px;
  right: 10px;
  margin: 0;
  z-index: 10;
}

.woocommerce-cart-form__contents .product-remove a.remove {
  font-size: 22px;
  color: #c00;
  text-decoration: none;
  background: none;
  display: inline-block;
  transition: color 0.3s ease;
}

.woocommerce-cart-form__contents .product-remove a.remove:hover {
  color: #a00;
} */




	
/* header#masthead {
    position: sticky;
    top: 0;
    z-index: 99;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.site-tagline {
    font-size: 14px;
    color: #428ACF !important;
    z-index: 100;
    position: relative;
} */

/* header#masthead {
  position: sticky;
  top: 0;
  background-color: #fff;
  z-index: 1000;
  margin-top: -22px;
  border-bottom: 1px solid #ddd;
} */

/* header#masthead {
		margin-top: -26px;
    position: sticky;
    top: 0px;
    z-index: 100;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
} */

/* form.woocommerce-ordering {
    height: 40px!important;
} */


/* product bar */
select.orderby {
    height: 39px;
}

/* update button hide */
.woocommerce .actions .button[name="update_cart"] {
    display: none !important;
}


/* Aditional inform */
li#tab-title-additional_information {
    display: none;
}

/* Whatsapp	 */
.chaty-channels {
    right: 29px;
}
@media screen and (max-width: 768px) {
  .chaty-channels {
		right: -19px;
    top: -32px;
  }
}


/* Main Container Styles */
.elementor-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
    color: #333;
}

/* Progress Tabs */
.wpmc-tabs-wrapper {
    margin-bottom: 30px;
}

.wpmc-tabs-list {
    display: flex;
    justify-content: space-between;
    list-style: none;
    padding: 0;
    margin: 0;
}

.wpmc-tab-item {
    flex: 1;
    text-align: center;
    position: relative;
    padding: 15px 5px;
    background: #f8f8f8;
    color: #777;
    font-weight: 500;
    transition: all 0.3s ease;
}

.wpmc-tab-item.current {
    background: #4a6cf7;
    color: white;
}

.wpmc-tab-item:not(:last-child):after {
    content: '';
    position: absolute;
    right: -15px;
    top: 0;
    width: 0;
    height: 0;
    border-top: 25px solid transparent;
    border-bottom: 25px solid transparent;
    border-left: 15px solid #f8f8f8;
    z-index: 1;
    transition: all 0.3s ease;
}

.wpmc-tab-item.current:not(:last-child):after {
    border-left-color: #4a6cf7;
}

.wpmc-tab-number {
    display: inline-block;
    width: 25px;
    height: 25px;
    line-height: 25px;
    border-radius: 50%;
    background: #ddd;
    color: #777;
    margin-right: 8px;
}

.wpmc-tab-item.current .wpmc-tab-number {
    background: white;
    color: #4a6cf7;
}

/* Form Sections */
.wpmc-step-item {
    background: white;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
    margin-bottom: 20px;
}

/* Form Input Styles */
.woocommerce form .form-row {
    margin-bottom: 20px;
}

.woocommerce form .form-row label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
}

.woocommerce form .form-row input.input-text,
.woocommerce form .form-row textarea,
.woocommerce form .form-row select {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 15px;
    transition: border-color 0.3s;
}

.woocommerce form .form-row input.input-text:focus,
.woocommerce form .form-row textarea:focus,
.woocommerce form .form-row select:focus {
    border-color: #4a6cf7;
    outline: none;
    box-shadow: 0 0 0 2px rgba(74, 108, 247, 0.2);
}

/* Button Styles */
.button, 
button, 
input[type="button"], 
input[type="submit"] {
    background: #4a6cf7;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 4px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s;
}

.button:hover, 
button:hover, 
input[type="button"]:hover, 
input[type="submit"]:hover {
    background: #3a5ce4;
    transform: translateY(-2px);
}

.wpmc-nav-button {
    margin: 0 10px;
}

/* Order Review Table */
.woocommerce-checkout-review-order-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.woocommerce-checkout-review-order-table th,
.woocommerce-checkout-review-order-table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
    text-align: left;
}

.woocommerce-checkout-review-order-table th {
    font-weight: 500;
    color: #555;
}

.woocommerce-checkout-review-order-table .order-total th,
.woocommerce-checkout-review-order-table .order-total td {
    font-weight: bold;
    color: #333;
    border-top: 2px solid #eee;
}

/* Payment Methods */
.wc_payment_methods {
    list-style: none;
    padding: 0;
}

.wc_payment_method {
    margin-bottom: 15px;
    padding: 15px;
    border: 1px solid #eee;
    border-radius: 4px;
}

.wc_payment_method label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: 500;
}

.wc_payment_method input {
    margin-right: 10px;
}

.payment_box {
    padding: 15px;
    background: #f9f9f9;
    border-radius: 4px;
    margin-top: 10px;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .wpmc-tabs-list {
        flex-direction: column;
    }
    
    .wpmc-tab-item {
        margin-bottom: 5px;
    }
    
    .wpmc-tab-item:not(:last-child):after {
        display: none;
    }
    
    .wpmc-nav-wrapper {
        display: flex;
        flex-direction: column;
    }
    
    .wpmc-nav-wrapper button {
        margin-bottom: 10px;
        width: 100%;
    }
}

/* Login/Signup Tabs */
.xoo-el-tabs {
    display: flex;
    border-bottom: 1px solid #ddd;
    margin-bottom: 20px;
}

.xoo-el-tabs li {
    padding: 10px 20px;
    cursor: pointer;
    font-weight: 500;
}

.xoo-el-tabs li.xoo-el-active {
    color: #4a6cf7;
    border-bottom: 2px solid #4a6cf7;
}

/* Form Icons */
.xoo-aff-input-group {
    position: relative;
}

.xoo-aff-input-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: #777;
}

.xoo-aff-input-group input {
    padding-left: 40px !important;
}

/* Coupon Section */
/* .woocommerce-info {
    background: #f8f8f8;
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.woocommerce-info a {
    color: #4a6cf7;
    text-decoration: underline;
} */

/* pagination */
.pagination ul .page-numbers:not(.prev):not(.next), .woocommerce-pagination ul .page-numbers:not(.prev):not(.next){
			height:45px;
			border-radius:3px	
}			






/*
Theme Name: Woostify Child
Theme URI: https://woostify.com
Template: woostify
Author: Woostify
Author URI: https://woostify.com/about
Description: Woostify is fast, lightweight, responsive and super flexible WooCommerce theme built with SEO, speed, and usability in mind. The theme works great with any of your favorite page builder likes Elementor, Beaver Builder, SiteOrigin, Thrive Architect, Divi, etc. Therefore, you can build any type of websites like shop, business agencies, corporate, portfolio, education, university portal, consulting, church, restaurant, medical and so on. Woostify is compatible with all well-coded plugins, including major ones like WooCommerce, OrbitFox, Yoast, BuddyPress, bbPress, etc. Learn more about the theme and ready to import demo sites at https://woostify.com
Tags: e-commerce,two-columns,left-sidebar,right-sidebar,custom-background,custom-colors,custom-header,custom-menu,featured-images,full-width-template,threaded-comments,rtl-language-support,footer-widgets,sticky-post,theme-options
Version: 2.4.2.1750217502
Updated: 2025-06-18 07:31:42

*/


.custom-top-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    padding: 5px 20px;
    border-bottom: 1px solid #ddd;
    height: 60px; /* Reduced height to 25% of typical header height */
    box-sizing: border-box;
}

.custom-left-icons,
.custom-social-icons {
    display: flex;
    align-items: center;
    gap: 5px;
}

.phone-link {
    display: flex;
    align-items: center;
	gap: 10px;
}
/*     text-decoration: none; */
/*     padding: 8px 12px; */
/*     border: 1px solid #ddd; */
/*     border-radius: 8px; */
/*     transition: background-color 0.3s ease, transform 0.2s ease; */
}

/* .phone-link:hover {
    background-color: #f0f0f0;
    transform: scale(1.03);
} */

.phone-link svg {
    width: 24px;
    height: 24px;
    fill: #000; /* Black icon */
}

.phone-number {
    color: #333;
    font-weight: 600;
    font-size: 16px;
}


/* .custom-search-bar {
    flex: 1;
    display: flex;
    justify-content: center;
    margin: 0 20px;
}

.custom-search-bar form {
    display: flex;
    align-items: center;
    width: 100%;
    max-width: 600px;
    height: 40px;
}

.custom-search-bar input[type="search"] {
    height: 100%;
    background-color: white;
    flex: 1;
    padding: 0 15px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px 0 0 4px;
    color: #333;
}

.custom-search-bar button[type="submit"] {
    height: 100%;
    width: 48px;
    background-color: white;
    border: 1px solid #ccc;
    border-left: none;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.custom-search-bar button:hover {
    background-color: #f2f2f2;
}

.custom-search-bar svg.search-icon {
    width: 20px;
    height: 20px;
    fill: #333;
}

.custom-search-bar input[type="submit"]:hover {
    background-color: #f2f2f2;
} */

.custom-social-icons a {
    display: flex;
    align-items: center;
    height: 100%;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .custom-top-bar {
        height: auto;
        padding: 10px;
        flex-direction: column;
        align-items: stretch;
    }
    
    .custom-left-icons,
    .custom-social-icons {
        justify-content: center;
        padding: 5px 0;
    }
    
    .custom-search-bar {
        margin: 10px 0;
        order: 3;
        width: 100%;
    }
    
    .custom-left-icons {
        order: 1;
    }
    
    .custom-social-icons {
        order: 2;
    }
}

@media (min-width: 769px) and (max-width: 1024px) {
    .custom-top-bar {
        padding: 5px 10px;
    }
    
    .custom-left-icons,
    .custom-social-icons {
        flex: 0 0 auto;
    }
    
    .custom-search-bar {
        margin: 0 10px;
    }
}

/* Default styles for larger screens (e.g., your laptop) */ 

.site-tagline {
    font-size: 19px !important;
    margin-left: -670px; 
    position: relative;
    top: 42px;
	color:#428ACF !important;
	cursor:pointer;
}

/* --- Hide on tablets and smaller --- */
 @media (max-width: 1024px) {
    .site-tagline {
    font-size: 19px !important;
    margin-left: -550px; 
    position: relative;
    top: 42px;
	color:#428ACF!important;
	cursor:pointer;
    }
}
@media (max-width: 768px) {
    .site-tagline {
        display: none !important;
    }
}
 