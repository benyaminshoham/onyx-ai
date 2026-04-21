import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, TextareaControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { quote, author, role, avatarUrl, layout } = attributes;
		const blockProps = useBlockProps( {
			className: `onyx-testimonial onyx-testimonial--${ layout }`,
		} );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Testimonial', 'onyx-ai-blocks' ) }>
						<SelectControl label={ __( 'Layout', 'onyx-ai-blocks' ) } value={ layout }
							options={ [ { label: 'Card', value: 'card' }, { label: 'Inline', value: 'inline' }, { label: 'Featured', value: 'featured' } ] }
							onChange={ ( v ) => setAttributes( { layout: v } ) } />
						<TextareaControl label={ __( 'Quote', 'onyx-ai-blocks' ) } value={ quote } onChange={ ( v ) => setAttributes( { quote: v } ) } />
						<TextControl label={ __( 'Author', 'onyx-ai-blocks' ) } value={ author } onChange={ ( v ) => setAttributes( { author: v } ) } />
						<TextControl label={ __( 'Role', 'onyx-ai-blocks' ) } value={ role } onChange={ ( v ) => setAttributes( { role: v } ) } />
						<TextControl label={ __( 'Avatar URL', 'onyx-ai-blocks' ) } value={ avatarUrl } onChange={ ( v ) => setAttributes( { avatarUrl: v } ) } />
					</PanelBody>
				</InspectorControls>
				<blockquote { ...blockProps }>
					<p className="onyx-testimonial__quote">"{ quote }"</p>
					<footer className="onyx-testimonial__footer">
						{ avatarUrl && <img className="onyx-testimonial__avatar" src={ avatarUrl } alt={ author } width="40" height="40" /> }
						<span className="onyx-testimonial__author">{ author }</span>
						{ role && <span className="onyx-testimonial__role">{ role }</span> }
					</footer>
				</blockquote>
			</>
		);
	},

	save: () => null,
} );
