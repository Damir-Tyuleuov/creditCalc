<?php

namespace views\index;

use models\funCredit;


if (isset($_POST["sTime"])) 
{
    $credit = new funCredit($_POST["sum"], $_POST["sTime"],$_POST["proc"]);
}
else{
$credit = new funCredit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="css/bootstrap-reboot.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="js/bootstrap.min.js" rel="stylesheet" crossorigin="anonymous">
    <title>Кредитный калькулятор</title>
</head>

<body>
    <div class="row justify-content-center">
    <h1 >Кредитный калькулятор</h1>
    </div>
    <div class="row justify-content-center">
        <div class="col-3">
            <form class="form-control bg-secondary" action="#" id="formFun" method="post">
                <input class="form-control mb-1" style="font-size: 18px; justify-content:center" name="sum" placeholder="Введите сумму кредита" value="<?php echo $credit->getSum() ?>"></input>
                <?php if (!isset($_POST["sTime"])) : ?>
                    <select class="form-control mb-1" style="font-size: 18px; justify-content:center;" name="sTime" id="sTime">
                    <option class="dropdown-item" disabled selected >Выберите срок</option>   
                    <option class="dropdown-item" value="3">3</option>
                        <option class="dropdown-item" value="6">6</option>
                        <option class="dropdown-item" value="12">12</option>
                        <option class="dropdown-item" value="24">24</option>
                    </select>
                <?php endif
                ?>
                <?php if (isset($_POST["sTime"])) : 
                    $arr = [3,6,12,24];?>
                    <select class="form-control mb-1" style="font-size: 18px; justify-content:center;" name="sTime">
                    <?php foreach ($arr as $item): 
                        if ($item==$_POST["sTime"]):
                        
                        ?>   
                    <option class="dropdown-item" selected value="<?php echo $item ?>"><?php echo $item ?></option>
                    <?php  endif?>

                    <?php if ($item!=$_POST["sTime"]):
                        
                        ?>   
                    <option class="dropdown-item" value="<?php echo $item ?>"><?php echo $item ?></option>
                    <?php  endif?>

                        <?php  endforeach?>
                    </select>
                <?php endif;
                
                ?>
                <input class="form-control mb-1" style="font-size: 18px; justify-content:center" name="proc" placeholder="Процентная ставка" value="<?php echo $credit->getPercent() ?>"></input>


                <input class="btn btn-success form-control" type="submit" value="Расчитать"></input>
            </form>
        </div>

        <?php

        if (isset($_POST["sTime"])) {
            $credit = new funCredit($_POST["sum"], $_POST["sTime"],$_POST["proc"]);
            $credit->setstateCredit();

        } else {
            exit;
        }
    

        ?>

        <div class="col-4 form-control bg-primary">
            <h3 class="text-white">Сумма кредита  <?php echo $credit->getSum()  ?></h3><hr>
            <h4 class="text-white">Ежемесячный платеж <?php echo round($credit->getMounthPayment(), 2) ?> KZT</h4><hr>
            <h4 class="text-white">Общая сумма выплат  <?php echo     round($credit->getTotalAmount(), 2) ?> KZT</h4><hr>
            <h4 class="text-white">Переплата  <?php echo round($credit->getOverPayment(), 2) ?> KZT</h4>
        </div>
    </div>
    <?php if ($credit->getstateCredit()==0)
    {
exit;
    } 
    
    $schiduleList = $credit->getScheduleList();

    ?>

    <div class="row justify-content-center mt-2" >
<div class="col-8">
<table class="table table-hover">
  <thead>
    <tr class="text-center">
      <th scope="col">#</th>
      <th scope="col">Остаток долга</th>
      <th scope="col">Начисление %</th>
      <th scope="col">Платеж в основной долг</th>
      <th scope="col">Сумма платежа</th>
    </tr>
  </thead>
  <tbody>
    <?php    for ($i=0;$i<$credit->getTerm();$i++): ?>
    <tr class="text-center">
      <th scope="row"><?php echo $i+1 ?></th>
      <td><?php echo $schiduleList["credit"][$i] ?></td>

      <td><?php echo $schiduleList["paymentPercent"][$i] ?></td>

      <td><?php echo $schiduleList["paymentMain"][$i] ?></td>

      <td><?php echo $schiduleList["payment"][$i] ?></td>
    </tr>

    <?php    endfor ?>
  </tbody>
</table>
</div>
    </div>

</body>


</html>