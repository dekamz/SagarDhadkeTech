<?php
/**
 * The template-config functionality of the plugin.
 *
 * @link       https://www.solwininfotech.com/
 * @since      1.0.0
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/wp_timeline_templates
 */

/**
 * Add/Edit Timeline Layout setting page.
 *
 * @package    Wp_Timeline_Designer_PRO
 * @subpackage Wp_Timeline_Designer_PRO/admin
 * @author     Solwin Infotech <info@solwininfotech.com>
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wpdb;
$paged_n = filter_input( INPUT_GET, 'paged' ) ? absint( filter_input( INPUT_GET, 'paged' ) ) : 1;
if ( ! is_numeric( $paged_n ) ) {
	$paged_n = 1;
}
$limit         = 10;
$user          = get_current_user_id();
$screen        = get_current_screen();
$screen_option = $screen->get_option( 'per_page', 'option' );
$limit         = get_user_meta( $user, $screen_option, true );
if ( empty( $limit ) || $limit < 1 ) {
	$limit = $screen->get_option( 'per_page', 'default' );
}
$offset   = ( $paged_n - 1 ) * $limit;
$where    = '';
$search_n = '';
if ( isset( $_REQUEST['s'] ) && '' != $_REQUEST['s'] ) {
	$search_n  = sanitize_text_field( wp_unslash( $_REQUEST['s'] ) );
	$search_n1 = '%' . $search_n . '%';
	$where     = 'WHERE name LIKE %s';
}
if ( isset( $_POST['btnSearchShortcode'] ) || ( isset( $_POST['s'] ) && '' != $_POST['s'] ) ) {
	$delete_action = '';
	if ( isset( $_POST['take_action'] ) && isset( $_POST['wtl-action-top'] ) ) {
		$delete_action = 'multiple_delete';
	}
	?>
	<script type="text/javascript">
		"use strict";
		var paged = '<?php echo esc_html( $paged_n ); ?>';
		var s = ['<?php echo esc_html( $search_n ); ?>'];
		var action = ['<?php echo esc_html( $delete_action ); ?>'];
		window.location.pushState({ path: document.location.href }, '', document.location.href + "&paged=" + paged + "&s=" + s + "&action=" + action);
	</script>
	<?php
}
$ord = 0;
if ( isset( $_REQUEST['order'] ) && 0 == $_REQUEST['order'] ) {
	$order_by    = 'desc';
	$ord         = 1;
	$order_field = 'name';
} elseif ( isset( $_REQUEST['order'] ) && 1 == $_REQUEST['order'] ) {
	$order_by    = 'asc';
	$ord         = 0;
	$order_field = 'name';
} else {
	$order_by    = 'desc';
	$order_field = 'id';
}
if ( '' == $where ) {
	$total = $wpdb->get_var( 'SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'wtl_cpts ' );
} else {
	$total = $wpdb->get_var( $wpdb->prepare( 'SELECT COUNT(`id`) FROM ' . $wpdb->prefix . 'wtl_cpts WHERE name LIKE %s', $search_n1 ) );
}

$num_of_pages = ceil( $total / $limit );
$next_page    = (int) $paged_n + 1;
if ( $next_page > $num_of_pages ) {
	$next_page = $num_of_pages;
}
$prev_page = (int) $paged_n - 1;
if ( $prev_page < 1 ) {
	$prev_page = 1;
}
// Get the shortcode information.
if ( '' == $where ) {
	$shortcodes = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . "wtl_cpts WHERE 1=1 order by $order_field $order_by limit %d , %d", $offset, $limit ) );
} else {
	$shortcodes = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . "wtl_cpts WHERE name LIKE %s order by $order_field $order_by limit %d , %d", $search_n1, $offset, $limit ) );
}
?>
<div class="wp-timeline-admin wrap wp-timeline-shortcode-list">
	<?php
	if ( isset( $_GET['action'] ) && 'delete' === $_GET['action'] && isset( $_GET['id'] ) && ! empty( $_GET['id'] ) && isset( $_GET['page'] ) && 'layouts' === $_GET['page'] && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) ) ) {
		?>
		<div class="updated">
			<p>
				<?php esc_html_e( 'Layout deleted successfully.', 'wp-timeline-designer-pro' ); ?>
			</p>
		</div>
		<?php
	}
	if ( isset( $_POST['wtl-action-top'] ) && 'delete_pr' === sanitize_text_field( wp_unslash( $_POST['wtl-action-top'] ) ) ) {
		if ( isset( $_POST['chk_remove_all'] ) && ! empty( $_POST['chk_remove_all'] ) ) {
			?>
			<div class="updated">
				<p>
					<?php esc_html_e( 'Custom Post Type are deleted successfully.', 'wp-timeline-designer-pro' ); ?>
				</p>
			</div>
			<?php
		}
	}
	if ( isset( $_GET['msg'] ) || ( isset( $_GET['action'] ) ) && 'multiple_delete' === $_GET['action'] ) {
		?>
		<div class="updated">
			<p>
				<?php
				if ( isset( $_GET['action'] ) && 'multiple_delete' === $_GET['action'] ) {
					esc_html_e( 'Custom Post Type are deleted successfully.', 'wp-timeline-designer-pro' );
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
		<?php esc_html_e( 'Custom Post Type', 'wp-timeline-designer-pro' ); ?>
		<a class="page-title-action" href="?page=add_wtl_cpt">
			<?php esc_html_e( 'Create New Custom Post Type', 'wp-timeline-designer-pro' ); ?>
		</a>
	</h1>
	<form method="post">
		<ul class="subsubsub">
			<li class="all">
				<a class="current" href="?page=wtl_cpts"><?php esc_html_e( 'All', 'wp-timeline-designer-pro' ); ?>
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
			<input id="shortcode-search-input" type="search" value="<?php echo esc_attr( $search_n ); ?>" name="s">
			<input id="search-submit" class="button" type="submit" name="btnSearchShortcode" value="<?php esc_attr_e( 'Search Layout', 'wp-timeline-designer-pro' ); ?>">
		</p>
		<div class="tablenav top">
			<select name="wtl-action-top">
				<option selected="selected" value="none"><?php esc_html_e( 'Bulk Actions', 'wp-timeline-designer-pro' ); ?></option>
				<option value="delete_pr"><?php esc_html_e( 'Delete Permanently', 'wp-timeline-designer-pro' ); ?></option>
				<option value="wtl_export"><?php esc_html_e( 'Export Layout', 'wp-timeline-designer-pro' ); ?></option>
			</select>
			<input id="take_action" name="take_action" class="button action" type="submit" value="<?php esc_attr_e( 'Apply', 'wp-timeline-designer-pro' ); ?>" >
			<div class="tablenav-pages" 
			<?php
			if ( (int) $num_of_pages <= 1 ) {
				echo 'style="display:none;"';
			}
			?>
			>
				<span class="displaying-num"><?php echo intval( $total ) . ' ' . sprintf( esc_html( 'item', 'items', $total, 'wp-timeline-designer-pro' ), intval( $total ) ); ?></span>
				<span class="pagination-links">
					<?php if ( '1' == $paged_n ) { ?>
						<span class="tablenav-pages-navspan" aria-hidden="true">&laquo;</span>
						<span class="tablenav-pages-navspan" aria-hidden="true">&lsaquo;</span>
					<?php } else { ?>
						<a class="first-page" href="<?php echo '?page=wtl_cpts&paged=1&s=' . esc_attr( $search_n ); ?>" title="<?php esc_attr_e( 'Go to the first page', 'wp-timeline-designer-pro' ); ?>">&laquo;</a>
						<a class="prev-page" href="<?php echo '?page=wtl_cpts&paged=' . esc_attr( $prev_page ) . '&s=' . esc_attr( $search_n ); ?>" title="<?php esc_attr_e( 'Go to the previous page', 'wp-timeline-designer-pro' ); ?>">&lsaquo;</a>
					<?php } ?>
					<span class="paging-input">
						<span class="total-pages"><?php echo esc_html( $paged_n ); ?></span>
						<?php esc_html_e( 'of', 'wp-timeline-designer-pro' ); ?>
						<span class="total-pages"><?php echo esc_html( $num_of_pages ); ?></span>
					</span>
					<?php if ( $paged_n == $num_of_pages ) { ?>
						<span class="tablenav-pages-navspan" aria-hidden="true">&rsaquo;</span>
						<span class="tablenav-pages-navspan" aria-hidden="true">&raquo;</span>
					<?php } else { ?>
						<a class="next-page " href="<?php echo '?page=wtl_cpts&paged=' . esc_attr( $next_page ) . '&s=' . esc_attr( $search_n ); ?>" title="<?php esc_attr_e( 'Go to the next page', 'wp-timeline-designer-pro' ); ?>">&rsaquo;</a>
						<a class="last-page " href="<?php echo '?page=wtl_cpts&paged=' . esc_attr( $num_of_pages ) . '&s=' . esc_attr( $search_n ); ?>" title="<?php esc_attr_e( 'Go to the last page', 'wp-timeline-designer-pro' ); ?>">&raquo;</a>
					<?php } ?>
				</span>
			</div>
		</div>
		<table class="wp-list-table widefat fixed striped wp-timeline-sliders-list wp-timeline-table wp-timeline-sliders-list wp-timeline-table">
			<thead>
				<tr>
					<td class="manage-column column-cb check-column" id="cb"><input type="checkbox" name="delete-all-shortcodes-1" id="delete-all-shortcodes-1" value="0"></td>
					<th class="manage-column column-shortcode_name column-primary column-title sorted <?php echo esc_attr( $order_by ); ?>" scope="col" id="shortcode_name">
						<a href="?page=wtl_cpts&orderby=shortcode_name&order=<?php echo esc_attr( $ord ); ?>">
							<span><?php esc_html_e( 'Custom Post Type', 'wp-timeline-designer-pro' ); ?></span>
							<span class="sorting-indicator"></span>
						</a>
					</th>
					<th class="manage-column column-template-name" id="template_name"><?php esc_html_e( 'Slug', 'wp-timeline-designer-pro' ); ?></th>					
					<th class="manage-column column-categories" id="shortcode_categories" ><?php esc_html_e( 'Categories', 'wp-timeline-designer-pro' ); ?></th>
					<th class="manage-column column-tags" id="shortcode_tags" ><?php esc_html_e( 'Tags', 'wp-timeline-designer-pro' ); ?></th>
				</tr>
			</thead>
			<tbody id="the_list">
				<?php
				if ( ! $shortcodes ) {
					echo '<tr><td colspan="5" style="text-align: center;">';
					esc_html_e( 'No Custom Post Type found.', 'wp-timeline-designer-pro' );
					echo '</td></tr>';
				} else {
					$shortcode_cnt = 0;
					foreach ( $shortcodes as $shortcode ) {
						$allsettings = $shortcode->setting;
						if ( is_serialized( $allsettings ) ) {
							$wtl_settings = maybe_unserialize( $allsettings );
						}
						$cat_n          = '—';
						$tag_n          = '—';
						$cat_n          = isset( $wtl_settings['cpts_category_name'] ) ? $wtl_settings['cpts_category_name'] : '-';
						$tag_n          = isset( $wtl_settings['cpts_tag_name'] ) ? $wtl_settings['cpts_tag_name'] : '-';
						$shortcode_name = $shortcode->name;
						$shortcode_id   = $shortcode->id;
						$shortcode_cnt++;
						echo '<tr>';
						?>
					<th class="check-column"><input type="checkbox" class="chk_remove_all" name="chk_remove_all[]" id="chk_remove_all" value="<?php echo intval( $shortcode_id ); ?>"></th>
					<td class="title column-title column-primary">
						<strong>
							<a href="<?php echo '?page=add_wtl_cpt&action=edit&id=' . intval( $shortcode_id ); ?>">
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
							<span class="edit"><a title="<?php esc_attr_e( 'Edit this item', 'wp-timeline-designer-pro' ); ?>" href="<?php echo '?page=add_wtl_cpt&action=edit&id=' . intval( $shortcode_id ); ?>"><?php esc_html_e( 'Edit', 'wp-timeline-designer-pro' ); ?></a> | </span>
							<span class="delete"><a title="<?php esc_attr_e( 'Delete this item', 'wp-timeline-designer-pro' ); ?>" href="<?php echo esc_url( wp_nonce_url( '?page=wtl_cpts&action=delete&id=' . intval( $shortcode_id ) ) ); ?>" onclick="return confirm('Do you want to delete this Post Type?');"><?php esc_html_e( 'Delete', 'wp-timeline-designer-pro' ); ?></a></span>
							<?php
							$wp_timeline_setting = maybe_unserialize( $shortcode->setting );
							if ( ! empty( $wp_timeline_setting['wtl_page_display'] ) ) {
								echo ' | ';
								?>
								<span class="view">
									<a title="<?php esc_attr_e( 'View this item', 'wp-timeline-designer-pro' ); ?>" href="<?php echo esc_url( get_the_permalink( $wp_timeline_setting['wtl_page_display'] ) ); ?>" target="_blank">
										<?php esc_html_e( 'View', 'wp-timeline-designer-pro' ); ?>
									</a>
								</span>
								<?php
							}
							?>
						</div>
						<button class="toggle-row" type="button"><span class="screen-reader-text"><?php esc_html_e( 'Show more details', 'wp-timeline-designer-pro' ); ?></span></button>
					</td>
					<td class="column-template-name" data-colname="<?php esc_html_e( 'Slug', 'wp-timeline-designer-pro' ); ?>" style="text-transform:lowercase">
						<?php echo esc_html( $shortcode->slug ); ?>
						</td>
						<td class="categories column-categories" data-colname="<?php echo esc_attr__( 'Categories', 'wp-timeline-designer-pro' ); ?>"><?php echo esc_html( $cat_n ); ?></td>
						<td class="tags column-tags" data-colname="<?php echo esc_attr__( 'Tags', 'wp-timeline-designer-pro' ); ?>"><?php echo esc_html( $tag_n ); ?></td>
						<?php
						echo '</tr>';
					}
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<td class="manage-column check-column"><input type="checkbox" name="delete-all-shortcodes-2" id="delete-all-shortcodes-2" value="0"></td>
					<td class="manage-column column-shortcode_name"><?php esc_html_e( 'Custom Post Type', 'wp-timeline-designer-pro' ); ?></td>
					<th class="manage-column column-template-name"><?php esc_html_e( 'Slug', 'wp-timeline-designer-pro' ); ?></th>
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
						<span class="displaying-num"><?php echo esc_html( $total ) . ' ' . sprintf( esc_html( 'item', 'items', $total, 'wp-timeline-designer-pro' ), intval( $total ) ); ?></span>
						<span class="pagination-links">
							<?php if ( '1' === $paged_n ) { ?>
								<span class="tablenav-pages-navspan" aria-hidden="true">&laquo;</span>
								<span class="tablenav-pages-navspan" aria-hidden="true">&lsaquo;</span>
							<?php } else { ?>
								<a class="first-page" href="<?php echo '?page=wtl_cpts&paged=1&s=' . esc_attr( $search_n ); ?>" title="<?php esc_attr_e( 'Go to the first page', 'wp-timeline-designer-pro' ); ?>">&laquo;</a>
								<a class="prev-page" href="<?php echo '?page=wtl_cpts&paged=' . esc_attr( $prev_page ) . '&s=' . esc_attr( $search_n ); ?>" title="<?php esc_attr_e( 'Go to the previous page', 'wp-timeline-designer-pro' ); ?>">&lsaquo;</a>
							<?php } ?>
							<span class="paging-input">
								<span class="total-pages"><?php echo esc_html( $paged_n ); ?></span>
								<?php esc_html_e( 'of', 'wp-timeline-designer-pro' ); ?>
								<span class="total-pages"><?php echo esc_html( $num_of_pages ); ?></span>
							</span>
							<?php if ( $paged_n === $num_of_pages ) { ?>
								<span class="tablenav-pages-navspan" aria-hidden="true">&rsaquo;</span>
								<span class="tablenav-pages-navspan" aria-hidden="true">&raquo;</span>
							<?php } else { ?>
								<a class="next-page " href="<?php echo '?page=wtl_cpts&paged=' . esc_attr( $next_page ) . '&s=' . esc_attr( $search_n ); ?>" title="<?php esc_attr_e( 'Go to the next page', 'wp-timeline-designer-pro' ); ?>">&rsaquo;</a>
								<a class="last-page " href="<?php echo '?page=wtl_cpts&paged=' . esc_attr( $num_of_pages ) . '&s=' . esc_attr( $search_n ); ?>" title="<?php esc_attr_e( 'Go to the last page', 'wp-timeline-designer-pro' ); ?>">&raquo;</a>
							<?php } ?>
						</span>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php wp_nonce_field( 'wtl-cpt-form-list', 'wtl-cpt-form-list-nonce' ); ?>
	</form>
</div>
