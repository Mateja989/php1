<?php 
    $logFile=file(LOG_FILE);
    $pages= [];
    foreach($logFile as $f){
        $f = explode("\t",$f);
        $page = explode("=",$f[0]);
        if(isset($page[1])){
            $page=explode("&&",$page[1]);
            $page=$page[0];
        }
        else{
            $page="home";
        }
        $pages[] = $page;
        
    }
    $pagesUnique=array_unique($pages);
    $pagesOrder = [];
    foreach($pagesUnique as $p){
        $pagesOrder[] = $p;
    }

    $dataCount= [];

    foreach($pagesUnique as $p){
        $counter = 0;
        $totalCounter = 0;
            for($i = 0; $i < count($pages); $i++){
                if($p == $pages[$i]){
                    $counter++;
                }       
                $totalCounter++;
            }
        $dataCount[$p] = $counter;
    }
    
    $dataPercentage = [];
    foreach($dataCount as $key=>&$value){
            $calculate = $value * 100 / $totalCounter;
            $dataPercentage[] = round($calculate, 2);
    }

    $currentlyTime=time();
    $last24Hours=$currentlyTime-86400;
    $visits24hrs=[];
    foreach($logFile as $f){
    $f = explode("\t", $f);
    $visits24hrs[] = $f[1];
    $numberOfVisits=0;
    for($i=0;$i<count($visits24hrs);$i++){
       if((strtotime($visits24hrs[$i]) > $last24Hours)){
         $numberOfVisits++;
       }
       
    }
    }
?>
<h3>Total visitors of all time: <?= $totalCounter ?></h3>
<h3>Visitors in past 24 hours: <?= $numberOfVisits?></h3>
<div class="table-responsive table--no-card m-b-30" id="cart_details">
<table class="table table-borderless table-striped table-earning">
<thead>
    <tr class="red">
        <th>Page name</th>
        <th>Percent per page</th>
    </tr>
</thead>
<tbody id="modelsList">
    <?php for($i=0;$i < count($pagesUnique);$i ++): ?>
      <tr class="red">
        <td><?= $pagesOrder[$i] ?></td>
        <td><?= $dataPercentage[$i]."%" ?></td>
      </tr>
    <?php endfor; ?>
</tbody>

<div class="modal-bg">
    <div class="nes col-4">
        <div class="card-body" id="cartDetails">

        </div>
    </div>
</div>    