<?php
/*  Copyright 2014 Site2Quotes. 

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/*
Plugin Name: Quote of the Day - Site2Quotes
Plugin URI: http://site2quotes.com/widgets
Description: Show your website visitors quote of the day in your site's sidebar or any other widget area. To install, click activate and then go to Appearance > Widgets and look for the 'Quote of the Day - Site2Quotes'. Then, drag the widget to your sidebar or any other area where you would like to Show Quote of the Day Widget and can select the quote types of your choice.
Version: 1.0
Author: Site2Quotes
Author URI: http://site2quotes.com
*/

/**
 * Adds Quote of the Day widget.
 */
class QuoteOfDay_Site2Quotes extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'site2quotes_widget', // Base ID
			__('Quote of the Day - Site2Quotes', 'text_domain'), // Name
			array( 'description' => __( 'Display quote of the day on your website/blog automatically updated everyday!', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$qtype = apply_filters('widget_title', $instance['qtype']);
$qdisplay = apply_filters('widget_title', $instance['qdisplay']);

                $title_hash = array(
                     "none" => "Select Category",
					 "any" => "All",
                     "love" => "Love Quotes (Popular)",
                     "inspirational" => "Inspirational Quotes (Popular)",
                     "funny" => "Funny Quotes",
					 "friendship" => "Friendship Quotes",
					 "life" => "Life Quotes",
					 "motivational" => "Motivational Quotes",
					 "birthday" => "Birthday Quotes",
					 "famous" => "Famous Quotes",
					 "relationship" => "Relationship Quotes",
					 "positive" => "Positive Quotes",
					 "sad" => "Sad Quotes",
					 "happiness" => "Happiness Quotes",
					 "family" => "Family Quotes",
					 "smile" => "Smile Quotes",
					 "best" => "Best Quotes",
					 "success" => "Success Quotes",
					 "romantic" => "Romantic Quotes",
					 "good" => "Good Quotes",
					 "anniversary" => "Anniversary Quotes",
					 "attitude" => "Attitude Quotes",
					 "trust" => "Trust Quotes",
                 );

		echo $args['before_widget'];
		if ( ! empty( $qtype) )
			//echo $args['before_title'] . $title_hash[$qtype]. $args['after_title'];
$webpageurl=$_SERVER[REQUEST_URI];
$website=$_SERVER[SERVER_NAME];
$visitorip=$_SERVER[REMOTE_ADDR];
		$resp = wp_remote_get('http://api.site2quotes.com/wp/quotations.aspx?category=' .$qtype. '&qdisplay=' .$qdisplay. '&visitorip=' .$visitorip. '&domain=' .$website. '&webpage=' .$webpageurl. '' );
if ( 200 == $resp['response']['code'] ) {
$body = $resp['body'];
echo __($body,'text_domain');
// perform action with the content.
}

		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'qtype' ] ) ) {
			$qtype = $instance[ 'qtype' ];
		}
		else {
			$qtype = "day";
		}
        if ( isset( $instance[ 'qdisplay' ] ) ) {
			$qdisplay = $instance[ 'qdisplay' ];
		}
		else {
			$qdisplay = "image";
		}
		?>
	         <p>
			<select id="<?php echo $this->get_field_id( 'qtype' ); ?>" name="<?php echo $this->get_field_name( 'qtype' ); ?>" class="widefat" style="width:100%;">
				<option value="none" <?php if ( 'none' == $qtype ) echo 'selected="selected"'; ?>>Select Category</option>
				<option value="any" <?php if ( 'any' == $qtype ) echo 'selected="selected"'; ?>>Show Quotes of any Category</option>
				<option value="love" <?php if ( 'love' == $qtype ) echo 'selected="selected"'; ?>>Love Quotes (Popular)</option>
				<option value="inspirational" <?php if ( 'inspirational' == $qtype ) echo 'selected="selected"'; ?>>Inspirational Quotes (Popular)</option>
				<option value="funny" <?php if ( 'funny' == $qtype ) echo 'selected="selected"'; ?>>Funny Quotes</option>
				<option value="friendship" <?php if ( 'friendship' == $qtype ) echo 'selected="selected"'; ?>>Friendship Quotes</option>
				<option value="life" <?php if ( 'life' == $qtype ) echo 'selected="selected"'; ?>>Life Quotes</option>
				<option value="motivational" <?php if ( 'motivational' == $qtype ) echo 'selected="selected"'; ?>>Motivational Quotes</option>
				<option value="birthday" <?php if ( 'birthday' == $qtype ) echo 'selected="selected"'; ?>>Birthday Quotes</option>
				<option value="famous" <?php if ( 'famous' == $qtype ) echo 'selected="selected"'; ?>>Famous Quotes</option>
				<option value="relationship" <?php if ( 'relationship' == $qtype ) echo 'selected="selected"'; ?>>Relationship Quotes</option>
				<option value="positive" <?php if ( 'positive' == $qtype ) echo 'selected="selected"'; ?>>Positive Quotes</option>
				<option value="sad" <?php if ( 'sad' == $qtype ) echo 'selected="selected"'; ?>>Sad Quotes</option>
				<option value="happiness" <?php if ( 'happiness' == $qtype ) echo 'selected="selected"'; ?>>Happiness Quotes</option>
				<option value="family" <?php if ( 'family' == $qtype ) echo 'selected="selected"'; ?>>Family Quotes</option>
				<option value="smile" <?php if ( 'smile' == $qtype ) echo 'selected="selected"'; ?>>Smile Quotes</option>
				<option value="best" <?php if ( 'best' == $qtype ) echo 'selected="selected"'; ?>>Best Quotes</option>
				<option value="success" <?php if ( 'success' == $qtype ) echo 'selected="selected"'; ?>>Success Quotes</option>
				<option value="romantic" <?php if ( 'romantic' == $qtype ) echo 'selected="selected"'; ?>>Romantic Quotes</option>
				<option value="good" <?php if ( 'good' == $qtype ) echo 'selected="selected"'; ?>>Good Quotes</option>
				<option value="anniversary" <?php if ( 'anniversary' == $qtype ) echo 'selected="selected"'; ?>>Anniversary Quotes</option>
				<option value="attitude" <?php if ( 'attitude' == $qtype ) echo 'selected="selected"'; ?>>Attitude Quotes</option>
				<option value="trust" <?php if ( 'trust' == $qtype ) echo 'selected="selected"'; ?>>Trust Quotes</option>
			</select>
            <label for="<?php echo $this->get_field_id( 'qdisplay' ); ?>">Select Display Type:</label> 
			<select id="<?php echo $this->get_field_id( 'qdisplay' ); ?>" name="<?php echo $this->get_field_name( 'qdisplay' ); ?>" class="widefat" style="width:100%;">
            <option value="image" <?php if ( 'image' == $qdisplay ) echo 'selected="selected"'; ?>>Image</option>
			<option value="text" <?php if ( 'text' == $qdisplay ) echo 'selected="selected"'; ?>>Text</option>
            </select>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['qtype'] = ( ! empty( $new_instance['qtype'] ) ) ? strip_tags( $new_instance['qtype'] ) : '';
$instance['qdisplay'] = ( ! empty( $new_instance['qdisplay'] ) ) ? strip_tags( $new_instance['qdisplay'] ) : '';
		return $instance;
	}


} // class QuoteOfDay_Site2Quotes

// register QuoteOfDay_Site2Quotes widget
function register_site2quotes_widget() {
    register_widget( 'QuoteOfDay_Site2Quotes' );
}
add_action( 'widgets_init', 'register_site2quotes_widget' );
?>
