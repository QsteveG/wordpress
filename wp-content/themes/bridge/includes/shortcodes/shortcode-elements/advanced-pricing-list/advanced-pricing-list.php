<?php
namespace Bridge\Shortcodes\AdvancedPricingList;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class AdvancedPricingList implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_advanced_pricing_list';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Advanced Pricing List','qode'),
                'base' => $this->base,
                'icon' => 'extended-custom-icon-qode icon-wpb-advanced-pricing-list',
                'category' => esc_html__('by QODE','qode'),
                'params' => array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('List Title','qode'),
						'param_name'	=> 'list_title'
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Pricing Items', 'qode' ),
						'param_name' => 'pricing_items',
						'value' => '',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Item Title', 'qode' ),
								'param_name' => 'item_title',
								'admin_label' => true,
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Item Description', 'qode' ),
								'param_name' => 'item_description',
								'admin_label' => true,
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Item Price', 'qode' ),
								'param_name' => 'item_price',
								'admin_label' => true
							)
						)
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('List Title Tag', 'qode'),
						'param_name'	=> 'list_title_tag',
						'value'			=> qode_get_title_tag(true),
						'group' => esc_html__('Style', 'qode'),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('List Title Alignment', 'qode'),
						'param_name'	=> 'list_title_alignment',
						'value'			=> array(
							esc_html__( 'Left', 'qode' )	=> 'left',
							esc_html__( 'Center', 'qode' )	=> 'center',
							esc_html__( 'Right', 'qode' )	=> 'right',
						),
						'group' => esc_html__('Style', 'qode'),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'List Title Margin Bottom(px)', 'qode' ),
						'param_name' => 'list_title_margin_bottom',
						'group' => esc_html__('Style', 'qode')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('List Title Color', 'qode'),
						'param_name'  => 'list_title_color',
						'group' => esc_html__('Style', 'qode'),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Line Style', 'qode'),
						'param_name'  => 'line_style',
						'value'       => array(
							esc_html__('Solid', 'qode')	=> 'solid',
							esc_html__('Dashed', 'qode')	=> 'dashed',
							esc_html__('Dotted', 'qode')	=> 'dotted'
						),
						'group' => esc_html__('Style', 'qode'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Line Color', 'qode'),
						'param_name'  => 'line_color',
						'group' => esc_html__('Style', 'qode'),
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Item Title Tag', 'qode'),
						'param_name'	=> 'item_title_tag',
						'value'			=> array(
							''   => '',
							'p'	 => 'p',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'group' => esc_html__('Style', 'qode'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Item Title Color', 'qode'),
						'param_name'  => 'item_title_color',
						'group' => esc_html__('Style', 'qode'),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Item Description Color', 'qode'),
						'param_name'  => 'item_description_color',
						'group' => esc_html__('Style', 'qode'),
					)

                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'list_title'				=> '',
            'list_title_tag'			=> 'h3',
            'list_title_alignment'		=> '',
            'list_title_margin_bottom'	=> '',
            'list_title_color'			=> '',
            'item_title_tag'			=> 'h5',
            'pricing_items'				=> '',
            'line_style'				=> 'solid',
            'line_color'				=> '',
            'item_title_color'			=> '',
            'item_description_color'	=> ''
        );

        $params = shortcode_atts($args, $atts);

		extract($params);

		$params['content'] = $content;
		$params['pricing_items'] = json_decode(urldecode($params['pricing_items']), true);
		$params['line_style'] = $this->getLineStyle($params);
		$params['list_title_style'] = $this->getTitleStyle($params);
		$params['item_title_style'] = $this->getItemTitleStyle($params);
		$params['item_description_style'] = $this->getDescriptionStyle($params);


        $html = qode_get_shortcode_template_part('templates/advanced-pricing-list-template', 'advanced-pricing-list', '', $params);

        return $html;
    }

	private function getLineStyle($params) {

		$style = array();

		if($params['line_style']) {
			$style[] = 'border-style:'. $params['line_style'];
		}

		if($params['line_color']) {
			$style[] = 'border-color:'. $params['line_color'];
		}

		return implode(';', $style);

	}

	private function getItemTitleStyle($params) {

		$style = array();


		if($params['item_title_color']) {
			$style[] = 'color:'. $params['item_title_color'];
		}

		return implode(';', $style);

	}
	private function getTitleStyle($params) {

		$style = array();


		if($params['list_title_color']) {
			$style[] = 'color:'. $params['list_title_color'];
		}
		if($params['list_title_alignment']) {
			$style[] = 'text-align:'. $params['list_title_alignment'];
		}
		if($params['list_title_margin_bottom']) {
			$style[] = 'margin-bottom:'. $params['list_title_margin_bottom'].'px';
		}
		return implode(';', $style);

	}
	private function getDescriptionStyle($params) {

		$style = array();

		if($params['item_description_color']) {
			$style[] = 'color:'. $params['item_description_color'];
		}

		return implode(';', $style);

	}
}