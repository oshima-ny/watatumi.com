<?php
/**
 * Lightning Child theme functions
 *
 * @package lightning
 */

/*----------フォントを追加----------*/
add_action('lightning_entry_body_before', 'custom_lightning_entry_body_before');

function custom_load_fonts() {
    $version = wp_get_theme( get_template() )->get( 'Version' );
    wp_enqueue_style( 'add_google_fonts_ZenKakuGothicNew', '////fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;700;900&display=swap', false, $version );
    wp_enqueue_style( 'add_google_fonts_Roboto', '////fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap', false, $version );
}
add_action( 'wp_footer', 'custom_load_fonts' );
add_action( 'admin_footer', 'custom_load_fonts' );

/*----------javascript読み込み----------*/
function my_enqueue_scripts() {
	wp_enqueue_script( 
		'primary-script', 
		get_stylesheet_directory_uri() . '/_js/script.js',
		array( 'jquery' )
	);
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts' );

/*----------サイトヘッダー固定しない----------*/
function my_lightning_global_nav_fix( $options ) {
	$options['header_scrool']            = false;
	return $options;
}
add_filter( 'lightning_localize_options', 'my_lightning_global_nav_fix', 11, 1 );

/*----------ページヘッダーを非表示にする----------*/
add_filter( 'lightning_is_page_header', function( $return ){
    return false;
} );

/*----------サイトヘッダーにメニューを追加----------*/
function my_lightning_site_header_logo_after() {
	wp_nav_menu(array(
        'menu'       => 'header-sub-menu',
        'container'  => false,
        'depth'      => 1,
        'items_wrap' => '<ul class="header-sub-menu">%3$s</ul>'
    ));
}
add_action( 'lightning_site_header_logo_after', 'my_lightning_site_header_logo_after' );

function my_lightning_get_class_names( $class ) {
    $class['site-header'][1] = 'site-header--layout--sub-active';
    $class['global-nav'][1]  = 'global-nav--layout--penetration';
    return $class;
}
add_filter( 'lightning_get_class_names', 'my_lightning_get_class_names' );

function my_lightning_site_header_append() {
	$page_obj = get_page_by_path('drop-sign-in');
	$page = get_post( $page_obj );

	echo "<div id='sign-in' class='drop-sign-in'>";
	echo $page->post_content;
	echo "</div>";
}
add_action( 'lightning_site_header_append', 'my_lightning_site_header_append' );

/*----------更新日を非表示----------*/
add_filter('lightning_get_entry_meta_options', function($options) {
    $options['updated'] = false;
    $options['author_name'] = false;
    $options['author_image'] = false;
    return $options;
});

/*----------次の記事・前の記事を非表示----------*/
add_filter('lightning_is_next_prev', 'custom_hide_next_prev', 10, 2);
function custom_hide_next_prev($is_next_prev, $context) {
    if (is_single() && $context === 'next_prev') {
        return false; // 次の記事と前の記事を非表示にする
    }
    return $is_next_prev;
}

/*----------カテゴリーを非表示----------*/
function custom_hide_categories($taxnomies_html) {
    if ( is_single() ) {
        return '';
    }
    return $taxnomies_html;
}
add_filter( 'lightning_taxnomiesHtml', 'custom_hide_categories' );

/*----------カテゴリーを上に再表示----------*/
function custom_lightning_entry_body_before() {
    $categories = get_the_category();

    if ($categories) {
        echo '<div class="custom-entry-meta-data-list">';
        
        foreach ($categories as $category) {
            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . '<i class="fa-solid fa-circle-chevron-right"></i>' .esc_html($category->name) . '</a> ';
        }

        echo '</div>';
    }
}

