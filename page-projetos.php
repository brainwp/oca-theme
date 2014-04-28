<?php /* Template Name: Projetos */ get_header( 'projetos' ); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content content-projetos" role="main">
            
         <?php
		//Pega o CPT
		$post_type_obj = get_post_type_object('projetos');
		//Pega o Título do CPT
		$title_projetos = apply_filters('post_type_archive_title', $post_type_obj->labels->name );
		?>
            
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <h1 class="entry-title capriola"><?php echo $title_projetos; ?></h1>
                </header><!-- .entry-header -->
            
                <div class="entry-content">
                   
                   <?php
			/* $paged é a variável para paginação do Loop CPT Projetos */
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			/* $args_loop_cpt_projetos são os argumentos para o Loop */
			$args_loop_cpt_projetos = array(
				'post_type' => 'projetos',
				'orderby' => 'date',
				'order' => 'DESC',
				'posts_per_page' => '5',
				'paged' => $paged
			);
		
			$loop_cpt_projetos = new WP_Query( $args_loop_cpt_projetos ); if ( $loop_cpt_projetos->have_posts() ) {

			while ( $loop_cpt_projetos->have_posts() ) : $loop_cpt_projetos->the_post();
			?>

                <div class="cada-projeto">
                    
                    <div class="esquerda-cada-projeto">
                    
                        <div class="thumb-projetos">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb-projetos'); ?></a>
                        </div><!-- .thumb-projetos -->
                    
                    </div><!-- .esquerda-cada-projeto  -->
                    
                    <div class="direita-cada-projeto">
                    
                        <div class="titulo-cada-projeto">
                        <h2><a class="titulo-resumo" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        </div><!-- .titulo-cada-projeto -->
                        
                        <div class="status-cada-projeto">
                        </div><!-- .status-cada-projeto -->
                        
                        <div class="resumo-cada-projeto">
                        <?php the_excerpt(); ?>
                        </div><!-- .resumo-cada-projeto -->
                    
                    </div><!-- .direita-cada-projeto  -->
                    
                </div><!-- .cada-projeto -->
                <?php
                // Fim do Loop
				endwhile;
				}
				?>
                   
                   
                </div><!-- .entry-content -->

            </article><!-- #post-<?php the_ID(); ?> -->
			
                <?php if (function_exists( 'wp_pagenavi' )) { wp_pagenavi(array( 'query' => $loop_cpt_projetos )); } ?>
            
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer();?>