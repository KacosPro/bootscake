<?php
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
            'nextActive' => '<li class="next"><a rel="next" href="{{url}}" aria-label="Next"><span aria-hidden="true">&rsaquo;</span>{{text}}</a></li>',
            'nextDisabled' => '<li class="next disabled"><a href="" onclick="return false;" aria-label="Next"><span aria-hidden="true">&rsaquo;</span>{{text}}</a></li>',
            'prevActive' => '<li class="prev"><a rel="prev" href="{{url}}" aria-label="Previous"><span aria-hidden="true">&lsaquo;</span>{{text}}</a></li>',
            'prevDisabled' => '<li class="prev disabled"><a href="" onclick="return false;" aria-label="Previous"><span aria-hidden="true">&lsaquo;</span>{{text}}</a></li>',
            'counterRange' => '{{start}} - {{end}} of {{count}}',
            'counterPages' => '{{page}} of {{pages}}',
            'first' => '<li class="first"><a rel="first" href="{{url}}" aria-label="Next"><span aria-hidden="true">&laquo;</span>{{text}}</a></li>',
            'last' => '<li class="last"><a rel="last" href="{{url}}" aria-label="Next">{{text}}<span aria-hidden="true">&raquo;</span></a></li>',
            'number' => '<li><a href="{{url}}">{{text}}</a></li>',
            'current' => '<li class="active"><a href="">{{text}}</a></li>',
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
