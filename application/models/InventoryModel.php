<?php

class InventoryModel extends CI_Model
{
    function getInventories($date)
    {
        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/dashboard/inventory?date=' . $date);
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


        $materials = $this->getAllMaterials();

        foreach ($materials as $material) {
            $inventoryData = NULL;
            if($result->success == true){
                foreach($result->inventory as $inventory){
                    if($material->id == $inventory->materialId){
                        $inventoryData = $inventory;
                    }
                }
            }
            if($inventoryData != NULL){
                $material->warehouseStock = $inventoryData->warehouseStock;
                $material->takenByOutlet = $inventoryData->takenByOutlet;
                $material->leftOver = $inventoryData->leftOver;
                $material->date = $date;
            }else{
                $material->warehouseStock = 0;
                $material->takenByOutlet = 0;
                $material->leftOver = 0;
                $material->date = $date;
            }
        }


        // $this->vardump($materials);
        return $materials;
    }

    function getAllMaterials()
    {
        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/materials');
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

    function addInventory($date,$materialId,$stock)
    {
        $data = array(
            'materialId'      => $materialId,
            'date'      => $date,
            'warehouseStock'      => $stock,
        );

        // $this->vardump($data);

        $data_string = json_encode($data);

        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/dashboard/inventory');
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

    function vardump($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die;
    }
}
