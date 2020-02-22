<?php
/**
 * Class: ITSABlockParser
 *
 * @package ITSATheme\ITSABlockParser
 * @since 0.1.0
 */

namespace ITSATheme\ITSAParser;

use WP_Block_Parser;
use ITSATheme\Utility;

add_filter(
	'block_parser_class',
	function() {
		return __NAMESPACE__ . '\\ITSABlockParser';
	}
);

/***
 * Specialized block serialization parser
 */
class ITSABlockParser extends WP_Block_Parser {

	/**
	 * Post types to use this parser on
	 *
	 * @var array
	 */
	public static $allowed_post_types = array(
		'news',
		'event',
		'advocacy-material',
	);

	/**
	 * Parse document to get a list of block structures
	 *
	 * @param string $document  Input document being parsed.
	 */
	public function parse( $document ) {
		$this->document    = $document;
		$this->offset      = 0;
		$this->output      = array();
		$this->stack       = array();
		$this->empty_attrs = json_decode( '{}', true );
		// phpcs:disable Generic.CodeAnalysis.EmptyStatement
		do {
			// twiddle our thumbs.
		} while ( $this->proceed() );
		// phpcs:enable

		return $this->process_output();
	}

	/**
	 * Inject social share and entry meta into post content
	 */
	public function process_output() {
		$last_block_key    = 0;
		$block_name_needle = 'acf/header';
		$the_id            = get_the_ID() ? get_the_ID() : Utility\get_acf_post_id();

		if ( ! is_array( $this->output ) ) {
			return $this->output;
		}
		// Only inject into content for allowed post types
		if ( ! is_admin() && in_array( get_post_type(), self::$allowed_post_types, true ) && is_single( $the_id ) ) {
			$social_share_html = \itsa_get_social_share();
			$entry_meta_html   = \itsa_get_entry_meta();

			foreach ( $this->output as $index => $block ) {
				if ( ! isset( $block['blockName'] ) ) {
					continue;
				}

				if ( $block_name_needle === $block['blockName'] ) {
					$last_block_key = $index + 1;
				}
			}

			// Inject after header block or the page title
			if ( isset( $this->output[ $last_block_key ]['innerHTML'] ) ) {
				$this->output[ $last_block_key ]['innerHTML'] = $entry_meta_html . $social_share_html . $this->output[ $last_block_key ]['innerHTML'];
			}

			if ( isset( $this->output[ $last_block_key ]['innerContent'][0] ) ) {
				$this->output[ $last_block_key ]['innerContent'][0] = $entry_meta_html . $social_share_html . $this->output[ $last_block_key ]['innerContent'][0];
			}
		}

		return $this->output;
	}
}
