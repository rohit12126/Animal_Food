
<?php get_header(); ?>
<style type="text/css">
    .breadcrumb-area{
        display:none;
    }
</style>
<?php
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
    $args = array(
                'post_type'             => 'blog',
                'posts_per_page'        => 6,
                'paged'                 => $paged,
                'order'                 => 'DESC' ,
                'orderby'               => 'date' ,
                'taxonomy'              => 'blog_category',
                'term'                  => get_query_var( 'term' ), // WordPress 4.0 Portfolio Categories FIX
                'ignore_sticky_posts'   => 1,
            );
    //$tax = get_the_terms($post, 'blog_category')[0]->slug;
    $the_query = new WP_Query( $args ); 
?>
<div class="blog-area pt-100 pb-100 clearfix">
    <div class="container">
        <div class="row">
            <?php if($the_query -> have_posts()) { ?>
                <?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>
                        <?php
                            if (has_post_thumbnail( $the_query->post->ID ))
                                $image = get_the_post_thumbnail($the_query->post->ID, 'shop_catalog');
                            else
                                $image = '<img src="'.woocommerce_placeholder_img_src().'" alt="My Image Placeholder" />';

                            $author = get_the_author($the_query->post->ID);
                            $date = get_the_date( 'M d,Y' );
                        ?>

                            <div class="col-lg-6 col-md-6">
                                <div class="blog-wrapper mb-30 gray-bg">
                                    <div class="blog-img hover-effect">
                                        <a href="<?php the_permalink(); ?>"><?php echo $image; ?></a>
                                    </div>
                                    <div class="blog-content">
                                        <div class="blog-meta">
                                            <ul>
                                                <li>By: <span><?php echo $author; ?></span></li>
                                                <li><?php echo $date; ?></li>
                                            </ul>
                                        </div>
                                        <h4><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                    </div>
                                </div>
                            </div>

                <?php endwhile;?>
            <?php }else{ ?>
                <center><h1>no blog found.</h1></center>
            <?php } ?>
        </div>
        <?php
        $big = 999999999; // need an unlikely integer
         $pagination = paginate_links( array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $the_query->max_num_pages,
            'prev_text' => '<i class="icon-arrow-left"></i>',
            'next_text' => '<i class="icon-arrow-right"></i>'
        ) );
         if(!empty($pagination)){
        ?>
            <div class="pagination-style text-center mt-20">
                <?php echo $pagination; ?>
            </div>
        <?php } ?>
    </div>
</div>
<?php

wp_reset_postdata();


?>

<?php get_footer(); ?>
