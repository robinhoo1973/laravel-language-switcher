<?php

namespace TopviewDigital\LangSwitcher\Model;

use Illuminate\Database\Eloquent\Model;

class LangSwitcher extends Model
{
    protected $table = '_lang_switcher';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class', 'method', 'middleware', 'enable',
    ];

    public static function registerGuard(array $settings)
    {
        $keys = ['class', 'method', 'middleware', 'enable'];
        $settings = array_intersect_key($settings, array_flip($keys));
        if (!empty(array_intersect(array_keys($settings), $keys))) {
            $enable = $settings['enable'] ?? true;
            unset($settings['enable']);
            $settings = self::firstOrCreate($settings);
            $settings->refresh();
            $settings->enable = $enable ? 1 : 0;
            $settings->save();
        }
    }

    public static function switchLocale($back = false)
    {
        $switch_to = request()->input(config('lang-switch.request.input'));
        self::setLocale($switch_to);
        if ($back) {
            return back();
        }
    }

    public static function setLocale($switch_to = null)
    {
        $field = config('lang-switch.field');

        foreach (self::where('enable', 1)->get() as $guard) {
            $class = $guard->class;
            $method = $guard->method;
            $model = $class::$method();
            if ($model && $model->$field) {
                if ($switch_to) {
                    $model->$field = $switch_to;
                    $model->save();
                }
                app()->setLocale($model->$field);
            }
        }
        if (!request()->session()->has($field) || request()->session()->get($field) != app()->getLocale()) {
            request()->session()->put($field, app()->getLocale());
        }
    }
}
