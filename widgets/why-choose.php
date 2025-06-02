<?php
class Ekomart_Why_Choose extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_why_choose_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Why Choose Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'choose', 'why' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_why_choose_image_content',
			[
				'label' => esc_html__( 'Image', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_why_choose_image',
			[
				'label' => esc_html__( 'Choose Image', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'eka_why_choose_number',
			[
				'label' => esc_html__( 'Number', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_why_choose_title_content',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_why_choose_title',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_why_choose_content',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_why_choose_desc',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// Content Tab End

		$this->start_controls_section(
			'eka_why_choose_img_style',
			[
				'label' => esc_html__( 'Image', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_why_choose_image_width',
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
					'{{WRAPPER}} .icon-area img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'eka_why_choose_height',
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
					'{{WRAPPER}} .icon-area img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'eka_why_choose_border',
				'selector' => '{{WRAPPER}} .icon-area img',
			]
		);

		$this->add_control(
			'eka_why_choose_border_radius',
			[
				'label' => esc_html__( 'Border Radiuse', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .icon-area img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_why_choose_title_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_why_choose_title_color',
			[
				'label' => esc_html__( 'Color', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bottom-content h3.title' => 'color: {{VALUE}};',
				],
				'default' => ''
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'eka_why_choose_title_typography',
				'selector' => '{{WRAPPER}} .bottom-content h3.title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_why_choose_desc_style',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_why_choose_desc_color',
			[
				'label' => esc_html__( 'Color', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bottom-content p.disc' => 'color: {{VALUE}};',
				],
				'default' => ''
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'eka_why_choose_desc_typography',
				'selector' => '{{WRAPPER}} .bottom-content p.disc',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$eka_why_choose_image = $settings['eka_why_choose_image']['url'];
		$eka_why_choose_number = $settings['eka_why_choose_number'];
		$eka_why_choose_title = $settings['eka_why_choose_title'];
		$eka_why_choose_desc = $settings['eka_why_choose_desc'];

		?>
		<div class="single-service-area-style-one">
			<div class="icon-area">
				<span class="bg-text"><?php echo $eka_why_choose_number;?></span>
				<img src="<?php echo $eka_why_choose_image; ?>" alt="service">
			</div>
			<div class="bottom-content">
				<h3 class="title">
					<?php echo $eka_why_choose_title; ?>
				</h3>
				<p class="disc">
					<?php echo $eka_why_choose_desc; ?>
				</p>
			</div>
		</div>
		<?php

	}
}
