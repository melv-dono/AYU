$("#saveChange").on("click",()=>{
  $.ajax({
    url:"index.php?module=admin&action=addSalle",
    method:"POST",
    dataType: "json",
    data:JSON.stringify(getData()),
    statusCode:{
      201:()=>{
        console.log("ok");
        window.location.reload();
      }
    }
  })
});


function getData(){
  return {
    numeroSalle:document.getElementById("numeroSalle").value,
    capacite:document.getElementById("capacite").value,
    nbPostes:document.getElementById("nbPostes").value
  }
}
