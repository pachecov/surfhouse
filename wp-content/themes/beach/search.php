<?php
/**
 * The template for displaying search results pages.
 *
 * @package stackstar.
 */

function hs_do_search_loop() {
  ?>

      
<section class="section--foods">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <div class="search--recipes">
            <header class="page-header">
                <h1 class="search-page-title"><?php printf( esc_html__( 'Resultados para: %s', stackstar ), '<span>' . get_search_query() . '</span>' ); ?></h1>
            </header><!-- .page-header -->
            <div class="search-page-form" id="ss-search-page-form"><?php get_search_form(); ?>
                <i class="fas fa-search"></i>
            </div>
            <div class="row">
            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-sm-6 col-lg-4">
                <div class="post-wrap">
                    <?php 
                        if(get_the_post_thumbnail_url()){
                            $imageDefault = get_the_post_thumbnail_url();
                        }else{
                            $imageDefault = get_site_url()."/wp-content/themes/yisus/images/hero-bg.jpg'";
                        }
                    ?>
                    <img src="<?php echo $imageDefault?> " alt="">
                    <div class="search-box">
                        <span class="search-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </span>
                        <span class="search-post-excerpt"><?php the_excerpt(); ?></span>
                    </div>
                </div>
            </div>
            <?php endwhile;
            wp_reset_query();
             ?>
            </div>
            </div>
 
            <?php //the_posts_navigation(); ?>
 
        <?php else : ?>
            
            <div class="search--recipes">
                <header class="page-header">
                    <h1 class="search-page-title"><?php printf( esc_html__( 'Sin Resultados para: %s', stackstar ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->
                <div class="search-page-form" id="ss-search-page-form"><?php get_search_form(); ?>
                    <i class="fas fa-search"></i>
                </div>
                <p class="text-center">Lo sentimos, no hay contenido que coincida con tu busqueda. :(</p>
            </div>
            <section class="section--blog" id="blog--container">
                <div class="container">
                    <h3>Ultimos Posts</h3>
                    <div class="section--blog__slider row">
                        <?php
                        // $paged = get_query_var('paged') ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type' => array('post', 'receta', 'podcast'),
                            'post_status' => 'publish',
                            'posts_per_page' => 6,
                            // 'paged'          => $paged
                        );
                        $the_query = new WP_Query($args);
                        ?>
                        <?php
                        if ($the_query->have_posts()) : ?>
                            <?php while ($the_query->have_posts()) : $the_query->the_post();
                                $post_type = get_post_type(get_the_ID());
                            ?>
                                <div class="col-lg-4 col-md-6 blog--item">
                                    <div class="blog--item__img">
                                        <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="Image Chef">
                                        <a class="btn btn--red-small btn--red-hover" href="<?php echo get_site_url() . '/blog/?post_types=' . $post_type; ?>" title="<?php echo  $post_type; ?>"><?php echo  $post_type; ?></a>
                                    </div>
                                    <a href="<?php echo get_permalink() ?>">
                                        <p><?php echo get_the_title() ?></p>
                                    </a>
                                    <span>Sub-heading title</span>
                                </div>
                            <?php endwhile; ?>
                        <?php
                        endif;
                        $big = 999999999; // need an unlikely integer

                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>
            <?php 
           
            //get_template_part( 'template-parts/content', 'none' ); ?>
 
        <?php endif; ?>
 
        </div>
    </section>
   
<?php 

} 

// add_action( 'genesis_loop', 'hs_do_search_loop' );
// remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action('genesis_after_header', 'hs_do_search_loop');
remove_action('genesis_loop', 'genesis_do_loop');
 genesis(); 