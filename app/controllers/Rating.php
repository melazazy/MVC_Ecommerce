<?php
class Rating extends Controller
{
    // Assuming you have a function to update the rating in your database
    // Replace this with your actual logic
    // public function updateRating()
    public function updateRating($user_id, $product_id, $newRating)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Assuming you sent the data in the request body
            $requestData = json_decode(file_get_contents('php://input'), true);
            show($requestData);
            die;
            // Ensure the required data is present
            if (isset($requestData['newRating'], $requestData['user_id'], $requestData['product_id'])) {
                $newRating = $requestData['newRating'];
                $user_id = $requestData['user_id'];
                $product_id = $requestData['product_id'];

                // Now you have $newRating, $user_id, and $product_id to use in your logic
                // Perform your logic to update the rating in the database or any other actions

                // For this example, let's return a new average rating
                $averageRating = $this->calculateAverageRating();

                // Send the response as JSON
                header('Content-Type: application/json');
                echo json_encode(['averageRating' => $averageRating]);
                exit;
            }
        }

        // If the request is not a valid POST request, return an error
        http_response_code(400);
        echo 'Invalid request';
    }

    // Function to calculate the average rating (replace with your actual logic)
    public function calculateAverageRating()
    {
        // Your logic to calculate the average rating
        // ...

        // For this example, let's return a random average rating
        return rand(1, 5);
    }
}
