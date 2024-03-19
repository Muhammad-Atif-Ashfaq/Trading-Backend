<?php


namespace App\Helpers;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationHelper extends Helper
{
    public static function paginateAndGroup(Builder $query, $perPage, $page, callable $groupByColumn, callable $transformCallback)
    {
        $paginatedResults = $query->paginate($perPage, ['*'], 'page', $page);

        $groupedResults = $paginatedResults->groupBy($groupByColumn);

        $transformedData = $groupedResults->map(function ($records, $groupColumnValue) use ($transformCallback) {
            return $transformCallback($records, $groupColumnValue);
        })->values();

        $slicedResults = array_slice($transformedData->toArray(), ($page - 1) * $perPage, $perPage, true);

        $paginatedGroupedResults = new LengthAwarePaginator(
            $slicedResults,
            $paginatedResults->total(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return $paginatedGroupedResults;
    }

    public static function paginate(Builder $query, $perPage, $page)
    {

        $paginatedResults = $query->paginate($perPage, ['*'], 'page', $page);

        $paginatedCollection = new LengthAwarePaginator(
            $paginatedResults->items(),
            $paginatedResults->total(),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return $paginatedCollection;
    }

    public static function paginateGroupedResults($groupedResults, $perPage, $page)
    {

        $slicedResults = array_slice($groupedResults->toArray(), ($page - 1) * $perPage, $perPage, true);

        $paginatedGroupedResults = new LengthAwarePaginator(
            $slicedResults,
            count($groupedResults),
            $perPage,
            $page,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );

        return $paginatedGroupedResults;
    }
}
