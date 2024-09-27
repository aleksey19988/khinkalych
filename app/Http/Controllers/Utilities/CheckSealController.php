<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckSealsRequest;
use App\Models\Phone;
use App\Models\Seal;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

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

    /**
     * Проверка кол-ва печатей по номеру телефона
     *
     * @param CheckSealsRequest $request
     * @return RedirectResponse
     */
    public function check(CheckSealsRequest $request)
    {
        $request->validated();
        $phone = Phone::query()->where('number', $request->phone)->first();

        if (!$phone) {
            return back()
                ->withInput()
                ->with([
                    'success' => true,
                    'is-checked' => true,
                    'phone-is-expected' => false,
                    'message' => 'Не нашли такой номер телефона',
                ]);
        } else {
            $sealsCount = Seal::query()->where('guest_id', $phone->guest_id)->count();
            return back()
                ->withInput()
                ->with([
                    'success' => true,
                    'is-checked' => true,
                    'phone-is-expected' => true,
                    'seals-count' => $sealsCount,
                    'guest-name' => $phone->guest->name
                ]);
        }
    }
}
