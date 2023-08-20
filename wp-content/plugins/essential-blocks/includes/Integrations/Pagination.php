<?php

namespace EssentialBlocks\Integrations;

class Pagination extends ThirdPartyIntegration {
    public function __construct() {
        $this->add_ajax( [
            'post_grid_block_pagination' => [
                'callback' => 'post_grid_block_pagination_callback',
                'public'   => true
            ]
        ] );
    }

    /**
     * Get Google Map API
     */
    public function post_grid_block_pagination_callback() {
        if ( ! wp_verify_nonce( $_POST['post_grid_pagination_nonce'], 'eb-pagination-nonce' ) ) {
            die( __( 'Nonce did not match', 'essential-blocks' ) );
        }

        $html = '';

        $query           = unserialize( wp_unslash( $_POST['querydata'] ) );
        $attributes      = unserialize( wp_unslash( $_POST['attributes'] ) );
        $loadMoreOptions = $attributes['loadMoreOptions'];

        $totalPosts        = $_POST['totalPosts'];
        $per_page          = $query['per_page'];
        $enableMorePosts   = $loadMoreOptions['enableMorePosts'];
        $loadMoreType      = $loadMoreOptions['loadMoreType'];
        $loadMoreButtonTxt = $loadMoreOptions['loadMoreButtonTxt'];
        $prevTxt           = $loadMoreOptions['prevTxt'];
        $nextTxt           = $loadMoreOptions['nextTxt'];

        $html = "";
        if ( isset( $totalPosts ) && (int) $totalPosts > (int) $per_page ) {
            if ( isset( $enableMorePosts ) && $enableMorePosts ) {
                if ( $loadMoreType === '1' ) {
                    $html .= sprintf(
                        '<button class="btn ebpg-pagination-button" data-pagenumber="1">%1$s</button>',
                        $loadMoreButtonTxt
                    );
                }

                $prevTxt = isset( $prevTxt ) ? $prevTxt : "<";
                $nextTxt = isset( $nextTxt ) ? $nextTxt : ">";

                if ( isset( $totalPosts ) && ( $loadMoreType === '2' || $loadMoreType === '3' ) ) {
                    $totalPages = ceil( (int) $totalPosts / (int) $per_page );
                    $html .= sprintf(
                        '<button class="ebpg-pagination-item-previous">
                    %1$s
                </button>',
                        esc_html__( $prevTxt )
                    );
                    for ( $i = 1; $i <= $totalPages; $i++ ) {
                        $active = $i == 1 ? "active" : "";

                        $html .= sprintf(
                            '<button class="ebpg-pagination-item %2$s" data-pagenumber="%1$s">
                        %1$s
                    </button>',
                            $i, $active
                        );
                    }
                    $html .= sprintf(
                        '<button class="ebpg-pagination-item-next">
                    %1$s
                </button>',
                        esc_html__( $nextTxt )
                    );
                }
            }
        }

        echo $html;
        wp_die();
    }
}
