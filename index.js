$("document").ready(function () {
  let scriptUrl =
    "https://script.google.com/macros/s/AKfycbxndQqts44fnZvpVC75bTUl_Lg4XpTyi8EZS_NQsH1FL-gghVfjz_Cq8jJKIYhCj2BqqQ/exec";
  var form = document.forms["bookinghotelform"];

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    let name = $("#be-name").val();
    let phone = $("#be-number").val();
    let checkin = $("#datepicker").val();
    let checkout = $("#datepicker2").val();
    let rooms = $("#be-rooms").val();
    let adults = $("#be-adults").val();
    let children = $("#be-childs").val();

    let RegEx = /^[a-zA-Z][a-zA-Z ]+$/;
    let RegPhNo = /^[0-9,()-]{1,50}$/;

    if (name == "") {
      alert("Please enter your Name");
      return;
    }
    if (checkin == "") {
      alert("Please select check-in date");
      return;
    }
    if (checkout == "") {
      alert("Please select check-out date");
      return;
    }
    if (phone == "") {
      alert("Please enter your Phone Number");
      return;
    }
    if (rooms == "") {
      alert("Please enter the number of rooms");
      return;
    }
    if (adults == "") {
      alert("Please enter the number of adults");
      return;
    }
    if (children == "") {
      alert("Please enter the number of children");
      return;
    }

    if (!RegEx.test(name)) {
      alert("Invalid Name");
      return;
    }
    if (!RegPhNo.test(phone)) {
      alert("Invalid Phone Number");
      return;
    }
    var fullDate = new Date();
    twoDigitMonth =
      fullDate.getMonth().length + 1 === 1
        ? fullDate.getMonth() + 1
        : "0" + (fullDate.getMonth() + 1);
    var currentDate =
      fullDate.getDate() + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
    $("#c_date").attr("value", currentDate);
    sendBookingMail(name, phone, checkin, checkout, rooms, adults, children);

    fetch(scriptUrl, { method: "POST", body: new FormData(form) });
  });
});

// Function to send bookingengine email
function sendBookingMail(
  name,
  phone,
  checkin,
  checkout,
  rooms,
  adults,
  children
) {
  // Email sending logic goes here
  $.ajax({
    url: "mailSend.php",
    method: "POST",
    dataType: "json",
    data: {
      name: name,
      phone: phone,
      checkin: checkin,
      checkout: checkout,
      rooms: rooms,
      adults: adults,
      children: children,
      flag: "bookingEngine",
    },
    success: function (response) {
      if (response.status === "success") {
        alert("Form submitted successfully!");
        window.location.href = "https://be.aiosell.com/book/d6ba78d8bd";
      } else {
        alert("Mailer Error: " + response.message);
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", error);
      alert(error);
    },
  });
}
