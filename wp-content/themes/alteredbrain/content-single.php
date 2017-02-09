<div class="blog-post">
    <h2 class="blog-post-title"><?php the_title(); ?></h2>
    <p class="blog-post-meta"><?php the_date(); ?> by <a href="#"><?php the_author(); ?></a></p>
    <div class="rating">
        <?php echo get_the_term_list($post->ID, 'category', '', ',', '') ?>
    </div>
    <?php
        if( has_post_thumbnail() ) {
            the_post_thumbnail( 'full' );
        }
        
        the_content(); 
    ?>    
</div>

