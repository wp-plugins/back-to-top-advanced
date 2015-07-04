<?php
class BackToTopAdvnacedAdmin
{
	private $options;
	
	/**
	 * Admin construct
	 */
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'btta_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'btta_page_init' ) );
	}
	
	/**
	 * Admin option page add
	 */
	public function btta_plugin_page()
	{
		add_options_page(
				__("Back To Top Advanced Settings", "back-to-top-advanced"),
				__("Back To Top Advanced Settings", "back-to-top-advanced"),
				'manage_options',
				'btta-admin-page',
				array( $this, 'btta_admin_page' )
		);
	}
	
	/**
	 * Admin page html
	 */
	public function btta_admin_page()
	{
		$this->options = get_option( 'btta_settings' );		
		?>
        <div class="wrap">
            <h2><?php echo __("Back To Top Advanced Settings", "back-to-top-advanced"); ?></h2>           
            <form method="post" action="options.php">
            <?php
                settings_fields( 'btta_settings_group' );   
                do_settings_sections( 'btta-admin-page' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }
    
    /**
     * Setting fields for Wordpress api
     */
    public function btta_page_init()
    {
    	//register setting
        register_setting(
            'btta_settings_group',
            'btta_settings',
            array( $this, 'sanitize' )
        );
		// main settings section
        add_settings_section(
            'btta_settings_group_id',
            __("Main Settings", "back-to-top-advanced"),
            array( $this, 'print_section_info' ),
            'btta-admin-page'
        );  
        
        add_settings_field(
        		'enable',
        		__("Enable Back To Top Advanced", "back-to-top-advanced"),
        		array( $this, 'btta_enable_cb' ),
        		'btta-admin-page',
        		'btta_settings_group_id'
        );
        
        add_settings_field(
            'color',
            __("Color scheme", "back-to-top-advanced"),
            array( $this, 'btta_color_cb' ),
            'btta-admin-page',
            'btta_settings_group_id'        
        );  
            
		//fields settings section
        add_settings_section(
        		'btta_settings_group_id2',
        		__("Field Settings", "back-to-top-advanced"),
        		array( $this, 'print_section_info2' ),
        		'btta-admin-page'
        );
        add_settings_field(
        		'enable_text',
        		__("Enable content editor", "back-to-top-advanced"),
        		array( $this, 'btta_enable_text_cb' ),
        		'btta-admin-page',
        		'btta_settings_group_id2'
        );
        
        add_settings_field(
        		'enable_hellpers',
        		__("Enable user helper", "back-to-top-advanced"),
        		array( $this, 'btta_enable_hellpers_cb' ),
        		'btta-admin-page',
        		'btta_settings_group_id2'
        );
        
        add_settings_field(
        		'enable_social',
        		__("Enable social", "back-to-top-advanced"),
        		array( $this, 'btta_enable_social_cb' ),
        		'btta-admin-page',
        		'btta_settings_group_id2'
        );
        
        add_settings_field(
            'facebook', 
            __("Facebook url", "back-to-top-advanced"), 
            array( $this, 'btta_facebook_cb' ), 
            'btta-admin-page', 
            'btta_settings_group_id2'
        );

        add_settings_field(
        		'twitter',
        		__("Twitter url", "back-to-top-advanced"),
        		array( $this, 'btta_twitter_cb' ),
        		'btta-admin-page',
        		'btta_settings_group_id2'
        );

        add_settings_field(
        		'instagram',
        		__("Instagram url", "back-to-top-advanced"),
        		array( $this, 'btta_instagram_cb' ),
        		'btta-admin-page',
        		'btta_settings_group_id2'
        );

        add_settings_field(
        		'youtube',
        		__("Youtube url", "back-to-top-advanced"),
        		array( $this, 'btta_youtube_cb' ),
        		'btta-admin-page',
        		'btta_settings_group_id2'
        );

        add_settings_field(
        		'google',
        		__("Google plus url", "back-to-top-advanced"),
        		array( $this, 'btta_google_cb' ),
        		'btta-admin-page',
        		'btta_settings_group_id2'
        );
    }

    /**
     * After input sanitize
     * @param string $input
     * @return multitype:string Ambigous <string, mixed>
     */
    public function sanitize( $input )
    {
        $new_input = array();

        if( isset( $input['color'] ) )
            $new_input['color'] = sanitize_text_field( $input['color'] );

        if( isset( $input['enable'] ) )
            $new_input['enable'] = sanitize_text_field( $input['enable'] );

        if( isset( $input['facebook'] ) )
        	$new_input['facebook'] = sanitize_text_field( $input['facebook'] );

        if( isset( $input['twitter'] ) )
        	$new_input['twitter'] = sanitize_text_field( $input['twitter'] );

        if( isset( $input['instagram'] ) )
        	$new_input['instagram'] = sanitize_text_field( $input['instagram'] );

        if( isset( $input['youtube'] ) )
        	$new_input['youtube'] = sanitize_text_field( $input['youtube'] );

        if( isset( $input['google'] ) )
        	$new_input['google'] = sanitize_text_field( $input['google'] );

        if( isset( $input['enable_hellpers'] ) )
        	$new_input['enable_hellpers'] = sanitize_text_field( $input['enable_hellpers'] );

        if( isset( $input['enable_text'] ) )
        	$new_input['enable_text'] = sanitize_text_field( $input['enable_text'] );

        if( isset( $input['enable_social'] ) )
        	$new_input['enable_social'] = sanitize_text_field( $input['enable_social'] );
        
        return $new_input;
    }
    
    /**
     * Output main section intro
     */
    public function print_section_info()
    {
        print __("Back to top advanced main settings section.", "back-to-top-advanced");
    }
    
    /**
     * Output fields section intro
     */
    public function print_section_info2()
    {
        print __("Back to top advanced field settings section.<br /> If social link url is empty then wont be shown in user interface.", "back-to-top-advanced");
    }
    
    /**
     * Facebook callback function
     */
    public function btta_facebook_cb()
    {
    	printf(
    			'<input type="text" id="facebook" name="btta_settings[facebook]" value="%s" />',
    			isset( $this->options['facebook'] ) ? esc_attr( $this->options['facebook']) : ''
    	);
    }
    
    /**
     * Twitter callback function
     */
    public function btta_twitter_cb()
    {
    	printf(
    			'<input type="text" id="twitter" name="btta_settings[twitter]" value="%s" />',
    			isset( $this->options['twitter'] ) ? esc_attr( $this->options['twitter']) : ''
    	);
    }
    
    /**
     * Instagram callback function
     */
    public function btta_instagram_cb()
    {
    	printf(
    			'<input type="text" id="instagram" name="btta_settings[instagram]" value="%s" />',
    			isset( $this->options['instagram'] ) ? esc_attr( $this->options['instagram']) : ''
    	);
    }
    
    /**
     * Youtube callback function
     */
    public function btta_youtube_cb()
    {
    	printf(
    			'<input type="text" id="youtube" name="btta_settings[youtube]" value="%s" />',
    			isset( $this->options['youtube'] ) ? esc_attr( $this->options['youtube']) : ''
    	);
    }
    
    /**
     * Google callback function
     */
    public function btta_google_cb()
    {
    	printf(
    			'<input type="text" id="google" name="btta_settings[google]" value="%s" />',
    			isset( $this->options['google'] ) ? esc_attr( $this->options['google']) : ''
    	);
    }
    
    /**
     * Color scheme callback function
     */
    public function btta_color_cb()
    {
    	printf('<select name="btta_settings[color]">
    		<option value="white" '.selected( $this->options["color"], "white", false ).'>'.__("White", "back-to-top-advanced").'</option>
    	    <option value="black" '.selected( $this->options["color"], "black", false ).'>'.__("Black", "back-to-top-advanced").'</option>
    	</select>');

    }

    /**
     * BTTA enable callback function
     */
    public function btta_enable_cb()
    {
    	printf('<select name="btta_settings[enable]">
    		<option value="true" '.selected( $this->options["enable"], "true", false ).'>'.__("Enable", "back-to-top-advanced").'</option>
    	    <option value="" '.selected( $this->options["enable"], "", false ).'>'.__("Disable", "back-to-top-advanced").'</option>
    	</select>');
    }
    
    /**
     * BTTA content editor enable callback function
     */
    public function btta_enable_text_cb()
    {
    	printf('<select name="btta_settings[enable_text]">
    		<option value="true" '.selected( $this->options["enable_text"], "true", false ).'>'.__("Enable", "back-to-top-advanced").'</option>
    	    <option value="" '.selected( $this->options["enable_text"], "", false ).'>'.__("Disable", "back-to-top-advanced").'</option>
    	</select>');
    }

    /**
     * BTTA hellper enable callback function
     */
    public function btta_enable_hellpers_cb()
    {
    	printf('<select name="btta_settings[enable_hellpers]">
    		<option value="true" '.selected( $this->options["enable_hellpers"], "true", false ).'>'.__("Enable", "back-to-top-advanced").'</option>
    	    <option value="" '.selected( $this->options["enable_hellpers"], "", false ).'>'.__("Disable", "back-to-top-advanced").'</option>
    	</select>');
    }

    /**
     * BTTA social editor enable callback function
     */
    public function btta_enable_social_cb()
    {
    	printf('<select name="btta_settings[enable_social]">
    		<option value="true" '.selected( $this->options["enable_social"], "true", false ).'>'.__("Enable", "back-to-top-advanced").'</option>
    	    <option value="" '.selected( $this->options["enable_social"], "", false ).'>'.__("Disable", "back-to-top-advanced").'</option>
    	</select>');
    }

    /**
     * BTTA install hook
     */
    static function plugin_activation() {
    	
    	$data = array(
    			"color" => "white",
    			"enable" => "true",
    			"enable_text" => "true",
    			"enable_hellpers" => "true",
    			"enable_social" => "true",
    	);
    	
		add_option('btta_settings', $data);
    }

    /**
     * BTTA delete hook
     */
    static function plugin_deactivation() {
    	delete_option('btta_settings');
    }
    
    /**
     * Add simple link for better ux
     * @param array $links
     * @return array
     */
    public static function btta_settings_link ( $links ) {
    	$mylinks = array(
    			'<a href="' . admin_url( 'options-general.php?page=btta-admin-page' ) . '">Settings</a>',
    	);
    	return array_merge( $links, $mylinks );
    }
}