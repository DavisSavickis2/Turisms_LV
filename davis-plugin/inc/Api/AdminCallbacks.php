<?php 
/**
 * @package  DavisPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
	public function adminDashboard()
	{
		return require_once( "$this->plugin_path/templates/admin.php" );
	}

	public function adminCpt()
	{
		return require_once( "$this->plugin_path/templates/cpt.php" );
	}

	public function adminTaxonomy()
	{
		return require_once( "$this->plugin_path/templates/taxonomy.php" );
	}

	public function adminWidget()
	{
		return require_once( "$this->plugin_path/templates/widget.php" );
	}

	public function davisOptionsGroup( $input )
	{
		return $input;
	}

	public function davisAdminSection()
	{
		echo 'Sveiki';
	}

	public function firstName()
	{
		$value = esc_attr( get_option( 'first_name' ) );
		echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Ievadiet vārdu!">';
	}

	public function lastName()
	{
		$value = esc_attr( get_option( 'last_name' ) );
		echo '<input type="text" class="regular-text" name="last_name" value="' . $value . '" placeholder="Ievadiet uzvārdu!">';
	}
}