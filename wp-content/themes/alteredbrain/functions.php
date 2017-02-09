<?php
// Add scripts and stylesheets
function alteredbrain_scripts() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), '3.3.7' );
    wp_enqueue_style( 'blog', get_template_directory_uri().'/css/blog.css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css' );

    wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '3.3.7', true );        
    wp_enqueue_script( 'backstretch', get_template_directory_uri().'/js/jquery.backstretch.min.js', array('jquery'), '2.0.4', true );        
}
add_action('wp_enqueue_scripts', 'alteredbrain_scripts');

function my_admin_scripts() {
    wp_enqueue_script( 'image-upload', get_template_directory_uri().'/js/image-upload.js', array('jquery'), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'my_admin_scripts');

// Add Google Fonts
function alteredbrain_google_fonts() {
    wp_register_style( 'Open Sans', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' );
    wp_register_style( 'Oswald', 'https://fonts.googleapis.com/css?family=Oswald:300,400,700' );
    wp_register_style( 'Raleway', 'https://fonts.googleapis.com/css?family=Raleway:100,200,400,600' );
    wp_enqueue_style( 'Open Sans' );
    wp_enqueue_style( 'Oswald' );
    wp_enqueue_style( 'Raleway' );
}
add_action('wp_print_styles', 'alteredbrain_google_fonts');

// Wordpress Titles
add_theme_support( 'title-tag' );

// Support Featured Images
add_theme_support( 'post-thumbnails' );

function get_excerpt( $permalink ) {
    $excerpt = get_the_content();
    $excerpt = preg_replace( " ([.*?])", '', $excerpt );
    $excerpt = strip_shortcodes( $excerpt );
    $excerpt = strip_tags($excerpt);
    $excerpt = substr($excerpt, 0, 200);
    $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
//    $excerpt = trim(preg_replace( '/s+/', ' ', $excerpt)); // Fait sauter les "s" ??
    $excerpt = $excerpt.'... <a href="'. $permalink .'">more</a>';
    
    return $excerpt;
}

/**************************** ADD IMAGE SIZE 320x240 **********************************/

function theme_setup_add_image_sizes() {    
//    add_image_size( 'homepage-thumb', 360, 240, true ); // (360x240 and hard crop)
    add_image_size( 'homepage-thumb', 600, 400, true );
}
add_action( 'after_setup_theme', 'theme_setup_add_image_sizes' );


// Custom Post Types **************************************************************************************

/**
 * Create a movie custom post type
 */
function my_custom_posts() {
    
    $labels = array(
        'name' => __( 'Movies' ),
        'singular_name' => __( 'Movie' ),
        'menu_name' => __( 'Movies' ),
        'name_admin_bar' => __( 'Movie' ),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Movie'),
        'new_item' => __('New Movie'),
        'edit_item' => __('Edit Movie'),        
        'view_item' => __('View Movie'),        
        'all_items' => __('All Movies'),
        'search_items' => __('Search Movies'),
        'parent_item_colon' => __('Parent Movies:'),
        'not_found' => __('No movies found.'),
        'not_found_in_trash' => __('No movies found in Trash.')
    );
    
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-editor-video',
        'query_var' => true,
        'rewrite' => array('slug' => 'movies'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        
        'description' => 'Movie post type',        
        'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
        'taxonomies' => array(
            'post_tag',
            'category'
        )
    );
    
    register_post_type( 'movies', $args );    
    
    register_taxonomy_for_object_type('category', 'movies');
    register_taxonomy_for_object_type('post_tag', 'movies');
}
add_action( 'init', 'my_custom_posts');

function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    my_custom_posts();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );


/****************************** CUSTOM TAXONOMIES ***************************************/

function my_custom_taxonomies() {        
        
    $labels = array(
        'name' => 'Ratings',
        'singular_name' => 'Rating',
        'search_items' => 'Search Ratings',
        'all_items' => 'All Ratings',
        'parent_item' => 'Parent of Rating',
        'parent_item_colon' => 'Parent of Rating:',
        'edit_item' => 'Edit Rating',
        'update_item' => 'Update Rating',
        'add_new_item' => 'Add New Rating',
        'new_item_name' => 'New Rating',
        'menu_name' => 'Rating'
    );    
            
    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'ratings' )
    );        
            
    register_taxonomy( 'rating', array( 'movies'), $args );
    
    // Year of release hierarchical taxonomy
    $year_labels = array(
        'name' => 'Years of release',
        'singular_name' => 'Year of release',
        'search_items' => 'Search Years of release',
        'all_items' => 'All Years of release',
        'parent_item' => 'Parent of Year of release',
        'parent_item_colon' => 'Parent of Year of release:',
        'edit_item' => 'Edit Year of release',
        'update_item' => 'Update Year of release',
        'add_new_item' => 'Add New Year of release',
        'new_item_name' => 'New Year of release',
        'menu_name' => 'Year of release'
    );    
            
    $year_args = array(
        'hierarchical' => true,
        'labels' => $year_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'yearsofrelease' )
    );        
            
    register_taxonomy( 'year_of_release', array( 'movies'), $year_args );
    
    // Directors flat taxonomy
    $director_labels = array(
        'name' => 'Directors',
        'singular_name' => 'Director',
        'search_items' => 'Search Directors',
        'all_items' => 'All Directors',
        'parent_item' => 'Parent of Director',
        'parent_item_colon' => 'Parent of Director:',
        'edit_item' => 'Edit Director',
        'update_item' => 'Update Director',
        'add_new_item' => 'Add New Director',
        'new_item_name' => 'New Director',
        'menu_name' => 'Director'
    );    
            
    $director_args = array(
        'hierarchical' => false,
        'labels' => $director_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'directors' )
    );        
            
    register_taxonomy( 'director', array( 'movies'), $director_args );
    
    // Actors flat taxonomy
    $actor_labels = array(
        'name' => 'Actors',
        'singular_name' => 'Actor',
        'search_items' => 'Search Actors',
        'all_items' => 'All Actors',
        'parent_item' => 'Parent of Actor',
        'parent_item_colon' => 'Parent of Actor:',
        'edit_item' => 'Edit Actor',
        'update_item' => 'Update Actor',
        'add_new_item' => 'Add New Actor',
        'new_item_name' => 'New Actor',
        'menu_name' => 'Actor'
    );    
            
    $actor_args = array(
        'hierarchical' => false,
        'labels' => $actor_labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'actors' )
    );        
            
    register_taxonomy( 'actor', array( 'movies'), $actor_args );
}
add_action( 'init', 'my_custom_taxonomies' );


/******************************** CUSTOM FIELDS *****************************************/

/* Movie notes *****************************************/

add_action('load-post.php', 'movie_notes_meta_boxes_setup');
add_action('load-post-new.php', 'movie_notes_meta_boxes_setup');

function movie_notes_meta_boxes_setup () {
    add_action('add_meta_boxes', 'add_movie_notes_meta_box'); // Adds a movie notes meta box
    add_action('save_post', 'save_movie_notes_meta', 10, 2); // Saves the movie notes meta
}

function add_movie_notes_meta_box () {
    
    add_meta_box(
        'movie_notes',
        esc_html__('Movie Notes'),
        'show_movie_notes_meta_box',
        'movies',
        'normal',
        'default'
    );
}

/**
 * Displays the movie notes, post type meta box
 */
function show_movie_notes_meta_box () {
    global $post;
    
    if ( '' != get_post_meta($post->ID, 'movie_notes', true) ) {
        $movie_notes = get_post_meta($post->ID, 'movie_notes', true);
    } else {
        $movie_notes = get_post_meta($post->ID, 'movie_notes', false);
    }

?>
    <form>
        <input type="hidden" name="movie_notes_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>" />        

        <div>
            <label for="movie_notes[oneword]">One Word Review</label>
            <input type="text" name="movie_notes[oneword]" id="movie_notes[oneword]" class="regular-text" value="<?php echo $movie_notes['oneword']; ?>" />
        </div>
        
        <p>Positives</p>
        <div>
            <label for="movie_notes[pos1]">1. </label>
            <input type="text" name="movie_notes[pos1]" id="movie_notes[pos1]" class="regular-text" value="<?php echo $movie_notes['pos1']; ?>" />
        </div>        
        <div>
            <label for="movie_notes[pos2]">2. </label>
            <input type="text" name="movie_notes[pos2]" id="movie_notes[pos2]" class="regular-text" value="<?php echo $movie_notes['pos2']; ?>" />
        </div>
        <div>
            <label for="movie_notes[pos3]">3. </label>
            <input type="text" name="movie_notes[pos3]" id="movie_notes[pos3]" class="regular-text" value="<?php echo $movie_notes['pos3']; ?>" />
        </div>
            
        <p>Negatives</p>
        <div>
            <label for="movie_notes[neg1]">1. </label>
            <input type="text" name="movie_notes[neg1]" id="movie_notes[neg1]" class="regular-text" value="<?php echo $movie_notes['neg1']; ?>" />
        </div>        
        <div>
            <label for="movie_notes[neg2]">2. </label>
            <input type="text" name="movie_notes[neg2]" id="movie_notes[neg2]" class="regular-text" value="<?php echo $movie_notes['neg2']; ?>" />
        </div>
        <div>
            <label for="movie_notes[neg3]">3. </label>
            <input type="text" name="movie_notes[neg3]" id="movie_notes[neg3]" class="regular-text" value="<?php echo $movie_notes['neg3']; ?>" />
        </div>
    </form>
<?php
}

function save_movie_notes_meta ($post_id, $post) {
    
    // Verify the nonce before proceeding
    if ( !isset( $_POST['movie_notes_nonce'] ) || !wp_verify_nonce( $_POST['movie_notes_nonce'], basename( __FILE__ ) ) ) {
        return $post_id;
    }    
    // Check autosave
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }    
    // Get the post type object
    $post_type = get_post_type_object( $post->post_type );
    
    // Check if the current user has permission to edit the post
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
        return $post_id;
    }

    // Get the posted data and sanitize the text entries   
    if ( isset( $_POST['movie_notes'] ) ) {

        $movie_notes = $_POST['movie_notes'];
        
        foreach ( $movie_notes as $key => $note ) {
            $clean_movie_notes[$key] = sanitize_text_field( $note );
        }
        
        $clean_movie_notes['oneword'] = explode(' ',trim(strtoupper($clean_movie_notes['oneword'])))[0];
        if (strlen($clean_movie_notes['oneword']) > 12) {
            $clean_movie_notes['oneword'] = substr($clean_movie_notes['oneword'], 0, 12);
        }
        
        $new_meta_value = $clean_movie_notes;
    } else {
        $new_meta_value = '';
    }

    $old_meta_value = get_post_meta( $post_id, 'movie_notes', true );  
    
    // If a new meta value was added and there was no previous value, add it
    if ( $new_meta_value && '' == $old_meta_value ) {
        add_post_meta( $post_id, 'movie_notes', $new_meta_value, true );
    } elseif ( $new_meta_value && $new_meta_value != $old_meta_value ) {
        update_post_meta($post_id, 'movie_notes', $new_meta_value);
    } elseif ( '' == $new_meta_value && $old_meta_value ) {
        delete_post_meta( $post_id, $meta_key, $old_meta_value );
    }
}


/**************************** GET ALL POST TYPES **********************************/

function all_my_posts( $query ) {
    if ( !is_admin() && $query->is_main_query() ) {
        if ( $query->is_home() ) :
            $query->set( 'post_type', array( 'post', 'movies' ) );
        endif;
    }
    
    wp_reset_query();
}
add_action( 'pre_get_posts', 'all_my_posts' );


