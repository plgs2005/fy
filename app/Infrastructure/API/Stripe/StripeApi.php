<?php
namespace App\Infrastructure\API\Stripe;

use App\Influencer\User\User;

class StripeApi
{
    protected $key;
    protected $stripe;
    protected $monthlyPrice;
    protected $anualPrice;

    function __construct()
    {
        $this->key = env('STRIPE_API_KEY');
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_API_KEY'));
        $this->monthlyPrice = 'price_1IGhqAH3vdD88rQIB7k406vE';
        $this->anualPrice = 'price_1IGhqAH3vdD88rQI0XHkibhu';
    }

    /**
     * Creates stripe connected account
     * 
     * @param Object $user required
     *
     * @return Object Account
     */
    public function createAccount()
    {
        $res = $this->stripe->accounts->create(
            [
            'type' => 'express',
            ]
        );
        return $res;
    }

    /**
     * Gets a stripe connected account info of a user
     * 
     * @param Object $user required
     *
     * @return Object Account
     */
    public function getAccount($user)
    {
        if ($user->stripe_acc) {

            $res = $this->stripe->accounts->retrieve(
                $user->stripe_acc,
                []
            );
            return $res;
        } else {
            return false;
        }
    }

    public function updateAccount($user)
    {
        $this->stripe->accounts->update(
            $user->stripe_acc,
            [
                'settings' =>
                [
                    'payouts' =>
                    [
                        'schedule'=>
                        [
                            'interval'=>'manual',
                        ]
                    ],
                ],
            ],
        );
    }

    /**
     * Checks if a connected account has completed the onboarding process
     * 
     * @param Object $account required
     *
     * @return Boolean True | False
     */
    public function onboardingComplete($account)
    {
        if ($account->charges_enabled == true AND $account->details_submitted == true AND $account->payouts_enabled == true) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Creates a onboarding link for a connected account
     * 
     * @param Object $account required
     *
     * @return String Onboarding Link
     */
    public function onboardingLink($account)
    {
        $res = $this->stripe->accountLinks->create(
            [
            'account' => $account->id,
            'refresh_url' => 'https://example.com/reauth',
            'return_url' => url('/settings'),
            'type' => 'account_onboarding',
            'collect' =>'eventually_due',
            ]
        );

        return $res->url;
    }

    /**
     * Creates a login link for a connected account
     * 
     * @param Object $account required
     *
     * @return String Login Link or false
     */
    public function loginLink($account)
    {
        try {
            $res = $this->stripe->accounts->createLoginLink(
                $account->id,
                []
            );
        } catch (\Throwable $th) {
            return false;
        }
            return $res->url;
    }

    /**
     * Gets the stripe customer object for this user or false if it doesen't have a customer id
     * 
     * @param Object $user required
     *
     * @return Object  Stripe Customer | false
     */
    public function getCustomer($user)
    {
        if ($user->stripe_cus_id) {

            $res = $this->stripe->customers->retrieve(
                $user->stripe_cus_id,
                []
            );
            return $res;
        } else {
            return false;
        }
    }

    /**
     * Creates a customer
     * 
     * @param Object $user required
     *
     * @return Object Stripe Customer
     */
    public function createCustomer($user)
    {
        $res = $this->stripe->customers->create(
            [
            'description' => $user->brand_name,
            'name' => $user->brand_name,
            'email' => $user->email,
            'metadata' => [
                'type' => 'brand',
                'id' => $user->id,
            ]
            ]
        );
        $user->stripe_cus_id = $res->id;
        $user->save();
        return $res->id;
    }

    /**
     * Creates a payment methos of type card with the suplied data
     * 
     * @param Array Card details
     *
     * @return Object Payment method
     */
    public function createCard($cardData = null)
    {
        $res = $this->stripe->paymentMethods->create(
            [
            'type' => 'card',
                'card' => 
                [
                    'number' => $cardData['number'],
                    'exp_month' => $cardData['exp_month'],
                    'exp_year' => $cardData['exp_year'],
                    'cvc' => $cardData['cvc'],
                ],
                'billing_details'=> [
                    'name'=> $cardData['name'],
                ],
            ]
        );
        
        return $res;
    }

    public function deleteCard($cardId)
    {
        $res = $this->stripe->paymentMethods->detach(
            $cardId,
            []
        );
          return $res;
    }

    public function createSetupIntent($user, $payment_method_id)
    {
        $res = $this->stripe->setupIntents->create(
            [
            'payment_method_types' => ['card'],
            'customer'=>$user->stripe_cus_id,
            'confirm'=>true,
            'payment_method'=>$payment_method_id,
            ]
        );
        return $res;
    }

    /**
     * Creates session for card setup on stripe
     * 
     * @param Object $user required
     *
     * @return Object Setup session
     */
    public function setupCard($user)
    {
        $res = $this->stripe->checkout->sessions->create(
            [
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'http://influencify/brand-settings',
            'payment_method_types' => ['card'],
            'mode' => 'setup',
            'customer' => $user->stripe_cus_id,
            ]
        );
        return $res;
    }

    /**
     * Gets a customer payment methods
     * 
     * @param Object $user required
     *
     * @return Object Collection os payment methods
     */
    public function getPaymentMethods($user)
    {
        if ($user->stripe_cus_id) {
            $res = $this->stripe->paymentMethods->all(
                [
                'customer' => $user->stripe_cus_id,
                'type' => 'card',
                ]
            );
            return $res;
        } else {
            return false;
        }
    }

    public function subscribe($user, $card_id, $anual = false)
    {
        if ($anual) {
            $price = $this->anualPrice;
            $plan = 'anual';
        } else {
            $price = $this->monthlyPrice;
            $plan = 'monthly';
        }
        
        $res = $this->stripe->subscriptions->create(
            [
                'customer' => $user->stripe_cus_id,
                'items' => [
                    ['price' => $price],
                ],
                'default_payment_method' => $card_id,
                'metadata' => [
                    'userType' => 'brand',
                    'userId' => $user->id,
                ],
            ]
        );
        return $res;
    }

    public function cancelSubscription($id)
    {
        $res = $this->stripe->subscriptions->update(
            $id,
            [   
                'cancel_at_period_end' => true,
            ]
        );
        return $res;
    }

    public function subscribeOld($user, $anual = false)
    {
        if ($anual) {
            $price = $this->anualPrice;
            $plan = 'anual';
        } else {
            $price = $this->monthlyPrice;
            $plan = 'monthly';
        }

        if (!$user->stripe_cus_id) {
            $user->stripe_cus_id = $this->createCustomer($user);
        }

        if ($user->checkout_session) {
            $res = $this->retrieveCheckoutSession($user->checkout_session);
            return $res;
        } else {
            $res = $this->stripe->checkout->sessions->create(
                [
                'success_url' => url('/subscribe-success/', [$user->id]),
                'cancel_url' => 'https://example.com/cancel',
                'payment_method_types' => ['card'],
                'customer' => $user->stripe_cus_id,
                'line_items' => [
                [
                    'price' => $price,
                    'quantity' => 1,
                ],
                ],
                'metadata' => [
                    'userType' => 'brand',
                    'type' => 'subscription',
                    'plan' => $plan,
                ],
                'mode' => 'subscription',
                ]
            );
            $user->checkout_session = $res->id;
            $user->save();
            
            return $res;
        }
    }

    public function getCustomerSubscription($user)
    {
        if ($user->stripe_subscription_id) {
            $res = $this->stripe->subscriptions->retrieve(
                $user->stripe_subscription_id,
                []
            );
        } else {
            return false;
        }
        return $res;
    }

    public function retrieveCheckoutSession($session)
    {
        $res = $this->stripe->checkout->sessions->retrieve(
            $session,
            []
        );
        return $res;
    }

    public function listTransfers($group = null)
    {
        if ($group) {
            $res = $this->stripe->transfers->all(['limit' => 100, 'transfer_group'=>$group]);
        } else {
            $res = $this->stripe->transfers->all(['limit' => 100]);
        }
        return $res;
    }

    /**
     * Transfers funds from our account to the especified account
     * 
     * @param string $account  Account funds will be transfered to
     * @param int    $amount   Amount to be transfered in cents
     * @param string $group    Transfer group for identification
     * @param array  $metadata Set of key-value pairs that you can attach to this object.
     * 
     * @return Object Stripe object
     */
    public function transfer($account, $amount, $group, $metadata)
    {
        $res = $this->stripe->transfers->create(
            [
            'amount' => $amount,
            'currency' => 'cad',
            'destination' => $account,
            'transfer_group' => $group,
            'metadata'=>$metadata,
            ]
        );
        return $res;
    }

    public function getBalance($account)
    {
        $res = $this->stripe->balance->retrieve([], ['stripe_account' => $account]);
        return $res;
    }

    public function bankAccounts($user)
    {
        $res = $this->stripe->accounts->allExternalAccounts(
            $user->stripe_acc,
            ['object' => 'bank_account', 'limit' => 10]
        );
        if ($res) {
            return $res->data;
        } else {
            return false;
        }
    }

    public function payout($bank, $account, $amount)
    {
        $res = $this->stripe->payouts->create(
            [
            'amount' => $amount,
            'currency' => 'cad',
            'destination' => $bank,
            ],
            [
                'stripe_account' => $account
            ]
        );
        return $res;
    }

    public function createPaymentIntent($user, $amount, $metadata)
    {
        $res = $this->stripe->paymentIntents->create(
            [
            'customer'=>$user->stripe_cus_id,
            'amount' => $amount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            'metadata' => $metadata
            ]
        );
        return $res;
    }

    public function confirmPaymentIntent($id, $cardId)
    {
        $res = $this->stripe->paymentIntents->confirm(
            $id,
            ['payment_method' => $cardId]
        );
        return $res;
    }

    public function capturePaymentIntent()
    {
        
    }

    public function getCharges($user)
    {
        $res = $this->stripe->charges->all(['customer'=>$user->stripe_cus_id]);
        return $res;
    }

    public function getCards($user)
    {
        $res = $this->stripe->customers->allSources($user->stripe_cus_id, ['object'=>'card', 'limit'=>100]);
        return $res;
    }
}
