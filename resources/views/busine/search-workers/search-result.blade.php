
<div class="col-md-12" style="margin-bottom: 100px">
    <div style="z-index: -10;position: fixed;bottom:0">
        <input type="text" id="text-copy">
    </div>
    <div class="panel panel-bordered">
        

            <div class="panel-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Calificación</th>
                                <th>Accion</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                @if(number_format($item->star, 2) <= $star+1)
                                    <tr>
                                        <td style="text-align: center">{{ $item->first_name }}</td>
                                        <td style="text-align: center">{{ $item->last_name}}</td>
                                        <td style="text-align: center">
                                            @if($item->star >= 1 && $item->star < 2)
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                            @elseif($item->star >= 2 && $item->star < 3)
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                            @elseif($item->star >= 3 && $item->star < 4)
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                            @elseif($item->star >= 4 && $item->star < 5)
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #b3b3b3"></i>
                                            @elseif($item->star >= 5)
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                                <i class="fa fa-star" style="color: #ffc107"></i>
                                            @endif
                                            <br>
                                            <small>{{number_format($item->star, 2)}}</small>
                                        </td>
                                        <td style="text-align: right">
                                            <a type="button" data-toggle="modal" data-target="#modal_solicitud" data-id="{{ $item->id}}" title="Enviar solicitud de trabajo" class="btn btn-primary"><i class="fa-regular fa-envelope"></i> <span class="hidden-xs hidden-sm"></span></a>
                                        </td>                                
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center">No hay resultados</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </form>
    </div>
</div>
{{-- modal para enviar solicitud de trabajo --}}
<div class="modal modal-info fade" tabindex="-1" id="modal_solicitud" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            {!! Form::open(['route' => 'message-people-busine.store', 'id' => 'form-pagar', 'method' => 'POST', 'class' => 'form-search']) !!}        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa-regular fa-envelope"></i>  Enviar solicitud de Trabajo</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="rubro_people_id" value="{{$rubro_people}}">
                <input type="hidden" name="rubro_busine_id" value="{{$rubro_busine->rubro_busine}}">
                <input type="hidden" name="busine_id" value="{{$rubro_busine->busine_id}}">
                <input type="hidden" name="people_id" id="id">

                <div class="text-center" style="text-transform:uppercase">
                    <i class="fa-regular fa-envelope" style="color: rgb(87, 87, 87); font-size: 5em;"></i>
                    <br>
                    <p><b>Desea Enviar solicitud...!</b></p>
                </div>
                <div class="row">
                    <div class="form-group col-md-6" id="div-destinatario" >
                        <label class="control-label">Incluir Precio Estimado</label>
                        <input 
                        type="checkbox" 
                        
                        id="toggleswitch" 
                        data-toggle="toggle" 
                        data-on="Interno" 
                        data-off="Externo" 
                        >
                    </div>
                </div>
                <div class="row" id="money">
                    
                </div>

                <div class="row">   
                    <div class="col-md-12">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><b>Observacion:</b></span>
                        </div>
                        <textarea id="detail" class="form-control" name="detail" cols="77" rows="3"></textarea>
                    </div>                
                </div>
            </div>                
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                {{-- <input type="submit" class="btn btn-dark" value="Sí, Enviar"> --}}
                <button type="button" class="btn btn-info btn-submit" onclick="sendForm('form-pagar', 'Mensaje enviado exitosamente.')">Sí, Enviar</button>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>








<style>
    #dataTable {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        #dataTable td, #dataTable th {
        border: 1px solid #ddd;
        padding: 8px;
        color: #0f0f0f;
        }

        #dataTable tr:nth-child(even){background-color: #f2f2f2;}

        #dataTable tr:hover {background-color: #ddd;}

        #dataTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #04AA6D;
            color: white;
        }
        small{font-size: 12px;
            color: rgb(12, 12, 12);
            font-weight: bold;
        }

    /* .text-selected {
        cursor: pointer;
    }
    .app-footer {
        opacity: 1 !important;
    }
    .text-selected-copy{
        color: green !important;
        text-decoration: underline !important;
    }

    #dataTable-aguinaldo th{
        background-color: #E74C3C !important;
    }
    th{
        font-size: 11px !important;
    } */
</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#modal_solicitud').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) 
        var id = button.data('id')

        var modal = $(this)
        modal.find('.modal-body #id').val(id)
                
    });

    function sendForm(formId, message){
            $('.btn-submit').attr('disabled', true);
            $.post($('#'+formId).attr('action'), $('#'+formId).serialize(), function(res){
                if(res.success){
                    // toastr.success(message, 'Bien hecho!');
                    // alert('Solicitud enviada');
                    let timerInterval
                    Swal.fire({
                    title: res.message,
                    html: '<h2><i class="fa-regular fa-envelope"></i></h2>',
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 50)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log('I was closed by the timer')
                    }
                    })
                }else{
                    toastr.error(res.message ? res.message : 'Ocurrió un error.', 'Oopsx!')
                }
                $('.btn-submit').attr('disabled', false);
            })
            .fail(function() {
                toastr.error('Ocurrió un error en nuestro servidor.', 'Oops!');
                $('.btn-submit').attr('disabled', false);
            })
            $('.modal').modal('hide');
        }

        $('#toggleswitch').on('change', function() {
            if (this.checked) {
                // alert('checked');
                var html_money = '<div class="col-md-6">'+
                                    '<div class="input-group-prepend">'+
                                        '<span class="input-group-text"><b>Precio Estimado:</b></span>'+
                                    '</div>'+
                                    '<input type="text" class="form-control" name="imoney" value="0.00">'+
                                '</div>'+
                                '<div class="col-md-6">'+
                                    '<div class="input-group-prepend">'+
                                        '<span class="input-group-text"><b>Precio Estimado:</b></span>'+
                                    '</div>'+
                                    '<input type="text" class="form-control" name="fmoney" value="0.00">'+
                                '</div>';
                $('#money').html(html_money);
            } else 
            {
                $('#money').html('');
                // alert('unchecked');
            }
        });


    
</script>