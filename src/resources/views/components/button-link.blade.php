@props([
    'url' => '/',
    'icon' => null,
    'bgColor'=> 'bg-yellow-500',
    'hoverColor' => 'hover:bg-yellow-600',
    'textColor' => 'text-black',
    'mobile' => false
])

<a
    href="{{$url}}"
    class="{{$bgColor}} {{$hoverColor}} {{$textColor}} px-4 py-2 rounded hover:shadow-md transition duration-300
    {{$mobile ? 'block' : ''}}"
>
    @if($icon)
        <i class="fa fa-{{$icon}} mr-1"></i>
    @endif
    {{$slot}}
</a>
