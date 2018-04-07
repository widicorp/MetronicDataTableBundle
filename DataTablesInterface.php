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

use Symfony\Component\HttpFoundation\Request;

/**
 * DataTables lookup service.
 */
interface DataTablesInterface
{
    /**
     * Handles specified DataTable request.
     *
     * @param Request $request original request
     * @param string  $id      dataTable ID
     *
     * @throws DataTableException
     *
     * @return DataTableResults object with data to return in JSON response
     */
    public function handle(Request $request, string $id): DataTableResults;
}
