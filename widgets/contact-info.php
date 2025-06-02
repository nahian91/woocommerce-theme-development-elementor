<?php
class Ekomart_Contact_Info extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'ekomart_contact_info_widget';
	}

	public function get_title(): string {
		return esc_html__( 'Contact Info Widget', 'ekomart-elementor' );
	}

	public function get_icon(): string {
		return 'eicon-code';
	}

	public function get_categories(): array {
		return [ 'ekomart-category' ];
	}

	public function get_keywords(): array {
		return [ 'contact', 'info' ];
	}

	protected function register_controls(): void {

		$this->start_controls_section(
			'eka_contact_info_content',
			[
				'label' => esc_html__( 'Content', 'ekomart-elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eka_contact_info_icon',
			[
				'label' => esc_html__( 'Icon', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'eka_contact_info_heading',
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

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render(): void {
		$settings = $this->get_settings_for_display();
		$eka_contact_info_icon = $settings['eka_contact_info_icon']['value'];
		$eka_contact_info_heading = $settings['eka_contact_info_heading'];
		?>
		<div class="contact-left-area-main-wrapper">                        
			<div class="location-single-card">
				<div class="icon">
					<i class="<?php echo $eka_contact_info_icon;?>"></i>
				</div>
				<div class="information">
					<h3 class="title"><?php echo $eka_contact_info_heading;?></h3>
				</div>
			</div>
		</div>
		<?php
	}
}
