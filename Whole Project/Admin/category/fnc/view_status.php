<?php
    if($results['status'] == "Pending"){
?>
    <div class="" style="background-color: white; margin-top:20px; display:flex;justify-content:center; border:2px dashed blue">
    <p style="color: blue; font-weight:bold;margin-top:3px;margin-bottom:3px">The Book is Pending</p>
    </div>
<?php
    }elseif($results['status'] == "Approved"){
?>
    <div class="" style="background-color: white; margin-top:20px; display:flex;justify-content:center; border:2px dashed green">
    <p style="color: green; font-weight:bold;margin-top:3px;margin-bottom:3px">The Book is Approved</p>
    </div>
    <?php
    }elseif($results['status'] == "Archive"){
?>
    <div class="" style="background-color: white; margin-top:20px; display:flex;justify-content:center; border:2px dashed red">
    <p style="color: red; font-weight:bold;margin-top:3px;margin-bottom:3px">The Book is Archive</p>
    </div>
<?php
    }else{
?>
    <div class="" style="background-color: white; margin-top:20px; display:flex;justify-content:center; border:2px dashed red">
    <p style="color: red; font-weight:bold;margin-top:3px;margin-bottom:3px">The Book is Rejected</p>
    </div>
    <?php
    }
    ?>
