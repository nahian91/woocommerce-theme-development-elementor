<?php
class Ekomart_Testimonial extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_testimonial_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Testimonial Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'review', 'testimonial' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_testimonials_list',
			[
				'label' => esc_html__( 'Testimonial', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_testimonials_items',
			[
				'label' => esc_html__( 'Testimonial List', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'eka_testimonials_image',
						'label' => esc_html__( 'Image', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
						'label_block' => true,
					],
					[
						'name' => 'eka_testimonials_name',
						'label' => esc_html__( 'Name', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'eka_testimonials_desg',
						'label' => esc_html__( 'Designation', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'eka_testimonials_logo',
						'label' => esc_html__( 'Logo', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
						'label_block' => true,
					],
					[
						'name' => 'eka_testimonials_speech',
						'label' => esc_html__( 'Speech', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'label_block' => true,
					],
				],
				'default' => [
					[
						'eka_testimonials_name' => esc_html__( 'Title #1', 'ekomart-elementor' )
					],
				],
				'title_field' => '{{{ eka_testimonials_name }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_testimonials_settings',
			[
				'label' => esc_html__( 'Settings', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_testimonials_space_between',
			[
				'label' => esc_html__( 'Space Between', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 5,
				'max' => 100,
				'step' => 5,
				'default' => 24,
			]
		);

		$this->add_control(
			'eka_testimonials_slide',
			[
				'label' => esc_html__( 'Slide Show', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 2,
			]
		);

		$this->add_control(
			'eka_testimonials_loop',
			[
				'label' => esc_html__( 'Loop Enable?', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'ekomart-elementor' ),
				'label_off' => esc_html__( 'Hide', 'ekomart-elementor' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'eka_testimonials_speed',
			[
				'label' => esc_html__( 'Speed', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 100,
				'max' => 10000,
				'step' => 100,
				'default' => 1000,
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

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$eka_testimonials_items = $settings['eka_testimonials_items'];
		$eka_testimonials_space_between = $settings['eka_testimonials_space_between'];
		$eka_testimonials_slide = $settings['eka_testimonials_slide'];
		$eka_testimonials_loop = $settings['eka_testimonials_loop'];
		$eka_testimonials_speed = $settings['eka_testimonials_speed'];
		?>
		<div class="customers-feedback-area-main-wrapper">
			<!-- rts category area satart -->
			<div class="caregory-area">
				<div class="row">
					<div class="col-lg-12">
						<div class="category-area-main-wrapper-one">
							<div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
								"spaceBetween":<?php echo $eka_testimonials_space_between; ?>,
								"slidesPerView":<?php echo $eka_testimonials_slide; ?>,
								"loop": <?php echo $eka_testimonials_loop; ?>,
								"speed": <?php echo $eka_testimonials_speed; ?>,
								"navigation":{
									"nextEl":".swiper-button-nexts",
									"prevEl":".swiper-button-prevs"
									},
								"breakpoints":{
								"0":{
									"slidesPerView":1,
									"spaceBetween": 24},
								"320":{
									"slidesPerView":1,
									"spaceBetween":24},
								"480":{
									"slidesPerView":1,
									"spaceBetween":24},
								"640":{
									"slidesPerView":1,
									"spaceBetween":24},
								"840":{
									"slidesPerView":1,
									"spaceBetween":24},
								"1140":{
									"slidesPerView":<?php echo $eka_testimonials_slide; ?>,
									"spaceBetween":<?php echo $eka_testimonials_space_between; ?>}
								}
							}'>
								<div class="swiper-wrapper">

								<?php 
									foreach($eka_testimonials_items as $item) {
										$eka_testimonials_image = $item['eka_testimonials_image']['url'];
										$eka_testimonials_name = $item['eka_testimonials_name'];
										$eka_testimonials_desg = $item['eka_testimonials_desg'];
										$eka_testimonials_logo = $item['eka_testimonials_logo']['url'];
										$eka_testimonials_speech = $item['eka_testimonials_speech'];

									?>
										<!-- single swiper start -->
									<div class="swiper-slide">
										<!-- single customers feedback area start -->
										<div class="single-customers-feedback-area">
											<div class="top-thumbnail-area">
												<div class="left">
													<img src="<?php echo $eka_testimonials_image; ?>" alt="logo">
													<div class="information">
														<h4 class="title">
															<?php echo $eka_testimonials_name;?>
														</h4>
														<span><?php echo $eka_testimonials_desg;?></span>
													</div>
												</div>
												<div class="right">
													<img src="<?php echo $eka_testimonials_logo;?>" alt="logo">
												</div>
											</div>
											<div class="body-content">
												<p class="disc">
													“<?php echo $eka_testimonials_speech;?>”
												</p>
											</div>
										</div>
										<!-- single customers feedback area end -->
									</div>
									<!-- single swiper start -->
									<?php
									}
								?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- rts category area end -->
		</div>
		<?php

	}
}
