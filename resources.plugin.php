<?php

    /**
     *  Resources
     *
     *  @package Monstra
     *  @subpackage Plugins
     *  @author Moncho Varela / Nakome
     *  @copyright 2013 Nakome
     *  @version 1.0.0
     *
     */


    // Register plugin
    Plugin::register( __FILE__,
                    __('Resources', 'resources'),
                    __('Resources for Monstra', 'resources'),
                    '1.0.0',
                    'Nakome',
                    'http://nakome.com/',
                    'resources');


    // Load Stock Admin for Editor and Admin
    if (Session::exists('user_role') && in_array(Session::get('user_role'), array('admin', 'editor'))) {
        Plugin::admin('resources');
    }



    Shortcode::add('resources','Resources::short');
    Javascript::add('plugins/resources/lib/resources.js','backend',6);
    Javascript::add('plugins/resources/lib/app.js','frontend',5);
    Stylesheet::add('plugins/resources/lib/app.css','frontend',5);

    class Resources extends Frontend {
        // Php link Resources::ShowMe();
        public static function ShowMe(){

            // Vars
            $siteurl  = Option::get('siteurl');
            // Get xml data
            $data     = XML::loadfile(STORAGE.DS.'database'.DS.'resources.table.xml');
            // Get string in xml
            $xml      = $data->resources;
            // Count strings
            $count    = count($xml);

            $html = '<ul class="items" id="list">';

            for ($i = 0; $i < $count; $i++) {

               $html.= '<li class="item" rel="'.$xml[$i]->tags.'">
                         <a href="'.$xml[$i]->img.'" title="'.$xml[$i]->title.'">
                            <img class="'.$xml[$i]->tags.'" src="'.$xml[$i]->img.'" alt="'.$xml[$i]->title.'"/>
                         </a>
                           <div class="caption">
                                <strong class="item-title">'.$xml[$i]->title.'</strong><br>
                                <p>'.$xml[$i]->content.'</p>
                                <strong>'.__('Version','resources').': </strong>'.Html::nbsp(2).$xml[$i]->version.'
                                <a class="item-download" target="_blank" href="'.$xml[$i]->link.'" title="'.$xml[$i]->title.'">'.__('Go here...','resources').'</a>
                           </div>
                       </li>';
            }
            $html.= '</ul>';

            return $html;
        }


        // Shortcodes
        public static function short($attributes){

            extract($attributes);

            // Vars
            $siteurl  = Option::get('siteurl');
            // Get xml data
            $data     = XML::loadfile(STORAGE.DS.'database'.DS.'resources.table.xml');
            // Get string in xml
            $xml      = $data->resources;
            // Count strings
            $count    = count($xml);

            $html = '<ul class="items" id="list">';

            for ($i = 0; $i < $count; $i++) {

               $html.= '<li class="item" rel="'.$xml[$i]->tags.'">
                         <a href="'.$xml[$i]->img.'" title="'.$xml[$i]->title.'">
                            <img class="'.$xml[$i]->tags.'" src="'.$xml[$i]->img.'" alt="'.$xml[$i]->title.'"/>
                         </a>
                           <div class="caption">
                                <strong class="item-title">'.$xml[$i]->title.'</strong><br>
                                <p>'.$xml[$i]->content.'</p>
                                <span class="item-version">'.__('Version','resources').': '.Html::nbsp(2).$xml[$i]->version.'</span>
                                <a class="item-download" target="_blank" href="'.$xml[$i]->link.'" title="'.$xml[$i]->title.'">'.__('Go here...','resources').'</a>
                           </div>
                       </li>';
            }
            $html.= '</ul>';

            return $html;
        }
    }