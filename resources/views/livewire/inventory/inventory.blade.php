<div>
    <ul class="nav nav-tabs nav-justified mb-2" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="listProducto-tab" data-bs-toggle="tab" href="#listProducto" role="tab"
                aria-controls="listProducto" aria-selected="true">Lista de Productos</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="ListaProductoInvent-tab" data-bs-toggle="tab" href="#ListaProductoInvent"
                role="tab" aria-controls="ListaProductoInvent" aria-selected="false">Lista de Productos Inventariados
            </a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="listProducto" role="tabpanel" aria-labelledby="listProducto-tab">
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
                            <input wire:model="search" class="form-control" type="text"
                                placeholder="Buscar Producto...">
                        </div>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table table-sm table-hover table-striped overflow-scroll tblLayoutWidFont">
                            <thead>
                                <tr>
                                    <th class="text-primary" style="width: 6%">
                                        #
                                    </th>
                                    <th class="text-primary">
                                        Producto
                                    </th>
                                    <th class="text-primary" style="width: 15%">
                                        Laboratorio
                                    </th>
                                    <th class="text-primary" style="width: 40%">
                                        Utilidad
                                    </th>
                                    <th style="vertical-align: middle; width: 10%"></th>
                                </tr>
                            </thead>
                            <tbody class="text-center text-dark">
                                @if ($dataProduct->isNotEmpty())
                                    @foreach ($dataProduct as $producto)
                                        <tr>
                                            <td class="p-1 text-center  text-dark">{{ $producto->id }}</td>
                                            <td class="p-1 text-center  text-dark text-capitalize">
                                                {{ $producto->description }}</td>
                                            <td class="p-1 text-center  text-dark">
                                                {{ $producto->laboratory->name }}
                                            </td>
                                            <td class="text-sm textJustificado">{{ $producto->utility }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary btnDisplayBlocRela"
                                                    id="btnAgregar{{ $producto->id }}"
                                                    onclick="modal({{ $producto->id }},'{{ $producto->description }}')">Inventariar
                                                </button>
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
                            {{ $dataProduct->links() }}
                        </div>
                        <div class="col text-right text-muted">
                            Mostrar {{ $dataProduct->firstItem() }} a {{ $dataProduct->lastItem() }} de
                            {{ $dataProduct->total() }} registros
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ListaProductoInvent -->
        <div class="tab-pane fade" id="ListaProductoInvent" role="tabpanel" aria-labelledby="ListaProductoInvent-tab">
            ..SS.</div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modalInventProducto" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header row-span-2">
                    <h5 class="modal-title col-lg-11" id="productoName"></h5>
                    <button type="button" class="btn-close col-lg-1" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="inputEmail4" class="form-label">Caja(s)</label>
                            <input type="number" class="form-control" id="cantidaCajaProducto" min="0" max="10000">
                        </div>
                        <div class="col">
                            <label for="inputEmail4" class="form-label">Unidad(es)</label>
                            <input type="number" class="form-control" id="cantidaUnidadProducto" min="0" max="10000">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" wire:click="agregarCarrito()"
                        wire:loading.attr="disabled">Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function modal(idProducto, dProducto) {
        $('#modalInventProducto').appendTo("body");
        if ($('#modalInventProducto').is(':visible') == false && idProducto != 0) {
            document.getElementById('productoName').innerHTML = dProducto;
            document.getElementById('cantidaCajaProducto').value = 0;
            document.getElementById('cantidaUnidadProducto').value = 0;
            $("#modalInventProducto").modal('show');
            Livewire.emitTo('sale', 'setProduct', idProducto);
        } else {
            $("#modalInventProducto").modal('hide');
        }
    }
</script>
