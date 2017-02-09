<div class="movie-post">    
    <div class="row" id="movie-content">
        <div class="col-sm-12">
            <?php
                $movie_notes = get_post_meta( $post->ID, 'movie_notes', true );

        //        if( has_post_thumbnail() ) {
        //            the_post_thumbnail( 'full' );
        //        }

                the_content(); 
            ?>
            <div class="movie_notes">
                <p>Positives</p>
                <ul>
                    <li><?php echo $movie_notes['pos1']; ?></li>
                    <li><?php echo $movie_notes['pos2']; ?></li>
                    <li><?php echo $movie_notes['pos3']; ?></li>
                </ul>
                <p>Negatives</p>
                <ul>
                    <li><?php echo $movie_notes['neg1']; ?></li>
                    <li><?php echo $movie_notes['neg2']; ?></li>
                    <li><?php echo $movie_notes['neg3']; ?></li>
                </ul>
            </div>
            <div class="rating">
                <?php echo 'Overall score: ' . get_the_term_list($post->ID, 'rating'); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">    
    jQuery(document).ready(function($){
        $(".wp-caption").removeAttr('style'); // Remove wp-caption inline style that force a large width
    });    
</script>
