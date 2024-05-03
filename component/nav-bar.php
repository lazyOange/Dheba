<style>

    nav {
        position: absolute;
        top: 0;
        bottom: 0;
        height: 100%;
        left: 0;
        background: var(--secondary); ;
        width: 90px;
        overflow: hidden;
        transition: width 0.2s linear;
        box-shadow: 0 20px 35px rgba(246, 243, 241, 0.947);
        position: fixed;
    }
    .logo {
        text-align: center;
        display: flex;
        transition: all 0.5s ease;
        margin: 10px 0 0 10px;
    }
    .logo img{
        width: 45px;
        height: 45px;
        border-radius: 50%;
    }
    .logo span{
        font-weight: bold;
        padding-left: 15px;
        font-size: 18px;
        text-transform: uppercase;
    }
    a{
        position: relative;
        color:rgb(13, 58, 47);
        font-size: 14px;
        display: table;
        width: 300px;
        padding: 10px;
    }
    .fas{
        position: relative;
        width: 70px;
        height: 40px;
        top: 14px;
        font-size: 20px;
        text-align: center;
    }
    .nav-item{
        position: relative;
        top: 12px;
        margin-left: 10px;
        color: black;
        font-size: 19px;
    }
    a:hover{
        background: #eee;
    }
    nav:hover{
        width: 280px;
        transition: all 0.5s ease;
    }

    .logout{
        position: absolute;
        bottom: 0;
    }

</style>

<nav>
    <ul>
        <li>
            <a href="#" class="logo">
                <img src="../Resources/Images/logo.png" alt="Logo of the company">
                <span class="nav-item">Butcher Shop</span>
            </a>
        </li>
        <li>
            <a href="../dashboard/index.php">
                <i class="fas fa-chart-bar"></i>
                <span class="nav-item">Dashboard</span>
            </a>
        </li>
        <li><a href="../dailySales/daily_sales.php">
            <i class="fas fa-wallet"></i>
                <span class="nav-item">Daily Sales</span>
        </a></li>
        <li><a href="../addItem/add_item.php">
            <i class="fas fa-plus"></i>
                <span class="nav-item">Add Item</span>
        </a></li>
        <li><a href="../removeItems/remove.php">
            <i class="fas fa-trash"></i>
                <span class="nav-item">Remove Item</span>
        </a></li>
        <li><a href="#">
            <i class="fas fa-tag"></i>
                <span class="nav-item">Change Price</span>
        </a></li>
        <li><a href="../reports/reports.php">
            <i class="fas fa-tasks"></i>
                <span class="nav-item">Report</span>
        </a></li>
        <li><a href="#">
            <i class="fas fa-cog"></i>
                <span class="nav-item">Setting</span>
        </a></li>
        
        <li><a href="#" class="logout">
            <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Exit</span>
        </a></li>
    </ul>
</nav>

<div class="main--content">
    <div class="header--wrapper">
        <div class="header--title">
            <h4><?php echo $pageHeader ?></h4>
        </div>
        <div class="user--info">
        <img src="../resources/Images/logo.png" alt="logo of the company" >
        </div>
    </div>