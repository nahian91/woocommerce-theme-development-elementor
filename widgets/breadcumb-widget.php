<?php
class Ekomart_Breadcumb extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_breadcumb_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Breadcumb Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'breadcumb', 'about' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_breadcumb_content',
			[
				'label' => esc_html__( 'Content', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_breadcumb_title',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'eka_breadcumb_image',
			[
				'label' => esc_html__( 'Choose Image', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->end_controls_section();

		// Content Tab End

		// Style Tab Start

		$this->start_controls_section(
			'eka_breadcumb_content_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_breadcumb_title_color',
			[
				'label' => esc_html__( 'Color', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .banner-content .title' => 'color: {{VALUE}};',
				],
				'default' => '#fff'
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'eka_breadcumb_title_typography',
				'selector' => '{{WRAPPER}} .banner-content .title',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$eka_breadcumb_title = $settings['eka_breadcumb_title'];
		$eka_breadcumb_image = $settings['eka_breadcumb_image']['url'];

		?>
		<!-- Breadcumb -->
		<div class="breadcumb-area bg-image text-center" style="background-image: url('<?php echo $eka_breadcumb_image; ?>');">
			<div class="container">
				<div class="row">
					<div class="co-lg-12">
						<div class="banner-content">
							<h1 class="title"><?php echo $eka_breadcumb_title;?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Breadcumb -->
		<?php

	}
}
