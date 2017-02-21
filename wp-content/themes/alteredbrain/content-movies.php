<div class="movie-post">    
    <div class="row" id="movie-content">
        <div class="col-sm-12">
            <?php  
        //        if( has_post_thumbnail() ) {
        //            the_post_thumbnail( 'full' );
        //        }
                $movie_notes = get_post_meta( $post->ID, 'movie_notes', true );
                
                $year = get_the_term_list( $post->ID, 'year_of_release' );                 
                $actors = get_the_term_list( $post->ID, 'actor', '', ', ', '' );               
                $directors = get_the_term_list( $post->ID, 'director', '', ', ', '' );
            ?>
            <div id="movie-infos">
                <ul>
                    <li><span class="infos-titles">Year of release: </span><span><?php echo $year; ?></span></li>
                    <li><span class="infos-titles">Directors: </span><span><?php echo $directors; ?></span></li>
                    <li><span class="infos-titles">Actors: </span><span><?php echo $actors; ?></span></li>  
                </ul>   
            </div>
            <div class="the-content">
            <?php
                the_content(); 
            ?>
            </div>
            <div class="row" id="movie-ratings">
                <div class="col-sm-12"><h5><?php the_title(); ?></h5></div>
                <div class="col-sm-9" id="movie-notes">
                    <div class="row">                        
                        <div class="col-sm-6" id="positives">
                            <p>Positives</p>
                            <ul>
                                <li><?php echo $movie_notes['pos1']; ?></li>
                                <li><?php echo $movie_notes['pos2']; ?></li>
                                <li><?php echo $movie_notes['pos3']; ?></li>
                            </ul>
                        </div>
                        <div class="col-sm-6" id="negatives">
                            <p>Negatives</p>
                            <ul>
                                <li><?php echo $movie_notes['neg1']; ?></li>
                                <li><?php echo $movie_notes['neg2']; ?></li>
                                <li><?php echo $movie_notes['neg3']; ?></li>
                            </ul>
                        </div>                 
                    </div>
                </div>
                <div class="col-sm-3">
                    <div id="movie-rating">
                        <?php echo get_the_term_list($post->ID, 'rating'); ?>
                        <p>OVERALL SCORE</p>
                    </div>                    
                </div>
            </div>
            <div class="row tags">                
                <div class="col-sm-12">                
                    <?php the_tags('', '', ''); ?>               
                </div>
            </div>
            <div class="social-medias">
                <!-- Load Facebook SDK for JavaScript -->
                <div id="fb-root"></div>
                <script>(function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) return;
                  js = d.createElement(s); js.id = id;
                  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
                
                <div class="share-title">SHARE ON: </div>
                <!-- Your share button code -->                
                <div class="fb-share-button" 
                     data-href="<?php the_permalink(); ?>" 
                     data-layout="button_count" 
                     data-size="small" 
                     data-mobile-iframe="true">
                    <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>;src=sdkpreparse">Partager</a>
                </div>
                <div class="fb-like" 
                     data-href="<?php the_permalink(); ?>" 
                     data-layout="button" 
                     data-action="like" 
                     data-size="small" 
                     data-show-faces="true" 
                    data-share="false">                     
                </div>                
                <div class="twitter">
                    <a class="twitter-share-button" href="https://twitter.com/intent/tweet?text=AlteredBrain Film review: " 
                       data-size="small">
                        Tweet
                    </a>
                </div>
            </div>
            <div class="prevnextmovie">
                <div class="halfcolumn">
                    <div class="movie-nav prev">
                        <?php
                            $previous_post = get_previous_post();
                            if (!empty( $previous_post )) { ?>
                                <a href="<?php echo get_permalink( $previous_post->ID ); ?>"><?php echo $previous_post->post_title; ?><i class="fa fa-chevron-left"></i></a>
                            <?php                             
                            } else {                                 
                                echo '<p>No more movies</p>';                                
                            } 
                            ?>
                    </div>
                </div><!--
             --><div class="halfcolumn">
                    <div class="movie-nav next">
                       <?php
                       $next_post = get_next_post();
                            if (!empty( $next_post )) { ?>
                            <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?><i class="fa fa-chevron-right"></i></a>
                        <?php                             
                            } else { 
                                echo '<p>No more movies</p>';                                
                            } 
                        ?>
                   </div>               
                </div>               
            </div>
            <div class="author-about">
                <h3>About the author</h3>
                <?php                   
                    $email = get_the_author_meta( 'user_email' ); 
                    $av_url = get_avatar_url( $email, ['size' => 128] );
                ?>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="">
                    <img src="<?php echo $av_url; ?>" />
                </a>
                <div class="author-meta">
                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo the_author_meta( 'nickname' ); ?></a> 
                    <p><?php echo the_author_meta( 'description' ); ?></p>
                </div>
            </div>
            <div class="related-movies">
                <h3>Related Movies</h3>
                <?php
                    $categories = get_the_category();
                    
                    $first_category = !empty( $categories ) ? $categories[0]->name : '';
                    
                    $first_movie_args = array(
                        'post_type' => ['post', 'movies'],
                        'post__not_in' => array( $post->ID ),
                        'category_name' => $first_category,
                        'posts_per_page' => 1,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    $second_movie_args = array(
                        'post_type' => ['post', 'movies'],
                        'post__not_in' => array( $post->ID ),
                        'category_name' => $first_category,
                        'offset' => 1,
                        'posts_per_page' => 1,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    
                    $firstRelMovie = new WP_Query( $first_movie_args );
                    $secondRelMovie = new WP_Query( $second_movie_args );                                           
                    ?>
                    <div class="halfcolumn-related">        
                        <div class="rel-nav related-left">
                            <?php
                            if ( $firstRelMovie->have_posts() ) {
                                while ( $firstRelMovie->have_posts() ) : $firstRelMovie->the_post();
                                    the_post_thumbnail( 'homepage-thumb' ); 
                                endwhile;
                                ?>
                                <div class="rel-movie-infos">
                                    <a class="rel-movie-title" href="<?php the_permalink() ?>" rel="" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    <p>
                                        <span class="rel-movie-author"><i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></span>
                                        <span class=""><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_date(); ?></span>
                                    </p>
                                </div>
                                <?php
                            } else {
                                // Cas qui n'est pas censé se produire. Toujours uploader une image avant publication.
                                ?>                                
                                <img src="<?php bloginfo('template_url'); ?>/images/default-no-rel-movie.jpg" />                                
                                <?php
                            }                                
                            ?>                            
                        </div>
                    </div><!--
                 --><div class="halfcolumn-related">
                        <div class="rel-nav related-right">
                            <?php
                            if ( $secondRelMovie->have_posts() ) {
                                while ( $secondRelMovie->have_posts() ) : $secondRelMovie->the_post();
                                    the_post_thumbnail( 'homepage-thumb' );
                                endwhile;
                                ?>
                                <div class="rel-movie-infos">
                                    <a class="rel-movie-title" href="<?php the_permalink() ?>" rel="" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
                                    <p>
                                        <span class="rel-movie-author">
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a>
                                        </span>
                                        <span class=""><i class="fa fa-clock-o" aria-hidden="true"></i><?php the_date(); ?></span>
                                    </p>
                                </div>
                                <?php
                            } else {
                                // Cas qui n'est pas censé se produire. Toujours uploader une image avant publication.
                                ?>                                
                                <img src="<?php bloginfo('template_url'); ?>/images/default-no-rel-movie.jpg" />                                
                                <?php
                            }                                
                            ?>
                        </div>
                    </div>                            
                    <?php                       
                    
                    wp_reset_query();
                ?>                
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">    
    jQuery(document).ready(function($){
        $(".wp-caption").removeAttr('style'); // Remove wp-caption inline style that force a large width
    });    
    
    // Twitter button code snippet
    window.twttr = (function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0],
                      t = window.twttr || {};
                    if (d.getElementById(id)) return t;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "https://platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);

                    t._e = [];
                    t.ready = function(f) {
                      t._e.push(f);
                    };

                    return t;
                  }(document, "script", "twitter-wjs"));
</script>
