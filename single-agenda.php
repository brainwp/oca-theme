<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

 <?php
//Pega o CPT
$post_type_obj = get_post_type_object('agenda');
//Pega o Título do CPT
$title_agenda = apply_filters('post_type_archive_title', $post_type_obj->labels->name );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-projetos' ); ?>>
	<header class="entry-header">
		<div class="title-com-voltar">
		<div id="voltar-agenda">
		<a href="<?php bloginfo( 'home' ); ?>/agenda">
		<h2 class="entry-title title-agenda"><?php echo $title_agenda; ?></h2>
		<p>Voltar para Agenda</p>
		</a>
		</div>
		</div>
	</header><!-- .entry-header -->
            
		<div class="entry-content">
                   
		<?php while ( have_posts() ) : the_post(); ?>
       <?php // Pega os dados e salva em variáveis
				$ag_data = get_post_meta($post->ID,'agenda-event-date',TRUE);
				$ag_inicio = get_post_meta($post->ID,'agenda_horario_inic',TRUE);
				$ag_termino = get_post_meta($post->ID,'agenda_horario_fim',TRUE);
				$ag_local = get_post_meta($post->ID,'agenda_local',TRUE);
				$ag_endereco = get_post_meta($post->ID,'agenda_endereco',TRUE);
				$ag_bairro = get_post_meta($post->ID,'agenda_bairro',TRUE);
				$ag_cidade = get_post_meta($post->ID,'agenda_cidade',TRUE);
				$ag_estado = get_post_meta($post->ID,'agenda_estado',TRUE);

				// Seta a data atual - 1 dia
				$ag_datahoje = date('Y/m/d');
				$ag_dataexpira = strtotime( $ag_datahoje );

				// Transforma a $ag_data em tempo
				$ag_datatime = strtotime( $ag_data );

				$ag_data_invertida = $ag_data;
				
				/* Quebra (explode) a data ($ag_data_invertida) em 3 */
				$ag_data_explode = explode("/", $ag_data_invertida);
				/* Dia */				
				$ag_dia = $ag_data_explode[2];
				/* Mês */
				$ag_mes = $ag_data_explode[1];
				/* Ano */
				$ag_ano = $ag_data_explode[0];

				switch ($ag_mes){
					case 1: $ag_mes="Janeiro"; break;
					case 2: $ag_mes="Fevereiro"; break;
					case 3: $ag_mes="Março"; break;
					case 4: $ag_mes="Abril"; break;
					case 5: $ag_mes="Maio"; break;
					case 6: $ag_mes="Junho"; break;
					case 7: $ag_mes="Julho"; break;
					case 8: $ag_mes="Agosto"; break;
					case 9: $ag_mes="Setembro"; break;
					case 10: $ag_mes="Outubro"; break;
					case 11: $ag_mes="Novembro"; break;
					case 12: $ag_mes="Dezembro"; break;
					default: $ag_mes="Valor invalido"; 
				}
?>

					<div class="agenda-single">
					
                    <div class="esquerda-agenda-single">
						<div class="mes-agenda-single">
							<?php echo $ag_mes; ?>
						</div><!-- .mes-agenda-single -->

						<div class="dia-agenda-single">
							<?php echo $ag_dia; ?>
						</div><!-- .dia-agenda-single -->

						<div class="ano-agenda-single">
							<?php echo $ag_ano; ?>
						</div><!-- .ano-agenda-single -->
					
						<div class="das-agenda-single">
							<?php
							if (empty($ag_termino)){
							echo "a partir das ";
							} else {
							echo "das ";
							}
							echo $ag_inicio; ?>
						</div><!-- .das-agenda-single -->

						<div class="as-agenda-single">
							<?php
							if (empty($ag_termino)){
							} else {
							echo "&agrave;s " . $ag_termino;
							}
							?>	
						</div><!-- .as-agenda-single -->
                        
  					</div><!-- .esquerda-agenda-single -->
                    

					<div class="direita-agenda-single">
						<div <?php thumbnail_bg(); ?> class="thumb-agenda-single">
                            <div class="titulo-agenda-single">
                            <span><?php the_title(); ?></span>
                            </div><!-- .titulo-agenda-single -->
						</div><!-- .thumb-agenda-single -->
					
                        <div class="content-agenda-single">
                        	<?php the_content(); ?>
                        </div><!-- .content-agenda-single -->
                        
                        <hr />
                        
                        <div class="infos-agenda-single">
                            Local: <span class="info-agenda"><?php echo $ag_local; ?></span><br />
                            Endere&ccedil;o; <span class="info-agenda"><?php echo $ag_endereco; ?></span><br />
                            Bairro: <span class="info-agenda"><?php echo $ag_bairro; ?></span><br />
                            Cidade: <span class="info-agenda"><?php echo $ag_cidade; ?></span><br />
                            Estado: <span class="info-agenda"><?php echo $ag_estado; ?></span><br />
                        </div><!-- .infos-agenda-single -->
                    
                    </div><!-- .direita-agenda-single -->

					<div class="">
					</div><!--  -->

					</div><!-- .agenda-single -->
                  
                <?php
                // Fim do Loop
				endwhile;
				
				?>
                   
                   
                </div><!-- .entry-content -->
                <footer class="entry-meta">
                    <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>