import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, Button, TextControl, TextareaControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import metadata from './block.json';
import './style.scss';

registerBlockType( metadata.name, {
	edit( { attributes, setAttributes } ) {
		const { stats, quotes } = attributes;
		const blockProps = useBlockProps( { className: 'onyx-proof-strip' } );

		const updateStat  = ( i, f, v ) => setAttributes( { stats:  stats.map(  ( s, idx ) => idx === i ? { ...s,  [ f ]: v } : s  ) } );
		const updateQuote = ( i, f, v ) => setAttributes( { quotes: quotes.map( ( q, idx ) => idx === i ? { ...q, [ f ]: v } : q ) } );

		return (
			<>
				<InspectorControls>
					<PanelBody title={ __( 'Stats', 'onyx-ai-blocks' ) }>
						{ stats.map( ( s, i ) => (
							<div key={ i } style={ { marginBottom: 12 } }>
								<TextControl label={ __( 'Number', 'onyx-ai-blocks' ) } value={ s.number } onChange={ ( v ) => updateStat( i, 'number', v ) } />
								<TextControl label={ __( 'Label', 'onyx-ai-blocks' ) } value={ s.label } onChange={ ( v ) => updateStat( i, 'label', v ) } />
								<Button variant="secondary" isDestructive onClick={ () => setAttributes( { stats: stats.filter( ( _, idx ) => idx !== i ) } ) }>{ __( 'Remove', 'onyx-ai-blocks' ) }</Button>
							</div>
						) ) }
						<Button variant="primary" onClick={ () => setAttributes( { stats: [ ...stats, { number: '', label: '' } ] } ) }>{ __( '+ Add stat', 'onyx-ai-blocks' ) }</Button>
					</PanelBody>
					<PanelBody title={ __( 'Quotes', 'onyx-ai-blocks' ) } initialOpen={ false }>
						{ quotes.map( ( q, i ) => (
							<div key={ i } style={ { marginBottom: 12 } }>
								<TextareaControl label={ __( 'Quote', 'onyx-ai-blocks' ) } value={ q.quote } onChange={ ( v ) => updateQuote( i, 'quote', v ) } />
								<TextControl label={ __( 'Author', 'onyx-ai-blocks' ) } value={ q.author } onChange={ ( v ) => updateQuote( i, 'author', v ) } />
								<TextControl label={ __( 'Role', 'onyx-ai-blocks' ) } value={ q.role } onChange={ ( v ) => updateQuote( i, 'role', v ) } />
								<Button variant="secondary" isDestructive onClick={ () => setAttributes( { quotes: quotes.filter( ( _, idx ) => idx !== i ) } ) }>{ __( 'Remove', 'onyx-ai-blocks' ) }</Button>
							</div>
						) ) }
						<Button variant="primary" onClick={ () => setAttributes( { quotes: [ ...quotes, { quote: '', author: '', role: '' } ] } ) }>{ __( '+ Add quote', 'onyx-ai-blocks' ) }</Button>
					</PanelBody>
				</InspectorControls>

				<div { ...blockProps }>
					<div className="onyx-proof-strip__stats">
						{ stats.map( ( s, i ) => (
							<div key={ i } className="onyx-proof-strip__stat">
								<span className="onyx-proof-strip__number">{ s.number }</span>
								<span className="onyx-proof-strip__label">{ s.label }</span>
							</div>
						) ) }
					</div>
					{ quotes.length > 0 && (
						<div className="onyx-proof-strip__quotes">
							{ quotes.map( ( q, i ) => (
								<p key={ i } className="onyx-proof-strip__quote">
									"{ q.quote }" — <strong>{ q.author }</strong>{ q.role && `, ${ q.role }` }
								</p>
							) ) }
						</div>
					) }
				</div>
			</>
		);
	},

	save: () => null,
} );
