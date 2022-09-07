<?php

function pre($array, $exit = true)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';

    if ($exit) {
        exit();
    }
}

function prepareResult($status, $data, $errors, $msg, $status_code, $pagination = array())
{
    return response()->json(['status' => $status, 'data' => $data, 'message' => $msg, 'errors' => $errors, 'pagination' => $pagination], $status_code);
}

function ajax_response($status, $data, $errors, $msg, $status_code)
{
    return response(['status' => $status, 'data' => $data, 'message' => $msg, 'errors' => $errors, 'status_code' => $status_code]);
}

/**
 * output value if found in object or array
 * @param  [object/array] $model             Eloquent model, object or array
 * @param  [string] $key
 * @param  [boolean] $alternative_value
 * @return [type]
 */
function model($model, $key, $alternative_value = null, $type = 'object', $pluck = false)
{
    if ($pluck) {
        $count = $model;
        $array = array();
        if ($count && count($count)) {
            $array = $count->pluck($key)->toArray();
        }

        if (count($array)) {
            return implode(',', $array);
        }

        return $alternative_value;
    }

    if ($type == 'object') {
        if (isset($model->$key)) {
            return $model->$key;
        }
    }

    if ($type == 'array') {
        if (isset($model[$key]) && $model[$key]) {
            return $model[$key];
        }
    }

    return $alternative_value;
}


function sr($data)
{
    $data = str_replace('[', ' ', $data);
    $data = str_replace(']', '', $data);
    return $data;
}

function getUser()
{
    if (auth()->check()) {
        return auth()->guard('web')->user();
    }
    // return auth('api')->user() ?? ;
}
