<?php

if (!function_exists('hashDecodeId')) {
    /**
     * Function decode a hash
     *
     * @param string $id
     * @return Integer
     */
    function hashDecodeId(
        string $id
    ) {
        return \Vinkla\Hashids\Facades\Hashids::decode($id);
    }
}

if (!function_exists('hashEncodeId')) {
    /**
     * Function hash encode id
     *
     * @param integer $id
     * @return String
     */
    function hashEncodeId(
        int $id
    ) {
        return \Vinkla\Hashids\Facades\Hashids::encode($id);
    }
}
