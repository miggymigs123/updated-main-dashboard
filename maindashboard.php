
<?php
require 'pedia3xv2_DB.php';

// Check connection
if ($connection->connect_error) {
die("Connection failed: " . $connection->connect_error);
}

$sql = "SELECT COUNT(*) AS status_Overdue FROM VacRecord WHERE VacStatus = 'Overdue'";;
$sql1 = "SELECT COUNT(*) AS status_Completed FROM VacRecord WHERE VacStatus = 'Completed'";;
$sql2 = "SELECT COUNT(*) AS status_Conditional FROM VacRecord WHERE VacStatus = 'Conditional'";;
$sql3 = "SELECT COUNT(*) AS status_Pending FROM VacRecord WHERE VacStatus = 'Pending'";;

// Execute the query
$result = $connection->query($sql);
$result1 = $connection->query($sql1);
$result2 = $connection->query($sql2);
$result3 = $connection->query($sql3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" href="maindashboard.css">
<link rel="stylesheet" href="Main.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
body{
font-family: "Rubik", sans-serif;
background-color: #FCFCFC;
padding-top: 45px;
}

header {
background-color: #fff;       /* Background color */
color: black;                 /* Text color */
padding: 7px 15px;           /* Padding inside the header */
top: 0;                       /* Fix the header to the top */
left: 0;                      /* Ensure header starts from the left */
width: 100%;                  /* Make header span the full width */
position: fixed;              /* Fix the header position */
z-index: 1;                /* Ensure header is above other elements */
box-shadow: 0px 0px 5px rgba(160, 160, 160, 0.5); /* Shadow for depth */
}

#pedia3x{
height: 50px;
margin-left: 330px;
}

.container-fluid{
margin: 0px;
color: #171717;
}

#nav_bar{
height: auto;
box-shadow: 0px 0px 5px rgba(160, 160, 160, 0.5);
padding: 20px;
background: #fff;
border-top-right-radius: 10px;
border-bottom-right-radius: 10px;
position: fixed;
top: 0;
left: 0;
z-index: 2;
width: 330px;
height: 100vh;
overflow-y: auto;
}

#user_profile_card{
background-color: #F4F3FB;
height: 80px;
border-radius: 10px;
align-items: center;
margin: 1px;
display: flex;
}

#main{
margin-left: 350px; /* Give space for the sidebar */
margin-right: 12px;
margin-top: 35px;
padding: 80px;
padding-top: 50px;
background-color: #fff;
box-shadow: 0px 0px 3px rgba(160, 160, 160, 0.5);
flex-grow: 1;
border-radius: 10px;
min-height: 100vh;
}

.nav-link {
display: flex; /* Ensured icons and text align properly */
align-items: center;
padding: 8px;
font-size: 1.08rem;
font-weight: 450;
}

.nav-link img {
margin-right: 8px; /* Added space between icon and text */
}

.nav-link a {
text-decoration: none;
color: #3c3c3c;
}

.status-card {
display: flex;
align-items: center;
justify-content: space-between; /* Ensures icon and text have space */
border-radius: 10px;
box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
margin: 7px 0;
overflow: hidden; /* Ensure the left strip is contained within the card */
height: 85px; /* Adjust height as needed */
}

.status-content {
display: flex;
flex-direction: column;
align-items: center; /* Centers content horizontally */
justify-content: center; /* Centers content vertically */
text-align: center; /* Centers text */
flex-grow: 1;
}

.status-left {
width: 12px;
height: 100%;
border-radius: 10px 0 0 10px;
}

.status-icon {
display: flex;
align-items: center;
justify-content: center;
width: 50px;
height: 50px;
margin-right: 15px;
margin-left: 15px;
}

.status-icon.overdue {
color: #E55C5C;
background-color: #e55c5c29;
height: 95px;
width: 80px;
margin-left: 0;
}

.status-left.overdue {
background-color: #E74C3C;
}

.status-icon.completed {
color: #5FA154;
background-color: #60a15426;
height: 95px;
width: 80px;
margin-left: 0;
}

.status-left.completed {
background-color: #5FA154;
}

.status-icon.conditional {
color: #9574DC;
background-color: #9574dc29;
height: 95px;
width: 80px;
margin-left: 0;
}

.status-left.conditional {
background-color: #8E44AD;
}

.status-icon.pending {
color: #E5865C;
background-color: #e5855c2a;
height: 95px;
width: 80px;
margin-left: 0;
}

.status-left.pending {
background-color: #E67E22;
}

.status-text.overdue{
font-weight: 550;
color: #E55C5C;
font-size: 1.1rem;
}

.status-text.completed{
font-weight: 550;
color: #5FA154;
font-size: 1.1rem;
}

.status-text.conditional{
font-weight: 550;
color: #9574DC;
font-size: 1.1rem;
}

.status-text.pending{
font-weight: 550;
color: #E5865C;
font-size: 1.1rem;
}

.status-number {
font-size: 2rem;
font-weight: 550;
margin-right: 15px;
}

.form-control {
border-radius: 10px;
margin-right: 5px;
}

.profile_label.row{
background-color: #fff;
border-radius: 10px;
box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
height: 37px;
align-items: center;
text-align: center;
padding-top: 6px;
margin-top: 15px;
}

.child_profile_card.row{
background-color: #fff;
border-radius: 10px;
box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
height: 75px;
align-items: center;
text-align: center;
margin-top: 8px;
padding-bottom: 0;
}

footer {
background-color: #8F80D0;
color: white;
text-align: center;
position: fixed;
bottom: 0;
width: 100%;
height: 2.5%
}


</style>
</head>
<header>
<img src="/images/logo.png" alt="pedia3x" id="pedia3x">
</header>
<body>

<script>
const calendarGrid = document.querySelector('.calendar-grid');
const monthSelector = document.getElementById('month-selector');
const yearSelector = document.getElementById('year-selector');
const prevButton = document.querySelector('.nav-button.prev');
const nextButton = document.querySelector('.nav-button.next');
let currentDate = new Date();

function populateYearOptions() {
const currentYear = new Date().getFullYear();
for (let year = currentYear - 10; year <= currentYear + 10; year++) {
const option = document.createElement('option');
option.value = year;
option.textContent = year;
if (year === currentYear) {
option.selected = true;
}
yearSelector.appendChild(option);
}
}

function updateCalendarGrid(year, month) {
calendarGrid.innerHTML = ''; // Clear the grid
const daysInMonth = new Date(year, month + 1, 0).getDate();
const firstDay = new Date(year, month, 1).getDay();

// Create blank days for the first week
for (let i = 0; i < firstDay; i++) {
const emptyCell = document.createElement('div');
emptyCell.classList.add('calendar-day', 'empty');
calendarGrid.appendChild(emptyCell);
}

// Populate days of the month
for (let day = 1; day <= daysInMonth; day++) {
const dayCell = document.createElement('div');
dayCell.classList.add('calendar-day');
dayCell.textContent = day;
calendarGrid.appendChild(dayCell);
}
}

function updateCalendar() {
const selectedMonth = parseInt(monthSelector.value, 10);
const selectedYear = parseInt(yearSelector.value, 10);
updateCalendarGrid(selectedYear, selectedMonth);
}

function navigateMonth(step) {
currentDate.setMonth(currentDate.getMonth() + step);
monthSelector.value = currentDate.getMonth();
yearSelector.value = currentDate.getFullYear();
updateCalendar();
}

// Populate the year options
populateYearOptions();

// Initialize calendar grid
updateCalendarGrid(currentDate.getFullYear(), currentDate.getMonth());

// Event listeners for navigation and selection
monthSelector.addEventListener('change', updateCalendar);
yearSelector.addEventListener('change', updateCalendar);

prevButton.addEventListener('click', () => navigateMonth(-1));
nextButton.addEventListener('click', () => navigateMonth(1));

function toggleDescription(id) {
const desc = document.getElementById(id);
desc.classList.toggle('show');
}
</script>

<!--SIDE NAV-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-auto" id="nav_bar">
            <br>
            <div class="row" id="user_profile_card">
                <div class="col-2">
                    <img src="/images/sample.png" width="55px">
                </div>
                <div class="col-1">
                    
                </div>
                <div class="col-9">
                    <p class="fs-5 fw-bold mb-0">BRGY. UGAC SUR</p>
                    <p class="fs-6 mt-0">Account In Use</p>
                </div>
            </div>
            
            <hr>
            
            <div class="col">
                <ul class="list-unstyled">
                <li class="nav-link mb-2"><img width="30" height="30" src="https://img.icons8.com/material-outlined/96/dashboard-layout.png" alt="dashboard-layout"/><a style="text-decoration: none; color: #3c3c3c;" href="maindashboard.php">&#160 Dashboard</a></li>
                <li class="nav-link mb-2"><img width="30" height="30" src="https://img.icons8.com/material-outlined/96/syringe.png" alt="syringe"/><a style="text-decoration: none; color: #3c3c3c;" href="VaccineList.php">&#160 List of Vaccines</a></li>
                <li class="nav-link mb-2"><img width="30" height="30" src="https://img.icons8.com/material-outlined/96/admin-settings-male.png" alt="admin-settings-male"/><a style="text-decoration: none; color: #3c3c3c;" href="profilemgmt_login.php">&#160 Manage Profiles</a></li>
                <li class="nav-link mb-2"><img width="30" height="30" src="https://img.icons8.com/material-outlined/96/group-of-projects.png" alt="group-of-projects"/><a style="text-decoration: none; color: #3c3c3c;" href="programs.php">&#160 Immunization Programs</a></li>
                </ul>
                <hr class="divider">
                <section class="calendar-widget">
                <div class="calendar-container">
                    <div class="calendar-header">
                        <div class="month-selector">
                            <label for="month-selector" class="selector-text">Month</label>
                            <select id="month-selector">
                            <option value="0">January</option>
                            <option value="1">February</option>
                            <option value="2">March</option>
                            <option value="3">April</option>
                            <option value="4">May</option>
                            <option value="5">June</option>
                            <option value="6">July</option>
                            <option value="7">August</option>
                            <option value="8">September</option>
                            <option value="9">October</option>
                            <option value="10">November</option>
                            <option value="11">December</option>
                            </select>
                        </div>
                        <div class="year-selector">
                            <label for="year-selector" class="selector-text">Year</label>
                            <select id="year-selector"></select>
                        </div>
                    </div>
                    <div class="calendar-navigation">
                        <button class="nav-button prev" aria-label="Previous Month"><img src="images/arrowleft.png" alt="Previous Month" loading="lazy" style="width: 19px; height: 20px;"></button>
                        <button class="nav-button next" aria-label="Next Month"><img src="images/arrowright.png" alt="Next Month" loading="lazy" style="width: 19px; height: 20px;"></button>
                    </div>
                    <div class="calendar-grid">
                    <div class="calendar-day">1</div>
                    <div class="calendar-day">2</div>
                    <div class="calendar-day">3</div>
                    <div class="calendar-day">4</div>
                    <div class="calendar-day">5</div>
                    <div class="calendar-day">6</div>
                    <div class="calendar-day">7</div>
                    <div class="calendar-day">8</div>
                    <div class="calendar-day">9</div>
                    <div class="calendar-day">10</div>
                    <div class="calendar-day">11</div>
                    <div class="calendar-day">12</div>
                    <div class="calendar-day">13</div>
                    <div class="calendar-day">14</div>
                    <div class="calendar-day">15</div>
                    <div class="calendar-day">16</div>
                    <div class="calendar-day">17</div>
                    <div class="calendar-day">18</div>
                    <div class="calendar-day">19</div>
                    <div class="calendar-day">20</div>
                    <div class="calendar-day">21</div>
                    <div class="calendar-day">22</div>
                    <div class="calendar-day">23</div>
                    <div class="calendar-day">24</div>
                    <div class="calendar-day">25</div>
                    <div class="calendar-day">26</div>
                    <div class="calendar-day">27</div>
                    <div class="calendar-day">28</div>
                    <div class="calendar-day">29</div>
                    <div class="calendar-day">30</div>
                </div>
            </div>
            
        </div>
        </section>
        <hr class="divider">
        
        <button class="btn" type="button" style="color: #fff; background-color: #9574DC; border-radius: 10px;"><a href="logout.php" style="color: #fff; text-decoration: none;">Logout</a></button>
    </div>
</div>

                                                                                                                            
<!--STATUS CARD-->
<div class="col" id="main">
    <h2 style="font-size: large; font-weight: bold;">Barangay Immunization Compliance</h2>
    
    <div class="row">
        <!-- Overdue Card -->
        <div class="col-md-3">
            <button class="btnStatus">
            <div class="status-card">
                <div class="status-left overdue"></div>
                    <div class="status-icon overdue">
                        <img width="37" height="37" src="/images/overdue.png" alt="important-time"/>
                    </div>
                    <div class="status-content">
                        <div class="status-number">
                            <?php
                            if ($result->num_rows > 0) {
                            
                            $row = $result->fetch_assoc();
                            echo $row['status_Overdue'];
                            } else {
                            echo "0";
                            }
                            ?>
                        </div>
                        <div class="status-text overdue">Overdue</div>
                        </div>
                    </div>
                    </button>
                </div>
                
                
                <!-- Completed Card -->
                <div class="col-md-3">
                    <button class="btnStatus">
                    <div class="status-card">
                        <div class="status-left completed"></div>
                            <div class="status-icon completed">
                                <img width="37" height="37" src="/images/completed.png" alt="checked--v1"/>
                            </div>
                            <div class="status-content">
                                <div class="status-number">
                                    <?php
                                    if ($result1->num_rows > 0) {
                                    
                                    $row = $result1->fetch_assoc();
                                    echo $row['status_Completed'];
                                    } else {
                                    echo "0";
                                    }
                                    ?>
                                </div>
                                <div class="status-text completed">Completed</div>
                                </div>
                            </div>
                            </button>
                            
                        </div>
                                            
    <!-- Conditional Card -->
    <div class="col-md-3">
        <button class="btnStatus">
        <div class="status-card">
            <div class="status-left conditional"></div>
                <div class="status-icon conditional">
                    <img width="37" height="37" src="/images/conditional.png" alt="overtime">
                </div>
                <div class="status-content">
                    <div class="status-number">
                        <?php
                        if ($result2->num_rows > 0) {
                        
                        $row = $result2->fetch_assoc();
                        echo $row['status_Conditional'];
                        } else {
                        echo "0";
                        }
                        ?>
                    </div>
                    <div class="status-text conditional">Conditional</div>
                    </div>
                </div>
                </button>
            </div>
            
            <!-- Pending Card -->
            <div class="col-md-3">
                <button class="btnStatus">
                <div class="status-card">
                    <div class="status-left pending"></div>
                        <div class="status-icon pending">
                            <img width="37" height="37" src="/images/pending.png" alt="data-pending"/>
                        </div>
                        <div class="status-content">
                            <div class="status-number">
                                <?php
                                if ($result3->num_rows > 0) {
                                
                                $row = $result3->fetch_assoc();
                                echo $row['status_Pending'];
                                } else {
                                echo "0";
                                }
                                ?>
                            </div>
                            <div class="status-text pending">Pending</div>
                            </div>
                        </div>
                    </div>
                    </button>
                </div>
                
                <!-- SEARCH BAR -->
                <div class="row mt-4 mb-2 align-items-center" id="ch-info">
                    <div class="col-md-6">
                        <h2 style="font-size: large; font-weight: bold;">Children Information</h2>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search Name..." aria-label="Search Name">
                            <button class="btn" type="button" style="color: #fff; background-color: #9574DC; border-radius: 10px;">Search</button>
                        </div>
                    </div>
                </div>
                
                <!--PROFILE CARD HEADER-->
                <div class="row profile_label">
                    <div class="col-4">
                        <h6>Child Name</h6>
                    </div>
                    
                    <div class="col-3">
                        <h6>Home Address</h6>
                    </div>
                    
                    <div class="col-1">
                        <h6>Sex</h6>
                    </div>
                    
                    <div class="col-2">
                        <h6>Birthdate</h6>
                    </div>
                    
                    <div class="col-2">
                        <h6>Age</h6>
                    </div>
                </div>
                
                <!--PROFILE CARD-->
                <!-- START -->
                <div class="container mt-5">
                    
                    <div class="row_child_profile_card" onclick="">
                        <div class="col-1">
                            <img src="/images/sample.png" width="55px">
                        </div>
                        <div class="col-3" style="padding-top: 14px; text-align: left;">
                            <p>Vna Rica Andrea Tion</p>
                        </div>
                        
                        <div class="col-3" style="padding-top: 14px;">
                            <p>Bassig St., Ugac Sur </p>
                        </div>
                        
                        <div class="col-1" style="padding-top: 14px;">
                            <p>Female</p>
                        </div>
                        
                        <div class="col-2" style="padding-top: 14px;">
                            <p>11/16/2020</p>
                        </div>
                        
                        <div class="col-2" style="padding-top: 14px;">
                            <p>3 years old</p>
                        </div>
                    </div>
                    
                    <div class="row justify-content-center">
                        
                        <?php
                        $connection = mysqli_connect("localhost", "root", "", "CRUDE");
                        
                        $fetch_query = "SELECT * FROM ChildInfo";
                        $fetch_query_run = mysqli_query($connection, $fetch_query);
                        
                        if (mysqli_num_rows($fetch_query_run) > 0) {
                        echo '<div class="accordion" id="childAccordion">';
                        
                        $count = 0; // Counter for unique IDs
                        while ($accordion = mysqli_fetch_array($fetch_query_run)) {
                        $count++;
                        ?>
                        
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading<?php echo $count; ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $count; ?>" aria-expanded="true" aria-controls="collapse<?php echo $count; ?>">
                            <div class="row_child_profile_card">
                                <div class="col-1">
                                    <img src="/images/sample.png" width="55px">
                                </div>
                                <div class="col-3 childName" style="padding-top: 14px; text-align: left;">
                                    <p><?php echo $accordion['ChildID']; ?></p>
                                </div>
                                <div class="col-3 childName" style="padding-top: 14px; text-align: left;">
                                    <p><?php echo $accordion['ChildName']; ?></p>
                                </div>
                                <div class="col-3" style="padding-top: 14px;">
                                    <p><?php echo $accordion['Address']; ?></p>
                                </div>
                                <div class="col-1" style="padding-top: 14px;">
                                    <p><?php echo $accordion['Sex']; ?></p>
                                </div>
                                <div class="col-2" style="padding-top: 14px;">
                                    <p><?php echo $accordion['Birthdate']; ?></p>
                                </div>
                            </div>
                            </button>
                            </h2>
                            <div id="collapse<?php echo $count; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $count; ?>" data-bs-parent="#childAccordion">
                                <div class="accordion-body">
                                    <!-- Additional information can be added here -->
                                    <button type="button" class="btn btn-primary view_data" data-id="<?php echo $accordion['ChildID']; ?>">View Record</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="recordModalLabel">Child Record</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="recordDetails"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php
                            }
                            echo '</div>'; // Close accordion
                            } else {
                            echo "No records found.";
                            }
                            
                            // Close the connection
                            mysqli_close($connection);
                            ?>
                            
                            
                            
                            <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="recordModalLabel">Child Record</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="recordDetails"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                
            </div>
            
            
            <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="recordModalLabel">Child Record</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="recordDetails"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <!-- END -->
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    </body>
    </html>
                                                                                                            
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        $('.view_data').click(function() {
        var child_id = $(this).data('id');
        $.ajax({
        url: 'fetch_child.php',
        method: 'POST',
        data: {child_id: child_id},
        dataType: 'json',
        success: function(data) {
        if (data.status !== "error") {
        var details = `
        <p><strong>Child Name:</strong> ${data.ChildName}</p>
        <p><strong>Address:</strong> ${data.Address}</p>
        <p><strong>Birthdate:</strong> ${data.Birthdate}</p>
        <p><strong>Gender:</strong> ${data.Sex}</p>
        <p><strong>Parent/Guardian Name:</strong> ${data.ParentName}</p>
        <p><strong>Contact Number:</strong> ${data.ParentContactNumber}</p>
        <p><strong>Medical Notes:</strong> ${data.MedicalNotes}</p>
        `;
        $('#recordDetails').html(details);
        $('#recordModal').modal('show');
        } else {
        alert(data.message);
        }
        },
        error: function() {
        alert("An error occurred.");
        }
        });
        });
        });
    </script>