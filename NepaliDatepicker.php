<?php
/**
 * @copyright Copyright (c) 2013-2015 tejrajs
 * @link http://tejrajstha.com.np
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace tejrajs\datepicker;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
/**
 * Nepali DatePicker renders a DatePicker input.
 *
 * @author Tej Raj Shrestha <helloteju96@gmail.com>
 * @link http://tejrajstha.com.np
 * @package tejrajs\datepicker
 */
class NepaliDatepicker extends InputWidget
{
    /**
     * @var string the addon markup if you wish to display the input as a component. If you don't wish to render as a
     * component then set it to null or false.
     */
    public $addon = '<i class="glyphicon glyphicon-calendar"></i>';
    /**
     * @var string the template to render the input.
     */
    public $template = '{input}{addon}';
    /**
     * @var bool whether to render the input as an inline calendar
     */
    public $inline = false;
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->inline) {
            $this->options['readonly'] = 'readonly';
            Html::addCssClass($this->options, 'text-center');
        }
        if ($this->size) {
            Html::addCssClass($this->options, 'input-' . $this->size);
            Html::addCssClass($this->containerOptions, 'input-group-' . $this->size);
        }
        Html::addCssClass($this->options, 'form-control');
        Html::addCssClass($this->containerOptions, 'input-group date');
    }
    /**
     * @inheritdoc
     */
    public function run()
    {
        $input = $this->hasModel()
            ? Html::activeTextInput($this->model, $this->attribute, $this->options)
            : Html::textInput($this->name, $this->value, $this->options);
        if ($this->inline) {
            $input .= '<div></div>';
        }
        if ($this->addon && !$this->inline) {
            $addon = Html::tag('span', $this->addon, ['class' => 'input-group-addon']);
            $input = strtr($this->template, ['{input}' => $input, '{addon}' => $addon]);
            $input = Html::tag('div', $input, $this->containerOptions);
        }
        if ($this->inline) {
            $input = strtr($this->template, ['{input}' => $input, '{addon}' => '']);
        }
        echo $input;
        $this->registerClientScript();
    }
    /**
     * Registers required script for the plugin to work as DatePicker
     */
    public function registerClientScript()
    {
        $js = [];
        $view = $this->getView();
        // @codeCoverageIgnoreStart
        NepaliDatepickerAsset::register($view);
        // @codeCoverageIgnoreEnd
        $id = $this->options['id'];
        $selector = ";jQuery('#$id')";
        if ($this->addon || $this->inline) {
            $selector .= ".parent()";
        }
        $options = '';
        $js[] = "$selector.nepaliDatePicker($options);";
        $view->registerJs(implode("\n", $js));
    }
}