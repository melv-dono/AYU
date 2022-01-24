$(".deleteReservation").on('click', ()=>{
  const row = document.getElementsByClassName('deleteReservation').parentNode.parentNode.parentNode;
  const id = row.children[0].textContent;
  console.log(id);
  $.ajax({
    url:`index?module=reservation&action=deleteReservation=${id}`,
    method:'post',
    statusCode:{
      200:()=>{
        console.log("deleted");

      }
    }
  });


})
