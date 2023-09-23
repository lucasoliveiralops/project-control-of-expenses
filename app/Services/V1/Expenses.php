<?php

namespace App\Services\V1;

use App\Http\Requests\V1\UpdateExpenses;
use App\Models\Expenses as ModelsExpenses;
use App\Notifications\V1\Expenses\StoredExpense;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;

class Expenses
{

    public function index(): Collection
    {
        return ModelsExpenses::where('user_id', '=', auth()->user()->id)->get();
    }

    public function show(int $id): ModelsExpenses
    {
        $currentExpense =  ModelsExpenses::findOrFail($id);
        Gate::authorize('view', $currentExpense);
        return $currentExpense;
    }

    public function store(string $description, string $date, float $value): bool
    {
        $expense = ModelsExpenses::create([
            'description_expense' => $description,
            'user_id' => auth()->user()->id,
            'value_expense' => $value,
            'date_expense' => $date,
        ]);
        if ($expense) {
            $currentUser = auth()->user();
            $currentUser->notify((new StoredExpense($expense)));
            return true;
        }
        return false;
    }

    public function update(UpdateExpenses $newDataByRequest, string $id): bool
    {
        $currentExpense = $this->show($id);
        Gate::authorize('update', $currentExpense);
        $currentExpense->description_expense = $newDataByRequest->description ?? $currentExpense->description_expense;
        $currentExpense->date_expense = $newDataByRequest->date ?? $currentExpense->date_expense;
        $currentExpense->value_expense = $newDataByRequest->value ?? $currentExpense->value_expense;
        return $currentExpense->update();
    }

    public function delete(string $id): bool
    {
        $currentExpense = $this->show($id);
        Gate::authorize('delete', $currentExpense);
        return $currentExpense->delete();
    }
}
