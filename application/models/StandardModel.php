<?php

class StandardModel extends CI_Model
{
    function getMaterialStandard($materialId)
    {
        //get all outlets
        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/outlet');
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
        $outlets = json_decode(curl_exec($curl))->items;
        curl_close($curl);

        //get materials
        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/materials/standard?materialId=' . $materialId);
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
        $standards = json_decode(curl_exec($curl))->standart;
        curl_close($curl);
        

        foreach ($outlets as $outlet) {
            $standardValue = 0;
            foreach ($standards as $standard) {
                if ($standard->outletId == $outlet->id) {

                    $standardValue = $standard->standard;
                }
            }
            $outlet->materialId = $materialId;
            $outlet->standard = $standardValue;
        }
        return $outlets;
    }

    function getMilkStandard()
    {
        //get all outlets
        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/outlet');
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
        $outlets = json_decode(curl_exec($curl))->items;
        curl_close($curl);

        $itemMilk = 4;
        //get standard
        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/standard?itemId=' . $itemMilk);
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
        $standards = json_decode(curl_exec($curl))->data;
        curl_close($curl);
        

        foreach ($outlets as $outlet) {
            $standardValue = 0;
            foreach ($standards as $standard) {
                if ($standard->outletId == $outlet->id) {

                    $standardValue = $standard->standard;
                }
            }
            $outlet->itemId = $itemMilk;
            $outlet->standard = $standardValue;
        }
        return $outlets;
    }

    function getAllMaterial()
    {
        //get all outlets
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
        $materials = json_decode(curl_exec($curl))->items;
        curl_close($curl);

        return $materials;
    }

    function addStandardMilk($outletId, $itemId, $value)
    {
        $data = array(
            'outletId'      => $outletId,
            'itemId'      => $itemId,
            'standard' => $value,
        );

        $data_string = json_encode($data);

        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/standard');
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
        return $result;
    }

    function addStandardMaterial($outletId, $itemId, $value)
    {
        $data = array(
            'materialId'      => $itemId,
            'outletId'      => $outletId,
            'standard' => $value,
        );

        $data_string = json_encode($data);

        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/materials/standard');
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
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
        return $result;
    }

    function vardump($var)
    {
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
        die;
    }
}
