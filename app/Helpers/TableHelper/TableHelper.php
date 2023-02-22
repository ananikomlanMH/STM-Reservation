<?php

namespace App\Helpers\TableHelper;

use App\Helpers\URLHelper\URLHelper;

class TableHelper{

    /**
     * @var array
     */
    private $sortable = [];
    /**
     * @var array
     */
    private $get;
    /**
     * @var array
     */
    private $columns;

    public function __construct(array $columns, array $get){
        $this->get = $get;
        $this->columns = $columns;
    }

    public function setSortable(string $key, string $title): self
    {
        $this->sortable[$key] = $title;
        return $this;
    }

    public function getSortable(): array{
        return $this->sortable;
    }

    public function getSort(): string{
        if (!empty($_GET['sort'])){
            if(!in_array($_GET['sort'], $this->columns)){
                return '_id';
            }else{
                return $_GET['sort'];
            }
        }
        return '_id';
    }

    public function getDir(): string{
        if (!empty($_GET['dir'])){
            if(!in_array($_GET['dir'], ['ASC', 'DESC'])){
                return 'ASC';
            }else{
                return $_GET['dir'];
            }
        }
        return 'DESC';
    }

    public function th(string $key): string
    {
        if (!in_array($key, array_keys($this->sortable))){
            return ucfirst($key);
        }
        $sort = $this->get['sort'] ?? null;
        $direction = strtoupper($this->get['dir'] ?? 'asc');
        if(!in_array($direction, ['ASC', 'DESC'])){
            $direction = 'ASC';
        }
        if(!is_null($direction) && $sort === $key){
            $icon = $direction === "ASC" ? '<img src="/vendors/images/arrow-up.svg" alt="" width="15" style="margin-left: 6px;">' : '<img src="/vendors/images/arrow-down.svg" alt="" width="15" style="margin-left: 6px;">';
        }else{
            $icon = "<img src='/vendors/images/filter.svg' alt='' width='15' style='margin-left: 6px;'>";
        }

        $url = URLHelper::withParams($this->get,[
            'sort' => $key,
            'dir' => $direction === "ASC" && $sort === $key ? "DESC" : "ASC"
        ]);
        return <<<HTML
            <a href="?$url">{$this->sortable[$key]} $icon</a>
HTML;
    }
}
