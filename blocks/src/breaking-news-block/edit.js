import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	InspectorControls,
	InnerBlocks,
} from '@wordpress/block-editor';
import {
	SelectControl,
	PanelBody,
	ComboboxControl,
} from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import {
	useState,
} from '@wordpress/element';

import moment from 'moment';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes, focus, setFocus, className } ) {
	const { getPost, hasPost, posts } = attributes;

	return (
		<div { ...useBlockProps() }>
			<section className={ 'breaking-news-box' }>
				<div className={ 'breaking-news-left' }>
					<h2 className={ 'breaking-news-left-h2' }>{ __( 'Breaking News', 'jm-breaking-news' ) }</h2>
				</div>
				<div className={ 'breaking-news-right' }>
					<p className={ 'breaking-news-right-h2' }>{ __( 'Title of the Breaking News Section Will Go Here', 'jm-breaking-news' ) }</p>
				</div>
			</section>
		</div>
	);
}
