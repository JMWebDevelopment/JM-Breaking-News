/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

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

	function getPosts() {
		let options = [];
		const loadedPosts = wp.data.select( 'core' ).getEntityRecords( 'postType', 'jm_breaking_news', { per_page: -1 } );
		if ( null === loadedPosts ) {
			return options;
		}
		console.log(loadedPosts);
		loadedPosts.forEach( ( post ) => {
			options.push( { value: post.id, label: post.title.rendered } );
		} );
		getPost = true;
		return options;
	}

	const loadedPosts = getPosts();

	console.log(loadedPosts);

	const breaking_news_block = (
		<p>{__('Post hasn\'t been loaded')}</p>
	);

	if ( true === getPost ) {
		console.log(loadedPosts[0].post);
		let date1 = moment(loadedPosts[0].post.date);
		let date2 = moment(moment.utc().toJSON());
		console.log(date1);
		console.log(date2);
		let diffInMinutes = date2.diff(date1, 'hours');
		console.log(diffInMinutes);

		if ( diffInMinutes < parseInt( loadedPosts[0].post.jm_breaking_news_limit ) ) {
			console.log('show');
			setAttributes({
				hasPost: true
			});
		} else {
			console.log('hide');
			setAttributes({
				hasPost: false
			});
		}
	}

	return (
		<div { ...useBlockProps() }>
			{ hasPost && (<section className={ 'breaking-news-box' }>
				<div className={ 'breaking-news-left' }>
					<h2 className={ 'breaking-news-left-h2' }>{ __( 'Breaking News', 'jm-breaking-news' ) }</h2>
				</div>
				<div className={ 'breaking-news-right' }>
					<p className={ 'breaking-news-right-h2' }>{ loadedPosts[0].post.title.rendered }</p>
				</div>
			</section> ) }
			{ !hasPost && ( <p>
				{ __( 'The latest breaking news post has expired.', 'jm-breaking-news' )  }
			</p> ) }
		</div>
	);
}
