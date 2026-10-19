<x-layout>
    <h2 class="text-center text-3xl border-b-gray-400 mb-4 pb-4">Welcome to Workopia</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        @forelse($jobs as $job)
            <x-job-card :job="$job"/>
        @empty
            <p>No jobs available</p>
        @endforelse
    </div>
    <div class="text-center pb-4">
        <x-button-link
            url="{{route('jobs.index')}}"
            icon="arrow-alt-circle-right"
            bgColor="bg-gray-300"
            hoverColor="hover:bg-gray:500"
        >
            Show All Jobs
        </x-button-link>
    </div>
    <x-bottom-banner/>
</x-layout>


