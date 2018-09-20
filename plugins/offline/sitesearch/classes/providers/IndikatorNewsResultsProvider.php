<?php
namespace OFFLINE\SiteSearch\Classes\Providers;

use Indikator\News\Models\Posts;
use Illuminate\Database\Eloquent\Collection;
use OFFLINE\SiteSearch\Classes\Result;
use OFFLINE\SiteSearch\Models\Settings;

/**
 * Searches the contents generated by the
 * Indikator.News plugin
 *
 * @package OFFLINE\SiteSearch\Classes\Providers
 */
class IndikatorNewsResultsProvider extends ResultsProvider
{
    /**
     * Runs the search for this provider.
     *
     * @return ResultsProvider
     */
    public function search()
    {
        if ( ! $this->isInstalledAndEnabled()) {
            return $this;
        }

        foreach ($this->posts() as $post) {
            // Make this result more relevant, if the query is found in the title
            $relevance = mb_stripos($post->title, $this->query) === false ? 1 : 2;

            $result        = new Result($this->query, $relevance);
            $result->title = $post->title;
            $result->text  = $post->introductory;
            $result->url   = $this->getUrl($post);
            $result->meta  = $post->published_at;
            $result->model = $post;

            $this->addResult($result);
        }

        return $this;
    }

    /**
     * Get all posts with matching title or content.
     *
     * @return Collection
     */
    protected function posts()
    {
        return Posts::isPublished()
                    ->where(function ($query) {
                        $query->where('title', 'like', "%{$this->query}%")
                            ->orWhere('introductory', 'like', "%{$this->query}%")
                            ->orWhere('content', 'like', "%{$this->query}%");
                    })
                   ->orderBy('published_at', 'desc')
                   ->get();
    }

    /**
     * Checks if the Indikator.News Plugin is installed and
     * enabled in the config.
     *
     * @return bool
     */
    protected function isInstalledAndEnabled()
    {
        return $this->isPluginAvailable($this->identifier)
        && Settings::get('indikator_news_enabled', true);
    }

    /**
     * Generates the url to a blog post.
     *
     * @param $post
     *
     * @return string
     */
    protected function getUrl($post)
    {
        //$url = trim(Settings::get('indikator_news_posturl', '/news/post'), '/');
        //$langPrefix = $this->translator ? $this->translator->getLocale() : '';

        // by @SK
        $langPrefix = "";
        $url = "news/item";

        return implode('/', [$langPrefix, $url, $post->slug]);
    }

    /**
     * Display name for this provider.
     *
     * @return mixed
     */
    public function displayName()
    {
        return Settings::get('indikator_news_label', 'News');
    }

    /**
     * Returns the plugin's identifier string.
     *
     * @return string
     */
    public function identifier()
    {
        return 'Indikator.News';
    }
}
