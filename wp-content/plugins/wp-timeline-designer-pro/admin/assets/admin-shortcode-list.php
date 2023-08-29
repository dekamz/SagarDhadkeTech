<?php
/**
 * Admin Import Form.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

/**
 * To Import Layout.
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wpdb;
$paged_no = filter_input( INPUT_GET, 'paged' ) ? absint( filter_input( INPUT_GET, 'paged' ) ) : 1;
if ( ! is_numeric( $paged_no ) ) {
	$paged_no = 1;
}
$limit         = 10;
$user          = get_current_user_id();
$screen        = get_current_screen();
$screen_option = $screen->get_option( 'per_page', 'option' );
$limit         = get_user_meta( $user, $screen_option, true );
if ( empty( $limit ) || $limit < 1 ) {
	// get the default value if none is set.
	$limit = $screen->get_option( 'per_page', 'default' );
}
$offset        = ( $paged_no - 1 ) * $limit;
$where         = '';
$searched_data = '';
if ( isset( $_REQUEST['s'] ) && '' != $_REQUEST['s'] ) {
	$searched_data = esc_attr( sanitize_text_field( wp_unslash( $_REQUEST['s'] ) ) );
	$where         = "WHERE shortcode_name LIKE '%$searched_data%'";
}

if ( isset( $_POST['btnSearchShortcode'] ) || ( isset( $_POST['s'] ) && '' != $_POST['s'] ) ) {
	$delete_action = '';
	if ( isset( $_POST['take_action'] ) && isset( $_POST['wtl-action-top'] ) ) {
		$delete_action = 'multiple_delete';
	}
	?>
	<script type="text/javascript">
		"use strict";
		var paged = '<?php echo esc_html( $paged_no ); ?>';
		var s = ['<?php echo esc_html( $searched_data ); ?>'];
		var action = ['<?php echo esc_html( $delete_action ); ?>'];
		window.location.pushState({ path: document.location.href }, '', document.location.href + "&paged=" + paged + "&s=" + s + "&action=" + action);
	</script>
	<?php
}
$ord = 0;
if ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) && 0 == $_REQUEST['order'] ) {
	$order_by    = 'desc';
	$ord         = 1;
	$order_field = 'shortcode_name';
} elseif ( isset( $_REQUEST['orderby'] ) && isset( $_REQUEST['order'] ) && 1 == $_REQUEST['order'] ) {
	$order_by    = 'asc';
	$ord         = 0;
	$order_field = 'shortcode_name';
} else {
	$order_by    = 'desc';
	$order_field = 'wtlid';
}


$total        = $wpdb->get_var( 'SELECT COUNT(`wtlid`) FROM ' . $wpdb->prefix . 'wtl_shortcodes ' . $where );
$num_of_pages = ceil( $total / $limit );

$next_page = (int) $paged_no + 1;

if ( $next_page > $num_of_pages ) {
	$next_page = $num_of_pages;
}

$prev_page = (int) $paged_no - 1;

if ( $prev_page < 1 ) {
	$prev_page = 1;
}

// Get the shortcode information.
$shortcodes = $wpdb->get_results( 'SELECT * FROM ' . $wpdb->prefix . 'wtl_shortcodes ' . $where . ' order by ' . $order_field . ' ' . $order_by . ' limit ' . $offset . ', ' . $limit );
?>
<div class="wp-timeline-admin wrap wp-timeline-shortcode-list">
	<?php
	if ( isset( $_GET['action'] ) && 'delete' === $_GET['action'] && isset( $_GET['id'] ) && ! empty( $_GET['id'] ) && isset( $_GET['page'] ) && 'layouts' === $_GET['page'] && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) ) ) {
		?>
		<div class="updated"><p><?php esc_html_e( 'Layout deleted successfully.', 'wp-timeline-designer-pro' ); ?></p></div>
		<?php
	}
	if ( isset( $_POST['wtl-action-top'] ) && 'delete_pr' === esc_html( sanitize_text_field( wp_unslash( $_POST['wtl-action-top'] ) ) ) ) {
		if ( isset( $_POST['chk_remove_all'] ) && ! empty( $_POST['chk_remove_all'] ) ) {
			?>
			<div class="updated"><p><?php esc_html_e( 'Layouts are deleted successfully.', 'wp-timeline-designer-pro' ); ?></p></div>
			<?php
		}
	}
	if ( isset( $_GET['msg'] ) || ( isset( $_GET['action'] ) ) && 'multiple_delete' === $_GET['action'] ) {
		?>
		<div class="updated">
			<p>
				<?php
				if ( isset( $_GET['action'] ) && 'multiple_delete' === $_GET['action'] ) {
					esc_html_e( 'Layouts are deleted successfully.', 'wp-timeline-designer-pro' );
				}
				if ( isset( $_GET['msg'] ) && 'added' === $_GET['msg'] ) {
					esc_html_e( 'Designer Settings Added.', 'wp-timeline-designer-pro' );
				}
				if ( isset( $_GET['msg'] ) && 'updated' === $_GET['msg'] ) {
					esc_html_e( 'Designer Settings updated.', 'wp-timeline-designer-pro' );
				}
				?>
			</p>
		</div>
	<?php } ?>
	<!-- Create new Shortcode button -->
	<h1>
		<?php esc_html_e( 'Layouts', 'wp-timeline-designer-pro' ); ?>
		<a class="page-title-action" href="?page=add_wtl_shortcode"><?php esc_html_e( 'Create New Layout', 'wp-timeline-designer-pro' ); ?></a>
	</h1>
	<form method="post">
		<ul class="subsubsub">
			<li class="all">
				<a class="current" href="?page=wtl_layouts"><?php esc_html_e( 'All', 'wp-timeline-designer-pro' ); ?>
					<span class="count">(
					<?php
					if ( $total > 0 ) {
						echo esc_html( $total );
					} else {
						echo '0';
					}
					?>
						)
					</span>
				</a>
			</li>
		</ul>
		<p class="search-box">
			<input id="shortcode-search-input" type="search" value="<?php echo esc_html( $searched_data ); ?>" name="s">
			<input id="search-submit" class="button" type="submit" name="btnSearchShortcode" value="<?php esc_attr_e( 'Search Layout', 'wp-timeline-designer-pro' ); ?>">
		</p>
		<div class="tablenav top">
			<select name="wtl-action-top">
				<option selected="selected" value="none"><?php esc_html_e( 'Bulk Actions', 'wp-timeline-designer-pro' ); ?></option>
				<option value="delete_pr"><?php esc_html_e( 'Delete Permanently', 'wp-timeline-designer-pro' ); ?></option>
				<option value="wtl_export"><?php esc_html_e( 'Export Layout', 'wp-timeline-designer-pro' ); ?></option>
			</select>
			<?php wp_nonce_field( 'wtl_take_action', 'wtl_take_action_nonce' ); ?>
			<input id="take_action" name="take_action" class="button action" type="submit" value="<?php esc_attr_e( 'Apply', 'wp-timeline-designer-pro' ); ?>" >
			<div class="tablenav-pages" 
			<?php
			if ( (int) $num_of_pages <= 1 ) {
				echo 'style="display:none;"';
			}
			?>
			>
				<span class="displaying-num"><?php echo esc_html( number_format_i18n( $total ) ) . ' ' . sprintf( esc_html( 'item', 'items', $total, 'wp-timeline-designer-pro' ), esc_html( number_format_i18n( $total ) ) ); ?></span>
				<span class="pagination-links">
					<?php if ( '1' == $paged_no ) { ?>
						<span class="tablenav-pages-navspan" aria-hidden="true">&laquo;</span>
						<span class="tablenav-pages-navspan" aria-hidden="true">&lsaquo;</span>
					<?php } else { ?>
						<a class="first-page" href="<?php echo '?page=wtl_layouts&paged=1&s=' . esc_attr( $searched_data ); ?>" title="<?php esc_attr_e( 'Go to the first page', 'wp-timeline-designer-pro' ); ?>">&laquo;</a>
						<a class="prev-page" href="<?php echo '?page=wtl_layouts&paged=' . esc_attr( $prev_page ) . '&s=' . esc_attr( $searched_data ); ?>" title="<?php esc_attr_e( 'Go to the previous page', 'wp-timeline-designer-pro' ); ?>">&lsaquo;</a>
					<?php } ?>
					<span class="paging-input">
						<span class="total-pages"><?php echo esc_html( $paged_no ); ?></span>
						<?php esc_html_e( 'of', 'wp-timeline-designer-pro' ); ?>
						<span class="total-pages"><?php echo esc_html( $num_of_pages ); ?></span>
					</span>
					<?php if ( $paged_no == $num_of_pages ) { ?>
						<span class="tablenav-pages-navspan" aria-hidden="true">&rsaquo;</span>
						<span class="tablenav-pages-navspan" aria-hidden="true">&raquo;</span>
					<?php } else { ?>
						<a class="next-page " href="<?php echo '?page=wtl_layouts&paged=' . esc_attr( $next_page ) . '&s=' . esc_attr( $searched_data ); ?>" title="<?php esc_attr_e( 'Go to the next page', 'wp-timeline-designer-pro' ); ?>">&rsaquo;</a>
						<a class="last-page " href="<?php echo '?page=wtl_layouts&paged=' . esc_attr( $num_of_pages ) . '&s=' . esc_attr( $searched_data ); ?>" title="<?php esc_attr_e( 'Go to the last page', 'wp-timeline-designer-pro' ); ?>">&raquo;</a>
					<?php } ?>
				</span>
			</div>
		</div>
		<table class="wp-list-table widefat fixed striped wp-timeline-sliders-list wp-timeline-table wp-timeline-sliders-list wp-timeline-table">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column" id="cb"><input type="checkbox" name="delete-all-shortcodes-1" id="delete-all-shortcodes-1" value="0"></td>
					<th class="manage-column column-shortcode_name column-primary column-title sorted <?php echo esc_attr( $order_by ); ?>" scope="col" id="shortcode_name">
						<a href="?page=wtl_layouts&orderby=shortcode_name&order=<?php echo esc_attr( $ord ); ?>">
							<span><?php esc_html_e( 'Layout Name', 'wp-timeline-designer-pro' ); ?></span><span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="manage-column column-template-name" id="template_name"><?php esc_html_e( 'Template Name', 'wp-timeline-designer-pro' ); ?></th>
					<th class="manage-column column-shortcode_tag" id="shortcode_tag"><?php esc_html_e( 'Shortcode', 'wp-timeline-designer-pro' ); ?></th>
					<th class="manage-column column-categories" id="shortcode_categories" ><?php esc_html_e( 'Categories', 'wp-timeline-designer-pro' ); ?></th>
					<th class="manage-column column-tags" id="shortcode_tags" ><?php esc_html_e( 'Tags', 'wp-timeline-designer-pro' ); ?></th>
				</tr>
			</thead>
			<tbody id="the_list">
				<?php
				if ( ! $shortcodes ) {
					echo '<tr>';
					echo '<td colspan="6" style="text-align: center;">';
					esc_html_e( 'No Layout found.', 'wp-timeline-designer-pro' );
					echo '</td>';
					echo '</tr>';
				} else {
					$shortcode_cnt = 0;
					foreach ( $shortcodes as $shortcode ) {
						$allsettings = $shortcode->wtlsettngs;
						if ( is_serialized( $allsettings ) ) {
							$wtl_settings = maybe_unserialize( $allsettings );
						}
						$cat_data = '—';
						$tag_data = '—';
						if ( isset( $wtl_settings['custom_post_type'] ) && 'post' === $wtl_settings['custom_post_type'] ) {
							if ( isset( $wtl_settings['template_tags'] ) && ! empty( $wtl_settings['template_tags'] ) ) {
								$tags     = $wtl_settings['template_tags'];
								$tag_data = array();
								foreach ( $tags as $t ) {
									$tag_name   = get_tag( $t );
									$tag_data[] = $tag_name->name;
								}
								$tag_data = join( ', ', $tag_data );
							}
							if ( isset( $wtl_settings['template_category'] ) && ! empty( $wtl_settings['template_category'] ) ) {
								$categories = $wtl_settings['template_category'];
								$cat_data   = array();
								foreach ( $categories as $t ) {
									$cat_data[] = get_cat_name( $t );
								}
								$cat_data = join( ', ', $cat_data );
							}
						} else {
							$custom_post    = $wtl_settings['custom_post_type'];
							$taxonomy_names = get_object_taxonomies( $custom_post );
							if ( ! empty( $taxonomy_names ) ) {
								foreach ( $taxonomy_names as $taxonomy_name ) {
									$custom_cat = $taxonomy_name . '_terms';
									if ( isset( $wtl_settings[ $custom_cat ] ) && is_array( $wtl_settings[ $custom_cat ] ) ) {
										$cat_data = $wtl_settings[ $custom_cat ];
									}
								}
								if ( ! empty( $cat_data ) && is_array( $cat_data ) ) {
									$cat_data = join( ', ', $cat_data );
								}
							}
						}
						$shortcode_name = $shortcode->shortcode_name;
						$shortcode_cnt++;

						echo '<tr>';
						?>
					<th class="check-column"><input type="checkbox" class="chk_remove_all" name="chk_remove_all[]" id="chk_remove_all" value="<?php echo esc_attr( $shortcode->wtlid ); ?>"></th>
					<td class="title column-title column-primary">
						<strong>
							<a href="<?php echo '?page=add_wtl_shortcode&action=edit&id=' . esc_attr( $shortcode->wtlid ); ?>">
								<?php
								if ( ! empty( $shortcode_name ) ) {
									echo esc_html( $shortcode_name );
								} else {
									echo '(' . esc_html__( 'no title', 'wp-timeline-designer-pro' ) . ')';
								}
								?>
							</a>
						</strong>
						<div class="row-actions">
							<span class="edit">
								<a title="<?php esc_attr_e( 'Edit this item', 'wp-timeline-designer-pro' ); ?>" href="<?php echo '?page=add_wtl_shortcode&action=edit&id=' . esc_attr( $shortcode->wtlid ); ?>"><?php esc_html_e( 'Edit', 'wp-timeline-designer-pro' ); ?></a>
								|
							</span>
							<span class="duplicate">
								<a title="<?php esc_attr_e( 'Duplicate this item', 'wp-timeline-designer-pro' ); ?>" href="<?php echo esc_url( add_query_arg( 'action', 'duplicate_post_in_edit', admin_url( 'admin.php?wplayout=' . $shortcode->wtlid . '&wtl_duplicate_nonce=' . wp_create_nonce( 'wtl_duplicate_nonce' ) ) ) ); ?>"><?php esc_html_e( 'Duplicate', 'wp-timeline-designer-pro' ); ?></a>
								|
							</span>
							<span class="delete">
								<a title="<?php esc_attr_e( 'Delete this item', 'wp-timeline-designer-pro' ); ?>" href="<?php echo esc_url( wp_nonce_url( '?page=wtl_layouts&action=delete&id=' . $shortcode->wtlid ) ); ?>" onclick="return confirm('Do you want to delete this layout?');"><?php esc_html_e( 'Delete', 'wp-timeline-designer-pro' ); ?></a>
							</span>

							<?php
							$wp_timeline_setting = maybe_unserialize( $shortcode->wtlsettngs );
							if ( ! empty( $wp_timeline_setting['wtl_page_display'] ) ) {
								?>
								|
								<span class="view"><a title="<?php esc_attr_e( 'View this item', 'wp-timeline-designer-pro' ); ?>" href="<?php echo esc_url( get_the_permalink( $wp_timeline_setting['wtl_page_display'] ) ); ?>" target="_blank"><?php esc_html_e( 'View', 'wp-timeline-designer-pro' ); ?></a></span>
								<?php
							}
							?>
						</div>
						<button class="toggle-row" type="button"><span class="screen-reader-text"><?php esc_html_e( 'Show more details', 'wp-timeline-designer-pro' ); ?></span></button>
					</td>
					<td class="column-template-name" data-colname="<?php esc_html_e( 'Template Name', 'wp-timeline-designer-pro' ); ?>">
						<?php
						if ( isset( $wtl_settings['template_name'] ) ) {
							echo esc_html( str_replace( '_', '-', $wtl_settings['template_name'] ) );
						}
						?>
						</td>
					<td class="column-shortcode_tag" data-colname="<?php esc_html_e( 'Shortcode', 'wp-timeline-designer-pro' ); ?>">
						<input type="text" readonly="" onclick="this.select()" class="copy_shortcode" title="<?php esc_attr_e( 'Copy Shortcode', 'wp-timeline-designer-pro' ); ?>" value='[wp_timeline_design id="<?php echo esc_attr( $shortcode->wtlid ); ?>"]' />
					</td>
						<?php
						echo '<td class="categories column-categories" data-colname="' . esc_html__( 'Categories', 'wp-timeline-designer-pro' ) . '">' . esc_html( $cat_data ) . '</td>';
						echo '<td class="tags column-tags" data-colname="' . esc_html__( 'Tags', 'wp-timeline-designer-pro' ) . '">' . esc_html( $tag_data ) . '</td>';
						echo '</tr>';
					}
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td class="manage-column check-column"><input type="checkbox" name="delete-all-shortcodes-2" id="delete-all-shortcodes-2" value="0"></td>
					<td class="manage-column column-shortcode_name"><?php esc_html_e( 'Layout Name', 'wp-timeline-designer-pro' ); ?></td>
					<th class="manage-column column-template-name"><?php esc_html_e( 'Template Name', 'wp-timeline-designer-pro' ); ?></th>
					<td class="manage-column column-shortcode_tag" ><?php esc_html_e( 'Shortcode', 'wp-timeline-designer-pro' ); ?></td>
					<td class="manage-column column-categories"><?php esc_html_e( 'Categories', 'wp-timeline-designer-pro' ); ?></td>
					<td class="manage-column column-tags"><?php esc_html_e( 'Tags', 'wp-timeline-designer-pro' ); ?></td>
				</tr>
			</tfoot>
		</table>
		<div class="bottom-delete-form">
			<select name="wtl-action-top2">
				<option selected="selected" value="none"><?php esc_html_e( 'Bulk Actions', 'wp-timeline-designer-pro' ); ?></option>
				<option value="delete_pr"><?php esc_html_e( 'Delete Permanently', 'wp-timeline-designer-pro' ); ?></option>
				<option value="wtl_export"><?php esc_html_e( 'Export Layout', 'wp-timeline-designer-pro' ); ?></option>
			</select>
			<input id="take_action" name="take_action" class="button action" type="submit" value="<?php esc_attr_e( 'Apply', 'wp-timeline-designer-pro' ); ?>" >
			<?php if ( $shortcodes ) { ?>
				<div class="tablenav bottom">
					<div class="tablenav-pages" 
					<?php
					if ( (int) $num_of_pages <= 1 ) {
						echo 'style="display:none;"';
					}
					?>
					>
						<span class="displaying-num"><?php echo esc_html( number_format_i18n( $total ) ) . ' ' . sprintf( esc_html( 'item', 'items', $total, 'wp-timeline-designer-pro' ), esc_html( number_format_i18n( $total ) ) ); ?></span>
						<span class="pagination-links">
							<?php if ( '1' === $paged_no ) { ?>
								<span class="tablenav-pages-navspan" aria-hidden="true">&laquo;</span>
								<span class="tablenav-pages-navspan" aria-hidden="true">&lsaquo;</span>
							<?php } else { ?>
								<a class="first-page" href="<?php echo '?page=wtl_layouts&paged=1&s=' . esc_attr( $searched_data ); ?>" title="<?php esc_attr_e( 'Go to the first page', 'wp-timeline-designer-pro' ); ?>">&laquo;</a>
								<a class="prev-page" href="<?php echo '?page=wtl_layouts&paged=' . esc_attr( $prev_page ) . '&s=' . esc_attr( $searched_data ); ?>" title="<?php esc_attr_e( 'Go to the previous page', 'wp-timeline-designer-pro' ); ?>">&lsaquo;</a>
							<?php } ?>
							<span class="paging-input">
								<span class="total-pages"><?php echo esc_html( $paged_no ); ?></span>
								<?php esc_html_e( 'of', 'wp-timeline-designer-pro' ); ?>
								<span class="total-pages"><?php echo esc_html( $num_of_pages ); ?></span>
							</span>
							<?php if ( $paged_no == $num_of_pages ) { ?>
								<span class="tablenav-pages-navspan" aria-hidden="true">&rsaquo;</span>
								<span class="tablenav-pages-navspan" aria-hidden="true">&raquo;</span>
							<?php } else { ?>
								<a class="next-page " href="<?php echo '?page=wtl_layouts&paged=' . esc_attr( $next_page ) . '&s=' . esc_attr( $searched_data ); ?>" title="<?php esc_attr_e( 'Go to the next page', 'wp-timeline-designer-pro' ); ?>">&rsaquo;</a>
								<a class="last-page " href="<?php echo '?page=wtl_layouts&paged=' . esc_attr( $num_of_pages ) . '&s=' . esc_attr( $searched_data ); ?>" title="<?php esc_attr_e( 'Go to the last page', 'wp-timeline-designer-pro' ); ?>">&raquo;</a>
							<?php } ?>
						</span>
					</div>
				</div>
			<?php } ?>
		</div>
	</form>
</div>
