<?php

/**
 * Initializes main class and runs our plugin
 */
function wppb_init() {
    $wppb = new WPPB(__FILE__);
    $wppb->run();
}
