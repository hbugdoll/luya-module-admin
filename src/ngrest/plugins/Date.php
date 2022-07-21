<?php

namespace luya\admin\ngrest\plugins;

use luya\admin\ngrest\base\Plugin;
use Yii;

/**
 * Data input field
 *
 * When dealing with empty time values you can configure `emptyMessage` in order to change the display default text in
 * the list view.
 *
 * Example empty Date configuration
 *
 * ```php
 * ['timestamp', ['Date', 'emptyMessage' => 'No Date']],
 * ```
 *
 * @author Basil Suter <basil@nadar.io>
 * @since 1.0.0
 */
class Date extends Plugin
{
    /**
     * @var string This text will be displayed in the list overview when no date has been slected
     * or date is null/empty.
     */
    public $emptyMessage = '-';

    /**
     * @var string Use custom datetime format by [date filter](https://docs.angularjs.org/api/ng/filter/date). Default is 'shortDate'. Use false to take \yii\i18n\Formatter::$dateFormat as fallback.
     * @since 2.0.0
     */
    public $format = 'shortDate';

    /**
     * @inheritdoc
     */
    public function renderList($id, $ngModel)
    {
        $format = $this->format ? $this->format : Yii::$app->formatter->dateFormat;

        return [
            $this->createTag('span', null, ['ng-show' => $ngModel, 'ng-bind' => $ngModel."*1000 | date : '$format'"]),
            $this->createTag('span', $this->emptyMessage, ['ng-show' => '!'.$ngModel]),
        ];
    }

    /**
     * @inheritdoc
     */
    public function renderCreate($id, $ngModel)
    {
        return $this->createFormTag('zaa-date', $id, $ngModel);
    }

    /**
     * @inheritdoc
     */
    public function renderUpdate($id, $ngModel)
    {
        return $this->renderCreate($id, $ngModel);
    }
}
