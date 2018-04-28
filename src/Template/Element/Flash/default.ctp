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
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div class="<?= h($class) ?>"><?= h($message) ?></div>
