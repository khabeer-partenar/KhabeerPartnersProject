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
          /*  Swal.fire({
                title: 'من فضلك انتظر',
                allowOutsideClick: false
            });
            Swal.showLoading();*/

            $("#job_role_id").prop('disabled', false);
            var form = $(this);
            var formData = new FormData($(this)[0]);
           // console.log(formData);
            var url = form.attr("action");

            $("#overlay").fadeIn(300);


            $.ajax({
                type: form.attr('method'),
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#addDelegateModal').modal('hide');
                    $('.has-error').removeClass('has-error');
                    $('.span-error').text('');

                   // console.log(formData);
                    $("#job_role_id").prop('disabled', true);
                    getDelegates();
                    //swal.close();

                    //location.reload();
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
            //return false;
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

                        $('#table_delegates').html('');
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

         function getDelegates() {
             var committee_id = $('#committee_id').val();
             var url ='{{route('committees.get.delegate',':id')}}';
             url = url.replace(':id', committee_id);
             $.ajax({
                 type: 'GET',
                 url: url,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function (result) {
                     console.log(result);
                     if (result.length > 0) {
                         //console.log(result);
                         $('#delegatesTable').html('');
                         var html = "";
                         for (var i = 0; i < result.length; i++) {
                             html += '<tr>';
                             html += '<td>' + (i + 1) + '</td>';

                             var department = result[i]['department']['name'];
                             if (result[i]['department']['referenceDepartment'])
                             {
                                 department +='/' + result[i]['department']['referenceDepartment']['name'];
                             }
                             html +='<td>' + department + '</td>';
                             html +='<td>' + result[i]['name'] + '</td>';
                             html +='<td>' + result[i]['national_id'] + '</td>';
                             html +='<td>' + result[i]['phone_number'] + '</td>';
                             html +='<td>' + result[i]['email'] + '</td>';
                             html +='<td>' + result[i]['email'] + '</td>';


                             dataHref="{{ route('delegate.remove.from.committee',['delegate_id'=>':delegate_id','committee_id'=>':committee_id','department_id'=>Crypt::encrypt(':delegate_department_id')]) }}"
                             dataHref = dataHref.replace(':delegate_id', result[i]['id']);
                             dataHref = dataHref.replace(':committee_id','{{$committee->id}}');
                             dataHref = dataHref.replace(':delegate_department_id',result[i]['department']['id']);

                             html += '<td> <a data-href="'+ dataHref +'"  class="btn btn-sm btn-danger delete-row-delegate">' +
                                 '<i class="fa fa-trash"></i> {{ __('users::coordinators.delete') }}' +
                                 '</a>' +
                                 '</td>';
                             html += '</tr>';


                         }
                         //$('#department_id').val(result[1]['department_id']);
                         $('#delegatesTable').html(html);
                         $("#overlay").fadeOut(300);
                         //$("#nominationsListModal").modal();
                     }
                     else {
                         /*Swal.fire({
                             title: 'لا يوجد مندوبين لهذه الجهة من فضلك قم باضافة مندوب جديد',
                             type: 'error',
                             confirmButtonText: 'موافق'
                         })*/
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


         }

    });


</script>

