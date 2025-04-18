<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <form id="offerForm" class="offerForm">
        <label for="name">Name:</label><br />
        <input type="text" id="name" name="Name" placeholder="Enter Name"><br />
        <label for="phone">Phone:</label><br />
        <input type="tel" id="phone" name="Phone" placeholder="Enter Phone Number"><br />
        <label for="email">Email:</label><br />
        <input type="email" id="email" name="Email" placeholder="Enter Email"><br />
        <label for="offer">Offer:</label><br />
        <select id="offer" name="Offer">
            <option value="">Select Offer</option>
            <option value="10% off">10% Off</option>
            <option value="20% off">20% Off</option>
            <option value="30% off">30% Off</option>
            <option value="40% off">40% Off</option>
            <option value="50% off">50% Off</option>
            <option value="60% off">60% Off</option>
            <option value="70% off">70% Off</option>
            <option value="80% off">80% Off</option>
            <option value="90% off">90% Off</option>
            <option value="100% off">100% Off</option>
        </select><br />
        <label for="message">Message:</label><br />
        <textarea id="message" name="Message" placeholder="Enter Message"></textarea><br />
        <input type="text" id="q_date" name="Query Date" value="" placeholder="Enter Query Date"><br />
        <input type="submit" value="Submit" id="offer_submit_btn" />
    </form>
    <script>
        $("document").ready(function() {
            let scriptUrl = "https://script.google.com/macros/s/AKfycbxht9px1e1z4LPFsNmgvLJLO3253-xHZETz1aMO8KzVzF8amvaUGvDGNftAbi31-kVC/exec";
            let offerForm = document.forms["offerForm"];
            offerForm.addEventListener("submit", (e) => {
                e.preventDefault();
                let name = $("#name").val();
                let phone = $("#phone").val();
                let email = $("#email").val();
                let offer = $("#offer").val();
                let message = $("#message").val();

                let nameRex = /^[a-zA-Z ]{2,50}$/;
                let phoneRex = /^[6-9]{1}[0-9]{9}$/;
                let emailRex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

                if (name == "") {
                    alert("Please enter Name");
                    return;
                } else if (!nameRex.test(name)) {
                    alert("Invalid name please enter a valid name");
                    return;
                }
                if (phone == "") {
                    alert("Please enter phone number");
                    return;
                } else if (!phoneRex.test(phone)) {
                    alert("Invalid phone number please enter a valid 10 digit number starting with 6, 7, 8, or 9");
                    return;
                }
                if (email == "") {
                    alert("Please enter email");
                    return;
                } else if (!emailRex.test(email)) {
                    alert("Invalid email please enter a valid email address");
                    return;
                }
                if (offer == "") {
                    alert("Please select offer");
                    return;
                }
                if (message == "") {
                    alert("Please enter message");
                    return;
                }
                var fullDate = new Date();
                twoDigitMonth = fullDate.getMonth().length + 1 === 1 ? fullDate.getMonth() + 1 : "0" + (fullDate.getMonth() + 1);
                var currentDate = fullDate.getDate() + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
                console.log(document.getElementById("q_date"));
                $("#q_date").attr("value", currentDate);

                // Call your AJAX function here to send the form data to your PHP script
                $("#offer_submit_btn").prop("disabled", true);
                document.getElementById("offer_submit_btn").Value = "Submitting...";
                $("#offer_submit_btn").prop("Value", "Submitting...");
                sendOfferMail(name, phone, email, offer, message);

                fetch(scriptUrl, {
                    method: "POST",
                    body: new FormData(offerForm)
                });
            });

            function sendOfferMail(name, phone, email, offer, message) {
                $.ajax({
                    type: "POST",
                    url: 'emailSend.php',
                    dataType: "json",
                    data: {
                        name: name,
                        phone: phone,
                        email: email,
                        offer: offer,
                        message: message,
                        flag: 'offerForm'
                    },
                    success: function(response) {
                        $("#offer_submit_btn").prop("disabled", false);
                        document.getElementById("offer_submit_btn").Value = "Submitting...";
                        alert("Offer submitted successfully");
                        offerForm.reset();
                    },
                    error: function(xhr, status, error) {
                        alert("Error occurred while submitting offer: " + error);
                    }
                });
            }
        });
    </script>
</body>

</html>