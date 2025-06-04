<?php
class Ekomart_Categories extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_categories_slider_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Categories Slider Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'categories', 'slider' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_categories_slider_content',
			[
				'label' => esc_html__( 'Content', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_categories_slider_heading',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// Content Tab End

		// Style Tab Start

		$this->start_controls_section(
			'eka_section_title_content_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_section_title_color',
			[
				'label' => esc_html__( 'Color', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-center-area-main .title' => 'color: {{VALUE}};',
				],
				'default' => ''
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'eka_section_title_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_section_title_desc_style',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_section_title_desc_color',
			[
				'label' => esc_html__( 'Color', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .title-center-area-main p' => 'color: {{VALUE}};',
				],
				'default' => ''
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'eka_section_title_desc_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main p',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$eka_categories_slider_heading = $settings['eka_categories_slider_heading'];

		$product_categories = get_terms([
			'taxonomy'   => 'product_cat',
			'hide_empty' => true,
		]);

		?>

		<!-- rts categorya area start -->
    <div class="category-area section-gapTop">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-between">
                        <h2 class="title-left mb--0">
                            <?php echo $eka_categories_slider_heading;?>
                        </h2>
                        <div class="next-prev-swiper-wrapper">
                            <div class="swiper-button-prev"><i class="fa-regular fa-chevron-left"></i></div>
                            <div class="swiper-button-next"><i class="fa-regular fa-chevron-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="cover-card-main-over">
                        <!-- category area satart -->
                        <div class="caregory-area">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="category-area-main-wrapper-one">
                                            <div class="swiper mySwiper-category-1 swiper-data" data-swiper='{
                                                "spaceBetween":12,
                                                "slidesPerView":7,
                                                "loop": true,
                                                "speed": 1000,
                                                "navigation":{
                                                    "nextEl":".swiper-button-next",
                                                    "prevEl":".swiper-button-prev"
                                                  },
                                                "breakpoints":{
                                                "0":{
                                                    "slidesPerView":2,
                                                    "spaceBetween": 12},
                                                "320":{
                                                    "slidesPerView":2,
                                                    "spaceBetween":12},
                                                "480":{
                                                    "slidesPerView":3,
                                                    "spaceBetween":12},
                                                "640":{
                                                    "slidesPerView":4,
                                                    "spaceBetween":12},
                                                "840":{
                                                    "slidesPerView":4,
                                                    "spaceBetween":12},
                                                "1140":{
                                                    "slidesPerView":7,
                                                    "spaceBetween":12}
                                                }
                                            }'>
<div class="swiper-wrapper">
	<?php 
		foreach($product_categories as $item) {
			$cat_name = $item ->name;
			$cat_link = get_term_link( $item );
			$cat_thumbnail_id = get_term_meta( $item->term_id, 'thumbnail_id', true );
			$cat_image_url = wp_get_attachment_url( $cat_thumbnail_id );
			?>
			<div class="swiper-slide">
				<div class="single-category-one">
					<a href="<?php echo $cat_link;?>">
					<img src="<?php echo $cat_image_url;?>" alt="<?php echo $cat_name;?>">
					<p><?php echo $cat_name;?></p>
					</a>
				</div>
			</div>
			<?php
		}
	?>
</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- category area end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- categorya area end -->
		<?php
	}
}
