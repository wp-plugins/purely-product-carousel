<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*
Plugin Name: Product Carousel
Plugin URI: http://purelythemes.com/product-carousel
Description: WooCommerce Product Carousel with options 
Version: 1.0.1
Author: PurelyThemes
Author URI: http://www.purelythemes.com
License: GNU GPLv2
*/

class purely_product_carousel extends WP_Widget {

	// constructor
	function purely_product_carousel() {
		parent::__construct(false, $name = __('Product Carousel', 'purely_product_carousel') );
	}


	// widget form creation
	function form($instance) {

	// Check values
	if( $instance) {
		$title = esc_attr($instance['title']);
		$product_num = esc_attr($instance['product_num']);
		$toggle_free = esc_attr($instance['toggle_free']);
		$column_num = esc_attr($instance['column_num']);
		$column_scroll = esc_attr($instance['column_scroll']);
		$list_orderby = esc_attr($instance['list_orderby']);
		$list_types = esc_attr($instance['list_types']);
		$list_category = esc_attr($instance['list_category']);
		$list_order = esc_attr($instance['list_order']);
		$list_description = esc_attr($instance['list_description']);
		$list_rating = esc_attr($instance['list_rating']);
	} else {
		$title = '';
		$list_category = '';
		$product_num = '';
		$toggle_free = '';
		$column_num = '';
		$column_scroll = '';
		$list_types = '';
		$list_orderby = '';
		$list_order = '';
		$list_description = '';
		$list_rating = '';
	}
	?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'purely_product_carousel'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('product_num'); ?>"><?php _e('Number of products:', 'purely_product_carousel'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('product_num'); ?>" name="<?php echo $this->get_field_name('product_num'); ?>" type="text" value="<?php echo $product_num; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('column_num'); ?>"><?php _e('Column count:', 'purely_product_carousel'); ?></label>
			<select name="<?php echo $this->get_field_name('column_num'); ?>" id="<?php echo $this->get_field_id('column_num'); ?>" class="widefat">
				<?php
					$options = array('3', '4', '5', '6');
					foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $column_num == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('column_scroll'); ?>"><?php _e('Items to scroll:', 'purely_product_carousel'); ?></label>
			<select name="<?php echo $this->get_field_name('column_scroll'); ?>" id="<?php echo $this->get_field_id('column_scroll'); ?>" class="widefat">
				<?php
					$options = array('1', '2', '3', '4', '5', '6');
					foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $column_scroll == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('list_types'); ?>"><?php _e('Product Types:', 'purely_product_carousel'); ?></label>
			<select name="<?php echo $this->get_field_name('list_types'); ?>" id="<?php echo $this->get_field_id('list_types'); ?>" class="widefat">
				<?php
					$options = array('all', 'featured', 'onsale');
					foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $list_types == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
				?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('list_orderby'); ?>"><?php _e('List Order By', 'purely_product_carousel'); ?></label>
			<select name="<?php echo $this->get_field_name('list_orderby'); ?>" id="<?php echo $this->get_field_id('list_orderby'); ?>" class="widefat">
				<?php
					$options = array('date','price', 'random', 'sales');
					foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $list_orderby == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('list_category'); ?>"><?php _e('Categories to show (comma separate)', 'purely_product_carousel'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('list_category'); ?>" name="<?php echo $this->get_field_name('list_category'); ?>" type="text" value="<?php echo $list_category; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('list_order'); ?>"><?php _e('List Order', 'purely_product_carousel'); ?></label>
			<select name="<?php echo $this->get_field_name('list_order'); ?>" id="<?php echo $this->get_field_id('list_order'); ?>" class="widefat">
				<?php
					$options = array('asc','desc');
					foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $list_order == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
				?>
			</select>
		</p>
		
		<p>
			<input id="<?php echo $this->get_field_id('list_description'); ?>" name="<?php echo $this->get_field_name('list_description'); ?>" type="checkbox" value="1" <?php checked( '1', $list_description ); ?> />
			<label for="<?php echo $this->get_field_id('list_description'); ?>"><?php _e('Show Description?', 'purely_product_carousel'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('list_rating'); ?>" name="<?php echo $this->get_field_name('list_rating'); ?>" type="checkbox" value="1" <?php checked( '1', $list_rating ); ?> />
			<label for="<?php echo $this->get_field_id('list_rating'); ?>"><?php _e('Show Rating?', 'purely_product_carousel'); ?></label>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id('toggle_free'); ?>" name="<?php echo $this->get_field_name('toggle_free'); ?>" type="checkbox" value="1" <?php checked( '1', $toggle_free ); ?> />
			<label for="<?php echo $this->get_field_id('toggle_free'); ?>"><?php _e('Hide Free Products?', 'purely_product_carousel'); ?></label>
		</p>
		
		
	<?php
	}

	// update widget
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
    // Fields
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['product_num'] = strip_tags($new_instance['product_num']);
		$instance['toggle_free'] = strip_tags($new_instance['toggle_free']);
		$instance['column_num'] = strip_tags($new_instance['column_num']);
		$instance['column_scroll'] = strip_tags($new_instance['column_scroll']);
		$instance['list_types'] = strip_tags($new_instance['list_types']);
		$instance['list_orderby'] = strip_tags($new_instance['list_orderby']);
		$instance['list_order'] = strip_tags($new_instance['list_order']);
		$instance['list_description'] = strip_tags($new_instance['list_description']);
		$instance['list_category'] = strip_tags($new_instance['list_category']);
		$instance['list_rating'] = strip_tags($new_instance['list_rating']);
	return $instance;
	}


	// display widget
	function widget($args, $instance) {
	
		extract( $args );
	// these are the widget options
		if (!empty($instance['title'])) { $title = apply_filters('widget_title', $instance['title']);}
		if (!empty($instance['product_num'])) { $product_num = $instance['product_num'];}
		if (!empty($instance['list_types'])) { $list_types = $instance['list_types'];}
		if (!empty($instance['toggle_free'])) { $toggle_free = $instance['toggle_free'];}
		if (!empty($instance['column_num'])) { $column_num = $instance['column_num'];}
		if (!empty($instance['column_scroll'])) { $column_scroll = $instance['column_scroll'];}
		if (!empty($instance['list_orderby'])) { $list_orderby = $instance['list_orderby'];}
		$list_category = $instance['list_category'];
		if (!empty($instance['list_order'])) { $list_order = $instance['list_order']; }
		if (!empty($instance['list_description'])) { $list_description = $instance['list_description']; }
		if (!empty($instance['list_rating'])) { $list_rating = $instance['list_rating']; }
		
		echo $before_widget;
	// Display the widget
		echo '<div class="widget-text purely_product_carousel_box carousel-'.$column_num.'-columns">';
	// Check if title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
	// Check if textarea is set
		?>
		
	<!-- Dynamic Argument Setup -->	
		
		<?php 
		$args = array(
						'post_type' => 'product',
						'post_status'    => 'publish',
						'posts_per_page' => $product_num,
						'order' => $list_order,
						'product_cat' => $list_category,
						'meta_query'     => array()
					);
		
		if ( ! empty( $instance['toggle_free'] ) ) {
			$args['meta_query'][] = array(
				'key'     => '_price',
				'value'   => 0,
				'compare' => '>',
				'type'    => 'DECIMAL',
			);
		}
		
		$args['meta_query'][] = WC()->query->stock_status_meta_query();
		$args['meta_query']   = array_filter( $args['meta_query'] );
		switch ( $list_types ) {
		
			case 'featured' :
				$args['meta_query'][] = array(
					'key'   => '_featured',
					'value' => 'yes'
				);
				break;
			case 'onsale' :
				$product_ids_on_sale    = wc_get_product_ids_on_sale();
				$product_ids_on_sale[]  = 0;
				$args['post__in'] = $product_ids_on_sale;
				break;
		}
		
		switch ( $list_orderby ) {
			case 'price' :
				$args['meta_key'] = '_price';
				$args['orderby']  = 'meta_value_num';
				break;
			case 'random' :
				$args['orderby']  = 'rand';
				break;
			case 'sales' :
				$args['meta_key'] = 'total_sales';
				$args['orderby']  = 'meta_value_num';
				break;
			case 'date' :
				$args['orderby']  = 'date';
				break;
		}

		?>
		
	<!-- Query with the dynamic arguments -->	
		<div class="purely-carousel-wrapper" data-slick='{"slidesToShow": <?php echo $column_num; ?>, "slidesToScroll": <?php echo $column_scroll; ?>}'>
			<?php
			
				$loop = new WP_Query( $args );
					if ( $loop->have_posts() ) {
						while ( $loop->have_posts() ) : $loop->the_post();
						global $product;
			?>
			
			<div class="purely-carousel-item">
					<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
						<?php echo $product->get_image( array(300,300)); ?>
						<span class="product-title"><?php echo $product->get_title(); ?></span>
						<?php if ( ! empty( $list_rating ) ) 
							echo $product->get_rating_html(); 
						?>
					</a>
			
			<?php 
				echo $product->get_price_html(); 
			?>
			<?php if ( ! empty( $list_description ) ) 
			
			?>
				<div class="purely-carousel-description">
					<?php 
					$excerpt = apply_filters( 'the_excerpt', get_post_field('post_excerpt', $product->id) );
					
					echo substr($excerpt,0, 110);
					?>
				</div>
			
			</div>
			<?php
				endwhile;
					} else {
					echo __( 'No products found' );
					}
					wp_reset_postdata();
			?>
		<?php
			echo '</div>';
			echo $after_widget;
	}

}


// register widget
add_action('widgets_init', create_function('', 'return register_widget("purely_product_carousel");'));

function product_carousel_css() {
		wp_register_style('product_carousel_css', plugins_url('purely-product-carousel.css', __FILE__));
		wp_enqueue_style('product_carousel_css');
		wp_register_script('product_carousel_slick', plugins_url('slick.js', __FILE__), array('jquery'));
		wp_enqueue_script('product_carousel_slick');
		wp_register_script('product_carousel_script', plugins_url('purely-product-carousel.js', __FILE__), array('jquery'));
		wp_enqueue_script('product_carousel_script');

	}
add_action( 'wp_enqueue_scripts', 'product_carousel_css' );  	
	