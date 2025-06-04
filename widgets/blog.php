<?php
class Ekomart_Blog extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_blog_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Blog Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'blog', 'post' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_blog_content',
			[
				'label' => esc_html__( 'Content', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'ewa_post_category',
			[
				'label' => esc_html__( 'Post Category', 'ekomart-elementor' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $this->get_all_post_categories(),
				'default' => '',
			]
		);

		$this->end_controls_section();

		// Content Tab End

		// Style Tab Start

		$this->start_controls_section(
			'eka_blog_content_style',
			[
				'label' => esc_html__( 'Title', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_blog_color',
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
				'name' => 'eka_blog_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main .title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'eka_blog_desc_style',
			[
				'label' => esc_html__( 'Description', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'eka_blog_desc_color',
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
				'name' => 'eka_blog_desc_typography',
				'selector' => '{{WRAPPER}} .title-center-area-main p',
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	private function get_all_post_categories(): array {
		$terms = get_terms([
			'taxonomy'   => 'category',
			'hide_empty' => false,
		]);

		$options = [ '' => esc_html__( 'All Categories', 'your-textdomain' ) ];

		if ( ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$options[ $term->slug ] = $term->name;
			}
		}

		return $options;
	}


	protected function render(): void {
		// $settings = $this->get_settings_for_display();
		// $eka_blog_heading = $settings['eka_blog_heading'];
		// $eka_blog_desc = $settings['eka_blog_desc'];
		
		?>
			<div class="row">
				<?php 
					$args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                    );

					if ( ! empty( $settings['ewa_post_category'] ) ) {
						$args['tax_query'] = [
							[
								'taxonomy' => 'category',
								'field'    => 'slug',
								'terms'    => $settings['ewa_post_category'],
							],
						];
					}


					$query = new WP_Query($args);

					if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
							$query->the_post();
							?>
								<div class="col-lg-4">
									<div class="single-blog-area-start style-two">
										<a href="<?php the_permalink();?>" class="thumbnail">
											<?php the_post_thumbnail();?>
										</a>
										<div class="blog-body">
											<div class="top-area">
												<div class="single-meta">
													<i class="fa-light fa-clock"></i>
													<span><?php echo get_the_date('d M, Y');?></span>
												</div>
												<div class="single-meta">
													<i class="fa-regular fa-folder"></i>
													<span><?php the_category(', '); ?></span>
												</div>
											</div>
											<a href="<?php the_permalink();?>">
												<h4 class="title">
													<?php the_title();?>
												</h4>
											</a>
											<a href="<?php the_permalink();?>" class="shop-now-goshop-btn">
												<span class="text">Read Details</span>
												<div class="plus-icon">
													<i class="fa-sharp fa-regular fa-plus"></i>
												</div>
												<div class="plus-icon">
													<i class="fa-sharp fa-regular fa-plus"></i>
												</div>
											</a>
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
