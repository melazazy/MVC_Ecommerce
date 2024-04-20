<?php
class WishlistController extends Controller
{
    function index()
    {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $list = $this->loadModel('Wishlist');
            $items = $list->getList($user_id);
            return $items;
        } else {
            return false;
        }
    }

    function addTolist()
    {
        // Assuming you're using native PHP MVC without a framework
        $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : null;
        $product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;

        // Validate user_id and product_id if necessary

        if ($user_id !== null && $product_id !== null) {
            // Perform the logic to add the product to the cart
            $list = $this->loadModel('Wishlist');
            $result = $list->addToList($user_id, $product_id);
            $listCount = $list->getListQuantity($user_id);

            header('Content-Type: application/json');
            echo ($listCount);
            exit;
        }

        // If the parameters are missing, return an error JSON response
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Missing parameters: user_id and product_id are required.']);
        exit;
    }


    public function getList()
    {
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $list = $this->loadModel('Wishlist');
            $items = $list->getList($user_id);
            // Convert PHP array to JSON string
            $jsonString = json_encode($items);

            // Set the content type to JSON
            header('Content-Type: application/json');

            // Output the JSON string
            echo $jsonString;
        } else {
            return false;
        }
    }
}
