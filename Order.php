<?php

namespace Widicorp\MetronicDataTableBundle;

/**
 * Ordering parameters as part of mDataTables request.
 *
 * @see https://keenthemes.com/metronic/documentation.html#sec14
 *
 * @property string $column Column to which ordering should be applied.
 * @property string $dir    Ordering direction for this column.
 */
class Order extends ValueObject implements \JsonSerializable
{
    const ASC  = 'asc';
    const DESC = 'desc';

    protected $column;
    protected $dir;

    /**
     * Initializing constructor.
     *
     * @param string    $column
     * @param string $dir
     */
    public function __construct(string $column, string $dir)
    {
        $this->column = $column;
        $this->dir    = $dir;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'column' => $this->column,
            'dir'    => $this->dir,
        ];
    }
}
