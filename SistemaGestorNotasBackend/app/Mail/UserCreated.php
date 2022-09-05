<?php

namespace App\Mail;

use App\Models\Alumno;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $student;
    public $password;
    public $dataShow;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Alumno $student, $password)
    {
        $this->user = $user;
        $this->password = $password;
        $this->student = $student;
        $this->dataShow = [
            "username" => $user->username,
            "password" => $password,
            "alumno" => $student->nombre_alumno,
            "date" => Carbon::now()
        ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.userCreated')->subject('Nuevo usuario creado');
    }
}
