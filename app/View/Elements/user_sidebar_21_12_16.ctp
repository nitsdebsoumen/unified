<div class="left_panel_dashbpard">
    <div class="profile_image"><img src="http://uat-mssip.morganstanley.com/assets/images/people/tiles/michael-asmar.jpg" alt="" /></div>
    <h2><?php 
    $UserFName=isset($userdetails['User']['first_name'])?$userdetails['User']['first_name']:'';
    $UserLName=isset($userdetails['User']['last_name'])?$userdetails['User']['last_name']:'';
    $UserFullName=$UserFName.' '.$UserLName;
    echo $UserFullName;
    ?></h2>
    <ul>
        <li><a href="" class="active">Dashboard</a></li>
        <li><a href="">Messages</a></li>
        <li><a href="">My Tasks</a></li>
        <li><a href="">Payments History</a></li>
        <li><a href="">Payment Methods</a></li>
        <li><a href="">Reviews</a></li>
        <li><a href="">Notifications</a></li>
        <li><a href="">Settings</a></li>
    </ul>
</div>