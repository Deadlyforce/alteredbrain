<!--    <div class="">
        <h4>About</h4>
        <p><?php // the_author_meta('description'); ?></p>
    </div>-->
    <div class="row module">
        <div class="col-sm-12">
        <?php
            get_search_form();
        ?>
        </div>
    </div>
    <div class="row module">
        <div class="col-sm-12">
            <h2>Recent Posts</h2>
            <ul>
            <?php
                    $args = array( 
                        'numberposts' => '5', 
                        'orderby' => 'post_date', 
                        'order' => 'DESC' 
                    );
                    $recent_posts = wp_get_recent_posts( $args );
                    foreach( $recent_posts as $recent ){
                            echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
                    }
                    wp_reset_query();
            ?>
            </ul>
        </div>
    </div>   
    <div class="row module">
        <div class="col-sm-12">
            <h2>Recent Comments</h2>
            <ul>
                <?php
                    $args = [
                        'number' => 5,
                        'orderby' => 'comment_date',
                        'order' => 'DESC'
                    ];
                    get_comments( $args ); 
                ?>      
            </ul>
        </div>
    </div>
    <div class="row module">
        <div class="col-sm-12">
            <h2>Archives</h2>
            <ul>
                <?php wp_get_archives('type=monthly'); ?>      
            </ul>
        </div>
    </div>
    <div class="row module">
        <div class="col-sm-12">
            <h2>Categories</h2>
            <ul>
                <?php 
                $args = [
                    'hierarchical' => false,
                    'title_li' => '',
//                    'show_count' => 1
                ];
                wp_list_categories( $args ); 
                ?>      
            </ul>
        </div>
    </div>
    <div class="row module">
        <div class="col-sm-12">
            <h2>Meta</h2>
            <ul>                   
                <li><a href="http://alteredbrain.com/wp-login.php" title="Entries RSS">Log in</a></li>
                <li><a href="http://alteredbrain.com/feed/" title="Entries RSS">Entries RSS</a></li>
                <li><a href="http://alteredbrain.com/comments/feed/" title="Comments RSS">Comments RSS</a></li>
                <li><a href="https://wordpress.org" title="Wordpress">Wordpress.org</a></li>
            </ul>
        </div>
    </div>
<!--    <div class="">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="<?php // echo get_option( 'github' ); ?>">GitHub</a></li>
            <li><a href="<?php // echo get_option( 'twitter' ); ?>">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>-->

