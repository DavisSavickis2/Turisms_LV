<?php 
/**
 * @package  DavisPlugin
 */
namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
	public function checkboxClear( $input )
	{

		//return filter_var($input, FILTER_SANITAZE_NUMBER_INT);
		return( isset($input) ? true: false );
	}

	public function adminSectionManager()
	{
		echo 'Manage the Sections and Features by ckecking checkboxes.';
	}

	public function checkboxField( $args )
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$checkbox = get_option( $name );
		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="'. $name . '" value="1" class="'. $classes . '" ' . ($checkbox ? 'checked' : '') . '>
				<label for="' . $name . '">
					<div>
					</div>
				</label>
			</div>';
	}
}
