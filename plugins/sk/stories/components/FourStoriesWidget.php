<?php
namespace Sk\Stories\Components;

use Cms\Classes\ComponentBase;
use Redirect;
use BackendAuth;
use Sk\Stories\Models\Story as Story;

class FourStoriesWidget extends ComponentBase
{
    public $catalog_url;
    public $count;
    public $stories;

    public function componentDetails()
    {
        return [
            'name'        => 'sk.stories::lang.stories.catalog_widget',
            'description' => 'sk.stories::lang.stories.catalog_widget_short_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'catalog_url' => [
                'title'       => 'sk.stories::lang.stories.catalog_url',
                'description' => 'sk.stories::lang.stories.catalog_url',
                'default'     => '/',
                'type'        => 'string'
            ]
        ];
    }

    public function onRun()
    {
        $this->stories = $this->getFourStories();
    }

    /**
     * @return mixed
     */
    private function getFourStories()
    {
        $storyModel = new Story();

        $stories = $storyModel->getFourStories();

        foreach($stories as $key => &$story)
        {
            $story->body = strip_tags($story->body);


            if(!empty($story->picture) && $this->isJSON($story->picture))
            {
                $story->picture = json_decode($story->picture, true);
            }
        }

        return $stories;
    }


    /**
     * @param $string
     * @return bool
     */
    private function isJSON($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}
