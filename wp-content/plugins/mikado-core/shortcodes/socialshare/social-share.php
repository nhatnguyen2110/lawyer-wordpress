<?php
namespace Libero\Modules\SocialShare;

use Libero\Modules\Shortcodes\Lib\ShortcodeInterface;

class SocialShare implements ShortcodeInterface {

	private $base;
	private $socialNetworks;

	function __construct() {
		$this->base = 'mkd_social_share';
		$this->socialNetworks = array(
			'facebook',
			'twitter',
			'linkedin',
			'tumblr',
			'pinterest',
			'vk'
		);
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function getSocialNetworks() {
		return $this->socialNetworks;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	public function vcMap() {

		vc_map(array(
			'name' => esc_html__( 'Mikado Social Share', 'mikado-core' ),
			'base' => $this->getBase(),
			'icon' => 'icon-wpb-social-share extended-custom-icon',
			'category' => esc_html__( 'by MIKADO', 'mikado-core' ),
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Type', 'mikado-core' ),
					'param_name' => 'type',
					'admin_label' => true,
					'description' => esc_html__( 'Choose type of Social Share', 'mikado-core' ),
					'value' => array(
						esc_html__('List', 'mikado-core' ) => 'list',
						esc_html__('Dropdown', 'mikado-core' ) => 'dropdown'
					),
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Icons Type', 'mikado-core' ),
					'param_name' => 'icon_type',
					'admin_label' => true,
					'description' => esc_html__( 'Choose type of Icons', 'mikado-core' ),
					'value' => array(
						esc_html__('Normal', 'mikado-core' ) => 'normal',
						esc_html__('Circle', 'mikado-core' ) => 'circle'
					),
					'save_always' => true
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icons Color', 'mikado-core' ),
					'param_name' => 'icons_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Icons Hover Color', 'mikado-core' ),
					'param_name' => 'icons_hover_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Text Color', 'mikado-core' ),
					'param_name' => 'text_color',
				),
				array(
					'type' => 'colorpicker',
					'heading' => esc_html__( 'Border Color', 'mikado-core' ),
					'param_name' => 'border_color',
					'dependency' => array('element' => 'type', 'value' => array('list'))
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Number of Icons Shown', 'mikado-core' ),
					'param_name' => 'no_shown',
					'description' => esc_html__( 'Enter number of social icons to show (icons shown are the ones enabled globaly)', 'mikado-core' ),
					'dependency' => array('element' => 'type', 'value' => array('list'))
				)
			)
		));
	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {

		$args = array(
			'type'				=> 'list',
			'icon_type'			=> 'normal',
			'icons_color'		=> '',
			'icons_hover_color'	=> '',
			'text_color'		=> '',
			'border_color'		=> '',
			'links_showing'		=> '',
			'no_shown'			=> ''
		);

		//Shortcode Parameters
		$params = shortcode_atts($args, $atts);

		//Is social share enabled
		$params['enable_social_share'] = (libero_mikado_options()->getOptionValue('enable_social_share') == 'yes') ? true : false;

		//Is social share enabled for post type
		$post_type = get_post_type();
		$params['enabled'] = (libero_mikado_options()->getOptionValue('enable_social_share_on_'.$post_type)) ? true : false;

		//Social Networks Data
		$params['networks'] = $this->getSocialNetworksParams($params);

		$html = '';

		if ($params['enable_social_share']) {
			if ($params['enabled']) {
				$html .= mkd_core_get_core_shortcode_template_part('templates/' . $params['type'], 'socialshare', '', $params);
			}
		}

		return $html;

	}


	/**
	 * Get Social Icons style
	 * return string
	 *
	 */

	private function getSocialIconStyle($params){
		$icons_style = '';
		if ($params['icons_color'] !== ''){
			$icons_style .= libero_mikado_get_inline_style('color: '.$params['icons_color']).' ';
		}

		if ($params['icons_hover_color'] !== ''){
			$icons_style .= libero_mikado_get_inline_attr($params['icons_hover_color'],'data-hover-color');
		}

		return $icons_style;
	}

	/**
	 * Get Social Icons Text style
	 * return string
	 *
	 */

	private function getSocialTextStyle($params){
		$text_style = '';
		if ($params['text_color'] !== ''){
			$text_style = 'color: '.$params['text_color'];
		}

		return $text_style;
	}

	/**
	 * Get Social style
	 * return string
	 *
	 */

	private function getSocialStyle($params){
		$style = '';
		if ($params['border_color'] !== ''){
			$style = 'border-color: '.$params['border_color'];
		}

		return $style;
	}

	/**
	 * Get Social Networks data to display
	 * @return array
	 */
	private function getSocialNetworksParams($params) {

		$networks = array();
		$icons_type = $params['icon_type'];
		$params_for_style = $params;

		foreach ($this->socialNetworks as $net) {

			$html = '';
			if (libero_mikado_options()->getOptionValue('enable_'.$net.'_share') == 'yes') {

				$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				$params = array(
					'name' => $net
				);
				$params['link'] = $this->getSocialNetworkShareLink($net, $image);
				$params['text'] = $this->getSocialNetworkShareText($net);
				$params['icon'] = $this->getSocialNetworkIcon($net, $icons_type);
				$params['icons_style'] = $this->getSocialIconStyle($params_for_style);
				$params['text_style'] = $this->getSocialTextStyle($params_for_style);
				$params['social_style'] = $this->getSocialStyle($params_for_style);
				$params['custom_icon'] = (libero_mikado_options()->getOptionValue($net.'_icon')) ? libero_mikado_options()->getOptionValue($net.'_icon') : '';
				$html = mkd_core_get_core_shortcode_template_part('templates/parts/network', 'socialshare', '', $params);

			}
			if ($html !== '') {
				$networks[$net] = $html;
			}

		}

		return $networks;

	}

	/**
	 * Get share link for networks
	 *
	 * @param $net
	 * @param $image
	 * @return string
	 */
	private function getSocialNetworkShareLink($net, $image) {

		$net_image = ! empty( $image ) && isset( $image[0] ) ? $image[0] : '';

		switch ($net) {
			case 'facebook':
				if(wp_is_mobile()) {
					$link = 'window.open(\'https://m.facebook.com/sharer.php?u=' . urlencode(get_permalink()) .'\');';
				} else {
					$link = 'window.open(\'https://www.facebook.com/sharer.php?s=100&amp;p[title]=' . urlencode(get_the_title()) . '&amp;p[url]=' . urlencode(get_permalink()) . '&amp;p[images][0]=' . $net_image . '&amp;p[summary]=' . urlencode(get_the_excerpt()) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
				}
				break;
			case 'twitter':
				$count_char = (isset($_SERVER['https'])) ? 23 : 22;
				$twitter_via = (libero_mikado_options()->getOptionValue('twitter_via') !== '') ? ' via ' . libero_mikado_options()->getOptionValue('twitter_via') . ' ' : '';
				$link = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode(libero_mikado_the_excerpt_max_charlength($count_char) . $twitter_via) . ' ' . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				break;
			case 'linkedin':
				$link = 'popUp=window.open(\'https://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'tumblr':
				$link = 'popUp=window.open(\'https://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'pinterest':
				$link = 'popUp=window.open(\'https://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . urlencode(get_the_title()) . '&amp;media=' . urlencode($net_image) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'vk':
				$link = 'popUp=window.open(\'https://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($net_image) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			default:
				$link = '';
		}

		return $link;

	}

	private function getSocialNetworkIcon($net, $type) {

		switch ($net) {
			case 'facebook':
				$icon = ( $type == 'circle' ) ? 'social_facebook_circle' : 'social_facebook';
				break;
			case 'twitter':
				$icon = ( $type == 'circle' ) ? 'social_twitter_circle' : 'social_twitter';
				break;
			case 'linkedin':
				$icon = ( $type == 'circle' ) ? 'social_linkedin_circle' : 'social_linkedin';
				break;
			case 'tumblr':
				$icon = ( $type == 'circle' ) ? 'social_tumblr_circle' : 'social_tumblr';
				break;
			case 'pinterest':
				$icon = ( $type == 'circle' ) ? 'social_pinterest_circle' : 'social_pinterest';
				break;
			case 'vk':
				$icon = 'fa fa-vk';
				break;
			default:
				$icon = '';
		}

		return $icon;

	}


	/**
	 * Get titles for networks
	 *
	 * @param $net
	 * @return string
	 */
	private function getSocialNetworkShareText($net) {

		switch ($net) {
			case 'facebook':
				$text = esc_html__('Facebook','mikado-core');
				break;
			case 'twitter':
				$text = esc_html__('Twitter','mikado-core');
				break;
			case 'linkedin':
				$text = esc_html__('LinkedIn','mikado-core');
				break;
			case 'tumblr':
				$text = esc_html__('Tumblr','mikado-core');
				break;
			case 'pinterest':
				$text = esc_html__('Pinterest','mikado-core');
				break;
			case 'vk':
				$text = esc_html__('VK','mikado-core');
				break;
			default:
				$text = '';
		}

		return $text;

	}

}