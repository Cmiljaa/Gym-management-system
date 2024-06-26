<?php
    require_once 'config.php';
    if(isset($_GET)){
        if($_GET['what'] == 'members'){
            
            $sql = "SELECT * FROM members";
            $csv_cols = [
                'member_id',
                'first_name',	
                'last_name',	
                'email',	
                'phone_number',	
                'photo_path',	
                'training_plan_id',	
                'trainer_id',	
                'access_card_pdf_path',	
                'created_at'];

        } else if($_GET['what'] == 'trainers'){
           
            $sql = "SELECT * FROM trainers";
            $csv_cols = [
                'trainer_id',
                'first_name',	
                'last_name',	
                'email',	
                'phone_number',	
                'created_at'
            ];

        } else if($_GET['what'] == 'plans'){
            $sql = 'SELECT * FROM training_plans';
            $csv_cols = [       
                'plan_id',	
                'name',
                'sessions',	
                'price',	
                'created_at'
            ];  
                    
        }   else {
            die();
        }
        $results = $conn->query($sql);
        $results = $results->fetch_all(MYSQLI_ASSOC);

        $output = fopen('php://output', 'w');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename =' . $_GET['what'] . '.csv');

        fputcsv($output, $csv_cols);

        foreach($results as $result){
            fputcsv($output, $result);
        }
        fclose($output);
    }