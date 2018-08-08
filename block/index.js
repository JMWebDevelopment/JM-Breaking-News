/**
 * BLOCK: reference-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
//import './style.scss';
//import './editor.scss';
//import Selecta from './selecta.js';

import Select2 from './Select2';

const { __ } = wp.i18n; // Import __() from wp.i18n
const {
    InspectorControls,
    registerBlockType,
    blockEditRender,
    Spinner
} = wp.blocks; // Import registerBlockType() from wp.blocks

//this is where block control componants go! a-ha!
const { ToggleControl, SelectControl } = InspectorControls;
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
registerBlockType( 'teaser/reference-block', {
    // Block name. Block names must be string that contains a namespace prefix. Example: my-plugin/my-custom-block.
    title: "Teaser", // Block title.
    icon: 'analytics', // Block icon from Dashicons → https://developer.wordpress.org/resource/dashicons/.
    category: 'common', // Block category — Group blocks together based on common traits E.g. common, formatting, layout widgets, embed.
    keywords: [
        __( 'teaser block' ),
        __( 'teaser' ),
        __( 'create-guten-block' ),
    ],
    attributes: {
        getPost: {
            type: 'boolean',
            default: true,
        },
        hasPost: {
            type: 'boolean',
            default: false,
        },
        output: {
            type: 'string',
            default: '',
        },
        post_id: {
            type: 'int',
        },
        post_title: {
            type: 'string',
        },
        template: {
            type: 'string',
            default: 'block-'+ngfb.template_prefix
        },
        templates: {
            type: 'array',
        }
    },

    // The "edit" property must be a valid function.
    edit( { attributes, setAttributes, focus, setFocus, className } ) {
        const { getPost, hasPost, output, post_id, post_title, template, templates } = attributes;
        function onSelectData( option ){
            if( option === null ){
                setAttributes({
                    post_id: "",
                    post_title: "",
                    hasPost: false,
                    getPost: false,
                });
            } else {
                getTemplates().then( function( options ){
                    setAttributes({
                        post_id: option.value,
                        post_title: option.label,
                        hasPost: true,
                        getPost: true,
                        templates: options
                    });
                }).then(function() {
                    getPostDisplay( option.value, template ).then( function( display ){
                        setAttributes({
                            output: display,
                            getPost: false,
                        });
                    });
                });
            }
        }

        function onSelectTemplate( option ){
            getPostDisplay( post_id, option ).then( function( display ){
                setAttributes({
                    template: option,
                    output: display,
                    getPost: false,
                });
            });
        }

        function getPostDisplay( post_id, this_template ){
            var url = '/wp-json/reference-block/v1/get-block/' + post_id + '/temp/' + this_template;
            var vars = jQuery.param( attributes );
            url = url+'?'+vars;
            return fetch( url, {
                credentials: 'same-origin',
                method: 'get',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': ngfb.nonce
                },

            })
                .then( handleFetchErrors )
                .then( ( response ) => response.json() )
                .then( ( json ) => {
                    if( json ){
                        var display = json.html;
                        return display;
                    }
                }).catch(function(e) {
                    console.log(e);
                });
        }

        function getTemplates(){
            var url = '/wp-json/reference-block/v1/get-block-templates/'+ ngfb.template_prefix;
            return fetch( url, {
                credentials: 'same-origin',
                method: 'get',
                headers: {
                    Accept: 'application/json',
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': ngfb.nonce
                }})
                .then( handleFetchErrors )
                .then( ( response ) => response.json() )
                .then( ( json ) => {
                    var options = json.map( function(opt, i){
                        return {value: opt.basename, label: opt.template_name}
                    })
                    return options;
                })
                .catch(function(e) {
                    console.log(e);
                });

        }

        function handleFetchErrors( response ) {
            if (!response.ok) {
                console.log('fetch error, status: ' + response.statusText);
            }
            return response;
        }

        var selectaValue = { value: post_id, label: post_title }
        const selecta = (
            <Select2
                onChange={ onSelectData }
                restUrl="/wp-json/reference-block/v1/search-query/"
                initial_value={ selectaValue }
                nonce={ ngfb.nonce }
            />
        );

        const templateSelectControl = (
            <SelectControl
                type= 'number'
                label= 'Select Template'
                onChange = { onSelectTemplate }
                value = { template }
                options ={ templates }
            />
        )

        const controls = focus && (
            <InspectorControls key="inspector">
                <div class="blocks-base-control">
                    <label class="blocks-base-control_label">Search for a Post</label>
                    { selecta }
                </div>
                { templateSelectControl }
            </InspectorControls>
        );

        if ( ! hasPost ) {
            return [
                controls,
                <div className={ className }>
                    { selecta }
                </div>
            ]
        } else {
            if( getPost ){
                return [
                    controls,
                    <div className={ className } >
                        <div class="teaser-spinner"></div>
                    </div>
                ]
            } else {
                return [
                    controls,
                    <div className={ className } dangerouslySetInnerHTML={ { __html: output } } />
                ]
            }
        }
    },

    // The "save" property must be specified and must be a valid function.
    //this is what puts the html in the "edit as html" box
    save() {
        return null;
    },
});