<?php
the_post();
get_header(); 
?>

    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow s-content--no-padding-bottom">

        <article class="row format-standard" <?php post_class(); ?>>

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    <?php the_title(); ?>
                </h1>
                <ul class="s-content__header-meta">
                    <li class="date"> <?php echo get_the_date(); ?> </li>
                    <li class="cat">
                        In
                        <?php the_category(' '); ?>
                    </li>
                </ul>
            </div> <!-- end s-content__header -->
    
            <div class="s-content__media col-full">
                <div class="s-content__post-thumb">
                    <?php the_post_thumbnail(); ?>
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">

                <p>
                    <?php the_content(); ?>
                    <?php wp_link_pages( $args ); ?>
                </p>

                <p class="s-content__tags">
                    <span>Post Tags</span>

                    <span class="s-content__tag-list">
                        <?php the_tags('','',''); ?>
                    </span>
                </p> <!-- end s-content__tags -->

                <div class="s-content__author">
                    <?php echo get_avatar(get_the_author_meta('ID')); ?>

                    <div class="s-content__author-about">
                        <h4 class="s-content__author-name">
                            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php the_author(); ?> </a>
                        </h4>
                    
                        <?php echo get_the_author_meta('description'); ?>

                        <ul class="s-content__author-social">
                            <?php
                            $philosophy_author_facebook = get_field('facebook', "user_".get_the_author_meta('ID'));
                            $philosophy_author_twitter = get_field('twitter', "user_".get_the_author_meta('ID'));
                            ?>

                            <?php
                            if ($philosophy_author_facebook): ?>
                           <li><a href="<?php echo esc_url( '$philosophy_author_facebook' ); ?>">Facebook</a></li>
                           <?php endif; ?>

                           <?php
                            if ($philosophy_author_twitter): ?>
                           <li><a href="<?php echo esc_url($philosophy_author_twitter); ?>">Twitter</a></li>
                           <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="s-content__pagenav">
                    <div class="s-content__nav">
                        <?php 
                        $philosophy_prev_post = get_previous_post();
                        $philosophy_next_post = get_next_post();
                        ?>
                        <?php if($philosophy_prev_post): ?>
                        <div class="s-content__prev">
                            <a href="<?php echo get_the_permalink($philosophy_prev_post); ?>" rel="prev">
                                <span><?php _e('Previous Post','philosophy'); ?></span>
                                <?php echo get_the_title($philosophy_prev_post); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                        <?php if($philosophy_prev_post): ?>
                        <div class="s-content__next">
                            <a href="<?php echo get_the_permalink($philosophy_next_post); ?>" rel="prev">
                                <span><?php _e('Next Post','philosophy'); ?></span>
                                <?php echo get_the_title($philosophy_next_post); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div> <!-- end s-content__pagenav -->

            </div> <!-- end s-content__main -->

        </article>


        <!-- comments
        ================================================== -->
        <?php
        if(!post_password_required()){
            comments_template();
        }
        ?>

    </section> <!-- s-content -->

<?php get_footer(); ?>