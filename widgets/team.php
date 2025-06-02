<?php
class Ekomart_Team extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_team_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Team Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'team' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_team_image_content',
			[
				'label' => esc_html__( 'Image', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_team_image',
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
			'eka_team_title_content',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_team_title',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'eka_team_desg',
			[
				'label' => esc_html__( 'Designation', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_team_info_content',
			[
				'label' => esc_html__( 'Info', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_team_phone',
			[
				'label' => esc_html__( 'Phone', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'eka_team_phone_link',
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
			'eka_team_title_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_team_title_color',
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
				'name' => 'eka_team_title_typography',
				'selector' => '{{WRAPPER}} .about-content-area-1 .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_team_desg_style',
			[
				'label' => esc_html__( 'Dessignation', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_team_desg_color',
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
				'name' => 'eka_team_desg_typography',
				'selector' => '{{WRAPPER}} .about-content-area-1 p.disc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_team_phone_style',
			[
				'label' => esc_html__( 'Phone', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_team_phone_color',
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
				'name' => 'eka_team_phone_typography',
				'selector' => '{{WRAPPER}} .about-content-area-1 p.disc',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$eka_team_image = $settings['eka_team_image']['url'];
		$eka_team_title = $settings['eka_team_title'];
		$eka_team_desg = $settings['eka_team_desg'];
		$eka_team_phone = $settings['eka_team_phone'];
		$eka_team_phone_link = $settings['eka_team_phone_link']['url'];

		?>
		<div class="single-team">
			<a href="#" class="thumbnail">
				<img src="<?php echo $eka_team_image;?>" alt="team_single">
			</a>
			<div class="bottom-content-area">
				<div class="top">
					<h3 class="title">
						<?php echo $eka_team_title;?>
					</h3>
					<span class="designation"><?php echo $eka_team_desg;?></span>
				</div>
				<div class="bottom">
					<a href="<?php echo $eka_team_phone_link;?>" class="number">
						<i class="fa-solid fa-phone-rotary"></i>
						<?php echo $eka_team_phone;?>
					</a>
				</div>
			</div>
		</div>
		<?php

	}
}
