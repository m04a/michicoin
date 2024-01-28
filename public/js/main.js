window.onload = (function () {

  //swiper

  let swiper = new Swiper(".mySwiper", {
    spaceBetween: 10,
    effect: "coverflow",
    navigation: {
      nextEl: ".comics__btn-next",
      prevEl: ".comics__btn-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
  });



  const widgetData = {
    price: '',
  }

  const priceHeader = document.querySelector('#priceHeader');


  const isGrown = (str) => {
    return str[1] !== '-';
  }


  var xmlhttp = new XMLHttpRequest();
  var url = "https://3rdparty-apis.coinmarketcap.com/v1/cryptocurrency/widget?id=9436";
  var priceData;
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          priceData = JSON.parse(this.responseText);
          console.log(priceData['data'][9436]['quote']['USD']['price'])
      }
  };
  xmlhttp.open("GET", url, true);
  xmlhttp.send();

  setTimeout(() => {

    priceHeader.textContent = parseFloat(priceData['data'][9436]['quote']['USD']['price']).toFixed(9);

  }, 500)

})()
