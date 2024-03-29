<?php

class OutletModel extends CI_Model
{
    function getAllOutlets()
    {
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
        $result = json_decode(curl_exec($curl));
        curl_close($curl);

        // $this->vardump($result);
        return $result->items;
    }

    function addOutlet()
    {
        $data = array(
            'name'      => $this->input->post('name'),
            'address' => $this->input->post('address'),
        );

        $data_string = json_encode($data);

        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/outlet');
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

    function deleteOutlet($id)
    {
        $data = array(
            'name'      => $this->input->post('name'),
            'address' => $this->input->post('address'),
        );

        $data_string = json_encode($data);

        $curl = curl_init('http://api.susumaktam.com/api/v1/admin/master-data/outlet?id=' . $id);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
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
