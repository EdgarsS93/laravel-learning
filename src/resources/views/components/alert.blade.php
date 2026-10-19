@props(['type', 'message'])

@if($type)
    <p
        x-data="{show: true}"
        x-init="setTimeout(() => show =false, 5000 )"
        x-show="show"
        class="text-white text-sm rounded-b-sm p-4 mb-4 {{$type === 'success' ? 'bg-green-500' : 'bg-red-500'}}"
    >
        {{$message}}
    </p>
@endif
