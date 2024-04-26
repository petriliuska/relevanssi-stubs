<?php

/**
 * /lib/class-relevanssi-taxonomy-walker.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * A taxonomy walker used in Relevanssi interface.
 *
 * This is needed for wp_terms_checklist() in the Relevanssi admin interface to
 * control the way the taxonomies are listed.
 */
class Relevanssi_Taxonomy_Walker extends \Walker_Category_Checklist
{
    /**
     * Name of the input element.
     *
     * @var string $name Name of the input element.
     */
    public $name;
    /**
     * Creates a single element of the list.
     *
     * @see Walker::start_el()
     *
     * @param string $output   Used to append additional content (passed by reference).
     * @param object $category Category data object.
     * @param int    $depth    Optional. Depth of category in reference to parents. Default 0.
     * @param array  $args     Optional. An array of arguments. See wp_list_categories(). Default empty array.
     * @param int    $id       Optional. ID of the current category. Default 0.
     */
    public function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0)
    {
    }
}
/**
 * Checks if current user can access Relevanssi options.
 *
 * If the current user doesn't have sufficient access to Relevanssi options,
 * the function will die. If the user has access, nothing happens.
 *
 * @return void
 */
function relevanssi_current_user_can_access_options()
{
}
/**
 * Truncates the Relevanssi index.
 *
 * Wipes the index clean using relevanssi_truncate_index().
 */
function relevanssi_truncate_index_ajax_wrapper()
{
}
/**
 * Indexes posts in AJAX context.
 *
 * AJAX wrapper for indexing posts. Parses the arguments, uses the
 * relevanssi_build_index() to do the hard work, then creates the AJAX response.
 */
function relevanssi_index_posts_ajax_wrapper()
{
}
/**
 * Counts the posts to index.
 *
 * AJAX wrapper for relevanssi_count_total_posts().
 */
function relevanssi_count_posts_ajax_wrapper()
{
}
/**
 * Counts the posts missing from the index.
 *
 * AJAX wrapper for relevanssi_count_missing_posts().
 */
function relevanssi_count_missing_posts_ajax_wrapper()
{
}
/**
 * Lists categories.
 *
 * AJAX wrapper for get_categories().
 */
function relevanssi_list_categories()
{
}
/**
 * Performs an admin search.
 *
 * Performs an admin dashboard search.
 *
 * @since 2.2.0
 */
function relevanssi_admin_search()
{
}
/**
 * Formats the posts for admin search.
 *
 * Results are presented as an ordered list of posts. The format is very basic, and
 * can be modified with the 'relevanssi_admin_search_element' filter hook.
 *
 * @param array  $posts  The posts array.
 * @param int    $total  The number of posts found in total.
 * @param int    $offset Offset value.
 * @param string $query  The search query.
 *
 * @return string The formatted posts.
 *
 * @since 2.2.0
 */
function relevanssi_admin_search_format_posts($posts, $total, $offset, $query)
{
}
/**
 * Shows debugging information about the search.
 *
 * Formats the WP_Query parameters, looks at some filter hooks and presents the
 * information in an easy-to-read format.
 *
 * @param WP_Query $query The WP_Query object.
 *
 * @return string The formatted debugging information.
 *
 * @since 2.2.0
 */
function relevanssi_admin_search_debugging_info($query)
{
}
/**
 * Updates count options.
 *
 * Updates 'relevanssi_doc_count', 'relevanssi_terms_count' (and in Premium
 * 'relevanssi_user_count' and 'relevanssi_taxterm_count'). These are slightly
 * expensive queries, so they are updated when necessary as a non-blocking AJAX
 * action and stored in options for quick retrieval.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The Relevanssi global variable, used for table names.
 */
function relevanssi_update_counts()
{
}
/**
 * Returns a comma-separated list of indexed custom field names.
 *
 * @uses relevanssi_list_all_indexed_custom_fields()
 */
function relevanssi_list_custom_fields()
{
}
/**
 * /lib/common.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Adds the search result match breakdown to the post object.
 *
 * Reads in the number of matches and stores it in the relevanssi_hits field
 * of the post object. The post object is passed as a reference and modified
 * on the fly.
 *
 * @param object $post The post object, passed as a reference.
 * @param array  $data The source data.
 */
function relevanssi_add_matches(&$post, $data)
{
}
/**
 * Generates the search result breakdown added to the search results.
 *
 * Gets the source data from the post object and then replaces the placeholders
 * in the breakdown template with the data.
 *
 * @param object $post The post object.
 *
 * @return string The search results breakdown for the post.
 */
function relevanssi_show_matches($post)
{
}
/**
 * Generates the "Missing:" element for the search results breakdown.
 *
 * @param WP_Post $post The post object, which should have the missing terms in
 * $post->relevanssi_hits['missing_terms'].
 *
 * @return string The missing terms.
 */
function relevanssi_generate_missing_terms_list($post)
{
}
/**
 * Checks whether the user is allowed to see the post.
 *
 * The default behaviour on 'relevanssi_post_ok' filter hook. Do note that while
 * this function takes $post_ok as a parameter, it actually doesn't care much
 * about the previous value, and will instead overwrite it. If you want to make
 * sure your value is preserved, either disable this default function, or run
 * your function on a later priority (this defaults to 10).
 *
 * Includes support for various membership plugins. Currently supports Members,
 * Groups, Simple Membership and s2member.
 *
 * @param boolean $post_ok Can the post be shown to the user.
 * @param int     $post_id The post ID.
 *
 * @return boolean $post_ok True if the user is allowed to see the post,
 * otherwise false.
 */
function relevanssi_default_post_ok($post_ok, $post_id)
{
}
/**
 * Populates the Relevanssi post array.
 *
 * This is a caching mechanism to reduce the number of database queries required.
 * This function fetches all post data for the matches found using single MySQL
 * query, instead of doing up to 500 separate get_post() queries.
 *
 * @global array  $relevanssi_post_array An array of fetched posts.
 * @global object $wpdb                  The WordPress database interface.
 *
 * @param array $matches An array of search matches.
 * @param int   $blog_id The blog ID for multisite searches. Default -1.
 */
function relevanssi_populate_array($matches, $blog_id = -1)
{
}
/**
 * Returns the custom fields to index.
 *
 * Returns a list of custom fields to index, based on the custom field indexing
 * setting.
 *
 * @return array|string An array of custom fields to index, or 'all' or 'visible'.
 */
function relevanssi_get_custom_fields()
{
}
/**
 * Removes punctuation from a string.
 *
 * This function removes some punctuation and replaces some punctuation with spaces.
 * This can partly be controlled from Relevanssi settings: see Advanced Indexing
 * Settings on the Indexing tab. This function runs on the
 * 'relevanssi_remove_punctuation' filter hook and can be disabled, if necessary.
 *
 * @param string $a The source string.
 *
 * @return string The string without punctuation.
 */
function relevanssi_remove_punct($a)
{
}
/**
 * Prevents the default search from running.
 *
 * When Relevanssi is active, this function prevents the default search from running,
 * in order to save resources. There are some exceptions, where we don't want
 * Relevanssi to meddle.
 *
 * This function originally created by John Blackbourne.
 *
 * @global object $wpdb The WordPress database interface.
 *
 * @param string $request The MySQL query for the search.
 * @param object $query   The WP_Query object.
 */
function relevanssi_prevent_default_request($request, $query)
{
}
/**
 * Tokenizes strings.
 *
 * Tokenizes strings, removes punctuation, converts to lowercase and removes
 * stopwords. The function accepts both strings and arrays of strings as
 * source material. If the parameter is an array of string, each string is
 * tokenized separately and the resulting tokens are combined into one array.
 *
 * @param string|array   $str             The string, or an array of strings, to
 *                                        tokenize.
 * @param boolean|string $remove_stops    If true, stopwords are removed. If
 * 'body', also removes the body stopwords. Default true.
 * @param int            $min_word_length The minimum word length to include.
 * Default -1.
 * @param string         $context         The context for tokenization, can be
 * 'indexing' or 'search_query'.
 *
 * @return int[] An array of tokens as the keys and their frequency as the
 * value.
 */
function relevanssi_tokenize($str, $remove_stops = \true, int $min_word_length = -1, $context = 'indexing') : array
{
}
/**
 * Returns the post status from post ID.
 *
 * Returns the post status. This replacement for get_post_status() can handle user
 * profiles and taxonomy terms (both always return 'publish'). The status is read
 * from the Relevanssi caching mechanism to avoid unnecessary database calls, and
 * if nothing else works, this function falls back to get_post_status().
 *
 * @global array $relevanssi_post_array The Relevanssi post cache array.
 *
 * @param string $post_id The post ID.
 *
 * @return string The post status.
 */
function relevanssi_get_post_status($post_id)
{
}
/**
 * Returns the post type.
 *
 * Replacement for get_post_type() that uses the Relevanssi post cache to reduce the
 * number of database calls required.
 *
 * @global array $relevanssi_post_array The Relevanssi post cache array.
 *
 * @param int $post_id The post ID.
 *
 * @return string The post type.
 */
function relevanssi_get_post_type($post_id)
{
}
/**
 * Adds synonyms to a search query.
 *
 * Takes a search query and adds synonyms to it.
 *
 * @param string $query The source query.
 *
 * @return string The query with synonyms added.
 */
function relevanssi_add_synonyms($query)
{
}
/**
 * Updates the 'relevanssi_doc_count' option.
 *
 * The 'relevanssi_doc_count' option contains the number of documents in the
 * Relevanssi index. This function calculates the value and stores it in the
 * option.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The Relevanssi global variable, used for table names.
 * @return int    The doc count.
 */
function relevanssi_update_doc_count()
{
}
/**
 * Launches an asynchronous action to update the doc count and other counts.
 *
 * This function should be used instead of relevanssi_update_doc_count().
 */
function relevanssi_async_update_doc_count()
{
}
/**
 * Adjusts Relevanssi variables when switch_blog() happens.
 *
 * This function attaches to the 'switch_blog' action hook and adjusts the table
 * names in the global $relevanssi_variables array to match the new blog.
 *
 * @global array  $relevanssi_variables The global Relevanssi variables.
 * @global object $wpdb                 The WordPress database interface.
 *
 * @author Teemu Muikku
 */
function relevanssi_switch_blog()
{
}
/**
 * Adds a highlight parameter to the permalink.
 *
 * Relevanssi requires a 'highligh' parameter to the permalinks in order to have
 * working highlights. This function adds the highlight. The function doesn't add
 * the parameter to the links pointing at the front page, because if we do that,
 * the link won't point to the front page anymore, but instead points to the blog
 * page.
 *
 * @global object $post The global post object.
 *
 * @param string $permalink The link to patch.
 * @param object $link_post The post object for the current link, global $post if
 * the parameter is set to null. Default null.
 *
 * @return string The link with the parameter added.
 */
function relevanssi_add_highlight($permalink, $link_post = \null)
{
}
/**
 * Checks if a post ID is the front page ID.
 *
 * Gets the front page ID from the `page_on_front` option and checks the given
 * ID against that.
 *
 * @param integer $post_id The post ID to check. If null, checks the global
 * $post ID. Default null.
 * @return boolean True if the post ID or global $post matches the front page.
 */
function relevanssi_is_front_page_id(int $post_id = \null) : bool
{
}
/**
 * Adjusts the permalink to use the Relevanssi-generated link.
 *
 * This function is used to filter 'the_permalink', 'post_link' and
 * 'relevanssi_permalink'. It changes the permalink to point to
 * $post->relevanssi_link, if that exists. This means the permalinks to
 * user profiles and taxonomy terms work. This function also adds the
 * 'highlight' parameter to the URL.
 *
 * @global object $post The global post object.
 *
 * @param string     $link      The link to adjust.
 * @param object|int $link_post The post to modify, either WP post object or the
 * post ID. If null, use global $post. Defaults null.
 *
 * @return string The modified link.
 */
function relevanssi_permalink($link, $link_post = \null)
{
}
/**
 * Instructs a multisite installation to drop the tables.
 *
 * Attaches to 'wpmu_drop_tables' and adds the Relevanssi tables to the list of
 * tables to drop.
 *
 * @global array  $relevanssi_variables The Relevanssi global variables, used for
 * table names.
 *
 * @param array $tables The list of tables to drop.
 *
 * @return array Table list, with Relevanssi tables included.
 */
function relevanssi_wpmu_drop($tables)
{
}
/**
 * Displays the list of most common words in the index.
 *
 * @global object $wpdb                 The WP database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables.
 *
 * @param int     $limit  How many words to display, default 25.
 * @param boolean $wp_cli If true, return just a list of words. If false, print out
 * HTML code.
 *
 * @return array A list of words, if $wp_cli is true.
 */
function relevanssi_common_words($limit = 25, $wp_cli = \false)
{
}
/**
 * Returns a list of post types Relevanssi does not want to use.
 *
 * @return array An array of post type names.
 */
function relevanssi_get_forbidden_post_types()
{
}
/**
 * Returns a list of taxonomies Relevanssi does not want to use.
 *
 * @return array An array of taxonomy names.
 */
function relevanssi_get_forbidden_taxonomies()
{
}
/**
 * Filters out unwanted custom fields.
 *
 * Added to the relevanssi_custom_field_value filter hook. This function removes
 * visible custom fields that are known to contain unwanted content and also
 * removes ACF meta fields (fields where content begins with `field_`).
 *
 * @see relevanssi_index_custom_fields()
 *
 * @param array  $values The custom field values.
 * @param string $field  The custom field name.
 *
 * @return array Empty array for unwanted custom fields.
 */
function relevanssi_filter_custom_fields($values, $field)
{
}
/**
 * Removes page builder short codes from content.
 *
 * Page builder shortcodes cause problems in excerpts and add junk to posts in
 * indexing. This function cleans them out.
 *
 * @param string $content The content to clean.
 *
 * @return string The content without page builder shortcodes.
 */
function relevanssi_remove_page_builder_shortcodes($content)
{
}
/**
 * Blocks Relevanssi from the admin searches on specific post types.
 *
 * This function is added to relevanssi_search_ok, relevanssi_admin_search_ok,
 * and relevanssi_prevent_default_request hooks. When a search is made with
 * one of the listed post types, these filters will get a false response, which
 * means Relevanssi won't search and won't block the default request.
 *
 * @see relevanssi_prevent_default_request
 * @see relevanssi_search
 *
 * @param boolean  $allow Should the admin search be allowed.
 * @param WP_Query $query The query object.
 */
function relevanssi_block_on_admin_searches($allow, $query)
{
}
/**
 * Checks if user has relevanssi_indexing_restriction filter functions in use.
 *
 * Temporary check for the changes in the relevanssi_indexing_restriction filter
 * in 2.8/4.7. Remove eventually. The function runs all non-Relevanssi filters
 * on relevanssi_indexing_restriction and reports all that return a string.
 *
 * @see relevanssi_init()
 *
 * @return string The notice, if there's something to complain about, empty
 * string otherwise.
 */
function relevanssi_check_indexing_restriction()
{
}
/**
 * Fetches the data and generates the HTML for the "How Relevanssi sees this
 * post".
 *
 * @param int     $post_id The post ID.
 * @param boolean $display If false, add "display: none" style to the element.
 * @param string  $type    One of 'post', 'term' or 'user'. Default 'post'.
 *
 * @return string The HTML code for the "How Relevanssi sees this post".
 */
function relevanssi_generate_how_relevanssi_sees($post_id, $display = \true, $type = 'post')
{
}
/**
 * Fetches the Relevanssi indexing data for a post.
 *
 * @param int    $post_id The post ID.
 * @param string $type    One of 'post', 'term', or 'user'. Default 'post'.
 *
 * @global array  $relevanssi_variables The Relevanssi global variables array,
 * used for the database table name.
 * @global object $wpdb                 The WordPress database interface.
 *
 * @return array The indexed terms for various parts of the post in an
 * associative array.
 */
function relevanssi_fetch_sees_data($post_id, $type = 'post')
{
}
/**
 * Generates a list of custom fields for a post.
 *
 * Starts from the custom field setting, expands "all" or "visible" if
 * necessary, makes sure "_relevanssi_pdf_content" is not removed, applies the
 * 'relevanssi_index_custom_fields' filter and 'relevanssi_add_repeater_fields'
 * function.
 *
 * @param int          $post_id       The post ID.
 * @param array|string $custom_fields An array of custom field names, or "all"
 * or "visible". If null, uses relevanssi_get_custom_fields().
 *
 * @return array An array of custom field names.
 */
function relevanssi_generate_list_of_custom_fields($post_id, $custom_fields = \null)
{
}
/**
 * Updates the relevanssi_synonyms setting from a simple string to an array
 * that is required for multilingual synonyms.
 */
function relevanssi_update_synonyms_setting()
{
}
/**
 * Replaces synonyms in an array with their original counterparts.
 *
 * If there's a synonym "dog=hound", and the array of terms contains "hound",
 * it will be replaced with "dog". If there are multiple matches, all
 * replacements will happen.
 *
 * @param array $terms An array of words.
 *
 * @return array An array of words with backwards synonym replacement.
 */
function relevanssi_replace_synonyms_in_terms(array $terms) : array
{
}
/**
 * Replaces stemmed words in an array with their original counterparts.
 *
 * @param array $terms     An array of words where to replace.
 * @param array $all_terms An array of all words to stem. Default $terms.
 *
 * @return array An array of words with stemmed words replaced with their
 * originals.
 */
function relevanssi_replace_stems_in_terms(array $terms, array $all_terms = \null) : array
{
}
/**
 * Returns an array of bot user agents for Relevanssi to block.
 *
 * The bot user agent is the value and a human-readable name (not used for
 * anything) is in the index. This same list is used for different contexts,
 * and there are separate filters for modifying the list in various contexts.
 *
 * @return array An array of name => user-agent pairs.
 */
function relevanssi_bot_block_list() : array
{
}
/**
 * Removes unwanted metadata fields from custom field indexing.
 *
 * This function hooks on to relevanssi_index_custom_fields and stops Relevanssi
 * from indexing a bunch of custom fields than only contain metadata that is
 * not useful to index.
 *
 * @param array $custom_fields A list of custom field names.
 *
 * @return @array The custom fields with the excluded fields removed.
 */
function relevanssi_remove_metadata_fields(array $custom_fields) : array
{
}
/**
 * Returns the list of custom fields included in the index.
 *
 * This list contains the names of all the custom fields that are assigned to
 * the posts in the Relevanssi index. This also includes ACF fields excluded
 * with filters and from ACF field settings.
 *
 * @see relevanssi_list_custom_fields()
 *
 * @return string A comma-separated list of custom field names.
 */
function relevanssi_list_all_indexed_custom_fields()
{
}
/**
 * Disables Relevanssi in the ACF Relationship field post search.
 *
 * We don't want to use Relevanssi on the ACF Relationship field post searches, so
 * this function disables it (on the 'relevanssi_search_ok' hook).
 *
 * @param boolean $search_ok Block the search or not.
 *
 * @return boolean False, if this is an ACF Relationship field search, pass the
 * parameter unchanged otherwise.
 */
function relevanssi_acf_relationship_fields($search_ok)
{
}
/**
 * Indexes the human-readable value of "choice" options list from ACF.
 *
 * @author Droz Raphaël
 *
 * @param array  $insert_data The insert data array.
 * @param int    $post_id     The post ID.
 * @param string $field_name  Name of the field.
 * @param string $field_value The field value.
 *
 * @return int Number of tokens indexed.
 */
function relevanssi_index_acf(&$insert_data, $post_id, $field_name, $field_value)
{
}
/**
 * Adds a Relevanssi exclude setting to ACF fields.
 *
 * @param array $field The field object array.
 */
function relevanssi_acf_exclude_setting($field)
{
}
/**
 * Excludes ACF fields based on the exclude setting.
 *
 * Hooks on to relevanssi_index_custom_fields.
 *
 * @param array $fields  The list of custom fields to index.
 * @param int   $post_id The post ID.
 *
 * @return array Filtered list of custom fields.
 */
function relevanssi_acf_exclude_fields($fields, $post_id)
{
}
/**
 * Checks if the field has an excluded parent field.
 *
 * If the field has a "parent" value set, this function gets the parent field
 * post based on the post ID in the "parent" value. This is done recursively
 * until we reach the top or find an excluded parent.
 *
 * @param array $field_object The field object.
 *
 * @return bool Returns true if the post has an excluded parent.
 */
function relevanssi_acf_is_parent_excluded($field_object)
{
}
/**
 * Gets the field ID from the field name.
 *
 * The field ID is stored in the postmeta table with the field name prefixed
 * with an underscore as the key.
 *
 * @param string $field_name The field name.
 * @param int    $post_id    The post ID.
 *
 * @return string The field ID.
 */
function relevanssi_acf_get_field_id($field_name, $post_id)
{
}
/**
 * Blocks indexing of posts marked "noindex" in the All-in-One SEO settings.
 *
 * Attaches to the 'relevanssi_do_not_index' filter hook.
 *
 * @param boolean $do_not_index True, if the post shouldn't be indexed.
 * @param integer $post_id      The post ID number.
 *
 * @return string|boolean If the post shouldn't be indexed, this returns
 * 'aioseo_seo'. The value may also be a boolean.
 */
function relevanssi_aioseo_noindex(bool $do_not_index, int $post_id)
{
}
/**
 * Excludes the "noindex" posts from Relevanssi indexing.
 *
 * Adds a MySQL query restriction that blocks posts that have the aioseo SEO
 * "noindex" setting set to "1" from indexing.
 *
 * @param array $restriction An array with two values: 'mysql' for the MySQL
 * query restriction to modify, 'reason' for the reason of restriction.
 */
function relevanssi_aioseo_exclude(array $restriction)
{
}
/**
 * Fetches the post IDs where robots_noindex is set to 1 in the aioseo_posts
 * table.
 *
 * @return array An array of post IDs.
 */
function relevanssi_aioseo_get_noindex_posts()
{
}
/**
 * Prints out the form fields for disabling the feature.
 */
function relevanssi_aioseo_form()
{
}
/**
 * Saves the SEO No index option.
 *
 * @param array $request An array of option values from the request.
 */
function relevanssi_aioseo_options(array $request)
{
}
/**
 * Enables Relevanssi in the query when the 's' query var is set.
 *
 * @param array $query_vars The query variables.
 *
 * @return array The query variables with the Relevanssi toggle enabled.
 */
function relevanssi_bricks_enable($query_vars)
{
}
/**
 * Adds the `_bricks_page_content_2` to the list of indexed custom fields.
 *
 * @param array|boolean $fields An array of custom fields to index, or false.
 *
 * @return array An array of custom fields, including `_bricks_page_content_2`.
 */
function relevanssi_add_bricks($fields)
{
}
/**
 * Includes only text from _bricks_page_content_2 custom field.
 *
 * This function goes through the multilevel array of _bricks_page_content_2
 * and only picks up the "text" elements inside it, discarding everything else.
 *
 * @param array  $value   An array of custom field values.
 * @param string $field   The name of the custom field.
 *
 * @return array An array containing a string with all the values concatenated
 * together.
 */
function relevanssi_bricks_values($value, $field)
{
}
/**
 * Makes sure the Bricks builder shortcode is included in the index, even when
 * the custom field setting is set to 'none'.
 *
 * @param string $value The custom field indexing setting value. The parameter
 * is ignored, Relevanssi disables this filter and then checks the option to
 * see what the value is.
 *
 * @return string If value is undefined, it's set to '_bricks_page_content_2'.
 */
function relevanssi_bricks_fix_none_setting($value)
{
}
/**
 * Blocks Relevanssi from interfering with the Elementor Library searches.
 *
 * @param bool     $ok    Should Relevanssi be allowed to process the query.
 * @param WP_Query $query The WP_Query object.
 *
 * @return bool Returns false, if this is an Elementor library search.
 */
function relevanssi_block_elementor_library(bool $ok, \WP_Query $query) : bool
{
}
/**
 * Adds the 'relevanssi' parameter to the Fibo Search.
 *
 * Uses the dgwt/wcas/search_query_args filter hook to modify the search query.
 *
 * @param array $args The search arguments.
 *
 * @return array
 */
function relevanssi_enable_relevanssi_in_fibo($args)
{
}
/**
 * Checks whether the user is allowed to see the post.
 *
 * Only applies to published posts.
 *
 * @param boolean $post_ok Can the post be shown to the user.
 * @param int     $post_id The post ID.
 *
 * @return boolean $post_ok True if the user is allowed to see the post,
 * otherwise false.
 */
function relevanssi_groups_compatibility($post_ok, $post_id)
{
}
/**
 * Registers rest_after_insert_{post_type} actions for all indexed post types.
 *
 * Runs on `admin_init` action hook and registers the function
 * `relevanssi_save_gutenberg_postdata` for all indexed post types.
 *
 * @see relevanssi_save_gutenberg_postdata
 */
function relevanssi_register_gutenberg_actions()
{
}
/**
 * Renders Gutenberg blocks.
 *
 * Renders all sorts of Gutenberg blocks, including reusable blocks and ACF
 * blocks. Also enables basic Gutenberg deindexing: you can add an extra CSS
 * class 'relevanssi_noindex' to a block to stop it from being indexed by
 * Relevanssi. This function is essentially the same as core do_blocks().
 *
 * @see do_blocks()
 *
 * @param string $content     The post content.
 * @param object $post_object The post object.
 *
 * @return string The post content with the rendered content added.
 */
function relevanssi_gutenberg_block_rendering($content, $post_object)
{
}
/**
 * Runs recursively through inner blocks to filter them.
 *
 * Runs relevanssi_block_to_render and the relevanssi_noindex CSS class check
 * on all inner blocks. If inner blocks are filtered out, they will be removed
 * with empty blocks of the type "core/fake". Removing the inner blocks causes
 * problems; that's why they are replaced. The blocks are rendered here;
 * everything will be rendered once at the top level.
 *
 * @param array $block A Gutenberg block.
 *
 * @return array The filtered block.
 */
function relevanssi_process_inner_blocks($block)
{
}
/**
 * Makes JetSmartFilters use posts from Relevanssi.
 *
 * @param WP_Query $wp_query The wp_query object.
 */
function relevanssi_jetsmartfilters($wp_query)
{
}
/**
 * Checks whether the user is allowed to see the post.
 *
 * @param boolean $post_ok Can the post be shown to the user.
 * @param int     $post_id The post ID.
 *
 * @return boolean $post_ok True if the user is allowed to see the post,
 * otherwise false.
 */
function relevanssi_memberpress_compatibility($post_ok, $post_id)
{
}
/**
 * Checks whether the user is allowed to see the post.
 *
 * Only applies to private posts and only if the "content permissions" feature
 * is enabled.
 *
 * @param boolean $post_ok Can the post be shown to the user.
 * @param int     $post_id The post ID.
 *
 * @return boolean $post_ok True if the user is allowed to see the post,
 * otherwise false.
 */
function relevanssi_members_compatibility($post_ok, $post_id)
{
}
/**
 * Indexes Ninja Tables table contents.
 *
 * Uses regular expression matching to find all the Ninja Tables shortcodes in
 * the post content and then uses relevanssi_index_ninja_table() to convert the
 * tables into strings.
 *
 * @uses $wpdb WordPress database abstraction.
 * @see relevanssi_index_ninja_table()
 *
 * @param string $content The post content.
 *
 * @return string Post content with the Ninja Tables data.
 */
function relevanssi_index_ninja_tables($content)
{
}
/**
 * Creates a string containing a Ninja Table table contents.
 *
 * The string contains the caption and the values from each row. The table
 * title and description are also included, if they are set visible on the
 * frontend.
 *
 * @uses $wpdb WordPress database abstraction.
 *
 * @param int $table_id The table ID.
 *
 * @return string The table content as a string.
 */
function relevanssi_index_ninja_table($table_id)
{
}
/**
 * Cleans up the Oxygen Builder custom field for Relevanssi consumption.
 *
 * Splits up the big custom field content from ct_builder_shortcodes into
 * sections ([ct_section] tags). Each section can be processed with filters
 * defined with `relevanssi_oxygen_section_filters`, for example to remove
 * sections based on their "nicename" or "ct_category" values. After that the
 * section is passed through the `relevanssi_oxygen_section_content` filter.
 * Finally all shortcode tags are removed, leaving just the content.
 *
 * @param array  $value   An array of custom field values.
 * @param string $field   The name of the custom field. This function only looks
 * at `ct_builder_shortcodes` fields.
 * @param int    $post_id The post ID.
 *
 * @return array|null An array of custom field values, null if no value exists.
 */
function relevanssi_oxygen_compatibility($value, $field, $post_id)
{
}
/**
 * Recursively processes the Oxygen JSON data.
 *
 * This function extracts all the ct_content data from the JSON. All elements
 * are run through the relevanssi_oxygen_element filter hook. You can use that
 * filter hook to modify or to eliminate elements from the JSON.
 *
 * @param array $child The child element array.
 *
 * @return string The content from the child and the grandchildren.
 */
function relevanssi_process_oxygen_child($child) : string
{
}
/**
 * Adds the Oxygen custom field to the list of indexed custom fields.
 *
 * @param array|boolean $fields An array of custom fields to index, or false.
 *
 * @return array An array of custom fields, including `ct_builder_json` or
 * `ct_builder_shortcodes`.
 */
function relevanssi_add_oxygen($fields)
{
}
/**
 * Makes sure the Oxygen builder shortcode is included in the index, even when
 * the custom field setting is set to 'none'.
 *
 * @param string $value The custom field indexing setting value. The parameter
 * is ignored, Relevanssi disables this filter and then checks the option to
 * see what the value is.
 *
 * @return string If value is undefined, it's set to 'ct_builder_json' or
 * 'ct_builder_shortcodes'.
 */
function relevanssi_oxygen_fix_none_setting($value)
{
}
/**
 * Indexes the Base64 encoded PHP & HTML code block contents.
 *
 * @param string $content The section content from the
 * relevanssi_oxygen_section_content filter hook.
 *
 * @return string $content The content with the decoded code block content
 * added to the end.
 */
function relevanssi_oxygen_code_block($content)
{
}
/**
 * Removes the Oxygen rich text shortcode.
 *
 * @param string $content The content of the Oxygen section.
 *
 * @return string The content with the oxy_rich_text shortcodes removed.
 */
function relevanssi_oxygen_rich_text($content)
{
}
/**
 * Checks whether the user is allowed to see the post.
 *
 * @param boolean $post_ok Can the post be shown to the user.
 * @param int     $post_id The post ID.
 *
 * @return boolean $post_ok True if the user is allowed to see the post,
 * otherwise false.
 */
function relevanssi_paidmembershippro_compatibility($post_ok, $post_id)
{
}
/**
 * Removes the Polylang language filters.
 *
 * If the Polylang allow all option ('relevanssi_polylang_all_languages') is
 * enabled this removes the Polylang language filter. By default Polylang
 * filters the languages using a taxonomy query.
 *
 * @param object $query WP_Query object we need to clean up.
 */
function relevanssi_polylang_filter($query)
{
}
/**
 * Allows taxonomy terms in language-restricted searches.
 *
 * This is a bit of a hack, where the language taxonomy WHERE clause is modified
 * on the go to allow all posts with the post ID -1 (which means taxonomy terms
 * and users). This may break suddenly in updates, but I haven't come up with a
 * better way so far.
 *
 * @param string $where The WHERE clause to modify.
 *
 * @return string The WHERE clause with additional filtering included.
 *
 * @since 2.1.6
 */
function relevanssi_polylang_where_include_terms($where)
{
}
/**
 * Filters out taxonomy terms in the wrong language.
 *
 * If all languages are not allowed, this filter goes through the results and
 * removes the taxonomy terms in the wrong language. This can't be done in the
 * original query because the term language information is slightly hard to
 * find.
 *
 * @param array $hits The found posts are in $hits[0].
 *
 * @return array The $hits array with the unwanted posts removed.
 *
 * @since 2.1.6
 */
function relevanssi_polylang_term_filter($hits)
{
}
/**
 * Returns the term_taxonomy_id matching the Polylang language based on locale.
 *
 * @param string $locale The locale string for the language.
 *
 * @return int The term_taxonomy_id for the language; 0 if nothing is found.
 */
function relevanssi_get_language_term_taxonomy_id($locale)
{
}
/**
 * Returns false if the query post type is set to 'pretty-link'.
 *
 * @param boolean  $ok    Whether to allow the query.
 * @param WP_Query $query The WP_Query object.
 *
 * @return boolean False if this is a Pretty Links query.
 */
function relevanssi_pretty_links_ok($ok, $query)
{
}
/**
 * Disables the 'wpm_pgw_search_by_code' option.
 *
 * If this option is enabled, it will break Relevanssi search when there's a
 * match for the code.
 *
 * @return string 'no'.
 */
function relevanssi_disable_gtin_code()
{
}
/**
 * Adds the `_wpm_gtin_code` to the list of indexed custom fields.
 *
 * @param array|boolean $fields An array of custom fields to index, or false.
 *
 * @return array An array of custom fields, including `_wpm_gtin_code`.
 */
function relevanssi_add_wpm_gtin_code($fields)
{
}
/**
 * Makes sure the GTIN code is included in the index, even when the custom field
 * setting is set to 'none'.
 *
 * @param string $value The custom field indexing setting value. The parameter
 * is ignored, Relevanssi disables this filter and then checks the option to
 * see what the value is.
 *
 * @return string If value is undefined, it's set to '_wpm_gtin_code'.
 */
function relevanssi_wpm_pgw_fix_none_setting($value)
{
}
/**
 * Blocks indexing of posts marked "noindex" in the Rank Math settings.
 *
 * Attaches to the 'relevanssi_do_not_index' filter hook.
 *
 * @param boolean $do_not_index True, if the post shouldn't be indexed.
 * @param integer $post_id      The post ID number.
 *
 * @return string|boolean If the post shouldn't be indexed, this returns
 * 'RankMath'. The value may also be a boolean.
 */
function relevanssi_rankmath_noindex($do_not_index, $post_id)
{
}
/**
 * Excludes the "noindex" posts from Relevanssi indexing.
 *
 * Adds a MySQL query restriction that blocks posts that have the Rank Math
 * "rank_math_robots" setting set to something that includes "noindex".
 *
 * @param array $restriction An array with two values: 'mysql' for the MySQL
 * query restriction to modify, 'reason' for the reason of restriction.
 */
function relevanssi_rankmath_exclude($restriction)
{
}
/**
 * Prints out the form fields for disabling the feature.
 */
function relevanssi_rankmath_form()
{
}
/**
 * Saves the SEO No index option.
 *
 * @param array $request An array of option values from the request.
 */
function relevanssi_rankmath_options(array $request)
{
}
/**
 * Checks whether the user is allowed to see the post.
 *
 * @param boolean $post_ok Can the post be shown to the user.
 * @param int     $post_id The post ID.
 *
 * @return boolean $post_ok True if the user is allowed to see the post,
 * otherwise false.
 */
function relevanssi_restrictcontentpro_compatibility($post_ok, $post_id)
{
}
/**
 * Blocks indexing of posts marked "Exclude this page from all search queries
 * on this site." in the SEO Framework settings.
 *
 * Attaches to the 'relevanssi_do_not_index' filter hook.
 *
 * @param boolean $do_not_index True, if the post shouldn't be indexed.
 * @param integer $post_id      The post ID number.
 *
 * @return string|boolean If the post shouldn't be indexed, this returns
 * 'SEO Framework'. The value may also be a boolean.
 */
function relevanssi_seoframework_noindex($do_not_index, $post_id)
{
}
/**
 * Excludes the "noindex" posts from Relevanssi indexing.
 *
 * Adds a MySQL query restriction that blocks posts that have the SEO Framework
 * "Exclude this page from all search queries on this site" setting set to "1"
 * from indexing.
 *
 * @param array $restriction An array with two values: 'mysql' for the MySQL
 * query restriction to modify, 'reason' for the reason of restriction.
 */
function relevanssi_seoframework_exclude($restriction)
{
}
/**
 * Prints out the form fields for disabling the feature.
 */
function relevanssi_seoframework_form()
{
}
/**
 * Saves the SEO No index option.
 *
 * @param array $request An array of option values from the request.
 */
function relevanssi_seoframework_options(array $request)
{
}
/**
 * Blocks indexing of posts marked "noindex" in the SEOPress settings.
 *
 * Attaches to the 'relevanssi_do_not_index' filter hook.
 *
 * @param boolean $do_not_index True, if the post shouldn't be indexed.
 * @param integer $post_id      The post ID number.
 *
 * @return string|boolean If the post shouldn't be indexed, this returns
 * 'seopress'. The value may also be a boolean.
 */
function relevanssi_seopress_noindex($do_not_index, $post_id)
{
}
/**
 * Excludes the "noindex" posts from Relevanssi indexing.
 *
 * Adds a MySQL query restriction that blocks posts that have the SEOPress
 * "noindex" setting set to "1" from indexing.
 *
 * @param array $restriction An array with two values: 'mysql' for the MySQL
 * query restriction to modify, 'reason' for the reason of restriction.
 */
function relevanssi_seopress_exclude($restriction)
{
}
/**
 * Prints out the form fields for disabling the feature.
 */
function relevanssi_seopress_form()
{
}
/**
 * Saves the SEO No index option.
 *
 * @param array $request An array of option values from the request.
 */
function relevanssi_seopress_options(array $request)
{
}
/**
 * Checks whether the user is allowed to see the post.
 *
 * @param boolean $post_ok Can the post be shown to the user.
 * @param int     $post_id The post ID.
 *
 * @return boolean $post_ok True if the user is allowed to see the post,
 * otherwise false.
 */
function relevanssi_simplemembership_compatibility($post_ok, $post_id)
{
}
/**
 * Replaces the [table_filter] shortcodes with [table].
 *
 * The shortcode filter extension adds a [table_filter] shortcode which is not
 * compatible with Relevanssi. This function switches those to the normal
 * [table] shortcode which works better.
 *
 * @param string $content The post content.
 *
 * @return string The fixed post content.
 */
function relevanssi_table_filter($content)
{
}
/**
 * Checks whether the user is allowed to see the post.
 *
 * @param boolean $post_ok Can the post be shown to the user.
 * @param int     $post_id The post ID.
 *
 * @return boolean $post_ok True if the user is allowed to see the post,
 * otherwise false.
 */
function relevanssi_useraccessmanager_compatibility($post_ok, $post_id)
{
}
/**
 * Resets the WC post loop in search queries.
 *
 * Hooks on to woocommerce_before_shop_loop.
 */
function relevanssi_wc_reset_loop()
{
}
/**
 * Applies the WooCommerce product visibility filter.
 *
 * @param array $restriction An array with two values: 'mysql' for the MySQL
 * query restriction to modify, 'reason' for the reason of restriction.
 */
function relevanssi_woocommerce_restriction($restriction)
{
}
/**
 * WooCommerce product visibility filtering for indexing.
 *
 * This filter is applied before the posts are selected for indexing, so this will
 * skip all the excluded posts right away.
 *
 * @since 4.0.9 (2.1.5)
 * @global $wpdb The WordPress database interface.
 *
 * @return string $restriction The query restriction for the WooCommerce filtering.
 */
function relevanssi_woocommerce_indexing_filter()
{
}
/**
 * SKU weight boost.
 *
 * Increases the weight for matches in the _sku custom field. The amount of
 * boost can be adjusted with the `relevanssi_sku_boost` filter hook. The
 * default is 2.
 *
 * @param object $match_object The match object.
 *
 * @return object The match object.
 */
function relevanssi_sku_boost($match_object)
{
}
/**
 * Adds blocked WooCommerce post types to the list of blocked post types.
 *
 *  Stops Relevanssi from taking over the admin search for the WooCommerce
 * blocked post types using the relevanssi_admin_search_blocked_post_types
 * filter hook.
 *
 * @param array $post_types The list of blocked post types.
 * @return array
 */
function relevanssi_woocommerce_admin_search_blocked_post_types(array $post_types) : array
{
}
/**
 * Relevanssi support for WooCommerce filtering.
 *
 * @param WP_Query $query The WP_Query object.
 * @return WP_Query The WP_Query object.
 */
function relevanssi_woocommerce_filters($query)
{
}
/**
 * Provides layered navigation term counts based on Relevanssi searches.
 *
 * Hooks onto woocommerce_get_filtered_term_product_counts_query to provide
 * accurate term counts.
 *
 * @param array $query The MySQL query parts.
 *
 * @return array The modified query.
 */
function relevanssi_filtered_term_product_counts_query($query)
{
}
/**
 * Checks the parent product status for product variations.
 *
 * @param bool $ok      Whether the post is OK to return in search.
 * @param int  $post_id The post ID.
 *
 * @return bool
 */
function relevanssi_variation_post_ok($ok, $post_id) : bool
{
}
/**
 * Adds the WPFD indexed content to wpfd_file posts.
 *
 * Fetches the words from wpfd_words. wpfd_index.tid is the post ID, wpfd_index.id is
 * then used to get the wpfd_docs.id, that is used to get the wpfd_vectors.did which
 * can then be used to fetch the correct words from wpfd_words. This function is
 * hooked onto relevanssi_content_to_index filter hook.
 *
 * @param string $content The post content as a string.
 * @param object $post    The post object.
 *
 * @return string The post content with the words added to the end.
 */
function relevanssi_wpfd_content($content, $post)
{
}
/**
 * Runs Relevanssi indexing after WPFD indexing is done.
 *
 * @param int $wpfd_id The WPFD post index.
 */
function relevanssi_wpfd_index($wpfd_id)
{
}
/**
 * Checks whether the post type is blocked.
 *
 * Allows all logged-in users to see posts. For non-logged-in users, checks if
 * the post is blocked by the _wpmem_block custom field, or if the post type is
 * blocked in the $wpmem global.
 *
 * @param bool       $post_ok Whether the user is allowed to see the post.
 * @param int|string $post_id The post ID.
 *
 * @return bool
 */
function relevanssi_wpmembers_compatibility(bool $post_ok, $post_id) : bool
{
}
/**
 * Adds Relevanssi results to WP Search Suggest dropdown.
 *
 * @param array  $title_list  List of post titles.
 * @param object $query The WP_Query object.
 *
 * @return array List of post titles.
 */
function relevanssi_wpss_support($title_list, $query)
{
}
/**
 * Checks whether the user is allowed to see the post.
 *
 * @param boolean $post_ok Can the post be shown to the user.
 * @param int     $post_id The post ID.
 *
 * @return boolean $post_ok True if the user is allowed to see the post,
 * otherwise false.
 */
function relevanssi_wpjvpostreadinggroups_compatibility($post_ok, $post_id)
{
}
/**
 * Filters posts based on WPML language.
 *
 * Attaches to 'relevanssi_hits_filter' to restrict WPML searches to the current
 * language. Whether this filter is used or not depends on the option
 * 'relevanssi_wpml_only_current'. Thanks to rvencu for the initial code.
 *
 * @global object $sitepress The WPML global object.
 *
 * @param array $data Index 0 has the array of results, index 1 has the search query.
 *
 * @return array $data The whole parameter array, with the filtered posts in the index 0.
 */
function relevanssi_wpml_filter($data)
{
}
/**
 * Fixes translated term indexing for WPML.
 *
 * WPML indexed translated terms based on current admin language, not the post
 * language. This filter changes the term indexing to match the post language.
 *
 * @param string $term_content All terms in the taxonomy as a string.
 * @param array  $terms        All the term objects in the current taxonomy.
 * @param string $taxonomy     The taxonomy name.
 * @param int    $post_id      The post ID.
 *
 * @return string The term names as a string.
 */
function relevanssi_wpml_term_fix(string $term_content, array $terms, string $taxonomy, int $post_id)
{
}
/**
 * Disables WPML term filtering.
 *
 * This function disables the WPML term filtering, so that Relevanssi can index
 * the terms in the correct language.
 */
function relevanssi_disable_wpml_terms()
{
}
/**
 * Enables WPML term filtering.
 *
 * This function enables the WPML term filtering.
 */
function relevanssi_enable_wpml_terms()
{
}
/**
 * Blocks indexing of posts marked "noindex" in the Yoast SEO settings.
 *
 * Attaches to the 'relevanssi_do_not_index' filter hook.
 *
 * @param boolean $do_not_index True, if the post shouldn't be indexed.
 * @param integer $post_id      The post ID number.
 *
 * @return string|boolean If the post shouldn't be indexed, this returns
 * 'yoast_seo'. The value may also be a boolean.
 */
function relevanssi_yoast_noindex($do_not_index, $post_id)
{
}
/**
 * Excludes the "noindex" posts from Relevanssi indexing.
 *
 * Adds a MySQL query restriction that blocks posts that have the Yoast SEO
 * "noindex" setting set to "1" from indexing.
 *
 * @param array $restriction An array with two values: 'mysql' for the MySQL
 * query restriction to modify, 'reason' for the reason of restriction.
 */
function relevanssi_yoast_exclude($restriction)
{
}
/**
 * Prints out the form fields for disabling the feature.
 */
function relevanssi_yoast_form()
{
}
/**
 * Saves the SEO No index option.
 *
 * @param array $request An array of option values from the request.
 */
function relevanssi_yoast_options(array $request)
{
}
/**
 * /lib/contextual-help.php
 *
 * Adds the contextual help menus.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Displays the contextual help menu.
 *
 * @global object $wpdb The WP database interface.
 */
function relevanssi_admin_help()
{
}
/**
 * Checks if Relevanssi debug mode is enabled.
 *
 * Debug mode is enabled by setting RELEVANSSI_DEBUG to true or with the
 * 'relevanssi_debug' query parameter if the debug mode is allowed from the
 * settings.
 *
 * @return boolean True if debug mode is enabled, false if not.
 */
function relevanssi_is_debug() : bool
{
}
/**
 * Adds the debug information to the search results.
 *
 * Displays the found posts.
 *
 * @param array $posts The search results.
 */
function relevanssi_debug_posts($posts)
{
}
/**
 * Prints out an array in a preformatted block.
 *
 * @param array  $array_value The array to print.
 * @param string $title       The title for the array.
 */
function relevanssi_debug_array($array_value, $title)
{
}
/**
 * Prints out a string in a preformatted block.
 *
 * @param string $str   The string to print.
 * @param string $title The title for the string.
 */
function relevanssi_debug_string($str, $title)
{
}
/**
 * Prints out the Relevanssi debug information for a post.
 *
 * This function is called by the 'wp' action, so it's executed on every page
 * load.
 */
function relevanssi_debug_post()
{
}
/**
 * Generates the debugging view for a post.
 *
 * @param int $post_id ID of the post.
 *
 * @return string The debugging view in a div container.
 */
function relevanssi_generate_db_post_view(int $post_id)
{
}
/**
 * Prints out the Relevanssi debug information for search settings.
 */
function relevanssi_debug_search_settings()
{
}
/**
 * Returns true if RELEVANSSI_DEBUG, WP_DEBUG and WP_DEBUG_DISPLAY are true.
 *
 * @return bool True if debug mode is on.
 */
function relevanssi_log_debug() : bool
{
}
/**
 * /lib/didyoumean.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Generates the Did you mean suggestions.
 *
 * A wrapper function that prints out the Did you mean suggestions. If Premium
 * is available, will use relevanssi_premium_didyoumean(), otherwise the
 * relevanssi_simple_didyoumean() is used.
 *
 * @param string  $query   The query.
 * @param string  $pre     Printed out before the suggestion.
 * @param string  $post    Printed out after the suggestion.
 * @param int     $n       Maximum number of search results found for the
 * suggestions to show up. Default 5.
 * @param boolean $echoed  If true, echo out. Default true.
 *
 * @return string|null The suggestion HTML element.
 */
function relevanssi_didyoumean($query, $pre, $post, $n = 5, $echoed = \true)
{
}
/**
 * Generates the Did you mean suggestions HTML code.
 *
 * Uses relevanssi_simple_generate_suggestion() to come up with a suggestion,
 * then wraps that up with HTML code.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The Relevanssi global variables.
 * @global object $wp_query             The WP_Query object.
 *
 * @param string $query The query.
 * @param string $pre   Printed out before the suggestion.
 * @param string $post  Printed out after the suggestion.
 * @param int    $n     Maximum number of search results found for the
 * suggestions to show up. Default 5.
 *
 * @return string|null The suggestion HTML code, null if nothing found.
 */
function relevanssi_simple_didyoumean($query, $pre, $post, $n = 5)
{
}
/**
 * Generates the 'Did you mean' suggestions. Can be used to correct any queries.
 *
 * Uses the Relevanssi search logs as source material for corrections. If there
 * are no logged search queries, can't do anything.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The Relevanssi global variables, used
 * for table names.
 *
 * @param string $query The query to correct.
 *
 * @return string Corrected query, empty if nothing found.
 */
function relevanssi_simple_generate_suggestion($query)
{
}
/**
 * /lib/excerpts-highlights.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Generates an excerpt for a post.
 *
 * Takes the excerpt length and type as parameters. These can be omitted, in
 * which case the values are taken from the 'relevanssi_excerpt_length' and
 * 'relevanssi_excerpt_type' options respectively.
 *
 * @global $post The global post object.
 *
 * @param object $t_post         The post object.
 * @param string $query          The search query.
 * @param int    $excerpt_length The length of the excerpt, default null.
 * @param string $excerpt_type   Either 'chars' or 'words', default null.
 *
 * @return string The created excerpt.
 */
function relevanssi_do_excerpt($t_post, $query, $excerpt_length = \null, $excerpt_type = \null)
{
}
/**
 * Creates an excerpt from content.
 *
 * This is provided for backwards compatibility. The new version of the function
 * supports the Premium capability to return multiple excerpts. Since that
 * changes the return value of the function, this function is provided to
 * return the original return value.
 *
 * @uses relevanssi_create_excerpts()
 *
 * @param string $content        The content.
 * @param array  $terms          The search terms, tokenized.
 * @param string $query          The search query.
 * @param int    $excerpt_length The length of the excerpt, default 30.
 * @param string $excerpt_type   Either 'chars' or 'words', default 'words'.
 *
 * @return array Element 0 is the excerpt, element 1 the number of term hits,
 * element 2 is true, if the excerpt is from the start of the content.
 */
function relevanssi_create_excerpt($content, $terms, $query, $excerpt_length = 30, $excerpt_type = 'words')
{
}
/**
 * Creates an excerpt from content.
 *
 * Relevanssi Premium has the capability to generate multiple excerpts from one
 * post. While the free version only generates one excerpt per post, this
 * function supports the multiple excerpt behaviour by returning an array of
 * excerpts, even though just one excerpt is returned.
 *
 * @see relevanssi_create_excerpt()
 *
 * @param string $content        The content.
 * @param array  $terms          The search terms, tokenized.
 * @param string $query          The search query.
 * @param int    $excerpt_length The length of the excerpt, default 30.
 * @param string $excerpt_type   Either 'chars' or 'words', default 'words'.
 *
 * @return array An array of excerpts. In each excerpt, there are following
 * parts: 'text' has the excerpt text, 'hits' the number of keyword matches in
 * the excerpt, 'start' is true if the excerpt is from the beginning of the
 * content.
 */
function relevanssi_create_excerpts($content, $terms, $query, $excerpt_length = 30, $excerpt_type = 'words')
{
}
/**
 * Manages the highlighting in documents.
 *
 * Uses relevanssi_highlight_terms() to do the highlighting. Attached to
 * 'the_content' and 'comment_text' filter hooks.
 *
 * @global object  $wp_query               The global WP_Query object.
 * @global boolean $relevanssi_test_enable If true, this is a test.
 *
 * @param string $content The content to highlight.
 *
 * @return string The content with highlights.
 */
function relevanssi_highlight_in_docs($content)
{
}
/**
 * Adds highlighting to content.
 *
 * Adds highlighting to content based on Relevanssi highlighting settings (if
 * you want to override the settings, 'pre_option_relevanssi_highlight' filter
 * hook is your friend).
 *
 * @param string       $content          The content to highlight.
 * @param string|array $query            The search query (should be a string,
 * can also be an array of string).
 * @param boolean      $convert_entities Are we highlighting post content?
 * Default false.
 *
 * @return string The $content with highlighting.
 */
function relevanssi_highlight_terms($content, $query, $convert_entities = \false)
{
}
/**
 * Fixes problems with entities.
 *
 * For excerpts, runs htmlentities() on the excerpt, then converts the allowed
 * tags back into tags.
 *
 * @param string  $excerpt The excerpt to fix.
 * @param boolean $in_docs If true, we are manipulating post content, and need
 * to work in a different fashion.
 *
 * @return string The $excerpt with entities fixed.
 */
function relevanssi_fix_entities($excerpt, $in_docs)
{
}
/**
 * Runs htmlentities() for content inside specified tags.
 *
 * @param string $content The content.
 * @param string $tag     The tag.
 *
 * @return string $content The content with HTML code inside the $tag tags
 * ran through htmlentities().
 */
function relevanssi_entities_inside($content, $tag)
{
}
/**
 * Removes nested highlights from a string.
 *
 * If there are highlights within highlights in a string, this function will
 * clean out the nested highlights, leaving just the outmost highlight tokens.
 *
 * @param string $str    The content.
 * @param string $begin  The beginning highlight token.
 * @param string $end    The ending highlight token.
 *
 * @return string The string with nested highlights cleaned out.
 */
function relevanssi_remove_nested_highlights($str, $begin, $end)
{
}
/**
 * Finds the locations of each word.
 *
 * Originally lifted from http://www.boyter.org/2013/04/building-a-search-result-extract-generator-in-php/
 * Finds the location of each word in the fulltext.
 *
 * @author Ben Boyter
 *
 * @param array  $words    An array of words to locate.
 * @param string $fulltext The fulltext where to find them.
 *
 * @return array Array of locations.
 */
function relevanssi_extract_locations($words, $fulltext)
{
}
/**
 * Counts how many times the words appear in the text.
 *
 * @param array  $words         An array of words.
 * @param string $complete_text The text where to count the words.
 *
 * @return int Number of times the words appear in the text.
 */
function relevanssi_count_matches($words, $complete_text)
{
}
/**
 * Works out which is the most relevant portion to display.
 *
 * This is done by looping over each match and finding the smallest distance
 * between two found strings. The idea being that the closer the terms are the
 * better match the snippet would be. When checking for matches we only change
 * the location if there is a better match. The only exception is where we have
 * only two matches in which case we just take the first as will be equally
 * distant.
 *
 * @author Ben Boyter
 *
 * @param array $locations Locations of the words.
 * @param int   $prevcount How much text to include before the location.
 *
 * @return int Starting position for the snippet.
 */
function relevanssi_determine_snip_location($locations, $prevcount)
{
}
/**
 * Extracts relevant part of the full text.
 *
 * Finds the part of full text with as many relevant words as possible. 1/6
 * ratio on prevcount tends to work pretty well and puts the terms in the middle
 * of the excerpt.
 *
 * Source: https://boyter.org/2013/04/building-a-search-result-extract-generator-in-php/
 *
 * @author Ben Boyter
 *
 * @param array  $words          An array of relevant words.
 * @param string $fulltext       The source text.
 * @param int    $excerpt_length The length of the excerpt, default 300
 * characters.
 * @param int    $prevcount      How much text include before the words, default
 * 50 characters.
 *
 * @return array The excerpt, number of words in the excerpt, true if it's the
 * start of the $fulltext.
 */
function relevanssi_extract_relevant($words, $fulltext, $excerpt_length = 300, $prevcount = 50)
{
}
/**
 * Extracts relevant words of the full text.
 *
 * Finds the part of full text with as many relevant words as possible. If the
 * excerpt length parameter is less than 1, the function will immediately
 * return an empty excerpt in order to avoid an endless loop.
 *
 * @param array  $terms          An array of relevant words.
 * @param string $content        The source text.
 * @param int    $excerpt_length The length of the excerpt, default 30 words.
 *
 * @return array The excerpt, number of words in the excerpt, true if it's the
 * start of the $fulltext.
 */
function relevanssi_extract_relevant_words($terms, $content, $excerpt_length = 30)
{
}
/**
 * Finds the first match in the content.
 *
 * Looks for search terms in the post content and stops immediately when the
 * first match is found. Then an excerpt is returned where the match is in the
 * middle of the excerpt.
 *
 * @param array $words          An array of words to look in.
 * @param array $terms          An array of search terms to look for.
 * @param int   $excerpt_length The length of the excerpt.
 *
 * @return array The found excerpt in 'excerpt', a boolean in 'start' that's
 * true if the excerpt was from the start of the content and the number of
 * matches found in the excerpt in 'best_excerpt_term_hits'.
 */
function relevanssi_get_first_match(array $words, array $terms, int $excerpt_length)
{
}
/**
 * Adds accented variations to letters.
 *
 * In order to have non-accented letters in search terms match the accented terms in
 * full text, this function adds accent variations to the search terms.
 *
 * @param string $word The word to manipulate.
 *
 * @return string The word with accent variations.
 */
function relevanssi_add_accent_variations($word)
{
}
/**
 * Fetches the custom field content for a post.
 *
 * @param int $post_id The post ID.
 *
 * @return array The custom field content in an array. The array either has the
 * the field names as keys (if relevanssi_excerpt_specific_fields is on) or has
 * everything in one string in index 0 (if relevanssi_excerpt_specific_fields is
 * off).
 */
function relevanssi_get_custom_field_content($post_id) : array
{
}
/**
 * Kills the autoembed filter hook on 'the_content'.
 *
 * @global array $wp_filter The global filter array.
 *
 * It's an object hook, so this isn't as simple as doing remove_filter(). This
 * needs to be done, because autoembed discovery can take a very, very long
 * time.
 */
function relevanssi_kill_autoembed()
{
}
/**
 * Adjusts things before `the_content` is applied in excerpt-building.
 *
 * Removes the `prepend_attachment` filter hook and enables the `noindex`
 * shortcode.
 */
function relevanssi_excerpt_pre_the_content()
{
}
/**
 * Adjusts things after `the_content` is applied in excerpt-building.
 *
 * Reapplies the `prepend_attachment` filter hook and disables the `noindex`
 * shortcode.
 */
function relevanssi_excerpt_post_the_content()
{
}
/**
 * Adds a highlighted title in the post object in $post->post_highlighted_title.
 *
 * @param WP_Post $post  The post object (passed as reference).
 * @param string  $query The search query.
 *
 * @uses relevanssi_highlight_terms
 */
function relevanssi_highlight_post_title(&$post, $query)
{
}
/**
 * Replaces $post->post_excerpt with the Relevanssi-generated excerpt and puts
 * the original excerpt in $post->original_excerpt.
 *
 * @param WP_Post $post           The post object (passed as reference).
 * @param string  $query          The search query.
 *
 * @uses relevanssi_do_excerpt
 */
function relevanssi_add_excerpt(&$post, $query)
{
}
/**
 * Runs html_entity_decode(), then restores entities inside data attributes.
 *
 * First replace all &quot; entities inside data attributes with REL_QUOTE,
 * then decode, then replace REL_QUOTE with &quot; to restore the data
 * attributes.
 *
 * @uses html_entity_decode
 *
 * @param string $content The content to decode.
 * @param int    $flags   The flags for html_entity_decode, default ENT_QUOTES.
 * @param string $charset The charset for html_entity_decode, default 'UTF-8'.
 *
 * @return string The decoded content.
 */
function relevanssi_entity_decode($content, $flags = \ENT_QUOTES, $charset = 'UTF-8')
{
}
/**
 * Blocks image attachments from the index.
 *
 * @param array $restriction An array with two values: 'mysql' for the MySQL
 * query and 'reason' for the blocking reason.
 *
 * @return array The image attachment blocking MySQL code, if the image
 * attachments are blocked.
 */
function relevanssi_image_filter($restriction)
{
}
/**
 * Returns the total number of posts to index.
 *
 * Counts the total number of posts to index, considering post type restrictions and
 * the valid statuses.
 *
 * @return int The number of posts to index.
 */
function relevanssi_count_total_posts()
{
}
/**
 * Returns the number of posts missing from the index.
 *
 * Counts the total number of posts to index, considering post type restrictions and
 * the valid statuses, and only looks at posts missing from the index.
 *
 * @return int The number of posts to index.
 */
function relevanssi_count_missing_posts()
{
}
/**
 * Counts the total number of posts.
 *
 * Counts the total number of posts to index, considering post type restrictions and
 * the valid statuses.
 *
 * @global object $wpdb The WordPress database interface.
 *
 * @param boolean $extend If true, count only missing posts. If false, count all
 * posts. Default false.
 *
 * @return int The number of posts to index.
 */
function relevanssi_indexing_post_counter($extend = \false)
{
}
/**
 * Generates the indexing query.
 *
 * Generates the query that fetches the list of posts to index. The parameters are
 * assumed to be safely escaped. In regular use, the values are generated by
 * Relevanssi functions which provide reliable source data.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The Relevanssi global variables array, used
 * for table names.
 *
 * @param string  $valid_status Comma-separated list of valid post statuses.
 * @param boolean $extend       If true, only care about posts missing from the
 * index. If false, take all posts. Default false.
 * @param string  $restriction  Query restrictions, MySQL code that restricts the
 * posts fetched in the desired way. Default ''.
 * @param string  $limit        MySQL code to set the LIMIT and OFFSET values.
 * Default ''.
 *
 * @return string MySQL query to fetch the posts.
 */
function relevanssi_generate_indexing_query($valid_status, $extend = \false, $restriction = '', $limit = '')
{
}
/**
 * Generates a post type restriction.
 *
 * Generates a post type restriction for the MySQL query based on the
 * 'relevanssi_index_post_types' option.
 *
 * @return string MySQL code for the post type restriction.
 */
function relevanssi_post_type_restriction()
{
}
/**
 * Generates a list of valid post statuses.
 *
 * Generates a list of valid post statuses to use in indexing. By default,
 * Relevanssi accepts 'publish', 'draft', 'private', 'pending', and 'future'. If
 * you need to use a custom post status, you can use the
 * 'relevanssi_valid_status' filter hook to add your own post status to the list
 * of valid statuses.
 *
 * @param boolean $return_array If true, return array; default false, return
 * string.
 *
 * @return string|array A comma-separated list of escaped valid post statuses
 * ready for MySQL, or an unfiltered array, depending on the $return_array
 * parameter.
 */
function relevanssi_valid_status_array($return_array = \false)
{
}
/**
 * Builds the index.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The Relevanssi global variables array,
 * used for table names.
 *
 * @param boolean|int $extend_offset If numeric, offsets the indexing by that
 * amount. If true, doesn't truncate the index before indexing. If false,
 * truncates index before indexing. Default false.
 * @param boolean     $verbose       Not used anymore, kept for backwards
 * compatibility.
 * @param int         $post_limit    How many posts to index. Default null, no
 * limit.
 * @param boolean     $is_ajax       If true, indexing is done in AJAX context.
 * Default false.
 *
 * @return array In AJAX context, returns array with two values:
 * 'indexing_complete' tells whether indexing is completed or not, and 'indexed'
 * returns the number of posts indexed. Outside AJAX context, these values are
 * returned as an array in format of array(completed, posts indexed).
 */
function relevanssi_build_index($extend_offset = \false, $verbose = \null, $post_limit = \null, $is_ajax = \false)
{
}
/**
 * Indexes one document.
 *
 * Different cases:
 *
 * Build index:
 * - global $post is null, $index_post is a post object.
 *
 * Update post:
 * - global $post has the original $post, $index_post is the ID of revision.
 *
 * Quick edit:
 * - global $post is an array, $index_post is the ID of current revision.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The Relevanssi global variables array, used
 * for table names.
 * @global object $post                 The global post object.
 *
 * @param object|int $index_post         The post to index, either post object or
 * post ID.
 * @param boolean    $remove_first       If true, remove the post from the index
 * before indexing. Default false.
 * @param array      $custom_fields      The custom fields that are indexed for the
 * post. Default an empty string.
 * @param boolean    $bypass_global_post If true, do not use the global $post object.
 * Default false.
 * @param boolean    $debug              If true, echo out debugging information.
 * Default false.
 *
 * @return string|int Number of insert queries run, or -1 if the indexing fails,
 * or 'hide' in case the post is hidden or 'donotindex' if a filter blocks this.
 */
function relevanssi_index_doc($index_post, $remove_first = \false, $custom_fields = '', $bypass_global_post = \false, $debug = \false)
{
}
/**
 * Index taxonomy terms for given post and given taxonomy.
 *
 * @since 1.8
 *
 * @param array   $insert_data Insert query data array, modified here.
 * @param int     $post_id     The indexed post ID.
 * @param string  $taxonomy    Taxonomy name.
 * @param boolean $debug       If true, print out debugging notices.
 *
 * @return int The number of new tokens added.
 */
function relevanssi_index_taxonomy_terms(&$insert_data, $post_id, $taxonomy, $debug)
{
}
/**
 * Updates child posts when a parent post changes status.
 *
 * Called from 'transition_post_status' action hook when a post is edited,
 * published, or deleted. Will do the appropriate indexing action on the child
 * posts and attachments.
 *
 * @author renaissancehack
 *
 * @param string $new_status The new status.
 * @param string $old_status The old status.
 * @param object $post       The post object.
 *
 * @return null|array Null in problem cases, an array of 'removed' and
 * 'indexed' values that show how many posts were indexed and removed.
 */
function relevanssi_update_child_posts($new_status, $old_status, $post)
{
}
/**
 * Indexes a published post.
 *
 * @param int     $post_id            The post ID.
 * @param boolean $bypass_global_post If true, bypass the global $post object.
 * Default false.
 *
 * @return string|int Returns 'auto-draft' if the post is an auto draft and
 * thus skipped, or the relevanssi_index_doc() return value.
 *
 * @see relevanssi_index_doc()
 */
function relevanssi_publish($post_id, $bypass_global_post = \false)
{
}
/**
 * Indexes a post after publishing or modification.
 *
 * Hooks on to 'wp_insert_post' action hook and triggers when wp_insert_post() is
 * used to add a post into the database. Doesn't use the global $post object, because
 * that doesn't have the correct post.
 *
 * @author Lumpysimon.
 *
 * @global object $wpdb The WP database interface.
 *
 * @param int $post_id The post ID.
 *
 * @return string|int Returns 'auto-draft' if the post is an auto draft and
 * thus skipped, 'revision' for revisions, 'nav_menu_item' for navigation menu
 * items, 'removed' if the post is removed or the relevanssi_index_doc() return
 * value from relevanssi_publish().
 *
 * @see relevanssi_publish()
 */
function relevanssi_insert_edit($post_id)
{
}
/**
 * Updates comment indexing when comments are added, edited or deleted.
 *
 * @author OdditY
 *
 * @param int $comment_id Commend ID.
 *
 * @see relevanssi_comment_remove
 * @see relevanssi_comment_edit
 * @see relevanssi_publish
 *
 * @return int|string The relevanssi_publish return value, "nocommentfound" if
 * the comment doesn't exist or "donotindex" if it cannot be indexed.
 * comment indexing is disabled.
 */
function relevanssi_index_comment($comment_id)
{
}
/**
 * Returns the comment text for a post.
 *
 * @param int $post_id The post ID.
 *
 * @return string All the comment content as a string that has the comment author
 * and the comment text.
 */
function relevanssi_get_comments($post_id)
{
}
/**
 * Truncates the Relevanssi index.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The Relevanssi global variables array, used
 * for table names.
 *
 * @return boolean True on success, false on failure.
 */
function relevanssi_truncate_index()
{
}
/**
 * Remove post from the Relevanssi index.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The Relevanssi global variables array, used
 * for table names.
 *
 * @param int     $post_id             The post ID.
 * @param boolean $keep_internal_links If true, keep internal link indexing (a
 * Premium feature). Default false.
 */
function relevanssi_remove_doc($post_id, $keep_internal_links = \false)
{
}
/**
 * Filter that allows you to set the index type based on the post type.
 *
 * @param string $type The index 'type' column value, default 'post'.
 * @param object $post The post object containing the post being indexed.
 *
 * @return string The index 'type' column value, default 'post'.
 */
function relevanssi_index_get_post_type($type, $post)
{
}
/**
 * Sets the indexing MySQL LIMIT parameter and other parameters.
 *
 * @param boolean|int $extend_offset If numeric, offsets the indexing by that
 * amount. If true, doesn't truncate the index before indexing. If false,
 * truncates index before indexing. Default false.
 * @param int         $post_limit    How many posts to index. Default null, no
 * limit.
 *
 * @return array Array with the LIMIT clause in 'limit', the extend boolean in
 * 'extend' and the size integer in 'size'.
 */
function relevanssi_indexing_query_args($extend_offset, $post_limit)
{
}
/**
 * Creates indexing queries for the comment content.
 *
 * @param array   $insert_data     The INSERT query data. Modified here.
 * @param int     $post_id         The indexed post ID.
 * @param int     $min_word_length The minimum word length.
 * @param boolean $debug           If true, print out debug notices.
 *
 * @return int The number of tokens added to the data.
 */
function relevanssi_index_comments(&$insert_data, $post_id, $min_word_length, $debug)
{
}
/**
 * Creates indexing queries for the post author.
 *
 * @param array   $insert_data     The INSERT query data. Modified here.
 * @param int     $post_author     The post author id.
 * @param int     $min_word_length The minimum word length.
 * @param boolean $debug           If true, print out debug notices.
 * @param WP_Post $post            The post object.
 *
 * @return int The number of tokens added to the data.
 */
function relevanssi_index_author(&$insert_data, $post_author, $min_word_length, $debug, $post)
{
}
/**
 * Creates indexing query data for custom fields.
 *
 * @param array        $insert_data     The INSERT query data. Modified here.
 * @param int          $post_id         The indexed post ID.
 * @param string|array $custom_fields   The custom fields to index. Only allowed
 * string values are "all" and "visible". If you wish to specify a single custom
 * field, wrap it in an array.
 * @param int          $min_word_length The minimum word length.
 * @param boolean      $debug           If true, print out debug notices.
 *
 * @return int The number of tokens added to the data.
 */
function relevanssi_index_custom_fields(&$insert_data, $post_id, $custom_fields, $min_word_length, $debug)
{
}
/**
 * Creates indexing queries for the excerpt content.
 *
 * @param array   $insert_data     The INSERT query data. Modified here.
 * @param string  $excerpt         The post excerpt to index.
 * @param int     $min_word_length The minimum word length.
 * @param boolean $debug           If true, print out debug notices.
 *
 * @return int The number of tokens added to the data.
 */
function relevanssi_index_excerpt(&$insert_data, $excerpt, $min_word_length, $debug)
{
}
/**
 * Creates indexing queries for post title.
 *
 * @param array   $insert_data     The INSERT query data. Modified here.
 * @param object  $post_object     The post object.
 * @param int     $min_word_length The minimum word length.
 * @param boolean $debug           If true, print out debug notices.
 *
 * @return int The number of tokens added to the data.
 */
function relevanssi_index_title(&$insert_data, $post_object, $min_word_length, $debug)
{
}
/**
 * Creates indexing queries for post content.
 *
 * @param array   $insert_data     The INSERT query data. Modified here.
 * @param object  $post_object     The post object.
 * @param int     $min_word_length The minimum word length.
 * @param boolean $debug           If true, print out debug notices.
 *
 * @return int The number of tokens added to the data.
 */
function relevanssi_index_content(&$insert_data, $post_object, $min_word_length, $debug)
{
}
/**
 * Disables problematic shortcode before Relevanssi indexing to avoid problems.
 *
 * Uses the `relevanssi_disabled_shortcodes` filter hook to filter the
 * shortcodes. The disabled shortcodes are first removed with
 * remove_shortcode() and then given a reference to `__return_empty_string`.
 *
 * The option `relevanssi_disable_shortcodes` is also supported for legacy
 * reasons, but it's better to use the filter instead.
 */
function relevanssi_disable_shortcodes()
{
}
/**
 * Converts INSERT query data array to query values.
 *
 * Takes the collected data and converts it to values that can be fed into
 * an INSERT query using $wpdb->prepare(). Provides filters to modify the
 * insert query values before and after the conversion.
 *
 * @global $wpdb The WordPress database interface.
 * @global $relevanssi_variables Used for the Relevanssi db table name.
 *
 * @param array  $insert_data An array of term => data pairs, where data has
 * token counts for the term in different contexts.
 * @param object $post        The indexed post object.
 *
 * @return array An array of values clauses for an INSERT query.
 */
function relevanssi_convert_data_to_values($insert_data, $post)
{
}
/**
 * Initiates Relevanssi.
 *
 * @global string $pagenow              Current admin page.
 * @global array  $relevanssi_variables The global Relevanssi variables array.
 */
function relevanssi_init()
{
}
/**
 * Iniatiates Relevanssi for admin.
 *
 * @global array $relevanssi_variables Global Relevanssi variables array.
 */
function relevanssi_admin_init()
{
}
/**
 * Adds the Relevanssi menu items.
 *
 * @global array $relevanssi_variables The global Relevanssi variables array.
 */
function relevanssi_menu()
{
}
/**
 * Introduces the Relevanssi query variables.
 *
 * Adds the Relevanssi query variables (cats, tags, post_types, by_date, and
 * highlight) to the WordPress whitelist of accepted query variables.
 *
 * @param array $qv The query variable list.
 *
 * @return array The query variables.
 */
function relevanssi_query_vars($qv)
{
}
/**
 * Creates the Relevanssi database tables.
 *
 * @global object $wpdb The WordPress database interface.
 *
 * @param int $relevanssi_db_version The Relevanssi database version number.
 */
function relevanssi_create_database_tables($relevanssi_db_version)
{
}
/**
 * Prints out the action links on the Plugins page.
 *
 * Hooked on to the 'plugin_action_links_' filter hook.
 *
 * @param array $links Action links for Relevanssi.
 *
 * @return array Updated action links.
 */
function relevanssi_action_links($links)
{
}
/**
 * Disables Relevanssi in REST API searches.
 *
 * Relevanssi doesn't work in the REST API context, so disable and allow the
 * default search to work.
 */
function relevanssi_rest_api_disable()
{
}
/**
 * Checks if a log export is requested.
 *
 * If the 'relevanssi_export' query variable is set, a log export has been
 * requested and one will be provided by relevanssi_export_log(). The click
 * tracking log export checks 'relevanssi_export_clicks' and uses the function
 * relevanssi_export_click_log().
 *
 * @see relevanssi_export_log
 * @see relevanssi_export_click_log
 */
function relevanssi_export_log_check()
{
}
/**
 * Loads in the Relevanssi plugin compatibility code.
 */
function relevanssi_load_compatibility_code()
{
}
/**
 * /lib/install.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Installs Relevanssi on a new plugin if Relevanssi is network active.
 *
 * Hooks on to 'wpmu_new_blog' and 'wp_initialize_site' action hooks and runs
 * '_relevanssi_install' on the new blog.
 *
 * @param int|object $blog Either the blog ID (if 'wpmu_new_blog') or new site
 * object (if 'wp_initialize_site').
 */
function relevanssi_new_blog($blog)
{
}
/**
 * Runs _relevanssi_install() on one blog or for the whole network.
 *
 * If Relevanssi is network active, this installs Relevanssi on all blogs in the
 * network, running the _relevanssi_install() function.
 *
 * @param boolean $network_wide If true, install on all sites. Default false.
 */
function relevanssi_install($network_wide = \false)
{
}
/**
 * Installs Relevanssi on the blog.
 *
 * Adds Relevanssi options and sets their default values and generates the
 * database tables.
 *
 * @global array $relevanssi_variables The global Relevanssi variables array.
 */
function _relevanssi_install()
{
}
/**
 * /lib/interface.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Controls the Relevanssi settings page.
 *
 * @global array $relevanssi_variables The global Relevanssi variables array.
 */
function relevanssi_options()
{
}
/**
 * Prints out the 'Admin search' page.
 */
function relevanssi_admin_search_page()
{
}
/**
 * Truncates the Relevanssi logs.
 *
 * @global object $wpdb                 The WP database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables array.
 *
 * @param boolean $verbose If true, prints out a notice. Default true.
 *
 * @return boolean True if success, false if failure.
 */
function relevanssi_truncate_logs($verbose = \true)
{
}
/**
 * Prints out the Relevanssi options form.
 *
 * @global array $relevanssi_variables The global Relevanssi variables array.
 */
function relevanssi_options_form()
{
}
/**
 * Adds admin scripts to Relevanssi pages.
 *
 * Hooks to the 'admin_enqueue_scripts' action hook.
 *
 * @global array $relevanssi_variables The global Relevanssi variables array.
 *
 * @param string $hook The hook suffix for the current admin page.
 */
function relevanssi_add_admin_scripts($hook)
{
}
/**
 * Prints out the form fields for tag and category weights.
 */
function relevanssi_form_tag_weight()
{
}
/**
 * Creates a line chart.
 *
 * @param array $labels   An array of labels for the line chart. These will be
 * wrapped in apostrophes.
 * @param array $datasets An array of (label, dataset) pairs.
 */
function relevanssi_create_line_chart(array $labels, array $datasets)
{
}
/**
 * /lib/log.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Adds the search query to the log.
 *
 * Logs the search query, trying to avoid bots.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables, used for database table names.
 *
 * @param string $query The search query.
 * @param int    $hits  The number of hits found.
 *
 * @return boolean True if logged, false if not logged.
 */
function relevanssi_update_log($query, $hits)
{
}
/**
 * Deletes partial string match log entries from the same session.
 *
 * Deletes all log entries that match the beginning of the current query. This
 * is used to avoid logging partial string matches from live search.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables, used
 * for database table names.
 *
 * @param string $session_id The session ID.
 * @param string $query      The current query.
 */
function relevanssi_delete_session_logs(string $session_id, string $query)
{
}
/**
 * Trims Relevanssi log table.
 *
 * Trims Relevanssi log table, using the day interval setting from 'relevanssi_trim_logs'.
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables, used for database table names.
 *
 * @return int|bool Number of rows deleted, or false on error.
 */
function relevanssi_trim_logs()
{
}
/**
 * Generates the user export data.
 *
 * @since 4.0.10
 *
 * @param int $user_id The user ID to export.
 * @param int $page    Paging to avoid time outs.
 *
 * @return array Two-item array: 'done' is a Boolean that tells if the exporter is
 * done, 'data' contains the actual data.
 */
function relevanssi_export_log_data($user_id, $page)
{
}
/**
 * Erases the user log data.
 *
 * @since 4.0.10
 *
 * @param int $user_id The user ID to erase.
 * @param int $page    Paging to avoid time outs.
 *
 * @return array Four-item array: 'items_removed' is a Boolean that tells if
 * something was removed, 'done' is a Boolean that tells if the eraser is done,
 * 'items_retained' is always false, 'messages' is always an empty array.
 */
function relevanssi_erase_log_data($user_id, $page)
{
}
/**
 * Prints out the Relevanssi log as a CSV file.
 *
 * Exports the whole Relevanssi search log as a CSV file.
 *
 * @uses relevanssi_output_exported_log
 *
 * @since 2.2
 */
function relevanssi_export_log()
{
}
/**
 * Prints out the log.
 *
 * Does the exporting work for log exports.
 *
 * @param string $filename The filename to use.
 * @param array  $data     The data to export.
 * @param string $message  The message to print if there is no data.
 */
function relevanssi_output_exported_log(string $filename, array $data, string $message)
{
}
/**
 * Checks if logging the query is ok.
 *
 * Returns false if the user agent is on the blocked bots list or if the
 * current user is on the relevanssi_omit_from_logs option list.
 *
 * @param WP_User $user The current user. If null, gets the value from
 * wp_get_current_user().
 *
 * @return boolean True, if the user is not a bot or not on the omit list.
 */
function relevanssi_is_ok_to_log($user = \null) : bool
{
}
/**
 * Deletes a query from log.
 *
 * @param string $query The query to delete.
 */
function relevanssi_delete_query_from_log(string $query)
{
}
/**
 * /lib/options.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Updates Relevanssi options.
 *
 * Checks the option values and updates the options. It's safe to use $request
 * here, check_admin_referer() is done immediately before this function is
 * called.
 *
 * @param array $request The request array from $_REQUEST.
 */
function update_relevanssi_options(array $request)
{
}
/**
 * Fetches option values for variable name options.
 *
 * Goes through all options and picks up all options that have names that
 * contain post types, taxonomies and so on.
 *
 * @param array $request The $request array.
 */
function relevanssi_process_weights_and_indexing($request)
{
}
/**
 * Takes a value, converts it to float and if it's negative or zero, sets it
 * to 1.
 *
 * @param mixed $weight The weight value, which can be anything user enters.
 *
 * @return float The float value of the weight.
 */
function relevanssi_sanitize_weights($weight)
{
}
/**
 * Compiles the punctuation settings from the request and updates the option.
 *
 * @param array $request The request array.
 *
 * @return boolean True, if update_option() succeeds, false otherwise.
 */
function relevanssi_process_punctuation_options(array $request) : bool
{
}
/**
 * Updates the synonym option in the current language.
 *
 * @param array $request The request array.
 *
 * @return boolean True, if update_option() succeeds, false otherwise.
 */
function relevanssi_process_synonym_options(array $request) : bool
{
}
/**
 * Updates the index_fields option in the current language.
 *
 * @param array $request The request array.
 *
 * @return boolean True, if update_option() succeeds, false otherwise.
 */
function relevanssi_process_index_fields_option(array $request) : bool
{
}
/**
 * Updates the trim_logs option.
 *
 * @param array $request The request array.
 *
 * @return boolean True, if update_option() succeeds, false otherwise.
 */
function relevanssi_process_trim_logs_option(array $request) : bool
{
}
/**
 * Updates the cat option.
 *
 * @param array $request The request array.
 *
 * @return boolean True, if update_option() succeeds, false otherwise.
 */
function relevanssi_process_cat_option(array $request) : bool
{
}
/**
 * Updates the excat option.
 *
 * @param array $request The request array.
 *
 * @return boolean True, if update_option() succeeds, false otherwise.
 */
function relevanssi_process_excat_option(array $request) : bool
{
}
/**
 * /lib/phrases.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Extracts phrases from the search query.
 *
 * Finds all phrases wrapped in quotes (curly or straight) from the search
 * query.
 *
 * @param string $query The search query.
 *
 * @return array An array of phrases (strings).
 */
function relevanssi_extract_phrases(string $query)
{
}
/**
 * Generates the MySQL code for restricting the search to phrase hits.
 *
 * This function uses relevanssi_extract_phrases() to figure out the phrases in
 * the search query, then generates MySQL queries to restrict the search to the
 * posts containing those phrases in the title, content, taxonomy terms or meta
 * fields.
 *
 * @global array $relevanssi_variables The global Relevanssi variables.
 *
 * @param string $search_query The search query.
 * @param string $operator     The search operator (AND or OR).
 *
 * @return string $queries If not phrase hits are found, an empty string;
 * otherwise MySQL queries to restrict the search.
 */
function relevanssi_recognize_phrases($search_query, $operator = 'AND')
{
}
/**
 * Generates the phrase queries from phrases.
 *
 * Takes in phrases and a bunch of parameters and generates the MySQL queries
 * that restrict the main search query to only posts that have the phrase.
 *
 * @param array        $phrases          A list of phrases to handle.
 * @param array        $taxonomies       An array of taxonomy names to use.
 * @param array|string $custom_fields    A list of custom field names to use,
 * "visible", or "all".
 * @param string       $excerpts         If 'on', include excerpts.
 *
 * @global object $wpdb The WordPress database interface.
 *
 * @return array An array of queries sorted by phrase.
 */
function relevanssi_generate_phrase_queries(array $phrases, array $taxonomies, $custom_fields, string $excerpts) : array
{
}
/**
 * Registers the Relevanssi privacy policy information.
 *
 * @since 4.0.10
 */
function relevanssi_register_privacy_policy()
{
}
/**
 * Registers the Relevanssi data exporter.
 *
 * @since 4.0.10
 *
 * @param array $exporters The exporters array.
 *
 * @return array The exporters array, with Relevanssi added.
 */
function relevanssi_register_exporter($exporters)
{
}
/**
 * Registers the Relevanssi data eraser.
 *
 * @since 4.0.10
 *
 * @param array $erasers The erasers array.
 *
 * @return array The erasers array, with Relevanssi added.
 */
function relevanssi_register_eraser($erasers)
{
}
/**
 * Exports the log entries based on user email.
 *
 * @since 4.0.10
 *
 * @param string $email_address The user email address.
 * @param int    $page          The page number, default 1.
 *
 * @return array Two-item array: 'done' is a Boolean that tells if the exporter is
 * done, 'data' contains the actual data.
 */
function relevanssi_privacy_exporter($email_address, $page = 1)
{
}
/**
 * Erases the log entries based on user email.
 *
 * @since 4.0.10
 *
 * @param string $email_address The user email address.
 * @param int    $page          The page number, default 1.
 *
 * @return array Four-item array: 'items_removed' is a Boolean that tells if
 * something was removed, 'done' is a Boolean that tells if the eraser is done,
 * 'items_retained' is always false, 'messages' is always an empty array.
 */
function relevanssi_privacy_eraser($email_address, $page = 1)
{
}
/**
 * /lib/search-query-restrictions.php
 *
 * Responsible for converting query parameters to MySQL query restrictions.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Processes the arguments to create the query restrictions.
 *
 * All individual parts are tested.
 *
 * @param array $args The query arguments.
 *
 * @return array An array containing `query_restriction` and `query_join`.
 */
function relevanssi_process_query_args($args)
{
}
/**
 * Processes the 'in' and 'not in' parameters to MySQL query restrictions.
 *
 * Checks that the parameters are integers and formulates a MySQL query
 * restriction from them. If the same posts are both included and excluded,
 * exclusion will take precedence.
 *
 * Tested.
 *
 * @param array $post_query An array where included posts are in
 * $post_query['in'] and excluded posts are in $post_query['not in'].
 *
 * @return string MySQL query restrictions matching the array.
 */
function relevanssi_process_post_query($post_query)
{
}
/**
 * Processes the 'parent in' and 'parent not in' parameters to MySQL query
 * restrictions.
 *
 * Checks that the parameters are integers and formulates a MySQL query restriction
 * from them. If the same posts are both included and excluded, exclusion will take
 * precedence.
 *
 * Tested.
 *
 * @param array $parent_query An array where included posts are in
 * $post_query['parent in'] and excluded posts are in $post_query['parent not in'].
 *
 * @return string MySQL query restrictions matching the array.
 */
function relevanssi_process_parent_query($parent_query)
{
}
/**
 * Processes the meta query parameter to MySQL query restrictions.
 *
 * Uses the WP_Meta_Query object to parse the query variables to create the MySQL
 * JOIN and WHERE clauses.
 *
 * Tested.
 *
 * @see WP_Meta_Query
 *
 * @param array $meta_query A meta query array.
 *
 * @return array Index 'where' is the WHERE, index 'join' is the JOIN.
 */
function relevanssi_process_meta_query($meta_query)
{
}
/**
 * Processes the date query parameter to MySQL query restrictions.
 *
 * Uses the WP_Date_Query object to parse the query variables to create the
 * MySQL WHERE clause. By default using a date query will block taxonomy terms
 * and user profiles from the search (because they don't have a post ID and
 * also don't have date information associated with them). If you want to keep
 * the user profiles and taxonomy terms in the search, set the filter hook
 * `relevanssi_date_query_non_posts` to return true.
 *
 * @see WP_Date_Query
 *
 * @global object $wpdb The WP database interface.
 *
 * @param WP_Date_Query $date_query A date query object.
 *
 * @return string The MySQL query restriction.
 */
function relevanssi_process_date_query($date_query)
{
}
/**
 * Processes the post exclusion parameter to MySQL query restrictions.
 *
 * Takes a comma-separated list of post ID numbers and creates a MySQL query
 * restriction from them.
 *
 * @param string $expost The post IDs to exclude, comma-separated.
 *
 * @return string The MySQL query restriction.
 */
function relevanssi_process_expost($expost)
{
}
/**
 * Processes the author parameter to MySQL query restrictions.
 *
 * Takes an array of author ID numbers and creates the MySQL query restriction code
 * from them. Negative values are counted as exclusion and positive values as
 * inclusion.
 *
 * Tested.
 *
 * @global object $wpdb The WP database interface.
 *
 * @param array $author An array of authors. Positive values are inclusion,
 * negative values are exclusion.
 *
 * @return string The MySQL query restriction.
 */
function relevanssi_process_author($author)
{
}
/**
 * Processes the by_date parameter to MySQL query restrictions.
 *
 * The by_date parameter is a simple data parameter in the format '24h', that is a
 * number followed by an unit (h, d, m, y, or w).
 *
 * Tested.
 *
 * @global object $wpdb The WP database interface.
 *
 * @param string $by_date The date parameter.
 *
 * @return string The MySQL query restriction.
 */
function relevanssi_process_by_date($by_date)
{
}
/**
 * Extracts the post types from a comma-separated list or an array.
 *
 * Handles the non-post post types as well (user, taxonomies, etc.) and escapes the
 * post types for SQL injections.
 *
 * Tested.
 *
 * @param string|array $post_type           An array or a comma-separated list of
 * post types.
 * @param boolean      $admin_search        True if this is an admin search.
 * @param boolean      $include_attachments True if attachments are allowed in the
 * search.
 *
 * @global object $wpdb The WP database interface.
 *
 * @return array Array containing the 'post_type' and 'non_post_post_type' (which
 * defaults to null).
 */
function relevanssi_process_post_type($post_type, $admin_search, $include_attachments)
{
}
/**
 * Processes the post status parameter.
 *
 * Takes the post status parameter and creates a MySQL query restriction from it.
 * Checks if this is in admin context: if the query isn't, there's a catch added to
 * capture user profiles and taxonomy terms.
 *
 * @param string $post_status A post status string.
 *
 * @global WP_Query $wp_query              The WP Query object.
 * @global object   $wpdb                  The WP database interface.
 * @global boolean  $relevanssi_admin_test If true, an admin search. for tests.
 *
 * @return string The MySQL query restriction.
 */
function relevanssi_process_post_status($post_status)
{
}
/**
 * Adds phrase restrictions to the query.
 *
 * For OR searches, adds the phrases only for matching terms that are in the
 * phrases, achieving the OR search effect for phrases: posts without the phrase
 * but with another search term are not excluded from the search. In AND
 * searches, all search terms must match to documents containing the phrase.
 *
 * @param string $query_restrictions The MySQL query restriction for the search.
 * @param array  $phrase_queries     The phrase queries - 'and' contains the
 * main query, while 'or' has the phrase-specific queries.
 * @param string $term               The current search term.
 * @param string $operator           AND or OR.
 *
 * @return string The query restrictions with the phrase restrictions added.
 */
function relevanssi_add_phrase_restrictions($query_restrictions, $phrase_queries, $term, $operator)
{
}
/**
 * /lib/search-tax-query.php
 *
 * Responsible for converting tax_query parameters to MySQL query restrictions.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Processes the tax query to formulate a query restriction to the MySQL query.
 *
 * @uses relevanssi_process_tax_query_row()
 *
 * @param string $tax_query_relation The base tax query relation. Default 'and'.
 * @param array  $tax_query          The tax query array.
 *
 * @return string The query restrictions for the MySQL query.
 */
function relevanssi_process_tax_query(string $tax_query_relation, array $tax_query) : string
{
}
/**
 * Processes one tax_query row.
 *
 * @global object $wpdb The WordPress database interface.
 *
 * @param array   $row                The tax_query row array.
 * @param boolean $is_sub_row         True if this is a subrow.
 * @param string  $global_relation    The global tax_query relation (AND or OR).
 * @param string  $query_restrictions The MySQL query restriction.
 * @param string  $tax_query_relation The tax_query relation.
 * @param array   $term_tax_ids       Array of term taxonomy IDs.
 * @param array   $not_term_tax_ids   Array of excluded term taxonomy IDs.
 * @param array   $and_term_tax_ids   Array of AND term taxonomy IDs.
 * @param array   $exist_queries      MySQL queries for EXIST subqueries.
 *
 * @return array Returns an array where the first item is the updated
 * $query_restrictions, then $term_tax_ids, $not_term_tax_ids, $and_term_tax_ids
 * and $exist_queries.
 */
function relevanssi_process_tax_query_row(array $row, bool $is_sub_row, string $global_relation, string $query_restrictions, string $tax_query_relation, array $term_tax_ids, array $not_term_tax_ids, array $and_term_tax_ids, array $exist_queries) : array
{
}
/**
 * Generates query restrictions from the term taxonomy ids.
 *
 * Combines different term tax ID arrays into a set of query restrictions that
 * can be used in an OR query.
 *
 * @global object $wpdb The WP database interface.
 *
 * @param array $term_tax_ids     The regular terms.
 * @param array $not_term_tax_ids The NOT terms.
 * @param array $and_term_tax_ids The AND terms.
 * @param array $exist_queries    The EXIST queries.
 *
 * @return string The MySQL query restrictions.
 */
function relevanssi_process_term_tax_ids(array $term_tax_ids, array $not_term_tax_ids, array $and_term_tax_ids, array $exist_queries) : string
{
}
/**
 * Gets and sanitizes the taxonomy name and slug parameters.
 *
 * Checks parameters: if they're numeric, pass them for term_id filtering,
 * otherwise sanitize and create a comma-separated list.
 *
 * @param string|array $terms_parameter The 'terms' field from the tax_query
 * row.
 * @param string       $taxonomy        The taxonomy name.
 * @param string       $field_name      The field name ('slug', 'name').
 *
 * @return array An array containing numeric terms and the list of sanitized
 * term names.
 */
function relevanssi_get_term_in($terms_parameter, string $taxonomy, string $field_name) : array
{
}
/**
 * Gets the term_tax_id from a row with 'field' set to 'slug' or 'name'.
 *
 * If the slugs or names are all numeric values, will switch the 'field'
 * parameter to 'term_id'.
 *
 * @param array $row The taxonomy query row.
 *
 * @return array An array of term taxonomy IDs.
 */
function relevanssi_term_tax_id_from_row(array $row) : array
{
}
/**
 * /lib/search.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Triggers the Relevanssi search query.
 *
 * Attaches to 'the_posts' filter hook, checks to see if there's a place for a
 * search and runs relevanssi_do_query() if there is. Do not call directly; for
 * direct Relevanssi access, use relevanssi_do_query().
 *
 * @global boolean $relevanssi_active True, if Relevanssi is already running.
 *
 * @param array    $posts An array of post objects.
 * @param WP_Query $query The WP_Query object, default false.
 */
function relevanssi_query($posts, $query = \false)
{
}
/**
 * Does the actual searching.
 *
 * This function gets the search arguments, finds posts and returns all the results
 * it finds. If you wish to access Relevanssi directly, use relevanssi_do_query(),
 * which takes a WP_Query object as a parameter, formats the arguments nicely and
 * returns a specified subset of posts. This is for internal use.
 *
 * @global object   $wpdb                  The WordPress database interface.
 * @global array    $relevanssi_variables  The global Relevanssi variables array.
 * @global WP_Query $wp_query              The WP_Query object.
 *
 * @param array $args Array of arguments.
 *
 * @return array An array of return values.
 */
function relevanssi_search($args)
{
}
/**
 * Takes a WP_Query object and runs the search query based on that
 *
 * This function can be used to run Relevanssi searches anywhere. Just create an
 * empty WP_Query object, give it some parameters, make sure 's' is set and contains
 * the search query, then run relevanssi_do_query() on the query object.
 *
 * This function is strongly influenced by Kenny Katzgrau's wpSearch plugin.
 *
 * @global boolean $relevanssi_active     If true, Relevanssi is currently
 * doing a search.
 * @global boolean $relevanssi_test_admin If true, assume this is an admin
 * search (because we can't adjust WP_ADMIN constant).
 *
 * @param WP_Query $query A WP_Query object, passed as a reference. Relevanssi will
 * put the posts found in $query->posts, and also sets $query->post_count.
 *
 * @return array The found posts, an array of post objects.
 */
function relevanssi_do_query(&$query)
{
}
/**
 * Limits the search queries to restrict the number of posts handled.
 *
 * Tested.
 *
 * @param string $query The MySQL query.
 *
 * @return string The query with the LIMIT parameter added, if necessary.
 */
function relevanssi_limit_filter($query)
{
}
/**
 * Fetches the list of post types that are excluded from the search.
 *
 * Figures out the post types that are not included in the search. Only includes
 * the post types that are actually indexed.
 *
 * @param string $include_attachments Whether to include attachments or not.
 *
 * @return string SQL escaped list of excluded post types.
 */
function relevanssi_get_negative_post_type($include_attachments)
{
}
/**
 * Generates the WHERE condition for terms.
 *
 * Trims the term, escapes it and places it in the template.
 *
 * Tested.
 *
 * @param string  $term            The search term.
 * @param boolean $force_fuzzy     If true, force fuzzy search. Default false.
 * @param boolean $no_terms        If true, no search term is used. Default false.
 * @param string  $option_override If set, won't read the value from the
 * 'relevanssi_fuzzy' option but will use this instead. Used in multisite searching.
 * Default null.
 *
 * @return string The template with the term in place.
 */
function relevanssi_generate_term_where($term, $force_fuzzy = \false, $no_terms = \false, $option_override = \null)
{
}
/**
 * Counts the taxonomy score for a match.
 *
 * Uses the taxonomy_detail object to count the taxonomy score for a match.
 * If there's a taxonomy weight in $post_type_weights, that is used, otherwise
 * assume weight 1.
 *
 * Tested.
 *
 * @since 2.1.5
 *
 * @param object $match_object      The match object, used as a reference.
 * @param array  $post_type_weights The post type and taxonomy weights array.
 */
function relevanssi_taxonomy_score(&$match_object, $post_type_weights)
{
}
/**
 * Collects the search parameters from the WP_Query object.
 *
 * @global boolean $relevanssi_test_admin If true, assume this is an admin
 * search.
 *
 * @param object $query The WP Query object used as a source.
 * @param string $q     The search query.
 *
 * @return array The search parameters.
 */
function relevanssi_compile_search_args($query, $q)
{
}
/**
 * Generates a WP_Date_Query from the query date variables.
 *
 * First checks $query->date_query, if that doesn't exist then looks at the
 * other date parameters to construct a date query.
 *
 * @param WP_Query $query The query object.
 *
 * @return WP_Date_Query|boolean The date query object or false, if no date
 * parameters can be parsed.
 */
function relevanssi_wp_date_query_from_query_vars($query)
{
}
/**
 * Generates a meta_query array from the query meta variables.
 *
 * First checks $query->meta_query, if that doesn't exist then looks at the
 * other meta query and custom field parameters to construct a meta query.
 *
 * @param WP_Query $query The query object.
 *
 * @return array|boolean The meta query object or false, if no meta query
 * parameters can be parsed.
 */
function relevanssi_meta_query_from_query_vars($query)
{
}
/**
 * Checks whether Relevanssi can do a media search.
 *
 * Relevanssi does not work with the grid view of Media Gallery. This function
 * will disable Relevanssi a) if Relevanssi is not set to index attachments,
 * b) if Relevanssi is not set to index image attachments and c) if the Media
 * Library is in grid mode. Any of these will inactivate Relevanssi in the
 * Media Library search.
 *
 * @param boolean  $search_ok If true, allow the search.
 * @param WP_Query $query     The query object.
 *
 * @return boolean If true, allow the search.
 */
function relevanssi_control_media_queries(bool $search_ok, \WP_Query $query) : bool
{
}
/**
 * Calculates the TF value.
 *
 * @param stdClass $match_object      The match object.
 * @param array    $post_type_weights An array of post type weights.
 *
 * @return float The TF value.
 */
function relevanssi_calculate_tf($match_object, $post_type_weights)
{
}
/**
 * Calculates the match weight based on TF, IDF and bonus multipliers.
 *
 * @param stdClass $match_object      The match object.
 * @param float    $idf               The inverse document frequency.
 * @param array    $post_type_weights The post type weights.
 * @param string   $query             The search query.
 *
 * @return float The weight.
 */
function relevanssi_calculate_weight($match_object, $idf, $post_type_weights, $query)
{
}
/**
 * Updates the $term_hits array used for showing how many hits were found for
 * each term.
 *
 * @param array    $term_hits    The term hits array (passed as reference).
 * @param array    $match_arrays The matches array (passed as reference).
 * @param stdClass $match_object The match object.
 * @param string   $term         The search term.
 */
function relevanssi_update_term_hits(&$term_hits, &$match_arrays, $match_object, $term)
{
}
/**
 * Initializes the matches array with empty arrays.
 *
 * @return array An array of empty arrays.
 */
function relevanssi_initialize_match_arrays()
{
}
/**
 * Calculates the DF counts for each term.
 *
 * @param array $terms The list of terms.
 * @param array $args  The rest of the parameters: bool 'no_terms' for whether
 * there's a search term or not; string 'operator' for the search operator,
 * array 'phrase_queries' for the phrase queries, string 'query_join' for the
 * MySQL query JOIN value, string 'query_restrictions' for the MySQL query
 * restrictions, bool 'search_again' to tell if this is a redone search.
 *
 * @return array An array of DF values for each term.
 */
function relevanssi_generate_df_counts(array $terms, array $args) : array
{
}
/**
 * Sorts the results Relevanssi finds.
 *
 * @param array        $hits       The results array (passed as reference).
 * @param string|array $orderby    The orderby parameter, accepts both string
 * and array format.
 * @param string       $order      Either 'asc' or 'desc'.
 * @param array        $meta_query The meta query parameters.
 */
function relevanssi_sort_results(&$hits, $orderby, $order, $meta_query)
{
}
/**
 * Adjusts the $match->doc ID in case of users, post type archives and
 * taxonomy terms.
 *
 * @param stdClass $match_object The match object.
 *
 * @return int|string The doc ID, modified if necessary.
 */
function relevanssi_adjust_match_doc($match_object)
{
}
/**
 * Generates the MySQL search query.
 *
 * @param string $term               The search term.
 * @param bool   $search_again       If true, this is a repeat search (partial matching).
 * @param bool   $no_terms           If true, no search term is used.
 * @param string $query_join         The MySQL JOIN clause, default empty string.
 * @param string $query_restrictions The MySQL query restrictions, default empty string.
 *
 * @return string The MySQL search query.
 */
function relevanssi_generate_search_query(string $term, bool $search_again, bool $no_terms, string $query_join = '', string $query_restrictions = '') : string
{
}
/**
 * Compiles search arguments that are shared between single site search and
 * multisite search.
 *
 * @param WP_Query $query The WP_Query that has the parameters.
 *
 * @return array The compiled search parameters.
 */
function relevanssi_compile_common_args($query)
{
}
/**
 * Adds posts to the matches list from the other term queries.
 *
 * Without this functionality, AND searches would not return all posts. If a
 * post appears within the best results for one word, but not for another word
 * even though the word appears in the post (because of throttling), the post
 * would be excluded. This functionality makes sure it is included.
 *
 * @param array $matches        The found posts array.
 * @param array $included_posts The posts to include.
 * @param array $params         Search parameters.
 */
function relevanssi_add_include_matches(array &$matches, array $included_posts, array $params)
{
}
/**
 * Figures out the low and high boundaries for the search query.
 *
 * The low boundary defaults to 0. If the search is paged, the low boundary is
 * calculated from the page number and posts_per_page value.
 *
 * The high boundary defaults to the low boundary + post_per_page, but if no
 * posts_per_page is set or it's -1, the high boundary is the number of posts
 * found. Also if the high boundary is higher than the number of posts found,
 * it's set there.
 *
 * If an offset is defined, both boundaries are offset with the value.
 *
 * @param WP_Query $query The WP Query object.
 *
 * @return array An array with the low boundary first, the high boundary second.
 */
function relevanssi_get_boundaries($query) : array
{
}
/**
 * Returns a ID=>parent object from post ID.
 *
 * @param int $post_id The post ID.
 *
 * @return object An object with the post ID in ->ID and post parent in
 * ->post_parent.
 */
function relevanssi_generate_post_parent(int $post_id)
{
}
/**
 * Returns a ID=>type object from post ID.
 *
 * @param string $post_id The post ID.
 *
 * @return object An object with the post ID in ->ID, object type in ->type and
 * (possibly) term taxonomy in ->taxonomy and post type name in ->name.
 */
function relevanssi_generate_id_type(string $post_id)
{
}
/**
 * Adds a join for wp_posts for post_date searches.
 *
 * If the default orderby is post_date, this function adds a wp_posts join to
 * the search query.
 *
 * @param string $query_join The join query.
 *
 * @return string The modified join query.
 */
function relevanssi_post_date_throttle_join($query_join)
{
}
/**
 * Adds a join for wp_posts for post_date searches.
 *
 * If the default orderby is post_date, this function connects the wp_posts
 * table joined in another filter function.
 *
 * @param string $query_restrictions The where query restrictions.
 *
 * @return string The modified query restrictions.
 */
function relevanssi_post_date_throttle_where($query_restrictions)
{
}
/**
 * Creates a link to search results.
 *
 * Using this is generally not a brilliant idea, actually. Google doesn't like
 * it if you create links to internal search results.
 *
 * Usage: [search term='tomato']tomatoes[/search] would create a link like this:
 * <a href="/?s=tomato">tomatoes</a>
 *
 * Set 'phrase' to something else than 'not' to make the search term a phrase.
 *
 * @global object $wpdb The WordPress database interface.
 *
 * @param array  $atts    The shortcode attributes. If 'term' is set, will use
 * it as the search term, otherwise the content word is used as the term.
 * @param string $content The content inside the shortcode tags.
 *
 * @return string A link to search results.
 */
function relevanssi_shortcode($atts, $content)
{
}
/**
 * Does nothing.
 *
 * In normal use, the [noindex] shortcode does nothing.
 *
 * @param array  $atts    The shortcode attributes. Not used.
 * @param string $content The content inside the shortcode tags.
 *
 * @return string The shortcode content.
 */
function relevanssi_noindex_shortcode($atts, $content)
{
}
/**
 * Returns nothing.
 *
 * During indexing, the [noindex] shortcode returns nothing.
 *
 * @return string An empty string.
 */
function relevanssi_noindex_shortcode_indexing()
{
}
/**
 * Returns a search form.
 *
 * Returns a search form generated by get_search_form(). Any attributes passed to the
 * shortcode will be passed onto the search form, for example like this:
 *
 * [searchform post_types='post,product']
 *
 * This would add a
 *
 * <input type="hidden" name="post_types" value="post,product" />
 *
 * to the search form.
 *
 * @param array $atts The shortcode attributes.
 *
 * @return string A search form.
 */
function relevanssi_search_form($atts)
{
}
/**
 * /lib/sorting.php
 *
 * Sorting functions.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Gets the next key-direction pair from the orderby array.
 *
 * Fetches a key-direction pair from the orderby array. Converts key names to
 * match the post object parameters when necessary and seeds the random
 * generator, if required.
 *
 * @param array $orderby An array of key-direction pairs.
 *
 * @return array A set of 'key', 'dir' for direction and 'compare' for proper
 * comparison method.
 */
function relevanssi_get_next_key(&$orderby)
{
}
/**
 * Gets the values for comparing items for given key.
 *
 * Fetches the key values for the item pair. If random order is required, this
 * function will randomize the order.
 *
 * @global array $relevanssi_meta_query The meta query used for the sorting.
 *
 * @param string $key    The key used.
 * @param object $item_1 The first post object to compare.
 * @param object $item_2 The second post object to compare.
 *
 * @return array Array with the key values: 'key1' and 'key2', respectively.
 */
function relevanssi_get_compare_values($key, $item_1, $item_2)
{
}
/**
 * Compares two values.
 *
 * Compares two sorting keys using date based comparison, string comparison or
 * numeric comparison.
 *
 * @param string $key1 The first key.
 * @param string $key2 The second key.
 * @param string $compare The comparison method; possible values are 'date' for
 * date comparisons and 'string' for string comparison, everything else is
 * considered a numeric comparison.
 *
 * @return int $val Returns < 0 if key1 is less than key2; > 0 if key1 is
 * greater than key2, and 0 if they are equal.
 */
function relevanssi_compare_values($key1, $key2, $compare)
{
}
/**
 * Compares two values using order array from a filter.
 *
 * Compares two sorting keys using a sorted array that contains value => order
 * pairs. Uses the 'relevanssi_comparison_order' filter to get the sorting
 * guidance array.
 *
 * @param string $key1 The first key.
 * @param string $key2 The second key.
 *
 * @return int $val Returns < 0 if key1 is less than key2; > 0 if key1 is
 * greater than key2, and 0 if they are equal.
 */
function relevanssi_filter_compare($key1, $key2)
{
}
/**
 * Compares values using multiple levels of sorting keys.
 *
 * Comparison function for usort() using multiple levels of sorting methods. If
 * one level produces a tie, the sort will get a next level of sorting methods.
 *
 * @global array $relevanssi_keys     An array of sorting keys by level.
 * @global array $relevanssi_dirs     An array of sorting directions by level.
 * @global array $relevanssi_compares An array of comparison methods by level.
 *
 * @param object $a A post object.
 * @param object $b A post object.
 *
 * @return int $val Returns < 0 if a is less than b; > 0 if a is greater
 * than b, and 0 if they are equal.
 */
function relevanssi_cmp_function($a, $b)
{
}
/**
 * Sorts post objects.
 *
 * Sorts post objects using multiple levels of sorting methods. This function
 * was originally written by Matthew Hood and published in the PHP manual
 * comments.
 *
 * The actual sorting is handled by relevanssi_cmp_function().
 *
 * @see relevanssi_cmp_function()
 *
 * @global array $relevanssi_keys       An array of sorting keys by level.
 * @global array $relevanssi_dirs       An array of sorting directions by level.
 * @global array $relevanssi_compares   An array of comparison methods by level.
 * @global array $relevanssi_meta_query The meta query array.
 *
 * @param array $data       The posts to sort are in $data[0], used as a
 * reference.
 * @param array $orderby    The array of orderby rules with directions.
 * @param array $meta_query The meta query array, in case it's needed for meta
 * query based sorting.
 */
function relevanssi_object_sort(&$data, $orderby, $meta_query)
{
}
/**
 * Sorts strings by length.
 *
 * A sorting function that sorts strings by length. Uses relevanssi_strlen() to
 * count the string length.
 *
 * @see relevanssi_strlen()
 *
 * @param string $a String A.
 * @param string $b String B.
 *
 * @return int Negative value, if string A is longer; zero, if strings are
 * equally long; positive, if string B is longer.
 */
function relevanssi_strlen_sort($a, $b)
{
}
/**
 * /lib/stopwords.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Reads automatically the correct stopwords for the current language set in
 * WPLANG.
 *
 * The stopwords are first read from the wp_relevanssi_stopwords database table
 * (which is where they were stored before they were moved to an option), but
 * if the table is empty (as it will be in new installations), the stopwords are
 * read from the stopword file for the current language (defaulting to en_US).
 *
 * @global object $wpdb                 The WordPress database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables array.
 *
 * @param boolean $verbose        If true, output results. Default false.
 * @param string  $stopword_table Name of the stopword table to use. Default
 * empty, which means the default table.
 *
 * @return string Result: 'database' for reading from database, 'file' for
 * reading from file, 'no_file' for non-existing file, 'file_error' for file
 * with non-acceptable data.
 */
function relevanssi_populate_stopwords($verbose = \false, string $stopword_table = '')
{
}
/**
 * Fetches the list of stopwords in the current language.
 *
 * Gets the list of stopwords from the relevanssi_stopwords option using the
 * current language.
 *
 * @return array An array of stopwords;  if nothing is found, returns an empty
 * array.
 */
function relevanssi_fetch_stopwords()
{
}
/**
 * Adds a stopword to the list of stopwords.
 *
 * @param string  $term    The stopword that is added.
 * @param boolean $verbose If true, print out notices. Default true.
 *
 * @return boolean True, if success; false otherwise.
 */
function relevanssi_add_stopword($term, $verbose = \true)
{
}
/**
 * Adds a single stopword to the stopword table.
 *
 * @global object $wpdb                 The WP database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables.
 *
 * @param string $term The term to add.
 *
 * @return boolean True if success, false if not.
 */
function relevanssi_add_single_stopword($term)
{
}
/**
 * Updates the current language stopwords in the stopwords option.
 *
 * Fetches the stopwords option, replaces the current language stopwords with
 * the parameter array and updates the option.
 *
 * @param array $stopwords An array of stopwords.
 *
 * @return boolean The return value from update_option().
 */
function relevanssi_update_stopwords($stopwords)
{
}
/**
 * Deletes a term from all posts in the database, language considered.
 *
 * If Polylang or WPML are used, deletes the term only from the posts matching
 * the current language.
 *
 * @param string $term The term to delete.
 */
function relevanssi_delete_term_from_all_posts($term)
{
}
/**
 * Removes all stopwords in specific language.
 *
 * Empties the relevanssi_stopwords option for particular language.
 *
 * @param boolean $verbose  If true, print out notice. Default true.
 * @param string  $language The language code of stopwords. If empty, removes
 * the stopwords for the current language.
 *
 * @return boolean True, if able to remove the options.
 */
function relevanssi_remove_all_stopwords($verbose = \true, $language = \false)
{
}
/**
 * Removes a single stopword.
 *
 * @global object $wpdb                 The WP database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables.
 *
 * @param string  $term    The stopword to remove.
 * @param boolean $verbose If true, print out a notice. Default true.
 *
 * @return boolean True if success, false if not.
 */
function relevanssi_remove_stopword($term, $verbose = \true)
{
}
/**
 * Helper function to remove stopwords from an array.
 *
 * Removes all stopwords from an array of terms. If body stopwords are
 * available, those will also be removed. The terms must be in the array values.
 *
 * @param array $terms An array of terms to clean out.
 *
 * @return array An array of terms with stopwords removed.
 */
function relevanssi_remove_stopwords_from_array($terms)
{
}
/**
 * Updates the relevanssi_stopwords setting from a simple string to an array
 * that is required for multilingual stopwords.
 */
function relevanssi_update_stopwords_setting()
{
}
/**
 * /lib/tabs/attachments-tab.php
 *
 * Prints out the Attachments tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the attachments tab in Relevanssi settings.
 */
function relevanssi_attachments_tab()
{
}
/**
 * /lib/tabs/debugging-tab.php
 *
 * Prints out the Debugging tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the debugging tab in Relevanssi settings.
 */
function relevanssi_debugging_tab()
{
}
/**
 * /lib/tabs/excerpts-tab.php
 *
 * Prints out the Excerpts tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the excerpts tab in Relevanssi settings.
 */
function relevanssi_excerpts_tab()
{
}
/**
 * /lib/tabs/indexing-tab.php
 *
 * Prints out the Indexing tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the indexing tab in Relevanssi settings.
 *
 * @global $wpdb                 The WordPress database interface.
 * @global $relevanssi_variables The global Relevanssi variables array.
 */
function relevanssi_indexing_tab()
{
}
/**
 * /lib/tabs/logging-tab.php
 *
 * Prints out the Logging tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the logging tab in Relevanssi settings.
 *
 * @global $wpdb                 The WordPress database interface.
 */
function relevanssi_logging_tab()
{
}
/**
 * /lib/tabs/overview-tab.php
 *
 * Prints out the Overview tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the overview tab in Relevanssi settings.
 *
 * @global array  $relevanssi_variables The global Relevanssi variables array.
 */
function relevanssi_overview_tab()
{
}
/**
 * /lib/tabs/redirects-tab.php
 *
 * Prints out the Redirects tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the redirects tab in Relevanssi settings.
 */
function relevanssi_redirects_tab()
{
}
/**
 * /lib/tabs/search-tab.php
 *
 * Prints out the search tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the search tab in Relevanssi settings.
 */
function relevanssi_search_tab()
{
}
/**
 * /lib/tabs/searching-tab.php
 *
 * Prints out the Searching tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the searching tab in Relevanssi settings.
 *
 * @global $wpdb                 The WordPress database interface.
 * @global $relevanssi_variables The global Relevanssi variables array.
 */
function relevanssi_searching_tab()
{
}
/**
 * /lib/tabs/stopwords-tab.php
 *
 * Prints out the Stopwords tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the stopwords tab in Relevanssi settings.
 */
function relevanssi_stopwords_tab()
{
}
/**
 * Displays a list of stopwords.
 *
 * Displays the list of stopwords and gives the controls for adding new
 * stopwords.
 */
function relevanssi_show_stopwords()
{
}
/**
 * Displays an error message when Polylang is in all languages mode.
 */
function relevanssi_polylang_all_languages_stopwords()
{
}
/**
 * /lib/tabs/synonyms-tab.php
 *
 * Prints out the Synonyms tab in Relevanssi settings.
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the synonyms tab in Relevanssi settings.
 */
function relevanssi_synonyms_tab()
{
}
/**
 * Displays an error message when Polylang is in all languages mode.
 */
function relevanssi_polylang_all_languages_synonyms()
{
}
/**
 * /lib/uninstall.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Drops the database tables.
 *
 * Drops the Relevanssi database tables
 *
 * @global $wpdb The WordPress database interface.
 */
function relevanssi_drop_database_tables()
{
}
/**
 * Uninstalls Relevanssi.
 *
 * Deletes all options and removes database tables.
 *
 * @global object $wpdb The WordPress database interface.
 */
function relevanssi_uninstall_free()
{
}
/**
 * /lib/user-searches.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Prints out the 'User searches' page.
 */
function relevanssi_search_stats()
{
}
/**
 * Shows the query log with the most common queries
 *
 * Uses relevanssi_total_queries() and relevanssi_date_queries() to fetch the data.
 */
function relevanssi_query_log()
{
}
/**
 * Shows the total number of searches on 'User searches' page.
 *
 * @global object $wpdb                 The WP database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables array.
 *
 * @param string $from The start date.
 * @param string $to   The end date.
 *
 * @return int The number of searches.
 */
function relevanssi_total_queries(string $from, string $to)
{
}
/**
 * Shows the total number of searches on 'User searches' page.
 *
 * @global object $wpdb                 The WP database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables array.
 *
 * @param string $from The start date.
 * @param string $to   The end date.
 */
function relevanssi_nothing_found_queries(string $from, string $to)
{
}
/**
 * Shows the most common search queries on different time periods.
 *
 * @global object $wpdb                 The WP database interface.
 * @global array  $relevanssi_variables The global Relevanssi variables array.
 *
 * @param string $from    The beginning date.
 * @param string $to      The ending date.
 * @param string $version If 'good', show the searches that found something; if
 * 'bad', show the searches that didn't find anything. Default 'good'.
 */
function relevanssi_date_queries(string $from, string $to, string $version = 'good')
{
}
/**
 * /lib/utils.php
 *
 * @package Relevanssi
 * @author  Mikko Saari
 * @license https://wordpress.org/about/gpl/ GNU General Public License
 * @see     https://www.relevanssi.com/
 */
/**
 * Returns a Relevanssi_Taxonomy_Walker instance.
 *
 * Requires the class file and generates a new Relevanssi_Taxonomy_Walker instance.
 *
 * @return object A new Relevanssi_Taxonomy_Walker instance.
 */
function get_relevanssi_taxonomy_walker()
{
}
/**
 * Adds apostrophes around a string.
 *
 * @param string $str The string.
 *
 * @return string The string with apostrophes around it.
 */
function relevanssi_add_apostrophes($str)
{
}
/**
 * Adds quotes around a string.
 *
 * @param string $str The string.
 *
 * @return string The string with quotes around it.
 */
function relevanssi_add_quotes($str)
{
}
/**
 * Wraps the relevanssi_mb_trim() function so that it can be used as a callback
 * for array_walk().
 *
 * @since 2.1.4
 *
 * @see relevanssi_mb_trim.
 *
 * @param string $str String to trim.
 */
function relevanssi_array_walk_trim(string &$str)
{
}
/**
 * Converts sums in an array to averages, based on an array containing counts.
 *
 * Both arrays need to have (key, value) pairs with the same keys. The values
 * in $arr are then divided by the matching values in $counts, so when we have
 * sums in $arr and counts in $counts, we end up with averages.
 *
 * @param array $arr    The array with sums, passed as reference.
 * @param array $counts The array with counts.
 */
function relevanssi_average_array(array &$arr, array $counts)
{
}
/**
 * Returns 'checked' if the option is enabled.
 *
 * @param string $option Value to check.
 *
 * @return string If the option is 'on', returns 'checked', otherwise returns an
 * empty string.
 */
function relevanssi_check(string $option)
{
}
/**
 * Closes tags in a bit of HTML code.
 *
 * Used to make sure no tags are left open in excerpts. This method is not
 * foolproof, but it's good enough for now.
 *
 * @param string $html The HTML code to analyze.
 *
 * @return string The HTML code, with tags closed.
 */
function relevanssi_close_tags(string $html)
{
}
/**
 * Counts search term occurrances in the Relevanssi index.
 *
 * @param string $query The search query. Will be split at spaces.
 * @param string $mode  Output mode. Possible values 'array' or 'string'.
 * Default is 'array'.
 *
 * @return array|string An array of search term occurrances, or a string with
 * the number of occurrances.
 */
function relevanssi_count_term_occurrances(string $query, string $mode = 'array')
{
}
/**
 * Prints out debugging notices.
 *
 * If WP_CLI is available, prints out the debug notice as a WP_CLI::log(),
 * otherwise if debug mode is on, uses error_log(), otherwise just echo.
 *
 * @param string $notice The notice to print out.
 */
function relevanssi_debug_echo(string $notice)
{
}
/**
 * Runs do_shortcode() on content, but safeguards the global $post to make sure
 * it isn't changed by the shortcodes. If shortcode expansion is disabled in
 * Relevanssi settings, runs strip_shortcodes() on the content.
 *
 * @uses relevanssi_disable_shortcodes() Disables problem shortcodes.
 * @see do_shortcode()                   Expands shortcodes.
 * @see strip_shortcodes()               Strips off shortcodes.
 *
 * @param string $content The content where the shortcodes are expanded.
 *
 * @return string
 */
function relevanssi_do_shortcode(string $content) : string
{
}
/**
 * Recursively flattens a multidimensional array to produce a string.
 *
 * @param array $arr The source array.
 *
 * @return string The array contents as a string.
 */
function relevanssi_flatten_array(array $arr)
{
}
/**
 * Generates from and to date values from ranges.
 *
 * Possible values in the $request array: 'from' and 'to' for direct dates,
 * 'this_year' for Jan 1st to today, 'this_month' for 1st of month to today,
 * 'last_month' for 1st of previous month to last of previous month,
 * 'this_week' for Monday of this week to today (or Sunday, if the
 * relevanssi_week_starts_on_sunday returns `true`), 'last_week' for the
 * previous week, 'last_30' for from 30 days ago to today, 'last_7' for from
 * 7 days ago to today.
 *
 * @param array  $request The request array where the settings are.
 * @param string $from    The default 'from' date in "Y-m-d" format.
 * @return array The from date in 'from' and the to date in 'to' in "Y-m-d"
 * format.
 */
function relevanssi_from_and_to(array $request, string $from) : array
{
}
/**
 * Generates closing tags for an array of tags.
 *
 * @param array $tags Array of tag names.
 *
 * @return array $closing_tags Array of closing tags.
 */
function relevanssi_generate_closing_tags(array $tags)
{
}
/**
 * Returns a post object based on ID, **type**id notation or an object.
 *
 * @uses relevanssi_get_post_object() Fetches post objects.
 *
 * @param int|string|WP_Post $source The source identified to parse, either a
 * post ID integer, a **type**id string or a post object.
 *
 * @return array An array containing the actual object in 'object' and the
 * format of the original value in 'format'. The value can be 'object', 'id'
 * or 'id=>parent'.
 */
function relevanssi_get_an_object($source)
{
}
/**
 * Returns the attachment filename suffix.
 *
 * Reads the filename from $post->guid and returns the file suffix.
 *
 * @param WP_Post|int $post The post object or post ID.
 * @return string The suffix if it is found, an empty string otherwise.
 */
function relevanssi_get_attachment_suffix($post) : string
{
}
/**
 * Returns the locale or language code.
 *
 * If WPML or Polylang is not available, returns `get_locale()` value. With
 * WPML or Polylang, first this function checks to see if the global $post is
 * set. If it is, the function returns the language of the post, as we're
 * working on a post and need to use the correct language.
 *
 * If the global $post is not set, this function returns for Polylang the
 * results of `pll_current_language()`, for WPML it uses `wpml_current_language`
 * and `wpml_active_languages`.
 *
 * @param boolean $locale If true, return locale; if false, return language
 * code.
 *
 * @return string The locale or the language code.
 */
function relevanssi_get_current_language(bool $locale = \true)
{
}
/**
 * Gets the permalink to the current post within Loop.
 *
 * Uses get_permalink() to get the permalink, then adds the 'highlight'
 * parameter if necessary using relevanssi_add_highlight().
 *
 * @param int|WP_Post $post Post ID or post object. Default is the global $post.
 *
 * @see get_permalink()
 *
 * @return string The permalink.
 */
function relevanssi_get_permalink($post = 0)
{
}
/**
 * Replacement for get_post() that uses the Relevanssi post cache.
 *
 * Tries to fetch the post from the Relevanssi post cache. If that doesn't work,
 * gets the post using get_post().
 *
 * @param int|string $post_id The post ID. Usually an integer post ID, but can
 * also be a string (u_<user ID>, p_<post type name> or
 * **<taxonomy>**<term ID>).
 * @param int        $blog_id The blog ID, default -1. If -1, will be replaced
 * with the actual current blog ID from get_current_blog_id().
 *
 * @return object|WP_Error The post object or a WP_Error object if the post
 * doesn't exist.
 */
function relevanssi_get_post($post_id, int $blog_id = -1)
{
}
/**
 * Fetches post meta value for a large group of posts with just one query.
 *
 * This function can be used to reduce the number of database queries. Instead
 * of looping through an array of posts and calling get_post_meta() for each
 * individual post, you can get all the values with this function with just one
 * database query.
 *
 * @param array  $post_ids An array of post IDs.
 * @param string $field    The name of the field.
 *
 * @return array An array of post_id, meta_value pairs.
 */
function relevanssi_get_post_meta_for_all_posts(array $post_ids, string $field) : array
{
}
/**
 * Returns an object based on ID.
 *
 * Wrapper to handle non-post cases (terms, user profiles). Regular posts are
 * passed on to relevanssi_get_post().
 *
 * @uses relevanssi_get_post() Used to fetch regular posts.
 *
 * @param int|string $post_id An ID, either an integer post ID or a
 * **type**id string for terms and users.
 *
 * @return WP_Post|WP_Term|WP_User|WP_Error An object, type of which depends on
 * the target object. If relevanssi_get_post() doesn't find the post, this
 * returns a WP_Error.
 */
function relevanssi_get_post_object($post_id)
{
}
/**
 * Returns the term taxonomy ID for a term based on term ID.
 *
 * @global object $wpdb The WordPress database interface.
 *
 * @param int    $term_id  The term ID.
 * @param string $taxonomy The taxonomy.
 *
 * @return int Term taxonomy ID.
 */
function relevanssi_get_term_tax_id(int $term_id, string $taxonomy)
{
}
/**
 * Fetches the taxonomy based on term ID.
 *
 * Fetches the taxonomy from wp_term_taxonomy based on term_id.
 *
 * @global object $wpdb The WordPress database interface.
 *
 * @param int $term_id The term ID.
 *
 * @deprecated Will be removed in future versions.
 *
 * @return string $taxonomy The term taxonomy.
 */
function relevanssi_get_term_taxonomy(int $term_id)
{
}
/**
 * Gets a list of tags for post.
 *
 * Replacement for get_the_tags() that does the same, but applies Relevanssi
 * search term highlighting on the results.
 *
 * @uses relevanssi_the_tags() Does the actual work.
 *
 * @param string $before    What is printed before the tags, default ''.
 * @param string $separator The separator between items, default ', '.
 * @param string $after     What is printed after the tags, default ''.
 * @param int    $post_id   The post ID. Default current post ID (in the Loop).
 */
function relevanssi_get_the_tags(string $before = '', string $separator = ', ', string $after = '', int $post_id = 0)
{
}
/**
 * Returns the post title with highlighting.
 *
 * Reads the highlighted title from $post->post_highlighted_title. Uses the
 * relevanssi_get_post() to fecth the post.
 *
 * @uses relevanssi_get_post() Fetches post objects.
 *
 * @param int|WP_Post $post The post ID or a post object.
 *
 * @return string The post title with highlights and an empty string, if the
 * post cannot be found.
 */
function relevanssi_get_the_title($post)
{
}
/**
 * Adds a soft hyphen to a string at every five characters.
 *
 * @param string $str The string to hyphenate.
 *
 * @return string The hyphenated string.
 */
function relevanssi_hyphenate($str)
{
}
/**
 * Returns an imploded string if the option exists and is an array, an empty
 * string otherwise.
 *
 * @see implode()
 *
 * @param array  $request An array of option values.
 * @param string $option  The key to check.
 * @param string $glue    The glue string for implode(), default ','.
 *
 * @return string Imploded string or an empty string.
 */
function relevanssi_implode(array $request, string $option, string $glue = ',')
{
}
/**
 * Increases a value. If it's not set, sets it first to the default value.
 *
 * @param int $value     The value to increase (passed by reference).
 * @param int $increase  The amount to increase the value, default 1.
 * @param int $def_value The default value, default 0.
 */
function relevanssi_increase_value(&$value, $increase = 1, $def_value = 0)
{
}
/**
 * Returns the intval of the option if it exists, null otherwise.
 *
 * @see intval()
 *
 * @param array  $request An array of option values.
 * @param string $option  The key to check.
 *
 * @return int|null Integer value of the option, or null.
 */
function relevanssi_intval(array $request, string $option)
{
}
/**
 * Returns true if the search is from Relevanssi Live Ajax Search.
 *
 * Checks if $wp_query->query_vars['action'] is set to "relevanssi_live_search".
 *
 * @return bool True if the search is from Relevanssi Live Ajax Search, false
 * otherwise.
 */
function relevanssi_is_live_search()
{
}
/**
 * Checks if a string is a multiple-word phrase.
 *
 * Replaces hyphens, quotes and ampersands with spaces if necessary based on
 * the Relevanssi advanced indexing settings.
 *
 * @param string $str The string to check.
 *
 * @return boolean True if the string is a multiple-word phrase, false otherwise.
 */
function relevanssi_is_multiple_words(string $str) : bool
{
}
/**
 * Launches an asynchronous Ajax action.
 *
 * Makes a wp_remote_post() call with the specific action. Handles nonce
 * verification.
 *
 * @see wp_remove_post()
 * @see wp_create_nonce()
 *
 * @param string $action       The action to trigger (also the name of the
 * nonce).
 * @param array  $payload_args The parameters sent to the action. Defaults to
 * an empty array.
 *
 * @return WP_Error|array The wp_remote_post() response or WP_Error on failure.
 */
function relevanssi_launch_ajax_action(string $action, array $payload_args = array())
{
}
/**
 * Returns a legal value.
 *
 * @param array  $request An array of option values.
 * @param string $option  The key to check.
 * @param array  $values  The legal values.
 * @param string $def_val The default value.
 *
 * @return string|null A legal value or the default value, null if the option
 * isn't set.
 */
function relevanssi_legal_value(array $request, string $option, array $values, string $def_val)
{
}
/**
 * Multibyte friendly case-insensitive string comparison.
 *
 * If multibyte string functions are available, do strnatcmp() after using
 * mb_strtoupper() to both strings. Otherwise use strnatcasecmp().
 *
 * @see strnatcasecmp() Falls back to this if multibyte functions are
 * not available.
 * @see strnatcmp()     Used to compare the strings.
 * @see mb_strtoupper() Used to convert strings to uppercase.
 *
 * @param string $str1     First string to compare.
 * @param string $str2     Second string to compare.
 * @param string $encoding The encoding to use, default mb_internal_encoding().
 *
 * @return int $val Returns < 0 if str1 is less than str2; > 0 if str1 is
 * greater than str2, and 0 if they are equal.
 */
function relevanssi_mb_strcasecmp($str1, $str2, $encoding = '') : int
{
}
/**
 * Multibyte friendly case-insensitive string search.
 *
 * If multibyte string functions are available, do mb_stristr(). Otherwise,
 * do stristr().
 *
 * @see stristr()     Falls back to this if multibyte functions are not
 * available.
 *
 * @param string $haystack The string to search in.
 * @param string $needle   The string to search for.
 * @param string $encoding The encoding to use, default mb_internal_encoding().
 *
 * @return bool True if the needle was found in the haystack, false otherwise.
 */
function relevanssi_mb_stristr($haystack, $needle, $encoding = '') : bool
{
}
/**
 * Trims multibyte strings.
 *
 * Removes the 194+160 non-breakable spaces, removes null bytes and removes
 * whitespace.
 *
 * @param string $str The source string.
 *
 * @return string Trimmed string.
 */
function relevanssi_mb_trim(string $str)
{
}
/**
 * Returns 'on' if option exists and value is not 'off', otherwise 'off'.
 *
 * @param array  $request An array of option values.
 * @param string $option  The key to check.
 *
 * @return string 'on' or 'off'.
 */
function relevanssi_off_or_on(array $request, string $option)
{
}
/**
 * Removes quotes (", ”, “) from a string.
 *
 * @param string $str The string to clean.
 *
 * @return string The cleaned string.
 */
function relevanssi_remove_quotes(string $str)
{
}
/**
 * Removes quotes from array keys. Does not keep array values.
 *
 * Used to remove phrase quotes from search term array, which have the format
 * of (term => hits). The number of hits is not needed, so this function
 * discards it as a side effect.
 *
 * @uses relevanssi_remove_quotes() This does the actual work.
 *
 * @param array $arr An array to process.
 *
 * @return array The same array with quotes removed from the keys.
 */
function relevanssi_remove_quotes_from_array_keys(array $arr)
{
}
/**
 * Returns an ID=>parent object from a post (or a term, or a user).
 *
 * @param WP_Post|WP_Term|WP_User $post_object The source object.
 *
 * @return object An object with the attributes ID and post_parent set. For
 * terms and users, ID is the term or user ID and post_parent is 0. For bad
 * inputs, returns 0 and 0.
 */
function relevanssi_return_id_parent($post_object)
{
}
/**
 * Returns an ID=>type object from a post (or a term, or a user).
 *
 * @param WP_Post|WP_Term|WP_User $post_object The source object.
 *
 * @return object An object with the attributes ID and type set. Type is
 * 'post', 'user', 'term' or 'post_type'. For terms, also fills in 'taxonomy',
 * for post types 'name'.
 */
function relevanssi_return_id_type($post_object)
{
}
/**
 * Returns "off".
 *
 * Useful for returning "off" to filters easily.
 *
 * @return string A string with value "off".
 */
function relevanssi_return_off()
{
}
/**
 * Returns "OR".
 *
 * @return string A string with value "OR".
 */
function relevanssi_return_or()
{
}
/**
 * Gets a post object, returns ID, ID=>parent or the post object.
 *
 * @uses relevanssi_return_id_type()   Used to return ID=>type results.
 * @uses relevanssi_return_id_parent() Used to return ID=>parent results.
 *
 * @param object $post         The post object.
 * @param string $return_value The value to return, possible values are 'id'
 * for returning the ID and 'id=>parent' for returning the ID=>parent object,
 * otherwise the post object is returned.
 *
 * @return int|object|WP_Post The post object in the desired format.
 */
function relevanssi_return_value($post, string $return_value)
{
}
/**
 * Sanitizes hex color strings.
 *
 * A copy of sanitize_hex_color(), because that isn't always available.
 *
 * @param string $color A hex color string to sanitize.
 *
 * @return string Sanitized hex string, or an empty string.
 */
function relevanssi_sanitize_hex_color(string $color)
{
}
/**
 * Returns 'selected' if the option matches a value.
 *
 * @param string $option Value to check.
 * @param string $value  The 'selected' value.
 *
 * @return string If the option matches the value, returns 'selected', otherwise
 * returns an empty string.
 */
function relevanssi_select(string $option, string $value)
{
}
/**
 * Strips all tags from content, keeping non-tags that look like tags.
 *
 * Strips content that matches <[!a-zA-Z\/]*> to remove HTML tags and HTML
 * comments, but not things like "<30 grams, 4>1".
 *
 * @param string $content The content.
 *
 * @return string The content with tags stripped.
 */
function relevanssi_strip_all_tags($content) : string
{
}
/**
 * Strips invisible elements from text.
 *
 * Strips <style>, <script>, <object>, <embed>, <applet>, <noscript>, <noembed>,
 * <iframe> and <del> tags and their contents and comments from the text.
 *
 * @param string $text The source text.
 *
 * @return string The processed text.
 */
function relevanssi_strip_invisibles($text)
{
}
/**
 * Strips tags from contents, keeping the allowed tags.
 *
 * The allowable tags are read from the relevanssi_excerpt_allowable_tags
 * option. Relevanssi also adds extra spaces after some tags to make sure words
 * are not stuck together after the tags are removed. The function also removes
 * invisible content.
 *
 * @uses relevanssi_strip_invisibles() Used to remove scripts and other tags.
 * @see  strip_tags()                  Used to remove tags.
 *
 * @param string|null $content The content.
 *
 * @return string The content without tags.
 */
function relevanssi_strip_tags($content)
{
}
/**
 * Returns the position of substring in the string.
 *
 * Uses mb_stripos() if possible, falls back to mb_strpos() and mb_strtoupper()
 * if that cannot be found, and falls back to just strpos() if even that is not
 * possible.
 *
 * @param string $haystack String where to look.
 * @param string $needle   The string to look for.
 * @param int    $offset   Where to start, default 0.
 *
 * @return mixed False, if no result or $offset outside the length of $haystack,
 * otherwise the position (which can be non-false 0!).
 */
function relevanssi_stripos($haystack, $needle, int $offset = 0)
{
}
/**
 * Returns the length of the string.
 *
 * Uses mb_strlen() if available, otherwise falls back to strlen().
 *
 * @param string $s The string to measure.
 *
 * @return int The length of the string.
 */
function relevanssi_strlen($s)
{
}
/**
 * Multibyte friendly strtolower.
 *
 * If multibyte string functions are available, returns mb_strtolower() and
 * falls back to strtolower() if multibyte functions are not available.
 *
 * @param string $str The string to lowercase.
 *
 * @return string $str The string in lowercase.
 */
function relevanssi_strtolower($str)
{
}
/**
 * Multibyte friendly substr.
 *
 * If multibyte string functions are available, returns mb_substr() and falls
 * back to substr() if multibyte functions are not available.
 *
 * @param string   $str The source string.
 * @param int      $start  If start is non-negative, the returned string will
 * start at the start'th position in str, counting from zero. If start is
 * negative, the returned string will start at the start'th character from the
 * end of string.
 * @param int|null $length Maximum number of characters to use from string. If
 * omitted or null is passed, extract all characters to the end of the string.
 *
 * @return string $str The string in lowercase.
 */
function relevanssi_substr($str, int $start, $length = \null)
{
}
/**
 * Prints out the post excerpt.
 *
 * Prints out the post excerpt from $post->post_excerpt, unless the post is
 * protected. Only works in the Loop.
 *
 * @see post_password_required() Used to check for password requirements.
 *
 * @global $post The global post object.
 */
function relevanssi_the_excerpt()
{
}
/**
 * Echoes out the permalink to the current post within Loop.
 *
 * Uses get_permalink() to get the permalink, then adds the 'highlight'
 * parameter if necessary using relevanssi_add_highlight(), then echoes it out.
 *
 * @param int|WP_Post $post Post ID or post object. Default is the global $post.
 *
 * @uses relevanssi_get_permalink() Fetches the current post permalink.
 */
function relevanssi_the_permalink($post = 0)
{
}
/**
 * Prints out a list of tags for post.
 *
 * Replacement for the_tags() that does the same, but applies Relevanssi search term
 * highlighting on the results.
 *
 * @param string  $before    What is printed before the tags, default ''.
 * @param string  $separator The separator between items, default ', '.
 * @param string  $after     What is printed after the tags, default ''.
 * @param boolean $echoed    If true, echo, otherwise return the result. Default true.
 * @param int     $post_id   The post ID. Default current post ID (in the Loop).
 */
function relevanssi_the_tags(string $before = '', string $separator = ', ', string $after = '', bool $echoed = \true, int $post_id = 0)
{
}
/**
 * Prints out post title with highlighting.
 *
 * Uses the global $post object. Reads the highlighted title from
 * $post->post_highlighted_title. This used to accept one parameter, the
 * `$echo` boolean, but in 2.12.3 / 4.10.3 the function signature was matched
 * to copy `the_title()` function in WordPress core. The original behaviour is
 * still supported: `relevanssi_the_title()` without arguments works exactly as
 * before and `relevanssi_the_title( false )` returns the title.
 *
 * @global object $post The global post object.
 *
 * @param boolean|string $before Markup to prepend to the title. Can also be a
 * boolean for whether to echo or return the title.
 * @param string         $after  Markup to append to the title.
 * @param boolean        $echoed   Whether to echo or return the title. Default
 * true for echo.
 *
 * @return void|string Void if $echoed argument is true, current post title with
 * highlights if $echoed is false.
 */
function relevanssi_the_title($before = \true, string $after = '', bool $echoed = \true)
{
}
/**
 * Turns off options, ie. sets them to "off".
 *
 * If the specified options don't exist in the request array, they are set to
 * "off".
 *
 * @param array $request The _REQUEST array, passed as reference.
 * @param array $options An array of option names.
 */
function relevanssi_turn_off_options(array &$request, array $options)
{
}
/**
 * Sets an option after doing floatval.
 *
 * @param array   $request  An array of option values.
 * @param string  $option   The key to check.
 * @param boolean $autoload Should the option autoload, default true.
 * @param float   $def_val  The default value if floatval() fails, default 0.
 * @param boolean $positive If true, replace negative values and zeroes with
 * $def_val.
 */
function relevanssi_update_floatval(array $request, string $option, bool $autoload = \true, float $def_val = 0, bool $positive = \false)
{
}
/**
 * Sets an option after doing intval.
 *
 * @param array   $request  An array of option values.
 * @param string  $option   The key to check.
 * @param boolean $autoload Should the option autoload, default true.
 * @param int     $def_val  The default value if intval() fails, default 0.
 */
function relevanssi_update_intval(array $request, string $option, bool $autoload = \true, int $def_val = 0)
{
}
/**
 * Sets an option with one of the listed legal values.
 *
 * @param array   $request  An array of option values.
 * @param string  $option   The key to check.
 * @param array   $values   The legal values.
 * @param string  $def_val  The default value.
 * @param boolean $autoload Should the option autoload, default true.
 */
function relevanssi_update_legal_value(array $request, string $option, array $values, string $def_val, bool $autoload = \true)
{
}
/**
 * Sets an on/off option according to the request value.
 *
 * @param array   $request  An array of option values.
 * @param string  $option   The key to check.
 * @param boolean $autoload Should the option autoload, default true.
 */
function relevanssi_update_off_or_on(array $request, string $option, bool $autoload = \true)
{
}
/**
 * Sets an option after sanitizing and unslashing the value.
 *
 * @param array   $request  An array of option values.
 * @param string  $option   The key to check.
 * @param boolean $autoload Should the option autoload, default true.
 */
function relevanssi_update_sanitized(array $request, string $option, bool $autoload = \true)
{
}
/**
 * Returns true if $_SERVER['HTTP_USER_AGENT'] is on the bot block list.
 *
 * Looks for bot user agents in the $_SERVER['HTTP_USER_AGENT'] and returns true
 * if a match is found.
 *
 * @return bool True if $_SERVER['HTTP_USER_AGENT'] is a bot.
 */
function relevanssi_user_agent_is_bot() : bool
{
}
/**
 * Validates that the parameter is a valid taxonomy type.
 *
 * @parameter string $taxonomy The taxonomy to validate.
 *
 * @return string The validated taxonomy, empty string if invalid.
 */
function relevanssi_validate_taxonomy($taxonomy)
{
}