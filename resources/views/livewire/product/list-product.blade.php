<div class="mdl-grid">
    <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
        <div class="card">
            <div class="card-body">
                <div class="row mb-4 justify-content-between">
                    <div class="col-lg-2 form-inline">
                        Por Pagina:
                        <select wire:model="perPage" class="form-control form-control-sm">
                            <option>10</option>
                            <option>15</option>
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <input wire:model="search" class="form-control" type="text" placeholder="Buscar Producto...">
                    </div>
                </div>
                <div class="row table-responsive">
                    <table class="table overflow-scroll">
                        <thead>
                            <tr>
                                <th wire:click.prevent="sortBy('products.id')">
                                    <a class="text-primary" href="#">
                                        Id
                                    </a>
                                </th>
                                <th wire:click.prevent="sortBy('products.description')">
                                    <a class="text-primary" href="#">
                                        Producto
                                    </a>
                                </th>
                                <th wire:click.prevent="sortBy('cantidad')">
                                    <a class="text-primary" href="#">
                                        PVPU
                                    </a>
                                    @include('includes._sort-icon', ['field' => 'cantidad'])
                                </th>
                                <th wire:click.prevent="sortBy('cantidad')">
                                    <a class="text-primary" href="#">
                                        PVPC
                                    </a>
                                    @include('includes._sort-icon', ['field' => 'cantidad'])
                                </th>
                                <th wire:click.prevent="sortBy('cantidad')">
                                    <a class="text-primary" href="#">
                                        PVPR
                                    </a>
                                    @include('includes._sort-icon', ['field' => 'cantidad'])
                                </th>
                                <th wire:click.prevent="sortBy('cantidad')">
                                    <a class="text-primary" href="#">
                                        Laboratorio
                                    </a>
                                </th>
                                <th wire:click.prevent="sortBy('transacciones_count')"><a class="text-primary"
                                        href="#">
                                        Utilidad
                                    </a>
                                    @include('includes._sort-icon', [
                                        'field' => 'transacciones.cantidad',
                                    ])
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
                                        <td class="p-1 text-center  text-dark">{{ $producto->utility }}</td>
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
        {{-- <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripcion</th>
                    <th>Unidades</th>
                    <th>Generico</th>
                    <th>pvpr</th>
                    <th>pvpc</th>
                    <th>Utilidad</th>
                    <th class="mdl-data-table__cell--non-numeric">Fecha Vencimiento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->generic }}</td>
                        <td>{{ $product->pvpr }}</td>
                        <td>{{ $product->pvpu }}</td>
                        <td>No se define aun</td>
                        <td class="mdl-data-table__cell--non-numeric">Tampoco se define</td>

                    </tr>
                @endforeach
            </tbody>
        </table> --}}
    </div>
</div>

{{-- <table id="example" class="display" style="width:100%">
     <thead>
         <tr>
             <th>#</th>
             <th>Descripcion</th>
             <th>Unidades</th>
             <th>Generico</th>
             <th>pvpr</th>
             <th>pvpc</th>
             <th>Utilidad</th>
             <th>Fecha Vencimiento</th>
         </tr>
     <tbody>
         @foreach ($data as $product)
             <tr>
                 <td>{{ $product->id }}</td>
                 <td>{{ $product->description }}</td>
                 <td>{{ $product->unit }}</td>
                 <td>{{ $product->generic }}</td>
                 <td>{{ $product->pvpr }}</td>
                 <td>{{ $product->pvpu }}</td>
                 <td>No se define aun</td>
                 <td>Tampoco se define</td>

             </tr>
         @endforeach
     </tbody>
     <tfoot>
         <tr>
             <td></td>
             <th>Descripcion</th>
             <td></td>
             <td></td>
             <td></td>
             <td></td>
             <th>Utilidad</th>
             <th>Fecha Vencimiento</th>
         </tr>
     </tfoot>
     </thead>
 </table>
 <table id="tableCompra" class="display" style="width:100%">
     <thead>
         <tr>
             <th>#</th>
             <th>Descripcion</th>
             <th>pvpr</th>
             <th>total</th>
         </tr>
     <tbody>
         @foreach ($data as $product)
             <tr>
                 <td>{{ $product->id }}</td>
                 <td>{{ $product->description }}</td>
                 <td>{{ $product->unit }}</td>
                 <td>{{ $product->generic }}</td>
                 <td>{{ $product->pvpr }}</td>
                 <td>{{ $product->pvpu }}</td>
                 <td>No se define aun</td>
                 <td>Tampoco se define</td>

             </tr>
         @endforeach
     </tbody>
     </thead>
 </table>
 <script>
     $(document).ready(function() {
         // Setup - add a text input to each footer cell
         $('#example tfoot th').each(function() {
             var title = $(this).text();
             $(this).html('<input type="text" placeholder="Search ' + title + '" />');
         });
         // DataTable
         var table = $('#example').DataTable({
             initComplete: function() {
                 // Apply the search
                 this.api().columns().every(function() {
                     var that = this;

                     $('input', this.footer()).on('keyup change clear', function() {
                         if (that.search() !== this.value) {
                             that
                                 .search(this.value)
                                 .draw();
                         }
                     });
                 });
             }
         });

     });
 </script> --}}
