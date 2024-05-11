<?php
    
    $pageHeader = "Daily Sales";
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

/* sales recorder */
.container {
  max-width: 1000px; /* Adjust based on your preference */
  margin: 75px auto;
  padding: 20px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  align-items: flex-start; /* Align items at the start of the flex container */
  font-size: large;
}

.input-group,
.button-group {
  flex: 1 1 200px; /* Grow and shrink with a basis of 200px */
  display: flex;
  flex-direction: column; /* Stack the label/input vertically */
  gap: 10px;
}


.button-group {
    
  align-items: flex-end;
  justify-content: flex-end;
}

.input-group label,
.button-group button {
  width: 10rem; /* Full width */
}

/* Styling for inputs, buttons, and labels (you can reuse the styles provided in the previous response) */
.input-group input,
.input-group select {
  padding: 8px;
  font-size: 16px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.button-group button {
    padding: 12px 20px; /* Increase padding for a larger button */
    font-size: 18px; /* Larger text inside the button */
    width: auto; /* Adjust if you want the buttons to be wider */
    border: 1px solid #ccc;
  border-radius: 4px;
  }
.button-group button {
  background-color: var(--primary);
  color: white;
  cursor: pointer;
  border: none;
}

.button-group button:hover {
  background-color: var(--accent);
}

/* Ensure buttons align below the "Total Price" at the end */
.button-group {
  order: 5; /* Push the button group to the end */
}

#buyerNameGroup {
   padding-top: 10px;
   margin-left: 0px;
}
#sales-type{
    padding-top: 47px;
    padding-left: 20px;

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
    color: green;
    background: none;
    cursor: pointer;
}
</style>
    <!-- Here we record Daily Sales-->
    <div class="container">
    <form class="form" action="record_sales.php" method="post">
            <div class="input-group">
                <label for="item">Item:</label>
                <select name="item" id="item">
        <?php 
        include('../functions/dbconnect.php');

        $sql = "SELECT * FROM add_item";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['itemName'] . "'>" . htmlspecialchars($row['itemName']) . "</option>";
            }
        } else {
            echo "<option>No data found</option>";
        }

        // Close connection
        mysqli_close($conn);
        ?>
    </select>
            </div>
            <div class="input-group">
                <label for="unitPrice">Unit Price:</label>
                <input type="number" step="0.00001" id="unitPrice" name="unitPrice" placeholder="Unit Price">
            </div>
            <div class="input-group">
                <label for="quantity">Quantity:</label>
                <input type="number" step="0.00001" id="quantity" name="quantity" placeholder="Quantity">
            </div>
            <div class="input-group">
                <label for="totalPrice">Total Price:</label>
                <input type="text" id="totalPrice" name="totalPrice" placeholder="Total Price" readonly>
            </div>
            <div class="input-group" id="buyerNameGroup" >
                <label for="buyerName">Buyer:</label>
                <input type="text" id="buyerName" name="buyerName" placeholder="Buyer's Name">
            </div>
            <div class="sales-type">
               
            </div>
            <div class="button-group">
                <button type="button" id="calculateBtn">Calculate Total</button>
                <button>Record Sale</button>
            </div>
            <label for="paid-sales"><input id="sales-type" type="radio" name="transaction_type" value="Cash" class="inline" checked /> Cash</label>
            <label for="unpaid-sales"><input id="sales-type" type="radio" name="transaction_type" value="Not Paid" class="inline" /> Unpaid</label>
            <label for="online-sales"><input id="sales-type" type="radio" name="transaction_type" value="Online Paid" class="inline" /> Online</label>
        </form>
      </div>      
<script>
    document.getElementById('calculateBtn').addEventListener('click', function() {
        var unitPrice = parseFloat(document.getElementById('unitPrice').value);
        var quantity = parseFloat(document.getElementById('quantity').value);
        var totalPrice = unitPrice * quantity;
        document.getElementById('totalPrice').value = totalPrice.toFixed(2);
    });
   
  $(document).ready(function(){
    $('.form').on('submit', function(e){
      e.preventDefault(); // Prevent default form submission
      
      var formData = $(this).serialize(); // Serialize form data
      
      $.ajax({
        type: 'POST',
        url: 'record_sales.php', // Replace 'submit_item.php' with your PHP script URL
        data: formData,
        success: function(response){
          alert(response); // Display success message (for testing)

            // Clear form fields
            $('.form')[0].reset();

                // Update table with the response received from add_table.php
                $('.table--container').load('../dailySales/daily_table.php');
              },
        error: function(xhr, status, error){
          console.log(xhr.responseText); // Log error message
        }
      });
    });
  });

</script>
            
            <div class="tabular--wrapper">
                <h3 class="main--title">Finance Data</h3>
                <div class="table--container">
                    <?php
                require('../dailySales/daily_table.php');
                ?>
                </div>
            </div>
    <?php
    include('../component/footer.php');
?>