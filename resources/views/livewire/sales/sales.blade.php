<div class="mdl-grid" style="padding-top: 5px;">
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
                <div class="row table-responsive" style="height: 300px;overflow: scroll;">
                    <table class="table table-striped table-sm table-hover tblLayoutWidFont">
                        <thead>
                            <tr>
                                <th class="text-primary" style="vertical-align: middle; width: 5%">
                                    #
                                </th>
                                <th class="text-primary" style="vertical-align: middle;" wire:click.prevent="
                                    sortBy('products.description')" role="button">
                                    Producto
                                    @include('includes._sort-icon', [
                                        'field' => 'products.description',
                                    ])
                                </th>
                                <th class="text-primary" style=" vertical-align: middle; width: 6%"
                                    wire:click.prevent="sortBy('products.pvpu')" role="button">
                                    PVPU
                                    @include('includes._sort-icon', [
                                        'field' => 'products.pvpu',
                                    ])
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 6%"
                                    wire:click.prevent="sortBy('products.pvpc')" role="button">
                                    PVPC
                                    @include('includes._sort-icon', [
                                        'field' => 'products.pvpc',
                                    ])
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 5%">
                                    PVPR
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 10%">
                                    Descuento
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 15%">
                                    Laboratorio
                                </th>
                                <th class="text-primary" style="vertical-align: middle;">
                                    Utilidad
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 6%">
                                    Stock<br>Unidad
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 5%">
                                    Stock<br>Caja
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
                                        <td class="text-sm textJustificado" style="font-size: 11px">
                                            {{ $producto->producto->utility }}
                                        </td>
                                        <td class="text-right">
                                            {{ $producto->stockUnidad }}</td>
                                        <td class="text-right">
                                            {{ $producto->stockCaja }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary btnDisplayBlocRela" id="btnAgregar"
                                                onclick="modal({{ $producto->producto->id }},'{{ $producto->producto->description }}')">Agregar</button>

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
                        <tfoot>
                            <tr>
                                <th class="text-primary" style="vertical-align: middle; width: 5%">
                                    #
                                </th>
                                <th class="text-primary" style="vertical-align: middle;" wire:click.prevent="
                                    sortBy('products.description')" role="button">
                                    Producto
                                    @include('includes._sort-icon', [
                                        'field' => 'products.description',
                                    ])
                                </th>
                                <th class="text-primary" style=" vertical-align: middle; width: 6%"
                                    wire:click.prevent="sortBy('products.pvpu')" role="button">
                                    PVPU
                                    @include('includes._sort-icon', [
                                        'field' => 'products.pvpu',
                                    ])
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 6%"
                                    wire:click.prevent="sortBy('products.pvpc')" role="button">
                                    PVPC
                                    @include('includes._sort-icon', [
                                        'field' => 'products.pvpc',
                                    ])
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 5%">
                                    PVPR
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 10%">
                                    Descuento
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 15%">
                                    Laboratorio
                                </th>
                                <th class="text-primary" style="vertical-align: middle;">
                                    Utilidad
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 6%">
                                    Stock<br>Unidad
                                </th>
                                <th class="text-primary" style="vertical-align: middle; width: 5%">
                                    Stock<br>Caja
                                </th>
                                <th style="vertical-align: middle; width: 10%"></th>
                            </tr>
                        </tfoot>
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
                            <button wire:click.prevent="relizarVenta()">Realizar Venta</button>
                        </div>
                    </div>
                    <div class="row table-responsive" style="height: 500px;overflow: scroll;">
                        <table class="table table-striped table-sm table-hover tblLayoutWidFont tblLayoutWidFont">
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
                                                name="prsentacion{{ $carro['idCarro'] }}"
                                                id="prsentacion{{ $carro['idCarro'] }}"
                                                wire:change="cambioRegistroCarro('{{ $carro['idCarro'] }}',1,document.getElementById('prsentacion{{ $carro['idCarro'] }}').value)"
                                                style="line-height: 15px;">
                                                @foreach ($tipoPresentacion as $tipoP)
                                                    @if ($carro['presentacion'] == $tipoP)
                                                        <option value="{{ $tipoP }}" selected>
                                                            {{ $tipoP }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $tipoP }}">{{ $tipoP }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-right">
                                            <input type="number" id="cantidaProd{{ $carro['idCarro'] }}"
                                                name="cantidaProd{{ $carro['idCarro'] }}" min="1" max="100"
                                                value="{{ $carro['cantidad'] }}"
                                                wire:change="cambioRegistroCarro('{{ $carro['idCarro'] }}',2,document.getElementById('cantidaProd{{ $carro['idCarro'] }}').value)"
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
                                                        name="pvpr{{ $carro['idCarro'] }}"
                                                        id="pvpr{{ $carro['idCarro'] }}"
                                                        {{ $carro['siPvpr'] ? 'checked' : '' }}
                                                        wire:click="cambioRegistroCarro('{{ $carro['idCarro'] }}',3, ($(pvpr{{ $carro['idCarro'] }}).is(':checked')) )"
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
                        <div class="col-sm-6">
                            <select class="form-select " name="presentacion" id="presentacion"
                                wire:model="presentacion">
                                <option value="">SELECCIONE UNA OPCION</option>
                                @foreach ($tipoPresentacion as $tipo)
                                    <option value="{{ $tipo }}">{{ $tipo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="number" wire:model="cantidaProducto" id="cantidaProducto" min="1" max="300"
                            class="col-sm-2">
                        <div class="col-sm-3 offset-sm-1 form-check">
                            <label class="form-check-label" for="defaultCheck1">
                                Precio Caja?
                            </label>
                            <input class="form-check-input" type="checkbox" name="pvpr" id="pvpr" wire:model="siPvpr">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="modal(0,'')">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="agregar()">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function modal(idProducto, dProducto) {
        $('#modalProducto').appendTo("body");
        if ($('#modalProducto').is(':visible') == false) {
            document.getElementById('productoName').innerHTML = dProducto;
            document.getElementById('cantidaProducto').value = 1;
            let element = document.getElementById('presentacion');
            element.value = "";
            $("#modalProducto").modal('show');
            Livewire.emitTo('sale', 'setProduct', idProducto);
        } else {
            $("#modalProducto").modal('hide');
        }
    }

    function agregar() {
        var presentacion = document.getElementById('presentacion').value;
        Livewire.emitTo('sale', 'agregar', $('#pvpr').is(':checked'));
        modal(0, '');
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
</script>
<style>
    .tblLayoutWidFont {
        table-layout: fixed;
        width: 1900px;
        font-size: 1em;
        --bs-table-hover-color: #177d57;
        --bs-table-hover-bg: #177d5721;
        height: 10px;
    }

    .btnDisplayBlocRela {
        display: inline-block;
        position: relative;
    }

    .textJustificado {
        text-align: justify;
    }

</style>
