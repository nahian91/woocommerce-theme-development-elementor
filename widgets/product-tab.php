<?php
class Ekomart_Product_Tab extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_product_tab_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Product Tab Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'product', 'tab' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_product_tab_content',
			[
				'label' => esc_html__( 'Content', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$cats = get_terms([
			'taxonomy' => 'product_cat',
			'hide_empty' => true,
		]);

		$options = [];
		foreach ($cats as $cat) {
			$options[$cat->term_id] = $cat->name;
		}

		$this->add_control(
			'eka_product_tab_cats',
			[
				'label' => esc_html__( 'Product Categories', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => true,
				'options' => $options,
				'default' => [],
			]
		);


		$this->end_controls_section();

		// Content Tab End

		// Style Tab Start

		$this->start_controls_section(
			'eka_product_tab_content_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_product_tab_color',
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
				'name' => 'eka_product_tab_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_product_tab_desc_style',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_product_tab_desc_color',
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
				'name' => 'eka_product_tab_desc_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main p',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$eka_product_tab_cats = $settings['eka_product_tab_cats'];
		// $eka_product_tab_desc = $settings['eka_product_tab_desc'];

		?>
		<!-- popular product area start -->
    <div class="popular-product-weekly-seller-item section-gap bg-light-1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-area-between">
                        <h2 class="title-left mb--0">
                            Popular Products
                        </h2>
                        <ul class="nav nav-tabs" id="myTabx" role="tablist">
							<?php 
								$i = 0;
								foreach($eka_product_tab_cats as $cat_id) {
									$i++;
									$term = get_term($cat_id, 'product_cat');
									$cat_name = $term->name;
									$cat_slug = $term->slug;
									?>
										<li class="nav-item" role="presentation">
											<button class="nav-link <?php if($i === 1) {echo 'active';} ?>" id="tab-<?php echo $cat_slug;?>" data-bs-toggle="tab" data-bs-target="#tab-<?php echo $cat_slug;?>" type="button" role="tab" aria-controls="tab-<?php echo $cat_slug;?>" aria-selected="<?php echo ($i === 1) ? 'true' : 'false'; ?>"> <?php echo $cat_name;?> </button>
										</li>
									<?php
								}
							?>
                          </ul>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="tab-content" id="myTabContentx">
						<?php 
							$i = 0;
							foreach($eka_product_tab_cats as $cat_id) {
								$i++;
								$term = get_term($cat_id, 'product_cat');
								$cat_pro_slug = $term->slug;
								?>
 						<div class="tab-pane fade <?php if($i == 1) {echo "show active";}?>" id="tab-<?php echo $cat_pro_slug;?>" role="tabpanel" aria-labelledby="tab-<?php echo $cat_pro_slug;?>" tabindex="0">
                            <div class="row g-4">
								<?php 
									$args = [
										'post_type' => 'product',
										'posts_per_page' => 4,
										'tax_query' => [
											[
												'taxonomy' => 'product_cat',
												'field' => 'term_id',
												'terms' => $cat_id,
											],
										],
									];
									$query = new WP_Query($args);
									while($query -> have_posts()) {
										$query->the_post();
										global $product;
										?>
 								<div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                    <div class="single-shopping-card-one">
                                        <!-- iamge and sction area start -->
                                        <div class="image-and-action-area-wrapper">
                                            <a href="<?php the_permalink();?>" class="thumbnail-preview">

<?php if ( $product->is_on_sale() ) : 
    $regular_price = (float) $product->get_regular_price();
    $sale_price = (float) $product->get_sale_price();
    if ( $regular_price > 0 ) {
        $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
    ?>
	<div class="badge">
	<span><?php echo esc_html( $percentage ); ?>% <br> 
		Off
	</span>
	<i class="fa-solid fa-bookmark"></i>
</div>
    <?php } ?>
<?php endif; ?>


                                                <?php the_post_thumbnail();?>
                                            </a>
                                        </div>
                                         <!-- iamge and sction area start -->
                                        <div class="body-content">
                                            <!-- <div class="time-tag">
                                                <i class="fa-light fa-clock"></i>
                                                9 MINS
                                            </div> -->
                                            <a href="<?php the_permalink();?>">
                                                <h4 class="title"><?php the_title();?></h4>
                                            </a>
											<?php 
											$weight = $product->get_weight();
											if($weight) {
												?>
													<span class="availability"><?php
											
											echo $product->get_weight();?> KG</span>
												<?php
											}
                                            ?>
                                            <div class="price-area">
                                                <span class="current"><?php echo wc_price( $product->get_regular_price() ); ?></span>
												<?php 
													if(!empty($product->get_sale_price())) {
													?>
														<div class="previous"><?php echo wc_price( $product->get_sale_price() ); ?></div>
													<?php 
													}
												?>
                                                
                                            </div>
<div class="cart-counter-action">
	<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<div class="quantity-edit">
				<input type="number" class="input" name="quantity" value="1" min="1">
				<div class="button-wrapper-action">
					<button type="button" class="button decrement"><i class="fa-regular fa-chevron-down"></i></button>
                	<button type="button" class="button increment">+<i class="fa-regular fa-chevron-up"></i></button>
				</div>
			</div>

			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>">

			<button type="submit" class="main-btn btn-primary radious-sm with-icon">
				<div class="btn-text">
					Add To Cart
				</div>
				<div class="arrow-icon">
					<i class="fa-regular fa-cart-shopping"></i>
				</div>
				<div class="arrow-icon">
					<i class="fa-regular fa-cart-shopping"></i>
				</div>
			</button>
	</form>
</div>
                                        </div>
                                    </div>
                                </div>
										<?php
									}
								?>
                               
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
    <!-- popular product area end -->
		<?php
	}
}
