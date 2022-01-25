$(".deleteReservation").on('click', (ev)=>{
  console.log(ev)
  const row = ev.target.parentNode.parentNode.parentNode;
  const id = row.children[0].textContent;
  console.log(id);
  $.ajax({
    url:`index?module=reservation&action=deleteReservation&idRes=${id}`,
    method:'post',
    statusCode:{
      200:()=>{
        window.location.reload();

      }
    }
  });


})
