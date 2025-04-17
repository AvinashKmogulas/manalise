<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <form class="eventform" id="eventform">
        <div class="col2">
            <div class="InputItem">
                <label>Name <span>*</span> </label>
                <input type="text" class="InputFiled" name="Name" id="ename" placeholder="">
            </div>
            <div class="InputItem">
                <label>Phone Number <span>*</span> </label>
                <input type="number" class="InputFiled" name="Phone" id="enumber" placeholder="">
            </div>
        </div>
        <div class="col2">
            <div class="InputItem">
                <label>Email Id </label>
                <input type="email" class="InputFiled" name="Email" id="e_email" placeholder="">
            </div>
            <div class="InputItem">
                <label>Event Type <span>*</span> </label>
                <select name="Event" class="InputFiled" id="Event">
                    <option value="Please Select">Please Select</option>
                    <option value="Board Room">Board Room</option>
                    <option value="Cluster">Cluster</option>
                    <option value="Theatre">Theatre</option>
                    <option value="Banquet">Banquet</option>
                </select>
            </div>
        </div>
        <div class="col2">
            <div class="InputItem">
                <label>No of People <span>*</span></label>
                <input type="number" class="InputFiled" name="People" id="e_people" placeholder="">
            </div>
            <div class="InputItem">
                <label>Event Date <span>*</span> </label>
                <input type="date" class="InputFiled e_date" name="Date" id="banquetPickerDs" placeholder="" min="2025-04-17">
            </div>
        </div>
        <div class="InputItem">
            <label>Message </label>
            <textarea class="InputFiled" name="Message" id="emessage" placeholder="" rows="3"></textarea>
            <input type="hidden" class="con_date" name="Query Date">
            <input type="hidden" class="source" name="Source">
        </div>
        <div class="InputItem text-center"><button type="submit" class="btn" id="submit">Submit</button> </div>
    </form>
    <script>
        $("document").ready(function() {
            let scriptUrl =
                "https://script.google.com/macros/s/AKfycbxndQqts44fnZvpVC75bTUl_Lg4XpTyi8EZS_NQsH1FL-gghVfjz_Cq8jJKIYhCj2BqqQ/exec";
            let eventForm = document.forms["eventform"];
            // event form submission
            eventForm.addEventListener("submit", (e) => {
                e.preventDefault();
                let name = $("#ename").val();
                let phone = $("#enumber").val();
                let email = $("#e_email").val();
                let event_type = $("#Event").val();
                let people = $("#e_people").val();
                let event_date = $("#banquetPickerDs").val();
                let message = $("#emessage").val();

                const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                let RegEx = /^[a-zA-Z][a-zA-Z ]+$/;
                let RegPhNo = /^[0-9,()-]{1,50}$/;
                if (
                    name == "" ||
                    phone == "" ||
                    email == "" ||
                    event_type == "" ||
                    people == "" ||
                    // event_date == "" ||
                    message == ""
                ) {
                    alert("Please fill all required fields");
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
                if (!emailRegex.test(email)) {
                    alert("Invalid email address");
                }

                var fullDate = new Date();
                twoDigitMonth =
                    fullDate.getMonth().length + 1 === 1 ?
                    fullDate.getMonth() + 1 :
                    "0" + (fullDate.getMonth() + 1);
                var currentDate =
                    fullDate.getDate() + "-" + twoDigitMonth + "-" + fullDate.getFullYear();
                $("#con_date").attr("value", currentDate);
                sendEventMail(name, phone, email, event_type, people, event_date, message);

                fetch(scriptUrl, {
                    method: "POST",
                    body: new FormData(eventForm)
                });
            });

            // Function to send event email
            function sendEventMail(
                name,
                phone,
                email,
                event_type,
                people,
                event_date,
                message
            ) {
                $.ajax({
                    url: "mailSend.php",
                    method: "POST",
                    dataType: "json",
                    data: {
                        name: name,
                        phone: phone,
                        email: email,
                        event_type: event_type,
                        people: people,
                        event_date: event_date,
                        message: message,
                        flag: "eventForm",
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            alert("Form submitted successfully!");
                            $("#bookinghotelform")[0].reset();
                        } else {
                            alert("Mailer Error: " + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        alert(error);
                    },
                });
            }
        });
    </script>
</body>

</html>