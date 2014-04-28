
	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
    
        <?php
		$endereco = get_option ('mo_enderecorodape');
		$telefone = get_option ('mo_telefonerodape');
		$facebook = get_option ('mo_facebookrodape');
		?>
	
		<div id="logo-rodape"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/mini-oca.png" /></div><!-- #logo-rodadpe -->
		<div id="infos">
		<?php bloginfo( 'name' ); ?> <?php the_date( 'Y' ); ?> - Todos os Direitos Reservados &reg;<br />
		<?php echo $endereco; ?> - Tel.:<?php echo $telefone; ?>
        </div><!-- #infos -->
		<div id="brasa"><a class="a-brasa" href="http://www.brasa.art.br" target="_blank"></a></div><!-- #brasa -->		
		<div id="redes-rodape"><a class="a-face" href="<?php echo $facebook; ?>"></a></div><!-- #redes-rodape -->
			
	</footer><!-- #colophon -->

	<div id="menus-rodape">
		<div class="menu-links">
		<?php
			$menu_obj = echo_name_menu( 'um' ); 
			wp_nav_menu( array('theme_location' => 'um', 'items_wrap'=> '<h3>'.esc_html($menu_obj->name).'</h3><ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>') );
		?>
		</div><!-- .menu-links -->
		<div class="menu-links">
		<?php
			$menu_obj = echo_name_menu( 'dois' ); 
			wp_nav_menu( array('theme_location' => 'dois', 'items_wrap'=> '<h3>'.esc_html($menu_obj->name).'</h3><ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>') );
		?>
		</div><!-- .menu-links -->
		<div class="menu-links">
		<?php
			$menu_obj = echo_name_menu( 'tres' ); 
			wp_nav_menu( array('theme_location' => 'tres', 'items_wrap'=> '<h3>'.esc_html($menu_obj->name).'</h3><ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>') );
		?>
		</div><!-- .menu-links -->
		<div class="menu-links">
		<?php
			$menu_obj = echo_name_menu( 'quatro' ); 
			wp_nav_menu( array('theme_location' => 'quatro', 'items_wrap'=> '<h3>'.esc_html($menu_obj->name).'</h3><ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>') );
		?>
		</div><!-- .menu-links -->
		<div class="menu-links">
		<?php
			$menu_obj = echo_name_menu( 'cinco' ); 
			wp_nav_menu( array('theme_location' => 'cinco', 'items_wrap'=> '<h3>'.esc_html($menu_obj->name).'</h3><ul id=\"%1$s\" class=\"%2$s\">%3$s</ul>') );
		?>
		</div><!-- .menu-links -->
	</div><!-- #menus-rodape -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>