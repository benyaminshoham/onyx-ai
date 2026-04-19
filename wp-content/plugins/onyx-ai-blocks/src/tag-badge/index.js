import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { text, variant } = attributes;
		const blockProps = useBlockProps( {
			className: `onyx-tag-badge onyx-tag-badge--${ variant }`,
		} );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Badge', 'onyx-ai-blocks' ) }>
						<TextControl
							label={ __( 'Text', 'onyx-ai-blocks' ) }
							value={ text }
							onChange={ ( val ) => setAttributes( { text: val } ) }
						/>
						<SelectControl
							label={ __( 'Variant', 'onyx-ai-blocks' ) }
							value={ variant }
							options={ [
								{ label: 'Mustard', value: 'mustard' },
								{ label: 'Teal',    value: 'teal' },
								{ label: 'Amber',   value: 'amber' },
							] }
							onChange={ ( val ) => setAttributes( { variant: val } ) }
						/>
					</PanelBody>
				</InspectorControls>
				<span { ...blockProps }>{ text }</span>
			</>
		);
	},

	save( { attributes } ) {
		const { text, variant } = attributes;
		const blockProps = useBlockProps.save( {
			className: `onyx-tag-badge onyx-tag-badge--${ variant }`,
		} );
		return <span { ...blockProps }>{ text }</span>;
	},
} );
