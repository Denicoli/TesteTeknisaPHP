<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Email;
use Illuminate\Http\Request;
use Monolog\Handler\FirePHPHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class EmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function add(Request $request)
    {
        $emails = [];
        foreach (array_unique($request->emails) as $email) {
            if (Email::filter($email)) {
                $emails[] = $email;
                if (file_exists('../emails.txt')) {
                    if (strpos(file_get_contents("../emails.txt"), $email) === false) {
                        \file_put_contents('../emails.txt', $email . chr(13) . chr(10), FILE_APPEND);
                    }
                } else {
                    \file_put_contents('../emails.txt', $email . chr(13) . chr(10), FILE_APPEND);
                }
            }
        }

        $emails = Email::sort($emails);
        foreach ($emails as $email) {
            \file_put_contents('../emails_' . Carbon::now()->format('Y-m-d-H-i-s') . '.txt', $email . chr(13) . chr(10), FILE_APPEND);
        }


        return response()
            ->json([
                'data' => [
                    'message' => 'E-mails adicionados com sucesso!'
                ]
            ]);
    }


    public function send(Request $request)
    {
        $emails = file('../emails.txt', FILE_SKIP_EMPTY_LINES);
        $sent = 0;
        $fail = 0;
        foreach ($emails as $email) {
            $result = (new Email($email))->send();
            $result ? $sent++ : $fail++;
            $log = new Logger('email');
            $log->pushHandler(new StreamHandler(storage_path() . '/logs/' . ($result ? 'sent' : 'fail') . '.log', Logger::DEBUG));
            $log->pushHandler(new FirePHPHandler());
            $log->info('Hora: ' . Carbon::now()->format('d/m/Y H:i.s') . ' - Email: ' . $email . ' - Assunto: ' . $request->subject);
        }

        return response()
            ->json([
                'emails' => count($emails),
                'emails_sent' => $sent,
                'emails_fail' => $fail
            ]);
    }
    //
}
