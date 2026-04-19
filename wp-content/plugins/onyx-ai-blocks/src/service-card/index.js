import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, SelectControl, ToggleControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { icon, title, description, audienceTag, serviceType, format, nextDate, price, ctaLabel, ctaUrl, featured } = attributes;
		const blockProps = useBlockProps( {
			className: `onyx-service-card onyx-service-card--${ serviceType }${ featured ? ' onyx-service-card--featured' : '' }`,
		} );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Service Card', 'onyx-ai-blocks' ) }>
						<SelectControl label={ __( 'Type', 'onyx-ai-blocks' ) } value={ serviceType }
							options={ [ { label: 'Group', value: 'group' }, { label: 'Personal', value: 'personal' }, { label: 'Organizational', value: 'organizational' } ] }
							onChange={ ( v ) => setAttributes( { serviceType: v } ) } />
						<TextControl label={ __( 'Icon', 'onyx-ai-blocks' ) } value={ icon } onChange={ ( v ) => setAttributes( { icon: v } ) } />
						<TextControl label={ __( 'Title', 'onyx-ai-blocks' ) } value={ title } onChange={ ( v ) => setAttributes( { title: v } ) } />
						<TextControl label={ __( 'Description', 'onyx-ai-blocks' ) } value={ description } onChange={ ( v ) => setAttributes( { description: v } ) } />
						<TextControl label={ __( 'Audience tag', 'onyx-ai-blocks' ) } value={ audienceTag } onChange={ ( v ) => setAttributes( { audienceTag: v } ) } />
						<TextControl label={ __( 'Format', 'onyx-ai-blocks' ) } value={ format } onChange={ ( v ) => setAttributes( { format: v } ) } />
						<TextControl label={ __( 'Next date', 'onyx-ai-blocks' ) } value={ nextDate } onChange={ ( v ) => setAttributes( { nextDate: v } ) } />
						<TextControl label={ __( 'Price', 'onyx-ai-blocks' ) } value={ price } onChange={ ( v ) => setAttributes( { price: v } ) } />
						<TextControl label={ __( 'CTA label', 'onyx-ai-blocks' ) } value={ ctaLabel } onChange={ ( v ) => setAttributes( { ctaLabel: v } ) } />
						<TextControl label={ __( 'CTA URL', 'onyx-ai-blocks' ) } value={ ctaUrl } onChange={ ( v ) => setAttributes( { ctaUrl: v } ) } />
						<ToggleControl label={ __( 'Featured', 'onyx-ai-blocks' ) } checked={ featured } onChange={ ( v ) => setAttributes( { featured: v } ) } />
					</PanelBody>
				</InspectorControls>
				<div { ...blockProps }>
					<div className="onyx-service-card__header">
						<span className="onyx-service-card__icon" aria-hidden="true">{ icon }</span>
						{ audienceTag && <span className="onyx-tag-badge onyx-tag-badge--mustard">{ audienceTag }</span> }
					</div>
					<h3 className="onyx-service-card__title">{ title }</h3>
					<p className="onyx-service-card__description">{ description }</p>
					{ format && <span className="onyx-service-card__format">{ format }</span> }
					{ 'group' === serviceType && nextDate && <span className="onyx-service-card__next-date">{ nextDate }</span> }
					{ price && <span className="onyx-service-card__price">{ price }</span> }
					<a className="onyx-service-card__cta" href={ ctaUrl } onClick={ ( e ) => e.preventDefault() }>{ ctaLabel }</a>
				</div>
			</>
		);
	},

	save( { attributes } ) {
		const { icon, title, description, audienceTag, serviceType, format, nextDate, price, ctaLabel, ctaUrl, featured } = attributes;
		const blockProps = useBlockProps.save( {
			className: `onyx-service-card onyx-service-card--${ serviceType }${ featured ? ' onyx-service-card--featured' : '' }`,
		} );
		return (
			<div { ...blockProps }>
				<div className="onyx-service-card__header">
					<span className="onyx-service-card__icon" aria-hidden="true">{ icon }</span>
					{ audienceTag && <span className="onyx-tag-badge onyx-tag-badge--mustard">{ audienceTag }</span> }
				</div>
				<h3 className="onyx-service-card__title">{ title }</h3>
				<p className="onyx-service-card__description">{ description }</p>
				{ format && <span className="onyx-service-card__format">{ format }</span> }
				{ 'group' === serviceType && nextDate && <span className="onyx-service-card__next-date">{ nextDate }</span> }
				{ price && <span className="onyx-service-card__price">{ price }</span> }
				<a className="onyx-service-card__cta" href={ ctaUrl }>{ ctaLabel }</a>
			</div>
		);
	},
} );
