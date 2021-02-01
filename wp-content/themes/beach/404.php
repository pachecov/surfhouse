<?php
/**
 * @author  Brad Dalton
 * @link    https://wp.me/p1lTu0-hfq
 */

remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );
function genesis_404() {
	genesis_markup( array(
		'open' => '<article class="entry">',
		'context' => 'entry-404',
    ) );
    ?>
     <section class="podcast--hero">
        <div class="animation--background">
        </div>
        <div class="container">
            <div class="podcast--hero__content">
            	<span>ERROR 404</span>
            </div>
        </div>
    </section>
    <?php
		printf( '<div class="container"><h1 class="entry-title">%s</h1>', apply_filters( 'genesis_404_entry_title', __( '404 Página no encontrada', 'genesis' ) ) );
		echo '<div class="entry-content">';
			if ( genesis_html5() ) :
				echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'No se pudo encontrar la página que estaba buscando; 
				es posible que haya escrito la dirección incorrectamente, 
				pero lo más probable es que se haya eliminado debido a la reciente reorganización del sitio web.', 'genesis' ), trailingslashit( home_url('genesis-tutorials-child-theme') ), trailingslashit( home_url('contact') )  ) . '</p>' );
				?>
				<h6>Buscar en este Sitio Web</h6>
				<?php
				get_search_form();
			else :
	?>
			<p><?php printf( __( '
			La página que estás buscando ya no existe. 
			Quizás puedas volver al sitio\'s <a href="%s">homepage</a> 
			y vea si puede encontrar lo que está buscando. O puede intentar encontrarlo con la siguiente información.', 'genesis' ), trailingslashit( home_url() ) ); ?></p>
	<?php
			endif;
		echo '</div></div>';
	genesis_markup( array(
		'close' => '</article>',
		'context' => 'entry-404',
	) );
}

genesis();