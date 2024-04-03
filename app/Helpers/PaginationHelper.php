<?php


namespace App\Helpers;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class PaginationHelper extends Helper
{
    // TODO: This class provides helper methods for paginating and grouping query results.

    // TODO: Paginates and groups the results of a query.
    // TODO: Parameters:
    // TODO: - $query: The query builder instance.
    // TODO: - $perPage: The number of items per page.
    // TODO: - $page: The current page number.
    // TODO: - $groupByColumn: A callback to specify the column to group by.
    // TODO: - $transformCallback: A callback to transform grouped results.
    // TODO: Returns: A paginated and grouped collection of results.
    public static function paginateAndGroup(Builder $query, $perPage, $page, callable $groupByColumn, callable $transformCallback)
    {
        // TODO: Paginate the query results
        $paginatedResults = $query->paginate($perPage, ['*'], 'page', $page);

        // TODO: Group the paginated results by the specified column
        $groupedResults = $paginatedResults->groupBy($groupByColumn);

        // TODO: Transform the grouped results using the provided callback
        $transformedData = $groupedResults->map(function ($records, $groupColumnValue) use ($transformCallback) {
            return $transformCallback($records, $groupColumnValue);
        })->values();

        // TODO: Slice the transformed data to get the current page's results
        $slicedResults = array_slice($transformedData->toArray(), ($page - 1) * $perPage, $perPage, true);

        // TODO: Create a LengthAwarePaginator instance for the paginated grouped results
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

    // TODO: Paginates the results of a query without grouping.
    // TODO: Parameters:
    // TODO: - $query: The query builder instance.
    // TODO: - $perPage: The number of items per page.
    // TODO: - $page: The current page number.
    // TODO: Returns: A paginated collection of results.
    public static function paginate(Builder $query, $perPage, $page)
    {
        // TODO: Paginate the query results
        $paginatedResults = $query->paginate($perPage, ['*'], 'page', $page);

        // TODO: Create a LengthAwarePaginator instance for the paginated results
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

    // TODO: Paginates the provided grouped results.
    // TODO: Parameters:
    // TODO: - $groupedResults: The grouped results to paginate.
    // TODO: - $perPage: The number of items per page.
    // TODO: - $page: The current page number.
    // TODO: Returns: A paginated collection of grouped results.
    public static function paginateGroupedResults($groupedResults, $perPage, $page)
    {

        // TODO: Slice the grouped results to get the current page's results
        $slicedResults = array_slice($groupedResults->toArray(), ($page - 1) * $perPage, $perPage, true);

        // TODO: Create a LengthAwarePaginator instance for the paginated grouped results
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
