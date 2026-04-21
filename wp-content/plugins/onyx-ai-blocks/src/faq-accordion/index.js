import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, Button, TextControl, TextareaControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { items } = attributes;
		const blockProps = useBlockProps( { className: 'onyx-faq-accordion' } );

		const updateItem = ( index, field, value ) => {
			const updated = items.map( ( item, i ) =>
				i === index ? { ...item, [ field ]: value } : item
			);
			setAttributes( { items: updated } );
		};

		const addItem = () => setAttributes( { items: [ ...items, { question: '', answer: '' } ] } );
		const removeItem = ( index ) => setAttributes( { items: items.filter( ( _, i ) => i !== index ) } );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'FAQ Items', 'onyx-ai-blocks' ) }>
						{ items.map( ( item, i ) => (
							<div key={ i } style={ { marginBottom: 16, borderBottom: '1px solid #3D3528', paddingBottom: 16 } }>
								<TextControl
									label={ `${ __( 'Question', 'onyx-ai-blocks' ) } ${ i + 1 }` }
									value={ item.question }
									onChange={ ( v ) => updateItem( i, 'question', v ) }
								/>
								<TextareaControl
									label={ __( 'Answer', 'onyx-ai-blocks' ) }
									value={ item.answer }
									onChange={ ( v ) => updateItem( i, 'answer', v ) }
								/>
								<Button variant="secondary" isDestructive onClick={ () => removeItem( i ) }>
									{ __( 'Remove', 'onyx-ai-blocks' ) }
								</Button>
							</div>
						) ) }
						<Button variant="primary" onClick={ addItem }>
							{ __( '+ Add question', 'onyx-ai-blocks' ) }
						</Button>
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					{ items.map( ( item, i ) => (
						<details key={ i } className="onyx-faq-accordion__item">
							<summary className="onyx-faq-accordion__question">{ item.question }</summary>
							<div className="onyx-faq-accordion__answer">{ item.answer }</div>
						</details>
					) ) }
				</div>
			</>
		);
	},

	save: () => null,
} );
