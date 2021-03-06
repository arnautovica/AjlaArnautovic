<?php



Flight::route('GET /products', function () {
    $offset = Flight::query('offset', 0);
    $limit = Flight::query('limit', 10);
    $search = Flight::query('search');
    Flight::json(Flight::productService()->get_products($search, $offset, $limit));
});


Flight::route('GET /products/@id', function ($id) {
    Flight::json(Flight::productService()->get_products_by_id($id));
});



Flight::route('POST /products', function () {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->add_products($data));
});




Flight::route('PUT /products/@id', function ($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::productService()->update_products($id, $data));
});
