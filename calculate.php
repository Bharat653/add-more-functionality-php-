<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $unit_value = intval($_POST["unit_value"]);
    $range = [
        ["start" => 0, "end" => 100, "multiplier" => 2], 
        ["start" => 100, "end" => 200, "multiplier" => 5], 
        ["start" => 200, "end" => 500, "multiplier" => 10], 
        // ["start" => 501, "end" => PHP_INT_MAX, "multiplier" => 100]
        ["start" => 500, "end" => 1000, "multiplier" => 20] 
    ];
    $total = 0;

    foreach ($range as $group) {
        if ($unit_value > $group["start"] && $unit_value <= $group["end"]) {
            $total += ($unit_value - $group["start"]) * $group["multiplier"];
            break;
        } elseif ($unit_value > $group["end"]) {
            $total += ($group["end"] - $group["start"]) * $group["multiplier"];
        }
    }
    if ($unit_value > end($range)["end"]) {  //1200
        $total += ($unit_value - end($range)["end"]) * end($range)["multiplier"];
    }
    echo "Total Value: " . $total;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
</head>
<body>
    <form action="try.php" class="cal" method="post">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        Unit Value: <input type="number" name="unit_value"><br>
                        <input type="submit" value="Calculate">
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php 
?>
</body>
</html>
