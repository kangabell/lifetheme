/**
 * File navigation.js.
 */

 /*--------------------------------------------------------------
 ## Navigation Menu
 ** Handles toggling the navigation menu for small screens and enables TAB key
 ** navigation support for dropdown menus.
 --------------------------------------------------------------*/

( function() {
	var html, container, button, menu, links, i, len;

	html = document.getElementsByTagName( 'html' )[0];

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	function closeMenu() {
		html.className = html.className.replace( ' menu-open', '' );
		container.className = container.className.replace( ' toggled', '' );
		button.setAttribute( 'aria-expanded', 'false' );
		menu.setAttribute( 'aria-expanded', 'false' );
	}

	function openMenu() {
		html.className += ' menu-open';
		container.className += ' toggled';
		button.setAttribute( 'aria-expanded', 'true' );
		menu.setAttribute( 'aria-expanded', 'true' );
	}

	// toggle menu open/close with button
	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			closeMenu();
		} else {
			openMenu();
		}
	};

	// close menu using ESC key
	document.onkeydown = function(evt) {
		evt = evt || window.event;
		var isEscape = false;
		if ("key" in evt) {
			isEscape = (evt.key === "Escape" || evt.key === "Esc");
		} else {
			isEscape = (evt.keyCode === 27);
		}
		if (isEscape) {
			closeMenu();
		}
	};

	// close menu if you click outside it
	document.addEventListener("click", function(evt) {
		targetElement = evt.target;  // clicked element

		do {
			if (targetElement == container) {
				return;
			}
			targetElement = targetElement.parentNode;
		} while (targetElement);

		closeMenu();
	});

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

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

} )();

/*--------------------------------------------------------------
# Dark Mode detection & toggle
--------------------------------------------------------------*/

jQuery(document).ready( function($) {

	$( 'html' ).toggleClass( localStorage.toggled );

	const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');

	function darkMode() {
		$( 'html' ).toggleClass( 'dark', true );
		$( 'html' ).toggleClass( 'light', false );
		localStorage.toggled = 'dark';
		$( '.toggle-mode' ).attr( 'aria-checked', true );
	}

	function lightMode() {
		$( 'html' ).toggleClass( 'dark', false );
		$( 'html' ).toggleClass( 'light', true );
		localStorage.toggled = 'light';
		$( '.toggle-mode' ).attr( 'aria-checked', false );
	}

	// if dark mode system pref is detected, and localStorage preference isn't set to "light",
	// mark the toggle as checked on load
	if ( prefersDarkScheme.matches && localStorage.toggled != 'light' ) {
		$( '.toggle-mode' ).attr( 'aria-checked', true );
		console.log("prefersDarkScheme.matches && localStorage.toggled != 'light'");
	}

	// switch to the opposite mode with the toggle is clicked
	$( '.toggle-mode' ).click( function() {

		if ( !prefersDarkScheme.matches && localStorage.toggled != 'dark' ) {
			darkMode();
		}
		else if ( prefersDarkScheme.matches && localStorage.toggled != 'light' ) {
			lightMode();
		} else if ( !prefersDarkScheme.matches && localStorage.toggled == 'dark' ) {
			lightMode();
		} else {
			darkMode();
		}
	});

} );
