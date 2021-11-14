<html>
    <head>
        <title>KTScoin Explorer - Transction Details</title>
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
            <a href="#" class="navbar-brand">KTScoin Explorer - Transaction Details</a>
        </nav>
        <?php
           if(isset($_GET['id'])){
               $id = $_GET['id'];
               $data = file_get_contents('http://localhost:3001/transaction/'.$id.'');
               $arr = json_decode($data);
               $transaction_details = $arr->transaction;
               if($transaction_details != ''){
               echo '<div class="p-5"><div class="card card-body card-text">';
               echo '<b>Amount:</b> '.$transaction_details->amount.'<br>';
               echo '<b>Sender:</b> '.$transaction_details->sender.'<br>';
               echo '<b>Recipient:</b> '.$transaction_details->recipient.'<br>';
               echo '<b>Timestamp:</b> '.$transaction_details->timestamp.'<br>';
               echo '<b>Status:</b> '.$transaction_details->status.'<br>';
               echo '<b>Transaction Hash:</b> '.$id.'<br>';
               echo "</div>";
               echo '<form method="get" class="d-flex mt-5">
               <input type="text" name="id" class="form-control" placeholder="Enter Transaction Id..." style="width: 50%">
               <button class="btn btn-primary">Get Details</button>';
               echo "</div>";
               }
               else {
                echo '<div class="p-5">';
                   echo '<div class="alert alert-danger" role="alert"><b>Invalid Transaction Id or It was not mined yet !</b></div><br><form method="get" class="d-flex mt-2">
                   <input type="text" name="id" class="form-control" placeholder="Enter Transaction Id..." style="width: 50%">
                   <button class="btn btn-primary">Get Details</button>
               </form>';
               echo "</div>";
               }
           }else{
            echo '<div class="p-5">';
               echo '<form method="get" class="d-flex">
               <input type="text" name="id" class="form-control" placeholder="Enter Transaction Id..." style="width: 50%">
               <button class="btn btn-primary">Get Details</button>
           </form>';
           echo "</div>";
           }
        ?>
        
    </body>
</html>