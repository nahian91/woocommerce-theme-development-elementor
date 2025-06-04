<?php
class Ekomart_Product_List extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_product_list_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Product List Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'product', 'list' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_product_list_content',
			[
				'label' => esc_html__( 'Content', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_product_list_heading',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'product_list_filter_type',
			[
				'label' => esc_html__( 'Product Filter Type', 'your-plugin-textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'latest',
				'label_block' => true,
				'options' => [
					'latest'        => esc_html__( 'Latest Products', 'your-plugin-textdomain' ),
					'sale'          => esc_html__( 'Sale Products', 'your-plugin-textdomain' ),
					'featured'      => esc_html__( 'Featured Products', 'your-plugin-textdomain' ),
					'best_selling'  => esc_html__( 'Best Selling Products', 'your-plugin-textdomain' ),
					'top_rated'     => esc_html__( 'Top Rated Products', 'your-plugin-textdomain' ),
					'random'        => esc_html__( 'Random Products', 'your-plugin-textdomain' ),
				],
			]
		);

		$this->add_control(
			'eka_product_list_number',
			[
				'label' => esc_html__( 'Numbers', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'label_block' => true,
			]
		);

		$this->end_controls_section();

		// Content Tab End

		// Style Tab Start

		$this->start_controls_section(
			'eka_product_list_content_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_product_list_color',
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
				'name' => 'eka_product_list_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_product_list_desc_style',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_product_list_desc_color',
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
				'name' => 'eka_product_list_desc_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main p',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$filter_type = $settings['product_list_filter_type'];
		$eka_product_list_number = $settings['eka_product_list_number'];
		$eka_product_list_heading = $settings['eka_product_list_heading'];
		// $eka_product_list_desc = $settings['eka_product_list_desc'];

		?>
		<div class="feature-product-list-wrapper">
			<div class="title-area">
				<h2 class="title">
					<?php echo $eka_product_list_heading; ?>
				</h2>
			</div>
			<?php 
				$args = [
					'post_type'      => 'product',
					'posts_per_page' => $eka_product_list_number, // -1 means all products
					'post_status'    => 'publish',
				];

				switch ( $filter_type ) {
					case 'sale':
						$args['meta_query'][] = [
							'key'     => '_sale_price',
							'value'   => 0,
							'compare' => '>',
							'type'    => 'NUMERIC',
						];
						break;

					case 'featured':
						$args['tax_query'][] = [
							'taxonomy' => 'product_visibility',
							'field'    => 'name',
							'terms'    => 'featured',
							'operator' => 'IN',
						];
						break;

					case 'best_selling':
						$args['meta_key'] = 'total_sales';
						$args['orderby']  = 'meta_value_num';
						$args['order']    = 'DESC';
						break;

					case 'top_rated':
						$args['meta_key'] = '_wc_average_rating';
						$args['orderby']  = 'meta_value_num';
						$args['order']    = 'DESC';
						break;

					case 'random':
						$args['orderby'] = 'rand';
						break;

					case 'latest':
					default:
						$args['orderby'] = 'date';
						$args['order']   = 'DESC';
						break;
				}


				$loop = new WP_Query( $args );
				if($loop->have_posts()) {
					while ( $loop->have_posts() ) {
        			$loop->the_post();
					global $product;
						?>
							<div class="single-product-list">
								<a href="<?php the_permalink();?>" class="thumbnail">
									<?php echo woocommerce_get_product_thumbnail();?>
								</a>
								<div class="body-content">
									<div class="top">
										<div class="stars-area">
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
											<i class="fa-solid fa-star"></i>
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
								</div>
							</div>
						<?php 
					}
				}
			?>
		</div>
		<?php
	}
}
