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
                                    <th class="text-primary" style="vertical-align: middle; width: 5%">
                                        #
                                    </th>
                                    <th class="text-primary" style="vertical-align: middle; width: 12%">
                                        Cliente
                                    </th>
                                    <th class="text-primary" style=" vertical-align: middle; width: 12%">
                                        Usuario/Vendedor
                                    </th>
                                    <th class="text-primary" style="vertical-align: middle;  width: 10%">
                                        Forma de Pago
                                    </th>
                                    <th class="text-primary" style="vertical-align: middle; ">
                                        SubTotal
                                    </th>
                                    <th class="text-primary" style="vertical-align: middle;">
                                        Descuento
                                    </th>
                                    <th class="text-primary" style="vertical-align: middle;">
                                        Base IVA 0
                                    </th>
                                    <th class="text-primary" style="vertical-align: middle;">
                                        Base IVA 12
                                    </th>
                                    <th class="text-primary" style="vertical-align: middle;">
                                        Total
                                    </th>
                                    <th class="text-primary" style="vertical-align: middle;">
                                        Fecha Venta
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
                                                    id="btnDetalle{{ $venta->id }}"
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
                                        <th class="text-primary" style="vertical-align: middle">
                                            Producto
                                        </th>
                                        <th class="text-primary" style="vertical-align: middle; width: 10%">
                                            Unidad
                                        </th>
                                        <th class="text-primary" style=" vertical-align: middle; width: 10%">
                                            Precio
                                        </th>
                                        <th class="text-primary" style="vertical-align: middle; width: 10%">
                                            SubTotal
                                        </th>
                                        <th class="text-primary" style="vertical-align: middle; width: 10%">
                                            Descuento
                                        </th>
                                        <th class="text-primary" style="vertical-align: middle; width: 10%">
                                            Base IVA 0
                                        </th>
                                        <th class="text-primary" style="vertical-align: middle; width: 10%">
                                            Base IVA 12
                                        </th>
                                        <th class="text-primary" style="vertical-align: middle; width: 10%">
                                            Total
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
                                                {{ $detalle->price }}
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

    .input-group-append {
        cursor: pointer;
    }

</style>
