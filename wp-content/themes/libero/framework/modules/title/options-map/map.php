<?php

if ( ! function_exists('libero_mikado_title_options_map') ) {

	function libero_mikado_title_options_map() {

		libero_mikado_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => esc_html__( 'Title', 'libero' ),
				'icon' => 'icon_archive_alt'
			)
		);

		$panel_title = libero_mikado_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => esc_html__( 'Title Settings', 'libero' )
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'show_title_area',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => esc_html__( 'Show Title Area', 'libero' ),
				'description' => esc_html__( 'This option will enable/disable Title Area', 'libero' ),
				'parent' => $panel_title,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_show_title_area_container"
				)
			)
		);

		$show_title_area_container = libero_mikado_add_admin_container(
			array(
				'parent' => $panel_title,
				'name' => 'show_title_area_container',
				'hidden_property' => 'show_title_area',
				'hidden_value' => 'no'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_type',
				'type' => 'select',
				'default_value' => 'standard',
				'label' => esc_html__( 'Title Area Type', 'libero' ),
				'description' => esc_html__( 'Choose title type', 'libero' ),
				'parent' => $show_title_area_container,
				'options' => array(
					'standard' => esc_html__('Standard', 'libero' ),
					'breadcrumb' => esc_html__('Breadcrumb', 'libero' )
				),
				'args' => array(
					"dependence" => true,
					"hide" => array(
						"standard" => "",
						"breadcrumb" => "#mkd_title_area_type_container"
					),
					"show" => array(
						"standard" => "#mkd_title_area_type_container",
						"breadcrumb" => ""
					)
				)
			)
		);

		$title_area_type_container = libero_mikado_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_type_container',
				'hidden_property' => 'title_area_type',
				'hidden_value' => '',
				'hidden_values' => array('breadcrumb'),
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_enable_breadcrumbs',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => esc_html__( 'Enable Breadcrumbs', 'libero' ),
				'description' => esc_html__( 'This option will display Breadcrumbs in Title Area', 'libero' ),
				'parent' => $title_area_type_container,
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_animation',
				'type' => 'select',
				'default_value' => 'no',
				'label' => esc_html__( 'Animations', 'libero' ),
				'description' => esc_html__( 'Choose an animation for Title Area', 'libero' ),
				'parent' => $show_title_area_container,
				'options' => array(
					'no' => esc_html__('No Animation', 'libero' ),
					'fade-in' => esc_html__('Fade In', 'libero' ),
					'right-left' => esc_html__('Text right to left', 'libero' ),
					'left-right' => esc_html__('Text left to right', 'libero' )
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_vertial_alignment',
				'type' => 'select',
				'default_value' => 'header_bottom',
				'label' => esc_html__( 'Vertical Alignment', 'libero' ),
				'description' => esc_html__( 'Specify title vertical alignment', 'libero' ),
				'parent' => $show_title_area_container,
				'options' => array(
					'header_bottom' => esc_html__('From Bottom of Header', 'libero' ),
					'window_top' => esc_html__('From Window Top', 'libero' )
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_content_alignment',
				'type' => 'select',
				'default_value' => 'left',
				'label' => esc_html__( 'Horizontal Alignment', 'libero' ),
				'description' => esc_html__( 'Specify title horizontal alignment', 'libero' ),
				'parent' => $show_title_area_container,
				'options' => array(
					'left' => esc_html__('Left', 'libero' ),
					'center' => esc_html__('Center', 'libero' ),
					'right' => esc_html__('Right', 'libero' )
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_background_color',
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'libero' ),
				'description' => esc_html__( 'Choose a background color for Title Area', 'libero' ),
				'parent' => $show_title_area_container
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_background_image',
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'libero' ),
				'default_value' => '',
				'description' => esc_html__( 'Choose an Image for Title Area', 'libero' ),
				'parent' => $show_title_area_container
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_background_as_pattern',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__( 'Background Image as Pattern', 'libero' ),
				'description' => esc_html__( 'Enable this option to make background image behave as pattern', 'libero' ),
				'parent' => $show_title_area_container,
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_background_image_responsive',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__( 'Background Responsive Image', 'libero' ),
				'description' => esc_html__( 'Enabling this option will make Title background image responsive', 'libero' ),
				'parent' => $show_title_area_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#mkd_title_area_background_image_responsive_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$title_area_background_image_responsive_container = libero_mikado_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_background_image_responsive_container',
				'hidden_property' => 'title_area_background_image_responsive',
				'hidden_value' => 'yes'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_background_image_parallax',
				'type' => 'select',
				'default_value' => 'no',
				'label' => esc_html__( 'Background Image in Parallax', 'libero' ),
				'description' => esc_html__( 'Enabling this option will make Title background image parallax', 'libero' ),
				'parent' => $title_area_background_image_responsive_container,
				'options' => array(
					'no' => esc_html__('No', 'libero' ),
					'yes' => esc_html__('Yes', 'libero' ),
					'yes_zoom' => esc_html__('Yes, with zoom out', 'libero' )
				)
			)
		);

		libero_mikado_add_admin_field(array(
			'name' => 'title_area_height',
			'type' => 'text',
			'label' => esc_html__( 'Height', 'libero' ),
			'description' => esc_html__( 'Set a height for Title Area', 'libero' ),
			'parent' => $title_area_background_image_responsive_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_border_bottom_enable',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Border Bottom', 'libero' ),
				'description' => esc_html__( 'Enable this option to add border bottom on title area', 'libero' ),
				'parent' => $show_title_area_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_title_area_border_bottom_container"
				)
			)
		);

		$title_area_border_bottom_container = libero_mikado_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_border_bottom_container',
				'hidden_property' => 'title_area_border_bottom_enable',
				'hidden_value' => 'no'
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_area_border_bottom',
				'type' => 'color',
				'default_value' => '',
				'label' => esc_html__( 'Border Bottom Color', 'libero' ),
				'description' => esc_html__( 'Choose border bottom color for title area', 'libero' ),
				'parent' => $title_area_border_bottom_container,
			)
		);

		libero_mikado_add_admin_field(
			array(
				'name' => 'title_icon_enable',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => esc_html__( 'Enable Icon', 'libero' ),
				'description' => esc_html__( 'Enable icon to be rendered above title text', 'libero' ),
				'parent' => $show_title_area_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#mkd_title_icon_all_container"
				)
			)
		);

		$title_icon_all_container = libero_mikado_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_icon_all_container',
				'hidden_property' => 'title_icon_enable',
				'hidden_value' => 'no'
			)
		);

//init icon pack hide and show array. It will be populated dinamically from collections array
		$title_above_icon_pack_hide_array = array();
		$title_above_icon_pack_show_array = array();

//do we have some collection added in collections array?
		if (is_array(libero_mikado_icon_collections()->iconCollections) && count(libero_mikado_icon_collections()->iconCollections)) {
			//get collections params array. It will contain values of 'param' property for each collection
			$title_above_icon_collections_params = libero_mikado_icon_collections()->getIconCollectionsParams();

			//foreach collection generate hide and show array
			foreach (libero_mikado_icon_collections()->iconCollections as $dep_collection_key => $dep_collection_object) {
				$title_above_icon_pack_hide_array[$dep_collection_key] = '';

				//we need to include only current collection in show string as it is the only one that needs to show
				$title_above_icon_pack_show_array[$dep_collection_key] = '#mkd_title_above_icon_' . $dep_collection_object->param . '_container';

				//for all collections param generate hide string
				foreach ($title_above_icon_collections_params as $title_above_icon_collections_param) {
					//we don't need to include current one, because it needs to be shown, not hidden
					if ($title_above_icon_collections_param !== $dep_collection_object->param) {
						$title_above_icon_pack_hide_array[$dep_collection_key] .= '#mkd_title_above_icon_' . $title_above_icon_collections_param . '_container,';
					}
				}

				//remove remaining ',' character
				$title_above_icon_pack_hide_array[$dep_collection_key] = rtrim($title_above_icon_pack_hide_array[$dep_collection_key], ',');
			}

		}

		libero_mikado_add_admin_field(
			array(
				'parent' => $title_icon_all_container,
				'type' => 'select',
				'name' => 'title_above_icon_pack',
				'default_value' => 'font_awesome',
				'label' => esc_html__( 'Icon Pack', 'libero' ),
				'description' => esc_html__( 'Choose icon pack', 'libero' ),
				'options' => libero_mikado_icon_collections()->getIconCollections(),
				'args' => array(
					'dependence' => true,
					'hide' => $title_above_icon_pack_hide_array,
					'show' => $title_above_icon_pack_show_array
				)
			)
		);

		if (is_array(libero_mikado_icon_collections()->iconCollections) && count(libero_mikado_icon_collections()->iconCollections)) {
			//foreach icon collection we need to generate separate container that will have dependency set
			//it will have one field inside with icons dropdown
			foreach (libero_mikado_icon_collections()->iconCollections as $collection_key => $collection_object) {
				$icons_array = $collection_object->getIconsArray();

				//get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
				$icon_collections_keys = libero_mikado_icon_collections()->getIconCollectionsKeys();

				//unset current one, because it doesn't have to be included in dependency that hides icon container
				unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

				$title_icon_hide_values = $icon_collections_keys;

				$title_above_icon_container = libero_mikado_add_admin_container(
					array(
						'parent' => $title_icon_all_container,
						'name' => 'title_above_icon_' . $collection_object->param . '_container',
						'hidden_property' => 'title_above_icon_pack',
						'hidden_value' => '',
						'hidden_values' => $title_icon_hide_values
					)
				);

				libero_mikado_add_admin_field(
					array(
						'parent' => $title_above_icon_container,
						'type' => 'select',
						'name' => 'title_above_icon_' . $collection_object->param,
						'default_value' => '',
						'label' => esc_html__( 'Icon', 'libero' ),
						'description' => esc_html__( 'Choose icon to be displayed above title', 'libero' ),
						'options' => $icons_array,
					)
				);

			}

		}

		$group_page_title_icon_styles = libero_mikado_add_admin_group(array(
			'name'			=> 'group_page_title_icon_styles',
			'title' => esc_html__( 'Icon Style', 'libero' ),
			'description' => esc_html__( 'Define icon style', 'libero' ),
			'parent'		=> $title_icon_all_container
		));

		$row_page_title_icon_styles_1 = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_title_icon_styles_1',
			'parent'	=> $group_page_title_icon_styles
		));

		libero_mikado_add_admin_field(
			array(
				'parent' => $row_page_title_icon_styles_1,
				'type' => 'colorsimple',
				'name' => 'title_icon_color',
				'default_value' => '',
				'label' => esc_html__( 'Color', 'libero' ),
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $row_page_title_icon_styles_1,
				'type' => 'colorsimple',
				'name' => 'title_icon_border_color',
				'default_value' => '',
				'label' => esc_html__( 'Border Color', 'libero' ),
			)
		);

		$row_page_title_icon_styles_2 = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_title_icon_styles_2',
			'parent'	=> $group_page_title_icon_styles
		));

		libero_mikado_add_admin_field(
			array(
				'parent' => $row_page_title_icon_styles_2,
				'type' => 'selectblanksimple',
				'name' => 'title_icon_size',
				'default_value' => '',
				'label' => esc_html__( 'Size', 'libero' ),
				'options' => array(
					'' => esc_html__('Default', 'libero' ),
					'mkd-icon-tiny' => esc_html__('Tiny', 'libero' ),
					'mkd-icon-small' => esc_html__('Small', 'libero' ),
					'mkd-icon-medium' => esc_html__('Medium', 'libero' ),
					'mkd-icon-large' => esc_html__('Large', 'libero' ),
					'mkd-icon-huge' => esc_html__('Very Large', 'libero' ),
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $row_page_title_icon_styles_2,
				'type' => 'textsimple',
				'name' => 'title_icon_custom_size',
				'default_value' => '',
				'label' => esc_html__( 'Custom Size', 'libero' ),
				'args' => array(
					'suffix' => 'px',
				)
			)
		);

		libero_mikado_add_admin_field(
			array(
				'parent' => $row_page_title_icon_styles_2,
				'type' => 'textsimple',
				'name' => 'title_icon_shape_size',
				'default_value' => '',
				'label' => esc_html__( 'Shape Size', 'libero' ),
				'args' => array(
					'suffix' => 'px',
				)
			)
		);

		$panel_typography = libero_mikado_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title_typography',
				'title' => esc_html__( 'Typography', 'libero' )
			)
		);

		$group_page_title_styles = libero_mikado_add_admin_group(array(
			'name'			=> 'group_page_title_styles',
			'title' => esc_html__( 'Title', 'libero' ),
			'description' => esc_html__( 'Define styles for page title', 'libero' ),
			'parent'		=> $panel_typography
		));

		$row_page_title_styles_1 = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_title_styles_1',
			'parent'	=> $group_page_title_styles
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_title_color',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Color', 'libero' ),
			'parent'		=> $row_page_title_styles_1
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_fontsize',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Size', 'libero' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_lineheight',
			'default_value'	=> '',
			'label' => esc_html__( 'Line Height', 'libero' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_1
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_texttransform',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Transform', 'libero' ),
			'options'		=> libero_mikado_get_text_transform_array(),
			'parent'		=> $row_page_title_styles_1
		));

		$row_page_title_styles_2 = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_title_styles_2',
			'parent'	=> $group_page_title_styles,
			'next'		=> true
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_title_google_fonts',
			'default_value'	=> '-1',
			'label' => esc_html__( 'Font Family', 'libero' ),
			'parent'		=> $row_page_title_styles_2
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontstyle',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Style', 'libero' ),
			'options'		=> libero_mikado_get_font_style_array(),
			'parent'		=> $row_page_title_styles_2
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_title_fontweight',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Weight', 'libero' ),
			'options'		=> libero_mikado_get_font_weight_array(),
			'parent'		=> $row_page_title_styles_2
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_title_letter_spacing',
			'default_value'	=> '',
			'label' => esc_html__( 'Letter Spacing', 'libero' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_title_styles_2
		));

		$group_page_subtitle_styles = libero_mikado_add_admin_group(array(
			'name'			=> 'group_page_subtitle_styles',
			'title' => esc_html__( 'Subtitle', 'libero' ),
			'description' => esc_html__( 'Define styles for page subtitle', 'libero' ),
			'parent'		=> $panel_typography
		));

		$row_page_subtitle_styles_1 = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_1',
			'parent'	=> $group_page_subtitle_styles
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_subtitle_color',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Color', 'libero' ),
			'parent'		=> $row_page_subtitle_styles_1
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_fontsize',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Size', 'libero' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_lineheight',
			'default_value'	=> '',
			'label' => esc_html__( 'Line Height', 'libero' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_1
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_texttransform',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Transform', 'libero' ),
			'options'		=> libero_mikado_get_text_transform_array(),
			'parent'		=> $row_page_subtitle_styles_1
		));

		$row_page_subtitle_styles_2 = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_subtitle_styles_2',
			'parent'	=> $group_page_subtitle_styles,
			'next'		=> true
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_subtitle_google_fonts',
			'default_value'	=> '-1',
			'label' => esc_html__( 'Font Family', 'libero' ),
			'parent'		=> $row_page_subtitle_styles_2
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_fontstyle',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Style', 'libero' ),
			'options'		=> libero_mikado_get_font_style_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_subtitle_fontweight',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Weight', 'libero' ),
			'options'		=> libero_mikado_get_font_weight_array(),
			'parent'		=> $row_page_subtitle_styles_2
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_subtitle_letter_spacing',
			'default_value'	=> '',
			'label' => esc_html__( 'Letter Spacing', 'libero' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_subtitle_styles_2
		));

		$group_page_breadcrumbs_styles = libero_mikado_add_admin_group(array(
			'name'			=> 'group_page_breadcrumbs_styles',
			'title' => esc_html__( 'Breadcrumbs', 'libero' ),
			'description' => esc_html__( 'Define styles for page breadcrumbs', 'libero' ),
			'parent'		=> $panel_typography
		));

		$row_page_breadcrumbs_styles_1 = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_1',
			'parent'	=> $group_page_breadcrumbs_styles
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_color',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Color', 'libero' ),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_fontsize',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Size', 'libero' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_lineheight',
			'default_value'	=> '',
			'label' => esc_html__( 'Line Height', 'libero' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_texttransform',
			'default_value'	=> '',
			'label' => esc_html__( 'Text Transform', 'libero' ),
			'options'		=> libero_mikado_get_text_transform_array(),
			'parent'		=> $row_page_breadcrumbs_styles_1
		));

		$row_page_breadcrumbs_styles_2 = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_2',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'fontsimple',
			'name'			=> 'page_breadcrumb_google_fonts',
			'default_value'	=> '-1',
			'label' => esc_html__( 'Font Family', 'libero' ),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_fontstyle',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Style', 'libero' ),
			'options'		=> libero_mikado_get_font_style_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'selectblanksimple',
			'name'			=> 'page_breadcrumb_fontweight',
			'default_value'	=> '',
			'label' => esc_html__( 'Font Weight', 'libero' ),
			'options'		=> libero_mikado_get_font_weight_array(),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'textsimple',
			'name'			=> 'page_breadcrumb_letter_spacing',
			'default_value'	=> '',
			'label' => esc_html__( 'Letter Spacing', 'libero' ),
			'args'			=> array(
				'suffix'	=> 'px'
			),
			'parent'		=> $row_page_breadcrumbs_styles_2
		));

		$row_page_breadcrumbs_styles_3 = libero_mikado_add_admin_row(array(
			'name'		=> 'row_page_breadcrumbs_styles_3',
			'parent'	=> $group_page_breadcrumbs_styles,
			'next'		=> true
		));

		libero_mikado_add_admin_field(array(
			'type'			=> 'colorsimple',
			'name'			=> 'page_breadcrumb_hovercolor',
			'default_value'	=> '',
			'label' => esc_html__( 'Hover/Active Color', 'libero' ),
			'parent'		=> $row_page_breadcrumbs_styles_3
		));

	}

	add_action( 'libero_mikado_options_map', 'libero_mikado_title_options_map', 6);

}