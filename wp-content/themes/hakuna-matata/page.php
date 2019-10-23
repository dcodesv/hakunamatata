<?php get_header(); ?>
<?php
        while(have_posts()): the_post();
            $destacada = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            $destacada = $destacada[0]; ?>
            <div class="contenedor-banner post" 
            style="background:url(<?php echo $destacada; ?>) no-repeat !important; background-size:cover !important; background-position: center center !important;">
                <div class="contenedor-banner-inner">
                    <div class="text-banner">
                        <h1 class="t-portada"><?php the_title(); ?></h1>
                    </div>
                </div>
            </div>
    <div class="content-pages">
        <?php
            
            the_content();
        endwhile;
    ?>
    </div>
<?php get_footer(); ?>