<?php
/**
 * Project database-helper
 * Created by PhpStorm
 * User: 713uk13m <dev@nguyenanhung.com>
 * Copyright: 713uk13m <dev@nguyenanhung.com>
 * Date: 09/22/2021
 * Time: 01:25
 */

namespace nguyenanhung\Bear\Database;

use Exception;
use PDO;
use PDOException;

/**
 * Class Support
 *
 * @package   nguyenanhung\Bear\Database
 * @author    713uk13m <dev@nguyenanhung.com>
 * @copyright 713uk13m <dev@nguyenanhung.com>
 */
class Support
{
    /**
     * Function connectUsePhpTelnet
     *
     * @param string $hostname
     * @param string $port
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/22/2021 27:45
     */
    public static function connectUsePhpTelnet($hostname = '', $port = '')
    {
        $message = 'Connection to server ' . $hostname . ':' . $port . '';
        try {
            $socket = fsockopen($hostname, $port);
            if ($socket) {
                $code = true;
            } else {
                $code = false;
            }
            $result = array(
                'code'    => $code,
                'message' => $message,
                'status'  => $code === true ? 'OK' : 'NOK'
            );
        } catch (Exception $exception) {
            $result = array(
                'code'    => false,
                'message' => $message,
                'status'  => $exception->getMessage()
            );
        }

        return $result;
    }

    /**
     * Function phpTelnet
     *
     * @param string $hostname
     * @param string $port
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/22/2021 29:20
     */
    public static function phpTelnet($hostname = '', $port = '')
    {
        $result = self::connectUsePhpTelnet($hostname, $port);
        Console::writeLn($result['message'] . ' -> ' . $result['status']);
    }

    /**
     * Function checkConnectDatabaseWithPDO
     *
     * @param string     $host
     * @param string|int $port
     * @param string     $database
     * @param string     $username
     * @param string     $password
     *
     * @return array
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/22/2021 30:55
     */
    public static function checkConnectDatabaseWithPDO($host = '', $port = '', $database = '', $username = '', $password = '')
    {
        try {
            $dsnString = "mysql:host=$host;port=$port;dbname=$database";
            $conn      = new PDO($dsnString, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result = array(
                'code'    => true,
                'message' => "Connected successfully to Database : " . $dsnString . " with username: " . $username . " and your input password"
            );
            $conn   = null;
        } catch (PDOException $e) {
            $result = array(
                'code'    => false,
                'message' => "Connection failed: " . $e->getMessage(),
                'error'   => $e->getTraceAsString()
            );
        }

        return $result;
    }

    /**
     * Function checkConnectDatabase
     *
     * @param string     $host
     * @param string|int $port
     * @param string     $database
     * @param string     $username
     * @param string     $password
     *
     * @author   : 713uk13m <dev@nguyenanhung.com>
     * @copyright: 713uk13m <dev@nguyenanhung.com>
     * @time     : 09/22/2021 31:17
     */
    public static function checkConnectDatabase($host = '', $port = '', $database = '', $username = '', $password = '')
    {
        $result = self::checkConnectDatabaseWithPDO($host, $port, $database, $username, $password);
        Console::writeLn($result['message']);
        if (isset($result['error'])) {
            Console::writeLn($result['error']);
        }
    }
}
