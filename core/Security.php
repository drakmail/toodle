<?php
/**
 * TOODLE
 *
 * PHP Version 5.3
 *
 * @category  Framework
 * @package   Core
 * @author    Alexander Maslov <it@delta-z.ru>
 * @copyright 2011 Alexader Maslov (http://www.delta-z.ru)
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GPL v3
 * @link      https://github.com/drakmail/toodle
 */

namespace toodle\core;

/**
 * Security utils
 */
class Security
{
    /**
     * Returns escaped string for user-content insertion
     * @static
     * @param string $string
     * @return string
     */
    public static function safeStr($string)
    {
        //TODO: check autoescape
        return htmlspecialchars($string);
    }

    /**
     * Returns unified float for DB insertion or other things. Doesn't depend on locale
     * @static
     * @param float $float
     * @return string
     */
    public static function safeFloat($float)
    {
        $locale_arr = localeconv();
        $search = array(
            $locale_arr['decimal_point'],
            $locale_arr['mon_decimal_point'],
            $locale_arr['thousands_sep'],
            $locale_arr['mon_thousands_sep'],
            $locale_arr['currency_symbol'],
            $locale_arr['int_curr_symbol']
        );
        $replace = array('.', '.', '', '', '', '');
        return str_replace($search, $replace, $float);
    }
}

?>