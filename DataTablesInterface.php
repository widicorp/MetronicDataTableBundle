<?php

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
     * @param Request $request Original request.
     * @param string  $id      DataTable ID.
     *
     * @throws DataTableException
     *
     * @return DataTableResults Object with data to return in JSON response.
     */
    public function handle(Request $request, string $id): DataTableResults;
}
