<nav class="mr-5">
    <ul class="pagination justify-content-end">
        <li class="page-item @if($pager->getCurrentPage()==1) disabled @endif ">
            <a class="page-link" href="javascript:goToPage({{$pager->getCurrentPage()-1}});">
                @lang('pagination.previous')
            </a>
        </li>
        @if($pager->getCurrentPage()!=1)
            <li class="page-item"><a class="page-link" href="javascript:goToPage({{$pager->getCurrentPage()-1}});">{{$pager->getCurrentPage()-1}}</a></li>
        @endif
        <li class="page-item disabled"><a class="page-link" href="javascript:;">{{$pager->getCurrentPage()}}</a></li>
        @if($pager->getCurrentPage()!=$pager->getLastPage())
            <li class="page-item"><a class="page-link" href="javascript:goToPage({{$pager->getCurrentPage()+1}});">{{$pager->getCurrentPage()+1}}</a></li>
        @endif
        <li class="page-item @if($pager->getCurrentPage()==$pager->getLastPage()) disabled @endif ">
            <a class="page-link" href="javascript:goToPage({{$pager->getCurrentPage()+1}});">
                @lang('pagination.next')
            </a>
        </li>
    </ul>
</nav>
<script>
    function goToPage(page) {
        location.href = '{{route(\Illuminate\Support\Facades\Request::route()->getName())}}' + '?page=' + page;
    }
</script>
