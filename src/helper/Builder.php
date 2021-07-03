<?php
/*
 * Author: zsw zswemail@qq.com
 */

namespace surface\helper;

use surface\form\Form;
use surface\Factory;
use surface\table\Table;

class Builder
{

    public static function form(FormAbstract $model): Form
    {
        return Factory::form(
            function (Form $form) use ($model)
            {
                if (method_exists($model, 'init')) {
                    $model->init($form);
                }
                $form->options($model->options());
                $form->columns($model->columns());
            }
        );
    }

    public static function table(TableAbstract $model): Table
    {
        return Factory::table(
            function (Table $table) use ($model)
            {
                if (method_exists($model, 'init')) {
                    $model->init($table);
                }

                if (null !== $searchModel = $model->search()) {
                    $search = static::form($searchModel);
                    $table->search($search);
                }

                $table->options($model->options());
                $table->columns($model->columns());
                ($header = $model->header()) && $table->header($header);
                ($pagination = $model->pagination()) && $table->pagination($pagination);
            }
        );
    }

}
