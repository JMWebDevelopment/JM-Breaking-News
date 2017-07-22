jQuery( function( $ ) {
    $(document).ready( function() {
        $.get( jmloadposts.rest_url + 'wp/v2/posts?per_page=25', function ( res ) {
            if ( res ) {
                var html = '';
                res.forEach( function( post ) {
                    if ( jmloadposts.selected_post != '' && jmloadposts.selected_post == post.id ) {
                        var selected = 'selected="selected"';
                    } else {
                        var selected = '';
                    }
                    html += '<option value="' + post.id + '" ' + selected + '>' + post.title.rendered + '</option>';
                });
                $('#jm_breaking_news_internal_link').html( html );
            }
        });
    });
});