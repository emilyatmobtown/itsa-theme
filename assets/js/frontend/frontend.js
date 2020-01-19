import Navigation from './components/Navigation';
new Navigation();

import jQuery from 'jquery';
jQuery( function( $ ){
	/* global ajaxUrl, postType, maxPageMyAjax:writable, postsMyAjax:writable, currentPageMyAjax:writable */

	$( '#post-grid-filter' ).submit( function() {
		const filter         = $( '#post-grid-filter' );
		const loadMoreButton = $( '#post-grid-load-more' );
		const results        = $( '#post-grid-filter-results' );

		$.ajax( {
			url : ajaxUrl,
			data : filter.serialize(),
			dataType : 'json',
			type : 'POST',
			/**
		    * Updates the button text before sending the request
		    */
			beforeSend : function(){
				filter.find( 'button' ).text( 'Processing...' );
			},
			/**
		    * Updates the globals and the button text. Toggles the load more
			* button. Displays the updated content.
			* @params {object} data
		    */
			success : function( data ){
				currentPageMyAjax = 1;
				postsMyAjax       = data.posts;
				maxPageMyAjax     = data.maxPage;

				results.html( data.content );
				filter.find( 'button' ).text( 'Apply filter' );

				if ( 2 > data.maxPage ) {
					loadMoreButton.hide();
				} else {
					loadMoreButton.show();
				}
			},
			/**
		    * Displays the error message.
			* @params {object} req
			* @params {string} err
		    */
			error : function( req, err ) {
				console.error( `error: ${ err }` );
			}
		} );
		return false;
	} );

	$( '#post-grid-load-more' ).click( function() {
		const loadMoreButton = $( this );

		$.ajax( {
			url : ajaxUrl, // AJAX handler
			data : {
				'action' : 'post-grid-load-more',
				'query'  : postsMyAjax,
				'page'   : currentPageMyAjax,
				'type'   : postType,
			},
			type : 'POST',
			/**
		    * Updates the button text before sending the request
		    */
			beforeSend : function () {
				loadMoreButton.text( 'Loading...' );
			},
			/**
		    * Updates the currentPageMyAjax and the button text. Toggles the
			* load more button. Displays the updated content.
			* @params {object} data
		    */
			success : function( data ) {
				if ( data ) {
					loadMoreButton.text( 'More posts' );
					$( '#post-grid-filter-results' ).append( data );

					currentPageMyAjax++;
					if ( currentPageMyAjax === maxPageMyAjax ) {
						loadMoreButton.hide();
					}
				} else {
					loadMoreButton.hide();
				}
			},
			/**
		    * Displays the error message.
			* @params {object} req
			* @params {string} err
		    */
			error : function( req, err ) {
				console.error( `error: ${ err }` );
			}
		} );
		return false;
	} );
} );
