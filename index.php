<?php
// Get the queried object and sanitize it
$current_page = sanitize_post($GLOBALS['wp_the_query']->get_queried_object());
// Get the page slug
$page_slug = $current_page->post_name;
$pageid = get_page_by_slug($page_slug);
// $pageid->ID;
$page_meta = get_post_meta($pageid->ID); 


/* 
 * This section added by robert@peakzebra.com to display "Blog" when query is for blogs
 * The menu redirects to ./resource-center/?r=blog and that's what we detect. 
 */
$hash = $_GET['r'];
if( !$hash ) {
    $hash = "";
    $cat_num = null;
} else {
$pz_tag = '';

// var_dump($hash);
// exit;

$pz_author = '';
$pz_author = $_GET['auth'];

switch( $hash) {
    case "blog":
        $page_meta['ignyte_hero_title'][0] = "Resource Center";
        $cat_num = 1;  // this is the category id 
        break;
    case "white_paper":
        $page_meta['ignyte_hero_title'][0] = "Resource Center";
        $cat_num = 4;
        break;
    case "infographic":
        $page_meta['ignyte_hero_title'][0] = "Resource Center";
        $cat_num = 40;
        break;
    case "fact-sheet":
        $page_meta['ignyte_hero_title'][0] = "Resource Center";
        $cat_num = 41;
        break;
    case "video":
        $page_meta['ignyte_hero_title'][0] = "Resource Center";
        $cat_num = 6;
        break;
    // case "":
    //     $page_meta['ignyte_hero_title'][0] = "Resource Center";
    //     break;
    default:
        $page_meta['ignyte_hero_title'][0] = "Resource Center";
        $cat_num = 1;
        $pz_tag = $hash;
}
}

/* -----------------------------------------------------------*/


get_header();




?>

<style>
    .pz-tag  {
    color: #fff !important;
    background-color: #b2a2ff;
    border-radius: 5px;
    padding-left: 8px; 
    padding-right: 8px;
    padding-top: 4px;
    padding-bottom: 4px;
    margin-top: 25px;
    line-height: 35px;
    }

    .pz-title {
        min-height: 115px !important; 
    }
   
    .pz-author {
        margin-bottom: 50px;
    }

    .pz-tagcontainer {
        overflow: hidden;
        min-height: 100px;
    }
   
    

</style>


    <div id="page-wrap">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="textonly col-sm-12 col-md-12 col-lg-12">
                        <?php //single_post_title();
                        $bannercontent = '';
                        if ($page_meta['ignyte_hero_title'][0] != "") {
                            $bannercontent = '<h1 id="pzbannercontent">' . nl2br(esc_html($page_meta['ignyte_hero_title'][0]));
                            $bannercontent .= '</h1>';
                        }
                        if ($page_meta['ignyte_hero_title2'][0] != "") {
                            $bannercontent .= '<h3>' . nl2br(esc_html($page_meta['ignyte_hero_title2'][0])) . '</h3>';
                        }
                        echo $bannercontent;
                        ?>


                    </div>
                    <div class="filter-list col-sm-12 col-md-12 col-lg-12" id="insightsfilter">

                        <div class="filters-dropdown">
                            <div class="filters">


                                <div class="row"><!--row -->
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?php /*<div class="dropdown mobile">
                                            <?php
                                            $terms2 = get_terms(array(
                                                'taxonomy' => 'category',
                                                'hide_empty' => true,
                                                //   'exclude'    => '11',
                                                'parent' => 29,
                                            ));
                                            ?>
                                            <button class="btn dropdown-toggle btn-blue form-control" type="button"
                                                    id="mobilefilterbuttontwo" data-toggle="dropdown">
                                                <span>Topic</span>
                                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                     xmlns:cc="http://creativecommons.org/ns#"
                                                     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                     xmlns:svg="http://www.w3.org/2000/svg"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     id="svg12" version="1.1" viewBox="0 0 32 32" height="32"
                                                     width="32">
                                                    <g transform="translate(8,11)"
                                                       style="fill:none;fill-rule:evenodd;stroke:none;stroke-width:1"
                                                       id="Design-R1C">
                                                        <g transform="translate(-879,-956)" id="Contact">
                                                            <g transform="rotate(-90,924,53)" id="ic-chevron-left-18px">
                                                                <polygon style="fill:#495057;fill-rule:nonzero"
                                                                         points="10.666667,16 18.666667,24 20.551111,22.115556 14.435556,16 20.551111,9.8844444 18.666667,8 "
                                                                         id="Path"/>
                                                                <polygon points="32,32 0,32 0,0 32,0 " id="polygon7"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>

                                            <ul class="dropdown-menu button-group topic_filter" role="menu" id="mobilefilter2"
                                                data-filter-group='all_topic'>
                                                <?php $countercat = 1;
                                                $listclasscat = '';
                                                $listclasscat .= ' <li role="presentation" class="post_filter_li active" data-filter=".all" id="all_topic">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">All Topics</a>
                                        </li>';
                                                //$currentloadcat=
                                                foreach ($terms2 as $wcatTerm2) {
                                                    $removespace = preg_replace('/\s+/', '', $wcatTerm2->slug);
                                                    $listclass = $removespace . '-category';
                                                    $currentloadcat[] = $wcatTerm2->term_id;
                                                    $aclass = '';
                                                    if ($countercat == 1) {
                                                        //$aclass = 'active';
                                                    }
                                                    $listclasscat .= ' <li role="presentation" class="post_filter_li ' . $aclass . '" data-filter=".' . $listclass . '" id="' . $wcatTerm2->slug . '">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">' . $wcatTerm2->name . '</a>
                                        </li>';
                                                    ?>
                                                    <?php $countercat++;
                                                } ?>
                                                <?php echo $listclasscat; ?>
                                            </ul>

                                        </div> */ ?>
                                        <div class="dropdown mobile">
                                            <?php
                                            $terms2 = get_terms(array(
                                                'taxonomy' => 'category',
                                                'hide_empty' => true,
                                                   'exclude'    => array( 23, 9, 42 ),
                                                'parent' => 28,
                                            ));
                                            
                                          
                                            ?>
                                            <button class="btn dropdown-toggle btn-blue form-control" type="button"
                                                    id="mobilefilterbutton" data-toggle="dropdown">
                                                <span>Type</span>
                                                <svg xmlns:dc="http://purl.org/dc/elements/1.1/"
                                                     xmlns:cc="http://creativecommons.org/ns#"
                                                     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                                                     xmlns:svg="http://www.w3.org/2000/svg"
                                                     xmlns="http://www.w3.org/2000/svg"
                                                     id="svg12" version="1.1" viewBox="0 0 32 32" height="32"
                                                     width="32">
                                                    <g transform="translate(8,11)"
                                                       style="fill:none;fill-rule:evenodd;stroke:none;stroke-width:1"
                                                       id="Design-R1C">
                                                        <g transform="translate(-879,-956)" id="Contact">
                                                            <g transform="rotate(-90,924,53)" id="ic-chevron-left-18px">
                                                                <polygon style="fill:#495057;fill-rule:nonzero"
                                                                         points="10.666667,16 18.666667,24 20.551111,22.115556 14.435556,16 20.551111,9.8844444 18.666667,8 "
                                                                         id="Path"/>
                                                                <polygon points="32,32 0,32 0,0 32,0 " id="polygon7"/>
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu button-group type_filter" role="menu" id="mobilefilter"
                                                data-filter-group='all_type'>
                                                <?php $countercat = 1;
                                                $listclasscat = '';
                                                $listclasscat .= ' <li role="presentation" class="post_filter_li active" data-filter=".all" id="all">
                                    <a role="menuitem" tabindex="-1" href="javascript:void(0);">All</a>
                                        </li>';
                                                //$currentloadcat=
                                                foreach ($terms2 as $wcatTerm2) {
                                                    
                                                    $removespace = preg_replace('/\s+/', '', $wcatTerm2->slug);
                                                    $listclass = $removespace . '-category';
                                                    $currentloadcat[] = $wcatTerm2->term_id;
                                                    $aclass = '';
                                                    if ($countercat == 1) {
                                                        //$aclass = 'active';
                                                    }
                                                    // url construction modified by robert@peakzebra.com
                                                    $pz_href = '"?r=' . $wcatTerm2->slug . '#' . $wcatTerm2->slug . '"';
                                                    $listclasscat .= ' <li role="presentation" class="post_filter_li ' . $aclass . '" data-filter=".' . $listclass . '" id="' . $wcatTerm2->slug . '">
                                    <a role="menuitem" tabindex="-1" href=' . $pz_href . '>' . $wcatTerm2->name . '</a>
                                        </li>';
                                        // var_dump($wcatTerm2);
                                        // exit;
                                                    ?>
                                                    <?php $countercat++;
                                                } ?>
                                                <?php echo $listclasscat; ?>
                                            </ul>

                                        </div>
                                    </div>

                                </div> <!--/row -->
                                <script>
                                    jQuery('.type_filter a').click(function () {
                                        // alert();
                                        jQuery('#mobilefilterbutton span').text(jQuery(this).text());

                                    });
                                    jQuery('.topic_filter a').click(function () {
                                        // alert();
                                        jQuery('#mobilefilterbuttontwo span').text(jQuery(this).text());

                                    });
                                </script>

                            </div>
                        </div>
                        <div class="search-bar">
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" class="form-control quicksearch" value=""
                                           placeholder="Search">
                                    <div class="input-group-append">
                                        <button class="search-btn" type="button">
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div id="main-content">
                <div class="container">
                    <!-- Main editor page contents -->
                    <!-- main column -->

                    <div class="row list">
                        <?php
                        //print_r($currentloadcat);
                        $argsfist = array(
                            'post_type' => 'post',
                            'posts_per_page' => -1,
                             'orderby' => 'date',
                             'order' => 'DESC',
                            'post_status' => 'publish',
                            'category__not_in' => array( 23,42 ),
                            'category__in' => $cat_num,
                            'author_name' => $pz_author,
                            'tag' => $pz_tag
                        );
                        $args22 = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'orderby' => 'date',
                             'order' => 'DESC',
                            'category__not_in' => array( 23,42 ),
                            'meta_query' => array(
                                array(
                                    'key'     => 'featured_post',
                                    'value'   => 1,
                                    'compare' => '!='
                                )
                            ),
                        );

                        $allpost_query = new WP_Query($argsfist);
                        $postscount = new WP_Query($args22);
                        $total_posts = $postscount->found_posts;
                        ?>
                        <?php $postcontent = "";
                        $count = 0;
                        if ($allpost_query->have_posts()) : while ($allpost_query->have_posts()) :
                            $allpost_query->the_post();
                             $postid = get_the_ID();
                            $docmeta = get_post_meta($postid);
                            //if($docmeta['featured_post'][0]!=1) {

                                $m_category = wp_get_post_terms($postid, 'category');
                            $docscategory = '';
                            $spececount = 1;
                            $listclass = 'all ';

                            foreach ($m_category as $category) {
                                // if ($category->slug != 'news') {
                                $removespace2 = preg_replace('/\s+/', '', $category->slug);
                                $listclass .= $removespace2 . '-category ';
                                //print_r($category);
                                if ($category->parent != 0) {
                                    if ($spececount < 2) {
                                        $docscategory .= $category->name;
                                    }
                                    $spececount++;
                                }

                                // break;
                                // }
                            }

                            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($postid), 'medium_large');
                            $image = $thumbnail[0];
                                if($docmeta['ignyte_thumbnail_banner'][0]!="")
                                {
                                $image = $docmeta['ignyte_thumbnail_banner'][0];
                                }
                            $tday = get_the_date("d", $postid);
                            $tmonth = get_the_date("F", $postid);
                            $tyear = get_the_date("Y", $postid);
                            $finalDate = $tmonth . ' ' . $tday . ', ' . $tyear;
                            $imagepart = "";
                            $contentpart = "";

                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 ignyte-post color-shape <?php echo $listclass; ?>">
                                <div class="blog-tile">
                                   <?php
                                   /* <a href="<?php if($docmeta['hubsporturl'][0]!="") { echo $docmeta['hubsporturl'][0]; }else { echo get_permalink($postid);} ?>" <?php if($docmeta['hubsporturl'][0]!="") { ?> target="_blank" <?php  }?>>
                                      */
                                   ?>
                                    <a href="<?php if($docmeta['hubsporturl'][0]!="") { echo $docmeta['hubsporturl'][0];  } else { echo get_permalink($postid); } ?>" <?php if($docmeta['hubsporturl'][0]!="") { ?> target="_blank" <?php  }?>>
                                        <div class="image bg-image"
                                             style="background-image: url(<?php echo $image; ?>);"></div>
                                    </a>
                                    <div class="title_description pz-blog-title">
                                        <a href="<?php if($docmeta['hubsporturl'][0]!="") { echo $docmeta['hubsporturl'][0];  } else { echo get_permalink($postid); } ?>" <?php if($docmeta['hubsporturl'][0]!="") { ?> target="_blank" <?php  }?>>
                                        <h4 class="eyebrow"><?php echo $docscategory; ?></h4>
                                            <p class="pz-title"><?php echo get_the_title(); ?></p></a>
                                            
                                            <?php 
                                                
                                                // this block added by robert@peakzebra.com to add author name and tags to listing
                                                // if( $category->slug == "blog" ) {
                                                   
                                                //     $pz_author = get_the_author_meta( 'nicename');
                                                //     $pz_author_display = get_the_author_meta( 'display_name' );
                                                   
                                                //     $pz_author_link = "<a href='./?r=blog&auth=" . $pz_author . "#blog'>" . $pz_author_display . "  </a>" ;
                                                    
                                                //     echo( "<span class='pz-author'>" . $pz_author_link . "</span><br><br>" );
                                                // }
                                                $tags = get_the_tags();
                                                ?>
                                                <div class="pz-tagcontainer"> 
                                                <?php
                                                foreach($tags as $tag) {
                                                    // if user clicks tag name,
                                                    // we'll call back this page with r parm set to tag slug
                                                    echo( '<a class="pz-tag" href="./resource-center/?r=' . $tag->slug . '">' . $tag->name . "</a> ");
                                                }
                                                
                                            ?>  </div>  
                                            
                                    </div>
                                </div>
                                
                            </div>
                           
                            <?php $count++;   endwhile; ?>
                        <?php else: ?>
                            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                        <?php endif; ?>
                        
                    </div>
                   
                    <div class="load-more center">
                        <a class="button btn-transparent">Load More Resources</a>
                    </div>
                    <div class="not_found_msg center" style="display: none">
                        <h4></h4>
                    </div>
                    <script>

                        jQuery(document).ready(function () {

                            setTimeout(function () {
                                filteractive();
                            }, 1);

                            function filteractive() {
                                //clear search field
                                //jQuery('.quicksearch').val('');
                                var qsRegex;
                                var buttonFilter;
                                // init Isotope
                                var buttonFilters = {};
                                var buttonFilter;


                                // init Isotope
                                var grid = jQuery('.list').isotope({
                                    itemSelector: '.color-shape',
                                    layoutMode: 'masonry',
                                    filter: function () {
                                        var thisdata = jQuery(this);
                                        var searchResult = qsRegex ? thisdata.text().match(qsRegex) : true;
                                        var buttonResult = buttonFilter ? thisdata.is(buttonFilter) : true;

                                        return searchResult && buttonResult;
                                    },
                                });
                                var iso = grid.data('isotope');

                                jQuery('.filters').on('click', '.post_filter_li', function () {
                                    var thisdata = jQuery(this);
                                    var girdclass = thisdata.attr('class');

                                    initfilter();
                                    // jQuery(this).data('clicked', true);
                                    loadMore(initShow);

                                    function initfilter() {
                                        // get group key
                                        // alert();
                                        var buttonGroup = thisdata.parents('.button-group');
                                        // alert(buttonGroup);
                                        var filterGroup = buttonGroup.attr('data-filter-group');
                                        // alert(filterGroup);
                                        // set filter for group
                                        buttonFilters[filterGroup] = thisdata.attr('data-filter');
                                        // combine filters
                                        buttonFilter = concatValues(buttonFilters);
                                        
                                        // alert(buttonFilter);
                                        // Isotope arrange
                                        grid.isotope();
                                        // setTimeout(set_team, 3000)

                                    }
                                });

                                // use value of search field to filter
                                var quicksearch = jQuery('.quicksearch').keyup(debounce(function () {
                                    grid.find(".hidden").removeClass("hidden");
                                    qsRegex = new RegExp(quicksearch.val(), 'gi');
                                    grid.isotope();

                                    loadMore(initShow);

                                }));
                                var anyButtons = jQuery('.filters').find('.post_filter_li[data-filter=""]');
                                var buttons = jQuery('.post_filter_li');


// change active class on buttons
                                jQuery('.button-group').each(function (i, buttonGroup) {
                                    var buttonGroup = jQuery(buttonGroup);
                                    buttonGroup.on('click', '.post_filter_li', function () {
                                        buttonGroup.find('.active').removeClass('active');
                                        jQuery(this).addClass('active');
                                    });
                                }); 

                                //****************************
                                // Isotope Load more button
                                //****************************
                                var initShow = 9; //number of items loaded on init & onclick load more button
                                var counter = initShow; //counter for load more button
                                var iso = grid.data('isotope'); // get Isotope instance
                                var taotalrac = "<?php echo $total_posts; ?>";

                                function loadMore(toShow) {
                                    grid.find(".hidden").removeClass("hidden");
                                    var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function (item) {
                                        return item.element;
                                    });

                                    jQuery(hiddenElems).addClass('hidden');
                                    grid.isotope('layout');
                                    //when no more to load, hide show more button
                                    taotalrac = hiddenElems.length + toShow;
                                    if (hiddenElems.length == 0) {
                                        jQuery(".load-more").hide();
                                    } else {
                                        jQuery(".load-more").show();
                                    }
                                    ;
                                    var resultount = iso.filteredItems.length;
                                    //alert(resultount);
                                    if (resultount == 0) {
                                        jQuery(".not_found_msg").show();

                                    }
                                    else {
                                        jQuery(".not_found_msg").hide();
                                    }
                                    /* htmlString='<div class="bottom-paginations"><p class="bottom-pagination">Showing '+toShow+' of  “'+taotalrac+' Results”.</p></div>'+
                                         '<div class="pagination-count center"><a class="btn hidden-text-btn icon green load-more-provider"><div class="hidden-text">Show More</div></a></div>';
                                     jQuery('.load-more').html( htmlString );
                                     */
                                }

                                loadMore(initShow); //execute function onload
                                jQuery(".load-more").click(function () {
                                    if (jQuery('.filters').data('clicked')) {
                                        //when filter button clicked, set initial value for counter
                                        counter = initShow;
                                        jQuery('.filters').data('clicked', false);
                                    } else {
                                        counter = counter;
                                    }

                                    counter = counter + initShow;
                                    loadMore(counter);
                                });

                                //when filter button clicked
                                jQuery(".filters .post_filter_li").click(function () {
                                    var getdata = jQuery(this).attr('data-filter');
                                    if (getdata != '') {
                                        grid.find(".hidden").removeClass("hidden");
                                        jQuery(".load-more").hide();

                                    }
                                    else {
                                        // grid.find(".color-shape").addClass("hidden");
                                        // jQuery(this).data('clicked', true);
                                        //var initShow = 12;
                                        // loadMore(initShow);
                                        // jQuery(".load-more").show();

                                    }
                                });
                            }

                            // flatten object by concatting values
                            function concatValues(obj) {
                                var value = '';
                                for (var prop in obj) {
                                    value += obj[prop];
                                }
                                return value;
                            }

                            // debounce so filtering doesn't happen every millisecond
                            function debounce(fn, threshold) {
                                var timeout;
                                threshold = threshold || 100;
                                return function debounced() {
                                    clearTimeout(timeout);
                                    var args = arguments;
                                    var _this = this;

                                    function delayed() {
                                        fn.apply(_this, args);

                                    }

                                    timeout = setTimeout(delayed, threshold);
                                };
                            }


                        });

                        function get_height() {
                            var str = 0;
                            var windowsize = jQuery(window).width();
                            if (windowsize > 580) {
                                str = 1;
                            }
                            var offsetHeight = document.getElementById('insightsfilter').offsetHeight;
                            if (str == 1) {

                                jQuery("#sidebar").height(offsetHeight);
                            }
                            else {
                                // alert();
                                jQuery("#sidebar").css("height", "");

                            }
                        }

                        //setTimeout(function(){ get_height() }, 2000);
                        jQuery(window).load(function () {
                            //get_height();
                            jQuery(window).resize(function () {
                                // get_height();
                            });
                        });

                        jQuery(document).ready(function () {
                            jQuery("#menu-item-25 .sub-menu a").click(function() {
                                jQuery('#closemm2').trigger('click');
                            });

                            jQuery('#main-nav-wrap a, footer a, #menu-item-25 .sub-menu a').click(function () {
                                var target = jQuery(this).attr('href');
                                var arr = target.split('/#');
                                if(arr[0]!="")
                                {
                                    target='#'+arr[1];
                           
                                }
                               
                              //  if( jQuery(target).length ) {
                                    jQuery(target).trigger('click');
                                    jQuery(target+' a').trigger('click');
                               // }

                            });


                            jQuery(".filters .post_filter_li").click(function () {
                                if (history.pushState) {
                                    //  history . pushState('http://example.ca', null, jQuery(this) . attr("id"));
                                    if (jQuery(this).attr("id") != 'resource-center') {
                                        window.history.pushState(null, null, '/resource-center/#' + jQuery(this).attr("id"));
                                    }
                                    else {
                                        window.history.pushState(null, null, '/resource-center/');
                                    }
                                }

                            });

                            setTimeout(function () {
                                var hashval = window.location.hash;
                                if (hashval == "") {
                                    hashval = "#nothing";
                                } 


                                var target = jQuery('.filters ' + hashval);
                                if (target.length) {
                                    //event.preventDefault();
                                    //jQuery('html, body').animate({scrollTop: jQuery(target).offset().top - 150}, 300);
                                    jQuery('.filters ' + hashval).trigger('click');
                                    jQuery('.filters ' + hashval + ' a').trigger('click');
                                }
                            }, 0);


                        });

                    </script>
                </div> <!-- /.container -->
            </div> <!-- /#main-content -->
        </div>
    </div> <!-- /#page-wrap -->
<?php get_footer(); ?>