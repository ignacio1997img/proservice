
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
                                <th>Empresa</th>
                                <th>Responsable</th>
                                <th>Calificación</th>
                                <th>Accion</th>
                                
                            </tr>
                        </thead>
                       
                        <tbody>
                            @forelse ($data as $item)
                                @if(number_format($item->star, 2) <= $star+1)
                                    <tr>
                                        <td style="text-align: center">{{ $item->name }}</td>
                                        <td style="text-align: center">{{ $item->responsible}}</td>
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
                                            <a type="button" data-toggle="modal" data-target="#modal_solicitud" data-id="{{ $item->id}}"  class="btn btn-success"><i class="voyager-check"></i> <span class="hidden-xs hidden-sm">Enviar</span></a>
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
<div class="modal modal-primary fade" tabindex="-1" id="modal_solicitud" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            {!! Form::open(['route' => 'message-beneficiary-busine.store', 'id' => 'form-pagar', 'method' => 'POST', 'class' => 'form-search']) !!}        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="voyager-check"></i> Enviar solicitud de Trabajo</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="busine_id" id="id">

                <div class="text-center" style="text-transform:uppercase">
                    <i class="voyager-check" style="color: green; font-size: 5em;"></i>
                    <br>
                    <p><b>Desea Enviar solicitud...!</b></p>
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
                <button type="button" class="btn btn-success btn-submit" onclick="sendForm('form-pagar', 'Mensaje enviado exitosamente.')">Sí, Enviar</button>

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

    
</script>