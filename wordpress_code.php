<?php

1. To Create Custom Post Type : Write In Function.php
2. To get Custom Post Data
3. Post_type with Texonomy function
4. Get Category (Texonomy)
5. Get User Role And Login
6. Get Custom Field Data
7. Create Meta Box
8. Get Custon logo
9. Get page Thumbnail Image
10. Get menus
11. To Get custom field Text
12. get_post by category & pagination
13. Get SubCategory Or His Post By Perent Cat id
14. Get image title or contant By plugin ""Just Custom Fields for Wordpress""
15. Author , comment or category on Blog 
16. Page contant_title_thumbnail
17. get first image first_image from wp_contant
18. if_image else image
19. time_ago
20. Get sub category of parent
21. Get Featured Products
22. get image Alt tag
22. code to replace the class of the dropdown menu
23. Toolset pluging loop for Image
24. Toolset pluging loop
25. Add new User role
26. Remove User role
27. Custom field for image and text box
28. add custom field in post type
29. To Provide Order Field in Custom Post Type
30. Provide extra attibute in predefine post type suppots paramenter
31. Custom Post Type With Taxonomy
32. Create Shortcode with parameters
33. Creating custom hook and action
34. Add featured post checkbox
35. Add Custom Field In user profile page in admin Side
36. Login And Logout menu
37. User Can See its own images only
38. Disable admin toolbar for all user accept administrator
39. Login logout in primary menu bar
40. Remove Capability of particular User role
41. remove dashboard access to users
42. Add Capability Using Function
43. Restrict User to see posts Except Defaults
44. Get Post By user id as term_id
45. Associate one post with another custom post type
46. Change predefine post type slug to another using Function
47. Function to add first image of the post as featured image of the post.
48. Get post taxonomy name using post type


Functions:-

1. function for stop update of plugin
2. function for Excerpt limit
3. Option Tree Functionality
4. Advance Custom Field
5. Post_type with Texonomy function
6. Function to get Number of views in posts
7. Function To add Multiple Image Meta field in any post/page
8. Function To insert new post by code


Woocommerce:-


1. Change number or products per row
2. To diable link on woocomerce product in listing page


======================================================= All Shorts Related ================================================

javascript:void(0);
<?php echo get_template_directory_uri();?>/    //get folder path
<?php the_title(); ?>   					  //To Print Title
<?php echo get_the_title(); ?>			      //To get Title
<?php the_content(); ?>		  				  //To get content
<?php the_post_thumbnail(); ?>				  //To get Post Thumbnail
<?php bloginfo("template_url");?>		      //To get Template Url
<?php echo get_the_date('F j, Y'); ?>		  //To Display date 
<p><?php the_excerpt(); ?></p>		          //To get Excerpt
<?php echo home_url(); ?>					  //To get Home or index page url
<?php echo substr(get_the_excerpt(), 0,200); ?>  //To get excerpt according to word length
<?php the_permalink(); ?>						 //To get permalink(url)
<?php echo category_description(1); ?>		     //To get Category Description
<?php single_cat_title(); ?>		             //To get Single Category Title
<?php echo do_shortcode('[shortcode]');?>        //To put shortcode manually
<?php dynamic_sidebar('blog_detals_sidebar'); ?> //To put Widgets manually
<?php echo get_post_meta(get_the_ID(),'team_facebook_link',true); ?> //post meta
<?php echo get_field( "field_name" ); ?> //To get Advanced Custom Field Value
<?php echo get_comments_number(); ?>    //To get comments counts
<?php echo get_the_date( 'j' ); ?>			//To get date of post
<?php echo get_the_date( 'F' ); ?>			//To get month of post
<?php show_admin_bar(false); ?>				//Disable header toolbar for all user
<?php wp_roles()->remove_role( 'guest_author' ); ?>   //remove unwanted user role
<?php get_object_taxonomies( array( 'post_type' => 'post_type' ) ); ?> //get post taxonomy using post_type





<!-- get template-part in any page -->

<?php get_template_part( 'content', 'about' ); // 'content-about.php' ?>
<?php get_template_part( 'content', 'portfolio' ); // 'content-portfolio.php' ?>
<?php get_template_part( 'customtemplate' ); // 'customtemplate.php' ?>



<?php
html_entity_decode(strip_tags($txt))


remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );
?>

========================================================================================================================

<?php
========================= To Create Custom Post Type : Write In Function.php ============================

function create_posttype_sliders() {

	register_post_type( 'Sliders',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Sliders' ),
				'singular_name' => __( 'Slider' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'Sliders'),
			'supports'=> array( 'title', 'editor', 'thumbnail','custom-fields'),
		)
	);
}

// Hooking up our function to theme setup
add_action( 'init', 'create_posttype_sliders' );
?>

<?php

================================ To get Custom Post Data =================================== 

$i=1;
$args = array( 'post_type' => 'sliders', 'posts_per_page' => 3, 'orderby' => 'ID', 'order' => 'ASC', 'orderby' => 'menu_order', );   
// if you want to sort post by order which come first use 'orderby' => 'menu_order',
$the_query = new WP_Query( $args ); 
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		 <div class="<?php if($i==1) {echo "item active left";} elseif($i==2) {echo "item next left";} else {echo "item";} ?>"> 
		 
		 <img src="<?php the_post_thumbnail_url( 'full' ); ?>" alt="banner">
			<div class="carousel-caption banner_content">
			
				 <h4><?php the_title();?></h4>
				<?php the_content(); ?> 
				
			</div>
		  </div>

	<?php $i++;
	wp_reset_postdata();
	endwhile;
	else:  ?>
	<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
	<?php endif; ?>


<?php
==================================== Post_type with Texonomy function ==================Texonomy==============

 add_action( 'init', 'my_custom_post_body' );

function my_custom_post_body() {
	$labels = array(
		'name'               => _x( 'bodys', 'post type general name' ),
		'singular_name'      => _x( 'body_care', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Product' ),
		'edit_item'          => __( 'Edit Product' ),
		'new_item'           => __( 'New Product' ),
		'all_items'          => __( 'All Products' ),
		'view_item'          => __( 'View Product' ),
		'search_items'       => __( 'Search Products' ),
		'not_found'          => __( 'No products found' ),
		'not_found_in_trash' => __( 'No products found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'body'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	register_post_type( 'body_care', $args );	
}

function my_taxonomies_body() {
	$labels = array(
		'name'              => _x( 'body Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'body Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Product Categories' ),
		'all_items'         => __( 'All Product Categories' ),
		'parent_item'       => __( 'Parent Product Category' ),
		'parent_item_colon' => __( 'Parent Product Category:' ),
		'edit_item'         => __( 'Edit Product Category' ), 
		'update_item'       => __( 'Update Product Category' ),
		'add_new_item'      => __( 'Add New Product Category' ),
		'new_item_name'     => __( 'New Product Category' ),
		'menu_name'         => __( 'body Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'body_category', 'body_care', $args );
}
add_action( 'init', 'my_taxonomies_body', 0 );

 ?>


?>



<?php

=================================Get Category ---------------------taxonomy--------==========================
(1)
$categories = get_terms( 'category', array(
				'orderby'    => 'term_id',
				'hide_empty' => 0
			) );
			print_r($categories);

//get subcategory-------

$term = get_queried_object();

$children = get_terms( $term->taxonomy, array(
'parent'    => $term->term_id,
'hide_empty' => false
) );
print_r($children); // uncomment to examine for debugging
if($children) { 
	echo "hellasdasdasdo";
		$parent_id = '25';
	$termchildren = get_terms('category',array('child_of' => $parent_id));
	print_r($termchildren); }
			
// or -----
(2)
$post_categories = wp_get_object_terms( get_the_ID() , array('taxonomy'=>'service-categories'));
foreach($post_categories as $c)
{
$c->name;
}

// or- - - 
(3)
$post_categories = wp_get_object_terms( get_the_ID() , array('taxonomy'=>'service-categories'));

foreach($post_categories as $c){
	//print_r($c);
	 echo '<li><img src="'.[after plugin(Categories Images) installed]  z_taxonomy_image_url($c->term_id).'" alt="icon" /><span>'.$c->name.'</span></li>';



(4)

$cat_args=array(
  'orderby' => 'name',
  'order' => 'ASC'
   );
$categories=get_categories($cat_args);
echo '<pre>';
//print_r($categories);
foreach($categories as $categoriess){

	echo $categoriess->term_id;
}
echo '</pre>';


?>

========================================================================================================================


<?php
========================================= Get User Role And Login ======================================================


$user = wp_get_current_user();
if ( in_array( 'booking_customer', (array) $user->roles ) && is_user_logged_in() ) { 
  wp_redirect( $if_client_login_redirect );
 }

 ?>
 =======================================================================================================================


 <?php

=============================================== Get Custom Field Data ==================================================


global $post;
	$args = array( 'post_type' => 'team', 'posts_per_page' => -1, 'orderby' => 'ID', 'order' => 'ASC');
	$lastposts = get_posts( $args );
		foreach($lastposts as $post)
			{ ?>
			<li>
				<div class="phototeam"> <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="photo" />
					<div class="teamcontent">
						<section>
							<p><?php echo $post->post_title; ?></p>
								<a href="<?php echo get_post_meta(get_the_ID(),'team_facebook_link',true); ?>"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href='#'><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <span><?php echo get_post_meta(get_the_ID(),'position',true); ?></span> 
						</section>
					</div>
				</div>
			</li>
<?php	} 

	wp_reset_postdata(); ?>

 ?>

========================================================================================================================

<?php
================================================== Create Meta Box =====================================================


	/* Fire our meta box setup function on the post editor screen. */
add_action( 'load-post.php', 'smashing_post_meta_boxes_setup' );
add_action( 'load-post-new.php', 'smashing_post_meta_boxes_setup' );

/* Meta box setup function. */
function smashing_post_meta_boxes_setup() {

 /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action( 'add_meta_boxes', 'smashing_add_post_meta_boxes' );
  /* Save post meta on the 'save_post' hook. */
  add_action( 'save_post', 'wpt_save_events_meta_video', 10, 2 );
}

/* Create one or more meta boxes to be displayed on the post editor screen. */
function smashing_add_post_meta_boxes()
{
    add_meta_box("demo-meta-box", "Property Details", "smashing_post_class_meta_box", "recommend", "normal", "high", null);
}


function wpt_save_events_meta_video($post_id, $post) {


	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['property_price_nonce'], basename(__FILE__) )) {
	return $post->ID;
	}
	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;
	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$events_meta['property_price'] = $_POST['property_price'];
	$events_meta['property_address'] = $_POST['property_address'];
	$events_meta['property_title'] = $_POST['property_title'];	
	$events_meta['property_description'] = $_POST['property_description'];
	$events_meta['property_price'] = $_POST['property_price'];
	//$events_meta['featured_video'] = $_POST['featured_video'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}
}
/*------------------------------- Display the post meta box --------------------------*/
function smashing_post_class_meta_box( $post ) { ?>

  <?php wp_nonce_field( basename( __FILE__ ), 'property_price_nonce' ); ?>

  <p>
    <label for="smashing-post-class"><?php _e( "Property Price($)", 'example' ); ?></label>
    <br />
    <input class="widefat" type="text" name="property_price" id="property-price" value="<?php echo esc_attr( get_post_meta( $post->ID, 'property_price', true ) ); ?>" size="30" />
  </p>
  
    <p>
    <label for="property_address"><?php _e( "Property Address", 'example' ); ?></label>
    <br />
    <textarea name="property_address" id="property_address" cols="150" rows="4"><?php echo  get_post_meta( $post->ID, 'property_address', true ); ?></textarea>
  </p>
  
    <p>
    <label for="smashing-post-class"><?php _e( "Property Title", 'example' ); ?></label>
    <br />
    <input class="widefat" type="text" name="property_title" id="property-price" value="<?php echo esc_attr( get_post_meta( $post->ID, 'property_title', true ) ); ?>" size="30" />
  </p>
  
      <p>
    <label for="smashing-post-class"><?php _e( "Property Description", 'example' ); ?></label>
    <br />
    <input class="widefat" type="text" name="property_description" id="property-price" value="<?php echo esc_attr( get_post_meta( $post->ID, 'property_description', true ) ); ?>" size="30" />
  </p>
  
        <p>
    <label for="smashing-post-class"><?php _e( "Property Price", 'example' ); ?></label>
    <br />
    <input class="widefat" type="text" name="property_price" id="property-price" value="<?php echo esc_attr( get_post_meta( $post->ID, 'property_price', true ) ); ?>" size="30" />
  </p>
  
  

<?php } ?>

========================================================================================================================

<?php

=================================================== Get Custon logo ====================================================

 $custom_logo_id = get_theme_mod( 'custom_logo' );
$image = wp_get_attachment_image_src( $custom_logo_id , 'full' ); ?>

<a href="<?php echo site_url(); ?>"><img src="<?php echo $image[0]; ?>" alt="logo" />

========================================================================================================================

<?php

====================================================  Get page Thumbnail Image =========================================

$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full"); ?>
<img src="<?php echo $imgsrc[0]; ?>" width="100%" height="100%" alt="image" />


========================================================================================================================

<?php
 ===================================================== Get menus ======================================================

<?php wp_nav_menu( array('menu' => 'topmenu' )); ?>
<?php wp_nav_menu( array('menu' => 'Main', 'container' => '', 'menu_class' => 'class_name', 'items_wrap' => '<ul id="mymenu">%3$s</ul>' )); ?>

========================================================================================================================

<?php

===================================================== To Get custom field Text =========================================

<?php $tit_data = get_post_meta($post->ID, 'header_title_side'); echo $tit_data[0]; ?>

========================================================================================================================

<?php 
============================================== get_post by category & pagination ======================================= 

<?php $args = array( 'orderby' => 'name', 'parent' =>1 );
$categories = get_categories( $args );
foreach ( $categories as $category ) {
echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><br/>'; } ?>

<?php $wp_query->query(array('category__in'=>array(5,6,7),'post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>1, 'paged' => $paged));?>
or
<?php $wp_query->query('category__in=5&post_type=post&post_status=publish&posts_per_page=1&paged='. get_query_var('paged'));?>
<?php  wp_reset_query(); // end have_posts() check ?>       
<?php if (have_posts()) : ?><?php  while (have_posts()): the_post(); ?>
<?php the_title(); ?><?php the_content(); ?>
<?php $terms = get_the_terms( $post->ID , 'taxonomyname' );foreach ( $terms as $term ) {echo $term->name;}?>
<?php endwhile; ?><?php //wp_pagenavi();  ?><?php endif; wp_reset_query(); // end have_posts() check ?>



<?php global $post; $tmp_post = $post;
$args = array( 'post_type'=>'post', 'post_status'=>'publish', 'numberposts' => 40, 'category' => 4 );
$myposts = get_posts( $args );
foreach( $myposts as $post ) : setup_postdata($post); ?> <?php the_title(); ?><?php the_content(); ?><?php endforeach; ?>

========================================================================================================================
<?php

============================================ Get SubCategory Or His Post By Perent Cat id ==============================

<?php $categories = get_categories('child_of='.$nk_cat_id.''); foreach ($categories as $cat) { ?>
<?php query_posts("cat=$cat->cat_ID&showposts=-1&order=ASC&orderby=name"); ?>
<?php $cur_cat_id = get_cat_id( single_cat_title("",false)); ?>
<?php $category_link = get_category_link( $cur_cat_id ); ?>
<h4 class="cat_title_nk"> <a href="<?php echo esc_url( $category_link ); ?>" title="<?php  single_cat_title(); ?>"><?php  single_cat_title(); ?></a>  </h4>
<?php while (have_posts()) : the_post(); ?>
<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><?php endwhile; ?> <?php } ?>

========================================================================================================================

<?php
====================== Get image title or contant By plugin ""Just Custom Fields for Wordpress""========================

<?php $cus_data = get_post_meta($post->ID, 'field_uploadmedia__8'); //print_r($cus_data);
foreach($cus_data[0] as $data){ ?>
<div class="team_m" style="background:url(<?php  echo $data['image']; ?>) no-repeat scroll 0 0 transparent"></div>
<?php echo $data['title']; ?><?php echo $data['description']; ?><?php  } ?>

========================================================================================================================

<?php
======================================== Author , comment or category on Blog ==========================================

<li>Author: &nbsp;&nbsp; <?php the_author(); ?></li>
<li>comment&nbsp; <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( 'Comments ( 1 )', 'twentytwelve' ), __( 'Comments (%)', 'twentytwelve' ) ); ?>
</li> 
<li>Category : &nbsp;&nbsp; 
<?php $category = get_the_category(); 
if($category[0]){ echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';  }?></li>
<li>Category : &nbsp;&nbsp; <?php $categories = get_the_category();
$separator = ' '; $output = ''; if($categories){foreach($categories as $category) {
$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
}echo trim($output, $separator);} ?></li> 
<li>Tag :::: <?php $posttags = get_the_tags(); if ($posttags) { foreach($posttags as $tag) { echo '<a href="';echo bloginfo(url);
echo '/?tag=' . $tag->slug . '" class="' . $tag->slug . '">' . $tag->name . '</a>'; }} ?></li> 

========================================================================================================================

<?php
========================================== Page contant_title_thumbnail ================================================ 
<div class="section"> <?php $args=array(
  'orderby' =>'parent',
  'order' =>'asc',
  'post_type' =>'page',
  'post__in' => array(80,2,33,2), );
   $page_query = new WP_Query($args); ?>
<?php while ($page_query->have_posts()) : $page_query->the_post(); ?>
   <div class="section">
	<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <?php the_post_thumbnail(); ?>
	<?php the_excerpt(); ?>
        <?php /*?><p class="readmore"><a href="<?php the_permalink();?>">Read More</a></p><?php */?>
  </div>
<?php endwhile; ?> 
</div> 

========================================================================================================================

<?php
======================================= get first image first_image from wp_contant ====================================

<div class=""><?php function catch_that_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];
if($first_img){
return '<img src="'.$first_img.'" />';
}
// no image found display default image instead
//return $first_img;
}
?><a href="<?php the_permalink();?>"><?php echo catch_that_image(); ?></a> </div>

========================================================================================================================

<?php============================================ if_image else image ================================================?>
<div class=""><?php if ( has_post_thumbnail() ) {
the_post_thumbnail(); }
elseif( catch_that_image() ) { ?>
<?php echo catch_that_image(); ?>
<?php } else { ?>
<img src="http://" width="64" height="64" alt="<?php the_title_attribute(); ?>" />
<?php } ?> </div>

========================================================================================================================

<?php================================================= Time Ago ======================================================?>
<div class=""><?php function time_ago( $type = 'post' ) {
 $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');
} ?>   <?php echo time_ago(); ?> </div>

========================================================================================================================

<?php======================================= Get sub category of parent =============================================?>

<?php
$args = array( 'orderby' => 'name', 'parent' => 19 );
$categories = get_categories( $args );
foreach ( $categories as $category ) {
echo '<a href="' . get_category_link( $category->term_id ) . '">' . $category->name . '</a><br/>'; } ?>

<!-- :> condition for IS_HOME() :>> is_page ,is_page_template >> -->
<?php if ( is_home() ) { ?>
<?php } else { ?>
<?php } ?>

<?php echo category_description(); ?>
<?php single_cat_title('',true); ?>
<?php $category_ids = get_all_category_ids();
foreach($category_ids as $cat_id) {
$cat_name = get_cat_name($cat_id); echo $cat_id . ': ' . $cat_name; } ?>

	<?php wp_list_categories('orderby=order&title_li=&depth=3'); ?>
	<?php $cat_name = get_the_category_by_ID( 36 ); echo $cat_name; ?>
	<?php if(is_category()) { $cat_ID = ''.get_query_var('cat'); } ?>
 	<?php echo $cat_ID; ?>
 
<?php $args = array(
	'show_option_all'    => '',
	'orderby'            => 'name',
	'order'              => 'ASC',
	'style'              => 'list',
	'show_count'         => 0,
	'hide_empty'         => 1,
	'use_desc_for_title' => 1,
	'child_of'           => $cat_ID,
	'feed'               => '',
	'feed_type'          => '',
	'feed_image'         => '',
	'exclude'            => '',
	'exclude_tree'       => '',
	'include'            => '',
	'hierarchical'       => 1,
	'title_li'           => __( 'Categories' ),
	'show_option_none'   => __('No categories'),
	'number'             => null,
	'echo'               => 1,
	'depth'              => 0,
	'current_category'   => 0,
	'pad_counts'         => 0,
	'taxonomy'           => 'category',
	'walker'             => null
); ?>

<?php =========================================== function for stop update of plugind ==================================================== 

//stop update of plugind
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) ); 

?>

<?php =================================================== function for Excerpt limit ===================================================== 

function custom_excerpt_length( $length ) {	return 130;  }
add_filter( 'excerpt_length', 'custom_excerpt_length', 900 ); 

?>

<?php ============================================== Option Tree Functionality ====================================================== ?>

<?php if ( function_exists( 'ot_get_option' ) ) {
echo  $test_input = ot_get_option( 'header_email_id' ); ?>
<img src="<?php echo $header_logo =ot_get_option( 'header_logo' );?>" width="309" height="67" alt="logo" />
<?php } ?>

:>slider :>>
  <?php if ( function_exists( 'ot_get_option' ) ) {  /* get the slider array */
  $slides = ot_get_option( 'index_slider', array() );
 if ( ! empty( $slides ) ) {
 foreach( $slides as $slide ) { echo '<li> <a href="' . $slide['link'] . '"><img src="' . $slide['image'] . '" alt="' . $slide['title'] . '" /></a>
 <div class="description">' . $slide['description'] . '</div>  </li>';  }  }} ?>

:>>Option Tree Group set
<?php $schedule_ = ot_get_option('featured_services');
foreach($schedule_ as $sche){ //print_r($sche); ?> <?php echo $sche['title']; ?><?php echo $sche['featured_services_images']; ?><?php }?>

<?php ===================================================== advance custom field ======================================================= ?>

<img src="<?php the_field('shop_image1'); ?>" />
<?php if( get_field('enable_sidebar') ): ?> <?php endif; ?>
<?php echo CFS()->get('method_of_prepeartion'); ?>
<?php $fields = CFS()->get('method_of_prepeartion');
 if( $fields ) {} ?>

<?php ================================================ Post_type with Texonomy function ================================================== ?>

<div>
<?php add_action( 'init', 'my_custom_post_body' );

function my_custom_post_body() {
	$labels = array(
		'name'               => _x( 'bodys', 'post type general name' ),
		'singular_name'      => _x( 'body_care', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Product' ),
		'edit_item'          => __( 'Edit Product' ),
		'new_item'           => __( 'New Product' ),
		'all_items'          => __( 'All Products' ),
		'view_item'          => __( 'View Product' ),
		'search_items'       => __( 'Search Products' ),
		'not_found'          => __( 'No products found' ),
		'not_found_in_trash' => __( 'No products found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'body'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our products and product specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
	register_post_type( 'body_care', $args );	
}

function my_taxonomies_body() {
	$labels = array(
		'name'              => _x( 'body Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'body Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Product Categories' ),
		'all_items'         => __( 'All Product Categories' ),
		'parent_item'       => __( 'Parent Product Category' ),
		'parent_item_colon' => __( 'Parent Product Category:' ),
		'edit_item'         => __( 'Edit Product Category' ), 
		'update_item'       => __( 'Update Product Category' ),
		'add_new_item'      => __( 'Add New Product Category' ),
		'new_item_name'     => __( 'New Product Category' ),
		'menu_name'         => __( 'body Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'body_category', 'body_care', $args );
}
add_action( 'init', 'my_taxonomies_body', 0 ); ?>

:::>>> Get Category by post_type :>>>>>>
<?php wp_list_categories(array(
            'show_option_all'       => 'Home',
            'orderby'            => 'ID',
            'order'                 => 'DESC',
            'use_desc_for_title' => 0,
            'child_of'           => 0,
            'exclude'            => '',
            'exclude_tree'       => '', 
            'include'            => '',
            'hierarchical'       => 1,
            'title_li'           => NULL,
            'show_option_none'   => NULL,
            'number'             => NULL,
            'taxonomy'           => 'body_category' ));?>

</div>
==================================================== Get Featured Products ======================================================


<?php

$args = array( 'post_type' => 'product', 'orderby' => 'ID', 'order' => 'ASC', 'post__in' => wc_get_featured_product_ids(), );

$the_query = new WP_Query( $args ); 

if ( $the_query->have_posts() ) :

while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

     
      <li>
        <div class="topimg"><img src="<?php echo get_template_directory_uri();?>/images/ratedimg.jpg" alt="img" /></div>
        <div class="ratedcontent">
          <h5><?php the_title();?></h5>
          <div class="staricon"><img src="<?php echo get_template_directory_uri();?>/images/staricon.png" alt="star" /></div>
          <span class="pricetext"><?php 

   $product = new WC_Product(get_the_ID()); 

  echo wc_price($product->get_price_including_tax(1,$product->get_price()));

?></span> <a class="searcheart_b" href="#"><i class="fa fa-search" aria-hidden="true"></i></a> <a class="searcheart_b" href="#"><i class="fa fa-heart" aria-hidden="true"></i></a> <a class="searcheart_b" href="#"> <img src="<?php echo get_template_directory_uri();?>/images/carticon.png" alt="basket" width="20" /></a> </div>
      </li>
    
     <?php

  wp_reset_postdata();

  endwhile;

  endif; ?>


========================================================= get image Alt tag =============================================================

<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>

            <?php 

                $post_img_id = get_post_thumbnail_id(get_the_ID());

                $post_img_thumbnail = wp_get_attachment_image_src($post_img_id,'large'); 

            ?>

                <div class="col-md-3 col-sm-3">

                  <div class="business_img"><img src="<?php echo $post_img_thumbnail[0]; ?>" width="328" alt="<?php echo $image_alt = get_post_meta( $post_img_id , '_wp_attachment_image_alt', true); ?>" /></div>


                </div>


// code to replace the class of the dropdown menu ----------------------------------------------------------------- Inside functions.php
<?php
function new_submenu_class($menu) {    
    $menu = preg_replace('/ class="sub-menu"/','/ class="new-class-name" /',$menu);         
    return $menu;      
}

add_filter('wp_nav_menu','new_submenu_class'); 

//------------------------------------------------------------------------



================================================= Toolset pluging loop for Image ========================================================

 <?php


              $slider_images = get_post_meta(get_the_ID(),'wpcf-slider-image');
              
              foreach ($slider_images as $slider_image) {
                

                /* for getting imges alt tag*/
                $feature1_id = attachment_url_to_postid($slider_image);

               $image_alt_slide = get_post_meta( $feature1_id, '_wp_attachment_image_alt', true );
              
              
            ?>

          <li data-transition="slideleft" data-slotamount="7" data-thumb="<?php echo get_template_directory_uri();?>/images/thumbs/thumb2.jpg">
          <img src="<?php echo $slider_image; ?>" alt="<?php echo $image_alt_slide; ?>" title="<?php echo $image_alt_slide; ?>">
            <div class="caption lft blur_bg"  data-x="460" data-y="350" data-speed="400" data-start="1700" data-easing="easeOutExpo"></div>
            <div class="caption lft small_white"  data-x="150" data-y="center" data-speed="400" data-start="1700" data-easing="easeOutExpo">
            Stage the <br>
              <strong class="caligra" >Wedding <br> of your Dreams </strong> <br> with us</div>
          </li>

          <?php } ?>



================================================================ Toolset pluging loop ===================================================

 <?php


              $slider_images = get_post_meta(get_the_ID(),'wpcf-slider-image');
              
              foreach ($slider_images as $slider_image) {
                
              
            ?>

          <li data-transition="slideleft" data-slotamount="7" data-thumb="<?php echo get_template_directory_uri();?>/images/thumbs/thumb2.jpg">
          <img src="<?php echo $slider_image; ?>" alt="" title="">
            <div class="caption lft blur_bg"  data-x="460" data-y="350" data-speed="400" data-start="1700" data-easing="easeOutExpo"></div>
            <div class="caption lft small_white"  data-x="150" data-y="center" data-speed="400" data-start="1700" data-easing="easeOutExpo">
            Stage the <br>
              <strong class="caligra" >Wedding <br> of your Dreams </strong> <br> with us</div>
          </li>

          <?php }


==================================================== Add new User role ====================================================

add_role('moderator', __(
    'Moderator'),
    array(
        'read'              => true, // Allows a user to read
        'create_posts'      => true, // Allows user to create new posts
        'edit_posts'        => true, // Allows user to edit their own posts
        'edit_others_posts' => true, // Allows user to edit others posts too
        'publish_posts'     => true, // Allows the user to publish posts
        'manage_categories' => true, // Allows user to manage post categories
        )
);



/*Another User Role*/

add_role(
    'guest_author',
    __( 'Guest Author', 'testdomain' ),
    array(
        'read'         => true,  // true allows this capability
        'edit_posts'   => true,
        'delete_posts' => false, // Use false to explicitly deny
    )
);


========================================================= Remove User role ==============================================================



remove_role( 'subscriber' );
remove_role( 'editor' );
remove_role( 'contributor' );
remove_role( 'author' );


===================================================Function to get Number of views in posts =============================================


function bac_PostViews($post_ID) {
 
    //Set the name of the Posts Custom Field.
    $count_key = 'post_views_count'; 
     
    //Returns values of the custom field with the specified key from the specified post.
    $count = get_post_meta($post_ID, $count_key, true);
     
    //If the the Post Custom Field value is empty. 
    if($count == ''){
        $count = 0; // set the counter to zero.
         
        //Delete all custom fields with the specified key from the specified post. 
        delete_post_meta($post_ID, $count_key);
         
        //Add a custom (meta) field (Name/value)to the specified post.
        add_post_meta($post_ID, $count_key, '0');
        return $count . ' View';
     
    //If the the Post Custom Field value is NOT empty.
    }else{
        $count++; //increment the counter by 1.
        //Update the value of an existing meta key (custom field) for the specified post.
        update_post_meta($post_ID, $count_key, $count);
         
        //If statement, is just to have the singular form 'View' for the value '1'
        if($count == '1'){
        return $count . ' View';
        }
        //In all other cases return (count) Views
        else {
        return $count . ' Views';
        }
    }
}
-------------------------------------------- use where want to display count ----------------------------------------------

<?php if(function_exists('bac_PostViews')) { 
    echo bac_PostViews(get_the_ID()); 
}






=============================================Change number or products per row=============================================


/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}



=================================== To diable link on woocomerce product in listing page =================================



/*To diable link on woocomerce product in listing page*/


add_filter('woocommerce_template_loop_product_link_open','mbc_remove_link_on_thumbnail' );

 function mbc_remove_link_on_thumbnail($html){
      return strip_tags($html,'<img>');
 }



/* other option */


 remove_action ('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
 remove_action ('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);





============================================ Custom field for image and text box ==========================================


/*For Image 1*/



// add necessary scripts
add_action('plugins_loaded', function(){
  if($GLOBALS['pagenow']=='post.php'){
    add_action('admin_print_scripts', 'my_admin_scripts');
    add_action('admin_print_styles',  'my_admin_styles');
  }
});

function my_admin_scripts(){
  wp_enqueue_script('jquery');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('thickbox');
}

// Proper way to enqueue
// wp_register_script(
//   'my-upload',
//   WP_PLUGIN_URL.'/my-script.js',
//   array('jquery','media-upload','thickbox') /* dependencies */
// );
//
// wp_enqueue_script('my-upload');

function my_admin_styles(){
  wp_enqueue_style('thickbox');
}




add_action(
  'add_meta_boxes',
  function(){
    add_meta_box(
      'my-metaboxx1', // ID
      'Image 1', // Title
      'func99999', // Callback (Construct function)
      'get_post_types()', //screen (This adds metabox to all post types)
      'normal' // Context
    );
 },
 9
);


function func99999($post){
  $url = get_post_meta($post->ID, 'my-image-for-post', true); ?>
  <input id="my_image_URL" name="my_image_URL" type="text"
         value="<?php echo $url;?>" style="width:400px;" />
  <input id="my_upl_button" type="button" value="Upload Image" /><br/>
  <img src="<?php echo $url;?>" style="width:200px;" id="picsrc" />
  <script>
  jQuery(document).ready( function($) {
    jQuery('#my_upl_button').click(function() {
      window.send_to_editor = function(html) {
        imgurl = jQuery(html).attr('src')
        jQuery('#my_image_URL').val(imgurl);
        jQuery('#picsrc').attr("src", imgurl);
        tb_remove();
      }

      formfield = jQuery('#my_image_URL').attr('name');
      tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true' );
      return false;
    }); // End on click
  });
  </script>
<?php
}

add_action('save_post', function ($post_id) {
  if (isset($_POST['my_image_URL'])){
    update_post_meta($post_id, 'my-image-for-post', $_POST['my_image_URL']);
  }
});



/* For Image 2 */


add_action(
  'add_meta_boxes',
  function(){
    add_meta_box(
      'my-metaboxx2', // ID
      'Image 2', // Title
      'func999991', // Callback (Construct function)
      get_post_types(), //screen (This adds metabox to all post types)
      'normal' // Context
    );
 },
 9
);


function func999991($post){
  $url1 = get_post_meta($post->ID, 'my-image-for-post1', true); ?>
  <input id="my_image_URL1" name="my_image_URL1" type="text"
         value="<?php echo $url1;?>" style="width:400px;" />
  <input id="my_upl_button1" type="button" value="Upload Image" /><br/>
  <img src="<?php echo $url1;?>" style="width:200px;" id="picsrc1" />
  <script>
  jQuery(document).ready( function($) {
    jQuery('#my_upl_button1').click(function() {
      window.send_to_editor = function(html) {
        imgurl1 = jQuery(html).attr('src')
        jQuery('#my_image_URL1').val(imgurl1);
        jQuery('#picsrc1').attr("src", imgurl1);
        tb_remove();
      }

      formfield = jQuery('#my_image_URL1').attr('name');
      tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true' );
      return false;
    }); // End on click
  });
  </script>
<?php
}

add_action('save_post', function ($post_id) {
  if (isset($_POST['my_image_URL1'])){
    update_post_meta($post_id, 'my-image-for-post1', $_POST['my_image_URL1']);
  }
});




/* For  Text field */


add_action(
  'add_meta_boxes',
  function(){
    add_meta_box(
      'category_link', // ID
      'Category Link', // Title
      'cat_fun', // Callback (Construct function)
      get_post_types(), //screen (This adds metabox to all post types)
      'normal' // Context
    );
 },
 9
);


function cat_fun($post){
  $link = get_post_meta($post->ID, 'my-cat-link', true); ?>
  <input id="my_cat_link" name="my_cat_link" type="text"
         value="<?php echo $link;?>" style="width:400px;" />
  
<?php
}

add_action('save_post', function ($post_id) {
  if (isset($_POST['my_cat_link'])){
    update_post_meta($post_id, 'my-cat-link', $_POST['my_cat_link']);
  }
});



======================================================= add custom field in post type ==================================================



/* add Custom Field to Post type*/

add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add()
{
    add_meta_box( 'my-meta-box-id', 'My First Meta Box', 'cd_meta_box_cb', 'hampers', 'normal', 'high' );   /*Hampers are used to get vale in hamper post type*/
} 




function cd_meta_box_cb()
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
    $text = isset( $values['my_meta_box_text'] ) ? $values['my_meta_box_text'] : '';
    $image1 = isset( $values['my_meta_box_image1'] ) ? $values['my_meta_box_image1'] : '';
    $image2 = isset( $values['my_meta_box_image2'] ) ? $values['my_meta_box_image2'] : '';
    $image3 = isset( $values['my_meta_box_image3'] ) ? $values['my_meta_box_image3'] : '';
    $image4 = isset( $values['my_meta_box_image4'] ) ? $values['my_meta_box_image4'] : '';
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
    ?>
    <p>
        <label for="my_meta_box_text">category link</label>
        <input type="text" name="my_meta_box_text" id="my_meta_box_text" value="<?php echo $text; ?>" />
    </p>
    <p>
        <label for="my_meta_box_image1">Image 1</label>
        <input type="file" name="my_meta_box_image1" id="my_meta_box_image1" value="<?php echo $image1; ?>" />
    </p>


    <p>
        <label for="my_meta_box_image2">Image 2</label>
        <input type="file" name="my_meta_box_image2" id="my_meta_box_image2" value="<?php echo $image2; ?>" />
    </p>


    <p>
        <label for="my_meta_box_image3">Image 3</label>
        <input type="file" name="my_meta_box_image3" id="my_meta_box_image3" value="<?php echo $image3; ?>" />
    </p>

    <p>
        <label for="my_meta_box_image4">Image 4</label>
        <input type="file" name="my_meta_box_image4" id="my_meta_box_image4" value="<?php echo $image4; ?>" />
    </p>
    <?php    
}




add_action( 'save_post', 'cd_meta_box_save' );
function cd_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['my_meta_box_text'] ) )
        update_post_meta( $post_id, 'my_meta_box_text', wp_kses( $_POST['my_meta_box_text'], $allowed ) );
         
    if( isset( $_POST['my_meta_box_image1'] ) )
        update_post_meta( $post_id, 'my_meta_box_image1', wp_kses( $_POST['my_meta_box_image1'], $allowed ) );

    if( isset( $_POST['my_meta_box_image2'] ) )
        update_post_meta( $post_id, 'my_meta_box_image2', wp_kses( $_POST['my_meta_box_image2'], $allowed ) );

    if( isset( $_POST['my_meta_box_image3'] ) )
        update_post_meta( $post_id, 'my_meta_box_image3', wp_kses( $_POST['my_meta_box_image3'], $allowed ) );

    if( isset( $_POST['my_meta_box_image4'] ) )
        update_post_meta( $post_id, 'my_meta_box_image4', wp_kses( $_POST['my_meta_box_image4'], $allowed ) );
}




 
====================================== /* To Provide Order Field in Custom Post Type */ ===================================


/**
* show custom order column values
*/
function show_order_column($name){
  global $post;
 
  switch ($name) {
    case 'menu_order':
      $order = $post->menu_order;
      echo $order;
      break;
   default:
      break;
   }
}
add_action('manage_portfolio_posts_custom_column','show_order_column');



/*Provde page-attributes in custom post type support parameter to see order field*/


=============================== Provide extra attibute in predefine post type suppots paramenter ==========================
/**
 * Enables the Excerpt meta box in Page edit screen.
 */
function wpcodex_add_excerpt_support_for_pages() {
	add_post_type_support( 'post', 'page-attributes' );
}
add_action( 'init', 'wpcodex_add_excerpt_support_for_pages' );



add_post_type_support( 'post_name', 'parameter_name' ); // Parameter can be 'excerpt','thumbnail' from support


 ================================================== Custom Post Type With Taxonomy ========================================


function np_init() {
    $args = array(
        'public' => true,
        'label' => 'Nivo Images',
        'supports' => array(
            'title',
            'thumbnail'
        )
    );
    register_post_type('np_images', $args);
}
add_action('init', 'np_init');


// Let us create Taxonomy for Custom Post Type
add_action( 'init', 'crunchify_create_deals_custom_taxonomy', 0 );
 
//create a custom taxonomy name it "type" for your posts
function crunchify_create_deals_custom_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'all_items' => __( 'All Types' ),
    'parent_item' => __( 'Parent Type' ),
    'parent_item_colon' => __( 'Parent Type:' ),
    'edit_item' => __( 'Edit Type' ), 
    'update_item' => __( 'Update Type' ),
    'add_new_item' => __( 'Add New Type' ),
    'new_item_name' => __( 'New Type Name' ),
    'menu_name' => __( 'Types' ),
  ); 	
 
  register_taxonomy('types',array('np_images'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));
}





============================================= Create Shortcode with parameters ============================================




function rscustom_shortcode( $atts, $content = null ) {

    // Extract variables from shortcode attributes: post type, id, taxonomy
    $a = shortcode_atts( array(
        'rspt' => '',
        'rsid' => '',
        'rstax' => '',
    ), $atts );

    $rspt = trim($a['rspt']);
    $rsid = trim($a['rsid']);
    $rstax = trim($a['rstax']);

    // Execute the Royal Slider Query Override
    add_filter('new_royalslider_posts_slider_query_args', 'newrs_custom_query', 10, $rsid);

    function newrs_custom_query($args) {

        $args = array( 
            'post_type' =>  'carousel-slide',
            'orderby' => array(
                'menu_order' => 'ASC'
            ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'carousel-slide-category',
                    'field'    => 'slug',
                    'terms'    => "$rstax", // THIS VARIABLE ISN'T PASSING INTO THE FUNCTION
                ),
            ),
        ); 
        return $args;
    };

    return get_new_royalslider($rsid);
}
add_shortcode( 'rscustom', 'rscustom_shortcode' );



==================================== Function To add Multiple Image Meta field in any post/page ===========================

function add_image_uploader_metabox()
{	
	add_meta_box(
		'image_uploader_metabox', // Unique ID of metabox
		esc_html__('Image Uploader Metabox', 'textdomain'), //Title of metabox
		'image_uploader_metaboxes', // Callback function
		'np_images',//'np_images', //name of your custom post type (here post is for wordpress posts.)
		'normal', //Context
		'default' //Priority
	);
}


function image_uploader_metaboxes($object, $box)
{
	wp_nonce_field ( basename ( __FILE__ ), 'image_uploader_metaboxes' );
	
	global $post;
	
	// Get WordPress' media upload URL
	$upload_link = esc_url( get_upload_iframe_src() );
	
	// See if there's a media id already saved as post meta
	$your_img_id = get_post_meta( get_the_ID(), '_your_img_id', true );
	
	// Get the image src
	$your_img_src = wp_get_attachment_image_src( $your_img_id, 'full' );
	
	// For convenience, see if the array is valid
	$you_have_img = is_array( $your_img_src );
	
 
?>
	<div id="custom-images">
		
		<div class="custom-img-container">
			
			<?php 
				$meta_values = get_post_meta( get_the_ID(), 'image_src', false );
				
				foreach ($meta_values as $value){
			?>
			
			
				<div class="image-wrapper">
					<input type="text" name="image_src[]" value="<?php echo $value;?>">
					<a class="delete-custom-img" href="#">Remove this image</a>
				</div>
				
			<?php }?>
			
		</div>
		
	</div>
		
	<p>
	
	    <a class="upload-custom-img <?php if ( $you_have_img  ) { echo 'hidden'; } ?>" href="<?php echo $upload_link; ?>">
	        <?php _e('Add custom image'); ?>
		</a>
    
	</p>
<?php } /*<!-- End image_uploader_metaboxes Function -->*/



function save_image_uploader_metadata( $post_id, $post )
{
 
	/* Verify the nonce before proceeding. */
		if ( !isset( $_POST['image_uploader_metaboxes'] ) || !wp_verify_nonce( $_POST['image_uploader_metaboxes'], basename( __FILE__ ) ) )
			return $post_id;
		
	/* Get the post type object. */
		$post_type = get_post_type_object( $post->post_type );
	
	/* Check if the current user has permission to edit the post. */
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
			return $post_id;
		
	/* Get the meta key. */
		$meta_key = 'image_src';
		
	/* Get the meta value of the custom field key. */
		$meta_value = get_post_meta( $post_id, $meta_key, false );
		
	/* For looping all meta values */
		foreach ($meta_value as $value){
			delete_post_meta( $post_id, $meta_key, $value );
		}
		
	/* Get the posted data and sanitize it for use as an HTML class. */
		foreach($_POST['image_src'] as $value){	
			add_post_meta( $post_id, $meta_key, $value, false );
		}
		
}

function enqueue_media(){
	wp_enqueue_media();
}


function include_js_code_for_uploader(){
?>
 
<!-- ****** JS CODE ******  -->
<script>
	jQuery(function($){
 
	  // Set all variables to be used in scope
	  var frame,
		  metaBox = $('#image_uploader_metabox.postbox'); // Your meta box id here
		  addImgLink = metaBox.find('.upload-custom-img');
		  imgContainer = metaBox.find( '.custom-img-container');
		  imgIdInput = metaBox.find( '.custom-img-id' );
		  customImgDiv = metaBox.find( '#custom-images' );
 
 
	  
	  // ADD IMAGE LINK
	  addImgLink.on( 'click', function( event ){
		
		event.preventDefault();
		
		// If the media frame already exists, reopen it.
		if ( frame ) {
		  frame.open();
		  return;
		}
		
		// Create a new media frame
		frame = wp.media({
		  title: 'Select or Upload Media Of Your Chosen Persuasion',
		  button: {
			text: 'Use this media'
		  },
		  multiple: false  // Set to true to allow multiple files to be selected
		});
 
		
		// When an image is selected in the media frame...
		frame.on( 'select', function() {
		  
		  // Get media attachment details from the frame state
		  var attachment = frame.state().get('selection').first().toJSON();
		  
		  // Send the attachment URL to our custom image input field.
		  imgContainer.append( '<div class="image-wrapper"><input type="text" name="image_src[]" value="'+attachment.url+'"> <a class="delete-custom-img" href="#">Remove this image</a></div>' );
		  
		});
 
		// Finally, open the modal on click
		frame.open();
	  });
 
	  
		customImgDiv.on ( 'click', '.delete-custom-img', function (event){		
			event.preventDefault();
			jQuery(event.target).parent().remove();		
 
		});
 
 
	});
 
</script>
 
<?php }



add_action ( 'admin_enqueue_scripts', 'enqueue_media' );
 
add_action( 'admin_head', 'include_js_code_for_uploader' );

add_action( 'add_meta_boxes', 'add_image_uploader_metabox' );
 
add_action( 'save_post', 'save_image_uploader_metadata', 10, 2 );



=============================================== Creating custom hook and action ===========================================


// i can has custom hook
function custom_hook() {
	do_action('custom_hook');
}




function hello_wordpress() {
	echo '<h1>Hello WordPress this is custom  hook test!</h1>';
}
add_action('custom_hook', 'hello_wordpress', 7);




/*<?php custom_hook(); ?> use this where you want to show the hook action at template file*/

================================================ Add featured post checkbox ===============================================



/*********************************************************************/
/* Add featured post checkbox
/********************************************************************/
add_action( 'add_meta_boxes', 'add_featured_checkbox_function' );
function add_featured_checkbox_function() {
	add_meta_box('featured_checkbox_id','FEATURED POST ?', 'featured_checkbox_callback_function', 'post', 'normal', 'high');
}
function featured_checkbox_callback_function( $post ) {
	global $post;
	$isFeatured=get_post_meta( $post->ID, 'is_featured', true );
?>
	
	<input type="checkbox" name="is_featured" value="yes" <?php echo (($isFeatured=='yes') ? 'checked="checked"': '');?>/> YES
<?php
}


add_action('save_post', 'save_featured_post'); 
function save_featured_post($post_id){ 
	update_post_meta( $post_id, 'is_featured', $_POST['is_featured']);
}


/*Functions to get value */
//option 1

Function 1: $meta_values = get_post_meta( $post_id, $key, $single );


$isFeatured=get_post_meta( $post->ID, 'is_featured', true );
echo $isFeatured;


//option 2
Function 2: $custom_fields = get_post_custom($post->ID);


$all_meta_fields= get_post_custom($post->ID);
 $isFeatured=$all_meta_fields["is_featured"][0];
 echo $isFeatured;



/*display featured posts on any page*/


global $post;

$isFeatured=get_post_meta( $post->ID, 'is_featured', true );
//echo $isFeatured;



	$args = array( 'post_type' => 'post', 'posts_per_page' => -1, 'orderby' => 'ID', 'order' => 'ASC', 'meta_query' => array(
        array(
            'key' => 'is_featured',
            'value' => 'yes'
        )
    ) );
	$lastposts = get_posts( $args );
		foreach($lastposts as $post)
			{ ?>
		
			<li>
				<div class="phototeam"> <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="photo" />
					<div class="teamcontent">
						<section>
							<p><?php echo $post->post_title; ?></p>
								  <span><?php echo get_post_meta(get_the_ID(),'is_featured',true); ?></span> 
						</section>
					</div>
				</div>
			</li>
<?php	} 

	wp_reset_postdata(); 



================================== Add Custom Field In user profile page in admin Side ====================================

/*To Show Fields in Admin Side*/


add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Extra profile information", "blank"); ?></h3>

<table class="form-table">
<tr>
<th><label for="address"><?php _e("Address"); ?></label></th>
<td>
<input type="text" name="address" id="address" value="<?php echo esc_attr( get_the_author_meta( 'address', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your address."); ?></span>
</td>
</tr>
<tr>
<th><label for="city"><?php _e("City"); ?></label></th>
<td>
<input type="text" name="city" id="city" value="<?php echo esc_attr( get_the_author_meta( 'city', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your city."); ?></span>
</td>
</tr>
<tr>
<th><label for="province"><?php _e("Province"); ?></label></th>
<td>
<input type="text" name="province" id="province" value="<?php echo esc_attr( get_the_author_meta( 'province', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your province."); ?></span>
</td>
</tr>
<tr>
<th><label for="postalcode"><?php _e("Postal Code"); ?></label></th>
<td>
<input type="text" name="postalcode" id="postalcode" value="<?php echo esc_attr( get_the_author_meta( 'postalcode', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your postal code."); ?></span>
</td>
</tr>
</table>
<?php }


/* To Save The Field Value*/

add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {

if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

update_user_meta( $user_id, 'address', $_POST['address'] );
update_user_meta( $user_id, 'city', $_POST['city'] );
update_user_meta( $user_id, 'province', $_POST['province'] );
update_user_meta( $user_id, 'postalcode', $_POST['postalcode'] );
}


=================================================== Login And Logout menu =================================================

function my_wp_nav_menu_args( $args = '' ) {
 
if( is_user_logged_in() ) { 
    $args['menu'] = 'LogIn Menu';   /*If User is login Show this menu*/
} else { 
    $args['menu'] = 'logout Menu';    /*If user Is Logout Show this menu*/
} 
    return $args;
}
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );



============================================== User Can See its own images only ===========================================

/*User Can See its own images only*/

add_action('pre_get_posts','users_own_attachments');
function users_own_attachments( $wp_query_obj ) {

    global $current_user, $pagenow;

    $is_attachment_request = ($wp_query_obj->get('post_type')=='attachment');

    if( !$is_attachment_request )
        return;

    if( !is_a( $current_user, 'WP_User') )
        return;

    if( !in_array( $pagenow, array( 'upload.php', 'admin-ajax.php' ) ) )
        return;

    if( !current_user_can('delete_pages') )
        $wp_query_obj->set('author', $current_user->ID );

    return;
}


================================== Disable admin toolbar for all user accept administrator ================================

/*Disable admin toolbar for all user accept administrator*/

add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}


============================================ Login logout in primary menu bar =============================================

/* Login logout in primary menu bar */

function add_login_logout_register_menu( $items, $args ) {
 if ( $args->theme_location != 'primary' ) {
 return $items;
 }
 
 if ( is_user_logged_in() ) {
 $items .= '<li><a href="' . wp_logout_url() . '">' . __( 'Log Out' ) . '</a></li>';
 } else {
 $items .= '<li><a href="' . wp_login_url() . '">' . __( 'Login In / Sign Up' ) . '</a></li>';
 //$items .= '<li><a href="' . wp_registration_url() . '">' . __( 'Sign Up' ) . '</a></li>';
 }
 
 return $items;
}
 
add_filter( 'wp_nav_menu_items', 'add_login_logout_register_menu', 199, 2 );


======================================= Remove Capability of particular User role =========================================

$wp_roles->remove_cap( 'visitor', 'upload_files' );
$wp_roles->remove_cap( 'visitor', 'switch_themes' );



=========================================== remove dashboard access to users ==============================================

/*remove dashboard access to users*/

/* current_user_can('subscriber') || current_user_can('visitor')*/

function dashboard_access_restricted(){  
  if( is_admin() && !defined('DOING_AJAX') && ( current_user_can('subscriber') || current_user_can('visitor') ) ){
    wp_redirect(home_url());
    exit;
  }
}
add_action('init','dashboard_access_restricted');



============================================== Add Capability Using Function ==============================================



if ( current_user_can('visitor') && !current_user_can('switch_themes') )
    add_action('admin_init', 'allow_contributor_uploads');
function allow_contributor_uploads() {
    $contributor = get_role('visitor');
    $contributor->add_cap('switch_themes');
}

if ( current_user_can('suscriber') && !current_user_can('upload_files') )
    add_action('admin_init', 'allow_subsriber_uploads');
function allow_subsriber_uploads() {
    $suscriber = get_role('suscriber');
    $suscriber->add_cap('upload_files');
}





======================================== Restrict User to see posts Except Defaults =======================================


/*For Subscriber*/

add_filter('template_include', 'restrict_by_category');

function check_user() {
  $user = wp_get_current_user();
  if ( ! $user->ID || in_array('subscriber', $user->roles) ) {
    // user is not logged or is a subscriber
    return false;
  }
  return true;
}

function restrict_by_category( $template ) {
  if ( ! is_main_query() ) return $template; // only affect main query.
  $allow = true;
  $private_categories = array('standard', 'advanced'); // categories subscribers cannot see
  if ( is_single() ) {
    $cats = wp_get_object_terms( get_queried_object()->ID, 'category', array('fields' => 'slugs') ); // get the categories associated to the required post
    if ( array_intersect( $private_categories, $cats ) ) {
      // post has a reserved category, let's check user
      $allow = check_user();
    }
  } elseif ( is_tax('category', $private_categories) ) {
    // the archive for one of private categories is required, let's check user
    $allow = check_user();
  }
  // if allowed include the required template, otherwise include the 'not-allowed' one
  return $allow ? $template : get_template_directory() . '/not_allowed_user.php';
}


========================================= Function To insert new post by code =============================================


$title= " Post Title Name ";
$content = "Demo Content"
$id = wp_insert_post(array(
    'post_title'=> $title, 
    'post_content' => $content,
    'post_type'=>'orders', 
    'post_content'=>'demo text',
    'post_status' => 'publish'
    ));


/*add Post meta fields Value also*/

add_post_meta($id, 'meta_field', $field_value, true);
add_post_meta($id, 'meta_field1', $field_value1, true);




============================================= Get Post By user id as term_id ==============================================


$user_id = get_current_user_id();

	$args = array( 'post_type' => 'orders', 'posts_per_page' => 1, 'orderby' => 'ID', 'order' => 'DESC','meta_query' => array(
            array(
                'key' => 'plan_user_id',
                'value' => $user_id
            	)
        	)
		);   
// if you want to sort post by order which come first use 'orderby' => 'menu_order',
$the_query = new WP_Query( $args ); 
if ( $the_query->have_posts() ) :
while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

		 <div> 
			<h4><?php the_title(); ?></h4>
			<p><?php the_content(); ?></p>
					

	<?php 
	wp_reset_postdata();
	endwhile;
	endif;  

==================================== Associate one post with another custom post type =====================================



add_action('admin_init', 'associated_posts_add_metabox');

function associated_posts_add_metabox(){
    add_meta_box( 
        'offer_post', 
        __('Associated Posts', 'bandpress'), 
        'associated_posts_metabox', 
        'offers', 
        'side', 
        'default'
        //array( 'id' => 'p2p2_author') 
    );
}


function associated_posts_metabox($post, $args){
    wp_nonce_field( plugin_basename( __FILE__ ), 'associated_posts_nonce' );
    $associated_posts = get_post_meta($post->ID, 'associated_posts', true);

    echo "<p>Select the post to associated with this offer</p>";
    echo "<select id='associated_posts' name='associated_posts'>";
    // Query the authors here
    $query = new WP_Query( 'post_type=post' );
    while ( $query->have_posts() ) {
        $query->the_post();
        $id = get_the_ID();
        $selected = "";

        if($id == $associated_posts){
            $selected = ' selected="selected"';
        }
        echo '<option' . $selected . ' value=' . $id . '>' . get_the_title() . '</option>';
    }
    echo "</select>";
}

add_action('save_post', 'save_associated_posts_metabox', 1, 2);

function save_associated_posts_metabox($post_id, $post){
    // Don't wanna save this now, right?
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if ( !isset( $_POST['associated_posts_nonce'] ) )
        return;
    if ( !wp_verify_nonce( $_POST['associated_posts_nonce'], plugin_basename( __FILE__ ) ) )
        return;

    // We do want to save? Ok!
    $key = 'associated_posts';
    $value = $_POST["associated_posts"];
    if ( get_post_meta( $post->ID, $key, FALSE ) ) { // If the custom field already has a value
        update_post_meta( $post->ID, $key, $value );
    } else { // If the custom field doesn't have a value
        add_post_meta( $post->ID, $key, $value );
    }
    if ( !$value ) delete_post_meta( $post->ID, $key ); // Delete if blank
}




==================================== Change predefine post type slug to another using Function ============================



function change_post_types_slug( $args, $post_type ) {

   /*item post type slug*/   
   if ( 'ptta-portfolio' === $post_type ) {  // Change post typr slug  ptta-portfolio to portfolio
      $args['rewrite']['slug'] = 'portfolio';
   }

   return $args;
}
add_filter( 'register_post_type_args', 'change_post_types_slug', 10, 2 );



============= Function to add first image of the post as featured image of the post =============

function auto_featured_image() {
    global $post;
 
    if (!has_post_thumbnail($post->ID)) {
        $attached_image = get_children( "post_parent=$post->ID&amp;post_type=attachment&amp;post_mime_type=image&amp;numberposts=1" );
         
      if ($attached_image) {
              foreach ($attached_image as $attachment_id => $attachment) {
                   set_post_thumbnail($post->ID, $attachment_id);
              }
         }
    }
}
// Use it temporary to generate all featured images
add_action('the_post', 'auto_featured_image');
// Used for new posts
add_action('save_post', 'auto_featured_image');
add_action('draft_to_publish', 'auto_featured_image');
add_action('new_to_publish', 'auto_featured_image');
add_action('pending_to_publish', 'auto_featured_image');
add_action('future_to_publish', 'auto_featured_image');


================================================================================================

============================ Get post taxonomy name using post type =============================


$taxonomy_name = get_object_taxonomies( array( 'post_type' => 'post_type_name' ) );
or
$taxonomy_name = get_object_taxonomies( array( 'post_type' => $posttypename ) ); 
or
$taxonomy_name = get_object_taxonomies( array( 'post_type' => get_post_type() ) )

$taxonamy_name_new = $taxonomy_name['0'];





===========================================================================================================================

