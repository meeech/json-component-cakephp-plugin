<?php
/**
 * JsonComponent for CakePHP
 *
 * Used to centralize some JSON output. 
 *
 * @usage Create an elements/json.ctp for your output - expects a var $output which it will output as a json object
 * @settings: fakeAjax (false) Set to true to make cake think any incoming req is a ajax req. Useful to load the page in your browser. 
 *            debug (false) Set to true to allow app core debug setting to be user. 
 *
 * To use, add this to your controller compnents: 
 * 
 * var $components = array(
 *       'Json.Json' => array('debug'=>false, 'fakeAjax'=>false)
 *     );
 *
 *
 * If you are using jsonp, you will need to turn on 
 * Router::parseExtensions('json');
 * and make sure the url you hit ends in .json. This behaviour will change - just that cakephp doesn't detect jsonp req as ajax, so isAjax fails. 
 *
 * @author Mitchell Amihod
 */
class JsonComponent extends Object {
    
    var $controller;
    var $components = array('RequestHandler');

    /**
     * Will make json component think any incoming req is ajax.
     * Useful to test the url in your browser
     *
     * @var bool
     */
    var $fakeAjax = false;
    
    /**
     * Use application level debug setting
     *
     * @var bool
     */
    var $debug = false;

    public function initialize(&$controller, $settings=array()) {
        $this->controller =& $controller;
        $this->_set($settings);

        //This it to work around jsonp not setting XMLHttpRequest. 
        //There may be a better way around this, let me know!
        // So, if this == json, we will trigger the 'fake ajax' behaviour. 
        $reqExtension = $this->RequestHandler->ext;

        if( $this->fakeAjax || ('json' == $reqExtension) ) {
            //Trick ReqHandler to think its an ajax request
            $_ENV['HTTP_X_REQUESTED_WITH'] = "XMLHttpRequest";
            $_SERVER['HTTP_X_REQUESTED_WITH'] = "XMLHttpRequest";
        }
    }
    
    public function startup(&$controller) {

        if($this->RequestHandler->isAjax()) {
            //If we aren't in debug mode, turn off error messaging
            if(!$this->debug) {
                Configure::write('debug', 0);
            }

            //For use of default cake ajax layout. Else reqHandler tries to find json/default.ctp
            $controller->layoutPath = '';
            $controller->layout = 'ajax';
            //Need to turn off autoRender.
            $controller->autoRender = false;

            //Maybe I'm just dumb, but not getting how to get some of the RequestHandler automagic should work
            //or maybe i'm thinking there's more magic than there is.
            //Either way, set the respondAd to javascript
            $this->RequestHandler->respondAs('javascript');
        }
    }
    
    public function shutdown(&$controller) {
        if($this->RequestHandler->isAjax()) {
            $controller->output = $controller->render('../elements/json');
        }
    }
}
