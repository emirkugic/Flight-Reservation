var PassengerService = {
    init: function () {
        var token = localStorage.getItem('user_token');
        if (!token) {
            // store the current URL before being redirected
            localStorage.setItem('redirectUrl', window.location.href);
            window.location.href = 'login.html';
        }

        $.validator.addMethod("is18orOlder", function(value, element) {
            var birthDate = new Date(value);
            var currentDate = new Date();
            var diff = currentDate.getFullYear() - birthDate.getFullYear();
            if (diff < 18) return false;
            return true;
        }, "You must be at least 18 years old.");

        $.validator.addMethod("alphabetic", function(value, element) {
            return this.optional(element) || /^[a-z]+$/i.test(value);
        }, "Please enter only alphabetic characters.");

        $.validator.addMethod("passport", function(value, element) {
            // checking for 6 to 9 characters
            return this.optional(element) || /^[A-Za-z0-9]{6,9}$/i.test(value);
        }, "Please enter a valid passport number.");

        $('#passenger-form').validate({
            rules: {
                'passenger-name': {
                    required: true,
                    alphabetic: true
                },
                'passenger-surname': {
                    required: true,
                    alphabetic: true
                },
                'date-of-birth': {
                    required: true,
                    date: true,
                    is18orOlder: true
                },
                'title': {
                    required: true
                },
                'passport': {
                    required: true,
                    passport: true
                },
                'id-num': {
                    required: true,
                }
            },
            messages: {
                'passenger-name': 'Please enter your name',
                'passenger-surname': 'Please enter your surname',
                'date-of-birth': 'Please enter a valid date',
                'title': 'Please select a title',
                'passport': 'Please enter your passport number',
                'id-num': 'Please enter your ID number'
            },
            submitHandler: function(form) {
                var passengerInfo = {
                    name: $('#passenger-name').val(),
                    surname: $('#passenger-surname').val(),
                    dob: $('#date-of-birth').val(),
                    title: $('#title').val(),
                    passport: $('#passport').val(),
                    idNum: $('#id-num').val()
                };
                localStorage.setItem('passengerInfo', JSON.stringify(passengerInfo));
                form.submit();
                window.location.href = '#purchase';
            }
        });
    },
};

