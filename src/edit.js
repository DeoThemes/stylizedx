/**
 * External dependencies
 */
import classnames from 'classnames';

/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import {
	InspectorControls,
	useBlockProps,
	PanelColorSettings,
	withColors,
} from '@wordpress/block-editor';
import { PanelBody } from '@wordpress/components';

function StyleSwitcherEdit( props ) {
	const {
		attributes,
		setAttributes,
		backgroundColor,
		setBackgroundColor,
		iconColor,
		setIconColor,
		borderColor,
		setBorderColor,
	} = props;

	const { darkBackgroundColor, darkIconColor, darkBorderColor } = attributes;

	const setDarkBackgroundColor = ( color ) => {
		setAttributes( { darkBackgroundColor: color } );
	};

	const setDarkIconColor = ( color ) => {
		setAttributes( { darkIconColor: color } );
	};

	const setDarkBorderColor = ( color ) => {
		setAttributes( { darkBorderColor: color } );
	};

	const blockProps = useBlockProps( {
		className: 'js-stylizedx-switcher',
		style: {
			backgroundColor: backgroundColor.color,
			color: iconColor.color,
			borderColor: borderColor.color,
		},
	} );

	return (
		<>
			<InspectorControls>
				<PanelColorSettings
					title={ __( 'Color Settings', 'stylizedx' ) }
					colorSettings={ [
						{
							value: backgroundColor.color,
							onChange: setBackgroundColor,
							label: __( 'Background color', 'stylizedx' ),
						},
						{
							value: iconColor.color,
							onChange: setIconColor,
							label: __( 'Icon color', 'stylizedx' ),
						},
						{
							value: borderColor.color,
							onChange: setBorderColor,
							label: __( 'Border color', 'stylizedx' ),
						},
					] }
				/>
				<PanelColorSettings
					title={ __( 'Dark Color Settings', 'stylizedx' ) }
					colorSettings={ [
						{
							value: darkBackgroundColor,
							onChange: setDarkBackgroundColor,
							label: __( 'Background color', 'stylizedx' ),
						},
						{
							value: darkIconColor,
							onChange: setDarkIconColor,
							label: __( 'Icon color', 'stylizedx' ),
						},
						{
							value: darkBorderColor,
							onChange: setDarkBorderColor,
							label: __( 'Border color', 'stylizedx' ),
						},
					] }
				/>
			</InspectorControls>

			<span { ...blockProps }>
				<svg
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 24 24"
					width="24"
					height="24"
					className="stylizedx-switcher-light"
				>
					<path fill="none" d="M0 0h24v24H0z"></path>
					<path d="M11.38 2.019a7.5 7.5 0 1 0 10.6 10.6C21.662 17.854 17.316 22 12.001 22 6.477 22 2 17.523 2 12c0-5.315 4.146-9.661 9.38-9.981z"></path>
				</svg>
			</span>
		</>
	);
}

export default withColors( {
	backgroundColor: 'background-color',
	iconColor: 'fill',
	borderColor: 'border-color',
} )( StyleSwitcherEdit );
