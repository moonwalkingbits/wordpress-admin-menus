<?php
/**
 * Admin Menus: Abstract comments menu page class
 *
 * @package Moonwalking_Bits\Admin_Menus
 * @author Martin Pettersson
 * @license GPL-2.0
 * @since 0.1.0
 */

namespace Moonwalking_Bits\Admin_Menus;

/**
 * Class representing an abstract comments menu page.
 *
 * @since 0.1.0
 * @see \Moonwalking_Bits\Admin_Menus\Abstract_Admin_Menu_Page
 */
abstract class Abstract_Comments_Menu_Page extends Abstract_Admin_Menu_Page {

	/**
	 * Parent menu slug.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected ?string $parent_slug = 'edit-comments.php';
}
