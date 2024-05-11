<?php
$pageHeader = "Reports";
require '../functions/dbconnect.php';
require '../component/header.php';
require '../component/nav-bar.php';
?>
<style>
/* CSS styles for the report page */
.main--content {
    position: static;
    background-color: var(--background);
    width: 93%;
    padding: 1rem;
    margin-left: 90px;
}
.header--wrapper img {
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
.header--title {
    color: white;
    
}
.user--info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.container {
    max-width: 1000px;
    margin: 75px auto;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
.form {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    align-items: flex-start;
    font-size: large;
}
.input-group,
.button-group {
    flex: 1 1 100%;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.input-group label,
.button-group button {
    width: auto;
}
.input-group input {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
}
.button-group {
    align-items: center;
    justify-content: center;
}
.button-group button {
    background-color: #007bff;
    color: white;
    cursor: pointer;
    padding: 12px 20px;
    font-size: 18px;
    border: none;
    border-radius: 4px;
}
.button-group button:hover {
    background-color: #0056b3;
}
@media (max-width: 600px) {
    .input-group {
        flex-basis: 100%;
    }
}
</style>
<div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <h2>Sales Report Generator</h2>
            </div>
            <div class="user--info">
                <!-- Form for inputting date range -->
                <form action="do.php" method="POST" class="form">
                    <div class="input-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" required>
                    </div>
                    <div class="input-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" required>
                    </div>
                    <div class="button-group">
                        <button type="submit">Generate PDF</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    

<?php
    include('../component/footer.php');
?>
