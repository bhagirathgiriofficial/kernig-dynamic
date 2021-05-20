<?php

namespace App\Http\Traits;

trait GetUserData 
{
    /**
     * Get user's all data.
     * 
     * @param  object   $user
     * @param  boolean  $withId
     * @return object
     */
    private function getUserAllData($user, $withId = false)
    {
        // Get user categories
        $user->load([
            'categories' => function ($query) {
                $query->forUser()->active()->ordered();
            }, 
            'city' => function ($query) {
                $query->active();

                $query->whereHas('state', function ($query) {
                    $query->active();

                    $query->whereHas('country', function ($query) {
                        $query->active();
                    });
                });
            }, 
            'education'
        ]);
        //--------------------

        // Get user city's state and country
        if (! is_null($user['city'])) {
            $user->city->load(['state' => function ($query) {
                $query->active();

                $query->with(['country' => function ($query) {
                    $query->active();
                }]);
            }]);
        }
        //----------------------------------

        // Hide id
        if (! $withId) {
            $user->makeHidden('id');
        }
        //--------

        return $user;
    }
}
