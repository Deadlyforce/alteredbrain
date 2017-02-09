<?php 
/**
 * Template for rating taxonomy archive
 */

get_header(); 
?>

<div class="row">
    <div class="col-sm-8 blog-main">
        <h1>
            <?php 
                $current_term = get_queried_object();
                $taxonomy = get_taxonomy( $current_term->taxonomy );
                
                echo $taxonomy->label . ': ' . $current_term->name;
            ?>
        </h1>
        <?php
        if ( have_posts() ) : 
            while(have_posts()) : the_post();
                get_template_part('content-rating', get_post_format() );
            endwhile; 
        ?>
            <nav>
                <ul class="pager">
                    <li><?php  next_posts_link( 'Previous' ); ?></li>
                    <li><?php  previous_posts_link( 'Next' ); ?></li>
                </ul>
            </nav>
        <?php
        endif;
        ?> 
    </div>

    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>

