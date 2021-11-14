<html>
    <head>
        <title>KTScoin Explorer</title>
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
            <a href="#" class="navbar-brand">KTScoin Explorer</a>
        </nav>
        <?php
              $data = file_get_contents('http://localhost:3001/blockchain');
              $arr = json_decode($data);
              $blocksNo = count($arr->chain);
              $transactions = array_reverse($arr->pendingTransactions);
              $transNo = $arr->totalTransactions;
              echo '<div class="d-flex m-3">';
              echo '<div class="card text-center" style="width: 10rem; height: 7rem;">
              <div class="card-body">
              <h5 class="card-title">Total Blocks</h5>
              <p class="card-text">'.$blocksNo.'</p>
              </div>
            </div>';
            echo '<div class="card ml-5 text-center" style="width: 10rem; height: 7rem;">
              <div class="card-body">
              <h5 class="card-title">Total Transactions</h5>
              <p class="card-text">'.$transNo.'</p>
              </div>
            </div>';
              echo '</div>';
              ?>
              <h1 class="mt-5 ml-3">Latest Transactions</h1>
              <p class="ml-3">All latest unconfirmed transactions</p>
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
                  echo '<tr>';
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
        </section>
    </body>
</html>