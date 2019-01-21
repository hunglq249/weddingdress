var modal = document.getElementById('myModal');
var modalImg = document.getElementById("img01");
$('img').click(function (){
    modal.style.display = "block";
    modalImg.src = this.src;
})

// Get the <span> element that closes the modal
var close = document.getElementsByClassName("modal")[0];

// When the user clicks on <span> (x), close the modal
close.onclick = function() { 
  modal.style.display = "none";
}
