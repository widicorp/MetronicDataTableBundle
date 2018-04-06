<?php
namespace Widicorp\MetronicDataTableBundle;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Sent parameters from DataTables plugin.
 *
 * @see https://keenthemes.com/metronic/documentation.html#sec14
 *
 * @property int    $start      Index of first row to return, zero-based.
 * @property int    $length     Total number of rows to return (-1 to return all rows).
 * @property string $search     Global search value.
 * @property array  $order      Columns ordering (zero-based column index and direction).
 * @property array  $customData Custom data from DataTables.
 */
class Parameters
{
    /**
     * @Assert\NotNull
     * @Assert\GreaterThanOrEqual(value="0")
     */
    public $start = 0;

    /**
     * @Assert\NotNull
     * @Assert\GreaterThanOrEqual(value="-1")
     */
    public $length = -1;

    /**
     * @Assert\NotNull
     * @Assert\Length(max="100")
     */
    public $search = '';

    /**
     * @Assert\NotNull
     * @Assert\Type(type="array")
     * @Assert\All({
     *     @Assert\Collection(
     *         fields={
     *             "field" = {
     *                @Assert\Length(max="100")
     *             },
     *             "sort" = {
     *                 @Assert\Choice(choices={"asc", "desc"}, strict=true)
     *             }
     *         },
     *         allowExtraFields=false,
     *         allowMissingFields=false
     *     )
     * })
     */
    public $order = [];

    /**
     * @Assert\Type(type="array")
     */
    public $customData = [];
}
