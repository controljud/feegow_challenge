@extends('layouts.app')

@section('content')
    <form>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="specialtiesList">@lang('home.select_specialtie')</label>
                    <select id="specialtiesList" name="specialtiesList" class="form-control">
                    @foreach($specialties as $specialtie)
                        <option value="{{$specialtie['especialidade_id']}}">{{$specialtie['nome']}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
    </form>
@endsection