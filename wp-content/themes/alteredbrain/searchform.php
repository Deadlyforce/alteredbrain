<form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
    <button type="submit" class="search-submit">
        <i class="fa fa-search"></i>
    </button><!--
 --><label class="label-search">
        <input type="search" class="input-search" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query(); ?>" name="s" />
    </label>    
</form>