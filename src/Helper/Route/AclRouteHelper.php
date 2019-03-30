<?php declare(strict_types=1);
namespace cyrixbiz\acl\Helper\Route;

use cyrixbiz\acl\Repositories\Resource\ResourceRepository;

/**
 * Class AclRouteHelper
 * @package cyrixbiz\acl\Helper\Route
 */
class AclRouteHelper
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var $repository
     */
    protected $repository;

    /**
     * AclRouteHelper constructor.
     * @param ResourceRepository $repository
     */
    public function __construct(ResourceRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return bool
     */
    public function insertResources() : bool
    {
        return $this->repository->insert($this->buildArray());
    }

    /**
     * @return array|null
     */
    protected function getAllRoutes() : ?array
    {
        foreach(\Route::getRoutes()  as $key => $value)
        {
            if(!is_null($value->getName()))
            {
                $this->items[] = $value->getName();
                continue;
            }
            if(strstr($value->uri, '{'))
            {
                $this->items[] = substr(str_replace('/', '.', $value->uri),
                    0,
                    strpos($value->uri, '{') - 1);
                continue;
            }
            $this->items[] = str_replace('/', '.', $value->uri);
        }
        $this->items = array_unique($this->items);

        return $this->items;
    }

    /**
     * @return array|null
     */
    protected function getAllResources() : ?array
    {
        foreach ($this->repository->all(['name'])->toArray() as $item)
        {
            $key = array_search($item['name'], $this->items);

            if(is_int($key))
            {
                unset($this->items[$key]);
            }

        }
        return $this->items;
    }

    /**
     * @param string $item
     * @param bool $access
     * @return array
     */
    protected function setItem(string $item, bool $access = false) : array
    {
        return [
            'name' => $item,
            'default_access' => $access,
            'info' => __('AclLang::views.description_default'),
         ];
    }

    /**
     * @return array
     */
    protected function buildArray() : array
    {
        $this->getAllRoutes();
        $this->getAllResources();

        if($this->items != [])
        {
            $routes = [];
            foreach ($this->items as $item)
            {
                $routes[] = $this->setItem($item);
            }
            return $routes;
        }
        return [];
    }
}