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

/**
 * A draw query from mDataTables plugin.
 *
 * @see https://keenthemes.com/metronic/documentation.html#sec14
 *
 * @property int      $start      Index of first row to return, zero-based.
 * @property int      $length     Total number of rows to return (-1 to return all rows).
 * @property Search   $search     Global search value.
 * @property Order[]  $order      Columns ordering (zero-based column index and direction).
 * @property array    $customData Custom data from DataTables.
 */
class DataTableQuery extends ValueObject implements \JsonSerializable
{
    protected $start;

    protected $length;

    protected $search;

    protected $order;

    protected $customData;

    /**
     * Initializing constructor.
     *
     * @param Parameters $params
     */
    public function __construct(Parameters $params)
    {
        $this->start = (int) $params->start;
        $this->length = (int) $params->length;

        $this->search = new Search($params->search);

        $this->order = array_map(function (array $order) {
            return new Order(
                $order['field'],
                $order['sort']
            );
        }, $params->order);

        $this->customData = $params->customData;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        $callback = function (\JsonSerializable $item) {
            return $item->jsonSerialize();
        };

        return [
            'start' => $this->start,
            'length' => $this->length,
            'search' => $this->search,
            'order' => array_map($callback, $this->order),
        ];
    }
}
