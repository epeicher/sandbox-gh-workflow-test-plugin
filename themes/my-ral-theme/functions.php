<?php
/**
 * Fetch and include the pattern content
 */
function vip_learn_get_pattern_content( $pattern ) {
    $pattern = basename($pattern); // Protects against directory traversal
    ob_start();
    include __DIR__ . "/patterns/{$pattern}";
    return ob_get_clean();
}


function vip_learn_register_custom_pattern() {
    register_block_pattern(
        'vip-learn/featured-product',
        array(
            'title'       => __( 'Featured Product', 'vip-custom-block' ),
            'description' => _x( 'A product showcase with image, description, and call-to-action button.', 'Block pattern description', 'my-theme' ),
            'content'     => vip_learn_get_pattern_content( 'featured-product.php' ),
            'categories'  => array( 'featured' ),
        )
    );
}

add_action( 'init', 'vip_learn_register_custom_pattern' );

add_action( 'init', 'vip_learn_register_book_post_type' );
function vip_learn_register_book_post_type(){
    $book_arguments = array(
        'labels'       => array(
            'name'          => 'Books',
            'singular_name' => 'Book',
            'menu_name'     => 'Books',
            'add_new'       => 'Add New Book',
            'add_new_item'  => 'Add New Book',
            'new_item'      => 'New Book',
            'edit_item'     => 'Edit Book',
            'view_item'     => 'View Book',
            'all_items'     => 'All Books',
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'rest_base'    => 'books',
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'template'     => array(
            array( 'core/group', array(
                'layout' => array(
                    'type' => 'constrained',
                ),
            ), array(
                array( 'core/columns', array(), array(
                    array( 'core/column', array(), array(
                        array( 'core/image', array(
                            'align' => 'right',
                        ) ),
                    ) ),
                    array( 'core/column', array(), array(
                        array( 'core/heading', array(
                            'placeholder' => 'Add Author...',
                        ) ),
                        array( 'core/paragraph', array(
                            'placeholder' => 'Add Description...',
                        ) ),
                    ) ),
                ) ),
            ) ),
        ) 
    );
    register_post_type( 'book', $book_arguments );
}

function add_debug_headers( $headers ) {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $headers['X-Debug-User'] = 'Logged in as ' . $current_user->user_login;
    } else {
        $headers['X-Debug-User'] = 'Not logged in';
    }
    return $headers;
}
add_filter( 'wp_headers', 'add_debug_headers' );