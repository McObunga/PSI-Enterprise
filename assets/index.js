$(document).ready(function() {
    $('.select2').select2();
    $.ajax({
        url: "operations/getClinicLocations.php",
        method: "POST",
        data: { token: csrf_token },
        dataType: "json",
        success: function(result) {
            if (result == '404') {
                var txt = 'No locations found';
                $("#clinic-location").empty();
                $.each(result, function(i) {
                    $('#clinic-location').append($('<option></option>').attr("value", '').text(txt));
                });
            } else {
                $("#clinic-location").empty();
                $.each(result, function(i) {
                    $('#clinic-location').append($('<option></option>').attr({value: result[i].id}).text(result[i].name));
                });
            }
        },
        failure: function() {
            $.toast({
                heading: 'Warning',
                text: 'Something went wrong while loading data.',
                icon: 'warning',
                position: 'bottom-right',
                showHideTransition: 'slide'
            });
        }
    });
    var table = $('#clinics').DataTable({
        "dom": 'Bfrtip',
        "select": true,
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        language: {
            search: '<i class="fa fa-search" aria-hidden="true"></i>',
            searchPlaceholder: ' Search clinic'
        }
    });
    // $.ajax({
    //     data: {data: 'url'},
    //     url: 'operation/devicePixelRatio.php',
    //     success: function(response) {
        
    //     }
          
    // });

    $('.dataTable').on('click', 'tbody tr', function() {
        var data = table.row(this).data().map(function(item, index) {
           var r = {}; r['col'+index]=item; return r;
        });
        $.ajax({
          data: data,
          url: 'operation/devicePixelRatio.php',
          success: function(response) {
              
          }
            
        });
    });

    var start_dateval, end_dateval;
    $('#date-range-btn').daterangepicker({
        maxDate: moment(),
        ranges: {
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Last 3 Months': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "startDate": moment().subtract(29, 'days'),
        "endDate": moment(),
    },
        function (start, end) {
            $('#date_range').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

            [startDate, endDate] = $('#appointments_range').val().split(' - ');
            $(this).find('input[name="start_date"]').val(startDate);
            $(this).find('input[name="end_date"]').val(endDate);

            $start = $('#start_date').val();
            $end = $('#end_date').val();
            start_dateval = moment(start, 'MMMM D, YYYY').format("YYYY-MM-DD");
            end_dateval = moment(end, 'MMMM D, YYYY').format("YYYY-MM-DD");
            fetch_data(start_dateval, end_dateval);
        }
    )
        
    function fetch_data(doctorId, start_dateval = '', end_dateval = '') {
        $.ajax({
            url: "operation/getFilteredDashboardUpcomingAppointments.php",
            method: "POST",
            data: { doctorId: doctorId, start_dateval: start_dateval, end_dateval: end_dateval },
            dataType: "json",
            success: function(result) {
                document.getElementById("upcoming_appointments").value = ""
                document.getElementById("upcoming_in_person").value = ""
                document.getElementById("upcoming_telemedicine").value = ""
                document.getElementById("incomplete_appointments").value = ""
                document.getElementById("incomplete_in_person").value = ""
                document.getElementById("incomplete_telemedicine").value = ""
                
                document.getElementById("my_finances_stats").value = ""
                document.getElementById("total_in_person").value = ""
                document.getElementById("total_telemedicine").value = ""
                document.getElementById("my_e_prescriptions").value = ""
                $("#upcoming_appointments").attr('disabled', false);
                $.each(result, function(i) {
                    $('#upcoming_appointments').text(result[i].upcoming_appoitnments);
                    $('#upcoming_in_person').text(result[i].in_person);
                    $('#upcoming_telemedicine').text(result[i].telemedicine);
                    
                    $('#incomplete_appointments').text(0);
                    $('#incomplete_in_person').text(0);
                    $('#incomplete_telemedicine').text(0);
                    
                    $('#my_finances_stats').text(0);
                    $('#total_in_person').text(0);
                    $('#total_telemedicine').text(0);
                    $('#my_e_prescriptions').text(0);
                });
            },
            failure: function() {
                $.toast({
                    heading: 'Error',
                    text: 'Something went wrong.',
                    icon: 'error',
                    position: 'bottom-right',
                    showHideTransition: 'slide'
                })
            }
        });
        
        $.ajax({
            url: "operation/getFilteredTotalAppointments.php",
            method: "POST",
            data: { doctorId: doctorId, start_dateval: start_dateval, end_dateval: end_dateval },
            dataType: "json",
            success: function(result) {
                document.getElementById("total_appointments").value = ""
                document.getElementById("total_in_person_appointments").value = ""
                document.getElementById("total_telemedicine_appointments").value = ""
                
                $("#total_appointments").attr('disabled', false);
                $.each(result, function(i) {
                    $('#total_appointments').text(result[i].total_appointments);
                    $('#total_in_person_appointments').text(result[i].total_in_person);
                    $('#total_telemedicine_appointments').text(result[i].total_telemedicine);
                });
            },
            failure: function() {
                $.toast({
                    heading: 'Error',
                    text: 'Something went wrong.',
                    icon: 'error',
                    position: 'bottom-right',
                    showHideTransition: 'slide'
                })
            }
        });

    }
    
});