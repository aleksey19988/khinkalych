<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSealRequest;
use App\Models\Guest;
use App\Models\Phone;
use App\Models\Seal;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SealController extends Controller
{
    /**
     * Отображение списка печатей
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('seal.index', [
            'title' => 'Список печатей'
        ]);
    }

    /**
     * Отображение формы добавления новой печати
     */
    public function create(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        return view('seal.create', [
            'seal-is-saved' => false,
            'model' => new Seal(),
            'title' => 'Добавление печати',
        ]);
    }

    /**
     * Добавление новой печати в БД
     * Если клиента с таким номером не существует - он создаётся в БД
     */
    public function store(StoreSealRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->validated();
        $phone = Phone::query()->where('number', $request->phone)->first();
        if (!$phone) {
            if (!isset($request->name)) {
                return back()
                    ->withInput()
                    ->with([
                        'success' => true,
                        'show-name-block' => true
                    ]);
            } else {
                ['success' => $dataIsValidate, 'attribute' => $attribute, 'message' => $validateErrorMessage] = $request->validateGuestData();
                if (!$dataIsValidate) {
                    return back()
                        ->withInput()
                        ->withErrors([$attribute => $validateErrorMessage])
                        ->with([
                            'success' => false,
                            'show-name-block' => true,
                            'message' => $validateErrorMessage,
                        ]);
                }

                DB::beginTransaction();
                try {
                    $guest = Guest::query()->create([
                        'name' => $request->name,
                    ]);
                    Phone::query()->create([
                        'number' => $request->phone,
                        'guest_id' => $guest->id,
                    ]);

                    if ($request->sealsCount) {
                        for ($i = 0; $i < $request->sealsCount; $i++) {
                            Seal::query()->create([
                                'guest_id' => $guest->id,
                            ]);
                        }
                    }
                    $seal = Seal::query()->create([
                        'guest_id' => $guest->id,
                    ]);

                } catch (\Throwable $th) {
                    DB::rollBack();
                    return back()
                        ->withInput()
                        ->with([
                            'success' => false,
                            'show-name-block' => true,
                            'message' => $th->getMessage(),
                        ]);
                }

                DB::commit();

                return back()
                    ->withInput()
                    ->with([
                        'success' => true,
                        'seal-is-saved' => true,
                        'is-new-guest' => true,
                        'seals-count' => Seal::query()->where(['guest_id' => $guest->id])->count(),
                        'past-seals-count' => (int)$request->sealsCount,
                        'seal-id' => $seal->id,
                        'guest-name' => $guest->name,
                    ]);
            }
        } else {
            $guest = $phone->guest;
            try {
                $seal = Seal::query()->create([
                    'guest_id' => $guest->id,
                ]);
            } catch (\Throwable $th) {
                return back()
                    ->withInput()
                    ->with([
                        'success' => false,
                        'message' => $th->getMessage(),
                        'seal-is-saved' => false,
                        'is-new-guest' => false,
                        'seals-count' => Seal::query()->where(['guest_id' => $guest->id])->count(),
                    ]);
            }

            return back()->with([
                'success' => true,
                'seal-is-saved' => true,
                'is-new-guest' => false,
                'seals-count' => Seal::query()->where(['guest_id' => $guest->id])->count(),
                'seal-id' => $seal->id,
                'guest-name' => $guest->name
            ]);
        }
    }

    /**
     * Отображение информации о конкретной печати
     */
    public function show(string $id)
    {
        return 'Отображение конкретной печати';
    }

    /**
     * Отображение формы редактирования печати
     */
    public function edit(string $id)
    {
        return 'Форма редактирования печати';
    }

    /**
     * Обновление информации о печати в БД
     */
    public function update(Request $request, string $id)
    {
        return 'Фактическое редактирование печати';
    }

    /**
     * Отмена добавления печати клиенту (удаление данных о печати)
     * Если во время добавления печати создался новый клиент - он и его номер телефона будут удалены из БД
     *
     * @param Request $request
     * @param string $id
     * @return RedirectResponse
     */
    public function destroy(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            $seal = Seal::query()->find($id);

            Seal::query()->where(['id' => $id])->delete();
            if ($request->pastSealsCount) {
                Seal::query()
                    ->where('guest_id', $seal->guest->id)
                    ->orderBy('created_at', 'desc')
                    ->take($request->pastSealsCount)
                    ->delete();
            }

            if (is_null(Seal::query()->where(['guest_id' => $seal->guest->id])->first())) {
                $guest = $seal->guest;
                Phone::query()->where(['guest_id' => $guest->id])->delete();
                Guest::query()->where(['id' => $guest->id])->delete();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with([
                    'success' => false,
                    'is-seal-cancel' => true,
                    'seal-id' => $id,
                    'error-alert-message' => $th->getMessage(),
                ]);
        }

        DB::commit();

        return redirect(route('seals.create'))
            ->with([
                'success' => true,
                'is-seal-cancel' => true,
                'success-alert-message' => 'Данные о печати успешно удалены.',
            ]);
    }
}
