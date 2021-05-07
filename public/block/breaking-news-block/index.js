/**
 * Block dependencies
 */
import SelectPost from './select';
import moment from 'moment';
import icon from './icon';

/**
  * Internal block libraries
  */
const { __ } = wp.i18n;
const {
	registerBlockType,
	blockEditRender,
	Spinner
} = wp.blocks; // Import registerBlockType() from wp.blocks

//this is where block control componants go! a-ha!

registerBlockType(
	'jm-breaking-news/jm-breaking-news', {
		 title: __('Breaking News Post'),
		 icon: icon,
		 category: 'widgets',
		 keywords: [ __( 'breaking' ), __( 'news' ), __( 'banner' ) ],

		 attributes: {
			 getPost: {
				 type: 'boolean',
				 default: false,
			 },
			 hasPost: {
				 type: 'boolean',
				 default: false,
			 },
			 posts: {
				 type: 'array',
				 default: [],
			 },
			 blockAlignment: {
				 type: 'string',
				 default: 'none'
			 },
		 },

		 getEditWrapperProps( { blockAlignment } ) {
			 if ( 'full' === blockAlignment || 'wide' === blockAlignment ) {
				 return { 'data-align': blockAlignment };
			 }
		 },

		 edit( { attributes, setAttributes, focus, setFocus, className } ) {
			 const { getPost, hasPost, posts,  } = attributes;

			 if ( false === getPost ) {
				 getPosts().then(function (options) {
					 console.log(options);
					 setAttributes({
						 getPost: true,
						 posts: options
					 });
				 });
			 }

			 function getPosts(){
				 console.log('getting-posts');
				 console.log(jm_breaking_news_globals);
				 if ( false === getPost ) {
				 var url = '/wp-json/wp/v2/jm_breaking_news?per_page=1';
				 return fetch( url, {
					 credentials: 'same-origin',
					 method: 'get',
					 headers: {
						 Accept: 'application/json',
						 'Content-Type': 'application/json',
						 'X-WP-Nonce': jm_breaking_news_globals.nonce
					 }})
					 .then( handleFetchErrors )
					 .then( ( response ) => response.json() )
					 .then( ( json ) => {
						 console.log(json);
						 var posts = json.map( function(post, i){
							 return { post }
						 });
						 return posts;
					 })
					 .catch(function(e) {
						 console.log(e);
					 });
				 }
			 }

			 function handleFetchErrors( response ) {
				 if (!response.ok) {
					 console.log('fetch error, status: ' + response.statusText);
				 }
				 return response;
			 }

			 const breaking_news_block = (
				 <p>{__('Post hasn\'t been loaded')}</p>
			 );

			 if ( true === getPost ) {
				 console.log(posts[0].post);
				 let date1 = moment(posts[0].post.date);
				 let date2 = moment(moment.utc().toJSON());
				 console.log(date1);
				 console.log(date2);
				 let diffInMinutes = date2.diff(date1, 'hours');
				 console.log(diffInMinutes);

				 if ( diffInMinutes < parseInt( posts[0].post.jm_breaking_news_limit ) ) {
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

			 return [
				 <div className={className}>
					 { hasPost && (<section className={ 'breaking-news-box' }>
						 <div className={ 'breaking-news-left' }>
							 <h2 className={ 'breaking-news-left-h2' }>{ __( 'Breaking News', 'jm-breaking-news' ) }</h2>
						 </div>
						 <div className={ 'breaking-news-right' }>
							 <p className={ 'breaking-news-right-h2' }>{ posts[0].post.title.rendered }</p>
						 </div>
					 </section> ) }
					 { !hasPost && ( <p>
						 { __( 'The latest breaking news post has expired.', 'jm-breaking-news' )  }
					 </p> ) }
				 </div>
			 ];
		 },

		 save( { attributes, setAttributes, focus, setFocus, className } ) {
			 // Rendering in PHP
			 return null;
		 },
	 }
);
