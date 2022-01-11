<?php

class StockModel extends CI_Model
{
    function getStockData($date)
    {
        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/dashboard/stock?date=' . $date);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3VzdW1ha3RhbS5jb21cL2xvZ2luIiwiaWF0IjoxNjQxMDE3Mjk3LCJleHAiOjQ4MDgxNzYwNDYwMzY3NDIwOTcsIm5iZiI6MTY0MTAxNzI5NywianRpIjoiVXUzVVhHQzl1UUNSTWk4SyIsInN1YiI6NiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.CNDZ07rQjfWFw_194heCsZPuO50FE6IpE8IwjQoSgSo'
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        $outletItems = $this->getOutletItems();
        $outletItems[0]->url = $result->milk->url;
        $outletItems[1]->url = $result->cups->url;
        $outletItems[2]->url = $result->spices->url;
        foreach ($outletItems[0]->items as $milk) {
            $stock = NULL;
            foreach ($result->milk->items as $milkStock) {
                if ($milk->itemId == $milkStock->itemId) {
                    $stock = $milkStock;
                }
            }
            if ($stock != NULL) {
                $milk->stock = $stock->stock;
            } else {
                $milk->stock = 0;
            }
        }

        foreach ($outletItems[1]->items as $cup) {
            $stock = NULL;
            foreach ($result->cups->items as $cupStock) {
                if ($cup->itemId == $cupStock->itemId) {
                    $stock = $cupStock;
                }
            }
            if ($stock != NULL) {
                $cup->stock = $stock->stock;
                $cup->sold = $stock->sold;
                $cup->left = $stock->lefts;
            } else {
                $cup->stock = 0;
                $cup->sold = 0;
                $cup->left = 0;
            }
        }

        foreach ($outletItems[2]->items as $spice) {
            $stock = NULL;
            foreach ($result->spices->items as $spiceStock) {
                if ($spice->itemId == $spiceStock->itemId) {
                    $stock = $spiceStock;
                }
            }
            if ($stock != NULL) {
                $spice->stock = $stock->stock;
                $spice->sold = $stock->sold;
                $spice->left = $stock->lefts;
            } else {
                $spice->stock = 0;
                $spice->sold = 0;
                $spice->left = 0;
            }
        }

        // $this->vardump($outletItems);
        return $outletItems;
    }

    function addCup()
    {
        $data = array(
            'name'      => $this->input->post('name'),
            'price'      => 0,
            'subCategoryId' => 19,
        );

        // $this->vardump($data);

        $data_string = json_encode($data);

        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/items');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3VzdW1ha3RhbS5jb21cL2xvZ2luIiwiaWF0IjoxNjQxMDE3Mjk3LCJleHAiOjQ4MDgxNzYwNDYwMzY3NDIwOTcsIm5iZiI6MTY0MTAxNzI5NywianRpIjoiVXUzVVhHQzl1UUNSTWk4SyIsInN1YiI6NiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.CNDZ07rQjfWFw_194heCsZPuO50FE6IpE8IwjQoSgSo'
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        // $this->vardump($result);
        return $result->items;
    }

    function addSpices()
    {
        $data = array(
            'name'      => $this->input->post('name'),
            'price'      => 0,
            'subCategoryId' => 20,
        );

        // $this->vardump($data);

        $data_string = json_encode($data);

        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/items');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3VzdW1ha3RhbS5jb21cL2xvZ2luIiwiaWF0IjoxNjQxMDE3Mjk3LCJleHAiOjQ4MDgxNzYwNDYwMzY3NDIwOTcsIm5iZiI6MTY0MTAxNzI5NywianRpIjoiVXUzVVhHQzl1UUNSTWk4SyIsInN1YiI6NiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.CNDZ07rQjfWFw_194heCsZPuO50FE6IpE8IwjQoSgSo'
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        // $this->vardump($result);
        return $result->items;
    }

    function getOutletItems()
    {
        $curl = curl_init('http://api.susumaktam.com/api/v1/outlet/outlet_items');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3VzdW1ha3RhbS5jb21cL2xvZ2luIiwiaWF0IjoxNjQxMDE3Mjk3LCJleHAiOjQ4MDgxNzYwNDYwMzY3NDIwOTcsIm5iZiI6MTY0MTAxNzI5NywianRpIjoiVXUzVVhHQzl1UUNSTWk4SyIsInN1YiI6NiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.CNDZ07rQjfWFw_194heCsZPuO50FE6IpE8IwjQoSgSo'
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        // $this->vardump($result);
        return $result;
    }

    function deleteItem($name)
    {
        $products = $this->getAllProducts();
        foreach ($products as $product) {
            if ($product->name == $name) {
                $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/items?id=' . $product->id);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                curl_setopt(
                    $curl,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3VzdW1ha3RhbS5jb21cL2xvZ2luIiwiaWF0IjoxNjQxMDE3Mjk3LCJleHAiOjQ4MDgxNzYwNDYwMzY3NDIwOTcsIm5iZiI6MTY0MTAxNzI5NywianRpIjoiVXUzVVhHQzl1UUNSTWk4SyIsInN1YiI6NiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.CNDZ07rQjfWFw_194heCsZPuO50FE6IpE8IwjQoSgSo'
                    )
                );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $result = json_decode(curl_exec($curl));
                curl_close($curl);

                // $this->vardump($result);
                return $result->items;
            }
        }
        return NULL;
    }

    function getAllProducts()
    {
        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/items');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt(
            $curl,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcGkuc3VzdW1ha3RhbS5jb21cL2xvZ2luIiwiaWF0IjoxNjQxMDE3Mjk3LCJleHAiOjQ4MDgxNzYwNDYwMzY3NDIwOTcsIm5iZiI6MTY0MTAxNzI5NywianRpIjoiVXUzVVhHQzl1UUNSTWk4SyIsInN1YiI6NiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.CNDZ07rQjfWFw_194heCsZPuO50FE6IpE8IwjQoSgSo'
            )
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        // $this->vardump($result);
        return $result->items;
    }

    function vardump($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die;
    }
}
