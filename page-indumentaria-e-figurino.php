<?php
/**
 * Template Name: Indumentaria e Figurino
 */

get_header( 'nucleos' ); ?>

		<div id="primary">
        
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <h2><?php the_title(); ?></h2>
                    </header><!-- .entry-header -->
                
                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
                    </div><!-- .entry-content -->
                    
                    <footer class="entry-meta">
                        <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                    </footer><!-- .entry-meta -->
                </article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

	</div><!-- #main -->
    </div><!-- #page -->
    
    <div id="segundo-content">
    
    <div id="page" class="sub-page">

<div id="esquerda-home">
                <h2>Hist&oacute;rico</h2>
				<?php $cat_indumentaria_figurino = get_category_by_slug('indumentaria-e-figurino');
				$cat_indumentaria_figurino = $cat_indumentaria_figurino->term_id; ?>
                <?php query_posts( 'showposts=4&cat='.$cat_indumentaria_figurino.'' ); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div class="cada">
                    
                    <div class="home-thumb">

					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'thumb-home' );
						} else { ?>
						<?php thumb_default(); ?>
					<?php } ?>                    

                    </div><!-- .home-thumb -->

					<div class="direita-home-cada">
                       
                        <div class="home-title">
                        <h1><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
                        </div><!-- .home-title -->
                        
                        <div class="home-summary">
                            <?php the_excerpt('Read on...'); ?>
                        </div><!-- .home-summary -->
                    </div><!-- .direita-home-cada -->
                    </div><!-- .cada -->

				<?php endwhile; ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>
                </div><!-- #esquerda-home -->
                
                <div id="direita-home">
                <div id="agenda-home">
                <h2>Agenda</h2>
                <!-- Inicio Loop --> 		
<?php
	$args = array(
			'post_type' => 'agenda',
			'posts_per_page' => '4', /* Quantidade de Posts a exibir */
			'taxonomy' => 'cat_agenda',
			'term' => 'indumentaria-e-figurino',
			'caller_get_posts'=> 1,
			"meta_key" => "agenda-event-date", // Change to the meta key you want to sort by
			"orderby" => "meta_value", // This stays as 'meta_value' or 'meta_value_num' (str sorting or numeric sorting)
			"order" => "DESC"
			);
	$loop = query_posts( $args );
	while ( have_posts() ) : the_post();
	
	global $post;
		//Pega a data escolhida no admin e grava em $ag_data, $ag_inicio...
		$ag_data = get_post_meta($post->ID,'agenda-event-date',TRUE);
		$ag_hora_inic = get_post_meta( $post->ID, 'agenda_horario_inic', true);
		$ag_local = get_post_meta( $post->ID, 'agenda_local', true);
		
		// Seta a data atual - 1 dia
		$datahoje = date('Y/m/d');
		$dataexpira = strtotime( $datahoje );
		
		// Transforma a $ag_data em tempo
		$ag_data_time = strtotime( $ag_data );

		$data_invertida = $ag_data;
		/* Quebra a Data em 3 */
		$data_explode = explode("/", $data_invertida);
		$mes = $data_explode[1];
	
		switch ($mes){
			case 1: $mes="Janeiro"; break;
			case 2: $mes="Fevereiro"; break;
			case 3: $mes="Março"; break;
			case 4: $mes="Abril"; break;
			case 5: $mes="Maio"; break;
			case 6: $mes="Junho"; break;
			case 7: $mes="Julho"; break;
			case 8: $mes="Agosto"; break;
			case 9: $mes="Setembro"; break;
			case 10: $mes="Outubro"; break;
			case 11: $mes="Novembro"; break;
			case 12: $mes="Dezembro"; break;
			default: $mes="Valor invalido"; 
		}
?>

   	<div class="evento-agenda">					
    
	<?php
	// Condição: Se a data do evento for maior ou igual que a data de expiração, exibe normalmente!
    if ( $ag_data_time >= $dataexpira ) { ?>
	    <div class="cada cada-agenda">
    <?php } ?>
    
   	<?php
	// Condição: Se a data do evento for menor que a data de expiração, exibe alterado!
    if ( $ag_data_time < $dataexpira ) { ?>
    	<div class="cada cada-agenda passado">
    <?php } ?>
    
        <div class="esquerda-evento-agenda">
            <div class="dia-agenda"><a href="<?php the_permalink(); ?>"><?php echo $data_explode[2]; ?></a></div>
            <div class="mes-agenda"><a href="<?php the_permalink(); ?>"><?php echo $mes; ?></a></div>
            <div class="hora-agenda"><a href="<?php the_permalink(); ?>"><?php echo $ag_hora_inic; ?></a></div>
        </div><!-- .esquerda-evento-agenda -->
        
        <div class="direita-evento-agenda">
            <div class="titulo-agenda"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
            <div class="local-agenda"><a href="<?php the_permalink(); ?>"><?php echo $ag_local; ?></a></div>
            <div class="mais-agenda"><a href="<?php the_permalink() ?>">Veja mais>></a></div>
        </div><!-- .direita-evento-agenda -->
    </div><!-- .cada -->

	</div><!-- #evento-agenda -->

	<?php endwhile; ?>
	<!-- Loop -->
    
	<div class="toda-agenda">
    <a href="<?php home_url( '/' ); ?>agenda">Veja toda agenda>></a>
    </div><!-- .toda-agenda -->
    
    </div><!-- #agenda-home -->
    
	<div id="botoes-home">
        <div id="botao-atividades">
        <?php
		$grade = get_theme_mod ('url_field_grade');
		?>
        <a class="a-botao-atividades" href="<?php echo $grade; ?>" target="_blank">
        <h3>Atividades</h3>
        <p>Clique para fazer o download.</p>
        </a>
        </div><!-- #botao-atividades -->
    </div><!-- #botoes-home -->
    
                </div><!-- #direita-home -->
                
                <div class="hack-clear"></div>
                
                </div><!-- #page -->
    
<?php get_footer( 'nucleos' ); ?>