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
                <h2><?php the_title(); ?></h2>
                <div id="movie-meta">
                    <span class="index-author"><i class="fa fa-user" aria-hidden="true"></i><a href="#"><?php the_author_meta( 'nickname', $author_id ); ?></a></span>
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
        
        setHeights();
        
        $(window).resize(function(){
            var screenheight = $(window).innerHeight();

            $(".movie-background").height( screenheight );
            
            var div_height = Math.round( 0.6 * screenheight ); 
            $("#movie-header").height(div_height);
        });
        
        /**
         * Set initial heights at page startup
         * @returns {undefined}
         */
        function setHeights () {
            var screenheight = $(window).innerHeight();
            $(".movie-background").height( screenheight );

            var div_height = Math.round( 0.6 * screenheight ); 
            $("#movie-header").height(div_height);
        }
    });    
</script>