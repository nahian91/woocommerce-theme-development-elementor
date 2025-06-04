<?php
class Ekomart_Banner extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_banner_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Banner Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'banner', 'slider' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_banner_list',
			[
				'label' => esc_html__( 'Banners', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_banner_items',
			[
				'label' => esc_html__( 'Banners List', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'eka_banner_image',
						'label' => esc_html__( 'Image', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::MEDIA,
						'default' => [
							'url' => \Elementor\Utils::get_placeholder_image_src(),
						],
						'label_block' => true,
					],
					[
						'name' => 'eka_banner_subheading',
						'label' => esc_html__( 'Sub Heading', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'label_block' => true,
					],
					[
						'name' => 'eka_banner_heading',
						'label' => esc_html__( 'Heading', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'eka_banner_desc',
						'label' => esc_html__( 'Description', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::TEXTAREA,
						'label_block' => true,
					],
					[
						'name' => 'eka_banner_link_title',
						'label' => esc_html__( 'Link Title', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::TEXT,
						'label_block' => true,
					],
					[
						'name' => 'eka_banner_link',
						'label' => esc_html__( 'Link', 'ekomart-elementor' ),
						'type' => \Elementor\Controls_Manager::URL,
						'options' => [ 'url', 'is_external', 'nofollow' ],
						'default' => [
							'url' => '',
							'is_external' => true,
							'nofollow' => true,
						],
						'label_block' => true,
					],
				],
				'default' => [
					[
						'eka_banner_heading' => esc_html__( 'Title #1', 'ekomart-elementor' )
					],
				],
				'title_field' => '{{{ eka_banner_heading }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_banner_settings',
			[
				'label' => esc_html__( 'Settings', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_banner_space_between',
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
			'eka_banner_slide',
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
			'eka_banner_loop',
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
			'eka_banner_speed',
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
		$eka_banner_items = $settings['eka_banner_items'];
		$swiper_config = json_encode([
			'spaceBetween' => $settings['eka_banner_space_between'],
			'slidesPerView' => $settings['eka_banner_slide'],
			'loop' => true,
			'speed' => 700,
			'effect' => 'fade',
			'navigation' => [
				'nextEl' => '.swiper-button-next',
				'prevEl' => '.swiper-button-prev',
			],
			'breakpoints' => [
				0 => ['slidesPerView' => 1, 'spaceBetween' => 0],
				320 => ['slidesPerView' => 1, 'spaceBetween' => 0],
				480 => ['slidesPerView' => 1, 'spaceBetween' => 0],
				640 => ['slidesPerView' => 1, 'spaceBetween' => 0],
				840 => ['slidesPerView' => 1, 'spaceBetween' => 0],
				1140 => ['slidesPerView' => 1, 'spaceBetween' => 0],
				1540 => ['slidesPerView' => 1, 'spaceBetween' => 0],
				1840 => ['slidesPerView' => 1, 'spaceBetween' => 0],
			],
		]);
		?>
		<div class="banner-swiper-main-wrapper" >
			<div class="swiper mySwiper-category-1 swiper-data" data-swiper='<?php echo $swiper_config;?>'>
			<div class="swiper-wrapper swiper-button-between">
                <?php 
					foreach($eka_banner_items as $item) {
						$item_image = $item['eka_banner_image']['url'];
						$item_subheading = $item['eka_banner_subheading'];
						$item_heading = $item['eka_banner_heading'];
						$item_desc = $item['eka_banner_desc'];
						$item_title = $item['eka_banner_link_title'];
						$item_link = $item['eka_banner_link']['url'];
						?>
							<!-- single swiper start -->
                <div class="swiper-slide">
                    <!-- rts banner area start -->
                    <div class="section-gap banner-area banner-bg-full" style="background-image: url('<?php echo $item_image;?>');">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="banner-inner-content-three">
                                        <span class="pre">
                                            <?php echo $item_subheading;?>
                                        </span>
                                        <h1 class="title">
                                            <?php echo $item_heading;?>
                                        </h1>
                                        <p class="dsicription">
                                            <?php echo $item_desc;?>
                                        </p>
                                        <a href="<?php echo $item_link;?>" class="main-btn btn-primary radious-sm with-icon">
                                            <div class="btn-text">
                                               <?php echo $item_title;?>
                                            </div>
                                            <div class="arrow-icon">
                                                <i class="fa-light fa-arrow-right"></i>
                                            </div>
                                            <div class="arrow-icon">
                                                <i class="fa-light fa-arrow-right"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- rts banner area end -->
                </div>
                <!-- single swiper start -->
				 
						<?php 
					}
				?>
                 <button class="swiper-button-next"><i class="fa-regular fa-arrow-right"></i></button>
                 <button class="swiper-button-prev"><i class="fa-regular fa-arrow-left"></i></button>
            </div>
		</div>
		<?php

	}
}
