document
.getElementById("loginForm")
.addEventListener("submit", function(e){

    e.preventDefault();

    fetch("../php/Login.php",{
        method:"POST",
        body:new FormData(this)
    })
    .then(res=>res.json())
    .then(data=>{

       if(data.status==="success"){

    Swal.fire({
        icon: "success",
        title: "Login Successful",
        text: "Welcome " + data.role,
        confirmButtonColor: "#4f46e5"
    }).then(() => {

        if(data.role==="Admin"){
            window.location.href="admin-dashboard.html";
        }
        else if(data.role==="Manager"){
            window.location.href="manager-dashboard.html";
        }
        else{
            window.location.href="employee-dashboard.html";
        }

    });

}
        else{
            Swal.fire(
    "Login Failed",
    data.message,
    "error"
);
        }

    });

});