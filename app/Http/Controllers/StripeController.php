<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Influencer\User\User;
use App\Infrastructure\API\Stripe\StripeApi;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StripeController extends Controller
{
    public function createAccount(Request $request)
    {
        $user = $request->user();
        if ($user->stripe_acc) {
            return back()->withInput('Account already exist');
        }
        $stripeApi = new StripeApi;

        $account = $stripeApi->createAccount();
        $data['stripe_acc'] = $account->id;
        $user->update($data);

        $res = $stripeApi->onboardingLink($account);
        return redirect()->to($res);
    }

    public function completeOnboarding(Request $request)
    {
        $user = $request->user();
        $stripeApi = new StripeApi;

        $account = $stripeApi->getAccount($user);
        if ($stripeApi->onboardingComplete($account)) {
            return back()->withInput('Account already onboarded');
        }
        $res = $stripeApi->onboardingLink($account);
        return redirect()->to($res);
    }

    public function storeSubscription(Request $request)
    {
        $user = $request->user();
        $stripeApi = new StripeApi;

        $input = $request->all();
        if (isset($request['card_number']) and !isset($request['card_id'])) {
            $request->validate(
                [
                'plan' => ['required', Rule::in(['monthly', 'anual'])],
                'card_number' => 'required|string|max:19',
                'name' => 'required|string|max:50',
                'SecureCard-expiryMonth' => 'required|string|max:2',
                'SecureCard-expiryYear' => 'required|integer|max:39',
                'cvv' => 'required|integer|max:999',
                ]
            );

            $cardData['name'] = $request['name'];
            $cardData['number'] = $request['card_number'];
            $cardData['exp_month'] = $request['SecureCard-expiryMonth'];
            $cardData['exp_year'] = '20'.$request['SecureCard-expiryYear'];
            $cardData['cvc'] = $request['cvv'];
            
            try {
                $card = $stripeApi->createCard($cardData);
                try {
                    $stripeApi->createSetupIntent($user, $card['id']);
                } catch (\Throwable $th) {
                    return redirect()->back()->with('error', $th->getMessage());
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
            }
            
            $cardId = $card->id;

        } else {
            $v = Validator::make(
                $input, [
                    'plan' => ['required', Rule::in(['monthly', 'anual'])],
                    'card_id' => 'required|string|max:50',
                ],
                [
                    'card_id.required' => 'Plese select a saved card to charge for this campaign.',
                ]
            );
            $v->validate();
            $cardId = $request->card_id;
        }

        if ($request->plan == 'monthly') {
            $res = $stripeApi->subscribe($user, $cardId);
        } else {
            $res = $stripeApi->subscribe($user, $cardId, true);
        }

        if ($res->status == 'active') {
            $user->activateSubscription($res->id);
            return redirect('/subscribe')->with('message', 'Subscription activated!');
        }

    }

    public function cancelSubscription(Request $request)
    {
        $user = $request->user();
        $user->cancelSubscription();
        return redirect('/subscribe')->with('message', 'Subscription canceled!');
    }

    public function brandCards(Request $request)
    {
        $user = $request->user();
        $stripeApi = new StripeApi;

        $cards = $stripeApi->getPaymentMethods($user);
        return view('app/user/brand/brand_cards', ['cards'=>$cards]);
    }

    public function storeCard(Request $request)
    {
        $user = $request->user();
        $request->validate(
            [
            'card_number' => 'required|string|max:19',
            'name' => 'required|string|max:50',
            'SecureCard-expiryMonth' => 'required|string|max:2',
            'SecureCard-expiryYear' => 'required|integer|max:39',
            'cvv' => 'required|integer|max:999',
            ]
        );
        
        $cardData['name'] = $request['name'];
        $cardData['number'] = $request['card_number'];
        $cardData['exp_month'] = $request['SecureCard-expiryMonth'];
        $cardData['exp_year'] = '20'.$request['SecureCard-expiryYear'];
        $cardData['cvc'] = $request['cvv'];

        $stripeApi = new StripeApi;

        try {
            $card = $stripeApi->createCard($cardData);

            try {
                $stripeApi->createSetupIntent($user, $card['id']);
                $response_array['status'] = 'success';
                return new JsonResponse([$response_array], 201);
            } catch (\Throwable $th) {
                $response_array['status'] = 'error';
                $response_array['message'] = $th->getMessage();
                return new JsonResponse([$response_array], 201);
            }

        } catch (\Throwable $th) {
            $response_array['status'] = 'error';
            $response_array['message'] = $th->getMessage();
            return new JsonResponse([$response_array], 201);
        }
        
    }

    public function deleteCard(Request $request)
    {
        $request->validate(
            [
            'card_id' => 'required|string|max:100',
            ]
        );
        $stripeApi = new StripeApi;

        try {
            $stripeApi->deleteCard($request['card_id']);
            $response_array['status'] = 'success';
            return new JsonResponse([$response_array], 201);
            
        } catch (\Throwable $th) {
            $response_array['status'] = 'error';
            $response_array['message'] = $th->getMessage();
            return new JsonResponse([$response_array], 201);
        }
    }

}
