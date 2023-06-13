<?php
/*
Post Detail Page
*/
get_header();
$page_meta = get_post_meta(get_the_ID());
$excludeid = get_the_ID();
?>

<style>
    .pz-post-top {
        margin-top: 40px;
    }
    .pz-tag {
    color: #fff !important;
    background-color: #1edf8f;
    border-radius: 5px;
    padding-left: 8px;
    padding-right: 8px;
    padding-top: 4px;
    padding-bottom: 4px;
    margin-top: 15px;
    line-height: 35px;

    }
    .pz-author {
        line-height: 50px;
    }
    .pz-banner {
        max-width: 400px;
    }

    .pz-banner-image {
        margin-left: 0px;
        margin-bottom: 0px !important;
        max-height: 300px !important;
    }
    

</style>

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
    // change banner image to generic banners for whitepapers, data sheets, videos, and infographics 
   
	
    if( $category->term_id != 1  ) {  // blog, press, or news
        $image = content_url() . '/uploads/2023/06/cycuity-blue-diamond-grid.png';
        if( $category->term_id == 4) { // white paper
            // $image = content_url() . '/uploads/2023/06/cycuity-blue-diamond-grid.png';
            $header_text = 'White Paper';
        }
        if( $category->term_id == 40) { // infographic
            // $image = content_url() . '/uploads/2023/05/cycuity-resource-infographic-id40.png';
            $header_text = 'Infographic';
        }
        if( $category->term_id == 41) { // fact sheet
            // $image = 'https://cycuity.flywheelstaging.com/wp-content/uploads/2022/08/320x132_CycuityLogo-copy.png';
            $header_text = 'Fact Sheet';
        }
        if( $category->term_id == 6) { // video
            // $image = 'https://cycuity.flywheelstaging.com/wp-content/uploads/2022/08/320x132_CycuityLogo-copy.png';
            $header_text = 'Video';
        }
        if( $category->term_id == 23) { // news
            $image = 'http://cycuity.flywheelstaging.com/wp-content/uploads/2023/06/cycuity-tertiary-blue-news-bg.png';
            $header_text = 'News';
        }
        if( $category->term_id == 42) { // news
            $image = 'http://cycuity.flywheelstaging.com/wp-content/uploads/2023/06/cycuity-tertiary-blue-news-bg.png';
            $header_text = 'Press';
        }
        
    }
   
    
    
    $tday = get_the_date("d", $postid);
    $tmonth = get_the_date("F", $postid);
    $tyear = get_the_date("Y", $postid);
    $finalDate = $tmonth . ' ' . $tday . ',  ' . $tyear;
    //$autohor_detail = do_shortcode('[print_blog_author post_id="' . $postid . '" ]');

    // following code block added by Robert/PeakZebra.com to make non-blog pages run a full-width banner immage across 
    // the top of the page. If this is a blog, string is set to nothing. Otherwise (should be full width banner)
    // string is set to create a pz-full-banner class. The class is always called, but for blog entries, it 
    // doesn't do anything. 

   
               
    

    ?>
    <div class="container">

   

    <?php  if( $category->term_id != 1 ) { ?>
        <style>
        .pz-test {
            width: 100vw;
            position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw !important;
            margin-right: -50vw !important;
            margin-top: 0px !important;
            max-height: 300px !important;
        }
        .pz-header {
            margin-left: 20vw;
            padding-top: 200px;
            color: white;
        }
        </style>
    <?php } ?>

      
        <!--If text over image-->
        <div class="row">
            
            <div class="offset-xl-2 col-xl-8 offset-lg-0 col-lg-12 col-md-12 col-sm-12">
                <div class="banner-content">
                    <!-- <h6 class="eyebrow"><?php // echo $docscategory; ?></h6> -->
                    <?php if ($image != '') { ?>
                        <div class="container-fluid  banner-image pz-banner-image banner-image-full  pz-test"  data-src="<?php echo $image; ?>"
                        style="background-image: url(<?php echo $image; ?>); "><h2 class="pz-header"><?php echo $header_text; ?></h2></div> <?php } ?>
                    <h1 class="pz-post-top"><?php echo get_the_title(); ?></h1>
                    <span class="particulars_date"><?php 
                        $tags = get_the_tags();
                        foreach($tags as $tag) {
                            // if user clicks tag name,
                            // we'll call back this page with r parm set to tag slug
                            echo( '<a class="pz-tag" href="./resource-center/?r=' . $tag->slug . '">' . $tag->name . "</a> ");
                        }
                    ?> </span>
                    <br><br>
                    <span class="particulars_date"><?php if ($category->term_id == "1") echo $finalDate; ?> </span>
                      
                    <span class="authorename"><?php
                        $author_id = get_post_field('post_author', $excludeid);
                        $display_name = get_the_author_meta('display_name', $author_id);
                        // modified by robert@peakzebra.com -- only show author if is blog post
                        if( $category->term_id == "1" ) {
                            echo '<span class="dot"></span> by '  . $display_name;
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
