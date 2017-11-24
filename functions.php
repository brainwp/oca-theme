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
 * Set the post excerpt length to 40 words.
 *
 * To override this length in a child theme, remove
 * the filter and add your own function tied to
 * the excerpt_length filter hook.
 *
 * @since Twenty Eleven 1.0
 *
 * @param int $length The number of excerpt characters.
 * @return int The filtered number of characters.
 */
function twentyeleven_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );

if ( ! function_exists( 'twentyeleven_continue_reading_link' ) ) :
/**
 * Return a "Continue Reading" link for excerpts
 *
 * @since Twenty Eleven 1.0
 *
 * @return string The "Continue Reading" HTML link.
 */
function twentyeleven_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) . '</a>';
}
endif; // twentyeleven_continue_reading_link

/**
 * Replace "[...]" in the Read More link with an ellipsis.
 *
 * The "[...]" is appended to automatically generated excerpts.
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Eleven 1.0
 *
 * @param string $more The Read More text.
 * @return The filtered Read More text.
 */
function twentyeleven_auto_excerpt_more( $more ) {
	if ( ! is_admin() ) {
		return ' &hellip;' . twentyeleven_continue_reading_link();
	}
	return $more;
}
add_filter( 'excerpt_more', 'twentyeleven_auto_excerpt_more' );

/**
 * Add a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Eleven 1.0
 *
 * @param string $output The "Continue Reading" link.
 * @return string The filtered "Continue Reading" link.
 */
function twentyeleven_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() && ! is_admin() ) {
		$output .= twentyeleven_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'twentyeleven_custom_excerpt_more' );


load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();

// Add default posts and comments RSS feed links to <head>.
add_theme_support( 'automatic-feed-links' );

// This theme uses wp_nav_menu() in one location.
register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );

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

// Remove notificações de update do WP para usuários abaixo do Administrador
global $user_login;
wp_get_current_user();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

// Personaliza o rodapé do admin
function custom_admin_footer_brasa() {
        echo 'Desenvolvido com <a href=http://wordpress.org/>WordPress</a> por <a href=http://www.brasa.art.br>Brasa Design e Tecnologia</a>.';
}
add_filter('admin_footer_text', 'custom_admin_footer_brasa');

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


if ( ! function_exists( 'twentyeleven_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable.
 *
 * @since Twenty Eleven 1.0
 *
 * @param string $html_id The HTML id attribute.
 */
function twentyeleven_content_nav( $html_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo esc_attr( $html_id ); ?>">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentyeleven' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></div>
		</nav><!-- #nav-above -->
	<?php endif;
}
endif; // twentyeleven_content_nav

if ( ! function_exists( 'twentyeleven_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own twentyeleven_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Twenty Eleven 1.0
 *
 * @param object $comment The comment object.
 * @param array  $args    An array of comment arguments. @see get_comment_reply_link()
 * @param int    $depth   The depth of the comment.
 */
function twentyeleven_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'twentyeleven' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 68;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 39;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'twentyeleven' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'twentyeleven' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentyeleven' ); ?></em>
					<br />
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'twentyeleven' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for twentyeleven_comment()

if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'twentyeleven' ), get_the_author() ) ),
		get_the_author()
	);
}
endif;

/**
 * Add two classes to the array of body classes.
 *
 * The first is if the site has only had one author with published posts.
 * The second is if a singular post being displayed
 *
 * @since Twenty Eleven 1.0
 *
 * @param array $classes Existing body classes.
 * @return array The filtered array of body classes.
 */
function twentyeleven_body_classes( $classes ) {

	if ( function_exists( 'is_multi_author' ) && ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_singular() && ! is_home() && ! is_page_template( 'showcase.php' ) && ! is_page_template( 'sidebar-page.php' ) )
		$classes[] = 'singular';

	return $classes;
}
add_filter( 'body_class', 'twentyeleven_body_classes' );


// Função para Pular carrinho e ir direto para Finalizar compra

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
