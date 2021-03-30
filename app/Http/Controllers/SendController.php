<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\Send;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleXLSX;

class SendController extends Controller
{
    public function send(Request $request)
    {
        $file = $request->file('spreadsheet');

        $subject = $request->input('subject');

        $message = $request->input('message');

        if ( $xlsx = SimpleXLSX::parse($file) ) {
            foreach ($xlsx->rows() as $key => $line) {
                if ($line == '') {
                    continue;
                }

                list(
                    $name,
                    $toEmail
                    ) = $line;

                $currentMessage = preg_replace('/{nome}/', $name, $message);

                SendEmail::dispatch($toEmail, $subject, $currentMessage);

            }
        } else {
            echo SimpleXLSX::parseError();
        }

        return redirect()->back();
    }
}
