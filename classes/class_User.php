<?php
class BackToTopAdvnaced
{
	/**
	 * All data
	 * @var array
	 */
	private $options;
	
	/**
	 * User construct
	 */
	public function __construct()
	{		
		$this->options = get_option( 'btta_settings' );
		add_action( 'wp_enqueue_scripts', array( $this, 'loadStyles' ) );
		add_action( 'wp_footer', array( $this, 'showBox' ) );
	}
	
	/**
	 * Loads styles and scripts
	 */
	public function loadStyles ()
	{
		wp_enqueue_style('back-to-top-advanced-style-font-awesome-4.3.0', plugins_url( '../assets/font-awesome-4.3.0/css/font-awesome.min.css', __FILE__ ), array(), '4.3.0', 'all');
		wp_enqueue_style('back-to-top-advanced-style', plugins_url( '../assets/style.css', __FILE__ ), array(), 1, 'all');
		//wp_enqueue_script('back-to-top-advanced-easing', plugins_url( '../assets/jquery.easing.1.3.js', __FILE__ ),array('jquery'),'1.3',false);		
		wp_enqueue_script('back-to-top-advanced-js', plugins_url( '../assets/script.js', __FILE__ ),array('jquery','jquery-core'),1,false);		
	}
	
	/**
	 * Output home url for better ux
	 */
	public function outputHellpers() {
		?><div class="button-advanced"><a href="<?php echo bloginfo('url') ?>"><i class="fa fa-lg fa-home"></i></a></div><?php
	}
	
	/**
	 * Output social links if set
	 */
	public function outputSocial() {
		if (!empty($this->options['facebook'])) {
			?><div class="button-advanced"><a href="<?php echo $this->options['facebook']; ?>" target="_blank"><i class="fa fa-lg fa-facebook-official"></i></a></div><?php
		}
		if (!empty($this->options['twitter'])) {
			?><div class="button-advanced"><a href="<?php echo $this->options['twitter']; ?>" target="_blank"><i class="fa fa-lg fa-twitter-square"></i></a></div><?php
		}
		if (!empty($this->options['youtube'])) {
			?><div class="button-advanced"><a href="<?php echo $this->options['youtube']; ?>" target="_blank"><i class="fa fa-lg fa-youtube-square"></i></a></div><?php
		}
		if (!empty($this->options['instagram'])) {
			?><div class="button-advanced"><a href="<?php echo $this->options['instagram']; ?>" target="_blank"><i class="fa fa-lg fa-instagram"></i></a></div><?php
		}
		if (!empty($this->options['google'])) {
			?><div class="button-advanced"><a href="<?php echo $this->options['google']; ?>" target="_blank"><i class="fa fa-lg fa-google-plus-square"></i></a></div><?php
		}
	}
	
	/**
	 * Output html block
	 * Checks what is enabled and outputs it.
	 */
	public function showBox ()
	{
		?>
		<?php if ($this->options['enable']) { ?>
		<div class="back-to-top-advanced no-js btta-<?php echo $this->options['color']; ?>">
		
			<?php if ($this->options['enable_hellpers']) { ?>
			<div class="back-to-top-advanced-top">
				<?php $this->outputHellpers(); ?>
			</div>
			<div class="back-to-top-advanced-clearfix"></div>
			<?php } ?>
			
			<div class="back-to-top-advanced-left">
				<?php if ($this->options['enable_social']) { ?>
				<div class="back-to-top-advanced-social">
					<?php $this->outputSocial(); ?>
				</div>
				<?php } ?>
				<?php if ($this->options['enable_text']) { ?>
				<div class="back-to-top-advanced-options">
					<div class="button-advanced button-advanced-background"><i class="fa fa-lg fa-square-o"></i></div>
					<div class="button-advanced button-advanced-textsize"><i class="fa fa-lg fa-text-height"></i></div>
				</div>
				<?php } ?>
			</div>
			
			<div class="back-to-top-advanced-buttons">
				<div class="button-advanced button-advanced-settings"><i class="btta-toggle fa fa-lg fa-angle-left"></i></div>
				<div class="button-advanced button-advanced-up"><i class="fa fa-lg fa-angle-up"></i></div>
			</div>
			<div class="back-to-top-advanced-clearfix"></div>
			
		</div>
		<?php } ?>
		<?php
	}
}