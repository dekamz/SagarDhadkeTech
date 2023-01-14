<?php

/**
 * Functions to register client-side assets (scripts and stylesheets) for the
 * Gutenberg block.
 *
 * @package essential-blocks
 */

/**
 * Registers all block assets so that they can be enqueued through Gutenberg in
 * the corresponding context.
 *
 * @see https://wordpress.org/gutenberg/handbook/designers-developers/developers/tutorials/block-tutorial/applying-styles-with-stylesheets/
 */

function post_grid_block_init()
{
	// Skip block registration if Gutenberg is not enabled/merged.
	if (!function_exists('register_block_type')) {
		return;
	}

	$dir = dirname(__FILE__);

	$frontend_dependencies = include_once ESSENTIAL_BLOCKS_DIR_PATH . 'blocks/post-grid/frontend/index.asset.php';
	//  Frontend Script
	$frontEnd_js = 'post-grid/frontend/index.js';
	wp_register_script(
		'essential-blocks-post-grid-frontend',
		ESSENTIAL_BLOCKS_ADMIN_URL . 'blocks/post-grid/frontend/index.js',
		$frontend_dependencies['dependencies'],
		EssentialAdmin::get_version($dir . "/" . $frontEnd_js),
		true
	);

	register_block_type(
		EssentialBlocks::get_block_register_path("post-grid"),
		array(
			'editor_script' => 'essential-blocks-editor-script',
			'editor_style'    	=> ESSENTIAL_BLOCKS_NAME . '-editor-css',
			'render_callback' => 'render_block_eb_post_grid_block',
		)
	);
}
add_action('init', 'post_grid_block_init');

if (!function_exists('eb_post_grid_get_posts_api_callback')) {

	// Create API Endpoint for
	add_action('rest_api_init', function () {
		register_rest_route('eb-post-grid/v1', '/queries', array(
			'methods'  => 'GET',
			'callback' => 'eb_post_grid_get_posts_api_callback',
			'permission_callback' => function () {
				return true;
			}
		));
	});

	function eb_post_grid_get_posts_api_callback($request)
	{
		$query = unserialize($request['query_data']);
		$attributes = unserialize($request['attributes']);
		$pageNumber = isset($request['pageNumber']) ? (int)$request['pageNumber'] - 1 : 1;

		if (isset($query['per_page']) && isset($query['offset'])) {
			$query['offset'] = (int)$query['offset'] + ((int)$query['per_page'] * (int)$pageNumber);
		}

		if (isset($request["taxonomy"]) && isset($request["category"])) {
			$category = get_term_by('slug', $request["category"], $request["taxonomy"]);
			$catString = json_encode(array(array(
				"label" => $category->name,
				"value" => $category->term_id,
			)));
			$filterQuery = array(
				$request["taxonomy"] => array(
					"name" => $request["category"],
					"slug" => $request["category"],
					"value" => $catString
				)
			);
			$query["taxonomies"] = $filterQuery;
		}

		if (isset($request["query_type"]) && $request["query_type"] === "filter") {
			$query['offset'] = 0;
		}

		$queryResult = eb_post_grid_query($query, true);

		if (count($queryResult) > 0) {
			$posts_markup = eb_post_grid_markup($attributes, $queryResult);
			return $posts_markup;
		} else {
			return sprintf(
				'<div class="ebpg-grid-post">No more %1$s</div>',
				$query["source"] ? $query["source"] : "Posts"
			);
		}

		wp_die();
	}
}

//Render Callback Function
if (!function_exists('render_block_eb_post_grid_block')) {
	function render_block_eb_post_grid_block($attributes)
	{
		if (!is_admin()) {
			//Enqueue Styles
			wp_enqueue_style('essential-blocks-frontend-style');
			wp_enqueue_script('essential-blocks-post-grid-frontend');

			$queryData = $attributes["queryData"];

			//Query Result
			$query = eb_post_grid_query($queryData);

			$attributes = wp_parse_args(
				$attributes,
				[
					'preset' => 'style-1',
					'showThumbnail' => true,
					'thumbnailSize' => '',
					'showTitle' => true,
					'titleLength' => '',
					'titleTag' => 'h2',
					'showContent' => true,
					'contentLength' => 20,
					'expansionIndicator' => '...',
					'showReadMore' => false,
					'readmoreText' => 'Read More',
					'showMeta' => true,
					'loadMoreOptions' => false,
					'showTaxonomyFilter' => false,
					'headerMeta' => '[{"value":"categories","label":"Categories"}]',
					'footerMeta' => '[{"value":"avatar","label":"Author Avatar"},{"value":"author","label":"Author Name"},{"value":"date","label":"Published Date"}]',
				]
			);

			$className = isset($attributes["className"]) ? $attributes["className"] : "";

			$essentialAttr = array(
				'headerMeta' => $attributes["headerMeta"],
				'footerMeta' => $attributes["footerMeta"],
				'showMeta' => $attributes["showMeta"],
				'preset' => $attributes["preset"],
				'showThumbnail' => $attributes["showThumbnail"],
				'showTitle' => $attributes["showTitle"],
				'titleLength' => $attributes["titleLength"],
				'titleTag' => $attributes["titleTag"],
				'showContent' => $attributes["showContent"],
				'contentLength' => $attributes["contentLength"],
				'expansionIndicator' => $attributes["expansionIndicator"],
				'showReadMore' => $attributes["showReadMore"],
				'readmoreText' => $attributes["readmoreText"],
				'thumbnailSize' => $attributes["thumbnailSize"],
			);

			$classHook = isset($attributes['classHook']) ? $attributes['classHook'] : '';

			//HTML Wrapper Parent Start
			$html = sprintf(
				'<div class="eb-parent-wrapper eb-parent-%1$s %2$s">',
				$attributes["blockId"],
				$classHook
			);

			//HTML Wrapper Start
			$html .= sprintf(
				'<div class="eb-post-grid-wrapper %1$s %2$s %3$s" data-id="%1$s" data-querydata=\'%4$s\' data-attributes=\'%5$s\'>',
				$attributes["blockId"],
				$attributes["preset"],
				$className,
				serialize($queryData),
				serialize($essentialAttr)
			);

			//Category Filter
			if ($attributes["showTaxonomyFilter"] && isset($attributes["selectedTaxonomy"]) && isset($attributes["selectedTaxonomyItems"])) {
				$selectedTaxonomy = strlen($attributes["selectedTaxonomy"]) > 0 ? json_decode($attributes["selectedTaxonomy"]) : "";
				$categories = strlen($attributes["selectedTaxonomyItems"]) > 0 ? json_decode($attributes["selectedTaxonomyItems"]) : "";

				//Gather All Filterable Categories
				$catHtml = "";
				foreach ($categories as $cat) {
					$activeClass = $cat->value === "all" ? "active" : "";
					$catHtml .= sprintf(
						'<li class="ebpg-category-filter-list-item %1$s" data-ebpgCategory="%2$s">%3$s</li>',
						$activeClass,
						$cat->value,
						$cat->label
					);
				}

				$html .= sprintf(
					'<div class="eb-post-grid-category-filter" data-ebpgTaxonomy="%1$s">',
					$selectedTaxonomy->value
				);
				$html .= '<ul class="ebpg-category-filter-list">';
				$html .= $catHtml;
				$html .= '</ul></div>';
			}

			//Posts Markup
			$html .= eb_post_grid_markup($attributes, $query);

			if (count($query) === 0) {
				$html .= '<p>No Posts Found</p>';
			}

			// Pagination
			if (count($query) > 0) {
				$pagination = $attributes["loadMoreOptions"];
				if (isset($pagination['totalPosts']) && (int)$pagination['totalPosts'] > (int)$queryData['per_page']) {
					if (is_array($pagination) && isset($pagination['enableMorePosts']) && $pagination['enableMorePosts']) {

						$html .= sprintf(
							'<div class="ebpg-pagination %1$s">',
							$pagination['loadMoreType'] === '3' ? "prev-next-btn" : ""
						);

						if ($pagination['loadMoreType'] === '1') {
							$html .= sprintf(
								'<button class="btn ebpg-pagination-button" data-pagenumber="1">
								%1$s
							</button>',
								$pagination['loadMoreButtonTxt']
							);
						}

						$prevTxt = isset($pagination['prevTxt']) ? $pagination['prevTxt'] : "<";
						$nextTxt = isset($pagination['nextTxt']) ? $pagination['nextTxt'] : ">";

						if (isset($pagination['totalPosts']) && ($pagination['loadMoreType'] === '2' || $pagination['loadMoreType'] === '3')) {
							$totalPages = ceil((int)$pagination['totalPosts'] / (int)$queryData['per_page']);
							$html .= sprintf(
								'<button class="ebpg-pagination-item-previous">
								%1$s
							</button>',
								esc_html__($prevTxt)
							);
							for ($i = 1; $i <= $totalPages; $i++) {
								$active = $i == 1 ? "active" : "";

								$html .= sprintf(
									'<button class="ebpg-pagination-item %2$s" data-pagenumber="%1$s">
									%1$s
								</button>',
									$i,
									$active
								);
							}
							$html .= sprintf(
								'<button class="ebpg-pagination-item-next">
								%1$s
							</button>',
								esc_html__($nextTxt)
							);
						}

						$html .= '</div>';
					}
				}
			}

			$html .= '</div>'; //HTML Wrapper End
			$html .= '</div>'; //HTML Wrapper Parent End

			return $html;

			// Reset the `$post` data to the current post in main query.
			wp_reset_postdata();
		}
	}
}

//Limit Word Function
if (!function_exists('eb_trunc')) {
	function eb_trunc($phrase, $max_words)
	{
		$phrase_array = explode(' ', $phrase);
		if (count($phrase_array) > $max_words && $max_words >= 0)
			$phrase = implode(' ', array_slice($phrase_array, 0, $max_words));
		return strip_shortcodes($phrase);
	}
}

//This Function will return Query Result
if (!function_exists('eb_post_grid_query')) {
	function eb_post_grid_query($queryData, $isAjax = false)
	{
		if ($queryData['source'] === "posts") {
			$queryData['source'] = "post";
		}
		$args = array(
			'post_type'			=> $queryData['source'],
			'posts_per_page'	=> (int)$queryData['per_page'],
			'order'				=> $queryData['order'],
			'orderby'			=> $queryData['orderby'],
			'offset' 			=> $queryData['offset'],
		);

		if ($queryData['orderby'] == "id") {
			$args['orderby'] = "ID";
		}

		if (isset($queryData['taxonomies']) && is_array($queryData['taxonomies']) && count($queryData['taxonomies']) > 0) {

			$tax_query = array();
			foreach ($queryData['taxonomies'] as $taxonomy_key => $taxonomy) {

				//If Taxonomoy is array and has value
				if (is_array($taxonomy) && count($taxonomy) > 0 && isset($taxonomy["value"])) {
					$tax_value_obj = json_decode($taxonomy["value"]); //decode value from json strong to array
					$tax_values = array();

					//If value is Array and has value, push the value to $tax_values array
					if (is_array($tax_value_obj) && count($tax_value_obj) > 0) {
						foreach ($tax_value_obj as $tax_item) {
							array_push($tax_values, $tax_item->value);
						}

						//Push taxonomy array to $tax_query
						array_push($tax_query, array(
							'taxonomy' => $taxonomy_key,
							'field'    => 'id',
							'terms'    => $tax_values
						));
					}
				}
			}

			if (count($tax_query) > 0) {
				$args['tax_query'] = $tax_query;
			}
		}
		//For Old Query Data [Beofre 3.9.0]
		else {
			if (isset($queryData['categories']) && strlen($queryData['categories']) > 0) {
				$catJsonDecode = json_decode($queryData['categories']);
				$catArray = array();
				if (is_array($catJsonDecode)) {
					foreach ($catJsonDecode as $item) {
						array_push($catArray, $item->value);
					}
				}
				$args['category__in'] = $catArray;
			}

			if (isset($queryData['tags']) && strlen($queryData['tags']) > 0) {
				$tagJsonDecode = json_decode($queryData['tags']);
				$tagArray = array();
				foreach ($tagJsonDecode as $item) {
					array_push($tagArray, $item->value);
				}
				$args['tag__in'] = $tagArray;
			}
		}


		if (isset($queryData['author']) && strlen($queryData['author']) > 0) {
			$authorJsonDecode = json_decode($queryData['author']);
			$authorArray = array();
			foreach ($authorJsonDecode as $item) {
				array_push($authorArray, $item->value);
			}
			$args['author__in'] = $authorArray;
		}

		if (isset($queryData['include']) && strlen($queryData['include']) > 0) {
			$includeJsonDecode = json_decode($queryData['include']);
			$includeArray = array();
			foreach ($includeJsonDecode as $item) {
				array_push($includeArray, $item->value);
			}
			$args['post__in'] = $includeArray;
		}

		if (isset($queryData['exclude']) && strlen($queryData['exclude']) > 0) {
			$excludeJsonDecode = json_decode($queryData['exclude']);
			$excludeArray = array();
			foreach ($excludeJsonDecode as $item) {
				array_push($excludeArray, $item->value);
			}
			$args['exclude'] = $excludeArray;
		}

		if (isset($queryData['exclude_current']) && $queryData['exclude_current']) {
			$post_id = get_the_ID();
			if ($isAjax) {
				$url     = wp_get_referer();
				$post_id = url_to_postid($url);
			}
			
			if (isset($args['exclude']) && count($args['exclude']) > 0 && !in_array($post_id, $args['exclude'])) {
				array_push($args['exclude'], $post_id);
			} else {
				$args['exclude'] = array($post_id);
			}
		}

		return get_posts($args);
	}
}

if (!function_exists('eb_post_grid_markup')) {
	function eb_post_grid_markup($attributes, $posts)
	{
		//Get Taxonomies by Post Type
		$queryData = isset($attributes["queryData"]) ? $attributes["queryData"] : array();
		$source = isset($queryData['source']) ? $queryData['source'] : 'post';
		$taxonomies = get_object_taxonomies($source);

		$html = "";
		foreach ($posts as $result) {
			//Get Header and Footer Meta
			$headerMetaString = strlen($attributes["headerMeta"]) > 0 ? json_decode($attributes["headerMeta"]) : "";
			$headerMeta = array();
			if (is_array($headerMetaString)) {
				foreach ($headerMetaString as $item) {
					array_push($headerMeta, $item->value);
				}
			}
			$footerMetaString = strlen($attributes["footerMeta"]) > 0 ? json_decode($attributes["footerMeta"]) : "";
			$footerMeta = array();
			if (is_array($footerMetaString)) {
				foreach ($footerMetaString as $item) {
					array_push($footerMeta, $item->value);
				}
			}
			$allMeta = array_merge($headerMeta, $footerMeta);

			$tax_meta = array_intersect($allMeta, $taxonomies);

			$tax_meta_html = array();
			if (count($tax_meta) > 0) {
				foreach ($tax_meta as $item) {
					$term_obj_list = get_the_terms($result->ID, $item);
					$tax_item_html = "";

					$item_class = $item;
					if ($item === "category") {
						$item_class = "categories";
					} else if ($item === "post_tag") {
						$item_class = "tags";
					}

					if (is_array($term_obj_list) && count($term_obj_list) > 0) {
						$tax_item_html .= sprintf(
							'<div class="ebpg-meta ebpg-%1$s-meta">',
							$item_class
						);
						foreach ($term_obj_list as $term) {
							$tax_item_html .= sprintf(
								'<a href="%1$s" title="%2$s">%2$s</a>',
								esc_attr(esc_url(get_term_link($term->term_id))),
								esc_html($term->name)
							);
						}
						$tax_item_html .= '</div>';
					}
					$tax_meta_html[$item] = $tax_item_html;
				}
			}

			//Author HTML
			$authorId = $result->post_author;
			$author = "";
			if (in_array("author", $allMeta)) {
				$authorName = esc_html(get_the_author_meta('display_name', $authorId));
				$authorUrl = esc_url(get_author_posts_url(get_the_author_meta('ID', $authorId)));
				$author .= sprintf(
					'<span class="ebpg-posted-by">
					by <a href="%2$s" title="%1$s" rel="author">%1$s</a>
				</span>',
					$authorName,
					$authorUrl
				);
			}

			//Avatar HTML
			$authorId = $result->post_author;
			$avatar = "";
			if (in_array("avatar", $allMeta)) {
				$authorName = esc_html(get_the_author_meta('display_name', $authorId));
				$authorUrl = esc_url(get_author_posts_url(get_the_author_meta('ID', $authorId)));
				$authorAvatar = get_avatar_url($authorId, ['size' => '96']);
				$avatar .= sprintf(
					'<div class="ebpg-author-avatar">
					<a href="%1$s">
						<img
							alt="%2$s"
							src="%3$s"
						/>
					</a>
				</div>',
					$authorUrl,
					$authorName,
					$authorAvatar
				);
			}

			//Date HTML
			$date = "";
			if (in_array("date", $allMeta)) {
				$date .= sprintf(
					'<span class="ebpg-posted-on">
					on <time dateTime="%1$s">%2$s</time>
				</span>',
					esc_attr(get_the_date('c', $result)),
					esc_html(get_the_date('', $result))
				);
			}

			//Category HTML
			$categories = "";
			if (in_array("categories", $allMeta)) {
				$catArray = wp_get_post_categories($result->ID, array('fields' => 'all'));
				if (is_array($catArray) && count($catArray) > 0) {
					$categories .= '<div class="ebpg-meta ebpg-categories-meta">';
					foreach ($catArray as $cat) {
						$categories .= sprintf(
							'<a href="%1$s" title="%2$s">%2$s</a>',
							esc_attr(esc_url(get_category_link($cat->term_id))),
							esc_html($cat->name)
						);
					}
					$categories .= '</div>';
				}
			}

			//Tags HTML
			$tags = "";
			if (in_array("tags", $allMeta)) {
				$tagArray = get_the_tags($result->ID);
				if (is_array($tagArray) && count($tagArray) > 0) {
					$tags .= '<div class="ebpg-meta ebpg-tags-meta">';
					foreach ($tagArray as $tag) {
						$tags .= sprintf(
							'<a href="%1$s" title="%2$s">%2$s</a>',
							esc_attr(esc_url(get_tag_link($tag->term_id))),
							esc_html($tag->name)
						);
					}
					$tags .= '</div>';
				}
			}

			//Read Time HTML
			$calcReadTime = EBHelpers::eb_calc_read_time($result->post_content);
			$readtime = "";
			if (in_array("readtime", $allMeta)) {
				//Enqueue FontAwesome for Time Icon
				wp_enqueue_style(
					'eb-fontawesome-frontend',
					plugins_url('assets/css/font-awesome5.css', dirname(__FILE__)),
					array(),
					ESSENTIAL_BLOCKS_VERSION,
					'all'
				);
				$readtime .= sprintf(
					'<span class="ebpg-read-time"><i class="fas fa-clock"></i>%1$s %2$s read</span>',
					$calcReadTime,
					$calcReadTime > 1 ? 'minutes' : 'minute'
				);
			}

			//Final Header HTML
			$headerMetaHtml = "";
			if ($attributes["showMeta"]) {
				if (in_array("avatar", $headerMeta)) {
					$headerMetaHtml .= $avatar;
				}
				$headerMetaHtml .= '<div class="ebpg-entry-meta-items">';
				foreach ($headerMeta as $meta) {
					if (in_array($meta, $tax_meta)) {
						$headerMetaHtml .= $tax_meta_html[$meta];
					} else if (isset(${$meta}) && $meta != "avatar") {
						$headerMetaHtml .= ${$meta};
					}
				}
				$headerMetaHtml .= '</div>';
			}

			//Final Footer HTML
			$footerMetaHtml = "";
			if ($attributes["showMeta"]) {
				if (in_array("avatar", $footerMeta)) {
					$footerMetaHtml .= $avatar;
				}
				$footerMetaHtml .= '<div class="ebpg-entry-meta-items">';
				foreach ($footerMeta as $meta) {
					if (in_array($meta, $tax_meta)) {
						$footerMetaHtml .= $tax_meta_html[$meta];
					} else if ($meta != "avatar") {
						$footerMetaHtml .= ${$meta};
					}
				}
				$footerMetaHtml .= '</div>';
			}

			$html .= sprintf('<article class="ebpg-grid-post ebpg-post-grid-column" data-id="%1$s">', $result->ID);
			$html .= '<div class="ebpg-grid-post-holder">';
			$wrapper_link_html = sprintf('<a class="ebpg-post-link-wrapper" href="%1$s"></a>', get_permalink($result->ID));
			if ($attributes["preset"] === "style-5") {
				$html .= $wrapper_link_html;
				$wrapper_link_html = "";
			}

			//Post Thumbnail
			if ($attributes["showThumbnail"]) {
				$thumbnail = get_the_post_thumbnail($result->ID, $attributes['thumbnailSize']);
				if (!empty($thumbnail)) {
					$html .= sprintf(
						'<div class="ebpg-entry-media">
						<div class="ebpg-entry-thumbnail">
							%1$s
							%2$s
						</div>
					</div>',
						$wrapper_link_html,
						$thumbnail
					);
				} else {
					$html .= '
				<div class="ebpg-entry-media">
					<div class="ebpg-entry-thumbnail">
						<img src="https://via.placeholder.com/250x250.png" alt="No Thumbnail Found">
					</div>
				</div>';
				}
			}

			$html .= '<div class="ebpg-entry-wrapper">';

			//Post Title
			if ($attributes["showTitle"]) {
				$ebpg_title = wp_kses($result->post_title, 'post');
				if (!empty($attributes["titleLength"])) {
					$ebpg_title = eb_trunc($ebpg_title, $attributes["titleLength"]);
					// var_dump($ebpg_title);
				}
				$html .= sprintf(
					'<header class="ebpg-entry-header">
					<%1$s class="ebpg-entry-title">
						<a class="ebpg-grid-post-link" href="%2$s" title="%3$s">%4$s</a>
					</%1$s>
				</header>',
					$attributes["titleTag"],
					get_permalink($result->ID),
					esc_attr($ebpg_title),
					$ebpg_title
				);
			}
			$html .= '';
			$html .= '';

			$html .= '</h2>';
			$html .= '</header>';

			//Header Meta
			$html .= sprintf(
				'<div class="ebpg-entry-meta ebpg-header-meta">%1$s</div>',
				$headerMetaHtml
			);

			$html .= '<div class="ebpg-entry-content">';
			//Post Excerpt
			if ($attributes["showContent"]) {
				if (!empty($result->post_excerpt)) {
					$post_content = wp_kses_post(strip_tags($result->post_excerpt));
				} else {
					$post_content = wp_kses_post(strip_tags($result->post_content));
				}
				$content = eb_trunc($post_content, $attributes["contentLength"]);

				$html .= sprintf(
					'<div class="ebpg-grid-post-excerpt">
					<p>%1$s%2$s</p>
				</div>',
					$content,
					$attributes["expansionIndicator"]
				);
			}

			if ($attributes["showReadMore"]) {
				$html .= sprintf(
					'<div class="ebpg-readmore-btn">
					<a href="%1$s">%2$s</a>
				</div>',
					get_permalink($result->ID),
					$attributes["readmoreText"]
				);
			}

			$html .= '</div>';

			//Footer Meta
			$html .= sprintf(
				'<div class="ebpg-entry-meta ebpg-footer-meta">%1$s</div>',
				$footerMetaHtml
			);

			$html .= '</div>'; //End of class "ebpg-entry-wrapper"
			$html .= '</div>'; //End of class "ebpg-grid-post-holder"
			$html .= '</article>';
		}
		return $html;
	}
}
