<!DOCTYPE html> <!-- Instruction manually added because get_header() isn't on top -->
<?php 
/**
 * The template for displaying one movie post.
 */
if (has_post_thumbnail()) {
    $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
    $url = $thumbnail_data[0];
?>
<div class="container-fluid movie-background" style="background-image: url('<?php echo $url ?>')">
<?php
} else {
    
}

get_header();

global $post;
$author_id = $post->post_author;
?>
    <div class="row">
        <div id="movie-header">
            <div id="centered-block">
                <h1><?php the_title(); ?></h1>
                <div id="movie-meta">
                    <span class="index-author"><i class="fa fa-user" aria-hidden="true"></i><a href="<?php echo get_author_posts_url( $author_id ); ?>"><?php the_author_meta( 'nickname', $author_id ); ?></a></span>
                    <span class="index-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo get_the_time( get_option('date_format'), $post->ID ); ?></span>
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
                </div>
            </div>
        </div>
        <div class="col-sm-12" id="movie-single-content">
            <!--<div class="col-sm-12">-->
                <?php 
                if (have_posts()) { 
                    while(have_posts()) : the_post();
                        get_template_part( 'content', 'movies' );                
                    endwhile; 
                }
                ?>
            <!--</div>-->
            <div id="movie-comments">                    
                <?php
                if ( comments_open() || get_comments_number() != '0' ) : 
                    comments_template();
                endif; 
                ?>     
            </div>        
        </div>
    </div>
<?php 
get_footer(); 
?>
</div>

<script type="text/javascript">    
    jQuery(document).ready(function($){      
        $(".container").removeClass('sideshadow');
        
        if (window.matchMedia("(max-width: 768px)").matches) {
            /* La largeur max de l'affichage est 768px inclus */
            var ratio = 0.4;
            setHeights( ratio );
        } else {
            /* L'affichage est supérieur à 768px de large */
            var ratio = 0.6;
            
            setHeights( ratio );
        
            $(window).resize(function(){
                var screenheight = $(window).innerHeight();

                $(".movie-background").height( screenheight );

                var div_height = Math.round( ratio * screenheight ); 
                $("#movie-header").height(div_height);
            });
        }
        
        
        // Functions ***********************************************************
        
        /**
         * Set initial heights at page startup
         * @returns {undefined}
         */
        function setHeights ( ratio ) {
            var screenheight = $(window).innerHeight();
            $(".movie-background").height( screenheight );

            var div_height = Math.round( ratio * screenheight ); 
            $("#movie-header").height(div_height);
        }
    });    
</script>