<?php
/**
 * Project database-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/22/2021
 * Time: 01:28
 */

namespace nguyenanhung\Bear\Database;

/**
 * Class Console
 *
 * @package   nguyenanhung\Bear\Database
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Console
{
    /**
     * Function writeLn
     *
     * @param mixed  $message
     * @param string $newLine
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/22/2021 28:39
     */
    public static function writeLn($message, $newLine = "\n")
    {
        if (function_exists('json_encode') && (is_array($message) || is_object($message))) {
            $message = json_encode($message);
        }
        echo $message . $newLine;
    }
}
