<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
        <div class="card">
            <div class="card-body">
                <div class="mb-4 row">
                    <div class="col-4 row">
                        <div class="col-lg-4" style="width: 93px;padding-right: 0;">
                            <label for="staticEmail" class=" col-form-label">Por Pagina:</label>
                        </div>
                        <div class="col-lg-2" style="padding-left: 0;">
                            <select wire:model="perPage" class="form-control form-inline" style="display: inline;">
                                <option>5</option>
                                <option>10</option>
                                <option>15</option>
                                <option>20</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input wire:model="search" class="form-control" type="text"
                                placeholder="Buscar Producto...">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class=" input-group mb-3">
                            <label for="staticEmail" class=" col-form-label pr-1">Total Vendido:</label>
                            <span class="input-group-text" style="border: none">$</span>
                            <span class="input-group-text" style="border: none">{{ $totalVendido }}</span>
                        </div>
                    </div>
                    <div class="col-lg-5 row">
                        <div class="col-lg-6 row">
                            <label for="startDate" class="col-lg-3 col-form-label"
                                style="padding-right: 0;">Inicio</label>
                            <div class="col-lg-9" style="padding-left: 0;">
                                <input id="startDate" wire:model="startDate" class="col-lg-3 form-control"
                                    type="date" />
                            </div>
                        </div>
                        <div class="col-lg-6 row">
                            <label for="endDate" class="col-lg-2 col-form-label" style="padding-right: 0;">Fin</label>
                            <div class="col-lg-10" style="padding-left: 0;">
                                <input id="endDate" class="col-lg-3 form-control" wire:model="endDate" type="date" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4 row">
                    <div class="row table-responsive">
                        <table class="table table-sm table-hover table-striped overflow-scroll tblLayoutWidFont">
                            <thead>
                                <tr>
                                    <th style="vertical-align: middle; width: 5%">
                                        <a class="text-primary" href="#">
                                            #
                                        </a>
                                    </th>
                                    <th style="vertical-align: middle; width: 12%">
                                        <a class="text-primary" href="#">
                                            Cliente
                                        </a>
                                    </th>
                                    <th style=" vertical-align: middle; width: 12%">
                                        <a class="text-primary" href="#">
                                            Usuario/Vendedor
                                        </a>
                                    </th>
                                    <th style="vertical-align: middle;  width: 10%">
                                        <a class="text-primary" href="#">
                                            Forma de Pago
                                        </a>
                                    </th>
                                    <th style="vertical-align: middle; ">
                                        <a class="text-primary" href="#">
                                            SubTotal
                                        </a>
                                    </th>
                                    <th style="vertical-align: middle;">
                                        <a class="text-primary" href="#">
                                            Descuento
                                        </a>
                                    </th>
                                    <th style="vertical-align: middle;">
                                        <a class="text-primary" href="#">
                                            Base IVA 0
                                        </a>
                                    </th>
                                    <th style="vertical-align: middle;">
                                        <a class="text-primary" href="#">
                                            Base IVA 12
                                        </a>
                                    </th>
                                    <th style="vertical-align: middle;">
                                        <a class="text-primary" href="#">
                                            Total
                                        </a>
                                    </th>
                                    <th style="vertical-align: middle;">
                                        <a class="text-primary" href="#">
                                            Fecha Venta
                                        </a>
                                    </th>
                                    <th style="vertical-align: middle; width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if (count($saleData->data) > 0)
                                    @foreach ($saleData->data as $venta)
                                        <tr>
                                            <td class="text-right">{{ $venta->id }}</td>
                                            <td class="text-sm-start">
                                                {{ Auth::user()->find($venta->user_id)->name }}
                                            </td>
                                            <td class="text-left">
                                                {{ Auth::user()->find($venta->user_id)->name }}
                                            </td>
                                            <td class="text-left">{{ $venta->form_payment_id }}</td>
                                            <td class="text-left">{{ $venta->sub_total }}</td>
                                            <td class="actions">{{ $venta->discount }}</td>
                                            <td class="text-sm textJustificado">{{ $venta->base_iva_0 }}</td>
                                            <td class="text-right">{{ $venta->base_iva_12 }}</td>
                                            <td class="text-right">{{ $venta->total }}</td>
                                            <td class="text-right">{{ $venta->date_sale }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary btnDisplayBlocRela"
                                                    id="btnDetalle"
                                                    wire:click="obtenerDetalle({{ $venta->id }})">Detalle</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="10">
                                            <p class="text-center">No hay resultado para la busqueda
                                                <strong>{{ $search }}</strong> en la pagina
                                                <strong>{{ $page }}</strong> al mostrar
                                                <strong>{{ $perPage }}
                                                </strong> por pagina
                                            </p>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col">
                            {{ $saleData->paginate->links() }}
                        </div>
                        <div class="col text-right text-muted">
                            Mostrar {{ $saleData->paginate->firstItem() }} a
                            {{ $saleData->paginate->lastItem() }}
                            de
                            {{ $saleData->paginate->total() }} registros
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($saleDetalle) > 0)
        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4 row">
                        <div class="row table-responsive">
                            <table class="table table-sm table-hover table-striped overflow-scroll tblLayoutWidFont">
                                <thead>
                                    <tr>
                                        <th style="vertical-align: middle">
                                            <a class="text-primary" href="#">
                                                Producto
                                            </a>
                                        </th>
                                        <th style="vertical-align: middle; width: 10%">
                                            <a class="text-primary" href="#">
                                                Unidad
                                            </a>
                                        </th>
                                        <th style=" vertical-align: middle; width: 10%">
                                            <a class="text-primary" href="#">
                                                Precio
                                            </a>
                                        </th>
                                        <th style="vertical-align: middle; width: 10%">
                                            <a class="text-primary" href="#">
                                                SubTotal
                                            </a>
                                        </th>
                                        <th style="vertical-align: middle; width: 10%">
                                            <a class="text-primary" href="#">
                                                Descuento
                                            </a>
                                        </th>
                                        <th style="vertical-align: middle; width: 10%">
                                            <a class="text-primary" href="#">
                                                Base IVA 0
                                            </a>
                                        </th>
                                        <th style="vertical-align: middle; width: 10%">
                                            <a class="text-primary" href="#">
                                                Base IVA 12
                                            </a>
                                        </th>
                                        <th style="vertical-align: middle; width: 10%">
                                            <a class="text-primary" href="#">
                                                Total
                                            </a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($saleDetalle as $detalle)
                                        <tr>
                                            <td class="text-center">
                                                {{ $detalle->producto }}</td>
                                            <td class="text-right">
                                                {{ $detalle->unit }}
                                            </td>
                                            <td class="text-right">
                                                {{ $detalle->discount }}
                                            </td>
                                            <td class="text-right">{{ $detalle->sub_total }}</td>
                                            <td class="text-right">{{ $detalle->discount }}</td>
                                            <td class="text-right">{{ $detalle->base_iva_0 }}</td>
                                            <td class="text-right">{{ $detalle->base_iva_12 }}</td>
                                            <td class="text-right">{{ $detalle->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function agregar() {
        var presentacion = document.getElementById('presentacion').value
        var cantidad = document.getElementById('cantidaProd').value
        Livewire.emit('agregar', presentacion, cantidad, $('#pvpr').is(':checked'));
        limpiarControles();
        Livewire.emit('setProductoSelect', 0, '', false);

    }

    function limpiarControles() {
        document.getElementById("cantidaProd").defaultValue = "0";
        $("#pvpr").prop("checked", false);
    }
    window.addEventListener('swalAlertdialog', event => {
        Swal.fire({
            position: 'top-center',
            icon: event.detail.icon,
            title: event.detail.title,
            showConfirmButton: false,
            timer: 1200
        })
    })
    window.addEventListener('showmodal', event => {
        $('#modalProducto').appendTo("body");
        if (event.detail.show) {
            $("#modalProducto").modal('show');
        } else {
            $("#modalProducto").modal('hide');
        }
        document.getElementById("cantidaProd").defaultValue = "1";
    })
</script>
<style>
    .tblLayoutWidFont {
        table-layout: fixed;
        width: 1900px;
        font-size: 1em
    }

    .btnDisplayBlocRela {
        display: inline-block;
        position: relative;
    }

    .textJustificado {
        text-align: justify;
    }

    .input-group-append {
        cursor: pointer;
    }

</style>
