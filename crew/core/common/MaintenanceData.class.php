<?php

/**
 * phpVMS - Virtual Airline Administration Software
 * Copyright (c) 2008 Nabeel Shahzad
 * For more information, visit www.phpvms.net
 *	Forums: https://www.phpvms.net/forum
 *	Documentation: https://www.phpvms.net/docs
 *
 * phpVMS is licenced under the following license:
 *   Creative Commons Attribution Non-commercial Share Alike (by-nc-sa)
 *   View license.txt in the root, or visit https://creativecommons.org/licenses/by-nc-sa/3.0/
 *
 * @author Nabeel Shahzad
 * @copyright Copyright (c) 2008, Nabeel Shahzad
 * @link https://www.phpvms.net
 * @license https://creativecommons.org/licenses/by-nc-sa/3.0/
 */

class MaintenanceData extends CodonData {

    public static function optimizeTables() {
        $tables = Config::Get('TABLE_LIST');

        foreach ($tables as $key => $name) {
            $tables[$key] = '`' . TABLE_PREFIX . $name . '`';
        }

        $tables = implode(', ', $tables);
        $sql = 'OPTIMIZE TABLE ' . $tables;
        return DB::get_results($sql);
    }

    public static function resetPIREPCount() {

    }

}