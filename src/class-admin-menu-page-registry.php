<?php
/**
 * Admin Menus: Admin menu page registry class
 *
 * @package Moonwalking_Bits\Admin_Menus
 * @author Martin Pettersson
 * @license GPL-2.0
 * @since 0.1.0
 */

namespace Moonwalking_Bits\Admin_Menus;

/**
 * A admin menu page registry class.
 *
 * @since 0.1.0
 */
class Admin_Menu_Page_Registry {

	/**
	 * Registers a given admin menu page.
	 *
	 * @since 0.1.0
	 * @param \Moonwalking_Bits\Admin_Menus\Abstract_Admin_Menu_Page $admin_menu_page Admin menu page instance.
	 */
	public function register( Abstract_Admin_Menu_Page $admin_menu_page ): void {
		add_action( 'admin_menu', fn() => $this->register_admin_menu_page( $admin_menu_page ) );
	}

	/**
	 * Registers the given admin menu page.
	 *
	 * @param \Moonwalking_Bits\Admin_Menus\Abstract_Admin_Menu_Page $admin_menu_page Admin menu page instance.
	 */
	private function register_admin_menu_page( Abstract_Admin_Menu_Page $admin_menu_page ): void {
		if ( ! is_null( $admin_menu_page->parent_slug() ) ) {
			$this->register_admin_submenu_page( $admin_menu_page );

			return;
		}

		$hook_suffix = add_menu_page(
			$admin_menu_page->page_title(),
			$admin_menu_page->menu_title(),
			$admin_menu_page->capability(),
			$admin_menu_page->slug(),
			fn() => $this->render_admin_menu_page( $admin_menu_page ),
			$admin_menu_page->icon(),
			// @phan-suppress-next-line PhanTypeMismatchArgumentNullable
			$admin_menu_page->position()
		);

		add_action( "load-{$hook_suffix}", array( $admin_menu_page, 'load' ) );
	}

	/**
	 * Registers the given admin menu page as a submenu.
	 *
	 * @param \Moonwalking_Bits\Admin_Menus\Abstract_Admin_Menu_Page $admin_menu_page Admin menu page instance.
	 */
	private function register_admin_submenu_page( Abstract_Admin_Menu_Page $admin_menu_page ): void {
		$hook_suffix = add_submenu_page(
			(string) $admin_menu_page->parent_slug(),
			$admin_menu_page->page_title(),
			$admin_menu_page->menu_title(),
			$admin_menu_page->capability(),
			$admin_menu_page->slug(),
			fn() => $this->render_admin_menu_page( $admin_menu_page ),
			// @phan-suppress-next-line PhanTypeMismatchArgumentNullable
			$admin_menu_page->position()
		);

		add_action( "load-{$hook_suffix}", array( $admin_menu_page, 'load' ) );
	}

	/**
	 * Renders the given admin menu page.
	 *
	 * @param \Moonwalking_Bits\Admin_Menus\Abstract_Admin_Menu_Page $admin_menu_page Admin menu page instance.
	 */
	private function render_admin_menu_page( Abstract_Admin_Menu_Page $admin_menu_page ): void {
		if ( ! current_user_can( $admin_menu_page->capability() ) ) {
			return;
		}

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo $admin_menu_page->render();
	}
}
