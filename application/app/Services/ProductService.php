<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ProductService
{
    public function getFilteredProducts(array $filters): LengthAwarePaginator
    {
        $query = Product::query();

        // q — поиск по подстроке в name
        if (filled($filters['q'] ?? null)) {
            $query->whereFullText('name', $filters['q']);
        }

        // price_from, price_to
        if (filled($filters['price_from'] ?? null)) {
            $query->where('price', '>=', $filters['price_from']);
        }

        if (filled($filters['price_to'] ?? null)) {
            $query->where('price', '<=', $filters['price_to']);
        }

        // category_id
        if (filled($filters['category_id'] ?? null)) {
            $query->where('category_id', $filters['category_id']);
        }

        // in_stock (true/false)
        if (filled($filters['in_stock'] ?? null)) {
            $query->where('in_stock', $filters['in_stock']);
        }

        // rating_from
        if (filled($filters['rating_from'] ?? null)) {
            $query->where('rating', '>=', $filters['rating_from']);
        }

        $this->applySorting($query, $filters['sort'] ?? null);

        return $query->paginate(20);
    }

    private array $sortStrategies = [
        'price_asc' => ['price', 'asc'],
        'price_desc' => ['price', 'desc'],
        'rating_desc' => ['rating', 'desc'],
        'newest' => ['created_at', 'desc'],
    ];

    private function applySorting($query, ?string $sort): void
    {
        $strategy = $this->sortStrategies[$sort] ?? $this->sortStrategies['newest'];
        $query->orderBy($strategy[0], $strategy[1]);
    }
}
