<?php
class VSSP_Admin {
	
	private $options;
	private $page_hook;
	
	public function __construct() {

	
		add_action( 'admin_menu', array( $this, 'vssp_menu' ) );
		add_action( 'admin_init', array($this,'vssp_settings_init') );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		if (isset($_GET['do']) && $_GET['do'] == 'clear-cookies') {

			$config['cookie_name']	= 'vssp_cookie_' . wp_create_nonce( time() );
			update_option( 'vssp_settings', $config );
			//header('Location: admin.php?page=vssp-options.php');
			add_action( 'admin_notices', array($this,'success_notice') );
		}
					
	}
	
	public function vssp_menu() {

		$this->page_hook = add_menu_page( 'Very Simple Splash Page', 'Very Simple Splash Page', 'manage_options', 'vssp-options.php', array( $this, 'vssp_settings' ), 'dashicons-admin-page', 61.5 );

	}
	
	public function vssp_settings() {
	?>
		<div class="wrap">
            <h2>Very Simple Splash Page <?php echo VS_SPLASH_PAGE_VERSION; ?></h2>        
            <form method="post" action="options.php">
            <table>
            	<tr>
            		<td valign="top">
            <?php
                settings_fields( 'vssp_settings' );   
                do_settings_sections( 'vssp_settings' );
                $options = get_option( 'vssp_options' );

                dc_section('Settings');
            	dc_checkbox('Enable Splash Page', array('name'=>'vssp_options[enable_vs]', 'checked'=>( isset($options['enable_vs']) && $options['enable_vs']  == '1' ? 'checked' : '')), '1' );
            	//dc_number('Days until splash page appear', array('name'=>'vssp_options[cookie_expiration]', 'hint'=>'If 0, it will appear every session.', 'min' => 0, 'max' => 60), $options['cookie_expiration']);
            	//echo '<p><a href="admin.php?page=vssp-options.php&do=clear-cookies" class="button button-primary">Clear Cookies</a></p>';

           		dc_section('Content');
            	dc_textarea('Text', array('name'=>'vssp_options[text]'), $options['text']);
            	dc_number('Text Size', array('name'=>'vssp_options[text_size]'), $options['text_size']);
            	dc_color('Text Color', array('name'=>'vssp_options[text_color]','color'=>'#fff'), $options['text_color']);

            	
            ?>
            		</td>
            		<td width="50"></td>
            		<td valign="top">
            <?php
            	dc_section('Background');
            	dc_upload('Background Image', array('name'=>'vssp_options[background_image]', 'id'=>'bg-image'), $options['background_image'], array('type'=>'image'));
            	dc_upload('Background Video', array('name'=>'vssp_options[background_video]', 'id'=>'bg-video'), $options['background_video'], array('type'=>'video'));
                dc_radio('Background Type', array('name' => 'vssp_options[background_type]', 'hint' => 'If background type is video, please add the image thumbnail of the video in "Background Image" field.'), array('image','video'), $options['background_type']);


            	dc_section('Button');
            	dc_text('Button Text', array('name'=>'vssp_options[button_text]'), $options['button_text']);
            	dc_number('Button Text Size', array('name'=>'vssp_options[button_text_size]'), $options['button_text_size']);
            	dc_color('Button Text Color', array('name'=>'vssp_options[button_text_color]','color'=>'#fff'), $options['button_text_color']);
            	dc_color('Button Background Color', array('name'=>'vssp_options[button_bg_color]','color'=>'#fff'), $options['button_bg_color']);
            	
            	submit_button();
            ?>
            		</td>
            	</tr>
           </table>
            </form>
 		</div>
	<?php	
	}

	function vssp_settings_init() {
        register_setting( 'vssp_settings', 'vssp_options' );
    }
	
	public function enqueue_scripts( $hook ) {

		wp_enqueue_media();
    	wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_script( 'vssp-scripts', VS_SPLASH_PAGE_ROOT_URL.'assets/js/admin-scripts.js', array('wp-color-picker') );
	}

	public function success_notice() {
    ?>
    <div class="updated">
        <p>Cookies are now cleared.</p>
    </div>
    <?php
	}

}
?>