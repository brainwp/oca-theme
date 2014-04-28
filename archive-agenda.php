<?php get_header(); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content content-projetos" role="main">
            
         <?php
		//Pega o CPT
		$post_type_obj = get_post_type_object('agenda');
		//Pega o Título do CPT
		$title_agenda = apply_filters('post_type_archive_title', $post_type_obj->labels->name );
		?>
            
            
            <article id="post-<?php the_ID(); ?>" <?php post_class( 'content-projetos' ); ?>>
                <header class="entry-header">
                    <h2 class="entry-title"><?php echo $title_agenda; ?></h2>
                </header><!-- .entry-header -->
            
                <div class="entry-content">
                   
                   <?php
			/* $paged é a variável para paginação do Loop CPT Projetos */
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			/* $args_loop_cpt_projetos são os argumentos para o Loop */
			$args_loop_cpt_agenda = array(
				'post_type' => 'agenda',
				"meta_key" => "agenda-event-date", // Campo da Data do Evento
				"orderby" => "meta_value", // This stays as 'meta_value' or 'meta_value_num' (str sorting or numeric sorting)
				"order" => "DESC",
				'paged' => $paged,
			);
		
			$loop_cpt_agenda = new WP_Query( $args_loop_cpt_agenda ); if ( $loop_cpt_agenda->have_posts() ) {
			while ( $loop_cpt_agenda->have_posts() ) : $loop_cpt_agenda->the_post();

			global $post;
				// Pega os dados e salva em variáveis
				$ag_data = get_post_meta($post->ID,'agenda-event-date',TRUE);
				$ag_inicio = get_post_meta($post->ID,'agenda_horario_inic',TRUE);
				$ag_termino = get_post_meta($post->ID,'agenda_horario_fim',TRUE);

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
				$urlt = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			?>

					<div class="cada-agenda-archive <?php echo $ag_final_class; ?>">
					
                    <div class="esquerda-agenda-archive">
						<div class="mes-agenda-archive">
							<?php echo $ag_mes; ?>
						</div><!-- .mes-agenda-archive -->

						<div class="dia-agenda-archive">
							<?php echo $ag_dia; ?>
						</div><!-- .dia-agenda-archive -->

						<div class="ano-agenda-archive">
							<?php echo $ag_ano; ?>
						</div><!-- .ano-agenda-archive -->
					
						<div class="das-agenda-archive">
							<?php
							if (empty($ag_termino)){
							echo "a partir das ";
							} else {
							echo "das ";
							}
							echo $ag_inicio; ?>
						</div><!-- .das-agenda-archive -->

						<div class="as-agenda-archive">
							<?php
							if (empty($ag_termino)){
							} else {
							echo "&agrave;s " . $ag_termino;
							}
							?>	
						</div><!-- .as-agenda-archive -->
                        
   						<div class="mais-agenda-archive">
							<a href="<?php the_permalink(); ?>">+</a>
						</div><!-- .mais-agenda-archive -->

					</div><!-- .esquerda-agenda-archive -->
                    

					<div class="direita-agenda-archive">
						<div class="thumb-agenda-archive">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb-projetos'); ?></a>
						</div><!-- .thumb-agenda-archive -->

						<div class="titulo-agenda-archive">
							<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
						</div><!-- .titulo-agenda-archive -->



					</div><!-- .direita-agenda-archive -->

					<div class="">
					</div><!--  -->

					</div><!-- .cada-agenda-archive -->
                  
                <?php
                // Fim do Loop
				endwhile;
				}
				?>
                   
                   
                </div><!-- .entry-content -->
                <footer class="entry-meta">
                    <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-meta -->
            </article><!-- #post-<?php the_ID(); ?> -->
            
		
        
        

			
                <?php if (function_exists( 'wp_pagenavi' )) { wp_pagenavi(array( 'query' => $loop_cpt_agenda )); } ?>
            
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer();?>
