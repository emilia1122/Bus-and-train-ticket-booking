var findMore = document.querySelectorAll('.show-modal');
var element = document.querySelectorAll('.element');
var modals = document.querySelectorAll('.modal');
var testModal = document.querySelectorAll('.testmodal');

$(document).ready(function(){
  for(let i = 0; i<findMore.length; i++){
    var show_btn=$(findMore[i]);
    //$("#testmodal").modal('show');

    show_btn.click(function(){
    $(testModal[i]).modal('show');
    })

  }

});

$(function() {
        $(element[i]).on('click', function(e) {
            $('body').addClass('modal-open');
            e.preventDefault(); // previne sa nu se mai deschida fereastra de modal
        });
    });
