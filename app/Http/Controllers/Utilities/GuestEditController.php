<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

/**
 * Контроллер, который отвечает за функционал редактирования данных о клиенте
 */
class GuestEditController extends Controller
{
    /**
     * Отображение страницы ввода номера телефона для проверки кол-ва печатей клиента
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index()
    {
        return view('utility.guest-edit', [
            'title' => 'Редактировать данные о госте'
        ]);
    }
}
