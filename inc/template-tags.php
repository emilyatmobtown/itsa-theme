<?php
/**
 * Custom template tags for ITSA theme.
 *
 * This file is for custom template tags only and it should not contain
 * functions that will be used for filtering or adding an action.
 *
 * All functions should be prefixed with "itsa" in order to prevent
 * pollution of the global namespace and potential conflicts with functions
 * from plugins.
 *
 * @package ITSATheme\Template_Tags
 *
 */

use ITSATheme\Utility;

/**
 * Get HTML for social share
 *
 * @return string
 * @since 0.1.0
 */
function itsa_get_social_share() {
	$html = '<div class="entry-meta-social inverse-color">
				<span class="entry-meta-text">' . __( 'Share', 'itsa-theme' ) . '</span>
				<a class="icon social-icon twitter-icon" href="#"><span class="screen-reader-text">' . __( 'Twitter', 'itsa-theme' ) . '</span></a>
				<a class="icon social-icon facebook-icon" href="#"><span class="screen-reader-text">' . __( 'Facebook', 'itsa-theme' ) . '</span></a>
				<a class="icon social-icon instagram-icon" href="#"><span class="screen-reader-text">' . __( 'Instagram', 'itsa-theme' ) . '</span></a>
			</div><!-- .entry-meta-social -->';
	return $html;
}

/**
 * Display HTML for social share
 *
 * @return string
 * @since 0.1.0
 */
function itsa_the_social_share() {
	echo wp_kses_post( itsa_get_social_share() );
}

/**
 * Get HTML for button for more info on a post. Uses registration URL if the post
 * is an event and one exists. Otherwise uses the permalink.
 *
 * @param  WP_POST $the_post
 * @return string
 * @since 0.1.0
 */
function itsa_get_post_button( $the_post = null ) {
	global $post;

	if ( empty( $the_post ) || ! isset( $the_post ) ) {
		$the_post = $post;
	}
	$html = '';

	$posttype = get_post_type( $the_post->ID );
	if ( 'event' === $posttype ) {
		$registration_url = get_field( 'event_url' );
	}

	if ( ! empty( $registration_url ) ) {
		$html .= '<a href="' . $registration_url . '" title="';
		$html .= __( 'Register', 'itsa-theme' );
		$html .= '"><button class="has-arrow-right">';
		$html .= __( 'Register', 'itsa-theme' );
		$html .= '</button></a>';
	} else {
		$html .= '<a href="' . get_the_permalink( $the_post->ID ) . '" title="' . get_the_title( $the_post->ID ) . '"><button class="has-arrow-right">';
		$html .= __( 'Read More', 'itsa-theme' );
		$html .= '</button></a>';
	}

	return $html;
}

/**
 * Display HTML for button for more info on a post. Uses registration URL if the
 * post is an event and one exists. Otherwise uses the permalink.
 *
 * @param  WP_POST $the_post
 * @return string
 * @since 0.1.0
 */
function itsa_the_post_button( $the_post = null ) {
	echo wp_kses_post( itsa_get_post_button( $the_post ) );
}

/**
 * Get HTML for post type and issue taxonomy
 *
 * @param  WP_POST $the_post
 * @return string
 * @since 0.1.0
 */
function itsa_get_type_and_term( $the_post = null ) {
	global $post;

	if ( empty( $the_post ) || ! isset( $the_post ) ) {
		$the_post = $post;
	}

	$html = '';

	$posttype = get_post_type( $the_post->ID );
	$terms    = get_the_terms( $the_post, $posttype . '-type' );

	if ( ! empty( $terms ) && isset( $terms ) ) {
		// Display the first term only
		$the_type = $terms[0]->name;
	} else {
		$the_type = itsa_get_post_type_plural_label( $posttype );
	}

	$issues = get_the_terms( $the_post, 'issue' );
	if ( ! empty( $issues ) && isset( $issues ) ) {
		// Display the first issue only
		$issue = $issues[0]->name;
	}

	if ( ! ( empty( $the_type ) && empty( $issue ) ) ) {
		$html .= '<span class="entry-tag">' . $the_type;

		if ( ! empty( $issue ) ) {
			$html .= ' | ' . $issue;
		}

		$html .= '</span>';
	}

	return $html;
}

/**
 * Display HTML for post type and issue taxonomy
 *
 * @param  WP_POST $the_post
 * @return string
 * @since 0.1.0
 */
function itsa_the_type_and_term( $the_post = null ) {
	echo wp_kses_post( itsa_get_type_and_term( $the_post ) );
}

/**
 * Get HTML for post meta
 *
 * @param  WP_POST $the_post
 * @return string
 * @since 0.1.0
 */
function itsa_get_entry_meta( $the_post = null ) {
	global $post;

	if ( empty( $the_post ) || ! isset( $the_post ) ) {
		$the_post = $post;
	}

	$posttype = get_post_type( $the_post->ID );

	$html = '<div class="entry-meta">';

	if ( is_singular( $posttype ) ) {
		// Get the event type, news type, or advocacy material type
		$terms = get_the_terms( $the_post, $posttype . '-type' );
		if ( ! empty( $terms ) && isset( $terms ) ) {
			// Display the first term only
			$term  = $terms[0]->name;
			$html .= '<span class="entry-meta-text">' . $term . '</span>';
		} else {
			$html .= '<span class="entry-meta-text">' . itsa_get_post_type_plural_label( $posttype ) . '</span>';
		}
	}

	if ( has_term( '', 'issue', $the_post ) && is_singular( $posttype ) ) {
		$html .= '<div class="entry-meta-text">
					<span>' . __( 'Issues', 'itsa-theme' ) . ': </span>';
		$html .= get_the_term_list( $the_post->ID, 'issue', '<ul class="entry-categories"><li class="entry-category" rel="category tag">', ', </li><li class="entry-category">', '</li></ul>' );
		$html .= '</div><!-- .entry-meta-text -->';
	}

	if ( 'news' === $posttype ) {
		$html .= '<time class="entry-meta-text" datetime="' . get_the_date( 'c', $the_post->ID ) . '"  itemprop="datePublished">' . get_the_date( '', $the_post->ID ) . '</time>';
	}

	if ( 'event' === $posttype ) {
		$html .= '<div class="entry-meta-event">';

		$start_date = get_field( 'event_start_date', $the_post->ID );
		$end_date   = get_field( 'event_end_date', $the_post->ID );
		$start_time = get_field( 'event_start_time', $the_post->ID );
		$end_time   = get_field( 'event_end_time', $the_post->ID );
		$timezone   = get_field( 'event_timezone', $the_post->ID );

		$location = get_field( 'event_location', $the_post->ID );
		if ( ! has_term( 'webinars', 'event-type', $the_post ) ) {
			// translators: This is the label that appears when no location is set.
			$location = empty( $location ) ? __( 'Location TBD', 'itsa-theme' ) : $location;
		}

		$presenter = get_field( 'event_presenter', $the_post->ID );

		if ( ! empty( $start_date ) ) {
			$html .= '<span class="entry-meta-text display-block">' . itsa_get_date_span( $start_date, $end_date );

			if ( ! empty( $start_time ) ) {
				$html .= ' | ' . itsa_get_time_span( $start_time, $end_time, $timezone );
			}

			$html .= '</span>';
		}

		if ( ! empty( $location ) ) {
			$html .= '<span class="entry-meta-text display-block">' . $location . '</span>';
		}

		if ( ! empty( $presenter ) ) {
			// translators: This is the label preceding the presenter for an Event.
			$html .= '<span class="entry-meta-text display-block">' . __( 'Presented by', 'itsa-theme' ) . ': ' . $presenter . '</span>';
		}

		$html .= '</div><!-- .entry-meta-event -->';
	}

	$html .= '</div><!-- .entry-meta -->';

	return $html;
}

/**
 * Display HTML for post meta
 *
 * @param  WP_POST $the_post
 * @return string
 * @since 0.1.0
 */
function itsa_the_entry_meta( $the_post = null ) {
	echo wp_kses_post( itsa_get_entry_meta( $the_post ) );
}

/**
 * Get formatted string for span between two dates
 *
 * @param  string $start
 * @param  string $end
 * @param  string $timezone
 * @return string
 * @since 0.1.0
 */
function itsa_get_date_span( $start = '', $end = '' ) {
	$date_span = '';

	if ( is_string( $start ) && ! empty( $start ) ) {
		$start_date = getdate( strtotime( $start ) );
	}

	if ( ! empty( $start_date ) ) {
		$date_span .= $start_date['month'] . ' ' . $start_date['mday'];

		if ( is_string( $end ) && ! empty( $end ) ) {
			$end_date = getdate( strtotime( $end ) );
		}

		if ( ! empty( $end_date ) ) {
			if ( $start_date['year'] !== $end_date['year'] ) {
				$date_span .= ', ' . $start_date['year'] . ' - ' . $end_date['month'] . ' ' . $end_date['mday'];
			} else {
				if ( $start_date['month'] !== $end_date['month'] ) {
					$date_span .= ' - ' . $end_date['month'] . ' ' . $end_date['mday'];
				} else {
					$date_span .= '-' . $end_date['mday'];
				}
			}
			$date_span .= ', ' . $end_date['year'];
		} else {
			$date_span .= ', ' . $start_date['year'];
		}
	}

	return $date_span;
}

/**
 * Get formatted string for span between two times, including optional timezone.
 *
 * @param  string $start
 * @param  string $end
 * @param  string $timezone
 * @return string
 * @since 0.1.0
 */
function itsa_get_time_span( $start = '', $end = '', $timezone = '' ) {
	$time_span = '';

	if ( is_string( $start ) && ! empty( $start ) ) {
		$start_time = getdate( strtotime( $start ) );
	}

	if ( ! empty( $start_time ) ) {
		$start_suffix = 'pm';
		if ( $start_time['hours'] > 12 ) {
			$time_span .= $start_time['hours'] - 12;
		} elseif ( 0 === $start_time['hours'] ) {
			$start_suffix = 'am';
			$time_span   .= '12';
		} else {
			$start_suffix = 'am';
			$time_span   .= $start_time['hours'];
		}

		if ( $start_time['minutes'] < 10 ) {
			$time_span .= ':0' . $start_time['minutes'];
		} else {
			$time_span .= ':' . $start_time['minutes'];
		}

		if ( is_string( $end ) && ! empty( $end ) ) {
			$end_time = getdate( strtotime( $end ) );

			if ( ! empty( $end_time ) ) {
				$time_span .= '-';
				$end_suffix = 'pm';
				if ( $end_time['hours'] > 12 ) {
					if ( $start_suffix !== $end_suffix ) {
						$time_span .= ' ' . $start_suffix;
					}
					$time_span .= '-' . ( $end_time['hours'] - 12 );
				} elseif ( 0 === $end_time['hours'] ) {
					$end_suffix = 'am';
					if ( $start_suffix !== $end_suffix ) {
						$time_span .= ' ' . $start_suffix;
					}
					$time_span .= '-12';
				} else {
					$end_suffix = 'am';
					if ( $start_suffix !== $end_suffix ) {
						$time_span .= ' ' . $start_suffix;
					}
					$time_span .= '-' . $end_time['hours'];
				}

				if ( $end_time['minutes'] < 10 ) {
					$time_span .= ':0' . $end_time['minutes'];
				} else {
					$time_span .= ':' . $end_time['minutes'];
				}

				$time_span .= ' ' . $end_suffix;
			}
		} else {
			$time_span .= ' ' . $start_suffix;
		}

		if ( is_string( $timezone ) && ! empty( $timezone ) ) {
			$time_span .= ' ' . $timezone;
		}
	}

	return $time_span;
}

/**
 * Get HTML for post excerpt. If not excerpt exists, then extract excerpt from
 * the first paragraph block. Optionally, include the header if there's a
 * header block;
 *
 * @param  int $length
 * @param  bool $with_title
 * @param  bool $with_entry_meta
 * @param  WP_POST | null $the_post
 * @return string
 * @since 0.1.0
 */
function itsa_get_excerpt( $length, $with_title = false, $with_entry_meta = false, $the_post = null ) {
	global $post;

	if ( empty( $the_post ) || ! isset( $the_post ) ) {
		$the_post = $post;
	}

	if ( empty( $length ) ) {
		$length = 240;
	}

	$excerpt     = '';
	$has_excerpt = has_excerpt( $the_post->ID );

	if ( $with_title ) {
		$header_block = Utility\get_block( 'acf/header', $the_post );

		if ( ! empty( $header_block ) && isset( $header_block ) ) {
			$excerpt .= render_block( $header_block );
		}
	}

	if ( $with_entry_meta ) {
		$excerpt .= itsa_get_entry_meta( $the_post );
	}

	if ( false === $has_excerpt ) {
		$paragraph_block = Utility\get_block( 'core/paragraph', $the_post );

		if ( ! empty( $paragraph_block ) && isset( $paragraph_block ) ) {
			// Render paragraph block
			$paragraph = render_block( $paragraph_block );

			// Strip HTML tags
			$text = wp_strip_all_tags( $paragraph );

			// Cut string at limit + 1
			$text = substr( $text, 0, $length + 1 );

			// Drop any cut-off words
			$text     = substr( $text, 0, strrpos( $text, ' ' ) );
			$excerpt .= '<p>' . $text . '&hellip;</p>';
		}
	} else {
		$excerpt .= '<p>' . get_the_excerpt( $the_post->ID ) . '</p>';
	}

	return $excerpt;
}

/**
* Display HTML for post excerpt using first paragraph block. Optionally, include
* the title if there's a header block;
 *
 * @param  int $length
 * @param  bool $with_title
 * @param  bool $with_entry_meta
 * @param  WP_POST | null $the_post
 * @return string
 * @since 0.1.0
 */
function itsa_the_excerpt( $length, $with_title = false, $with_entry_meta = false, $the_post = null ) {
	echo wp_kses_post( itsa_get_excerpt( $length, $with_title, $with_entry_meta, $the_post ) );
}

/**
 * Get singular label for post type.
 *
 * @param string
 * @return string
 * @since 0.1.0
 */
function itsa_get_post_type_singular_label( $posttype = '' ) {
	if ( ! empty( $posttype ) && post_type_exists( $posttype ) ) {
		$object = get_post_type_object( $posttype );
		return $object->labels->singular_name;
	}
}

/**
 * Get plural label for post type.
 *
 * @param string
 * @return string
 * @since 0.1.0
 */
function itsa_get_post_type_plural_label( $posttype = '' ) {
	if ( ! empty( $posttype ) && post_type_exists( $posttype ) ) {
		$object = get_post_type_object( $posttype );
		return $object->labels->name;
	}
}

/**
 * Get singular label for taxonomy.
 *
 * @param string
 * @return string
 * @since 0.1.0
 */
function itsa_get_tax_singular_label( $tax = '' ) {
	if ( ! empty( $tax ) && taxonomy_exists( $tax ) ) {
		$object = get_taxonomy( $tax );
		return $object->labels->singular_name;
	}
}

/**
 * Get plural label for taxonomy.
 *
 * @param string
 * @return string
 * @since 0.1.0
 */
function itsa_get_tax_plural_label( $tax = '' ) {
	if ( ! empty( $tax ) && taxonomy_exists( $tax ) ) {
		$object = get_taxonomy( $tax );
		return $object->labels->name;
	}
}
