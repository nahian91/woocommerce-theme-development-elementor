<?php
class Ekomart_Product_Selected extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_product_selected_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Product Selected Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'product', 'selected' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_product_selected_content',
			[
				'label' => esc_html__( 'Content', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_product_selected_heading',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'product_select',
			[
				'label'       => esc_html__( 'Select Products', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => $this->get_woocommerce_products(),
				'default'     => [],
			]
		);


		$this->end_controls_section();

		// Content Tab End

		// Style Tab Start

		$this->start_controls_section(
			'eka_product_selected_content_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_product_selected_color',
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
				'name' => 'eka_product_selected_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_product_selected_desc_style',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_product_selected_desc_color',
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
				'name' => 'eka_product_selected_desc_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main p',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function get_woocommerce_products() {
    $products = [];

    $args = [
        'post_type'      => 'product',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    ];

    $query = new \WP_Query( $args );

    if ( $query->have_posts() ) {
        foreach ( $query->posts as $post ) {
            $products[ $post->ID ] = get_the_title( $post->ID );
        }
    }

    wp_reset_postdata();

    return $products;
}


	protected function render(): void {
		$settings = $this->get_settings_for_display();
		// $filter_type = $settings['product_selected_filter_type'];
		$eka_product_selected_heading = $settings['eka_product_selected_heading'];
		$product_select = $settings['product_select'];
		// $eka_product_selected_desc = $settings['eka_product_selected_desc'];

		?>
		<div class="weekly-best-deals-top-primary-wrapper">
			<div class="title-area-between with-progress">
				<h2 class="title-left color-white mb--0">
					<?php echo $eka_product_selected_heading; ?>
				</h2>
			</div>
			<div class="body-best-deals-padding">
				<div class="row g-4">
					<?php 
						$args = [
							'post_type'      => 'product',
							'posts_per_page' => 3, 
							'post_status'    => 'publish',
							'post__in'       => $product_select,
						];

						$loop = new WP_Query( $args );
							if($loop->have_posts()) {
								while ( $loop->have_posts() ) {
								$loop->the_post();
								global $product;
					?>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
						<div class="single-shopping-card-one tranding-product with-progress">
							<a href="<?php the_permalink();?>" class="thumbnail-preview">
								<?php echo woocommerce_get_product_thumbnail();?>
							</a>
							<div class="body-content">
								<div class="top">
									<div class="stars-area">
										<?php 
											$product = wc_get_product( get_the_ID() );
											$average = floatval( $product->get_average_rating() );
											for ( $i = 1; $i <= 5; $i++ ) {
												if ( $average >= $i ) {
													// Full star
													echo '<i class="fa-solid fa-star"></i>';
												} elseif ( $average >= ( $i - 0.5 ) ) {
													// Half star
													echo '<i class="fa-solid fa-star-half-stroke"></i>';
												} else {
													// Empty star
													echo '<i class="fa-regular fa-star"></i>';
												}
											}
										?>
										<span>(<?php echo $product->get_review_count();?> Reviews)</span>
									</div>
									<a href="<?php the_permalink();?>">
										<h4 class="title"><?php the_title();?></h4>
									</a>
									<div class="price-area">
										<span class="current"><?php echo wc_price( $product->get_regular_price() ); ?></span>
										<?php 
											if($product->get_sale_price()) {
												?>
													<div class="previous"><?php echo wc_price( $product->get_sale_price() ); ?></div>
												<?php
											}
										?>
									</div>
								</div>
								<?php
global $product;

// Get stock quantity and status
$stock_quantity = $product->get_stock_quantity();
$stock_status   = $product->get_stock_status();

// Determine stock label
$stock_label = ( 'outofstock' === $stock_status ) ? 'Out of Stock' : 'In Stock';

// Determine progress %: full bar if in stock, empty if out
$progress = ( 'outofstock' === $stock_status ) ? 0 : 100;
?>
<div class="bottom-content-deals mt--10">
    <span><?php echo esc_html( $stock_label ); ?></span>
    <div class="single-progress-area-incard">
        <div class="progress">
            <div class="progress-bar wow fadeInLeft" 
                 role="progressbar" 
                 style="width: <?php echo esc_attr( $progress ); ?>%;" 
                 aria-valuenow="<?php echo esc_attr( $progress ); ?>" 
                 aria-valuemin="0" 
                 aria-valuemax="100">
            </div>
        </div>
    </div>
</div>

							</div>
						</div>
					</div>
					<?php 
						}	}
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
