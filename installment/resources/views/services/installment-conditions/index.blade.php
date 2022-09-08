@extends('layouts.app')

@section('content')
    <h2>
        <a href="{{route('services.show', [$service])}}">
            Service : {{$service->title}}
        </a>
    </h2>

    <h2>Service Installment Conditions</h2>

    @forelse($installmentConditions as $installmentCondition)
        <div class="box">
            <p>maximum : {{$installmentCondition->maximum}}</p>
            <p>installments count : {{$installmentCondition->installments_count}}</p>
            <h4>
                <a href="{{route('services.installment_conditions.show', [$service, $installmentCondition])}}">
                    Show it
                </a>
            </h4>

            @if(auth('servers')->user()?->can('update',[$installmentCondition, $service]))
                <a href="{{route('services.installment_conditions.edit', [$service, $installmentCondition])}}">edit installmnent condition </a>
            @endif
            @if(auth('servers')->user()?->can('delete',[$installmentCondition, $service]))
                <form action="{{route('services.installment_conditions.destroy', [$service, $installmentCondition])}}" method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="delete"/>
                </form>
            @endif
        </div>
    @empty
        <h2>No Installment Condition !</h2>
    @endforelse

@endsection