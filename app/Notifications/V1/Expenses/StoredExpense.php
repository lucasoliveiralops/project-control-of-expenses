<?php

namespace App\Notifications\V1\Expenses;

use App\Models\Expenses;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StoredExpense extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(private Expenses $expense)
    {
        $this->onConnection('database');
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Despesa Cadastrada')
                    ->greeting('Olá,')
                    ->line("Foi cadastrado com sucesso a despesa no valor de {$this->expense->value_expense}.");
    }

 }
