<?php
namespace Grav\Plugin;

use Grav\Common\Data;
use Grav\Common\Plugin;
use Grav\Common\Grav;
use Grav\Common\Page\Page;
use RocketTheme\Toolbox\Event\Event;
/* https://github.com/acla/bibtex2html */
//require_once 'vendor/bibtex2html.php';

class h5preposhortcodePlugin extends Plugin
{


    public $features = [
        'blueprints' => 10, // priority
    ];


    /**
     * Register events with Grav
     * 
     * @return void
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onGetPageBlueprints' => ['onGetPageBlueprints', 0]
            //'onPageInitialized' => ['onPageInitialized', 0]
        ];
    }
    
    
    public function onGetPageBlueprints($event)
    {
      $types = $event->types;
      $types->scanBlueprints('plugins://' . $this->name . '/blueprints');
    }
    
    
     public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/classes/shortcodes');
        //dump("shortcodehandler");
    }
    
    
    
    
    /**
     * Initialize the plugin
     * 
     * @return void
     */
    public function onPluginsInitialized()
    {
    
        //dump("onPluginsInitialized");
        if ($this->isAdmin()) {
            return;
        }
        $config = (array) $this->config->get('plugins')['h5preposhortcode'];
        if ($config['enabled']) {
            $this->enable(
                [
                    'onPageContentProcessed' => ['onPageContentProcessed', -1]
                ]
            );
        } else {
            return;
        }
    }
    
    /*
    public function onPageInitialized()
    {
          //dump("onpageinit");
    
    }
    */
    
    
    function encodeURIComponent($str) {
        $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
        return strtr(rawurlencode($str), $revert);
    }
    
    
    public function registerNextGenEditorPluginShortcodes($event) {
        $plugins = $event['plugins'];

        $plugins['js'][] = 'plugin://shortcode-ui/nextgen-editor/shortcodes/ui-lti/ui-lti.js';

        $event['plugins']  = $plugins;
        return $event;
    }
    
    
    
    
    /**
     * Manipulate page content
     * 
     * @return void
     */
    public function onPageContentProcessed()
    {

    }
}
