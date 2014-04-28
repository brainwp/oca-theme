<?php

get_header( 'projetos' ); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h2>
						Projetos / <?php the_terms( $post->ID, 'projetos_category' ); ?>
					</h2>
				</header>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

				<div class="cada-projeto">

                    <div class="esquerda-cada-projeto">
                        <div class="thumb-projetos">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('projetos'); ?></a>
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

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

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

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_footer(); ?>