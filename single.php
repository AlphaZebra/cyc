<?php
/*
Post Detail Page
*/
get_header();
$page_meta = get_post_meta(get_the_ID());
$excludeid = get_the_ID();
?>
<div id="page-wrap">
    <?php if (have_posts()) : while (have_posts()) :
    the_post(); ?>
    <?php $postid = get_the_ID();
    $docmeta = get_post_meta($postid);
    $m_category = wp_get_post_terms($postid, 'category');
    $docscategory = '';
    $spececount = 1;
    $i = 0;
    $showrelatedpoat = true;
    foreach ($m_category as $category) {
        $len = count($category);
        // $customoption .=$service->slug.' ';
        if ($category->parent != 0) {
            if ($spececount < 2) {
                $docscategory .= $category->name;
            }

            if ($category->term_id == "1" || $category->term_id == "42" || $category->term_id == "23") {
                $showrelatedpoat = false;
            }
            $spececount++;
        }
        $i++;
    }
    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($postid), 'large');
    $image = $thumbnail[0];
    $tday = get_the_date("d", $postid);
    $tmonth = get_the_date("F", $postid);
    $tyear = get_the_date("Y", $postid);
    $finalDate = $tmonth . ' ' . $tday . ',  ' . $tyear;
    //$autohor_detail = do_shortcode('[print_blog_author post_id="' . $postid . '" ]');
    ?>
    <div class="container">
        <!--If text over image-->
        <div class="row">
            <?php if ($image != '') { ?>
                <div class="container-fluid  banner-image banner-image-full lazy" data-src="<?php echo $image; ?>"
                     style="background-image: url(<?php echo $image; ?>); "></div> <?php } ?>
            <div class="offset-xl-2 col-xl-8 offset-lg-0 col-lg-12 col-md-12 col-sm-12">
                <div class="banner-content">
                    <h6 class="eyebrow"><?php echo $docscategory; ?></h6>
                    <h1><?php echo get_the_title(); ?></h1>
                    <span class="particulars_date"><?php echo $finalDate; ?> </span><span class="dot"></span>
                    <span class="authorename">by <?php
                        $author_id = get_post_field('post_author', $excludeid);
                        $display_name = get_the_author_meta('display_name', $author_id);
                        // modified by robert@peakzebra.com -- only display name if blog
                        if( $category->term_id == "1" ) {
                            echo $display_name;
                        }
                        ?></span>
                </div><!-- Banner Text End -->
            </div><!-- End banner image -->
        </div><!--Row  -->
    </div><!-- End container -->

    <div class="container-fluid">
        <div id="main-content">
            <!-- Main editor page contents -->
            <div class="container">
                <div class="row">


                    <div class="offset-xl-2 col-xl-8 offset-lg-0 col-lg-12 col-md-12 col-sm-12 postdetail">
                        <?php the_content(); ?>
                        <?php // echo wpautop( get_the_content() );
                        ?>
<?php /* if($showrelatedpoat) { ?>
                        <h3 class="more-posts">More Blog Posts</h3>
                        <!-- Put shortcode for 2 blog articles here -->
                        <div class="row">
                            <? echo do_shortcode('[post_category exclude="' . $excludeid . '" order="DESC" num_articles="3" parentcat=""]'); ?>
                        </div>
                        <?php } */ ?>
                    </div>
                </div>


            </div><!-- /row-->
        </div><!-- / container-->
    </div> <!-- /#main-content -->
</div>
<?php endwhile; else: ?>

    <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

<?php endif; ?>

</div> <!-- /#page-wrap -->
<?php get_footer(); ?>
