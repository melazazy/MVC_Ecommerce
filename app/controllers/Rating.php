<?php
class Rating extends Controller
{
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
    // Test Function
    public function calculateAverageRating()
    {
        // Your logic to calculate the average rating
        // ...

        // For this example, let's return a random average rating
        return rand(1, 5);
    }
}
