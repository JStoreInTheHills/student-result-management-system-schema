<?php 

    require_once "../../../../resources/fxn/config.php";


    /** fucntion to get the academic year details and populating the datatables holding the 
    * academic years. parameter is year_id because we are querying for details of a specific 
    * academic year. 
    @param $year_id
     */
     function get_academic_year_details($year_id){
        global $dbh;

        $stmt = "SELECT academic_name, created_at, isActive
                FROM ACADEMIC_YEAR 
                WHERE academic_id =:academic_id";
                
        $query = $dbh->prepare($stmt);
        $query->bindParam(":academic_id", $year_id, PDO::PARAM_STR);
        $query->execute();

        $year_details = $query->fetchAll(PDO::FETCH_OBJ);

        return $year_details;     
     }


    /** function to get the classes in the db to be added to the academic year 
    * using the select2 option. 
        @param $searchTerms
        @return $classes
     */

    function get_classes_to_be_added_to_the_academic_year_using_select2($searchTerms){
    
        global $dbh;
        
        define("STATUS", 1);

        if(empty($searchTerms)){

            $stmt = "SELECT class_id, class_name 
                     FROM CLASS
                     WHERE isActive =".STATUS;

            $query = $dbh->prepare($stmt);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);  

        } else {

            $stmt = "SELECT class_id, class_name 
                    FROM CLASS
                    WHERE class_name 
                    LIKE :class_name
                    AND isActive =".STATUS;

            $query = $dbh->prepare($stmt);
            $query->bindValue(":class_name", '%'.$searchTerms.'%', PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        
            $classes = array();

                foreach ($result as $r) {
                    $classes [] = array (
                        "id" => $r['class_id'],
                        "text" => $r['class_name']
                    );
                };

            
        return $classes;
    
    }

    /** function to get the teachers in the db to be added to the academic year 
    * using the select2 option. 
        @param $searchTerms
        @return $teacher
     */
    function get_teachers_to_be_added_to_the_academic_year_using_select2($searchTerms){
        global $dbh;

        define("STATUS", 1);

        if(empty($searchTerms)){
            $stmt = "SELECT teacher_id, first_name, second_name, last_name
                     FROM TEACHERS
                     WHERE isActive =".STATUS;

            $query = $dbh->prepare($stmt);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        }else{
              $stmt = "SELECT teacher_id, first_name, second_name, last_name
                        FROM TEACHERS
                        WHERE first_name
                        LIKE :first_name
                        AND isActive =".STATUS;

            $query = $dbh->prepare($stmt);
            $query->bindValue(":first_name", '%'.$searchTerms.'%', PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
        
        }

         $teacher = array();

            foreach ($result as $r) {
                $teacher [] = array (
                    "id" => $r['teacher_id'],
                    "text" => $r['first_name'] ." ". $r['second_name'] ." ". $r['last_name'],
                );
            };

        return $teacher;
    
    }


    /** Function to add a class to the academic year. 
        @param $year_id, $class_id, $class_teacher_id, $max_no_student_, $max_no_of_exams_
     */
    function add_class_to_the_academic_year($year_id, $class_id, $class_teacher_id, $max_no_student_, $max_no_of_exams_){
        global $dbh;

        $error = array();
        $data = array();

        if(empty($year_id) || empty($class_id) || empty($class_teacher_id) || empty($max_no_student_) || empty($max_no_of_exams_))
            $error['errors'] = "There are some missing fields in the array.";
        
        if(!empty($error)){
            $data['success'] = false;
            $data['message'] = $error;
        }else{
            $academic_year_classes_id = bin2hex(random_bytes(30));

            $stmt = "INSERT INTO ACADEMIC_YEAR_CLASSES(`academic_year_classes_id`, `academic_year_id`, `class_id`, `class_teacher_id`, `max_no_of_student`,
                    `max_no_of_exams`, `created_at`)
                    VALUES(:academic_year_classes_id, :academic_year_id, :class_id, :class_teacher_id, :max_no_of_student,
                    :max_no_of_exams, CURRENT_TIMESTAMP)";
            
            $query = $dbh->prepare($stmt);
            
            $query->bindParam(":academic_year_classes_id", $academic_year_classes_id, PDO::PARAM_STR);
            $query->bindParam(":academic_year_id", $year_id, PDO::PARAM_STR);
            $query->bindParam(":class_id", $class_id, PDO::PARAM_STR);
            $query->bindParam(":class_teacher_id", $class_teacher_id, PDO::PARAM_STR);
            $query->bindParam(":max_no_of_student", $max_no_student_, PDO::PARAM_STR);
            $query->bindParam(":max_no_of_exams", $max_no_of_exams_, PDO::PARAM_STR);

            $query->execute();
            $errorInfo = $query->errorInfo();

            if($query->rowCount() > 0){
                $data['success'] = true;
                $data['message'] = "Successfully added class to academic year";
            }else{
                $data['success'] = false;
                $data['message'] = $errorInfo[2];
            }
        } 

        return $data;
    }

    /** Function to get all the academic classes in a specific academic year. 
        @param $year_id
        @return $classes;
     */ 
    
    function get_all_classes_for_classes_datatable($year_id){

        global $dbh;

        $stmt = "SELECT c.class_id, class_name, class_code, teacher_id, first_name, second_name, last_name,
                stream_name, ayc.created_at, ayc.isActive
                FROM CLASS c
                LEFT JOIN ACADEMIC_YEAR_CLASSES ayc ON c.class_id = ayc.class_id
                LEFT JOIN TEACHERS t On t.teacher_id = ayc.class_teacher_id
                LEFT JOIN STREAM s ON c.stream_id = s.stream_id
                WHERE ayc.academic_year_id =:year_id";

        $query = $dbh->prepare($stmt);

        $query->bindParam(":year_id", $year_id, PDO::PARAM_STR);
        $query->execute();

        $classes = $query->fetchAll(PDO::FETCH_ASSOC);

        return $classes;  
     
    }

    /** Function to add an academic year.
        @param year_name
        @return data.
     */
    function add_academic_year($academic_name){

        global $dbh;

        $academic_id = bin2hex(random_bytes(50));

        $errors = array();
        $data  = array();

        if(empty($academic_name))
            $errors['Year_Name'] = "Year Name Cannot be Blank";
    
        if(empty($academic_id))
            $errors['academic_id'] = "Year ID Cannot be Blank";

        if(!empty($errors)){

            $data['success'] = false;
            $data['message'] = $errors;

        } else {

            $sql = "INSERT INTO ACADEMIC_YEAR(`academic_id`, `academic_name`, `created_at`)
                    VALUES(:academic_id, :year_name, CURRENT_TIMESTAMP())";

            $query = $dbh->prepare($sql);

            $query->bindParam(':year_name', $academic_name, PDO::PARAM_STR);
            $query->bindParam(':academic_id', $academic_id, PDO::PARAM_STR);

            $query->execute();
            $er = $query->errorInfo(); //errorInfo returns an array 

            if($query->rowCount() > 0){
                $data['success'] = true;
                $data['message'] = "Academic Year Added Successfully";
            }else{
                $data['success'] = false;
                $data['message'] = "Warning! " . $er[2];
            }
        }
        return $data;
    }

    /** Function to add an academic term to an academic year 
        @param term_id, year_id
        @return data;
     */
    function add_academic_term_to_academic_year($term_id, $year_id){
        global $dbh;

        $data = array();
        $er = array();

        if(empty($term_id))
            $er['Term'] = "Term cannot be empty";
        
        if(empty($year_id))
            $er['Year'] = "Year cannot be empty";

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

        return $data;
    }

    /** Function to fetch all the academic year of fill the datatables. 

     */
    function fetch_all_academic_years(){
        global $dbh;


        $sql = "SELECT academic_id, academic_name, created_at, isActive  
                FROM ACADEMIC_YEAR";
            
        $query = $dbh->prepare($sql);

        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    /** Function to fetch the active academic year to be added to an academic year. 
       * this means an inactive term cannot be added to an academic year. 
     */
    function to_get_all_academic_year_terms($searchTerms){
        global $dbh;
        
        define("STATUS", 1);

        if(empty($searchTerms)){

             $query = "SELECT term_id, term_name
                        FROM TERMS 
                        WHERE isActive =".STATUS;

            $sql = $dbh->prepare($query);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        }else{
            $query = "SELECT term_id, term_name
                        FROM TERMS 
                        WHERE term_name 
                        LIKE :term_name
                        AND isActive =".STATUS;

            $sql = $dbh->prepare($query);
            $sql->bindValue(":term_name", '%'.$searchTerms.'%', PDO::PARAM_STR);
            $sql->execute();
            $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        
        $term_array = array();

            foreach ($result as $r) {
                $term_array [] = array (
                    "id" => $r['term_id'],
                    "text" => $r['term_name'],
                );
            };
        
        return $term_array;
        
    }

    /** Function to populate the academic year term datatables. We are 
     *  collecting terms from the database and populating the table.
      @note this terms are the ones that belong to a specific academic year.
      @param $year_id.   
     */
    function populate_the_academic_year_datatables_with_academic_terms($year_id){

        global $dbh;

        $stmt = "SELECT academic_terms_id, term_name, ty.created_at, ty.isActive
                FROM ACADEMIC_TERMS ty
                LEFT JOIN TERMS t ON t.term_id = ty.term_id
                WHERE academic_year_id =:year_id";

        $query = $dbh->prepare($stmt);
        $query->bindParam(":year_id", $year_id, PDO::PARAM_STR);
        $query->execute();

        $academic_year_terms = $query->fetchAll(PDO::FETCH_OBJ);

        return $academic_year_terms;
    
    }
