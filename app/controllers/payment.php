<?php
class Payment extends Controller
{
    function index()
    {
        // Page Title
        $data['title'] = "Payment";

        $this->view("zay_shop/payment", $data);
    }
    public function setbay()
    {
        show('PAY');
        echo json_encode(['success' => false, 'message' => 'All fields are required!']);
        die;
        require_once('vendor/autoload.php');  // Adjust the path if necessary

        \Stripe\Stripe::setApiKey('sk_test_51OG8HtF26LVJlyTRYZL7TOFnFqTKfdyO9aK70rIoBE8apPg4o6kxfGPSvaTEzzNoC7pvSxtGIUQIcLnca8dAqY1O00DKUEfAfT');

        // Retrieve the token from the client-side
        $token = $_POST['stripeToken'];  // Make sure to adjust this based on your frontend form

        try {
            // Create a charge using the Stripe API
            $charge = \Stripe\Charge::create([
                'amount' => 1000,  // Amount in cents
                'currency' => 'usd',
                'source' => $token,  // Token received from the client
                'description' => 'Example Charge',
            ]);

            // Payment was successful, you can handle success logic here

            // For example, you might store order information in your database
            $orderAmount = $charge->amount;
            $orderId = $charge->id;

            // Return a success response to the client
            echo json_encode(['success' => true, 'message' => 'Payment successful', 'order_id' => $orderId]);
        } catch (\Stripe\Exception\CardException $e) {
            // Handle card errors (e.g., incorrect card number, insufficient funds)
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            // Handle invalid requests
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            // Handle authentication errors
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle other API errors
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
