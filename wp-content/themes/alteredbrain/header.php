<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php wp_head(); ?>
</head>

<body>
    <div class="blog-menu">
        <div class="container">
            <nav class="blog-nav">
                <a class="blog-nav-item active" href="<?php echo home_url(); ?>">Home</a>
                <?php wp_list_pages('&title_li='); ?>
            </nav>
        </div>
    </div>
    <div class="container sideshadow">
        <div class="row blog-header">
            <a href="<?php bloginfo('wpurl');  ?>" title="<?php echo get_bloginfo('name'); ?>">
                <img class="img-responsive" src="<?php echo bloginfo('template_url'); ?>/images/logo.jpg" alt="Logo"/>
                <div id="header-titles">
                    <h1 class="blog-name"><?php echo get_bloginfo('name'); ?></h1>
                    <p class="blog-description">
                        <?php echo get_bloginfo('description'); ?>
                    </p>
                </div>                
            </a>            
        </div>

