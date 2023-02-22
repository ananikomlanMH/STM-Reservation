<?php
namespace App\Helpers\Pagination;

use App\Helpers\URLHelper\URLHelper;

class PaginationHelper{

    private $Pages;
    private $Get;

    public function __construct(int $Pages, $Get)
    {
        $this->Pages = $Pages;
        $this->Get = $Get;
    }

    public function getPagination(): string{

        $pages = $this->Pages;
        $page = intval($this->Get['p'] ?? 1);

        /* Set subgroup page start:                           */
        if    ( $pages < 6        ) $start = 2;
        elseif( $page  < 3        ) $start = 2;
        elseif( $page  > $pages-3 ) $start = $pages - 3;
        else                        $start = $page  - 1;

        /* Compose line:                                      */
        /* Page 1 (always):                                   */

        $output = "";
        if ($pages > 1 && $page > 1) $output .= "<a href=?" . URLHelper::withParam($this->Get,"p",$page - 1) . "><i class='fi-rr-angle-left'></i> Précedent</a>";

        $active = $page == "1" ? 'active' : '';

       if ($pages > 1) $output .= "<a class=\"$active\" href=?" . URLHelper::withParam($this->Get,"p",1) . ">1</a>";

        /* Initial separator:                                 */
        if( $start > 2 ) $output .= '<a>...</a>';
        /* Page subgroup: ends if reached +2 or pages-1       */
        for( $i = $start; $i < $pages; $i++ )
        {
            $active = $page == $i ? 'active' : '';
            $output .= "<a class=\"$active\" href=?" . URLHelper::withParam($this->Get,"p",$i) . ">$i</a>";
            if( $i > ($start+1) ) break;
        }
        /* Final separator:                                   */
        if( $start < $pages - 3 ) $output .= '<a class="step">...</a>';
        /* Last page:                                         */
        $active = $page == $pages ? 'active' : '';
        if( $pages > 1 ) $output .= "<a class=\"$active\" href=?" . URLHelper::withParam($this->Get,"p",$pages) . ">$pages</a>";

        if ($pages > 1 && $page < $pages) $output .= "<a href=?" . URLHelper::withParam($this->Get,"p",$page + 1) . ">Suivant <i class='fi-rr-angle-right'></i></a>";

        /* Output:                                            */
        return $output;
    }

}
