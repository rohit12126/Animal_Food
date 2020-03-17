<?php

get_header();

?>
<style type="text/css">
	.blog-dec-social i:before{
		font-family: unset !important;
	}
    .breadcrumb-area{
        display: none;
    }
</style>
<div id="Content">
    <div class="shop-area pt-50 pb-50">
        <div class="container">
            <div class="row flex-row-reverse">
            	<div class="col-lg-2 col-md-2 col-sm-12"></div>
                <div class="col-lg-8 col-md-8 col-sm-12">
    				<div class="blog-details-wrapper res-mrg-top">
                        <?php while( have_posts() ){ the_post(); ?>
    <?php

    if (has_post_thumbnail( ))
    	$image = '<div class="blog-img mb-30">'.get_the_post_thumbnail().'</div>';

    ?>
    	                    <div class="single-blog-wrapper">
    	                    	
    	                            <?php echo $image; ?>
    	                       
    	                        <div class="blog-details-content">
    	                            <h2><?php the_title(); ?></h2>
    	                            <div class="blog-meta">
    	                                <ul>
    	                                    <li><?php echo get_the_date( 'M d,Y' ); ?></li>
    	                                    <li><?php echo get_comments_number(); ?> Comments</a></li>
    	                                </ul>
    	                            </div>
    	                        </div>
    							<?php the_content(); ?>

    							<div class="blog-dec-tags-social">
    								<div class="blog-dec-social">
    								    <span>share :</span>
    								    <ul>
    								        <li><a href="http://www.twitter.com/share?url=<?php echo get_the_permalink(); ?>" target="_blank"><i class="icon-social-twitter"></i></a></li>
    								        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" target="_blank"><i class="icon-social-facebook"></i></a></li>
    								        <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_the_permalink(); ?>" target="_blank"><i class="icon-social-linkedin"></i></a></li>
    								    </ul>
    								</div>
    							</div>

    						</div>
    						<?php if(comments_open()){ ?>
    						<div class="blog-comment-wrapper mt-55">
    							<?php comments_template( '', true ); ?>
    						</div>
    						<?php } ?>
    				<?php } ?>
    				</div>
    			</div>
    			<div class="col-lg-2 col-md-2 col-sm-12"></div>
    		</div>
    	</div>
    </div>
</div>
<?php

get_footer();

?><!-- 

 