<?php
/**
 * Provide a laze selector modal for the plugin admin page.
 *
 * @since 1.0.0 *
 * @package Ticketmaster *
 * @subpackage Ticketmaster/admin/partials
 */

?>

<div class="modal modal-common fade" id="js_ls-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div></div><!--map-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <div class="row">
                    <h3 class="modal-title col-lg-12"><?php esc_attr_e( 'Find', $this->plugin_name); ?> <span><?php esc_attr_e( 'event' ); ?> </span> <?php esc_attr_e( 'by keyword', $this->plugin_name); ?></h3>
                </div>
            </div>
            <div class="modal-body">
                <form id="js_ls_form" accept-charset="UTF-8" method="GET">
                    <div class="col-sm-9 clear-padding-right">
                        <input required type="text" placeholder="keyword" id="ls_keyword" autofocus>
                    </div>
                    <div class="col-sm-3 text-right">
                        <button id="js_ls-modal_btn" type="button" class="btn btn-transparent"><?php esc_attr_e( 'GET', $this->plugin_name ); ?></button>
                    </div>
                </form>
                <div id="spinner-ls" style="display: none;"></div>
                <div class="ms-selection" style="display: none;">
                    <div class="col-sm-9 col-xs-12">
                        <ul class="ms-list">
                        </ul>
                    </div>
                    <div class="col-sm-3 col-xs-12 text-right">
                        <button id="js_ms-use-btn" type="button" class="btn btn-submit"><?php esc_attr_e( 'Use', $this->plugin_name); ?></button>
                    </div>
                </div>
                <hr id="js_ls-top-hr" style="display: none;">
                <div class="wrapper-list-group">
                    <ul id="js_lazy-sel_list" class="list-group"></ul>
                    <div class="list-footer text-center" style="display: none;" id="load-more-box">
                        <button id="js_ls-more_btn" type="button" class="btn btn-submit"><?php esc_attr_e( 'SHOW MORE EVENTS', $this->plugin_name); ?></button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->

        <div class="wrapper-map" class="" style="background-color: aliceblue;">
            <button style="display: none;" id="close1" class="button-close-map" aria-controls="m1"></button>
            <div id="map-canvas" class="" style="background-color: aliceblue;"></div>
        </div>

    </div><!-- /.modal-dialog -->
</div><!-- /.modal .js_ls-modal-->
