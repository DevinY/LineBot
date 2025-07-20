<?php

namespace Deviny\LineBot;
use Deviny\LineBot\Middleware\Localization;
use Illuminate\Contracts\Http\Kernel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        // 第二個參數 'LineBot' 是設定檔在 config() 載入時的命名空間（key），
        // 這樣你可以透過 config('LineBot.linebot_token') 來取得對應的設定值。
        $this->mergeConfigFrom(__DIR__.'/../config/linebot.php', 'LineBot');
    }
    public function boot()
    {

        //$this->loadRoutesFrom(__DIR__.'/routes.php');
        // return view('linebot::rich-menu')
        $this->loadViewsFrom(__DIR__.'/views/livewire', 'livewire');
        //$this->loadTranslationsFrom(__DIR__.'/lang', 'excelify');
        //$this->registerMiddleware(Localization::class);
        $this->registerLivewireComponents();

        $this->publishes([
            __DIR__.'/../config/linebot.php' => config_path('linebot.php'),
            // __DIR__.'/views' => resource_path('views/deviny/linebot'),
        ]);
    }
    // 如果你要在 ServiceProvider 中註冊 Livewire 元件，可以這樣寫：
    public function registerLivewireComponents()
    {
        if (class_exists(\Livewire\Livewire::class)) {
            // 假設你有一個元件叫 LineBotMessage，放在 Deviny\LineBot\Http\Livewire\LineBotMessage
            try{
                \Livewire\Livewire::component('rich-menu', \Deviny\LineBot\Livewire\RichMenu::class);
            }catch(\Exception $e){
                dd($e->getMessage());
            }
            // 你可以依需求註冊多個元件
        }
    }

    // 並在 boot 方法中呼叫

    protected function registerMiddleware($middleware)
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }
}

