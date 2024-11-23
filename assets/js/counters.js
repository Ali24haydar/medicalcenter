var count = document.querySelectorAll('.count');
//console.log(count);
var inc = [];

var countsID = document.getElementById("countsID");
window.onscroll = function (){
  var topElem = countsID?.offsetTop;
  var btmElem = countsID?.offsetTop + countsID?.clientHeight;
  var topScreen = window.pageYOffset;
  var btmScreen = window.pageYOffset + window.innerHeight;
  if(btmScreen > topElem && topScreen < btmElem){
    counterFunc();
  }
}
function counterFunc(){
  for(let i=0; i<count.length; i++){
    inc.push(0);
    let interval = setInterval(() =>{
      if(inc[i] <= count[i].getAttribute("data-purecounter-end")){
        inc[i]++;
        count[i].innerHTML = inc[i];
      }
      else{
        clearInterval(interval);
      }
    }, 1500);
  }
}


