<?php
/**
 * BoostCake
 *
 * Bootstrap helpers for CakePHP 3.x
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.md
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     Carlos Proaño <c@rlos.pro>
 * @copyright  2018 Carlos Proaño
 * @license    https://opensource.org/licenses/MIT MIT License
 * @link       https://github.com/KacosPro/bootscake
 * @since      File available since Release 0.0.4
 */
namespace BootsCake\View\Helper;

use Cake\View\Helper\PaginatorHelper;

/**
 * BootsCake Paginator Helper library.
 *
 * Inherits from Cake's Paginator Helper to render Bootstrap Components as necessary.
 */
class BootsCakePaginatorHelper extends PaginatorHelper
{
    protected $_defaultConfig = [
        'options' => [],
        'templates' => [
            'nextActive' => '<li class="page-item"><a rel="next" class="page-link" href="{{url}}" aria-label="Next"><span aria-hidden="true">&rsaquo;</span>{{text}}</a></li>',
            'nextDisabled' => '<li class="page-item disabled"><a href="" class="page-link" onclick="return false;" aria-label="Next"><span aria-hidden="true">&rsaquo;</span>{{text}}</a></li>',
            'prevActive' => '<li class="page-item"><a rel="prev" class="page-link" href="{{url}}" aria-label="Previous"><span aria-hidden="true">&lsaquo;</span>{{text}}</a></li>',
            'prevDisabled' => '<li class="page-item disabled"><a href="" class="page-link"  onclick="return false;" aria-label="Previous"><span aria-hidden="true">&lsaquo;</span>{{text}}</a></li>',
            'counterRange' => '{{start}} - {{end}} of {{count}}',
            'counterPages' => '{{page}} of {{pages}}',
            'first' => '<li class="page-item"><a rel="first" class="page-link" href="{{url}}" aria-label="Next"><span aria-hidden="true">&laquo;</span>{{text}}</a></li>',
            'last' => '<li class="page-item"><a rel="last" class="page-link" href="{{url}}" aria-label="Next">{{text}}<span aria-hidden="true">&raquo;</span></a></li>',
            'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
            'current' => '<li class="page-item active"><a class="page-link" href="">{{text}}</a></li>',
            'ellipsis' => '<li class="ellipsis">...</li>',
            'sort' => '<a href="{{url}}">{{text}}</a>',
            'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
            'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
            'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
            'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
        ]
    ];

    /**
     * Adapter for Paginator Helper first method
     *
     * Defaults $title to empty string so it would render &laquo character
     *
     * @param string $first Title for the link. Defaults to ''.
     * @param array $options Options for pagination link.
     * @return string A "first" link or a disabled link.
     */
    public function first($first = '', array $options = [])
    {
        return parent::first($first, $options);
    }

    /**
     * Adapter for Paginator Helper prev method
     *
     * Defaults $title to empty string so it would render &lsaquo character
     *
     * @param string $title Title for the link. Defaults to ''.
     * @param array $options Options for pagination link.
     * @return string A "previous" link or a disabled link.
     */
    public function prev($title = '', array $options = [])
    {
        return parent::prev($title, $options);
    }

    /**
     * Adapter for Paginator Helper next method
     *
     * Defaults $title to empty string so it would render &rsaquo character
     *
     * @param string $title Title for the link. Defaults to ''.
     * @param array $options Options for pagination link.
     * @return string A "next" link or a disabled link.
     */
    public function next($title = '', array $options = [])
    {
        return parent::next($title, $options);
    }

    /**
     * Adapter for Paginator Helper first method
     *
     * Defaults $title to empty string so it would render &laquo character
     *
     * @param string $last Title for the link. Defaults to ''.
     * @param array $options Options for pagination link.
     * @return string A "last" link or a disabled link.
     */
    public function last($last = '', array $options = [])
    {
        return parent::last($last, $options);
    }
}
