<?php
class Api
{
    private $connect = '';

    public function __construct()
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=Oef3", "root", "");
        $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    function fetch_all()
    {
        $query     = "SELECT * FROM `tbl_sample` ORDER BY Id";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    //add data
    function insert()
    {
        if (isset($_POST["first_name"])) {
            $form_data = array(
                ':first_name' => $_POST["first_name"],
                ':last_name' => $_POST["last_name"]
            );
            $query     = "
      INSERT INTO `tbl_sample` (first_name, last_name) VALUES (:first_name, :last_name)
      ";
            $statement = $this->connect->prepare($query);
            if ($statement->execute($form_data)) {
                $data[] = array(
                    'success' => '1'
                );
            } else {
                $data[] = array(
                    'success' => '0'
                );
            }
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }
    //edit data
    function fetch_single($id)
    {
        $query     = "SELECT * FROM `tbl_sample` WHERE Id='" . $id . "'";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            foreach ($statement->fetchAll() as $row) {
                $data['first_name'] = $row['first_name'];
                $data['last_name']  = $row['last_name'];
            }
            return $data;
        }
    }

    function update()
    {
        if (isset($_POST["first_name"])) {
            $form_data = array(
                ':first_name' => $_POST['first_name'],
                ':last_name' => $_POST['last_name'],
                ':Id' => $_POST["Id"]
            );
            $query     = "
      UPDATE `tbl_sample`
      SET first_name = :first_name, last_name = :last_name
      WHERE Id = :Id
      ";
            $statement = $this->connect->prepare($query);
            if ($statement->execute($form_data)) {
                $data[] = array(
                    'success' => '1'
                );
            } else {
                $data[] = array(
                    'success' => '0'
                );
            }
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }
    //Delete
    function delete($Id)
    {
        $query     = "DELETE FROM `tbl_sample` WHERE Id = '" . $Id . "'";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            $data[] = array(
                'success' => '1'
            );
        } else {
            $data[] = array(
                'success' => '0'
            );
        }
        return $data;
    }
}
?>
