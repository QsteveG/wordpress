<?php
namespace Bridge\Shortcodes\ScrollingImage;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class ScrollingImage
 */
class ScrollingImage implements ShortcodeInterface {
    /**
     * @var string
     */
	private $base; 
	
    /**
     * ScrollingImage constructor.
     */
	function __construct() {
		$this->base = 'qode_scrolling_image';

		add_action('qode_vc_map', array($this, 'vcMap'));
	}
	
	/**
		* Returns base for shortcode
		* @return string
	 */
	public function getBase() {
		return $this->base;
	}	
    
	public function vcMap() {
						
		vc_map( array(
			'name' => 'Scrolling Image',
			'base' => $this->base,
			'category' => 'by QODE',
			'icon' => 'icon-wpb-scrolling-image extended-custom-icon-qode',
			'params' =>	array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__('Scrolling Image', 'qode'),
                    'param_name' => 'scrolling_image'
                ),
                array(
                    'type'        => 'dropdown',
                    'heading' => esc_html__('Enable Rounded Image', 'qode'),
                    'param_name'  => 'rounded_image',
                    'value'       => array(
                        'No'  => 'no',
                        'Yes' => 'yes',
                    ),
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'dropdown',
                    'heading' => esc_html__('Enable Box Shadow', 'qode'),
                    'param_name'  => 'box_shadow',
                    'value'       => array(
                        'No'  => 'no',
                        'Yes' => 'yes',
                    ),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'qode'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type'        => 'textfield',
                    'heading' => esc_html__('Link', 'qode'),
                    'param_name'  => 'link',
                    'admin_label' => true
                ),
                array(
                    'type'        => 'dropdown',
                    'heading' => esc_html__('Link Target', 'qode'),
                    'param_name'  => 'link_target',
                    'value'       => array(
                        esc_html__('New Window','qode') => '_blank',
                        esc_html__('Same Window','qode') => '_self',
                    ),
                    'save_always' => true,
                    'dependency' => array( 'element' => 'link', 'not_empty' => true )
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Title Color', 'qode'),
                    'param_name'  => 'title_color',
                    'dependency' => array( 'element' => 'title', 'not_empty' => true ),
                    'group'     => esc_html__('Design Options', 'qode')
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => esc_html__('Icon Background Color', 'qode'),
                    'param_name'  => 'icon_background_color',
                    'dependency' => array( 'element' => 'link', 'not_empty' => true ),
                    'group'     => esc_html__('Design Options', 'qode')
                )
            )
		) );

	}

	public function render($atts, $content = null) {
		
		$args = array(
            'scrolling_image'       => '',
            'rounded_image'         => '',
            'box_shadow'            => '',
            'title'                 => '',
            'link'                  => '',
            'link_target'           => '_blank',
            'title_color'           => '',
            'icon_background_color' => '',
        );

        $params = shortcode_atts($args, $atts);

        extract($params);

        $params['holder_classes'] = $this->getHolderClasses($params);
        $params['title_styles'] = $this->getTitleStyles($params);
        $params['icon_background_styles'] = $this->getIconBackgroundStyles($params);

        return qode_get_shortcode_template_part('templates/scrolling-image-template', 'scrolling-image', '', $params);
    }


    /**
     * Returns classes for holder
     *
     * @param $params
     *
     * @return array
     */
    private function getHolderClasses($params) {
        $classes_array = array();

        $classes_array[] = 'qode-scrolling-image-holder';

        if (!empty($params['rounded_image'])) {
            $classes_array[] = 'qode-si-rounded-'. $params['rounded_image'];
        }

        if (!empty($params['box_shadow'])) {
            $classes_array[] = 'qode-si-box-shadow-'. $params['box_shadow'];
        }

        return implode(' ',$classes_array);
    }

    /**
     * Returns title styles
     *
     * @param $params
     *
     * @return array
     */
    private function getTitleStyles($params){
        $title_styles = array();

        if ($params['title_color'] !== ''){
            $title_styles[] = 'color: '.$params['title_color'];
        }

        return implode('; ', $title_styles);
    }

    /**
     * Returns icon background styles
     *
     * @param $params
     *
     * @return array
     */
    private function getIconBackgroundStyles($params){
        $icon_background_styles = array();

        if ($params['icon_background_color'] !== ''){
            $icon_background_styles[] = 'background-color: '. $params['icon_background_color']. ';';
        }

        return implode('; ', $icon_background_styles);
    }

}