<?php
    
    $pageHeader = "Remove Items";
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

/* Items Removed recorder */
.container {
    max-width: 1000px;
    margin: 75px auto;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form {
    display: flex;
    flex-wrap: wrap;
    gap: 10px; /* Maintain a small gap for layout cleanliness */
    align-items: flex-start;
    font-size: large;
}

.input-group {
    flex: 1 1 75px;
    display: flex;
    flex-direction:column;
    gap: 10px; /* Small gap between label and input for compact layout */
}

.input-group label,
.button-group button {
    width: auto; /* Flexibility in width based on content */
}

.input-group input,
.input-group select {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 50%;
}

.button-group button {
    background-color: var(--primary);
    color: white;
    cursor: pointer;
    padding: 12px 20px;
    font-size: 18px;
    border: none;
    border-radius: 4px;
}

.button-group button:hover {
    background-color: var(--accent);
}

@media (max-width: 600px) {
    .input-group, .button-group {
        flex-basis: 100%; /* Full width on small screens */
        order: 0; /* Reset order to default for stacking correctly */
    }
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
    <!-- Here input  items that we are removing in the shop -->
<div class="container">
<form action="remove_item.php" method="POST" class="form" >
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
      <div class="input-group">
        <label for="itemRemarks">Remarks</label>
        <input type="text" name ="des" id="itemRemarks" placeholder="Remarks">
      </div>
      <div class="button-group">
        <button type="submit" name="remove">Remove Item</button>
        
    </div>
   
        
</form>
            
            <div class="tabular--wrapper">
                <h3 class="main--title">Removed Items </h3>
                <div class="table--container">
                    <?php
                    require('../removeItems/remove_table.php');
                    ?>
  
                </div>
            </div>
            <?php
    include('../component/footer.php');
?>