$("#logout").on("click" , (ev)=>{
  $.ajax({
    url:"index.php?module=Connexion&action=logout",
    method:"POST",
    success: ()=>{
      window.location.href="index.php";
    },
    error:(response)=>{
      console.log(response);
    }
  });
});
