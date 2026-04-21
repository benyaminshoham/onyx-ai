import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { headline, description, linkLabel, linkUrl, audience, icon } = attributes;
		const blockProps = useBlockProps( {
			className: `onyx-audience-fork onyx-audience-fork--${ audience }`,
		} );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Audience Fork Card', 'onyx-ai-blocks' ) }>
						<SelectControl
							label={ __( 'Audience', 'onyx-ai-blocks' ) }
							value={ audience }
							options={ [
								{ label: 'Developers',    value: 'dev' },
								{ label: 'Business',      value: 'biz' },
								{ label: 'Organizations', value: 'org' },
							] }
							onChange={ ( val ) => setAttributes( { audience: val } ) }
						/>
						<TextControl label={ __( 'Icon (Lucide slug)', 'onyx-ai-blocks' ) } value={ icon } onChange={ ( v ) => setAttributes( { icon: v } ) } />
						<TextControl label={ __( 'Headline', 'onyx-ai-blocks' ) } value={ headline } onChange={ ( v ) => setAttributes( { headline: v } ) } />
						<TextControl label={ __( 'Description', 'onyx-ai-blocks' ) } value={ description } onChange={ ( v ) => setAttributes( { description: v } ) } />
						<TextControl label={ __( 'Link label', 'onyx-ai-blocks' ) } value={ linkLabel } onChange={ ( v ) => setAttributes( { linkLabel: v } ) } />
						<TextControl label={ __( 'Link URL', 'onyx-ai-blocks' ) } value={ linkUrl } onChange={ ( v ) => setAttributes( { linkUrl: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...blockProps }>
					<div className="onyx-audience-fork__icon" aria-hidden="true">{ icon }</div>
					<h3 className="onyx-audience-fork__headline">{ headline }</h3>
					<p className="onyx-audience-fork__description">{ description }</p>
					<a className="onyx-audience-fork__link" href={ linkUrl } onClick={ ( e ) => e.preventDefault() }>{ linkLabel }</a>
				</div>
			</>
		);
	},

	save: () => null,
} );
