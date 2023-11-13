<?php
class Search extends Controller
{

    function index()
    {
        // Page Title
        $data['title'] = "Search";
        // $data['result']='2323';
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $searchQuery = "SELECT * FROM products WHERE name LIKE '%" . trim($_GET['query']) . "%'";

            // Sanitize the input if needed

            // Use the Model to perform the search
            $productModel = new Database();
            // $products = $productModel->db_connect();

            $products = $productModel->read($searchQuery);

            if ($products != null) {
                # code...
                $data['result'] = $products;
            } else {
                # code...
                $data['result'] = [];
            }

            $data['query'] = $searchQuery;

            // Pass the data to the View for display
            // include('search.php');
        }
        // $data['searchQuery']= $_GET['query'];
        else {
            // Handle the case when the input is empty (e.g., display a message or show all data)
            $data['result'] = [];
            // You can also modify the query to return all data if needed
            // Example: $sql = "SELECT * FROM your_table";
            // Execute the query and display all data
        }
        $this->view("zay_shop/search", $data);
    }
}
