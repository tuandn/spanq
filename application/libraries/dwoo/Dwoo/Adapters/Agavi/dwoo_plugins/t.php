<?php

/**
 * <strong>Agavi specific plugin</strong>
 *
 * uses AgaviTranslationManager to localize a string
 *
 * <pre>
 *  * string : the string to localize
 * </pre>
 *
 * Examples:
 * <code>
 * {t "Hello"}
 * {t $header}
 * </code>
 *
 * This software is provided 'as-is', without any express or implied warranty.
 * In no event will the authors be held liable for any damages arising from the use of this software.
 *
 * @author     Jordi Boggiano <j.boggiano@seld.be>
 * @copyright  Copyright (c) 2008, Jordi Boggiano
 * @license    http://dwoo.org/LICENSE   Modified BSD License
 * @link       http://dwoo.org/
 * @version    1.0.0
 * @date       2008-10-23
 * @package    Dwoo
 */
function Dwoo_Plugin_t_compile(Dwoo_Compiler $compiler, $string)
{
    return '$this->data[\'tm\']->_(' . $string . ')';
}