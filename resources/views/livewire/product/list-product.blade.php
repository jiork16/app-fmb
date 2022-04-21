<div class="mdl-grid">
    <div wire:loading wire:target="perPage,previousPage,nextPage,gotoPage">
        @include('components.loading-indicator')
    </div>
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
                                <th class="text-primary" style="width: 8%">
                                    Precio Unitario
                                </th>
                                <th class="text-primary" style="width: 7%">
                                    Precio Caja
                                </th>
                                <th class="text-primary" style="width: 8%">
                                    Precio Relevante
                                </th>
                                <th class="text-primary" style="width: 15%">
                                    Laboratorio
                                </th>
                                <th class="text-primary" style="width: 40%">
                                    Utilidad
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center text-dark">
                            @if ($data->isNotEmpty())
                                @foreach ($data as $producto)
                                    <tr>
                                        <td class="p-1 text-center  text-dark">{{ $producto->id }}</td>
                                        <td class="p-1 text-center  text-dark text-capitalize">
                                            {{ $producto->description }}</td>
                                        <td class="p-1 text-center  text-dark">{{ $producto->pvpu }}</td>
                                        <td class="p-1 text-center  text-dark">{{ $producto->pvpc }}</td>
                                        <td class="p-1 text-center  text-dark">{{ $producto->pvpr }}</td>
                                        <td class="p-1 text-center  text-dark">
                                            {{ $producto->laboratory->name }}
                                        </td>
                                        <td class="text-sm textJustificado">{{ $producto->utility }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="10">
                                        <p class="text-center">No hay resultado para la busqueda
                                            <strong>{{ $search }}</strong> en la pagina
                                            <strong>{{ $page }}</strong> al mostrar <strong>{{ $perPage }}
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
                        {{ $data->links() }}
                    </div>
                    <div class="col text-right text-muted">
                        Mostrar {{ $data->firstItem() }} a {{ $data->lastItem() }} de
                        {{ $data->total() }} registros
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .tblLayoutWidFont {
        table-layout: fixed;
        font-size: 1em;
        --bs-table-hover-color: #177d57;
        --bs-table-hover-bg: #177d5721;
    }

    .btnDisplayBlocRela {
        display: inline-block;
        position: relative;
    }

    .textJustificado {
        text-align: justify;
    }

</style>
