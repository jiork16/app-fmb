@if ($orderBy !== $field)
    <i class="sort text-muted fas fa-sort"></i>
@elseif ($orderAsc)
    <i class="sort fas fa-sort-up"></i>
@else
    <i class="sort fas fa-sort-down"></i>
@endif
