<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package masDocs
 */

if ( ! function_exists( 'masdocs_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function masdocs_entry_footer() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$posted_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x( 'Updated on %s', 'post date', 'masdocs' ),
				$time_string
			);
		} else {
			$posted_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x( 'Posted on %s', 'post date', 'masdocs' ),
				$time_string
			);
		}

		$author_link = '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="post-author">'. wp_kses_post( get_avatar( get_the_author_meta( 'ID' ), 32 ) ) . '  ' . esc_html( get_the_author() ) . '</a>';

		echo '<span class="byline">' . $author_link  . '</span><span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

		//echo masdocs_entry_meta();

	}
endif;

if ( ! function_exists( 'masdocs_entry_meta' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function masdocs_entry_meta() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'masdocs' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="meta-title">' . esc_html__( 'Posted in', 'masdocs' ) . '</span><span class="cat-links">' . esc_html__( '%1$s', 'masdocs' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'masdocs' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="meta-title">' . esc_html__( 'Tagged', 'masdocs' ) . '</span><span class="tags-links">' . esc_html__( '%1$s', 'masdocs' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}
	}
endif;
