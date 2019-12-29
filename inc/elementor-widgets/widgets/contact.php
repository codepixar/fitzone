<?php
namespace Fitzoneelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 *
 * fitzone elementor about page section widget.
 *
 * @since 1.0
 */
class Fitzone_Contact extends Widget_Base {

    public function get_name() {
        return 'fitzone-contact';
    }

    public function get_title() {
        return __( 'Contact', 'fitzone' );
    }

    public function get_icon() {
        return 'eicon-mail';
    }

    public function get_categories() {
        return [ 'fitzone-elements' ];
    }

    protected function _register_controls() {


        // ----------------------------------------  Contact Info  ------------------------------
        
        $this->start_controls_section(
            'contact_info',
            [
                'label' => __( 'Contact Info', 'fitzone' ),
            ]
        );

        $this->add_control(
            'info', [
                'label'         => __( 'Create Contact Info', 'fitzone' ),
                'type'          => Controls_Manager::REPEATER,
                'title_field'   => '{{{ label }}}',
                'fields'  => [
                    [
                        'name'        => 'label',
                        'label'       => __( 'Contact Info', 'fitzone' ),
                        'label_block' => true,
                        'type'        => Controls_Manager::TEXT,
                        'default'     => esc_html__( 'Dhaka, Bangladesh', 'fitzone' )
                    ],
                    [
                        'name'    => 'desc',
                        'label'   => __( 'Contact Descriptions', 'fitzone' ),
                        'type'    => Controls_Manager::TEXTAREA,
                        'default' => esc_html__( 'Write something...', 'fitzone' )
                    ],
                    [
                        'name'  => 'icon',
                        'label' => __( 'Icon', 'fitzone' ),
                        'type'  => Controls_Manager::ICON,
                        'options' => fitzone_themify_icon()
                    ]

                ],
            ]
        );

        $this->end_controls_section(); // End Contact Info

        // ----------------------------------------  Contact Form  ------------------------------
        $this->start_controls_section(
            'contact_form',
            [
                'label' => __( 'Contact Form', 'fitzone' ),
            ]
        );
        $this->add_control(
            'contact_form_title',
            [
                'label'     => esc_html__( 'Contact Form Title', 'fitzone' ),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__('Get in Touch', 'fitzone')
            ]
        );
        $this->add_control(
            'contact_formshortcode',
            [
                'label'     => esc_html__( 'Form Shortcode', 'fitzone' ),
                'type'      => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );
        $this->end_controls_section(); // End Contact Form


    }

    protected function render() {

    $settings = $this->get_settings();


    ?>
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <?php
                    if( !empty( $settings['contact_form_title'] ) ) {
	                    echo '<h2 class="contact-title">' . esc_html( $settings['contact_form_title'] ) . '</h2>';
                    }
                    ?>

                </div>
                <div class="col-lg-8">
                    <?php 
                        if( !empty( $settings['contact_formshortcode'] ) ){
                            echo do_shortcode( $settings['contact_formshortcode'] );
                        }
                    ?>
                </div>

                <div class="col-lg-4">
                    <?php 
                    if( is_array( $settings[ 'info' ] ) && count( $settings[ 'info' ] ) > 0 ):
                        foreach( $settings[ 'info' ] as $info ):
                        ?>
                            <div class="media contact-info">
                                <span class="contact-info__icon"><i class="<?php echo esc_attr( $info['icon'] ) ?>"></i></span>
                                <div class="media-body">
                                <h3><?php echo esc_html( $info['label'] ) ?></h3>
                                <p><?php echo esc_html( $info['desc'] ) ?></p>
                                </div>
                            </div>
                            <?php 
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php
    }
    
}
