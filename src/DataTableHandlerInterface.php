<?php
namespace Widicorp\MetronicDataTableBundle;

/**
 * DataTable handler.
 */
interface DataTableHandlerInterface
{
    const ID = null;

    /**
     * Handles specified DataTable request.
     *
     * @param DataTableQuery $request
     *
     * @throws DataTableException
     *
     * @return DataTableResults
     */
    public function handle(DataTableQuery $request): DataTableResults;
}
