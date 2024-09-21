<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;

/**
 * Контроллер, который отвечает за функционал отображения статистики пользователя/сотрудника
 */
class StatisticController extends Controller
{
    public function index()
    {
        return view('utility.statistics', [
            'title' => 'Моя статистика'
        ]);
    }
}
