<!DOCTYPE html>
<html>
<title>Information</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="refresh" content="600">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {
    display: none;
}
</style>

<body>


    <div class="w3-content" style="max-width:100%">
        <div class="mySlides w3-container w3-xlarge w3-white w3-card-12">
            <header class="w3-container w3-teal">
                <h2>Employye Active</h2>
            </header>
            <?php include "aboutuser_employee_active.php"; ?>
            <footer class="w3-container w3-teal">
                <br>
            </footer>
        </div>

        <div class="mySlides w3-container w3-xlarge w3-white w3-card-12">
            <header class="w3-container w3-teal">
                <h2>New Employye</h2>
            </header>
            <?php include "aboutuser_employee_new.php"; ?>
            <footer class="w3-container w3-teal">
                <br>
            </footer>
        </div>

        <div class="mySlides w3-container w3-xlarge w3-white w3-card-12">
            <header class="w3-container w3-teal">
                <h2>Employye InActive</h2>
            </header>
            <?php include "aboutuser_employee_inactive.php"; ?>
            <footer class="w3-container w3-teal">
                <br>
            </footer>
        </div>

        <div class="mySlides w3-container w3-xlarge w3-white w3-card-12">
            <header class="w3-container w3-teal">
                <h2>Attendance Late</h2>
            </header>
            <?php include "aboutuser_attendance_late.php"; ?>
            <footer class="w3-container w3-teal">
                <br>
            </footer>
        </div>

        <div class="mySlides w3-container w3-xlarge w3-white w3-card-12">
            <header class="w3-container w3-teal">
                <h2>Attendance No Info</h2>
            </header>
            <?php include "aboutuser_attendance_no_info.php"; ?>
            <footer class="w3-container w3-teal">
                <br>
            </footer>
        </div>

    </div>

    <script>
    var slideIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > x.length) {
            slideIndex = 1
        }
        x[slideIndex - 1].style.display = "block";
        setTimeout(carousel, 10000);
    }
    </script>

</body>

</html>