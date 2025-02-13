@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Daftar Pegawai</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
    <a class="btn btn-primary"
        href={{ route('print.pdf') }}>
        <i class="nav-icon fa fa-print"> Print</i>
    </a>
      <div class="card-tools">
        <div class="input-group input-group-sm">
            <select id="department" class="form-control">
                <option value="">--- Filter Unit Kerja ---</option>
                @forelse ($departments as $department)
                    <option value={{$department}}
                    {{ app('request')->input('filter') == $department ? 'selected':'' }}>{{$department}}</option>
                @empty
                    <option value="">Unit Kerja Kosong</option>
                @endforelse
            </select>
            <button onclick="clearFilter()" type="button" class="btn-info">Clear Filter</button>
            <div style="width:20px"></div>
            <input type="text" name="table_search" class="form-control float-right"
                id="search" placeholder="Search">
            <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
                </button>
            </div>
            <button onclick="clearSearch()" type="button" class="btn-info">Clear Search</button>
        </div>
      </div>
    </div>
    <div class="card-body table-responsive p-0">
      @include('data_table', $datas)
    </div>
  </div>

  {{$datas->links('pagination::bootstrap-5')}}
@stop

@section('js')
<script src="{{ asset('js/axios.min.js') }}"></script>
<script>
    function clearFilter(){
        url = new URL(location.href);
        url.searchParams.delete('filter');
        window.location.href = url.href;
    };

    function clearSearch(){
        url = new URL(location.href);
        url.searchParams.delete('search');
        window.location.href = url.href;
    };

    $(document).ready(function(){
        let url = new URL(location.href);
        const urlParams = new URLSearchParams(location.search);
        $("#search").val(urlParams.get('search'));

        document.getElementById('department').addEventListener(
            'change', function(){
                url.searchParams.delete('filter');
                url.searchParams.append('filter',
                    this.options[this.selectedIndex].text
                );
                window.location.href = url.href;
        });

        document.getElementById('search').addEventListener(
            'change', function(){
                url.searchParams.delete('search');
                url.searchParams.append('search',
                    this.value
                );
                window.location.href = url.href;
        });
    });
</script>
@stop
