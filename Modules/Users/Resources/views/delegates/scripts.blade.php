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
        $(document).on('click', '.delete-row-delegate', function(){
            let btn = $(this);
            let path = $(this).attr('data-href');

            //console.log(path);
            Swal.fire({
                title: 'هل انت متأكد من عملية الحذف؟',
                text: "من فضلك اكتب سبب الحذف",

                input: 'textarea',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ed6b75',
                cancelButtonColor: '#337ab7',
                confirmButtonText: 'حذف',
                cancelButtonText: 'إلغاء',
                preConfirm: (result) => {
                    if (result) {
                        // alert(result);
                        path += '/' + result;
                        $.ajax({
                            type: 'GET',
                            url: path,
                            success: function(response){
                                $(btn).parent().parent().remove();
                                getNominationDepartments();
                                getDelegates();
                            },

                            error: function (request, status, error) {
                                console.log(error);
                                Swal.fire({
                                    title: 'حدث خطأ',
                                    text: request.responseJSON.msg,
                                    type: 'error',
                                    showCancelButton: false,
                                    confirmButtonColor: '#D3D3D3',
                                    confirmButtonText: 'حسنا',
                                });
                            }
                        });
                    }
                    else {
                        //alert('error');
                        Swal.showValidationMessage(
                            `من فضلك ادخل سبب الحذف`
                        )
                    }
                }

            }).then((result) => {
                //console.log(result.value);

            })
        });
        $(document).on('submit', 'form#delegate-form', function (event) {
            event.preventDefault();

            var form = $(this);
            var formData = new FormData($(this)[0]);
            // console.log(formData);
            var url = form.attr("action");
            $.ajax({
                type: form.attr('method'),
                url: url,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#nominationsListModal').modal('hide');
                    getNominationDepartments();
                    getDelegates();
                },
                error: function (request) {
                   // console.log(request);
                    let errors = request.responseJSON;
                    console.log(errors);


                }
            });
            //return false;
        });
        $(document).on('submit', 'form#delegate-form-create', function (event) {
            event.preventDefault();

            $("#job_role_id").prop('disabled', false);
            var form = $(this);
            var formData = new FormData($(this)[0]);
           // console.log(formData);
            var url = form.attr("action");



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

                    console.log(data);
                    $("#job_role_id").prop('disabled', true);
                    getNominationDepartments();
                    getDelegates();

                },
                error: function (request) {
                    //console.log(request);
                    $('.has-error').removeClass('has-error');
                    $('.span-error').text('');
                    let errors = request.responseJSON['errors'];
                    console.log(errors);
                    let keys = Object.keys(errors);
//console.log(keys);
                    for (index = 0; index < keys.length; ++index) {
                        $('#div_' + keys[index]).addClass('has-error');
                        $('#span_' + keys[index]).text(errors[keys[index]]);
                        /*console.log(keys[index]);
                        console.log(errors[keys[index]]);*/
                    }
                    $("#job_role_id").prop('disabled', true);

                }
            });
            //return false;
        });
        $(document).on('click', '.nominateBtn', function () {
            var department_id = this.value;
            var committe_id= '{{$committee->id}}';
            //console.log("id : " + department_id);
            var url = '{{url('/users/delegates/DepartmentDelegatesNotInCommittee')}}' + '/' + department_id + '/' + committe_id;

            //console.log(url);
            $.ajax({
                type: 'GET',
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    console.log(result);
                    if (result[0].length > 0) {
                        //console.log(result);

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
                            var specialty = result[0][i]['specialty'];
                            if (specialty==null) specialty='';
                            html +='<td>' + department + '</td>';
                            html +='<td>' + result[0][i]['name'] + '</td>';
                            html +='<td>' + result[0][i]['job_title'] + '</td>';
                            html +='<td>' + result[0][i]['national_id'] + '</td>';
                            html +='<td>' + result[0][i]['phone_number'] + '</td>';
                            html +='<td>' + result[0][i]['email'] + '</td>';
                            html +='<td>' + specialty + '</td>';
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
        function getNominationDepartments() {
            var committee_id = '{{$committee->id}}';
            //console.log('committee_id : ' + committee_id);
            var url ='{{route('committee.get.NominationDepartments',':id')}}';
            url = url.replace(':id', committee_id);
            $.ajax({
                type: 'GET',
                url: url,
                cache: false,
                contentType: false,
                processData: false,
                success: function (result) {
                    //console.log(result);
                   if (result.length > 0) {
                        $('#nominationTable').html('');
                        var html = "";
                        for (var i = 0; i < result.length; i++) {
                            html += '<tr>';
                            html += '<td>' + (i + 1) + '</td>';

                            var department = result[i]['name'];
                            if (result[i]['reference_department'])
                            {
                                department +='/' + result[i]['reference_department']['name'];
                            }
                            html +='<td>' + department + '</td>';
                            nomination_criteria="لا يوجد";
                            if ( result[i]['pivot']['nomination_criteria']!=null)
                            {
                                nomination_criteria =result[i]['pivot']['nomination_criteria'];
                            }

                            html +='<td>' + nomination_criteria + '</td>';
                            html +='<td>' ;
                            html +=  (result[i]['pivot']['has_nominations']==1)?'{{__('committee::committees.nomination_done')}}':'{{__('committee::committees.nomination_not_done') }}';
                            html += '</td>';
                            html += '<td>';
                            html += '<button  data-toggle="modal"  value="' + result[i]['id'] +'" class="btn btn-primary nominateBtn">{{__('committee::committees.nominate')}}</button>';
                            html += '</td>';
                            html += '</tr>';
                        }
                        $('#nominationTable').html(html);

                    }

                },
                error: function (data) {
                    var errors = data.responseJSON;
                    console.log(data);

                }


            });
        }
         function getDelegates() {
             var committee_id = '{{$committee->id}}';
             //console.log('committee_id : ' + committee_id);
             var url ='{{route('committees.get.delegate',':id')}}';
             url = url.replace(':id', committee_id);
             $.ajax({
                 type: 'GET',
                 url: url,
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function (result) {
                     if (result.length > 0) {
                         //console.log(result);
                         $('#delegatesTable').html('');
                         var html = "";
                         for (var i = 0; i < result.length; i++) {
                             html += '<tr>';
                             html += '<td>' + (i + 1) + '</td>';

                             var department = result[i]['department']['name'];
                             if (result[i]['department']['reference_department'])
                             {
                                 department +='/' + result[i]['department']['reference_department']['name'];
                             }

                             html +='<td>' + department + '</td>';
                             html +='<td>' + result[i]['name'] + '</td>';
                             html +='<td>' + result[i]['national_id'] + '</td>';
                             html +='<td>' + result[i]['phone_number'] + '</td>';
                             html +='<td>' + result[i]['email'] + '</td>';

                             dataHref="{{ route('delegate.remove.from.committee',['delegate_id'=>':delegate_id','committee_id'=>':committee_id','department_id'=>':delegate_department_id']) }}"
                             dataHref = dataHref.replace(':delegate_id', result[i]['id']);
                             dataHref = dataHref.replace(':committee_id','{{$committee->id}}');
                             dataHref = dataHref.replace(':delegate_department_id',result[i]['pivot']['nominated_department_id']);
                             //dataHref = dataHref.replace(':reason','');

                             html += '<td> ' ;
                             html +='<a data-href="'+ dataHref +'"  class="btn btn-sm btn-danger delete-row-delegate">';
                             html +='<i class="fa fa-trash"></i> {{ __('users::coordinators.delete') }}';
                             html +='</a>' ;
                             html +='</td>';
                             html += '</tr>';
                         }
                         html +='<tr>';
                         html +='<td colspan="6" style="font-weight:bold">';
                         html +='   اجمالى عددالمرشحين :  ' + result.length;
                         html +='</td>';
                         html +='</tr>';
                         $('#delegatesTable').html(html);

                     }

                 },
                 error: function (data) {
                     var errors = data.responseJSON;
                     console.log(data);

                 }


             });
         }

    });


</script>

