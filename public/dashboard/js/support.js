// Ajax
const _ajax = {
    get: (a,b,c,d='') => {
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
        $.ajax({type:"GET",url:a,encode:true,dataType:"json",beforeSend:d,success:b,error:c});
    },
    post: (a,b,c,d,e='') => {
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
        $.ajax({type:"POST",url:a,data:b,dataType:"json",beforeSend:e,success:c,error:d});
    },
    postWithFile: (a,b,c,d,e='') => {
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
        $.ajax({type:"POST",url:a,data:b,contentType:false,processData:false,beforeSend:e,success:c,error:d});
    },
    put: (a,b,c,d,e='') => {
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
        $.ajax({type:"PUT",url:a,data:b,dataType:"json",beforeSend:e,success:c,error:d});
    }
}

const _validation = {
    action: (r) => {
        var resp = r;
        if (resp.error) {
            $.each(resp.error, function (index, value) {
                if ($('small').length>0) {
                    $('small.' + index + '_error').text(value[0]);
                    if ($('input').length>0){
                        $('input#' + index).addClass('is-invalid');
                        $('input#' + index).keyup(function() {
                            $('small.' + index + '_error').text('');
                            $('input#' + index).removeClass('is-invalid');
                        });
                        $('input#' + index).change(function() {
                            $('small.' + index + '_error').text('');
                            $('input#' + index).removeClass('is-invalid');
                        });
                    }
                    if ($('select').length>0){
                        $('select#' + index).addClass('is-invalid');
                        $('select#' + index).change(function() {
                            $('small.' + index + '_error').text('');
                            $('select#' + index).removeClass('is-invalid');
                        });
                        if ($('.select2').length>0) {
                            $('#select2-'+index+'-container').parent().addClass('border border-danger');
                            $('select#'+index).change(function() {
                                $('small.'+index+'_error').text('');
                                $('#select2-'+index+'-container').parent().removeClass('border border-danger');
                            });
                        }
                    }
                    if ($('textarea').length>0){
                        $('textarea#' + index).addClass('is-invalid');
                        $('textarea#' + index).keyup(function() {
                            $('small.' + index + '_error').text('');
                            $('textarea#' + index).removeClass('is-invalid');
                        });
                    }
                    if($('.choice').length>0){
                        $('.choice.' + index).parent().addClass('border border-danger');
                        $('.choice.' + index).change(function() {
                            $('small.' + index + '_error').text('');
                            $('.choice.' + index).parent().removeClass('border border-danger');
                        });
                    }
                }
            });
        }
    }
}

// Datatable
const _table = {
    set: (url, data, table='#datatable') => {
        $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: data,
            scrollX: true,
            responsive: true
        });
    },
    reload: (table='#datatable') => {
        $(table).DataTable().ajax.reload();
        if ($('#modal_create').hasClass('show')){
            $('#modal_create').modal('hide');
        }
        if ($('#modal_edit').hasClass('show')) {
            $('#modal_edit').modal('hide');
        }
    }
}

const _form = {
    reset: (btn, form) => {
        $(btn).click(function (e) {
            e.preventDefault();
            $('form').trigger('reset');
            $('small.text-danger').text('');
            if ($(form+' input').length>0) {
                $(form+' input').removeClass('is-invalid');
                $(form+' input').val('');
            }
            if ($(form+' textarea').length>0) {
                $(form+' textarea').removeClass('is-invalid');
                $(form+' textarea').val('');
            }
            if ($(form+' select').length>0) {
                $(form+' select').removeClass('is-invalid');
                $(form+' select').trigger('0');
            }
            if($(form+' .choice').length>0){
                $(form+' .choice').parent().removeClass('border border-danger');
                $(form+' .choice').empty().trigger('change');
            }
        });
    }
}

const _swalert = (resp) => {
    let response = resp;
    if (response.status == 200) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: response.message,
            showConfirmButton: false,
            timer: 1500
        })
    } else if (response.status == 404) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: response.responseJSON.message,
            showConfirmButton: false,
            timer: 1500
        })
    }
}

const _input = {
    loading: {
        start: (element) => {
            $(element).html(`<div class="spinner-border text-white" style="width:15.5px;height:15.5px;" role="status"></div>`);
            $(element).attr('disabled','disabled');
        },
        stop: (element, title='Log In') => {
            $(element).html(title);
            $(element).removeAttr('disabled');
        }
    },
    rupiah: (angka, prefix) => {
        var angka = angka;
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}

            return rupiah;
    }
}
