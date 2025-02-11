<?php

/**
 * Class: LaStudioKit_Post_Author
 * Name: Post Author
 * Slug: lakit-post-author
 */

namespace Elementor;

if (!defined('WPINC')) {
    die;
}


/**
 * Post Author Widget
 */
class LaStudioKit_Post_Author extends LaStudioKit_Base {

    protected function enqueue_addon_resources(){
	    if(!lastudio_kit_settings()->is_combine_js_css()) {
		    $this->add_style_depends( 'lastudio-kit-base' );
	    }
    }

    public function get_name() {
        return 'lakit-post-author';
    }

    protected function get_widget_title() {
        return esc_html__( 'Post Author', 'lastudio-kit' );
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return [ 'lastudiokit-builder' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__( 'Post Author', 'lastudio-kit' ),
            ]
        );

        $this->add_control(
            'author',
            [
                'label' => __( 'Author', 'lastudio-kit' ),
                'type' => Controls_Manager::SELECT,
                'options' => $this->user_fields_labels(),
                'default' => 'display_name',
            ]
        );

        $this->add_control(
            'html_tag',
            [
                'label' => __( 'HTML Tag', 'lastudio-kit' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'p',
                    'div' => 'div',
                    'span' => 'span',
                ],
                'default' => 'p',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'lastudio-kit' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'lastudio-kit' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'lastudio-kit' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'lastudio-kit' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'lastudio-kit' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'link_to',
            [
                'label' => __( 'Link to', 'lastudio-kit' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none' => __( 'None', 'lastudio-kit' ),
                    'home' => __( 'Home URL', 'lastudio-kit' ),
                    'post' => esc_html__('Post URL', 'lastudio-kit'),
                    'author' => __( 'Author URL', 'lastudio-kit' ),
                    'custom' => __( 'Custom URL', 'lastudio-kit' ),
                ],
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'lastudio-kit' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'lastudio-kit' ),
                'condition' => [
                    'link_to' => 'custom',
                ],
                'default' => [
                    'url' => '',
                ],
                'show_label' => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Post Author', 'lastudio-kit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => __( 'Text Color', 'lastudio-kit' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lakit-post-author' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .lakit-post-author a' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'author!' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .lakit-post-author',
                'condition' => [
                    'author!' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .lakit-post-author',
                'condition' => [
                    'author!' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'space',
            [
                'label' => __( 'Size (%)', 'lastudio-kit' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units' => [ '%' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lakit-post-author img' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'author' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'opacity',
            [
                'label' => __( 'Opacity (%)', 'lastudio-kit' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 1,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lakit-post-author img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    'author' => 'image',
                ],
            ]
        );

        $this->add_control(
            'angle',
            [
                'label' => __( 'Angle (deg)', 'lastudio-kit' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'deg' ],
                'default' => [
                    'unit' => 'deg',
                    'size' => 0,
                ],
                'range' => [
                    'deg' => [
                        'max' => 360,
                        'min' => -360,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lakit-post-author img' => '-webkit-transform: rotate({{SIZE}}deg); -moz-transform: rotate({{SIZE}}deg); -ms-transform: rotate({{SIZE}}deg); -o-transform: rotate({{SIZE}}deg); transform: rotate({{SIZE}}deg);',
                ],
                'condition' => [
                    'author' => 'image',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __( 'Hover Animation', 'lastudio-kit' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __( 'Image Border', 'lastudio-kit' ),
                'selector' => '{{WRAPPER}} .lakit-post-author img',
                'condition' => [
                    'author' => 'image',
                ],
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label' => __( 'Border Radius', 'lastudio-kit' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .lakit-post-author img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'author' => 'image',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .lakit-post-author img',
                'condition' => [
                    'author' => 'image',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        if ( empty( $settings['author'] ) )
            return;

        $author = $this->user_data( $settings['author'] );

        switch ( $settings['link_to'] ) {
            case 'custom' :
                if ( ! empty( $settings['link']['url'] ) ) {
                    $link = esc_url( $settings['link']['url'] );
                } else {
                    $link = false;
                }
                break;

            case 'author' :
                $link = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
                break;

            case 'post' :
                $link = esc_url( get_the_permalink() );
                break;

            case 'home' :
                $link = esc_url( get_home_url() );
                break;

            case 'none' :
            default:
                $link = false;
                break;
        }
        $target = $settings['link']['is_external'] ? 'target="_blank"' : '';
	    $html_tag = lastudio_kit_helper()->validate_html_tag($settings['html_tag']);

        $animation_class = ! empty( $settings['hover_animation'] ) ? 'elementor-animation-' . $settings['hover_animation'] : '';

        $html = sprintf( '<%1$s class="lakit-post-author %2$s">', $html_tag, esc_attr($animation_class) );
        if ( $link ) {
            $html .= sprintf( '<a href="%1$s" %2$s>%3$s</a>', $link, $target, $author );
        } else {
            $html .= $author;
        }
        $html .= sprintf( '</%s>', $html_tag );

        echo $html;
    }

    protected function content_template() {
        ?>
        <#
        var author_data = [];
        <?php
        foreach ( $this->user_data() as $key => $value ) {
            printf( 'author_data[ "%1$s" ] = "%2$s";', $key, $value );
        }
        ?>
        var author = author_data[ settings.author ];

        var link_url;
        switch( settings.link_to ) {
        case 'custom':
        link_url = settings.link.url;
        break;
        case 'author':
        link_url = '<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>';
        break;
        case 'post':
        link_url = '<?php echo esc_url( get_the_permalink() ); ?>';
        break;
        case 'home':
        link_url = '<?php echo esc_url( get_home_url() ); ?>';
        break;
        case 'none':
        default:
        link_url = false;
        }
        var target = settings.link.is_external ? 'target="_blank"' : '';

        var animation_class = '';
        if ( '' !== settings.hover_animation ) {
        animation_class = 'elementor-animation-' + settings.hover_animation;
        }

        var html = '<' + settings.html_tag + ' class="lakit-post-author ' + animation_class + '">';
        if ( link_url ) {
        html += '<a href="' + link_url + '" ' + target + '>' + author + '</a>';
        } else {
        html += author;
        }
        html += '</' + settings.html_tag + '>';

        print( html );
        #>
        <?php
    }

    protected function user_fields_labels() {

        $fields = [
            'first_name'   => __( 'First Name', 'lastudio-kit' ),
            'last_name'    => __( 'Last Name', 'lastudio-kit' ),
            'first_last'   => __( 'First Name + Last Name', 'lastudio-kit' ),
            'last_first'   => __( 'Last Name + First Name', 'lastudio-kit' ),
            'nickname'     => __( 'Nick Name', 'lastudio-kit' ),
            'display_name' => __( 'Display Name', 'lastudio-kit' ),
            'user_login'   => __( 'User Name', 'lastudio-kit' ),
            'description'  => __( 'User Bio', 'lastudio-kit' ),
            'image'        => __( 'User Image', 'lastudio-kit' ),
        ];

        return $fields;

    }

    protected function user_data( $selected = '' ) {

        global $post;

        $author_id = $post->post_author;

        $fields = [
            'first_name'   => get_the_author_meta( 'first_name', $author_id ),
            'last_name'    => get_the_author_meta( 'last_name', $author_id ),
            'first_last'   => sprintf( '%s %s', get_the_author_meta( 'first_name', $author_id ), get_the_author_meta( 'last_name', $author_id ) ),
            'last_first'   => sprintf( '%s %s', get_the_author_meta( 'last_name', $author_id ), get_the_author_meta( 'first_name', $author_id ) ),
            'nickname'     => get_the_author_meta( 'nickname', $author_id ),
            'display_name' => get_the_author_meta( 'display_name', $author_id ),
            'user_login'   => get_the_author_meta( 'user_login', $author_id ),
            'description'  => get_the_author_meta( 'description', $author_id ),
            'image'        => get_avatar( get_the_author_meta( 'email', $author_id ), 256 ),
        ];

        if ( empty( $selected ) ) {
            // Return the entire array
            return $fields;
        } else {
            // Return only the selected field
            return $fields[ $selected ];
        }

    }
    
}