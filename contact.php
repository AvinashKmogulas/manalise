<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offer</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <form id="contactForm" class="contactForm">
        <label for="name">Name:</label><br />
        <input type="text" id="name" name="Name" placeholder="Enter Name"><br />
        <label for="phone">Phone:</label><br />
        <input type="tel" id="phone" name="Phone" placeholder="Enter Phone Number"><br />
        <label for="email">Email:</label><br />
        <input type="email" id="email" name="Email" placeholder="Enter Email"><br />
        <label for="subject">Subject:</label><br />
        <input type="text" id="subject" name="Subject" placeholder="Enter Subject"><br />
        <label for="message">Message:</label><br />
        <textarea id="message" name="Message" placeholder="Enter Message"></textarea><br />
        <input type="text" id="q_date" name="Query Date" value="" placeholder="Enter Query Date"><br />
        <input type="submit" value="Send Mesage" id="contact_submit_btn" />
    </form>
    <script>
        $(document).ready(function() {
            let scriptUrl = "https://script.google.com/macros/s/AKfycby4Ef2XzH1XVQYSMMwA5MpIMCJrhXa5Zx1xl028WwGqV2B_yOgI-dCPzp1VdxKNE06vUA/exec";
            let contactForm = document.forms["contactForm"];
            contactForm.addEventListener("submit", (e) => {
                e.preventDefault();
                let name = $("#name").val();
                let phone = $("#phone").val();
                let email = $("#email").val();
                let subject = $("#subject").val();
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
                if (subject == "") {
                    alert("Please enter subject");
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
                $("#contact_submit_btn").prop("disabled", true);
                $("#contact_submit_btn").prop("value", "Sending...");
                sendContactMail(name, phone, email, subject, message);

                fetch(scriptUrl, {
                    method: "POST",
                    body: new FormData(contactForm)
                }).then(response => {
                    console.log("Google script success");
                }).catch(error => {
                    console.error("Error from Google script:", error);
                });

                return false;
            });

            function sendContactMail(name, phone, email, subject, message) {
                $.ajax({
                    type: "POST",
                    url: 'emailSend.php',
                    dataType: "json",
                    data: {
                        name: name,
                        phone: phone,
                        email: email,
                        subject: subject,
                        message: message,
                        flag: 'contactForm'
                    },
                    success: function(response) {
                        $("#contact_submit_btn").prop("disabled", false);
                        $("#contact_submit_btn").prop("value", "Send Message");
                        alert("Contact submitted successfully");
                        contactForm.reset();
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