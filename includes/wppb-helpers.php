<?php

namespace richardevcom\wppb\helpers;

/**
 * Initializes main class and runs our plugin
 */
function wppb_init() {

    require_once WPPB_INCLUDES_PATH . 'class-wppb.php';

    $wppb = new \richardevcom\wppb\WPPB();
    $wppb->run();
}
