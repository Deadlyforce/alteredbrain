<div class="blog-post">
    <?php
        if ( 'movies' == get_post_type() ) {
            echo "<div class='movies-header'>Movies</div>";
        }
   
        if ( has_post_thumbnail() ) { 
            $movie_notes = get_post_meta($post->ID, 'movie_notes', true);
    ?>
            <div>
                <div class="post-picture">
                    <div class="index-images">
                        <?php the_post_thumbnail( 'homepage-thumb' ); ?>
                        <div class="index-rating">
                            <?php
                                if ( get_post_type() == 'movies' ) {
                                    echo get_the_term_list($post->ID, 'rating', '', '', '');
                                }
                            ?>
                            <p class="onewordreview">
                            <?php
                                if ( isset($movie_notes['oneword']) ) {
                                    echo $movie_notes['oneword'];
                                }
                            ?>
                            </p>
                        </div>
                    </div>
                </div><!--
             --><div class="post-meta">
                    <div class="index-meta">
                        <h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <div class="blog-post-meta">
                            <span class="index-author"><i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
                            <span class="index-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_date(); ?></span>
                            <?php
                                if ( strlen(get_the_term_list($post->ID, 'category', '', ', ', '')) > 220 ) {
                            ?>
                                    <p>
                                        <i class="fa fa-folder-o" aria-hidden="true"></i><?php echo get_the_term_list($post->ID, 'category', '', ', ', ''); ?>
                                    </p>
                            <?php
                                } else {
                            ?>
                                    <span><i class="fa fa-folder-o" aria-hidden="true"></i><?php echo get_the_term_list($post->ID, 'category', '', ', ', ''); ?></span>
                            <?php
                                }
                            ?>
                            <!--<br>-->
<!--                            <a href="<?php // comments_link(); ?>">
                                <?php // printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'textdomain' ), number_format_i18n( get_comments_number() ) ); ?>
                            </a>                            -->
                        </div>
                        <?php echo get_excerpt( get_permalink() ); ?>
                    </div>          
                </div>            
            </div>

    <?php
        } else {
    ?>
            <div class="row">
                <div class="col-md-12">
                <?php  the_excerpt(); ?>            
                </div>
            </div>
    <?php
        }
    ?>    
</div>

