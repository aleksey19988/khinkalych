<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

/**
 * Контроллер, который отвечает за функционал проверки печатей клиента
 */
class CheckSealController extends Controller
{
    /**
     * Отображение страницы ввода номера телефона для проверки кол-ва печатей клиента
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index()
    {
        return view('utility.check-seals', [
            'title' => 'Проверить кол-во печатей',
        ]);
    }
}
