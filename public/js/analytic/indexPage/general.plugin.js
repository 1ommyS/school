for (let i = 0; i < document.querySelector("#weeks").value * 1 + 1; i++) {
  let amount = {
    week: 0,
    homework: 0,
    whomework: 0,
    video: 0,
    revenue: 0,
    all: 0,
    wages: 0,
    prem: 0,
    finals: 0,
    Pribil: 0
  }
  document.querySelectorAll(`#accHM${i + 1}`).forEach((num) => amount.homework += parseInt(num
    .textContent));
  document.querySelectorAll(`#accWHM${i + 1}`).forEach((num) => amount.whomework += parseInt(num
    .textContent));
  document.querySelectorAll(`#accVD${i + 1}`).forEach((num) => amount.video += parseInt(num
    .textContent));
  document.querySelectorAll(`#accRV${i + 1}`).forEach((num) => amount.revenue += parseInt(num
    .textContent));
  document.querySelectorAll(`#accAL${i + 1}`).forEach((num) => amount.all += parseInt(num
    .textContent));
  document.querySelectorAll(`#accWG${i + 1}`).forEach((num) => amount.wages += parseInt(num
    .textContent));
  document.querySelectorAll(`#accPrem${i + 1}`).forEach((num) => amount.prem += parseInt(num
    .textContent));
  document.querySelectorAll(`#accFinals${i + 1}`).forEach((num) => amount.finals += parseInt(num
    .textContent));
  document.querySelectorAll(`#accPribil${i + 1}`).forEach((num) => amount.Pribil += parseInt(num
    .textContent));
  document.querySelector(`#allHM${i + 1}`).textContent = amount.homework ? amount.homework : 0;
  document.querySelector(`#allWHM${i + 1}`).textContent = amount.whomework ? amount.whomework : 0;
  document.querySelector(`#allVD${i + 1}`).textContent = amount.video ? amount.video : 0;
  document.querySelector(`#allRV${i + 1}`).textContent = amount.revenue ? amount.revenue : 0;
  document.querySelector(`#allAL${i + 1}`).textContent = amount.all ? amount.all : 0;
  document.querySelector(`#allWG${i + 1}`).textContent = amount.wages ? amount.wages : 0;
  document.querySelector(`#allPrem${i + 1}`).textContent = amount.prem ? amount.prem : 0;
  document.querySelector(`#allFinals${i + 1}`).textContent = amount.finals ? amount.finals : 0;
  document.querySelector(`#allPribil${i + 1}`).textContent = amount.Pribil ? amount.Pribil : 0;
}