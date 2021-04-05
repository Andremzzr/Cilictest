<?php

require_once __DIR__.'/assets/html/result.html';

$nome =filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_STRING);
$montante = filter_input(INPUT_GET, 'montante', FILTER_SANITIZE_STRING);
$montante = floatval($montante);
$montante = round($montante,2);
$montante = strval($montante);
$montante = str_replace('.',',',$montante);
$tempo = filter_input(INPUT_GET, 'tempo', FILTER_SANITIZE_NUMBER_INT);
$mensalidade = filter_input(INPUT_GET, 'mensalidade', FILTER_SANITIZE_NUMBER_FLOAT);

?>
<div class="container">
<div class="box">
    <div class="content">
        <div class="header-box">Ciclic</div>
        <div class="text" >Olá <?php echo $nome?>, juntando R$ <?php echo $mensalidade ?> todo mês, você terá R$ <?php echo $montante ?> em <?php echo $tempo?> anos!</div>
        <form method="POST"><div class="btn-box"><button type="submit" name="btn-back" class="btn-back">Simular Novamente</button></div></form>

      
    </div>
    
</div>
</div>
</body>
</html>

<?php

if (isset($_POST['btn-back'])) {
    header('Location: index.php');
}

