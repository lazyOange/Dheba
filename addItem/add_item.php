<?php
    
    $pageHeader = "Add Items";
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

/* Items recorder */
.container {
    max-width: 1000px; /* Adjustable to suit different screen sizes */
    margin: 75px auto; /* Center the container with a top and bottom margin */
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow for depth */
  }
  
   .form{
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Slightly increased gap for better visual separation */
    align-items: flex-start; /* Align items at the start of the flex container */
    font-size: large; /* Large font for better readability */
  }
  
  .input-group{
    flex: 1 1 300px; /* Adjust this basis as per your layout preference */
    display: flex;
    flex-direction: column;
    gap: 10px;

  }
  .button-group {
    flex: 1 1 100%; /* Make sure each group takes full width of the form */
    display: flex;
    flex-direction: column; /* Elements are stacked vertically */
    gap: 10px; /* Space between label and input or button */
  }
  
  .input-group label,
  .button-group button {
    width: auto; /* Allow the width to adjust based on content size */
  }
  
  .input-group input,
  .input-group select {
    padding: 8px;
    font-size: 16px; /* Increase font size for better readability */
    border: 1px solid #ccc;
    border-radius: 4px; /* Rounded corners for aesthetic */
  }
  
  .button-group {
    align-items: center; /* Center-align the button */
    justify-content: center; /* Center the button horizontally */
  }
  
  .button-group button {
    background-color: var(--primary);
    color: white; /* White text for better contrast */
    cursor: pointer; /* Pointer cursor on hover */
    padding: 12px 20px; /* Increased padding for a larger button */
    font-size: 18px; /* Larger font size for the button text */
    border: none; /* No border to keep it clean */
    border-radius: 4px; /* Consistency in border radius */
  }
  
  .button-group button:hover {
    background-color: var(--accent); /* Darker blue on hover for button */
  }
  @media (max-width: 600px) {
    .input-group {
      flex-basis: 100%; /* Full width on small screens */
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

 <!-- Here we record any new items that we are adding in the shop -->
 <div class="container">
    <form action="submit_item.php" method="POST" class="form" >
      <div class="input-group">
        <label for="itemName">Item Name</label>
        <input type="text" id="itemName" name="itemName" placeholder="Item Name" required>
      </div>
      <div class="input-group">
        <label for="itemPrice">Price</label>
        <input type="number" id="itemPrice" name="itemPrice" placeholder="Price per unit" required>
      </div>
      <div class="input-group">
        <label for="itemRemarks">Remarks</label>
        <input type="text" id="itemRemarks" name="itemRemarks" placeholder="Remarks">
      </div>
      <div class="button-group">
        <button type="submit">Add Item</button>
      </div>
    </form>
  </div>
 <!-- Display Items in Table -->
    <div class="tabular--wrapper">
        <h3 class="main--title">Items Data</h3>
        <div class="table--container">
        <?php
            require('../addItem/add_table.php')

                ?>

        </div>
    </div>
      
<?php
    include('../component/footer.php');
?>