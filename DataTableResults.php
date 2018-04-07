<?php

/*
 * This file is part of the Widicorp KafkaBundle package.
 *
 * (c) Widicorp <info@widitrade.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Widicorp\MetronicDataTableBundle;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Data to return to DataTables plugin.
 *
 * @see https://keenthemes.com/metronic/documentation.html#sec14
 *
 * @property int    $page    Page number, before filtering.
 * @property int    $pages   Total pages, before filtering.
 * @property int    $perpage Total records per page, before filtering.
 * @property int    $total   Total records, before filtering.
 * @property string $sort    Sort direction, before filtering.
 * @property string $field   Sort field, before filtering.
 * @property array  $data    The data to be displayed in the table.
 */
class DataTableResults implements \JsonSerializable
{
    /**
     * @Assert\NotNull
     * @Assert\GreaterThanOrEqual(value="0")
     */
    public $page = 0;

    /**
     * @Assert\NotNull
     * @Assert\GreaterThanOrEqual(value="0")
     */
    public $pages = 0;

    /**
     * @Assert\NotNull
     * @Assert\GreaterThanOrEqual(value="0")
     */
    public $perpage = 0;

    /**
     * @Assert\NotNull
     * @Assert\GreaterThanOrEqual(value="0")
     */
    public $total = 0;

    /**
     * @Assert\NotNull
     * @Assert\Choice(choices={"asc", "desc"}, strict=true)
     */
    public $sort = 'asc';

    /**
     * @Assert\NotNull
     */
    public $field = '';

    /**
     * @Assert\NotNull
     * @Assert\Type(type="array")
     */
    public $data = [];

    /**
     * Convert results into array as expected by DataTables plugin.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'meta' => [
                'page' => $this->page,
                'pages' => $this->pages,
                'perpage' => $this->perpage,
                'total' => $this->total,
                'sort' => $this->sort,
                'field' => $this->field,
            ],
            'data' => $this->data,
        ];
    }
}
