<?php

namespace App\Listeners;

use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use Illuminate\Support\Facades\Session;
use Modules\Users\Entities\User;
use App\Classes\Saml\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use App\NafazUser;
use Illuminate\Support\Facades\Auth;

class Saml2LoginListener
{
    private const ATTR_PATH = 'http://iam.gov.sa/claims/';
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Saml2LoginEvent  $event
     * @return void
     */
    public function handle(Saml2LoginEvent $event)
    {

        try {
            $messageId = $event->getSaml2Auth()->getLastMessageId();
            Session::put(['sessionIndex' => $event->getSaml2User()->getSessionIndex()]);
            Session::put(['nameId' => $event->getSaml2User()->getNameId()]);
            $userData = $event->getSaml2User()->getAttributes();
            $user_id = $userData[self::ATTR_PATH . 'userid'][0];
            $nafaz_user = NafazUser::where('national_id',$user_id)->count();
            $user = User::where('national_id',$user_id)->first();
            if($user) {
                $response = Response::formatResponse($userData);
                if(!$nafaz_user)
                    $nafaz_user = NafazUser::create($response);
                Auth::login($user);
            }
            else
            session()->flash('sso_login_error', __('messages.sso_user_not_auth'));


        }catch (ModelNotFoundException $ex ) {
            session()->flash('sso_login_error', __('messages.sso_user_not_auth'));
        }catch (Exception $ex ) {
            session()->flash('sso_login_error', __('messages.ssounexpected_error'));
        }


    }
}
