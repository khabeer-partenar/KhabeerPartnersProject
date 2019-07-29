<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.select2').select2({
            dropdownParent: $("#addDelegateModal"),
            width: '100%'
        });

        //$('.select2').select2();
        // Change Reference input
        $(document).on('change', '.change-reference', function () {
            let selectedOption = $(this).find(":selected")[0],
                id = $(selectedOption).attr('data-ref-id'),
                name = $(selectedOption).attr('data-ref-name'),
                is_reference = $(selectedOption).attr('data-is-ref'),
                selectJobElm = $('#job_role_id')[0];
            for (let index = 0; index < selectJobElm.length; index++) {
                if ($(selectJobElm.options[index]).attr('data-main') == is_reference) {
                    $('#job_role_id').val($(selectJobElm.options[index]).val());
                    $('#job_role_id').select2();
                }
            }

            $('#department_reference').val(id);
            $('#department_reference_val').val(name);
        });
        // On Submit
        $("#co-form").submit(function () {
            $('#job_role_id').prop('disabled', false);
            setTimeout(function () {
                $(this).submit();
            }, 1000);
        });

        $(document).on('submit', 'form#delegate-form-create', function (event) {
            event.preventDefault();
            $("#job_role_id").prop('disabled', false);
            var form = $(this);
            var data = new FormData($(this)[0]);
            console.log(data);
            var url = form.attr("action");

            $.ajax({
                type: form.attr('method'),
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('.has-error').removeClass('has-error');
                    $('.span-error').text('');

                    //console.log(data);
                    $("#job_role_id").prop('disabled', true);

                    $('#addDelegateModal').modal('hide');
                    location.reload();
                },
                error: function (request) {
                    $('.has-error').removeClass('has-error');
                    $('.span-error').text('');
                    let errors = request.responseJSON.errors;
                    let keys = Object.keys(errors);
//console.log(errors[0]);
                    for (index = 0; index < keys.length; ++index) {
                        $('#div_' + keys[index]).addClass('has-error');
                        $('#span_' + keys[index]).text(errors[keys[index]]);
                        console.log(keys[index]);
                        console.log(errors[keys[index]]);
                    }
                    $("#job_role_id").prop('disabled', true);
                    //console.log(errors[]);
                    //let keys = Object.keys(errors);
                    //alert("Error: " + errohrown);
                }
            });
            return false;
        });
        $(document).on('click', '.nominateBtn', function () {
            var department_id = this.value;
            console.log("id : " + department_id);
            var url = '{{url('/users/delegates/DepartmentDelegatesNotInCommittee')}}' + '/' + department_id;

            console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    if (result[0].length > 0) {
                        console.log(result);

                        var html = "";
                        for (var i = 0; i < result[0].length; i++) {
                            html += '<tr>';
                            html += '<td>' + (i + 1) + '</td>';

                            var department = result[0][i]['department']['name'];
                            if (result[0][i]['department']['referenceDepartment'])
                            {
                                department +='/' + result[i]['department']['referenceDepartment']['name'];
                            }
                            html +='<td>' + department + '</td>';
                            html +='<td>' + result[0][i]['name'] + '</td>';
                            html +='<td>' + result[0][i]['job_title'] + '</td>';
                            html +='<td>' + result[0][i]['national_id'] + '</td>';
                            html +='<td>' + result[0][i]['phone_number'] + '</td>';
                            html +='<td>' + result[0][i]['email'] + '</td>';
                            html +='<td>' + result[0][i]['specialty'] + '</td>';
                            html +='<td><input type="checkbox" name="delegates_ids[]" value="' + result[0][i]['id'] +'"/></td>';
                            html += '</tr>';


                        }
                        $('#department_id').val(result[1]['department_id']);
                        $('#table_delegates').html(html);
                        $("#nominationsListModal").modal();
                    }
                    else {
                        Swal.fire({
                            title: 'لا يوجد مندوبين لهذه الجهة من فضلك قم باضافة مندوب جديد',
                            type: 'error',
                            confirmButtonText: 'موافق'
                        })
                    }
                },
                error: function (data) {
                    var errors = data.responseJSON;
                    console.log(data);
                    // let keys = Object.keys(errors);
                    //console.log(errors);
                    /*

                        /!*for (index = 0; index < keys.length; ++index) {

                        console.log(keys[index]);
                        console.log(errors[keys[index]]);*/
                }


            });

        });
        /* function getDelegates(department) {
             var data = department.value;
             console.log("id : " + data);
             var url = 'users/delegates/DepartmentDelegatesNotInCommittee';

             console.log(url);
             $.ajax({
                 type: 'GET',
                 url: '/users/delegates/DepartmentDelegatesNotInCommittee',
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function (data) {
                     console.log(data);
                 },
                 error: function (request) {
                     /!*  let errors = request.responseJSON.errors;
                       let keys = Object.keys(errors);
                       console.log(errors);*!/
                     /!*for (index = 0; index < keys.length; ++index) {

                         console.log(keys[index]);
                         console.log(errors[keys[index]]);
                     }*!/

                 }
             });

         }*/

    });


</script>

