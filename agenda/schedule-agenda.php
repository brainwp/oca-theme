<?php
/**
* Muda o status dos posts do CustomPostType 'Agenda'
* para Rascunho quando o evento for do dia anterior.
*/

if (!wp_next_scheduled('draft_agenda_hook')) {
	wp_schedule_event( time(), 'daily', 'draft_agenda_hook' );
}

wp_clear_scheduled_hook('draft_agenda_hook');

/**
* Avisa ao WordPress para executar o draft_agenda() quando
* o gancho draft_agenda_hook for executado.
*/

add_action( 'draft_agenda_hook', 'draft_agenda' ); 

/**
* Aqui é onde o status do post é atualizado para Rascunho
* no dia seguinte ao evento.
*/

function draft_agenda()
{
	$args = array(
	 'post_type' => 'agenda'
	);

	$query  = new WP_Query($args);

	if( $query ->have_posts() ) {
		while ($query->have_posts()) : $query->the_post();
			
			global $post;
				$date_now = date('d/m/Y');			
				$data_evento = get_post_meta($post->ID,'agenda-event-date',TRUE);
	
				$date_now = ltrim($date_now);
				$date_meta_box = ltrim($data_evento);
				
				$date_n = explode('/', $date_now);
				$date_mb = explode('/', $date_meta_box);
				
				$date_now = $date_n['2'].$date_n['1'].$date_n['0'];
				$date_meta_box = $date_mb['0'].$date_mb['1'].$date_mb['2'];

			if( $date_now > $date_meta_box ):			
				$draft_post = array();
				$draft_post['ID'] = get_the_ID();
				$draft_post['post_status'] = 'draft';

				// Atualiza o post no banco de dados
				$ID  = wp_update_post( $draft_post );

			else:
			endif;
		endwhile;
	} else {
	}	

	wp_reset_query();

}

draft_agenda();

// Adiciona cor aos posts marcados como Rascunho
add_action('admin_footer','posts_status_color');
function posts_status_color(){
	?>
	<style>
	.status-draft{background: #ffecec !important;}
	</style>
	<?php
}
?>