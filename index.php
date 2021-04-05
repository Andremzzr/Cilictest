<?php

require __DIR__.'/assets/html/index.html';

if (isset($_POST['btn-submit'])) {
    $nome = filter_var($_POST['nome'],FILTER_SANITIZE_STRING);
    $tempo =  filter_var($_POST['tempo'],FILTER_SANITIZE_NUMBER_INT);
    $mensalidade = filter_var($_POST['mensalidade'],FILTER_SANITIZE_NUMBER_FLOAT);
    

   if (trim($nome) == '') {
    
    header('Status: 303 Moved Permanently', false, 303);
    header('Location: index.php');
   }elseif ($tempo <= 0) {
    header('Status: 303 Moved Permanently', false, 303);
    header('Location: index.php');
   } elseif ($mensalidade <= 0) {
    header('Status: 303 Moved Permanently', false, 303);
    header('Location: index.php');
   }
   else{
       $juros =  0.00517;
       $tempo_expr= $tempo * 12 ;
       $expr = $mensalidade.' * (((1 + '.$juros.') ^ '.$tempo_expr.' - 1) / '.$juros.')';
        
       $data = [
        'expr' => $expr
    ];

    $data = json_encode($data);
        try{$init = curl_init('http://api.mathjs.org/v4/');

            curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
     
     
            curl_setopt($init, CURLOPT_POST, true);
     
            curl_setopt($init, CURLOPT_POSTFIELDS,$data);
     
     
            $result =curl_exec($init);
           
            
            $result = json_decode($result,true);

            $final_result = $result['result'];
            
            
            curl_close($init);
            
            header('Location: result.php?montante='.$final_result.'&nome='.$nome.'&tempo='.$tempo.'&mensalidade='.$mensalidade);
        }
            catch(Exception $error){
                ?>
            <script> alert("Ocorreu um erro, tente novamente");</script>
            <?php
     }
       

   }
}