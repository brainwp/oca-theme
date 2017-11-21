<?php

// Adiciona a fun��o the_excerpt �s P�ginas
add_post_type_support( 'page', 'excerpt' );

/**
* Adiciona limite aos excerpts
*
*/
function limit_words($string, $word_limit) {

	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character

	$words = explode(' ', $string);

	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character

	return implode(' ', array_slice($words, 0, $word_limit));
}

// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
add_theme_support( 'post-thumbnails' );

/**
* Adiciona um tamanho de imagem
*
*/
if ( function_exists( 'add_image_size' ) ) { 
    add_image_size( 'thumb-home', 400, 150, true );
	add_image_size( 'thumb-projetos', 300, 999999999 );
	add_image_size( 'thumb-nucleos-home', 225, 99999999);
	add_image_size( 'projetos', 300, 999999999 );
}

//Adiciona o CustomPostType Agenda
require_once ( get_stylesheet_directory() . '/agenda/requires-agenda.php' );
	
register_nav_menu( 'um', __( 'Primeiro Menu Rodape', 'twentyeleven' ) );
register_nav_menu( 'dois', __( 'Segundo Menu Rodape', 'twentyeleven' ) );
register_nav_menu( 'tres', __( 'Terceiro Menu Rodape', 'twentyeleven' ) );
register_nav_menu( 'quatro', __( 'Quarto Menu Rodape', 'twentyeleven' ) );
register_nav_menu( 'cinco', __( 'Quinto Menu Rodape', 'twentyeleven' ) );

register_nav_menu( 'nucleos', __( 'Menu Nucleos', 'twentyeleven' ) );
register_nav_menu( 'projetos', __( 'Menu Projetos', 'twentyeleven' ) );

// Fun��o para imprimir o nome do menu
function echo_name_menu( $location ) {
    if( empty($location) ) return false;

    $locations = get_nav_menu_locations();
    if( ! isset( $locations[$location] ) ) return false;

    $menu_obj = get_term( $locations[$location], 'nav_menu' );

    return $menu_obj;
}

/**
* Fun��o para Thumb-Default.
* Use thumb_default();
*/
function thumb_default() {
	$endereco_thumb_default = get_bloginfo( 'stylesheet_directory' ) . '/images/thumb-default.jpg';
	echo '<img src='.$endereco_thumb_default.' />';
}

function id_por_titulo( $titulo ) {
	$o_id = get_page_by_title( $titulo );
	$o_id = $o_id->ID;
	return $o_id; 
}

function id_por_slug( $slug ) {
    $page = get_page_by_path( $slug );
    if ( $page ) {
        return $page->ID;
    } else {
        return null;
    }
}

/**
* Adiciona o CPT Projetos
*
*/
require_once ( get_stylesheet_directory() . '/custom-projetos.php' );


/**
* Imprime o Thumbnail no background da DIV
*
*/
function thumbnail_bg () {
	$get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array(800,99999), false, '' );
	echo 'style="background: url('.$get_post_thumbnail[0].' ) center center"';
}


// Add Customizer panel for Contatos e Links
function oca_customizer_register( $wp_customize ) {


	$wp_customize->add_panel( 'panel_oca', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Contatos e Links', 'textdomain' ),
	    'description' => '',
	) );


	$wp_customize->add_section( 'section_contatos', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Contatos', 'textdomain' ),
	    'description' => '',
	    'panel' => 'panel_oca',
	) );

	$wp_customize->add_setting( 'text_field_endereco', array(
	'default'           => 'CNPJ: 04.069.395/0001-30 - Rua Xapuri, 600 - Pq. da Aldeia - Carapicuiba/SP 06343-020',
	'transport' => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'text_field_endereco', array(
	    'type' => 'text',
	    'section' => 'section_contatos',
	    'label' => __( 'Endere&ccedil;o', 'textdomain' ),
	    'description' => 'Adicione o endere&ccedil;o para o rodap&eacute;',
	) );

	$wp_customize->add_setting( 'text_field_tel', array(
	'default' => '(11) 4146-8719',
	'transport' => 'refresh',
	'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'text_field_tel', array(
	    'type' => 'text',
	    'section' => 'section_contatos',
	    'label' => __( 'Telefone', 'textdomain' ),
	    'description' => 'Adicione o telefone para o rodap&eacute;. Exemplo (11) 4444-4444',
	) );

	$wp_customize->add_section( 'section_links', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'Links', 'textdomain' ),
	    'description' => '',
	    'panel' => 'panel_oca',
	) );

	$wp_customize->add_setting( 'url_field_fb', array(
	'default' => '',
	'type' => 'theme_mod',
	'capability' => 'edit_theme_options',
	'transport' => '',
	'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_field_fb', array(
	    'type' => 'url',
	    'priority' => 10,
	    'section' => 'section_links',
	    'label' => __( 'Facebook', 'textdomain' ),
	    'description' => 'Adicione a url para o Facebook com http://',
	) );

	$wp_customize->add_setting( 'url_field_grade', array(
	'default' => '',
	'type' => 'theme_mod',
	'capability' => 'edit_theme_options',
	'transport' => '',
	'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_field_grade', array(
	    'type' => 'url',
	    'priority' => 10,
	    'section' => 'section_links',
	    'label' => __( 'Grade de Atividades', 'textdomain' ),
	    'description' => 'Adicione a URL para o .pdf da Grade de Atividades.',
	) );

}
add_action( 'customize_register', 'oca_customizer_register' );

// Remove notifica��es de update do WP para usu�rios abaixo do Administrador
global $user_login;
wp_get_current_user();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

// Personaliza o rodap� do admin
function custom_admin_footer() {
        echo 'Desenvolvido com <a href=http://wordpress.org/>WordPress</a> por <a href=http://www.brasa.art.br>Brasa Design e Tecnologia</a>.';
}
add_filter('admin_footer_text', 'custom_admin_footer');

// Remove o Item Editar do menu Apar�ncia
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}

add_action('_admin_menu', 'remove_editor_menu', 1);

// Remove o MetaBox Format dos Posts
add_action( 'admin_menu', 'remove_meta_boxes' );
function remove_meta_boxes() {
    remove_meta_box( 'formatdiv', 'post', 'normal' ); // Post format meta box
}

// Remove Widgets do Wp-Admin
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

// Fun��o para Pular carrinho e ir direto para Finalizar compra

include_once(ABSPATH .'wp-admin/includes/plugin.php');

function cart_redirect() { 
		if ( is_plugin_active('woocommerce/woocommerce.php') ) {
			if ( is_cart() ) {
				wp_redirect( WC()->cart->get_checkout_url() );
			}
		}
	}
add_action( 'get_header', 'cart_redirect', 9999 );

function my_custom_place_order_text( $text ) {
	if ( is_plugin_active('woocommerce/woocommerce.php') ) {
    	return 'Finalizar Apoio';
	}
}

add_filter( 'woocommerce_order_button_text', 'my_custom_place_order_text' );

?>
