<?php

namespace Okolaa\TermiiPHP\Data;

use Saloon\Http\Response;

/**
 * @template D
 */
class PaginatedData
{
    /**
     * @param array<int, D> $data
     * @param int $currentPage
     * @param int $lastPage
     * @param int $total
     * @param int $perPage
     * @param int $from
     * @param int $to
     */
    public function __construct(
        public readonly array $data,
        public readonly int   $currentPage,
        public readonly int   $lastPage,
        public readonly int   $total,
        public readonly int   $perPage,
        public readonly int   $from,
        public readonly int   $to,
    )
    {
    }

    /**
     * @param class-string<D> $dtoClass
     * @return self<D>
     */
    public static function fromResponse(Response $response, string $dtoClass): PaginatedData
    {
        $pagination = $response->json();
        /** @var array<int, D> $data */
        $data = array_map(
            fn(array $item) => $dtoClass::fromArray($item),
            $pagination['data']
        );

        return new PaginatedData(
            data: $data,
            currentPage: $pagination['current_page'] ?? $pagination['meta']['current_page'],
            lastPage: $pagination['last_page'] ?? $pagination['meta']['last_page'],
            total: $pagination['total'] ?? $pagination['meta']['total'],
            perPage: $pagination['per_page'] ?? $pagination['meta']['per_page'],
            from: $pagination['from'] ?? $pagination['meta']['from'],
            to: $pagination['to'] ?? $pagination['meta']['to'],
        );
    }
}