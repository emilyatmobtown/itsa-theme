import Navigation from './components/Navigation';
new Navigation();

import jQuery from 'jquery';
jQuery( function( $ ){
	/* global ajaxUrl, postType, loadMoreNonce, maxPageMyAjax:writable, postsMyAjax:writable, currentPageMyAjax:writable */

	const filter         = $( '#post-grid-filter' );
	const results        = $( '#post-grid-filter-results' );
	const loadMoreButton = $( '#post-grid-load-more' );
	const filterLoader   = $( '#post-grid-filter-loader' );
	const loadMoreLoader = $( '#post-grid-load-more-loader' );

	$( '#post-grid-filter select' ).change( function() {

		$.ajax( {
			url : ajaxUrl,
			data : filter.serialize(),
			dataType : 'json',
			type : 'POST',
			/**
			* Shows loader icon before sending request
			*/
			beforeSend : function() {
				filterLoader.removeClass( 'hidden' );
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

				filterLoader.addClass( 'hidden' );
				results.html( data.content );

				if ( 2 > data.maxPage ) {
					loadMoreButton.detach();
				} else {
					loadMoreButton.insertAfter( results );
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

	loadMoreButton.click( function() {

		$.ajax( {
			url : ajaxUrl, // AJAX handler
			data : {
				'action' : 'post-grid-load-more',
				'query'  : postsMyAjax,
				'page'   : currentPageMyAjax,
				'type'   : postType,
				'nonce'  : loadMoreNonce,
			},
			type : 'POST',
			/**
			* Shows loader icon before sending request
			*/
			beforeSend : function() {
				loadMoreLoader.removeClass( 'hidden' );
			},
			/**
			* Updates the currentPageMyAjax and the button text. Toggles the
			* load more button. Displays the updated content.
			* @params {object} data
			*/
			success : function( data ) {
				if ( data ) {
					loadMoreLoader.addClass( 'hidden' );
					results.append( data );

					currentPageMyAjax++;
					if ( currentPageMyAjax === maxPageMyAjax ) {
						loadMoreButton.detach();
					}
				} else {
					loadMoreLoader.addClass( 'hidden' );
					loadMoreButton.detach();
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
