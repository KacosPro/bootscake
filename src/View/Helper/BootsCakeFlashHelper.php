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
 * BootsCakeFlashHelper class to render flash messages.
 *
 * Based on Cake's FlashHelper
 *
 */
class BootsCakeFlashHelper extends Helper
{

    /**
     * Renders the BootsCake Flash element
     *
     * @param string $key The [Flash.]key you are rendering in the view.
     * @param array $options Additional options to use for the creation of this flash message.
     *    Supports the 'params', and 'element' keys that are used in the helper.
     * @return string|null Rendered flash message or null if flash key does not exist
     *   in session.
     * @throws \UnexpectedValueException If value for flash settings key is not an array.
     */
    public function render($key = 'flash', array $options = [])
    {
        if (!$this->request->session()->check("Flash.$key")) {
            return null;
        }

        $flash = $this->request->session()->read("Flash.$key");
        if (!is_array($flash)) {
            throw new UnexpectedValueException(sprintf(
                'Value for flash setting key "%s" must be an array.',
                $key
            ));
        }
        $this->request->session()->delete("Flash.$key");

        $out = '';
        foreach ($flash as $message) {
            // Here I'm replacing the default Flash element for the BootsCake
            // flash element.
            $message['element'] = str_replace('Flash', 'BootsCake.Flash', $message['element']);
            $message = $options + $message;
            $out .= $this->_View->element($message['element'], $message);
        }

        return $out;
    }

    /**
     * Event listeners.
     *
     * @return array
     */
    public function implementedEvents()
    {
        return [];
    }
}
