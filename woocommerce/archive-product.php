<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'doacao' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
			<div class="woo-vindi-description">
			<?php query_posts('pagename=colabore-woo'); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	                <?php $content = get_the_content(); 
	                	echo ($content); ?>
					<?php endwhile; endif; wp_reset_query(); ?>
	                
	                <div class="hack-clear"></div>
			</div>
		<div id="texto-content">
			<div id="demo">
		      <div class="container">
		        <div class="row">
		          <div class="span5">
		            <div id="owl-demo" class="owl-carousel">
		              <div><img src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/images/escolha.JPG"></div>
		              <div><img src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/images/slide-1.JPG"></div>
		              <div><img src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/images/slide-2.JPG"></div>
		              <div><img src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/images/slide-3.JPG"></div>
		              <div><img src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/images/slide-4.JPG"></div>
		              <div><img src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/images/slide-5.JPG"></div>
		              <div><img src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/images/slide-6.JPG"></div>
		              <div><img src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/images/slide-7.JPG"></div>
		            </div>
		          </div>
		        </div>
		      </div>
		    </div>

		    <script src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/js/jquery-1.9.1.min.js"></script> 
		    <script src="https://ocaescolacultural.org.br/wp-content/themes/oca-theme/owl-carousel/owl.carousel.js"></script>
		</div>
		<div id="produtos-content">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

			<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

		<?php endif; ?>

		<?php
			/**
			 * woocommerce_archive_description hook.
			 *
			 * @hooked woocommerce_taxonomy_archive_description - 10
			 * @hooked woocommerce_product_archive_description - 10
			 */
			do_action( 'woocommerce_archive_description' );
		?>
		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>
					 
					<?php wc_get_template_part( 'content', 'product' );?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

			<?php
				/**
				 * woocommerce_after_shop_loop hook.
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
			?>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>
			<div><strong>* contribuição será feita mensalmente.</strong></div>
	</div>
	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

	<?php
		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// do_action( 'woocommerce_sidebar' );
	?>
	
	<script type='text/javascript'>
		jQuery(".price").append("*");
	</script>
	

<?php get_footer( 'doacao' ); ?>
