<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreExpenses;
use App\Http\Requests\V1\UpdateExpenses;
use App\Http\Resources\V1\Expenses\IndexExpense;
use App\Http\Resources\V1\Expenses\ShowExpense;
use App\Services\V1\Expenses;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as HttpResponse;

class ExpensesController extends Controller
{
    public function index(Expenses $serviceExpenses): IndexExpense|JsonResponse
    {
        $expenses = $serviceExpenses->index();
        return $expenses->isEmpty() ?  Response::json([], HttpResponse::HTTP_NO_CONTENT) : new IndexExpense($expenses);
    }

    public function show(string $id, Expenses $serviceExpenses): JsonResponse|ShowExpense
    {
        return new ShowExpense($serviceExpenses->show($id));
    }

    public function store(StoreExpenses $request, Expenses $serviceExpenses): JsonResponse
    {
        $storedExpense = $serviceExpenses->store($request['description'], $request['date'], $request['value']);
        if ($storedExpense) {
            return Response::json(
                status: HttpResponse::HTTP_CREATED
            );
        }
        return Response::json(
            [
                'message' => 'Unable to create expense, try again later',
            ],
            status: HttpResponse::HTTP_INTERNAL_SERVER_ERROR
        );
    }

    public function update(UpdateExpenses $request, string $id, Expenses $serviceExpenses): JsonResponse
    {
        $updatedExpense = $serviceExpenses->update($request, $id);
        return $updatedExpense
            ? Response::json(
                status: HttpResponse::HTTP_OK
            )
            : Response::json(
                [
                    'message' =>  'Unable to update expense, try again later',
                ],
                status: HttpResponse::HTTP_INTERNAL_SERVER_ERROR
            );
    }

    public function destroy(string $id, Expenses $serviceExpenses): JsonResponse
    {
        $destroyedExpense = $serviceExpenses->delete($id);
        return $destroyedExpense
            ? Response::json(
                status: HttpResponse::HTTP_OK
            )
            : Response::json(
                [
                    'message' =>  'Unable to delete expense, try again later',
                ],
                status: HttpResponse::HTTP_INTERNAL_SERVER_ERROR
            );
    }
}
