import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { label, url, variant, arrow, size } = attributes;
		const blockProps = useBlockProps( {
			className: `onyx-cta-button onyx-cta-button--${ variant } onyx-cta-button--${ size }`,
		} );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'CTA Button', 'onyx-ai-blocks' ) }>
						<TextControl
							label={ __( 'Label', 'onyx-ai-blocks' ) }
							value={ label }
							onChange={ ( val ) => setAttributes( { label: val } ) }
						/>
						<TextControl
							label={ __( 'URL', 'onyx-ai-blocks' ) }
							value={ url }
							onChange={ ( val ) => setAttributes( { url: val } ) }
						/>
						<SelectControl
							label={ __( 'Variant', 'onyx-ai-blocks' ) }
							value={ variant }
							options={ [
								{ label: 'Primary',   value: 'primary' },
								{ label: 'Secondary', value: 'secondary' },
								{ label: 'Ghost',     value: 'ghost' },
							] }
							onChange={ ( val ) => setAttributes( { variant: val } ) }
						/>
						<SelectControl
							label={ __( 'Size', 'onyx-ai-blocks' ) }
							value={ size }
							options={ [
								{ label: 'Default', value: 'default' },
								{ label: 'Large',   value: 'large' },
							] }
							onChange={ ( val ) => setAttributes( { size: val } ) }
						/>
						<ToggleControl
							label={ __( 'Show arrow (→)', 'onyx-ai-blocks' ) }
							checked={ arrow }
							onChange={ ( val ) => setAttributes( { arrow: val } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<div { ...blockProps }>
					<a href={ url } onClick={ ( e ) => e.preventDefault() }>
						{ label }{ arrow && ' →' }
					</a>
				</div>
			</>
		);
	},

	save( { attributes } ) {
		const { label, url, variant, arrow, size } = attributes;
		const blockProps = useBlockProps.save( {
			className: `onyx-cta-button onyx-cta-button--${ variant } onyx-cta-button--${ size }`,
		} );
		return (
			<div { ...blockProps }>
				<a href={ url }>{ label }{ arrow && ' →' }</a>
			</div>
		);
	},
} );
