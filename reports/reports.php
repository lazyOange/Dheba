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
.search--box {
    background: var(--secondary);
    border-radius: 15px;
    color: white;
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 4px 12px;
    width: 200px;
    height: 35px;
}
.search--box input {
    background: transparent;
    padding: 10px;
}
.search--box i {
    height: 20px;
    margin-bottom: 27px;
    font-size: 1.2rem;
    cursor: pointer;
    transition: all 0.5s ease-out;
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
<div class="container">
    <form action="report_data.php" method="POST" class="form">
        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate" name="startDate" required>
        <label for="endDate">End Date:</label>
        <input type="date" id="endDate" name="endDate" required>
        <button type="button" id="generateReportBtn">Generate Report</button>
    </form>
</div>
<div id="reportContainer" class="container"></div>
<script>
document.getElementById('generateReportBtn').addEventListener('click', function() {
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    // Fetch data and generate report here
});
</script>

<?php
    include('../component/footer.php');
?>
