/**
 * @module Navigation
 *
 * @description
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 *
 */
export default class Navigation {

	/**
	 * Initialize everything
	 *
	 * @returns {null}
	 */
	constructor() {
		this.container = document.getElementById( 'masthead' );
		if ( ! this.container ) {
			console.error( 'Navigation: No masthead container.' ); // eslint-disable-line
			return;
		}

		this.button = this.container.getElementsByTagName( 'button' )[0];
		if ( 'undefined' === typeof this.button ) {
			console.error( 'Navigation: No nav button.' ); // eslint-disable-line
			return;
		}

		this.menu = this.container.getElementsByTagName( 'ul' )[0];

		// Hide menu toggle button if menu is empty and return early.
		if ( 'undefined' === typeof this.menu ) {
			console.warning( 'Navigation: Nav menu is empty.' ); // eslint-disable-line
			this.button.style.display = 'none';
			return;
		}

		this.setupNav( this.container, this.button, this.menu );
	}

	/**
	 * Set ARIA attributes, toggle class names
	 *
	 * @param   {element} container The header
	 * @param   {element} button    The nav toggling button
	 * @param   {element} menu      The nav ul element
	 *
	 * @returns {null}
	 */
	setupNav( container, button, menu ) {
		menu.setAttribute( 'aria-expanded', 'false' );
		if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
			menu.className += ' nav-menu';
		}

		// Get all the link elements within the menu.
		const parents = menu.getElementsByClassName( 'page_item_has_children' );

		// Empty href for parent links
		for ( let i = 0, len = parents.length; i < len; i++ ) {
			const link = parents[i].getElementsByTagName( 'a' )[0];
			link.removeAttribute( 'href' );
		}

		this.toggleNav( container, button, menu );
	}

	/**
	 * Toggles nav
	 *
	 * @param   {element} container The header
	 * @param   {element} button    The nav toggling button
	 * @param   {element} menu      The nav ul element
	 *
	 * @returns {null}
	 */
	toggleNav( container, button, menu ) {
		button.onclick = function() {
			if ( -1 !== container.className.indexOf( 'menu-toggled' ) ) {
				container.className = container.className.replace( ' menu-toggled', '' );
				button.setAttribute( 'aria-expanded', 'false' );
				menu.setAttribute( 'aria-expanded', 'false' );
			} else {
				container.className += ' menu-toggled';
				button.setAttribute( 'aria-expanded', 'true' );
				menu.setAttribute( 'aria-expanded', 'true' );
			}
		};

		// Get all the link elements within the menu.
		const links = menu.getElementsByTagName( 'a' );

		// Each time a menu link is focused or blurred, toggle focus.
		for ( let i = 0, len = links.length; i < len; i++ ) {
			links[i].addEventListener( 'focus', this.toggleFocus, true );
			links[i].addEventListener( 'blur', this.toggleFocus, true );
		}

		// Get all the menu items
		const items = menu.getElementsByTagName( 'li' );

		// Toggle submenus if any exist
		for ( let i = 0, len = items.length; i < len; i++ ) {
			if ( -1 !== items[i].className.indexOf( 'page_item_has_children' ) ) {
				items[i].addEventListener( 'click', this.toggleChildren, true );
			}
		}
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	toggleFocus() {
		let self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles submenus
	 */
	toggleChildren() {
		const parent = this;
		const child = parent.getElementsByTagName( 'ul' )[0];

		if ( -1 !== parent.className.indexOf( 'submenu-toggled' ) ) {
			parent.className = parent.className.replace( ' submenu-toggled', '' );
			child.setAttribute( 'aria-expanded', 'false' );
		} else {
			parent.className += ' submenu-toggled';
			child.setAttribute( 'aria-expanded', 'true' );
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	// ( function( container ) {
	// 	let touchStartFn, i,
	// 		parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );
	//
	// 	if ( 'ontouchstart' in window ) {
	// 		touchStartFn = function( e ) {
	// 			let menuItem = this.parentNode, i;
	//
	// 			if ( ! menuItem.classList.contains( 'focus' ) ) {
	// 				e.preventDefault();
	// 				for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
	// 					if ( menuItem === menuItem.parentNode.children[i] ) {
	// 						continue;
	// 					}
	// 					menuItem.parentNode.children[i].classList.remove( 'focus' );
	// 				}
	// 				menuItem.classList.add( 'focus' );
	// 			} else {
	// 				menuItem.classList.remove( 'focus' );
	// 			}
	// 		};
	//
	// 		for ( i = 0; i < parentLink.length; ++i ) {
	// 			parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
	// 		}
	// 	}
	// }( container ) );
}
