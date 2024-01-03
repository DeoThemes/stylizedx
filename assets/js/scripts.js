window.stylizedX = {};
stylizedX.storageKey = 'stylizedx-theme-preference';

stylizedX.getColorPreference = function () {
	const storedPreferences = localStorage.getItem( stylizedX.storageKey );

	if ( storedPreferences ) {
		try {
			const parsedPreferences = JSON.parse( storedPreferences );

			if ( parsedPreferences.scheme && parsedPreferences.styles ) {
				return parsedPreferences;
			} else {
				console.error( 'Invalid stored preferences format' );
			}
		} catch ( error ) {
			console.error( 'Error parsing stored preferences:', error );
		}
	}

	return null;
};

stylizedX.setPreference = function () {
	const themeObj = {
		scheme: stylizedX.theme.scheme,
		styles: stylizedX.theme.value,
	};
	localStorage.setItem( stylizedX.storageKey, JSON.stringify( themeObj ) );
	stylizedX.reflectPreference();
};

stylizedX.theme = {
	scheme: '',
	value: stylizedX.getColorPreference()?.styles,
};

stylizedX.injectStyles = function () {
	const styleElement = document.createElement( 'style' );
	styleElement.classList.add( 'stylizedx-style' );
	const variationStyles =
		typeof stylizedX.theme.value !== 'undefined'
			? JSON.parse( stylizedX.theme.value )
			: '';
	styleElement.type = 'text/css';
	styleElement.innerText = variationStyles;
	document.head.appendChild( styleElement );
};

stylizedX.reflectPreference = function () {
	if ( localStorage.getItem( stylizedX.storageKey ) ) {
		stylizedX.injectStyles();
		document.firstElementChild.removeAttribute( 'data-scheme' );
		document.firstElementChild.setAttribute(
			'data-scheme',
			stylizedX.getColorPreference()?.scheme
		);
	}
	document.body.style.display = 'block';
};

// Init
variationSwitcher();

function variationSwitcher() {
	events();

	function events() {
		stylizedX.reflectPreference();

		window.addEventListener( 'load', () => {
			document
				.querySelectorAll( '.js-stylizedx-switcher' )
				.forEach( ( trigger ) => {
					trigger.addEventListener( 'click', ( e ) => onClick( e ) );
				} );
		} );
	}

	function onClick( e ) {
		e.preventDefault();

		const data = {
			action: 'stylizedx_style_switcher_ajax_action',
			security: stylizedx_ajax.ajax_nonce,
		};

		// Fetch request
		fetch( stylizedx_ajax.ajax_url, {
			method: 'POST',
			headers: {
				'Content-Type': 'application/x-www-form-urlencoded',
			},
			body: new URLSearchParams( data ),
		} )
			.then( ( response ) => response.json() )
			.then( ( data ) => {
				// console.log( data );

				// check the localStorage
				if ( ! localStorage.getItem( stylizedX.storageKey ) ) {
					// save styles to localStorage
					stylizedX.theme.scheme = 'dark';
					stylizedX.theme.value = JSON.stringify( data.data );
					stylizedX.setPreference();
				} else {
					localStorage.removeItem( stylizedX.storageKey );
					const styleElement =
						document.querySelector( '.stylizedx-style' );
					document.head.removeChild( styleElement );
					document.firstElementChild.removeAttribute( 'data-scheme' );
					return;
				}
			} )
			.catch( ( error ) => {
				console.error( 'Error:', error );
			} );
	}
}
