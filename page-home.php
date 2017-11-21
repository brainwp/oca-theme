<?php
/**
 * Template Name: Modelo Home
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header( 'home' ); ?>

		<div id="primary">
			<div id="content" role="main">

				<div id="slider-home">
				<?php if(function_exists("insert_post_highlights")) insert_post_highlights(); ?>
                </div><!-- #slider-home -->

				<?php query_posts('pagename=quem-somos'); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php  $content = get_the_content();
				echo limit_words($content,120); ?>...<br />
                <a class="leia-mais-home" href="<?php the_permalink(); ?>">Leia mais>></a>
				<?php endwhile; endif; wp_reset_query(); ?>
                
                <div class="hack-clear"></div>
                
				<?php
				$id_cultura_brasileira = id_por_slug('cultura-brasileira');
				$id_cultura_infantil = id_por_slug('cultura-infantil');
				$id_centro_formacao = id_por_slug('centro-de-formacao');
				$id_indumentaria_figurino = id_por_slug('indumentaria-e-figurino');
				?>

                <div class="box-home">
                <p>Cultura Brasileira</p>
				<div class="thumb-box-home">
				<a class="a-thumb-box-home" href="<?php home_url( '/' ); ?>cultura-brasileira">
				<?php echo get_the_post_thumbnail($id_cultura_brasileira, array(225,225)); ?>
				</a>
				</div>
                </div><!-- .box-home -->
                
                <div class="box-home">
                <p>Cultura Infantil</p>
				<div class="thumb-box-home">
				<a class="a-thumb-box-home" href="<?php home_url( '/' ); ?>cultura-infantil">
				<?php echo get_the_post_thumbnail($id_cultura_infantil, array(225,225)); ?>
				</a>
				</div>
                </div><!-- .box-home -->
                
                <div class="box-home">
                <p>Centro de Forma&ccedil;&atilde;o</p>
				<div class="thumb-box-home">
				<a class="a-thumb-box-home" href="<?php home_url( '/' ); ?>centro-de-formacao">
				<?php echo get_the_post_thumbnail($id_centro_formacao, array(225,225)); ?>
				</a>
				</div>
                </div><!-- .box-home -->
                
                <div class="box-home box-home-final">
                <p>Indument&aacute;ria e Figurino</p>
				<div class="thumb-box-home">
				<a class="a-thumb-box-home" href="<?php home_url( '/' ); ?>indumentaria-e-figurino">
				<?php echo get_the_post_thumbnail($id_indumentaria_figurino, array(225,225)); ?>
				</a>
				</div>
                </div><!-- .box-home -->
                
                <div class="hack-clear"></div>
                
                <div id="esquerda-home">
                <h2>Hist&oacute;rico</h2>
                <?php query_posts( 'showposts=4' ); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<div class="cada">
                    
                    <div class="home-thumb">
                    <?php if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'thumb-home' );
						} else { ?>
						<?php thumb_default(); ?>
					<?php } ?>
                    </div><!-- .home-thumb -->

					<div class="direita-home-cada">
                        <div class="home-author">
                        <p>Por <?php the_author(); ?></p>
                        </div><!-- .home-author -->
                        
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
			"meta_key" => "agenda-event-date", // Change to the meta key you want to sort by
			"orderby" => "meta_value", // This stays as 'meta_value' or 'meta_value_num' (str sorting or numeric sorting)
			"order" => "DESC"
			);
	$loop = new WP_Query( $args );
	while ( $loop->have_posts() ) : $loop->the_post();
	
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
    <a href="<?php home_url( '/' ); ?>agenda">Veja toda a Agenda>></a>
    </div><!-- .toda-agenda -->
    
    </div><!-- #agenda-home -->
    
    <div id="botoes-home">
        <div id="botao-premios">
        <a class="a-botao-premios" href="<?php home_url( '/' ); ?>premios">
        <h3>Pr&ecirc;mios OCA</h3>
        <p>Veja as premia&ccedil;&otilde;es que a OCA conquistou no decorrer dos anos.</p>
        </a>
        </div><!-- #botao-premios -->
    
        <div id="botao-certificados">
		<a class="a-botao-certificados" href="<?php home_url( '/' ); ?>certificados">
		<h3>Certificados OCA</h3>
        <p>Conhe&ccedil;a nossos certificados.</p>
        </a>
		</div><!-- #botao-certificados -->    
    </div><!-- #botoes-home -->
    
                </div><!-- #direita-home -->
                
			</div><!-- #content -->
		</div><!-- #primary -->
        
        <div class="hack-clear"></div>

<?php get_footer( 'home' ); ?>
