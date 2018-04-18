<?php

/*
 * This file is part of the Widicorp MetronicDataTableBundle package.
 *
 * (c) Widicorp <info@widitrade.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Widicorp\MetronicDataTableBundle;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * DataTables lookup service.
 */
class DataTables implements DataTablesInterface
{
    protected $logger;

    protected $validator;

    /** @var DataTableHandlerInterface[] List of registered DataTable services. */
    protected $services = [];

    /**
     * Dependency Injection constructor.
     *
     * @param LoggerInterface    $logger
     * @param ValidatorInterface $validator
     */
    public function __construct(LoggerInterface $logger, ValidatorInterface $validator)
    {
        $this->logger = $logger;
        $this->validator = $validator;
    }

    /**
     * Registers specified DataTable handler.
     *
     * @param DataTableHandlerInterface $service service of the DataTable handler
     * @param string                    $id      dataTable ID
     */
    public function addService(DataTableHandlerInterface $service, string $id = null)
    {
        $service_id = $id ?? $service::ID;

        if (null !== $service_id) {
            $this->services[$service_id] = $service;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, string $id): DataTableResults
    {
        $this->logger->debug('Handle DataTable request', [$id]);

        // Retrieve sent parameters.
        $params = new Parameters();

        $keyParams = [
            'datatable', // deprecated in v5.0.7
            'pagination',
            'query',
            'sort',
        ];

        $pagination = $request->get('pagination');

        $start = ($pagination['page'] - 1) * $pagination['perpage'];
        $params->start = ($start > 0 && (!isset($pagination['total']) || $start < $pagination['total'])) ? $start : 0;
        $params->length = $pagination['perpage'];
        $params->search = $request->get('query')['generalSearch'] ?? '';
        $params->order = [$request->get('sort')];

        $allParams = $request->isMethod(Request::METHOD_POST)
            ? $request->request->all()
            : $request->query->all();

        $params->customData = array_diff_key($allParams, array_flip($keyParams));

        // Validate sent parameters.
        $violations = $this->validator->validate($params);

        if (count($violations)) {
            $message = $violations->get(0)->getMessage();
            $this->logger->error($message, ['request']);

            throw new DataTableException($message);
        }

        // Check for valid handler is registered.
        if (!array_key_exists($id, $this->services)) {
            $message = 'Unknown DataTable ID.';
            $this->logger->error($message, [$id]);

            throw new DataTableException($message);
        }

        // Convert sent parameters into data model.
        $query = new DataTableQuery($params);

        // Pass the data model to the handler.
        $result = null;

        $timer_started = microtime(true);

        try {
            $result = $this->services[$id]->handle($query);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage(), [$this->services[$id]]);

            throw new DataTableException($e->getMessage());
        } finally {
            $timer_stopped = microtime(true);
            $this->logger->debug('DataTable processing time', [$timer_stopped - $timer_started, $this->services[$id]]);
        }
        // Validate results returned from handler.
        $violations = $this->validator->validate($result);

        if (count($violations)) {
            $message = $violations->get(0)->getMessage();
            $this->logger->error($message, ['response']);

            throw new DataTableException($message);
        }

        return $result;
    }
}
