/**
 * BLOCK: reference-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

const { __ } = wp.i18n;
const {
    InspectorControls,
    registerBlockType,
    blockEditRender,
    Spinner
} = wp.blocks; // Import registerBlockType() from wp.blocks

//this is where block control componants go! a-ha!
//const { ToggleControl, SelectControl } = InspectorControls;
/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registered, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType( 'jm-breaking-news/jm-live-blog-block', {
    // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
    title: __('JM Breaking News', 'jm-breaking-news' ),
    icon: 'lightbulb', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
    category: 'widgets', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
    keywords: [
        __( 'JM Breaking News', 'jm-breaking-news' ),
        __( 'breaking news', 'jm-breaking-news' ),
        __( 'news', 'jm-breaking-news' ),
    ],
    attributes: {

    },

    // The "edit" property must be a valid function.
    edit( { attributes, setAttributes, focus, setFocus, className } ) {
        return [
            <div className={className}>
                <h2>{__('JM Breaking News', 'jm-breaking-news')}</h2>
                <p>{__('The JM Breaking News  isn\'t directly editable. You can control the look of the breaking news item when creating a new breaking news item.', 'jm-breaking-news')}</p>
            </div>
        ];
    },

    // The "save" property must be specified and must be a valid function.
    //this is what puts the html in the "edit as html" box
    save() {
        return null;
    },
});