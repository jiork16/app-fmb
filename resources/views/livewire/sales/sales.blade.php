<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
        <div class="card">
            <div class="card-body">
                <div class="row mb-4 justify-content-between">
                    <div class="col-lg-2 form-inline">
                        Por Pagina:
                        <select wire:model="perPage" class="form-control form-control-sm">
                            <option>5</option>
                            <option>10</option>
                            <option>15</option>
                            <option>20</option>
                            <option>100</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <input wire:model="search" class="form-control" type="text" placeholder="Buscar Producto...">
                    </div>
                </div>
                <div class="row table-responsive">
                    <table class="table table-sm table-hover overflow-scroll align-middle mb-0">
                        <thead>
                            <tr>
                                <th>
                                    <a class="text-primary" href="#">
                                        #
                                    </a>
                                </th>
                                <th>
                                    <a class="text-primary" href="#">
                                        Producto
                                    </a>
                                </th>
                                <th>
                                    <a class="text-primary" href="#">
                                        PVPU
                                    </a>
                                </th>
                                <th>
                                    <a class="text-primary" href="#">
                                        PVPC
                                    </a>
                                </th>
                                <th>
                                    <a class="text-primary" href="#">
                                        PVPR
                                    </a>
                                </th>
                                <th>
                                    <a class="text-primary" href="#">
                                        Laboratorio
                                    </a>
                                </th>
                                <th><a class="text-primary" href="#">
                                        Utilidad
                                    </a>
                                </th>
                                <th><a class="text-primary" href="#">
                                        StockUnidad
                                    </a>
                                </th>
                                <th><a class="text-primary" href="#">
                                        StockCaja
                                    </a>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @if (count($inventarioData->data) > 0)
                                @foreach ($inventarioData->data as $producto)
                                    <tr>
                                        <td class="text-right">{{ $producto->producto->id }}
                                        </td>
                                        <td class="actions">
                                            {{ $producto->producto->description }}</td>
                                        <td class="text-left">{{ $producto->producto->pvpu }}</td>
                                        <td class="text-left">{{ $producto->producto->pvpc }}</td>
                                        <td class="text-left">{{ $producto->producto->pvpr }}</td>
                                        <td class="actions">
                                            {{ $producto->laboratorio->name }}
                                        </td>
                                        <td class="text-sm-start text-break fs-6 lh-1">
                                            {{ $producto->producto->utility }}
                                        </td>
                                        <td class="text-right">
                                            {{ $producto->stockUnidad }}</td>
                                        <td class="text-right">
                                            {{ $producto->stockCaja }}</td>
                                        <td>
                                            <button wire:click.prevent="agregarCarrito({{ $producto->producto->id }})"
                                                class="btn btn-primary">Agregar</button>
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
        @if (count($carroVenta) > 0)
            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
                <div class="card">
                    <div class="row">
                        <div class="col-sm-6">
                            <button wire:click.prevent="limpiarCarrito()">Limpiar Carrito</button>
                        </div>
                        <div class="col-sm-6">
                            <button wire:click.prevent="relizarCompra()">Realizar Compra</button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row table-responsive-sm">
                            <table class="table table-sm table-hover overflow-scroll align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <a class="text-primary" href="#">
                                                #
                                            </a>
                                        </th>
                                        <th>
                                            <a class="text-primary" href="#">
                                                Producto
                                            </a>
                                        </th>
                                        <th>
                                            <a class="text-primary" href="#">
                                                Presentacion
                                            </a>
                                        </th>
                                        <th>
                                            <a class="text-primary" href="#">
                                                Unidad
                                            </a>
                                        </th>
                                        <th>
                                            <a class="text-primary" href="#">
                                                Precio
                                            </a>
                                        </th>
                                        <th>
                                            <a class="text-primary" href="#">
                                                Total
                                            </a>
                                        </th>
                                        <th>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($carroVenta as $carro)
                                        <tr>
                                            <td class="text-right">{{ $carro['id'] }} </td>
                                            <td class="actions">{{ $carro['description'] }}</td>
                                            <td class="text-justify">
                                                <select class="form-select" aria-label="Default select example"
                                                    name="prsentacion{{ $carro['id'] }}"
                                                    id="prsentacion{{ $carro['id'] }}"
                                                    wire:change="cambioRegistroCarro({{ $carro['id'] }},1,document.getElementById('prsentacion{{ $carro['id'] }}').value)">
                                                    @foreach ($tipoPresentacion as $tipo)
                                                        <option value="{{ $tipo }}">{{ $tipo }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" id="cantidaProd{{ $carro['id'] }}"
                                                    name="cantidaProd{{ $carro['id'] }}" min="1" max="100"
                                                    value="{{ $carro['unidad'] }}"
                                                    wire:change="cambioRegistroCarro({{ $carro['id'] }},2,document.getElementById('cantidaProd{{ $carro['id'] }}').value)">
                                            </td>
                                            <td class="text-left row">
                                                <div class="col-4 p-0">
                                                    {{ $carro['precio'] }}
                                                </div>
                                                <div class="col-8 form-check pl-0">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="pvpr{{ $carro['id'] }}" id="pvpr{{ $carro['id'] }}"
                                                        wire:click="cambioRegistroCarro({{ $carro['id'] }},3, ($(pvpr{{ $carro['id'] }}).is(':checked')) )">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        Precio Caja?
                                                    </label>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                {{ $carro['total'] }}
                                            </td>
                                            <td>
                                                <button wire:click.prevent="eliminarCarrito({{ $carro['id'] }})"
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
    </div>
</div>
<script>
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
    .actions {
        white-space: nowrap;
        width: 1px;
    }

</style>
