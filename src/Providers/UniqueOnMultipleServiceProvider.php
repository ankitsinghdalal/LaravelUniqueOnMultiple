<?php

namespace ankitsinghdalal\UniqueOnMultiple\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class UniqueOnMultipleServiceProvider extends ServiceProvider
{
    /**
     * 
     */
    public function boot()
    {
        Validator::extend('uniqueOfMultiple', function ($attribute, $value, $parameters, $validator) {
            $whereData = [
                [$attribute, $value]
            ];

            foreach ($parameters as $key => $parameter) {

                //At 0th index, we have table name
                if(!$key) {
                    continue;
                }

                $arr = explode('-', $parameter);

                if($arr[0] == 'except') {
                    $column = $arr[1];
                    $data = $arr[2];

                    $whereData[] = [$column, '<>', $data];
                } else {
                    $column = $arr[0];
                    $data = $arr[1];

                    $whereData[] = [$column, $data];
                }
            }

            $count = DB::table($parameters[0])->where($whereData)->count();
            return $count === 0;
        });
    }
}
