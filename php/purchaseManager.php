<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esercizio 30 - PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    
    <?php
        const CURVA_COST = 30;
        const CENTRALE_COST = 80;
        const VIP_COST = 120;
        $available_coupons = ['FIRENZE5' => 0.05];
        $additional_fc = [];
        //* dati utente
        $name = $_POST['user_name'];
        $surname = $_POST['user_surname'];
        $fc = $_POST['fiscal_code'];           // Per semplicità non controlliamo che il codice fiscale sia valido in base alla sua espressione regolare
        $sector = $_POST['sectorChoice'];
        $coupon = $_POST['coupon'];

        //* data e ora acquisto
        $purchase_time = date('Y-m-d H:i:s');

        //* numero biglietti acquistati (massimo 4 acquistabili per ogni utente)   
        $num_ticket_choice = $_POST['single_multi'];
        $ticket_num = $num_ticket_choice == "s" ? 1 : $_POST['ticket_num'];

        //*lista codici fiscali degli eventuali biglietti aggiuntivi (se presenti)
        if($num_ticket_choice == "m") {
            for($i=1; $i < $_POST['ticket_num']; $i++) {
                $additional_fc[$i-1] = $_POST["fiscal_code_add_$i"];
            }
        }
        $total_cost = $ticket_num;
        switch($sector) {
            case "curva":
                $total_cost *= CURVA_COST;
                break;
            case "centrale":
                $total_cost *= CENTRALE_COST;
                break;
            case "onore":
                $total_cost *= VIP_COST;
        }

        $new_total = array_key_exists($coupon, $available_coupons) ? $total_cost * (1 - $available_coupons[$coupon]) : $total_cost;
    ?> 

    <div id="price_list" class="w-50 mx-auto my-3 bg-body-tertiary rounded-4 p-3">
        <h2> PREZZI BIGLIETTI </h2>
        <ul style="list-style-type: none;" class="fs-5">
            <li> CURVA : <?php echo CURVA_COST ?> € </li>
            <li> TRIBUNA CENTRALE: <?php echo CENTRALE_COST ?>  €</li>
            <li> TRIBUNA D'ONORE: <?php echo VIP_COST ?> € </li>
        </ul>
    </div>
    <div id="riepilogo" class="w-75 mx-auto bg-body-secondary shadow-lg fs-5 rounded-4 p-3">
        <h3> RIEPILOGO ACQUISTO BIGLIETTI </h3> <hr>
        <p>Nome acquirente: <?php echo $name ?> </p>
        <p>Cognome acquirente: <?php echo $surname ?> </p>
        <p>Codice fiscale: <?php echo $fc ?> </p>
        <p> Settore di prenotazione: <?php echo $sector ?> </p>
        <p> Modalità di acquisto: <?php
            if($num_ticket_choice == "s")
                echo "Biglietto singolo";
            else {
                echo "Biglietto multiplo - $ticket_num persone";
                echo "<br> Codice fiscale utenti aggiuntivi: <ul> <li>".implode(" </li> <li> ", $additional_fc)."</li> </ul>";
            }
        ?></p>
        <?php
            if(array_key_exists($coupon, $available_coupons))
                echo "<p>Coupon utilizzato: $coupon - sconto del ". $available_coupons[$coupon] * 100 ."%</p>";
            else
                echo "<p> Buono sconto non inserito o non valido </p>";
        ?>
        <p> Preventivo totale: <?php echo $total_cost?> €</p>
        <p> Costo effettivo (eventuali sconti applicati):<b> <?php echo $new_total ?>€</b></p>
        <p> Data acquisto  <?php echo $purchase_time ?></p>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>