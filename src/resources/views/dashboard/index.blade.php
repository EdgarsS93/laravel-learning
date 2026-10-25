<x-layout>
    <section class="flex flex-col md:flex-row gap-4">
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">Profile Info</h3>
            @if($user->avatar)
                <div class="mt-2 flex justify-center ">
                    <img src="{{asset('storage/'.$user->avatar)}}" alt="{{$user->name}}" class="w-32 h-32 rounded-full object-cover">
                </div>
            @endif
            <form method="POST" action="{{route('profile.update')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-inputs.text id="name" name="name" label="Name" value="{{$user->name}}"/>
                <x-inputs.text id="email" name="email" label="Email" type="email" value="{{$user->email}}"/>
                <x-inputs.file id="avatar" name="avatar" label="Upload Avatar"/>
                <button type="submit" class="text-white bg-green-400 hover:bg-green-500 rounded px-4 py-2 w-full">Save</button>
            </form>
        </div>
        <div class="bg-white p-8 rounded-lg shadow-md w-full">
            <h3 class="text-3xl text-center font-bold mb-4">My Job Listings</h3>
            @forelse($jobs as $job)
                <div class="flex justify-between items-center bordr-b-2 border-gray-200 py-2">
                    <div>
                        <h3 class="text-xl font-semibold">{{$job->title}}</h3>
                        <p class="text-gray-700">{{$job->job_type}}</p>
                    </div>
                    <div class="flex space-x-3 ml-4">
                        <a
                            href="{{route('jobs.edit', $job)}}"
                            class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded"
                        >Edit</a
                        >
                        <!-- Delete Form -->
                        <form method="POST" action="{{route('jobs.destroy', $job)}}?from=dashboard" onsubmit="return confirm('Are you sure, that you want to delete this job')">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded"
                            >
                                Delete
                            </button>
                        </form>
                        <!-- End Delete Form -->
                    </div>
                </div>
                <!--Appkications section-->
                <div class="mt-4">
                    <h4 class="text-lg font-semibold mb-4"> Job Applications</h4>
                    @forelse($job->applications as $application)
                        <div class="py-2">
                           <p class="text-gray-800">
                                <strong>Name: </strong> {{$application->full_name}}
                            </p>
                            <p class="text-gray-800">
                                <strong>Phone: </strong> {{$application->contact_phone}}
                            </p>
                            <p class="text-gray-800">
                                <strong>Email: </strong> {{$application->contact_email}}
                            </p>
                            <p class="text-gray-800">
                                <strong>Message: </strong> {{$application->message}}
                            </p>
                            <p class="my-4">
                                <a
                                    href="{{asset('storage/' . $application->resume_path)}}"
                                    class="text-blue-500 hover:underline"
                                    download
                                >
                                    <i class="fa fa-download"></i> Download Resume
                                </a>
                            </p>
                            <form
                                method="POST"
                                action="{{route('application.destroy', $application)}}"
                                onsubmit="return confirm('Are you sure , that you wan to delete this application?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 cursor-pointer">
                                    <i class="fa fa-trash"></i> Delete application
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-700">No applications for this job</p>
                    @endforelse
                </div>
                <!--Appkications section end-->
            @empty
                <p class="text-gray-700">Yuo have not job listings</p>
            @endforelse
        </div>
    </section>
</x-layout>
