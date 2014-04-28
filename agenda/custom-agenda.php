<?php



// CustomPostType Agenda
add_action('init', 'type_post_agenda');

// Labels
function type_post_agenda() {
$labels = array(
'name' => _x('Agenda', 'post type general name'),
'singular_name' => _x('Evento', 'post type singular name'),
'add_new' => _x('Novo Evento', 'Novo item'),
'add_new_item' => __('Novo Evento'),
'edit_item' => __('Editar Evento'),
'new_item' => __('Novo Evento'),
'view_item' => __('Ver Evento'),
'search_items' => __('Procurar Eventos'),
'not_found' => __('Nenhum registro encontrado'),
'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
'parent_item_colon' => '',
'menu_name' => 'Agenda'
);

$args = array(
'labels' => $labels,
'public' => true,
'public_queryable' => true,
'show_ui' => true, 
'query_var' => true,
'rewrite' => true,
'capability_type' => 'post',
'has_archive' => true,
'hierarchical' => false,
'menu_position' => null, 
'supports' => array('title','editor','thumbnail')
);

register_post_type( 'agenda' , $args );
flush_rewrite_rules();
}

// Adiciona Taxonomia
register_taxonomy(
'cat_agenda',
'agenda',
array( 
'label' => 'Adicionar Categorias ',
'singular_label' => 'Categoria',
'rewrite' => true,
'hierarchical' => true
)
);

// Fim CustomPostType Agenda
?>