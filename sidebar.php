<?php
function getRoleLinks() {
    $dashboard = "<li class='nav-item sb-dashboard'>
                    <a href='dashboard' class='nav-link nav-toggle' style='padding: 8px 15px;'>
                        <i class='material-icons' style='color: white;'>dashboard</i>
                        <span class='title' style='color: white;font-weight: 500;'>Enterprise Overview</span>
                        <span class='selected'></span>
                    </a>
                </li>";
   
    $appointments = "<li class='nav-item sb-appointments'>
                        <a href='appointments' class='nav-link nav-toggle' style='padding: 8px 15px;'>
                            <i class='material-icons' style='color: white;'>event_note</i>
                            <span class='title' style='color: white;font-weight: 500;'>Appointments</span>
                        </a>
                    </li>"; 

    $income = "<li class='nav-item sb-income'>
                        <a href='income' class='nav-link nav-toggle' style='padding: 8px 15px;'>
                            <i class='material-icons' style='color: white;'>account_balance</i>
                            <span class='title' style='color: white;font-weight: 500;'>Income</span>
                        </a>
                    </li>";

    return ("
        $dashboard
        $appointments
        $income
    ");
}
?>

<div class="sidebar-container">
    <div class="sidemenu-container navbar-collapse collapse fixed-menu" style="background: #002147; height: -webkit-fill-available;">
        <div id="remove-scroll" class="left-sidemenu">
            <ul class="sidemenu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px; height:690px;">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <li class="sidebar-user-panel">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/undraw_profile.svg" class="img-circle user-img-circle" alt="John Doe" />
                        </div>
                        <div class="pull-left info">
                            <p style="color: white;">John Doe</p>
                        </div>
                    </div>
                </li>
                <?php echo getRoleLinks() ?>
            </ul>
        </div>
    </div>
</div>