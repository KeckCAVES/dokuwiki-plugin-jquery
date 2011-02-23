<?php
/**
 * jQuery Plugin
 */

if(!defined('DOKU_INC')) die();
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once(DOKU_PLUGIN.'action.php');

class action_plugin_jquery extends DokuWiki_Action_Plugin {

    /*
     * Register handlers with the DokuWiki's event controller
     */
    function register(&$controller) {
        $controller->register_hook('TPL_METAHEADER_OUTPUT', 'BEFORE', $this, '_add_jquery');
    }

    function _add_jquery(&$event, $param) {
        array_unshift($event->data['script'],
            // Load the jQuery library
            array(
                'type' => 'text/javascript',
                'src' => $this->getConf('src'),
                '_data' => ''
            ),
            // Disable jQuery's use of $(), which conflicts with Dokuwiki
            array(
                'type' => 'text/javascript',
                'charset' => 'utf-8',
                '_data' => '$.noConflict();'
            )
        );
    }

}
