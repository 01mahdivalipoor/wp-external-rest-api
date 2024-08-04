<?php
/**
 * Plugin Name:       Rest Call
 * Plugin URI:        https://mahdivalipoor.ir/plugins/rest-call/
 * Description:       Rest Api Call
 * Version:           0.9.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Mahdi Valipoor
 * Author URI:        https://mahdivalipoor.ir/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 */

defined('ABSPATH') or die;

if (!class_exists('RestCall')) {
    class RestCall
    {
        public function __construct()
        {
            $this->addHooks();
        }

        private function addHooks()
        {
            add_action( 'admin_menu', array($this,'registerAbusAdminMenu') );
        }

        public function registerAbusAdminMenu() {
            add_menu_page(
                'Rest Call',
                'Rest Call',
                'manage_options',
                'restCall',
                array($this,'helloAbu')
            );
        }

        public function helloAbu() {
            $json = wp_remote_retrieve_body(wp_remote_get('https://api.restful-api.dev/objects'));
            $json = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $json), true );

            $decoded_json[] = $json;

            echo '<h2>List from rest api</h2>';

            for ($i=0; $i < count($decoded_json[0]); $i++) { 
                echo $decoded_json[0][$i]['id'] .
                    " | " .
                    $decoded_json[0][$i]['name'] .
                    '<br/>';
            }
        }
    }
    
    $restCall = new RestCall;
}
