<?php 
/**
 * @package  DavisPlugin
 */
namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;


class Admin extends BaseController
{
	public $settings;

	public $callbacks;

	public $callbacks_mngr;

	public $pages = array();

	public $subpages = array();

	public function register() 
	{

		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->setSettings();

		$this->setSections();

		$this->setFields();

		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}
	
	public function setPages() 
	{
		$this->pages = array(
			array(
				'page_title' => 'Davis Plugin', 
				'menu_title' => 'Admin_Settings', 
				'capability' => 'manage_options', 
				'menu_slug' => 'davis_plugin', 
				'callback' => array( $this->callbacks, 'adminDashboard' ), 
				'icon_url' => 'dashicons-admin-generic', 
				'position' => 110
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'davis_plugin', 
				'page_title' => 'Custom Post Types', 
				'menu_title' => 'CPT', 
				'capability' => 'manage_options', 
				'menu_slug' => 'davis_cpt', 
				'callback' => array( $this->callbacks, 'adminCpt' )
			),
			array(
				'parent_slug' => 'davis_plugin', 
				'page_title' => 'Custom Taxonomies', 
				'menu_title' => 'Taxonomies', 
				'capability' => 'manage_options', 
				'menu_slug' => 'davis_taxonomies', 
				'callback' => array( $this->callbacks, 'adminTaxonomy' )
			),
			array(
				'parent_slug' => 'davis_plugin', 
				'page_title' => 'Custom Widgets', 
				'menu_title' => 'Widgets', 
				'capability' => 'manage_options', 
				'menu_slug' => 'davis_widgets', 
				'callback' => array( $this->callbacks, 'adminWidget' )
			)
		);
	}

	public function setSettings()
	{
		$args = array(
			array(
				'option_group' => 'davis_plugin_settings',
				'option_name' => 'cpt_manager',
				'callback' => array( $this->callbacks, 'checkboxClear' )
			),
			array(
				'option_group' => 'davis_plugin_settings',
				'option_name' => 'taxonomy_manager',
				'callback' => array( $this->callbacks, 'checkboxClear' )
			),
			array(
				'option_group' => 'davis_plugin_settings',
				'option_name' => 'media_widget',
				'callback' => array( $this->callbacks, 'checkboxClear' )
			),
			array(
				'option_group' => 'davis_plugin_settings',
				'option_name' => 'gallery_manager',
				'callback' => array( $this->callbacks, 'checkboxClear' )
			),
			array(
				'option_group' => 'davis_plugin_settings',
				'option_name' => 'testimonial_manager',
				'callback' => array( $this->callbacks, 'checkboxClear' )
			),
			array(
				'option_group' => 'davis_plugin_settings',
				'option_name' => 'templates_manager',
				'callback' => array( $this->callbacks, 'checkboxClear' )
			),
			array(
				'option_group' => 'davis_plugin_settings',
				'option_name' => 'login_manager',
				'callback' => array( $this->callbacks, 'checkboxClear' )
			),
			array(
				'option_group' => 'davis_plugin_settings',
				'option_name' => 'membership_manager',
				'callback' => array( $this->callbacks, 'checkboxClear' )
			),
			array(
				'option_group' => 'davis_plugin_settings',
				'option_name' => 'chat_manager',
				'callback' => array( $this->callbacks, 'checkboxClear' )
			)
		);

		$this->settings->setSettings( $args );
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'davis_admin_index',
				'title' => 'Settings Manager',
				'callback' => array( $this->callbacks_mngr, 'adminSectionManager' ),
				'page' => 'davis_plugin'
			)
		);

		$this->settings->setSections( $args );
	}

	public function setFields()
	{
		$args = array(
			array(
				'id' => 'map_manager',
				'title' => 'Activate Map manager',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'davis_plugin',
				'section' => 'davis_admin_index',
				'args' => array(
					'label_for' => 'map_manager',
					'class' => 'ui-toogle'
				)
			),
			array(
				'id' => 'cpt_manager',
				'title' => 'Activate CPT Manager',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'davis_plugin',
				'section' => 'davis_admin_index',
				'args' => array(
					'label_for' => 'cpt_manager',
					'class' => 'ui-toogle'
				)
			),
			array(
				'id' => 'taxonomy_manager',
				'title' => 'Activate Taxonomy Manager',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'davis_plugin',
				'section' => 'davis_admin_index',
				'args' => array(
					'label_for' => 'taxonomy_manager',
					'class' => 'ui-toogle'
				)
			),
			array(
				'id' => 'media_widget',
				'title' => 'Activate Media Widget',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'davis_plugin',
				'section' => 'davis_admin_index',
				'args' => array(
					'label_for' => 'media_widget',
					'class' => 'ui-toogle'
				)
			),
				array(
				'id' => 'gallery_manager',
				'title' => 'Activate Gallery Manager',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'davis_plugin',
				'section' => 'davis_admin_index',
				'args' => array(
					'label_for' => 'gallery_manager',
					'class' => 'ui-toogle'
				)
			),
				array(
				'id' => 'testimonial_manager',
				'title' => 'Activate Testimonial Manager',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'davis_plugin',
				'section' => 'davis_admin_index',
				'args' => array(
					'label_for' => 'testimonial_manager',
					'class' => 'ui-toogle'
				)
			),
				array(
				'id' => 'templates_manager',
				'title' => 'Activate Templates Manager',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'davis_plugin',
				'section' => 'davis_admin_index',
				'args' => array(
					'label_for' => 'templates_manager',
					'class' => 'ui-toogle'
				)
			),
				array(
				'id' => 'login_manager',
				'title' => 'Activate Ajax Login/Signup',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'davis_plugin',
				'section' => 'davis_admin_index',
				'args' => array(
					'label_for' => 'login_manager',
					'class' => 'ui-toogle'
				)
			),
				array(
				'id' => 'chat_manager',
				'title' => 'Activate Chat Manager',
				'callback' => array( $this->callbacks_mngr, 'checkboxField' ),
				'page' => 'davis_plugin',
				'section' => 'davis_admin_index',
				'args' => array(
					'label_for' => 'chat_manager',
					'class' => 'ui-toogle'
				)
			)
		);

		$this->settings->setFields( $args );
	}
}