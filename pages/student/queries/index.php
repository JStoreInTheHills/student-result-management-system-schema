<?php
    // we need the config database file 
    require_once "../../../../resources/fxn/config.php";

    // the fillable fields in the student object. 
    $fillable = array(
        "first_name" => "first_name",
        "middle_name" => "middle_name",
        "last_name" => "last_name",
        "roll_id" => "roll_id",
        "gender" => "gender",
    );

    // isActive flag.  
    define("STATUS", 1);

    // function to populate the students table. 
    function to_populate_the_student_datatables_table(){

        // database initialization from the config file. 
        global $dbh;

        // the statement 
        $stmt = "SELECT first_name, middle_name, last_name, 
                gender, roll_id, created_at, isActive, students_id
                FROM STUDENTS 
                WHERE isActive=".STATUS;

        // preparing the query using the prepare method with the statement as an argurment.
        $query = $dbh->prepare($stmt);
        $query->execute();

        // we are fetching all the students in the database so we use PDO::FETCH_OBJ.
        $students = $query->fetchAll(PDO::FETCH_OBJ); 

        // return to the ajax request. 
        return $students;
    };

    // function to add the student model with data
    function to_add_students_to_the_datatables($students){

         // database initialization from the config file. 
        global $dbh;

        // an error holding the errors in the query.
        $error = array();

        // an array holding the data in the result query. 
        $data = array();

        // before we insert the object to the database. we validate if the 
        // argurments passed are not empty.
        if(empty($students['first_name']) || empty($students['middle_name']) || empty($students['last_name']) || empty($students['roll_id']) || empty($students['gender']))
            $error['Fields'] = "Array is empty";

        if(!empty($error)){
            $data['message'] = $error;
            $data['success'] = false;
        }else{

            // for the students_id, we generate a random binary and we convert it to a hexadecimal 
            $student_id = bin2hex(random_bytes(30));

            // the statement
            $stmt = "INSERT INTO STUDENTS(students_id, first_name, middle_name, last_name, roll_id, gender)
                    VALUES(:students_id, :first_name, :middle_name, :last_name, :roll_id, :gender)";
            
            // prepared statement using the stmt as an argurment. 
            $query = $dbh->prepare($stmt);

            // the parameter binding. 
            $query->bindParam(":students_id", $student_id, PDO::PARAM_STR);
            $query->bindParam(":first_name", $students['first_name'], PDO::PARAM_STR);
            $query->bindParam(":middle_name", $students['middle_name'], PDO::PARAM_STR);
            $query->bindParam(":last_name", $students['last_name'], PDO::PARAM_STR);
            $query->bindParam(":roll_id", $students['roll_id'], PDO::PARAM_STR);
            $query->bindParam(":gender", $students['gender'], PDO::PARAM_STR);

            $query->execute();

            $errorInfo = $query->errorInfo();

            if($query->rowCount() > 0){
                 $data['success'] = true;
                 $data['message'] = "Student Added Successfully";
            }else{
                 $data['success'] = false;
                 $data['message'] = $errorInfo[2];
            }
        
        }

        return $data;
    };

    // ----------- STUDENT DETAILS PAGE------------------------------------>

    // function that is being used to fetch the classes that the student
    // has been admitted to over the years. 
    /**
        @modal ACADEMIC_YEAR_CLASS_STUDENTS
     */
    function to_fetch_student_academic_year_classes($students_id){

        global $dbh; 

        $stmt = "SELECT c.class_name, c.class_code, aycs.isActive, aycs.hasCompleted, academic_name, 
                aycs.created_at as admission_date
                FROM ACADEMIC_YEAR_CLASS_STUDENTS aycs
                LEFT JOIN ACADEMIC_YEAR_CLASSES ayc
                ON aycs.academic_year_classes_id = ayc.academic_year_classes_id
                LEFT JOIN CLASS c ON ayc.class_id = c.class_id 
                LEFT JOIN ACADEMIC_YEAR ay ON aycs.academic_year_id = ay.academic_id 
                WHERE aycs.students_id =':students_id'
                GROUP BY ayc.academic_year_id";
        
        $query = $dbh->prepare($stmt);
        $query->bindParam(":students_id",$students_id, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetchAll(PDO::FETCH_OBJ);

        return $result;
        
    } 