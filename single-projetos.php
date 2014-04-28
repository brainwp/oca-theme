<?php get_header( 'projetos' ); ?>

		<div id="primary" class="content-area">
			<div id="content" class="site-content content-single-projetos" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
                
                <article id="single-projetos">
                    <div class="entry-content">
                    	<h2 class="capriola"><?php the_title(); ?></h2>
                        <?php the_content(); ?>
                        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'celestial_theme' ), 'after' => '</div>' ) ); ?>
                    </div><!-- .entry-content -->
				<footer class="entry-meta">
                    <?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
                </footer><!-- .entry-meta -->
                </article><!-- #single-projetos -->
                
			<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>