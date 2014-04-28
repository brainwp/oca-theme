<?php
/**
 * Adicionamos uma acção no inicio do carregamento do WordPress
 * através da função add_action( 'init' )
 */
add_action( 'init', 'create_post_type_projetos' );

/**
 * Esta é a função que é chamada pelo add_action()
 */
function create_post_type_projetos() {

    /**
     * Labels customizados para o tipo de post
     */
    $labels = array(
	    'name' => _x('Projetos', 'post type general name'),
	    'singular_name' => _x('Projeto', 'post type singular name'),
	    'add_new' => _x('Novo Projeto', 'projeto'),
	    'add_new_item' => __('Novo Projeto'),
	    'edit_item' => __('Editar Projeto'),
	    'new_item' => __('Novo Projeto'),
	    'all_items' => __('Todos Projetos'),
	    'view_item' => __('Ver Projeto'),
	    'search_items' => __('Procurar Projetos'),
	    'not_found' =>  __('Nenhum projetos encontrado'),
	    'not_found_in_trash' => __('Nenhum projeto encontrado no lixo'),
	    'parent_item_colon' => '',
	    'menu_name' => 'Projetos'
    );
    
    /**
     * Registamos o tipo de post projetos através desta função
     * passando-lhe os labels e parâmetros de controlo.
     */
    register_post_type( 'projetos', array(
	    'labels' => $labels,
	    'public' => true,
	    'publicly_queryable' => true,
	    'show_ui' => true,
	    /*'show_in_menu' => true,*/
	    /*'has_archive' => 'projetos',*/
	    'query_var' => true,
		'rewrite' => true,
	    'capability_type' => 'post',
	    'has_archive' => true,
	    'hierarchical' => false,
	    'menu_position' => null,
	    'supports' => array('title','editor','author','thumbnail','excerpt')
	    )
    );
	
	flush_rewrite_rules();

}

register_taxonomy(
	"projetos_category", 
		  "projetos", 
		  array(            
			"label" => "Categorias", 
				"singular_label" => "Categoria", 
				"rewrite" => true,
				"hierarchical" => true
	)
);

// Adiciona a coluna Categorias ao Custom Post Type Projetos
add_filter( 'manage_projetos_posts_columns', 'ilc_cpt_columns' );
add_action('manage_projetos_posts_custom_column', 'ilc_cpt_custom_column', 10, 2);

function ilc_cpt_columns($defaults) {
    $defaults['projetos_category'] = 'Categoria';
    return $defaults;
}

function ilc_cpt_custom_column($column_name, $post_id) {
    $taxonomy = $column_name;
    $post_type = get_post_type($post_id);
    $terms = get_the_terms($post_id, $taxonomy);
 
    if ( !empty($terms) ) {
        foreach ( $terms as $term )
            $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
        echo join( ', ', $post_terms );
    }
    else echo '<i>No terms.</i>';
}
