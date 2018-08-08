<?php
namespace App\Http\Controllers;

use App\User;
use \Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * subscribe the user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function subscribe(Request $request) {
        $response = ['success' => false, 'errors' => []];
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
        ]);

        if ($validator->fails()) {
            $response['errors'] = $validator->errors()->all();
            return response()->json($response);
        }

        Newsletter::subscribe($request->email, ['name' => $request->name]);

        $encryptedEmail = Crypt::encryptString($request->email);
        $href = env('APP_URL') . '/user/confirmEmail/' . $encryptedEmail;

        $email = $request->email;
         \Mail::send('emails.confirm', ['href' => $href, 'name' => $request->name], function ($m) use ($email){
            $m->from('kamo.harutyunyan@esterox.am', 'My app');

            $m->to($email)->subject('Your Reminder!');
        });
        return response()->json($response);
    }

    public function confirmEmail($encryptedValue) {
        try {
            $decryptedEmail = Crypt::decryptString($encryptedValue);
            $member = Newsletter::getMember($decryptedEmail);
            if (isset($member['email_address'])) {
                $checkUser = User::whereEmail($member['email_address'])->first();
                if ($checkUser) {
                    return redirect('/home');
                }
                $user = new User();
                $user->name = $member['merge_fields']['FNAME'] . ' ' .$member['merge_fields']['LNAME'];
                $user->email = $member['email_address'];
                $user->password = '';
                if ($user->save()) {
                    return redirect('/home');
                }
            }
            return redirect('/');
        } catch (DecryptException $e) {
            return redirect('/');
        }

    }
}