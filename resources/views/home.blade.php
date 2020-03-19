@extends('layouts.app')

@section('content')
    <div class="row dvSelect">
        <div class="col-md-12">
            <label for="specialtiesList">@lang('home.select_specialtie')</label>
            <select id="specialtiesList" name="specialtiesList" class="form-control">
            <option value="">@lang('home.select')</option>
            @foreach($specialties as $specialty)
                <option value="{{$specialty['especialidade_id']}}">{{$specialty['nome']}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <h3 class='titleHidden'>@lang('home.select_professionals')</h3>
    <div class="row" id="dvDoctors">
        
    </div>
@endsection

@section('scripts')
    <script>
        lang_agendar = "@lang('home.schedule')";
    </script>
@endsection