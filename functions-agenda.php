<?php

// Adiciona uma nova coluna a listagem (WP-ADMIN) de Eventos da Agenda
	function nova_coluna_agenda ( $agenda_columns ) {
		$new_columns['cb'] = '<input type="checkbox" />';
		$new_columns['title'] = _x('Titulo', 'column name');
		$new_columns['source'] = __('Data do Evento');
		return $new_columns;
	}
	add_filter( 'manage_edit-agenda_columns', 'nova_coluna_agenda' );
// Fim


// Content da nova coluna de listagem (WP-ADMIN) de Eventos da Agenda
	function content_nova_coluna_agenda ( $column_name, $id ) {
		global $post;
		switch ($column_name) {
			case 'source':
				$data_invert = get_post_meta( $post->ID , 'agenda-event-date' , true );
				$data_explo = explode("/", $data_invert);
				echo
				'<span style="font-size:15px;">' .
				$data_explo[2]
				. "." .
				$data_explo[1]
				. "." .
				$data_explo[0]
				. '</span>';
				break;
			default:
				break;
		} // Fim switch
	}
	add_action( 'manage_agenda_posts_custom_column', 'content_nova_coluna_agenda', 10, 2 );
// Fim


// Ordena automaticamente os Eventos da Agenda de forma ascendente (ASC)
	function agenda_pre_get_posts( $query ) {
		if (is_admin()) {
	
			if (isset($query->query_vars['post_type'])) {
			   if ($query->query_vars['post_type'] == 'eventos') {
	
					$query->set('meta_key', 'agenda-event-date');
					$query->set('orderby', 'meta_value');
					$query->set('order', 'DESC');
				}
			}
		}
	}
	add_filter( 'pre_get_posts' , 'agenda_pre_get_posts' );
// Fim

/*
// Adiciona um filtro aos posts da Agenda
	function agenda_admin_posts_filter_restrict_manage_posts () {
		//only add filter to post type you want
		global $post;
		if ( $post->post_type=='agenda' ){
			$values = array(
				'Todos' => 'any',
				'Futuros' => 'publish',
				'Rascunhos' => 'draft',
				'Passado' => 'passado',
			);
			?>
			
			<label><span style="margin:0 5px 0 20px;">Mostrar Eventos:</span></label>
			<select name="filter_status_post">
			<option value=""><?php _e('Filtrar por: '); ?></option>
			<?php
				$current_v = isset($_GET['filter_status_post'])? $_GET['filter_status_post']:'';
				foreach ($values as $label => $value) {
					printf
						(
							'<option value="%s"%s>%s</option>',
							$value,
							$value == $current_v? ' selected="selected"':'',
							$label
						);
					}
			?>
			</select>
			<?php
		}
	}
	add_action( 'restrict_manage_posts', 'agenda_admin_posts_filter_restrict_manage_posts' );
	*/
	/*
	function agenda_posts_filter( $query ){
		global $post;
		if ( $post->post_type=='agenda' && is_admin() && isset($_GET['filter_status_post']) && $_GET['filter_status_post'] != '') {
			$query->query_vars['post_status'] = $_GET['filter_status_post'];
		}
	}
	add_filter( 'parse_query', 'agenda_posts_filter' );
// Fim*/

/*
// Filtra a lista (WP-ADMIN) de Eventos da Agenda para mostrar apenas os eventos futuros
	function agenda_filtro_futuros ( $query ) {
		if ( isset($query->query_vars['post_type']) ) {
			if ( $query->query_vars['post_type'] == 'agenda' ) {
				if ( !isset($_GET['post_status']) )
					$query->query_vars['post_status'] = 'publish';
			}
		}
	}
	
	add_action( 'parse_query', 'agenda_filtro_futuros' );
// Fim */


?>