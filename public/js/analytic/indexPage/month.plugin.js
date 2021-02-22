let i = document.querySelector("#weeks").value * 1;
let amount = {
  week: 0,
  homework: 0,
  whomework: 0,
  video: 0,
  revenue: 0,
  all: 0,
  wages: 0,
  prem: 0,
  fin: 0,
  prib: 0
}
document.querySelectorAll(`#hw${i + 1}`).forEach((num) => amount.homework +=parseInt(num.textContent));
document.querySelectorAll(`#whw${i + 1}`).forEach((num) => amount.whomework +=parseInt(num.textContent));
document.querySelectorAll(`#vd${i + 1}`).forEach((num) => amount.video += parseInt(num.textContent));
document.querySelectorAll(`#rv${i + 1}`).forEach((num) => amount.revenue +=parseInt(num.textContent));
document.querySelectorAll(`#al${i + 1}`).forEach((num) => amount.all += parseInt(num.textContent));
document.querySelectorAll(`#wg${i + 1}`).forEach((num) => amount.wages += parseInt(num.textContent));
document.querySelectorAll(`#prem${i + 1}`).forEach((num) => amount.prem += parseInt(num.textContent));
document.querySelectorAll(`#fin${i + 1}`).forEach((num) => amount.fin += parseInt(num.textContent));
document.querySelectorAll(`#prib${i + 1}`).forEach((num) => amount.prib += parseInt(num.textContent));
document.querySelector(`#HW${i + 1}`).textContent = amount.homework ? amount.homework : 0;
document.querySelector(`#WHW${i + 1}`).textContent = amount.whomework ? amount.whomework : 0;
document.querySelector(`#VD${i + 1}`).textContent = amount.video ? amount.video : 0;
document.querySelector(`#RV${i + 1}`).textContent = amount.revenue ? amount.revenue : 0;
document.querySelector(`#AL${i + 1}`).textContent = amount.all ? amount.all : 0;
document.querySelector(`#WG${i + 1}`).textContent = amount.wages ? amount.wages : 0;
document.querySelector(`#PREM${i + 1}`).textContent = amount.prem ? amount.prem : 0;
document.querySelector(`#FIN${i + 1}`).textContent = amount.fin ? amount.fin : 0;
document.querySelector(`#PRIB${i + 1}`).textContent = amount.prib ? amount.prib : 0;