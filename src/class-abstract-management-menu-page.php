<?php
/**
 * Admin Menus: Abstract management menu page class
 *
 * @package Moonwalking_Bits\Admin_Menus
 * @author Martin Pettersson
 * @license GPL-2.0
 * @since 0.1.0
 */

namespace Moonwalking_Bits\Admin_Menus;

/**
 * Class representing an abstract management menu page.
 *
 * @since 0.1.0
 * @see \Moonwalking_Bits\Admin_Menus\Abstract_Admin_Menu_Page
 */
abstract class Abstract_Management_Menu_Page extends Abstract_Admin_Menu_Page {

	/**
	 * Parent menu slug.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected ?string $parent_slug = 'tools.php';
}
