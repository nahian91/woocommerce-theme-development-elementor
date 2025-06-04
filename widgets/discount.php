<?php
class Ekomart_Discount extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_discount_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Discount Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'discount' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_discount_image_content',
			[
				'label' => esc_html__( 'Image', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_discount_image',
			[
				'label' => esc_html__( 'Choose Image', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_discount_title_content',
			[
				'label' => esc_html__( 'Content', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_discount_subtitle',
			[
				'label' => esc_html__( 'Sub Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'eka_discount_title',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'eka_discount_desc',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_discount_link_content',
			[
				'label' => esc_html__( 'Link', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_discount_link_text',
			[
				'label' => esc_html__( 'Link Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'eka_discount_link',
			[
				'label' => esc_html__( 'Link', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// Content Tab End

		$this->start_controls_section(
			'eka_discount_title_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_discount_title_color',
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
				'name' => 'eka_discount_title_typography',
				'selector' => '{{WRAPPER}} .about-content-area-1 .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_discount_desg_style',
			[
				'label' => esc_html__( 'Dessignation', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_discount_desg_color',
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
				'name' => 'eka_discount_desg_typography',
				'selector' => '{{WRAPPER}} .about-content-area-1 p.disc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_discount_phone_style',
			[
				'label' => esc_html__( 'Phone', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_discount_phone_color',
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
				'name' => 'eka_discount_phone_typography',
				'selector' => '{{WRAPPER}} .about-content-area-1 p.disc',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$eka_discount_image = $settings['eka_discount_image']['url'];
		$eka_discount_subtitle = $settings['eka_discount_subtitle'];
		$eka_discount_title = $settings['eka_discount_title'];
		$eka_discount_desc = $settings['eka_discount_desc'];
		$eka_discount_link_text = $settings['eka_discount_link_text'];
		$eka_discount_link = $settings['eka_discount_link']['url'];

		?>
		<div class="single-feature-card ssthree style-three" style="background-image: url('<?php echo $eka_discount_image;?>');">
			<div class="content-area">
				<a href="shop-grid-top-filter.php" class="main-btn btn-primary"><?php echo $eka_discount_subtitle;?></a>
				<h3 class="title">
					<?php echo $eka_discount_title;?> <br>
					<span><?php echo $eka_discount_desc;?></span>
				</h3>
				<a href="<?php echo $eka_discount_link;?>" class="shop-now-goshop-btn">
					<span class="text"><?php echo $eka_discount_link_text;?></span>
					<div class="plus-icon">
						<i class="fa-sharp fa-regular fa-plus"></i>
					</div>
					<div class="plus-icon">
						<i class="fa-sharp fa-regular fa-plus"></i>
					</div>
				</a>
			</div>
		</div>
		<?php

	}
}
