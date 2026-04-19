import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { number, label } = attributes;
		const blockProps = useBlockProps( { className: 'onyx-section-label' } );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Section Label', 'onyx-ai-blocks' ) }>
						<TextControl
							label={ __( 'Number', 'onyx-ai-blocks' ) }
							value={ number }
							onChange={ ( val ) => setAttributes( { number: val } ) }
						/>
						<TextControl
							label={ __( 'Label', 'onyx-ai-blocks' ) }
							value={ label }
							onChange={ ( val ) => setAttributes( { label: val } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<div { ...blockProps }>
					<span className="onyx-section-label__number">{ number }</span>
					<span className="onyx-section-label__sep"> — </span>
					<span className="onyx-section-label__text">{ label }</span>
				</div>
			</>
		);
	},

	save( { attributes } ) {
		const { number, label } = attributes;
		const blockProps = useBlockProps.save( { className: 'onyx-section-label' } );
		return (
			<div { ...blockProps }>
				<span className="onyx-section-label__number">{ number }</span>
				<span className="onyx-section-label__sep"> — </span>
				<span className="onyx-section-label__text">{ label }</span>
			</div>
		);
	},
} );
