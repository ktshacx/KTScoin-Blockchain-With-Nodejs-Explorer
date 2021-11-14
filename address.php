<html>
    <head>
        <title>KTScoin Explorer - Address Details</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        
        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-light bg-light">
            <a href="#" class="navbar-brand">KTScoin Explorer - Address Details</a>
        </nav>
        <?php
           if(isset($_GET['id'])){
               $id = $_GET['id'];
               $data = file_get_contents('http://localhost:3001/address/'.$id.'');
               $arr = json_decode($data);
               $address = $arr->addressData;
               if($id != '' & strlen($id) == 130){
               echo '<div class="p-5"><div class="card card-body card-text">';
               echo '<b>Balance: </b> '.$address->addressBalance.'<br>';
               echo '<b>Address: </b><a href="http://localhost/address.php?id='.$id.'">'.$id.'</a><br>';
               echo "</div>";
               echo '<form method="get" class="d-flex mt-5">
               <input type="text" name="id" class="form-control" placeholder="Enter Address..." style="width: 50%">
               <button class="btn btn-primary">Get Details</button>';
               echo "</div>";
               $transactions = array_reverse($arr->addressData->addressTransactions);
               ?>
              <b class="ml-3">All transactions</b>
        <section class="transactions table-responsive">
              <table class="table table-bordered ">
                  <thead class="thead-dark">
                      <th>Sender</th>
                      <th>Recipient</th>
                      <th>Amount</th>
                      <th>Timestamp</th>
                      <th>Transaction Hash</th>
                  </thead>
                  <tbody>
              <?php
              for($i=0;$i < count($transactions); $i++) {
                  if($transactions[$i]->status == 'pending'){
                      echo '<tr class="bg-warning">';
                  } else {
                    echo '<tr>';
                  }
                    echo '<td><a href="http://localhost/address.php?id='.$transactions[$i]->sender.'">'.$transactions[$i]->sender.'</a></td>';
                    echo '<td><a href="http://localhost/address.php?id='.$transactions[$i]->recipient.'">'.$transactions[$i]->recipient.'</a></td>';
                    echo '<td>'.$transactions[$i]->amount.'</td>';
                    echo '<td>'.$transactions[$i]->timestamp.'</td>';
                    echo '<td><a href="http://localhost/transactionDetails.php?id='.$transactions[$i]->transactionId.'">'.$transactions[$i]->transactionId.'</a></td>';
                    echo '<tr>';
              }
            ?>
            </tbody>
            </table>
               <?php
               }
               else {
                echo '<div class="p-5">';
                   echo '<div class="alert alert-danger" role="alert"><b>Invalid Transaction Id or It was not mined yet !</b></div><br><form method="get" class="d-flex mt-2">
                   <input type="text" name="id" class="form-control" placeholder="Enter Address..." style="width: 50%">
                   <button class="btn btn-primary">Get Details</button>
               </form>';
               echo "</div>";
               }
           }else{
            echo '<div class="p-5">';
               echo '<form method="get" class="d-flex">
               <input type="text" name="id" class="form-control" placeholder="Enter Address..." style="width: 50%">
               <button class="btn btn-primary">Get Details</button>
           </form>';
           echo "</div>";
           }
        ?>
        
    </body>
</html>