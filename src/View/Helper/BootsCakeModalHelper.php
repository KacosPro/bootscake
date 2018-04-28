<?php
/**
 * BoostCake
 *
 * Bootstrap helpers for CakePHP 3.x
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.md
 * Redistributions of files must retain the above copyright notice.
 *
 * @author     Carlos Proaño <c@rlos.pro>
 * @copyright  2018 Carlos Proaño
 * @license    https://opensource.org/licenses/MIT MIT License
 * @link       https://github.com/KacosPro/bootscake
 * @since      File available since Release 0.0.4
 */
namespace BootsCake\View\Helper;

use Cake\View\Helper;
use UnexpectedValueException;

/**
 * FlashHelper class to render flash messages.
 *
 * After setting messages in your controllers with FlashComponent, you can use
 * this class to output your flash messages in your views.
 */
class BootsCakeModalHelper extends Helper
{

    /**
     * Used to render a Modal Component
     *
     *
     * @param array $options Additional options to use for the creation of this flash message.
     *    Supports the 'params', and 'element' keys that are used in the helper.
     * @return string|null Rendered Modal
     */
    public function render(array $options = [])
    {
        $out = '';
        $out .= $this->_View->element('BootsCake.Modal/default');

        return $out;
    }
}
