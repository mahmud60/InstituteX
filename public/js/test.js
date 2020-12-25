var timeCounter = 0;

$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

var headers = {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
};


setTimeout(function() {
    var x = document.getElementsByClassName("zm-btn join-audio-container__btn zm-btn--default zm-btn__outline--blue zm-btn-icon");
    var count = 0;
    x[0].addEventListener("click", function(e) {
        count++;
        if(count%2==1) //muted
        {
            console.log("muted");
            clearInterval(f);
            var data = { time: timeCounter };
            $.ajax({
              type: "POST",
              url: 'participation/audio',
              data: data,
              success: function() {
                console.log(data);
              }
            })
        }
        else //unmuted
        {
          console.log("unmuted");
          startTimer();
        }
    });
}, 10000);

function startTimer(){
  f = setInterval(function() {
    timeCounter++;
    console.log(timeCounter);
  }, 1000);
}