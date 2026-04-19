import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, Button, TextControl, TextareaControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { items, columns } = attributes;
		const blockProps = useBlockProps( {
			className: `onyx-pillars onyx-pillars--cols-${ columns }`,
		} );

		const updateItem = ( index, field, value ) => {
			const updated = items.map( ( item, i ) =>
				i === index ? { ...item, [ field ]: value } : item
			);
			setAttributes( { items: updated } );
		};

		const addItem = () => setAttributes( { items: [ ...items, { icon: '', label: '', description: '' } ] } );
		const removeItem = ( index ) => setAttributes( { items: items.filter( ( _, i ) => i !== index ) } );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Pillars Grid', 'onyx-ai-blocks' ) }>
						<SelectControl
							label={ __( 'Columns', 'onyx-ai-blocks' ) }
							value={ String( columns ) }
							options={ [ { label: '2', value: '2' }, { label: '3', value: '3' }, { label: '4', value: '4' } ] }
							onChange={ ( v ) => setAttributes( { columns: Number( v ) } ) }
						/>
						{ items.map( ( item, i ) => (
							<div key={ i } style={ { marginBottom: 16, borderBottom: '1px solid #3D3528', paddingBottom: 16 } }>
								<TextControl label={ __( 'Icon', 'onyx-ai-blocks' ) } value={ item.icon } onChange={ ( v ) => updateItem( i, 'icon', v ) } />
								<TextControl label={ __( 'Label', 'onyx-ai-blocks' ) } value={ item.label } onChange={ ( v ) => updateItem( i, 'label', v ) } />
								<TextareaControl label={ __( 'Description', 'onyx-ai-blocks' ) } value={ item.description } onChange={ ( v ) => updateItem( i, 'description', v ) } />
								<Button variant="secondary" isDestructive onClick={ () => removeItem( i ) }>{ __( 'Remove', 'onyx-ai-blocks' ) }</Button>
							</div>
						) ) }
						<Button variant="primary" onClick={ addItem }>{ __( '+ Add pillar', 'onyx-ai-blocks' ) }</Button>
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					{ items.map( ( item, i ) => (
						<div key={ i } className="onyx-pillars__item">
							<span className="onyx-pillars__icon" aria-hidden="true">{ item.icon }</span>
							<h3 className="onyx-pillars__label">{ item.label }</h3>
							<p className="onyx-pillars__description">{ item.description }</p>
						</div>
					) ) }
				</div>
			</>
		);
	},

	save( { attributes } ) {
		const { items, columns } = attributes;
		const blockProps = useBlockProps.save( {
			className: `onyx-pillars onyx-pillars--cols-${ columns }`,
		} );
		return (
			<div { ...blockProps }>
				{ items.map( ( item, i ) => (
					<div key={ i } className="onyx-pillars__item">
						<span className="onyx-pillars__icon" aria-hidden="true">{ item.icon }</span>
						<h3 className="onyx-pillars__label">{ item.label }</h3>
						<p className="onyx-pillars__description">{ item.description }</p>
					</div>
				) ) }
			</div>
		);
	},
} );
