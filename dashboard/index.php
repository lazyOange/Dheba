<?php
    
    $pageHeader = "Dashboard";
    require('../functions/dbconnect.php');
    require('../component/header.php');
    require('../component/nav-bar.php');

?>
    <style>
        /* main body section */
.main--content{
    position: static;
    background-color: var(--background);
    width: 93%;
    padding: 1rem;
    margin-left: 90px;
   
}

.header--wrapper img{
    width: 50px;
    height: 50px;
    cursor: pointer;
    border-radius: 50%;
}
.header--wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    background: var(--primary);
    border-radius: 10px;
    padding: 5px 2rem;
    margin-bottom: 1;
}
.header--title{
    color: white;
}
.user--info{
    display: flex;
    align-items: center;
    gap: 1rem;
}
.search--box{
    background: var(--secondary);
    border-radius: 15px;
    color: white;
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 4px 12px; 
    width:200px;
    height: 35px;
}
.search--box input{
    background: transparent;
    padding: 10px;
}
.search--box i{
    height: 20px;
    margin-bottom: 27px;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.5 ease-out;
}

/* card container */

.card--container{
    background: rgb(229, 235, 230);
    padding: 2rem;
    border-radius: 10px;
    margin-top: 20px;
}

.card--wrapper{
    display: flex;
    flex-wrap: wrap;
    gap:1rem;
}
.main--title{
    color: var(--text);
    padding-bottom: 10px;
    font-size: 30px;
}
.payment--card{
    background: var(--accent);
    border-radius: 10px;
    padding: 1.2rem;
    width:290px;
    height: 150px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.5s ease-in-out;
}
.payment--card:hover{
    transform: translateY(10px);
}
.card--header{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.amount{
    display: flex;
    flex-direction: column;

}
.title{
    font-size: 20px;
    font-weight: 200;
}
.amount--value{
    font-size: 24px;
    font-weight: 600;
}
.icon{
    color: white;
    padding: 1rem;
    height: 60px;
    width: 60px;
    text-align: center;
    border-radius: 50%;
    font-size: 1.5rem;
    background: var(--primary);
}
.card-details{
    letter-spacing: 2px;
}

/* tabular wrapper */
.tabular--wrapper{
    background: white;
    margin-top: 1rem;
    border-radius: 10px;
    padding: 2rem;
}

.table--container{
    column-width: 100%;
}
table {
    width: 100%;
    border-collapse: collapse;
}
thead{
    background: var(--primary);
    color: white;
}
th{
    padding: 15px;
    text-align: left;
}

tbody{
    background: white;
}
td{
    padding: 15px;
    font-size: 14px;
    color: black;
}

tr:nth-child(even){
    background: white;
}
tfoot{
    background-color: aqua;
    font-weight: bold;
    color: white;
}
tfoot td{
    padding: 15px;
}
.table--container button{
    color: rgb(128, 15, 0);
    background: none;
    cursor: pointer;
}
    </style>
            <div class="card--container">
                <h2 class="main--title">Today's Data</h2>
                <div class="card--wrapper">
                    <div class="payment--card">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Sales Amount</span>
                                <span class="amount--value">Rs
                                    <?php 
                                        include('../functions/dbconnect.php');

                                        $today = date("Y-m-d");
                                        
                                        $sql = "SELECT SUM(total_price) AS total_amount FROM dailysale
                                        Where DATE(transaction_date) ='$today' ";  // Give the sum an alias
                                        $result = mysqli_query($conn, $sql);
                                    
                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);  // Fetch the row
                                            $total_amount = $row['total_amount'];  // Get the sum from the row
                                            echo $total_amount;
                                        } else {
                                            echo "No data found";
                                        }
                                    
                                        // Close connection
                                        mysqli_close($conn);
                                    ?></span>
                            </div>
                            <i class="fas fa-dollar-sign icon"></i>
                        </div>
                    </div>
                    <div class="payment--card">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Items Sold</span>
                                <span class="amount--value"><?php 
                                        include('../functions/dbconnect.php');    
                                        $today = date("Y-m-d");

                                        $sql = "SELECT COUNT(item) AS total_item
                                         FROM dailysale 
                                         Where DATE(transaction_date) ='$today' ";  // Give the sum an alias
                                        $result = mysqli_query($conn, $sql);
                                    
                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);  // Fetch the row
                                            $total_item = $row['total_item'];  // Get the sum from the row
                                            echo $total_item;
                                        } else {
                                            echo "No data found";
                                        }
                                    
                                        // Close connection
                                        mysqli_close($conn);
                                    ?></span>
                            </div>
                            <i class="fas fa-list icon"></i>
                        </div>
                    </div>
                    <div class="payment--card">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Credit Sales</span>
                                <span class="amount--value">Rs  <?php 
                                        include('../functions/dbconnect.php');
                                        $today = date("Y-m-d");
                                        $sql = "SELECT SUM(total_price) AS total_amount
                                                 FROM dailysale
                                                 WHERE transaction_type = 'Not Paid' AND DATE(transaction_date) ='$today' ";  // Give the sum an alias
                                        $result = mysqli_query($conn, $sql);
                                    
                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);  // Fetch the row
                                            $total_amount = $row['total_amount'];  // Get the sum from the row
                                            echo $total_amount;
                                        } else {
                                            echo "No data found";
                                        }
                                    
                                        // Close connection
                                        mysqli_close($conn);
                                    ?></span>
                            </div>
                            <i class="fas fa-users icon"></i>
                        </div>
                    </div>
                    <div class="payment--card">
                        <div class="card--header">
                            <div class="amount">
                                <span class="title">Best Seller</span>
                                <span class="amount--value">
                                <?php 
                                        include('../functions/dbconnect.php');
                                        $today = date("Y-m-d");
                                        $sql = "SELECT item, SUM(quantity) AS total_quantity_sold
                                        FROM dailysale
                                        Where DATE(transaction_date) ='$today'
                                        GROUP BY item
                                        ORDER BY total_quantity_sold DESC
                                        LIMIT 1;";  
                                        $result = mysqli_query($conn, $sql);
                                    
                                        if ($result) {
                                            $row = mysqli_fetch_assoc($result);  // Fetch the row
                                             $best_seller_item = $row['item'];  // Get the item name from the row
                                                echo $best_seller_item;
                                        } else {
                                            echo "No data found";
                                        }
                                    
                                        // Close connection
                                        mysqli_close($conn);
                                    ?>
                                </span>
                            </div>
                            <i class="fas fa-check icon"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabular--wrapper">
                <h3 class="main--title">Finance Data</h3>
                <div class="table--container">
              <?php
                require('../dashboard/index_table.php');
              ?>
                </div>
            </div>
            <?php
    include('../component/footer.php');
?>