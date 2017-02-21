<?php 
if ( post_password_required() ) {
    return;
} 
?>

<div id="comments" class="comments-area">
    
    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title">
            <?php
            printf(_nx( 'One comment', '%1$s comments', get_comments_number(), 'comments title'), number_format_i18n( get_comments_number() ));            
            ?>
        </h3>        
        <ul class="comment-list">
            <?php 
            wp_list_comments( array(
                'callback' => 'custom_comments',
                'short_ping'  => true,
                'avatar_size' => 80,
            ) );
            ?>
        </ul>
    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments">
            <?php _e( 'Comments are closed.' ); ?>
        </p>
    <?php endif; ?> 
    <?php 
    $args = array(
        'title_reply' => __( 'Leave a Reply', 'textdomain' ),
        'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.' ) . ( $req ? $required_text : '' ) . '</p>',            
        'comment_field'
    );

    comment_form( $args ); 
    ?>
</div>
