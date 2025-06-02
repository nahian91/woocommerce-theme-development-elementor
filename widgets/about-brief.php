<?php
class Ekomart_About_Brief extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_about_brief_widget';
	}

	public function get_title(): string {
		return esc_html__( 'About Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'brief', 'about' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_about_brief_content',
			[
				'label' => esc_html__( 'Content', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_about_brief_image',
			[
				'label' => esc_html__( 'Choose Image', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'eka_about_brief_title',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'eka_about_brief_desc',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// Content Tab End

		// Style Tab Start

		$this->start_controls_section(
			'eka_about_brief_img_style',
			[
				'label' => esc_html__( 'Image', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_about_brief_image_width',
			[
				'label' => esc_html__( 'Width', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .thumbnail-left img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'eka_about_brief_image_height',
			[
				'label' => esc_html__( 'Height', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .thumbnail-left img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'eka_about_brief_image_border',
				'selector' => '{{WRAPPER}} .thumbnail-left img',
			]
		);

		$this->add_control(
			'eka_about_brief_image_border_radius',
			[
				'label' => esc_html__( 'Border Radiuse', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .thumbnail-left img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_about_brief_title_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_about_brief_title_color',
			[
				'label' => esc_html__( 'Color', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-content-area-1 .title' => 'color: {{VALUE}};',
				],
				'default' => ''
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'eka_about_brief_title_typography',
				'selector' => '{{WRAPPER}} .about-content-area-1 .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_about_brief_desc_style',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_about_brief_desc_color',
			[
				'label' => esc_html__( 'Color', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-content-area-1' => 'color: {{VALUE}};',
				],
				'default' => ''
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'eka_about_brief_desc_typography',
				'selector' => '{{WRAPPER}} .about-content-area-1 p.disc',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$eka_about_brief_image = $settings['eka_about_brief_image']['url'];
		$eka_about_brief_title = $settings['eka_about_brief_title'];
		$eka_about_brief_desc = $settings['eka_about_brief_desc'];

		?>
		<!-- Breadcumb -->
		<!-- about area start -->
    <div class="rts-about-area section-gap2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="thumbnail-left">
                        <img src="<?php echo $eka_about_brief_image; ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-8 pl--60 pl_md--10 pt_md--30 pl_sm--10 pt_sm--30">
                    <div class="about-content-area-1">
                        <h2 class="title">
                            <?php echo $eka_about_brief_title; ?>
                        </h2>
                        <?php echo $eka_about_brief_desc; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- about area end -->
		<?php

	}
}
