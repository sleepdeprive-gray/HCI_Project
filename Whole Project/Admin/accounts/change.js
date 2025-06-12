if(!cha){

    function ChangePASS(){
        document.getElementById("popUP").style.display = "none";
        document.getElementById("popUP2").style.display = "flex";


    }
    document.getElementById("newpass").style.display = "none";
    document.getElementById("confirmpass").style.display = "none";
    document.getElementById("newpassp").style.display = "none";
    document.getElementById("confirmpassp").style.display = "none";
    document.getElementById("changePASS").style.display = "none";
    

    const currentPass = document.getElementById("currentPass").value;
    function Verifies(){
        const oldpass = document.getElementById("oldpass").value;


        if(oldpass == ""){
            alert("Please Enter your Current Password");
        }else{
            const user_type = document.getElementById("user_types").value;
            const currentPass = document.getElementById("currentPass").value;

           if(user_type != "Admin"){
                const user_id = document.getElementById("user_IDS").value;
             window.location.href = "verifyHash.php?o="+oldpass+"&c="+currentPass+"&id="+user_id+"&at="+user_type+"&p="+currentPass;
           }else{
            if(currentPass != oldpass){
                alert("Incorrect current password");
            }else{
                document.getElementById("newpass").style.display = "flex";
                document.getElementById("confirmpass").style.display = "flex";
                document.getElementById("newpassp").style.display = "flex";
                document.getElementById("confirmpassp").style.display = "flex";
                document.getElementById("oldpass").style.display = "none";
                document.getElementById("oldpassp").style.display = "none";
                document.getElementById("verify").style.display = "none";
                document.getElementById("changePASS").style.display = "flex";


            }
           }


            
            
            
        }
 
      
       
        
    }

    function Changes(){
    const newpass = document.getElementById("newpass").value;
    const confirmpass = document.getElementById("confirmpass").value;

    if (newpass == "" || confirmpass == "") {
        alert("Please Enter all inputs");
    }else{
        if (newpass != confirmpass) {
            alert("Passwords did not Match!");
        }else{
            let userResponse = confirm('Are tou sure you want to change your Password?');

            // Check the user's response
            if (userResponse) {
                const user_id = document.getElementById("user_IDS").value;
                const user_type = document.getElementById("user_types").value;

                window.location.href = "changepass.php?id="+user_id+"&user="+user_type+"&n="+newpass+"&user="+user_type;
            } else {
                console.log('User clicked Cancel!');
            }
           
        }
    }
    }

    function cancels(){
         document.getElementById("popUP").style.display = "flex";
        document.getElementById("popUP2").style.display = "none";
    }
}
