<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-lg-2 form-inline">
                        Por Pagina:
                    </div>
                    <div class="col-lg-1 form-inline">
                        <select wire:model="perPage" class="form-control form-control-sm form-inline"
                            style="display: inline;">
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>100</option>
                        </select>
                    </div>
                    <div class="col-lg-9">
                        <input wire:model="search" class="form-control" type="text" placeholder="Buscar Producto...">
                    </div>
                </div>
                <div class="row table-responsive">

                    <table class="table table-sm table-hover table-striped overflow-scroll tblLayoutWidFont">
                        <thead>
                            <tr>
                                <th style="vertical-align: middle; width: 5%">
                                    <a class="text-primary">
                                        #
                                    </a>
                                </th>
                                <th style="vertical-align: middle;">
                                    <a class="text-primary" wire:click.prevent="sortBy('products.description')"
                                        role="button">
                                        Producto
                                        @include('includes._sort-icon', [
                                            'field' => 'products.description',
                                        ])
                                    </a>
                                </th>
                                <th style=" vertical-align: middle; width: 5%"
                                    wire:click.prevent="sortBy('products.pvpu')" role="button">
                                    <a class="text-primary" href="">
                                        PVPU
                                        @include('includes._sort-icon', [
                                            'field' => 'products.pvpu',
                                        ])
                                    </a>
                                </th>
                                <th style="vertical-align: middle; width: 5%"
                                    wire:click.prevent="sortBy('products.pvpc')" role="button">
                                    <a class="text-primary">
                                        PVPC
                                        @include('includes._sort-icon', [
                                            'field' => 'products.pvpc',
                                        ])
                                    </a>
                                </th>
                                <th style="vertical-align: middle; width: 5%">
                                    <a class="text-primary">
                                        PVPR
                                    </a>
                                </th>
                                <th style="vertical-align: middle; width: 10%">
                                    <a class="text-primary">
                                        Descuento
                                    </a>
                                </th>
                                <th style="vertical-align: middle; width: 15%">
                                    <a class="text-primary">
                                        Laboratorio
                                    </a>
                                </th>
                                <th style="vertical-align: middle;">
                                    <a class="text-primary">
                                        Utilidad
                                    </a>
                                </th>
                                <th style="vertical-align: middle; width: 6%">
                                    <a class="text-primary">
                                        Stock<br>Unidad
                                    </a>
                                </th>
                                <th style="vertical-align: middle; width: 5%">
                                    <a class="text-primary">
                                        Stock<br>Caja
                                    </a>
                                </th>
                                <th style="vertical-align: middle; width: 10%"></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @if (count($inventarioData->data) > 0)
                                @foreach ($inventarioData->data as $producto)
                                    <tr>
                                        <td class="text-right">{{ $producto->producto->id }}
                                        </td>

                                        <td class="text-sm-start">
                                            {{ $producto->producto->description }}</td>
                                        <td class="text-left">{{ $producto->producto->pvpu }}</td>
                                        <td class="text-left">{{ $producto->producto->pvpc }}</td>
                                        <td class="text-left">{{ $producto->producto->pvpr }}</td>
                                        <td class="text-left">{{ $producto->producto->porcen_discount }}%</td>
                                        <td class="actions">
                                            {{ $producto->laboratorio->name }}
                                        </td>
                                        <td class="text-sm textJustificado">{{ $producto->producto->utility }}
                                        </td>
                                        <td class="text-right">
                                            {{ $producto->stockUnidad }}</td>
                                        <td class="text-right">
                                            {{ $producto->stockCaja }}</td>
                                        <td>

                                            <button class="btn btn-sm btn-primary btnDisplayBlocRela" id="btnAgregar"
                                                wire:click="$emitUp('setProductoSelect',{{ $producto->producto->id }},'{{ $producto->producto->description }}')">Agregar</button>

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
                        {{ $inventarioData->paginate->links() }}
                    </div>
                    <div class="col text-right text-muted">
                        Mostrar {{ $inventarioData->paginate->firstItem() }} a
                        {{ $inventarioData->paginate->lastItem() }}
                        de
                        {{ $inventarioData->paginate->total() }} registros
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (count($carroVenta) > 0)
        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <button wire:click.prevent="limpiarCarrito()">Limpiar Carrito</button>
                        </div>
                        <div class="col-sm-6">
                            <button wire:click.prevent="relizarCompra()">Realizar Compra</button>
                        </div>
                    </div>
                    <div class="row table-responsive ">
                        <table class="table table-sm table-hover table-striped overflow-scroll tblLayoutWidFont">
                            <thead>
                                <tr>
                                    <th style="width: 5%">
                                        <a class="text-primary">
                                            #
                                        </a>
                                    </th>
                                    <th>
                                        <a class="text-primary">
                                            Producto
                                        </a>
                                    </th>
                                    <th style="width: 10%">
                                        <a class="text-primary">
                                            Presentacion
                                        </a>
                                    </th>
                                    <th style="width: 8%">
                                        <a class="text-primary">
                                            Unidad
                                        </a>
                                    </th>
                                    <th style="width: 20%">
                                        <a class="text-primary">
                                            Precio
                                        </a>
                                    </th>
                                    <th style="width: 10%">
                                        <a class="text-primary">
                                            Total
                                        </a>
                                    </th>
                                    <th style="width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($carroVenta as $carro)
                                    <tr>

                                        <td class="text-right">{{ $carro['id'] }} </td>
                                        <td class="text-left">{{ $carro['description'] }}</td>
                                        <td class="text-right">
                                            <select class="form-select" aria-label="Default select example"
                                                name="prsentacion{{ $carro['id'] }}"
                                                id="prsentacion{{ $carro['id'] }}"
                                                wire:change="cambioRegistroCarro('{{ $carro['idCarro'] }}',1,document.getElementById('prsentacion{{ $carro['id'] }}').value)"
                                                style="line-height: 15px;">
                                                @foreach ($tipoPresentacion as $tipo)
                                                    <option value="{{ $tipo }}">{{ $tipo }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-right">
                                            <input type="number" id="cantidaProd{{ $carro['id'] }}"
                                                name="cantidaProd{{ $carro['id'] }}" min="1" max="100"
                                                value="{{ $carro['cantidad'] }}"
                                                wire:change="cambioRegistroCarro('{{ $carro['idCarro'] }}',2,document.getElementById('cantidaProd{{ $carro['id'] }}').value)"
                                                style="width: 50px">
                                        </td>
                                        <td class="text-left">
                                            <div class="row">
                                                <div class="col-8 form-check"
                                                    style="padding-left: 60px; padding-right: 0px;">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Precio Caja?
                                                    </label>
                                                    <input class="form-check-input" type="checkbox"
                                                        name="pvpr{{ $carro['id'] }}" id="pvpr{{ $carro['id'] }}"
                                                        {{ $carro['siPvpr'] ? 'checked' : '' }}
                                                        wire:click="cambioRegistroCarro('{{ $carro['idCarro'] }}',3, ($(pvpr{{ $carro['id'] }}).is(':checked')) )"
                                                        style="padding-left: 0;">
                                                </div>
                                                <div class="col-4 text-left"
                                                    style="padding-left: 0;padding-right: 40px;">
                                                    {{ $carro['precio'] }}
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            {{ $carro['total'] }}
                                        </td>
                                        <td>
                                            <button wire:click.prevent="eliminarCarrito('{{ $carro['idCarro'] }}')"
                                                class="btn btn-danger">Eliminar</button>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="5" scope="row">Total</th>
                                    <td>{{ $totalCarrito }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="modalProducto" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header row-span-2">
                    <h5 class="modal-title col-lg-11" id="productoName"></h5>
                    <button type="button" class="btn-close col-lg-1" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <select class="form-select " name="presentacion" id="presentacion">
                                @foreach ($tipoPresentacion as $tipo)
                                    <option value="{{ $tipo }}">{{ $tipo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="number" id="cantidaProd" name="cantidaProd" min="1" max="100"
                            class="col-sm-4">
                        <div class="col-sm-3 offset-sm-1 form-check">
                            <label class="form-check-label" for="defaultCheck1">
                                Precio Caja?
                            </label>
                            <input class="form-check-input" type="checkbox" name="pvpr" id="pvpr">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregar()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function agregar() {
        var presentacion = document.getElementById('presentacion').value
        var cantidad = document.getElementById('cantidaProd').value
        Livewire.emit('agregar', presentacion, cantidad, $('#pvpr').is(':checked'));
        limpiarControles();
        Livewire.emit('setProductoSelect', 0, '', false);

    }

    function cerrarModal() {
        $("#modalProducto").modal('hide');
    }

    function limpiarControles() {
        document.getElementById('cantidaProd').value = 1;
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
            document.getElementById('productoName').innerHTML = event.detail.productoName;
            document.getElementById('cantidaProd').value = 1;
            $("#modalProducto").modal('show');
        } else {
            $("#modalProducto").modal('hide');
        }
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

</style>
