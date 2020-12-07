 
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> 
                    Result:
                </div>

                <div class="card-body">
                <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Brunch & Catchup</th>
                        <th>Thirsty Thursday</th>
                        <th class="text-center">Friday Fry-up</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach($Events as $Event)
                            <tr>
                                <td>
                                {{ $Event['Month']  }}
                            </td>
                            <td>
                                {{ $Event['Monday'] }}
                            </td>
                            <td>
                                {{ $Event['Thursday'] }}
                            </td>
                            <td>
                                {{ $Event['Friday'] }}
                            </td> 
                            </tr>
                            
                            @endforeach
                </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection