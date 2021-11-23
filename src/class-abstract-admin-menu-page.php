<?php
/**
 * Admin Menus: Abstract admin menu page class
 *
 * @package Moonwalking_Bits\Admin_Menus
 * @author Martin Pettersson
 * @license GPL-2.0
 * @since 0.1.0
 */

namespace Moonwalking_Bits\Admin_Menus;

/**
 * Class representing an abstract admin menu page.
 *
 * @since 0.1.0
 */
abstract class Abstract_Admin_Menu_Page {

	/**
	 * Parent menu slug.
	 *
	 * @since 0.1.0
	 * @var string|null
	 */
	protected ?string $parent_slug = null;

	/**
	 * Admin menu slug.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected string $slug;

	/**
	 * Menu page title.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected string $page_title;

	/**
	 * Menu title.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected string $menu_title;

	/**
	 * The capability required to access this menu page.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected string $capability = 'manage_options';

	/**
	 * The menu item icon.
	 *
	 * @since 0.1.0
	 * @var string
	 */
	protected string $icon = '';

	/**
	 * The menu item position order.
	 *
	 * @since 0.1.0
	 * @var int|null
	 */
	protected ?int $position = null;

	/**
	 * Creates a new admin menu page instance.
	 *
	 * @param string $slug Admin menu page slug.
	 */
	public function __construct( string $slug ) {
		$this->slug = $slug;

		if ( ! isset( $this->page_title ) ) {
			$this->page_title = $this->title_from( $this->slug );
		}

		if ( ! isset( $this->menu_title ) ) {
			$this->menu_title = $this->title_from( $this->slug );
		}
	}

	/**
	 * This method is invoked when the page is being loaded.
	 */
	abstract public function load(): void;

	/**
	 * This method is invoked when the page is being rendered.
	 *
	 * @return string A string representation of the rendered admin menu page.
	 */
	abstract public function render(): string;

	/**
	 * Returns the parent menu slug.
	 *
	 * @since 0.1.0
	 * @return string|null The parent menu slug.
	 */
	public function parent_slug(): ?string {
		return $this->parent_slug;
	}

	/**
	 * Returns the admin menu slug.
	 *
	 * @since 0.1.0
	 * @return string The menu slug.
	 */
	public function slug(): string {
		return $this->slug;
	}

	/**
	 * Returns the menu page title.
	 *
	 * @since 0.1.0
	 * @return string The menu page title.
	 */
	public function page_title(): string {
		return $this->page_title;
	}

	/**
	 * Returns the menu title.
	 *
	 * @since 0.1.0
	 * @return string The menu title.
	 */
	public function menu_title(): string {
		return $this->menu_title;
	}

	/**
	 * Returns the capability required to access this menu page.
	 *
	 * @since 0.1.0
	 * @return string The capability required to access this menu page.
	 */
	public function capability(): string {
		return $this->capability;
	}

	/**
	 * Returns the menu item icon.
	 *
	 * @since 0.1.0
	 * @return string The menu item icon.
	 */
	public function icon(): string {
		return $this->icon;
	}

	/**
	 * Returns the menu item position order.
	 *
	 * @since 0.1.0
	 * @return int|null The menu item position order.
	 */
	public function position(): ?int {
		return $this->position;
	}

	/**
	 * Creates a title from the given slug.
	 *
	 * @param string $slug Arbitrary slug string.
	 * @return string Title string.
	 */
	private function title_from( string $slug ): string {
		return implode(
			' ',
			array_map(
				fn( string $word ) => ucfirst( $word ),
				explode( '_', $slug )
			)
		);
	}
}
