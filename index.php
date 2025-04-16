<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <form name="bookinghotelform" class="booking-form">
        <div class="row g-0">
            <div class="col-md-6 col-lg form-wrap">
                <div class="form-group">
                    <label for="#">Name</label>
                    <div class="form-field">
                        <div class="icon"><span class="far fa-solid fa-user"></span></div>
                        <input type="text" name="Name" class="form-control" id="be-name" placeholder="Enter Name">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg form-wrap">
                <div class="form-group">
                    <label for="#">Phone Number</label>
                    <div class="form-field">
                        <div class="icon"><span class="fas fa-phone-alt"></span></div>
                        <input type="number" name="Phone No" class="form-control" id="be-number" placeholder="Enter Number">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg form-wrap">
                <div class="form-group">
                    <label for="#">Check-In</label>
                    <div class="form-field">
                        <div class="icon"><span class="fa fa-calendar"></span></div>
                        <input type="text" name="Check-IN" class="form-control be-checkin hasDatepicker" id="datepicker" placeholder="Check In" readonly="readonly"><button type="button" class="ui-datepicker-trigger"></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg form-wrap">
                <div class="form-group">
                    <label for="#">Check-Out</label>
                    <div class="form-field">
                        <div class="icon"><span class="fa fa-calendar"></span></div>
                        <input type="text" name="Check-Out" class="form-control be-checkout hasDatepicker" id="datepicker2" placeholder="Check Out" readonly="readonly"><button type="button" class="ui-datepicker-trigger"></button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg form-wrap">
                <div class="form-group">
                    <label for="#">Rooms</label>
                    <div class="form-field">
                        <div class="select-wrap">
                            <!-- <div class="icon"><span class="fa fa-chevron-down"></span></div> -->
                            <select name="Room" id="be-rooms" class="form-control">
                                <option value="">Room</option>
                                <option value="1">1 </option>
                                <option value="2">2 </option>
                                <option value="3">3 </option>
                                <option value="4">4 Rooms</option>
                                <option value="5">5 Rooms</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg form-wrap">
                <div class="form-group">
                    <label for="#">Guests</label>
                    <div class="form-field">
                        <div class="select-wrap">
                            <!-- <div class="icon"><span class="fa fa-chevron-down"></span></div> -->
                            <select name="Guest" id="be-adults" class="form-control">
                                <option value="">Adult</option>
                                <option value="1">1</option>
                                <option value="2">2 </option>
                                <option value="3">3 Adult</option>
                                <option value="4">4 Adult</option>
                                <option value="5">5 Adult</option>
                                <option value="6">6 Adult</option>
                                <option value="7">7 Adult</option>
                                <option value="8">8 Adult</option>
                                <option value="9">9 Adult</option>
                                <option value="10">10 Adult</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg form-wrap">
                <div class="form-group">
                    <label for="#">Children</label>
                    <div class="form-field">
                        <div class="select-wrap">
                            <!-- <div class="icon"><span class="fa fa-chevron-down"></span></div> -->
                            <select name="Children" id="be-childs" class="form-control">
                                <option value="">Children</option>
                                <option value="0">0 </option>
                                <option value="1">1 </option>
                                <option value="2">2 Children</option>
                                <option value="3">3 Children</option>
                                <option value="4">4 Children</option>
                                <option value="5">5 Children</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="Bucket" id="bucket" value="">
            <input type="text" id="c_date" name="Query-date" value="">
            <div class="col-md-6 col-lg text-center"><button type="submit" id="be_btn" class="btn">Book Now </button> </div>

        </div>
    </form>
    <script src="index.js"></script>
</body>

</html>