<?php

// Adiciona a função the_excerpt às Páginas
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

// Função para imprimir o nome do menu
function echo_name_menu( $location ) {
    if( empty($location) ) return false;

    $locations = get_nav_menu_locations();
    if( ! isset( $locations[$location] ) ) return false;

    $menu_obj = get_term( $locations[$location], 'nav_menu' );

    return $menu_obj;
}

/**
* Função para Thumb-Default.
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
	$get_post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array(800,99999), false, '' );
	echo 'style="background: url('.$get_post_thumbnail[0].' ) center center"';
}

/**
* Minhas Opções
*/
require( get_stylesheet_directory() . '/opcoes/opcoes.php' );


// Remove notificações de update do WP para usuários abaixo do Administrador
global $user_login;
get_currentuserinfo();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

// Personaliza o rodapé do admin
function custom_admin_footer() {
        echo 'Desenvolvido com <a href=http://wordpress.org/>WordPress</a> por <a href=http://www.brasa.art.br>Brasa Design e Tecnologia</a>.';
}
add_filter('admin_footer_text', 'custom_admin_footer');

// Remove o Item Editar do menu Aparência
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



?>