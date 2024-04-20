<?php
class Search extends Controller
{

    function index()
    {
        // Page Title
        $data['title'] = "Search";
        if (isset($_GET['query']) && !empty($_GET['query'])) {
            $searchQuery = "SELECT * FROM products WHERE name LIKE '%" . trim($_GET['query']) . "%'";

            // Use the Model to perform the search
            $productModel = new Database();
            $products = $productModel->read($searchQuery);

            if ($products != null) {
                $data['result'] = $products;
            } else {
                $data['result'] = [];
            }

            $data['query'] = $searchQuery;
        } else {
            // Handle the case when the input is empty (e.g., display a message or show all data)
            $data['result'] = [];
        }
        $this->view("zay_shop/search", $data);
    }
}
