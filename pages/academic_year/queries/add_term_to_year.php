<?php 

        // try{
            require_once "../../../resources/fxn/config.php";
        // }catch(Exception $e) {
        //     echo 'Message:  ' .  $e->getMessage();
        // }
    
        $term_id = $_GET['term_id'];
        $year_id = $_GET['year_id'];

        // var_dump($term_id);

// http://student/pages/academic_year/views/view_academic_year?year_id=12c4cc41008680b6305c3c0d089bfaeb2a1674f4915b8b0b5e56b57e16c34d10e113bcb839e6aed99cea6a0d1176a0752185?term_id=233fe37d73f20860e706ab5b800e9891799809a794f4ce5040a41cbc70a55acc451621d6f4d2b85f

        $data = array();
        $er = array();

        if(empty($term_id)){
            $er['Term'] = "Term cannot be empty";
        }

        if(empty($year_id)){
            $er['Year'] = "Year cannot be empty";
        }

        if (!empty($er)) {
            $data['success'] = false;
            $data['message'] = $er; 
        } else {

            $academic_terms_id = bin2hex(random_bytes(30));

            $query = "INSERT INTO ACADEMIC_TERMS(academic_terms_id, academic_year_id, term_id, created_at)
                      VALUES(:academic_term_id, :academic_year_id, :term_id, CURRENT_TIMESTAMP)";

            $sql = $dbh->prepare($query);

            $sql->bindParam(":academic_term_id", $academic_terms_id, PDO::PARAM_STR);
            $sql->bindParam(":academic_year_id", $year_id, PDO::PARAM_STR);
            $sql->bindParam(":term_id", $term_id, PDO::PARAM_STR);

            $sql->execute();

            $error = $sql->errorInfo();

            if($sql->rowCount() > 0){
                $data['success'] = true;
                $data['message'] = "Term Added to Academic Year Succesfully";
            } else { 
                $data['success'] = false;
                $data['message'] = $error[2];
            }


        }

    echo json_encode($data);