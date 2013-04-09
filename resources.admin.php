<?php

    // Admin Navigation: add new item
    Navigation::add(__('Resources', 'resources'), 'content', 'resources', 10);
    Stylesheet::add('plugins/resources/lib/app.css', 'backend', 11);
    class resourcesAdmin extends Backend {

        public static $resources = null;


        public static function main() {

            // Get menu table
            resourcesAdmin::$resources = new Table('resources');

            // Create Table
            $resources = new Table('resources');

            $reCd = $resources->select(null, 'all');

            if (Request::get('action')) {
                switch (Request::get('action')) {
                    case 'add_item':

                        if(Request::post('rAdd')){
                            if (Security::check(Request::post('csrf'))) {

                                // Request data
                                $title      = (string)Request::post('rTitle');
                                $content    = (string)Request::post('rContent');
                                $tags       = (string)Request::post('rTag');
                                $version    = (string)Request::post('rVer');
                                $img        = (string)Request::post('rImg');
                                $link       = (string)Request::post('rLink');

                                // If empty data
                                if(empty($title)) $title        = __('Title no added', 'resources');
                                if(empty($content)) $content    = __('Content no added', 'resources');
                                if(empty($tags)) $tags          = '';
                                if(empty($version)) $version    = __('None', 'resources');
                                if(empty($img)) $img            = __('Img no added', 'resources');
                                if(empty($link)) $link          = __('link no added', 'resources');



                                // Insert records
                                $resources->insert(array(
                                    'title'     => $title,
                                    'content'   => $content,
                                    'tags'      => $tags,
                                    'version'   => $version,
                                    'img'       => $img,
                                    'link'      => $link
                                ));

                                $reCd = $resources->select(null, 'all');

                                // Success
                                Notification::set('success', __('Your item has been added ', 'resources'));

                                // Redirect
                                Request::redirect('index.php?id=resources');

                            } else { die('csrf detected!'); }
                        }

                        View::factory('resources/views/backend/add')->display();

                    break;

                    case 'editItem':

                        $item = resourcesAdmin::$resources->select('[uid="'.Request::get('uid').'"]', null);

                        $title      = $item['title'];
                        $content    = $item['content'];
                        $tags       = $item['tags'];
                        $version    = $item['version'];
                        $img        = $item['img'];
                        $link       = $item['link'];

                        if(Request::post('rEdit')){
                            if (Security::check(Request::post('csrf'))) {

                                if (Request::post('rTitle'))    $title      = Request::post('rTitle');      else $title     = $item['title'];
                                if (Request::post('rContent'))  $content    = Request::post('rContent');    else $content   = $item['content'];
                                if (Request::post('rTag'))      $tags       = Request::post('rTag');        else $tags      = $item['tags'];
                                if (Request::post('rVer'))      $version    = Request::post('rVer');        else $version   = $item['version'];
                                if (Request::post('rImg'))      $img        = Request::post('rImg');        else $img       = $item['img'];
                                if (Request::post('rLink'))     $link       = Request::post('rLink');       else $link      = $item['link'];

                                // Insert records
                                $resources->updateWhere('[uid="'.Request::get('uid').'"]',
                                                        array(
                                                                'title'     => $title,
                                                                'content'   => $content,
                                                                'tags'      => $tags,
                                                                'version'   => $version,
                                                                'img'       => $img,
                                                                'link'      => $link
                                                            ));

                                $reCd = $resources->select(null, 'all');

                                // Success
                                Notification::set('success', __('Your item has been edit ', 'resources'));

                                // Redirect
                                Request::redirect('index.php?id=resources');

                            } else { die('csrf detected!'); }
                        }

                        View::factory('resources/views/backend/edit')
                        ->assign('title', $title)
                        ->assign('content', $content)
                        ->assign('tags', $tags)
                        ->assign('version', $version)
                        ->assign('img', $img)
                        ->assign('link', $link)
                        ->assign('reCd', $reCd)
                        ->display();

                    break;
                }
            }else{

                // Delete menu item
                if (Request::get('delItem')) {
                    resourcesAdmin::$resources->delete((int) Request::get('delItem'));
                    Notification::set('success', __('Your item has been delete ', 'resources'));
                    Request::redirect('index.php?id=resources');
                }


                // Display view
                View::factory('resources/views/backend/index')->assign('reCd', $reCd)->display();
            }


        }
    }

