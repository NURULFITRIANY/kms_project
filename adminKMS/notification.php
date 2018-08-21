<?php 

session_start();

  include('../koneksi.php'); //connected to database

// to count total number posts from the selected post types
    $post_types = array( 'brainstorming', 'document', 'project', 'news_event', 'employees' );

    foreach ( $post_types as $post_type ) {
        // variable
        $postCountTotal = wp_count_posts( $post_type )->publish;

        echo '<strong>' . $post_type . '</strong>';
        echo ' has total posts of : ' . $postCountTotal;
        echo '<br>';

        // First read the previous post count value from the database so we can compare the old value with the new one 
        // EDIT: use 0 as the default value if no data in database - first run
        $previousCount = get_option( 'post_count_total', 0 );

        if ( $postCountTotal != $previousCount ) {
            //echo 'New post detected';
            update_option( 'post_count_total', $postCountTotal );
        } elseif ( '' == $postCountTotal && $previousCount ) {
            delete_option( 'post_count_total', $previousCount );
        }


    }
    echo $postCountTotal;
?>